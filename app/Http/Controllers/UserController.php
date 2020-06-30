<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Traits\ImageUploader;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\UpdateUserRequest;
use App\User;
use App\Post;

class UserController extends Controller
{
    use ImageUploader;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        return view('profile.index', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UpdateUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request)
    {
        if ($request->hasFile('ava')) {
            $this->userImageUpdate($request->file('ava')); 
        } 
        $input = $request->except('ava');
        $input['viber'] = $request->viber ? 1 : 0;
        $input['telegram'] = $request->telegram ? 1 : 0;
        $input['whatsapp'] = $request->whatsapp ? 1 : 0;
        if ($input['password']) {
            $input['password'] = Hash::make($input['password']);
        } else {
            unset($input['password']);
        }
        $user = auth()->user();
        $user->update($input);
        Session::flash('message-success', __('messages.profileEdited'));
        return redirect(route('profile')); // use redirect() to force page refresh
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        return view('/');
    }

    public function favPosts()
    {
        $posts_list = auth()->user()->favPosts->reverse()->paginate(env('POSTS_PER_PAGE'));
        return view('profile.favPosts', compact('posts_list'));
    }

    public function myPosts()
    {
        $posts_list = auth()->user()->posts()->orderBy('created_at', 'desc')->paginate(env('POSTS_PER_PAGE'));
        return view('profile.myPosts', compact('posts_list'));
    }

    public function addToFav(Request $request) {
        //dd($request->all());
        if ( !$post = Post::find($request->post_id)) {
            return false;
        }
        if ( auth()->user()->favPosts->where('id', $post->id)->isEmpty() ) {
            auth()->user()->favPosts()->attach($post->id);
            return true;
        }
        auth()->user()->favPosts()->detach($post->id);
        return true;
    }

    /**
     * Check is email already taken or not
     *
     * @param  \Illuminate\Http\Request  $request
     * @return false email not available
     * @return true email is available
     */
    public function emailExists(Request $request) {
        $email = $request->email;
        $user = User::where('email', $email)->get();
        if ( $user->isEmpty()) {
            return json_encode(true);
        } 
        // if ignoring id is specified and it is match found user, return true
        if ( $request->ignoreId && $user[0]->id == $request->ignoreId ) {
            return json_encode(true);
        }
        return json_encode(false);
    }
}
