<?php

namespace App\Http\Controllers;

use App\Mailer;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\CreateMailerRequest;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Traits\Tags;

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
        $types = [];
        $request->sell ? $types[]=1 : false;
        $request->buy ? $types[]=2 : false;
        $request->rent ? $types[]=3 : false;
        $input = $request->all();
        $input['types'] = json_encode($types);
        $mailer = new Mailer($input);
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
        $types = [];
        $request->sell ? $types[]=1 : false;
        $request->buy ? $types[]=2 : false;
        $request->rent ? $types[]=3 : false;
        $input = $request->all();
        $input['types'] = json_encode($types);
        if ( !$mailer->update($input) ) {
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
        if (!$mailer) {
            $mailer = new Mailer;
            $mailer->tags_encoded = $tagId;
            auth()->user()->mailer()->save($mailer);
            return true;
        }
        if (!$mailer->tags_encoded) {
            $mailer->tags_encoded = $tagId;
            $mailer->save();
            return true;
        }
        $tagsArr = $mailer->tags_encoded;
        if ( !array_key_exists($tagId, $mailer->tags_map) ) {
            $tagsArr[] = $tagId;
            $mailer->tags_encoded = $tagsArr;
            $mailer->save();
            return true;
        }
        return false;
    }

    public function addText($string) 
    {
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
            $mailer->keywords = $string;
            auth()->user()->mailer()->save($mailer);
        }
        return true;
    }

    public function toggleAuthor($user_id)
    {
        if (!$this->addAuthor($user_id)) {
            $mailer = auth()->user()->mailer;
            $authorsArr = $mailer->authors_encoded;
            $pos = array_search($user_id, $authorsArr);
            unset($authorsArr[$pos]);
            $mailer->authors_encoded = $authorsArr;
            $mailer->save();
            return false;
        }
        return true;
    }

    public function addAuthor($user_id) 
    {
        $mailer = auth()->user()->mailer;
        if (!$mailer) {
            $mailer = new Mailer;
            $mailer->authors_encoded = $user_id;
            auth()->user()->mailer()->save($mailer);
            return 1;
        }
        if (!$mailer->authors_encoded) {
            $mailer->authors_encoded = $user_id;
            $mailer->save();
            return 1;
        }
        $authorsArr = $mailer->authors_encoded;
        if ( count($authorsArr) == 10 ) {
            return -1;
        }
        if ( array_search($user_id, $authorsArr) === false ) {
            $authorsArr[] = $user_id;
            $mailer->authors_encoded = $authorsArr; 
            $mailer->save();
            return 1;
        }
        return 0;
    } 
}
