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
use App\Jobs\TranslatePost;
use App\Http\Controllers\Traits\Tags;
use Google\Cloud\Translate\TranslateClient;
use Illuminate\Support\Facades\App;

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

        // make user_translation column
        $appLanguages = ['uk', 'ru', 'en'];
        $userTitleTranslations = [];
        $userDescTranslations = [];
        foreach ($appLanguages as $lang) {
            if ( array_key_exists($lang, $input['title_translate']) === false ) {
                $userTitleTranslations[] = $lang;
            }
            if ( array_key_exists($lang, $input['desc_translate']) === false ) {
                $userDescTranslations[] = $lang;
            }
        }
        $input['user_translations'] = ['title' => $userTitleTranslations, 'description' => $userDescTranslations];

        $translate = new TranslateClient(['key' => env('GCP_KEY')]); //create google translation object
        $input['origin_lang'] = $translate->detectLanguage( $input['title'] . '. ' . $input['description'] )['languageCode']; // merge title and description and find out the origin language

        $post = new Post($input);
        if (!auth()->user()->posts()->save($post)) {
            Session::flash('message-error', __('messages.postUploadedError'));
            return redirect(loc_url(route('home')));
        }
        if ($request->hasFile('images')) {
            $this->postImageUpload($request->file('images'), $post);
        }
        MailersAnalizePost::dispatch($post, auth()->user()->id)->onQueue('mailer');
        TranslatePost::dispatch($post, $input, true)->onQueue('translation');
        Session::flash('message-success', __('messages.postUploaded'));
        dd('uploading is done');
        return redirect(loc_url(route('home')));
    }

    public function storeFake()
    {
        Session::flash('message-success', __('messages.postUploaded'));
        return redirect(loc_url(route('home')));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($locale, $id=null)
    {
        $id = $id==null ? $locale : $id;
        $post = Post::findOrFail($id);
        if (!$post->is_active && $post->user != auth()->user()) {
            return view('post.inactive');
        }
        $translated = [];
        if ( App::getLocale() != $post->origin_lang ) {
            $translated['title'] = 'title_'.App::getLocale();
            $translated['description'] = 'description_'.App::getLocale();
        }
        return view('post.show', compact('post', 'translated'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($locale, $id=null)
    {
        $id = $id==null ? $locale : $id;
        $post = Post::findOrFail($id);
        if ($post->user != auth()->user()) {
            abort(403);
        }
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
        if ($post->thread == 1) {
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
    public function update(UpdatePostRequest $request, $locale, $id=null)
    {
        $id = $id==null ? $locale : $id;
        $post = Post::findOrFail($id);
        if ($post->user != auth()->user()) {
            abort(403);
        }

        // if there is a file, check for files amount. max 5
        if ( $request->hasFile('images')) {
            $imagesAmount = count($request->file('images')) + $post->images->count();
            if ($imagesAmount > 5) {
                Session::flash('tooManyImagesError', __('messages.postEditedErrorTooManyImages'));
                return redirect()->back();
            }
        }
        $input = $request->all();

        // parse messangers values. If no phone specified remove messangers
        if ( $input['user_phone_raw'] ) {
            $input['viber'] = $request->viber ? 1 : 0;
            $input['telegram'] = $request->telegram ? 1 : 0;
            $input['whatsapp'] = $request->whatsapp ? 1 : 0;
        } else {
            $input['viber'] = 0;
            $input['telegram'] = 0;
            $input['whatsapp'] = 0;
        }

        // make user_translation column
        $appLanguages = ['uk', 'ru', 'en'];
        $userTitleTranslations = [];
        $userDescTranslations = [];
        foreach ($appLanguages as $lang) {
            if ( array_key_exists($lang, $input['title_translate']) === false ) {
                $userTitleTranslations[] = $lang;
            }
            if ( array_key_exists($lang, $input['desc_translate']) === false ) {
                $userDescTranslations[] = $lang;
            }
        }
        $input['user_translations'] = ['title' => $userTitleTranslations, 'description' => $userDescTranslations];

        // check origin language
        $translate = new TranslateClient(['key' => env('GCP_KEY')]); //create google translation object
        $input['origin_lang'] = $translate->detectLanguage( $input['title'] . '. ' . $input['description'] )['languageCode']; // merge title and description and find out the origin language

        // if there is no cost specified, remove currency
        if ( !$input['cost'] ) {
            $input['currency'] = null;
            $input['cost'] = 0;
        }

        // save some old parameters of post
        $input['origin_lang_old'] = $post->origin_lang;
        $input['title_old'] = $post->title;
        $input['description_old'] = $post->description;
        $input['user_translations_old'] = $post->user_translations;

        // if there was an error while updating, return previous page with error
        if (!$post->update($input)) {
            Session::flash('message-error', __('messages.postEditedError'));
            return redirect(loc_url(route('home')));
        }

        // if there is images submited, upload them
        if ( $request->hasFile('images')) {
            $this->postImageUpload($request->file('images'), $post);
        }

        TranslatePost::dispatch($post, $input, false)->onQueue('translation');
        Session::flash('message-success', __('messages.postEdited'));
        return redirect(loc_url(route('posts.show', ['post'=>$id])));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale, $id=null)
    {
        $post = Post::findOrFail($id);
        $id = $id==null ? $locale : $id;
        if ($post->user == auth()->user()) {
            $this->postImagesDelete($post);
            $post->delete();
        }
        Session::flash('message-success', __('messages.postDeleted'));
        return redirect(loc_url(route('profile.posts')));
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
        //add check for subscription
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
        abort(403);
    }

}


