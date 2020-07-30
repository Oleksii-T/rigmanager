<?php

namespace App\Http\Controllers;

use App\Mailer;
use App\Tags;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\CreateMailerRequest;
use Illuminate\Support\Facades\Session;

class MailerController extends Controller
{
    use Tags;

    /**
     * Display a user`s resourse.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ( $mailer = auth()->user()->mailer ) {
            return view('mailer.index', compact('mailer'));
        } else {
            return view('mailer.index', ["mailer"=>null]);
        }
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
        $mailer = new Mailer($request->all());
        if (!auth()->user()->mailer()->save($mailer)) {
            Session::flash('message-error', __('messages.mailerUploadedError'));
            return view('mailer.index', ["mailer"=>null]);
        }
        Session::flash('message-success', __('messages.mailerUploaded'));
        return redirect(route('mailer.index'));
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
    public function update(CreateMailerRequest $request)
    {
        $mailer = auth()->user()->mailer;
        if (!$mailer->update($request->all())) {
            Session::flash('message-error', __('messages.mailerEditedError'));
        } else {
            Session::flash('message-success', __('messages.mailerEdited'));
        }
        return redirect(route('mailer.index'));
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
        return redirect(route('mailer.index'));
    }

    public function addRemoveAuthor($user_id) {
        $mailer = auth()->user()->mailer;
        $authorsArr = explode(" ", $mailer->authors);
        $pos = array_search($user_id, $authorsArr);
        if ( $pos === false ) {
            //add author to mailer
            $mailer->authors = $mailer->authors ? $mailer->authors." ".$user_id : $user_id;
            $mailer->save();
            // return true as it was added
            return true;
        } else {
            // remove autor from mailer
            if ( count($authorsArr) == 1 ) {
                $mailer->authors = null;
            } else if ( $pos == count($authorsArr)-1 ) {
                $mailer->authors = str_replace(" ".$user_id, "", $mailer->authors);
            } else {
                $mailer->authors = str_replace($user_id." ", "", $mailer->authors);
            }
            $mailer->save();
            // return false as it was removed
            return false;
        }
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
}
