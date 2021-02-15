<?php

namespace App\Console\Commands;

use App\Mail\SubscriptionNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Console\Command;
use App\Subscription;
use Carbon\Carbon;

class CheckSubscribers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscribers:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check all subscribers for valid subscription period. Send email notifications';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $subsc = Subscription::where('is_active', 1)->get();
            $now = Carbon::now()->format('Y-m-d');
            $tomorrow = Carbon::now()->addDay()->format('Y-m-d');
            $afterWeek = Carbon::now()->addDays(7)->format('Y-m-d');
            foreach ($subsc as $sub) {
                if ($afterWeek == $sub->expire_at) {
                    Mail::to($sub->user->email)->send(new SubscriptionNotification(2, $sub->expire_at, $sub->user->name, $sub->user->language)); //send mail notification to user    
                } else if ($tomorrow == $sub->expire_at) {
                    Mail::to($sub->user->email)->send(new SubscriptionNotification(2, $sub->expire_at, $sub->user->name, $sub->user->language)); //send mail notification to user    
                } else if ($now > $sub->expire_at) {
                    Mail::to($sub->user->email)->send(new SubscriptionNotification(1, $sub->expire_at, $sub->user->name, $sub->user->language)); //send mail notification to user    
                    $history = $sub->history;
                    $history[] = [
                        'period' => [
                            'from' => $sub->activated_at,
                            'to' => $sub->expire_at
                        ],
                        'payment' => $sub->payment,
                        'role' => $sub->role,
                        'number' => $sub->number,
                        'issued' => $sub->issued
                    ];
                    $sub->activated_at = null;
                    $sub->expire_at = null;
                    $sub->payment = null;
                    $sub->role = 0;
                    $sub->is_active = false;
                    $sub->history = $history;
                    $sub->save();
                }
            }
            Log::channel('jobs')->info('[subscribers.check] Subscribers checked sucessfully');
        } catch (\Throwable $th) {
            Log::channel('jobs')->error('[subscribers.check] Subscribers check fails. '.$th->getMessage());
        }

    }
}
