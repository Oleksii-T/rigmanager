<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\Subscription;
use App\Http\Requests\CreateMailerRequest;
use App\Http\Requests\UpdateMailerRequest;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Traits\Tags;
use Illuminate\Http\Request;
use App\Mailer;
use App\User;

class MailerController extends Controller
{
    use Tags, Subscription;
    /**
     * Display a user`s resourse.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mailer.index', ["mailer"=>auth()->user()->mailer, "subscription"=>$this->isSubscribed()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user_email = auth()->user()->email;
        return view('mailer.create', compact('user_email'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CreateMailerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMailerRequest $request)
    {
        $input = $request->all();
        $input['eq_tags_encoded'] = json_decode($input['eq_tags_encoded']);
        $input['se_tags_encoded'] = json_decode($input['se_tags_encoded']);
        $mailer = new Mailer($input);
        if (!auth()->user()->mailer()->save($mailer)) {
            Session::flash('message-error', __('messages.mailerUploadedError'));
            return view('mailer.index', ["mailer"=>null]);
        }
        Session::flash('message-success', __('messages.mailerUploaded'));
        return redirect(loc_url(route('mailer.index')));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $mailer = auth()->user()->mailer;
        return view('mailer.edit', compact('mailer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\CreateMailerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMailerRequest $request)
    {
        $mailer = auth()->user()->mailer;
        $input = $request->all();
        $input['eq_tags_encoded'] = json_decode($input['eq_tags_encoded']);
        $input['se_tags_encoded'] = json_decode($input['se_tags_encoded']);
        if ( !$mailer->update($input) ) {
            Session::flash('message-error', __('messages.mailerEditedError'));
        } else {
            Session::flash('message-success', __('messages.mailerEdited'));
        }
        return redirect(loc_url(route('mailer.index')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $mailer = auth()->user()->mailer;
        $mailer->delete();
        Session::flash('message-success', __('messages.mailerDeleted'));
        return redirect(loc_url(route('mailer.index')));
    }

    public function toggle()
    {
        $mailer = auth()->user()->mailer;
        if ($mailer->is_active) {
            $mailer->is_active = false;
        } else {
            $mailer->is_active = true;
        }
        $mailer->save();
        return true;
    }

    public function toggleAuthor($user_id)
    {
        $res = $this->addAuthor($user_id);
        if ($res == 0) {
            $mailer = auth()->user()->mailer;
            $authorsArr = $mailer->authors_encoded;
            $pos = array_search($user_id, $authorsArr);
            unset($authorsArr[$pos]);
            $mailer->authors_encoded = $authorsArr;
            $mailer->save();
        }
        return $res;
    }

    public function addAuthor($user_id)
    {
        if (!$this->isSubscribed()) {
            return -2; // error - premium acc required
        }
        $mailer = auth()->user()->mailer;
        if (!$mailer) {
            $mailer = new Mailer;
            $mailer->types = ["1","2","3","4","5","6"];
            $mailer->authors_encoded = $user_id;
            auth()->user()->mailer()->save($mailer);
            return 1; //mailer created with new author
        }
        if (!$mailer->authors_encoded) {
            $mailer->authors_encoded = $user_id;
            $mailer->save();
            return 1; // added first author to existing mailer
        }
        $authorsArr = $mailer->authors_encoded;
        if ( count($authorsArr) == 10 ) {
            return -1; //error - too many authors
        }
        if ( array_search($user_id, $authorsArr) === false ) {
            $authorsArr[] = $user_id;
            $mailer->authors_encoded = $authorsArr;
            $mailer->save();
            return 1; // added new author to old authors
        }
        return 0; // author already in the mailer
    }

    public function createBySearchRequest(Request $request) {
        if ( auth()->user()->mailers->count() > 10 ) {
            return json_encode(['message'=>__('messages.mailerTooManyMailers'), 'code'=>404]);
        }
        $input = json_decode($request->filters, true);
        $input['cost_from'] = $input['costFrom'];
        $input['cost_to'] = $input['costTo'];
        $search = json_decode($request->search, true);
        $resByTag = json_decode($request->resByTag, true);
        if ( isset($resByTag['searchedTagMap']) ) {
            $tagUrl = array_key_last( $resByTag['searchedTagMap'] );
            $input['tag'] = $this->getIdByUrl($tagUrl);
        }
        switch ($search['type']) {
            case 'type':
                $mailerByType = $this->createFromType($search['url']); // type_name and type_codes
                $input['type'] = array_intersect($input['type'], $mailerByType['type']); // make sure that type from chosen type-group respects the "type" filter
                $input['title'] = trim(preg_replace('/\s+/', ' ', $mailerByType['title'])); //save title of future mail message to array
                break;
            case 'tags':
                $input['tag'] = array_key_last($search['value']);
                $input['title'] = $search['value'][array_key_last($search['value'])];
                break;
            case 'author':
                $input['author'] = $search['value']['id'];
                $input['title'] = $search['value']['name'];
                break;
            case 'text':
                $input['keyword'] = $search['value'];
                $input['title'] = $search['value'];
                break;
            case 'none':
                $input['title'] = __('ui.mailerAllPosts');
                break;
            default:
                return false;
                break;
        }
        $mailer = new Mailer($input);
        if (!auth()->user()->mailers()->save($mailer)) {
            Session::flash('message-error', __('messages.mailerUploadedError'));
            return json_encode(['message'=>__('messages.error'), 'code'=>404]);
        }
        return json_encode(['message'=>__('messages.mailerRequestAdded'), 'code'=>500]);
    }

    private function createFromType($typeUrl) {
        switch ($typeUrl) {
            case 'equipment-sell': 
                $types = array(1,3);
                $name = __('ui.introSellEq');
                break;
            case 'equipment-buy':
                $types = [2,4];
                $name = __('ui.introBuyEq');
                break;
            case 'services':
                $types = [5,6];
                $name = __('ui.introSe');
                break;
            case 'tenders':
                $types = array(7);
                $name = __('ui.introTender');
                break;
            default: 
                abort(404);
        }
        $r['type'] = $types;
        $r['title'] = $name;
        return $r;
    }
}
