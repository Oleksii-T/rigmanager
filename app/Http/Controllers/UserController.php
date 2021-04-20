<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\ImageUploader;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Controllers\FiltersController;
use App\Http\Controllers\SearchController;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Traits\Tags;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\User;
use App\Post;

class UserController extends Controller
{
    use ImageUploader, Tags;

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
        if (auth()->user()->is_social) {
            unset($input['email']);
        }
        $input['viber'] = $request->viber ? 1 : 0;
        $input['telegram'] = $request->telegram ? 1 : 0;
        $input['whatsapp'] = $request->whatsapp ? 1 : 0;
        $input['url_name'] = transliteration($input['name'], User::all()->pluck('url_name')->toArray());
        $user = auth()->user();
        $user->update($input);
        Session::flash('message-success', __('messages.profileEdited'));
        return redirect(loc_url(route('profile')));
    }

    public function updatePass(UpdatePasswordRequest $request)
    {
        $input = $request->only('password');
        $user = auth()->user();
        if (!$user->is_social) {
                $input['password'] = Hash::make($input['password']);
                $user->update($input);
                Session::flash('message-success', __('messages.profileEdited'));
        }
        return redirect(loc_url(route('profile')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $user = auth()->user(); //remember user to be removed
        //remove all posts
        foreach ($user->posts as $post) {
            $this->postImagesDelete($post);
            $post->delete();
        }
        $this->userImageDelete(); //remove profile image
        //remove partner reference
        if ($user->partner) {
            $user->partner->delete();
        }
        //remove mailers of user
        foreach ($user->mailers as $mailer) {
            $mailer->delete();
        }
        // TODO - PARSE SUBSCRIPTION!
        auth()->logout(); //logout user
        $user->delete();
        Session::flash('message-success', __('messages.profileDeleted'));
        return redirect(loc_url(route('home')));
    }

    public function favourites(Request $request)
    {
        $searchValue = null;
        $query = auth()->user()->favPosts->reverse();
        if ( isset($request->all()['text']) ) {
            $searchValue = $request->all()['text'];
            $searched = Post::search($request->all()['text'])->get();
            $query = $query->intersect($searched);
        }
        $posts_list = $query->paginate(env('POSTS_PER_PAGE'));
        return view('profile.favourites', compact('posts_list', 'searchValue'));
    }

    public function userPosts(Request $request)
    {
        //{"1": {"name": "Administrator","times": 1,"last_date": "2021-03-25"},"17": {"name": "Андрій","times": 1,"last_date": "2021-03-18"},"178.150.243.67": {"name": "","times": 1,"last_date": "2021-03-15"},"188.163.22.186": {"name": "","times": 1,"last_date": "2021-03-10"},"79.110.134.219":{"name": "","times": 1,"last_date": "2021-03-03"},"159.224.182.233": {"name": "","times": 1,"last_date": "2021-04-09"},"194.183.168.234": {"name": "","times": 1,"last_date": "2021-03-11"}}
        $searchValue = null;
        $sort = null;
        $searchC = new SearchController;
        if ( isset($request->all()['tag']) ) {
            $tagId = $this->getIdByUrl($request->all()['tag']);
            $regex = str_replace('.', '\.', "^$tagId(.[0-9]+)*$"); //make regex from tag and escape regex '.' via '\'
        }
        if ( isset($request->all()['text']) ) {
            $searchValue = $request->all()['text'];
            $query = Post::search($request->all()['text'])->get()->where('user_id', auth()->id())->sortByDesc('created_at');
            if ( isset($request->all()['tag']) ) {
                $query = $query->filter(function ($post, $key) use ($regex) {
                    return preg_match('/'.$regex.'/', $post->tag_encoded);
                });
                $resByTag = $searchC->countResultByTags($query, $tagId);
            } else {
                $resByTag = $searchC->countResultByTags($query);
            }
        } else if ( isset($request->all()['tag']) ) {
            $query = Post::whereRaw("tag_encoded REGEXP '$regex'")->where('user_id', auth()->id())->orderBy('created_at', 'DESC'); //search appropriate for posts using raw where query
            $resByTag = $searchC->countResultByTags($query->get(), $tagId);
        } else {
            $query = auth()->user()->posts()->orderBy('created_at', 'desc');
            $resByTag = $searchC->countResultByTags($query->get());
        }
        if ( isset($request->all()['sort']) ) {
            if (!is_a($query, 'Illuminate\Database\Eloquent\Collection')) {
                $query = $query->get();
            }
            $sort = $request->all()['sort'];
            $filteC = new FiltersController;
            $query = $filteC->sorting($query, $request->all()['sort']);
        }
        $posts_list = $query->paginate(env('POSTS_PER_PAGE'));
        return view('profile.posts', compact('posts_list', 'searchValue', 'resByTag', 'sort'));
    }

    public function addToFav(Request $request)
    {
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
    public function emailExists(Request $request)
    {
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

    /**
     * Check is userName already taken or not
     *
     * @param  \Illuminate\Http\Request  $request
     * @return false email not available
     * @return true email is available
     */
    public function userNameExists(Request $request)
    {
        $name = $request->name;
        $user = User::where('name', $name)->get();
        if ( $user->isEmpty()) {
            return json_encode(true);
        }
        // if ignoring id is specified and it is match found user, return true
        if ( $request->ignoreId && $user[0]->id == $request->ignoreId ) {
            return json_encode(true);
        }
        return json_encode(false);
    }

    public function subscription()
    {
        $subscription = auth()->user()->subscription;
        return view('profile.subscription', compact('subscription'));
    }

    public function isPremium() 
    {
        return json_encode(true);
        if ($value=='3' && !auth()->user()->is_premium) {
            return json_encode(false);
        }
        return json_encode(true);
    }

}
