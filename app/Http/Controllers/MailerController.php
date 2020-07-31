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
        if ($mailer) {
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
        } else {
            $mailer = new Mailer;
            $mailer->authors = $user_id;
            auth()->user()->mailer()->save($mailer);
            return true;
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

    public function addTag($tagId) 
    {
        $mailer = auth()->user()->mailer;
        if ($mailer) {
            // Mailer exists
            if ($mailer->tags) {
                // Mailer have tags
                if ( array_key_exists($tagId, $mailer->tagsIdsAndNames) ) {
                    // This tag already in Mailer
                    return trans('messages.mailerTagExists');
                } else {
                    // Append tag to mailer
                    $mailer->tags = $mailer->tags." ".$tagId;
                    $mailer->save();
                    return trans('messages.mailerTagAdded');
                }
            } else {
                // Mailer have not no tags
                $mailer->tags = $tagId;
                $mailer->save();
                return trans('messages.mailerTagAdded');
            }
        } else {
            // Mailer absent. Create new Mailer
            $mailer = new Mailer;
            $mailer->tags = $tagId;
            auth()->user()->mailer()->save($mailer);
            return trans('messages.mailerCreatedWithTag');
        }
    }

    public function addText($string) 
    {
        $mailer = auth()->user()->mailer;
        if ($mailer) {
            // Mailer exists
            if ($mailer->keywords) {
                // Append text to mailer
                $mailer->keywords = $mailer->keywords."\n".$string;
                $mailer->save();
                return trans('messages.mailerTextAdded');
            } else {
                // Mailer have no text
                $mailer->keywords = $string;
                $mailer->save();
                return trans('messages.mailerTextAdded');
            }
        } else {
            // Mailer absent. Create new Mailer
            $mailer = new Mailer;
            $mailer->keywords = $string;
            auth()->user()->mailer()->save($mailer);
            return trans('messages.mailerCreatedWithText');
        }

    }

    public function addAuthor($author) 
    {
        $mailer = auth()->user()->mailer;
        if ($mailer) {
            // Mailer exists
            if ($mailer->authors) {
                // Mailer have authors
                if ( in_array($author, explode(" ", $mailer->authors)) ) {
                    // This author already in Mailer
                    return trans('messages.mailerAuthorExists');
                } else {
                    // Appent author to mailer
                    $mailer->authors = $mailer->authors." ".$author;
                    $mailer->save();
                    return trans('messages.mailerAuthorAdded');
                }
            } else {
                // Mailer have no authors
                $mailer->authors = $author;
                $mailer->save();
                return trans('messages.mailerAuthorAdded');
            }
        } else {
            // Mailer absent. Create new Mailer
            $mailer = new Mailer;
            $mailer->authors = $author;
            auth()->user()->mailer()->save($mailer);
            return trans('messages.mailerCreatedWithAuthor');
        }
    } 
}
