<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Mail\SubscriptionNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Subscription;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    /*
        status code of history:
        0 - expired
        1 - canceled
    */
    public function freeAccess() {
        auth()->user()->subscription()->save(new \App\Subscription([
            'is_active' => true,
            'number' => 000000,
            'role' => 2,
            'payment' => 0,
            'issued' => Carbon::now(),
            'activated_at' => Carbon::now(),
            'expire_at' => Carbon::create(2021, 5, 1, 0, 0, 0), // March 1, 2021 (01/03/2021)
        ]));
    }

    public function update(Request $request) {
        $newPlan = $this->planNameToInt($request->plan);
        if ($newPlan==0) {
            $this->cancelExpireHelper(auth()->user()->subscription, 1);
            Session::flash('message-success', __('messages.planUpdated'));
            return redirect( loc_url(route('profile.subscription')) );
        }
        $data = [
            'number' => '000000',
            'is_active' => 1,
            'role' => $newPlan,
            'payment' => 0,
            'issued' => Carbon::now()->toDateString(),
            'activated_at' => Carbon::now()->toDateString(),
            'expire_at' => Carbon::now()->addMonth()->toDateString(),
        ];
        $user = auth()->user();
        $sub = $user->subscription;
        //update sub if there is a sub record already
        if ($sub) {
            //update history if user has paid plan
            if ($sub->is_active!=0) {
                $data['history'] = $this->makeHistory($sub, 1); 
            }
            $sub->update($data);
        //craete sub record
        } else {
            $sub = new Subscription($data);
            $user->subscription()->save($sub);
        }
        Session::flash('message-success', __('messages.planUpdated'));
        return redirect( loc_url(route('profile.subscription')) );
    }

    public function cancel() {
        $sub = auth()->user()->subscription;
        $this->cancelExpireHelper($sub, 1);
        Session::flash('message-success', __('messages.planCanceled'));
        return redirect( loc_url(route('profile.subscription')) );
    }

    public function expire($sub) {
        $this->cancelExpireHelper($sub, 0);
        Mail::to($sub->user->email)->send(new SubscriptionNotification(1, $sub->expire_at, $sub->user->name, $sub->user->language)); //send mail notification to user    
        //diactivate posts
        if ($sub->user->posts->isNotEmpty()) {
            foreach ($sub->user->posts as $p) {
                $p->is_active = false;
                $p->save();
            }
        }
        //diactivate mailer
        if ($sub->user->mailers->isNotEmpty()) {
            foreach ($sub->user->mailers as $m) {
                $m->is_active = false;
                $m->save();
            }
        }
    }

    private function cancelExpireHelper($sub, $status) {
        $data = [
            'number' => null,
            'is_active' => 0,
            'role' => 0,
            'payment' => null,
            'issued' => null,
            'activated_at' => null,
            'expire_at' => null,
            'history' => $this->makeHistory($sub, $status),
        ];
        $sub->update($data);
    }

    private function planNameToInt($name) {
        switch ($name) {
            case 'start':
                return 0;
            case 'standart':
                return 1;
            case 'pro':
                return 2;
            default:
                return 0;
        }
    }

    private function makeHistory($sub, $status) {
        $history = [
            'number' => $sub->number,
            'role' => $sub->role,
            'payment' => $sub->payment,
            'issued' => $sub->issued,
            'status' => $status,
            'period' => [
                'from' => $sub->activated_at,
                'to' => Carbon::now()->toDateString()
            ],
        ];
        $oldHis = $sub->history;
        if ( $oldHis ) {
            $oldHis[] = $history;
            return $oldHis;
            
        }
        $h[] = $history;
        return $h;
    }

}