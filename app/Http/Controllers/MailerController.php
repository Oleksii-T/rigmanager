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
    public function create()
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

    public function addTag($tagId)
    {
        if (!$this->isSubscribed()) {
            return -2; // error - premium acc required
        }
        $tags_encoded = $this->getTagType($tagId) . '_tags_encoded';
        $mailer = auth()->user()->mailer;
        if (!$mailer) {
            $mailer = new Mailer;
            $mailer->types = ["1","2","3","4","5","6"];
            $mailer->$tags_encoded = array($tagId);
            auth()->user()->mailer()->save($mailer);
            return 1;
        }
        if (!$mailer->$tags_encoded) {
            $mailer->$tags_encoded = array($tagId);
            $mailer->save();
            return 1;
        }
        $tagsArr = $mailer->$tags_encoded;
        $tags_map = $this->getTagType($tagId) . '_tags_map';
        if ( !array_key_exists($tagId, $mailer->$tags_map) ) {
            $tagsArr[] = $tagId;
            $mailer->$tags_encoded = $tagsArr;
            $mailer->save();
            return 1;
        }
        return -1;
    }

    public function addText($string)
    {        
        if (!$this->isSubscribed()) {
            return false; // error - premium acc required
        }
        $mailer = auth()->user()->mailer;
        // check is Mailer exists
        if ($mailer) {
            // Mailer exists
            if ($mailer->keywords) {
                // Append text to mailer
                $mailer->keywords = $mailer->keywords."\n".$string;
                $mailer->save();
            } else {
                // Mailer have no text
                $mailer->keywords = $string;
                $mailer->save();
            }
        } else {
            // Mailer absent. Create new Mailer
            $mailer = new Mailer;
            $mailer->types = ["1","2","3","4","5","6"];
            $mailer->keywords = $string;
            auth()->user()->mailer()->save($mailer);
        }
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
}
