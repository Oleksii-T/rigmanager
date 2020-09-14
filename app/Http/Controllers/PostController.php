<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Post;
use App\User;
use App\Http\Controllers\Traits\ImageUploader;
use Illuminate\Support\Facades\Session;
use App\Jobs\MailersAnalizePost;
use App\Http\Controllers\Traits\Tags;

class PostController extends Controller
{
    use ImageUploader, Tags;

    /**
     * Display a listing of the resource.
     * This method and appropriate route is implemented as 'home.home' route
     *
     * @return \Illuminate\Http\Response
     */
    //public function index() {}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        return view('post.equipment_create', compact('user'));
    }

    public function serviceCreate()
    {
        $user = auth()->user();
        return view('post.service_create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CreatePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        $input = $request->all();
        if ( !$input['cost'] ) {
            unset($input['currency']);
            unset($input['cost']);
        }
        if ( !$input['user_phone_raw'] ) {
            $input['viber'] = 0;
            $input['telegram'] = 0;
            $input['whatsapp'] = 0;
        }
        $post = new Post($input);
        if (!auth()->user()->posts()->save($post)) {
            Session::flash('message-error', __('messages.postUploadedError'));
            return redirect(route('home'));
        }
        if ($request->hasFile('images')) {
            $this->postImageUpload($request->file('images'), $post);
        }
        Session::flash('message-success', __('messages.postUploaded'));
        MailersAnalizePost::dispatch($post, auth()->user()->id)->onQueue('mailer');
        return redirect(route('home'));
    }
    
    public function storeFake()
    {
        Session::flash('message-success', __('messages.postUploaded'));
        return redirect(route('home'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        if (!$post->is_active && $post->user != auth()->user()) {
            return view('post.inactive');
        }
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        if ($post->thread == 1) {
            $images = false;
            if ( $post->images->isNotEmpty() ) {
                $images = array();
                foreach ($post->images()->where('version', 'origin')->get() as $image) {
                    $img['name'] = $image->name;
                    $img['size'] = $image->size_b;
                    $img['url'] = $image->url;
                    $img['id'] = $image->serial_no;
                    $images[] = $img;
                }
                $images = json_encode($images);
            }
            return view('post.equipment_edit', compact('post', 'images'));
        } else {
            return view('post.service_edit', compact('post', 'images'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        if ($post->thread == 1) {
            if ( $request->hasFile('images')) {
                $imagesAmount = count($request->file('images')) + $post->images->count();
                if ($imagesAmount > 5) {
                    Session::flash('tooManyImagesError', __('messages.postEditedErrorTooManyImages'));
                    return redirect()->back();
                }
            }
            $input = $request->all();
            if ( $input['user_phone_raw'] ) {
                $input['viber'] = $request->viber ? 1 : 0;
                $input['telegram'] = $request->telegram ? 1 : 0;
                $input['whatsapp'] = $request->whatsapp ? 1 : 0;
            } else {
                $input['viber'] = 0;
                $input['telegram'] = 0;
                $input['whatsapp'] = 0;
            }
            if ( !$input['cost'] ) {
                unset($input['currency']);
                unset($input['cost']);
            }
            if (!$post->update($input)) {
                Session::flash('message-error', __('messages.postEditedError'));
                return redirect(route('home'));
            }
            if ( $request->hasFile('images')) {
                $this->postImageUpload($request->file('images'), $post);
            }
            Session::flash('message-success', __('messages.postEdited'));
            return redirect(route('posts.show', $id));
        } else {
            Session::flash('message-success', __('messages.postEdited'));
            return redirect(route('posts.show', $id));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if ($post->user == auth()->user()) {
            $this->postImagesDelete($post);
            $post->delete();
        }
        Session::flash('message-success', __('messages.postDeleted'));
        return redirect(route('profile.posts'));
    }

    /**
     * Remove the specified resource from storage. Call via Ajax
     *
     * @param  int  $id
     * @return boolean
     */
    public function destroyAjax($id)
    {
        $post = Post::findOrFail($id);
        if ($post->user == auth()->user()) {
            $this->postImagesDelete($post);
            $post->delete();
            return true;
        }
        return false;
    }

    public function imgsDel($id)
    {
        $post = Post::findOrFail($id);
        if ($post->user == auth()->user()) {
            $this->postImagesDelete($post);
            return true;
        }
        return false;
    }

    public function imgDel($postId, $imgNo)
    {
        $post = Post::findOrFail($postId);
        if ($post->user == auth()->user()) {
            $this->postImageDelete($post, $imgNo);
            return true;
        }
        return false;
    }

    public function getContacts($postId) 
    {
        $post = Post::findOrFail($postId);
        $contacts['email'] = $post->user_email;
        $contacts['phone'] = $post->user_phone_intern;
        $contacts['viber'] = $post->viber;
        $contacts['telegram'] = $post->telegram;
        $contacts['whatsapp'] = $post->whatsapp;
        return json_encode($contacts);
    }

    public function getImages($postId) 
    {
        $post = Post::findOrFail($postId);
        if ($post->user == auth()->user()) {
            if ( $post->images->isNotEmpty() ) {
                $result = array();
                foreach ($post->images()->where('version', 'origin')->get() as $image) {
                    $img['name'] = $image->name;
                    $img['size'] = $image->size_b;
                    $img['url'] = $image->url;
                    $img['id'] = $image->serial_no;
                    $result[] = $img;
                }
                return json_encode($result);
            }
        }
        return false;
    }

    public function togglePost($postId) {
        $post = Post::findOrFail($postId);
        if ($post->user == auth()->user()) {
            if ( $post->is_active ) {
                //disactivate post
                $post->is_active = false;
                $post->save();
                return false;
            } else {
                //activate post
                $post->is_active = true;
                $post->save();
                return true;
            }
        }
        abort(500);
    }

}


