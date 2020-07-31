<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Post;
use App\User;
use App\Http\Controllers\Traits\ImageUploader;
use Illuminate\Support\Facades\Session;
use App\Tags;

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
        return view('post.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CreatePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        $post = new Post($request->all());
        if (!auth()->user()->posts()->save($post)) {
            Session::flash('message-error', __('messages.postUploadedError'));
            return redirect(route('home.home'));
        }
        if ($request->hasFile('images')) {
            $this->postImageUpload($request->file('images'), $post);
        }
        Session::flash('message-success', __('messages.postUploaded'));
        return redirect(route('home.home'));
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
        $tagsArray = $this->getTagNameByIdWithPath($post->tag);
        return view('post.show', compact('post', 'tagsArray'));
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
        $tagReadble = $this->getTagPathAsString($post->tag);
        return view('post.edit', compact('post', 'tagReadble'));
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
        if ( $request->hasFile('images')) {
            $imagesAmount = count($request->file('images')) + $post->images->count();
            if ($imagesAmount > 5) {
                Session::flash('tooManyImagesError', __('messages.postEditedErrorTooManyImages'));
                return redirect()->back();
            }
        }
        $input = $request->all();
        $input['viber'] = $request->viber ? 1 : 0;
        $input['telegram'] = $request->telegram ? 1 : 0;
        $input['whatsapp'] = $request->whatsapp ? 1 : 0;
        if (!$post->update($input)) {
            Session::flash('message-error', __('messages.postEditedError'));
            return redirect(route('home.home'));
        }
        if ( $request->hasFile('images')) {
            $this->postImageUpload($request->file('images'), $post);
        }
        Session::flash('message-success', __('messages.postEdited'));
        return redirect(route('posts.show', $id));
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
        $this->postImagesDelete($post);
        $post->delete();
        Session::flash('message-success', __('messages.postDeleted'));
        return redirect(route('myPosts'));
    }

    public function imgsDel($id)
    {
        $post = Post::findOrFail($id);
        $this->postImagesDelete($post);
        Session::flash('message-success', __('messages.postEdited'));
        return $this->show($post->id);
    }

}


