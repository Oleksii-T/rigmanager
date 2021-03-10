<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\ImageUploader;
use Google\Cloud\Translate\TranslateClient;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Traits\Tags;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\App;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use App\Imports\PostsImport;
use Illuminate\Support\Str;
use App\Jobs\TranslatePost;
use Carbon\Carbon;
use App\Post;
use App\User;

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

    public function tenderCreate() {
        $user = auth()->user();
        return view('post.tender_create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        //check for maximum posts
        $max = auth()->user()->is_pro ? 500 : 200;
        if (!auth()->user()->partner && auth()->user()->posts->count() >= $max) {
            if ($request->wantsJson()) {
                return abort(400, __('messages.tooManyPostsError'));
            }
            Session::flash('message-error', __('messages.tooManyPostsError'));
            return back()->withInput();
        }

        $input = $request->all();

        //check for max urgent posts
        if ( isset($input['is_urgent']) ) {
            $max = auth()->user()->is_pro ? 300 : 100;
            if (!auth()->user()->partner && auth()->user()->posts()->where('is_urgent', 1)->get()->count() >= $max) {
                if ($request->wantsJson()) {
                    return abort(400, __('messages.tooManyUrgentPostsError'));
                }
                Session::flash('message-error', __('messages.tooManyUrgentPostsError'));
                return back()->withInput();
            }
        }

        if ( array_key_exists('cost',$input) && !$input['cost'] ) {
            unset($input['currency']);
            unset($input['cost']);
        }

        if ( !$input['user_phone_raw'] ) {
            $input['viber'] = 0;
            $input['telegram'] = 0;
            $input['whatsapp'] = 0;
        }

        //craete the url name
        $input['url_name'] = transliteration($input['title'], Post::all()->pluck('url_name')->toArray());

        //make lifetime and active_to columns
        switch ($input['lifetime']) {
            case '1':
                $input['active_to'] = Carbon::now()->addMonth()->toDateString();
            break;
            case '2':
                $input['active_to'] = Carbon::now()->addMonths(2)->toDateString();
            break;
            case '3':
                $input['active_to'] = null;
                break;
            default:
                break;
        }

        // make user_translation column
        $appLanguages = ['uk', 'ru', 'en'];
        $userTitleTranslations = [];
        $userDescTranslations = [];
        /*
        foreach ($appLanguages as $lang) {
            if ( array_key_exists($lang, $input['title_translate']) === false ) {
                $userTitleTranslations[] = $lang;
            }
            if ( array_key_exists($lang, $input['desc_translate']) === false ) {
                $userDescTranslations[] = $lang;
            }
        }
        $input['user_translations'] = ['title' => $userTitleTranslations, 'description' => $userDescTranslations];
        */

        $translate = new TranslateClient(['key' => env('GCP_KEY')]); //create google translation object
        $input['origin_lang'] = $translate->detectLanguage( $input['title'] . '. ' . $input['description'] )['languageCode']; // merge title and description and find out the origin language
        if ($input['origin_lang'] != 'ru' && $input['origin_lang'] != 'en' && $input['origin_lang'] != 'uk') {
            $input['origin_lang'] = 'ru';
        }

        //save document
        if ($request->file('doc')) {
            $name = $request->file('doc')->getClientOriginalName();
            while(auth()->user()->posts()->where('doc', auth()->id().'/'.$name)->get()->isNotEmpty()) {
                $rand = mb_strtolower(Str::random(3));
                $name = substr_replace($name, '-'.$rand, strrpos($name, '.', -1), 0);
            }
            $input['doc'] = $request->file('doc')->storeAs(auth()->id(), $name);
        } 

        $post = new Post($input);
        if (!auth()->user()->posts()->save($post)) {
            if ($request->wantsJson()) {
                return abort(400, __('messages.postUploadedError'));
            }
            Session::flash('message-error', __('messages.postUploadedError'));
            return back()->withInput();
        }
        if ($request->hasFile('images')) {
            $this->postImageUpload($request->file('images'), $post);
        }
        TranslatePost::dispatch($post, $input, true)->onQueue('translation');
        Session::flash('message-success', __('messages.postUploaded'));
        return redirect(loc_url(route('profile.posts')));
    }

    public function storeFake()
    {
        Session::flash('message-success', __('messages.postUploaded'));
        return redirect(loc_url(route('profile.posts')));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $locale, $urlName=null)
    {
        $urlName = $urlName==null ? $locale : $urlName;
        $post = Post::where('url_name', $urlName)->first();
        if (!$post) {
            abort(404);
        }
        if (!$post->is_active && !$this->isOwner($post->user->id)) {
            return view('post.inactive', compact('post'));
        }
        $translated = [];
        if ( App::getLocale() != $post->origin_lang ) {
            $translated['title'] = 'title_'.App::getLocale();
            $translated['description'] = 'description_'.App::getLocale();
        }
        return view('post.show', compact('post'));
    }

    public function viewed(Request $request) {
        $post = Post::findOrFail($request->post_id);
        if ( !$this->isOwner($post->user_id) ) {
            $views = $post->views;
            if (auth()->check()) {
                $key = auth()->user()->id;
                $name = auth()->user()->name;
            } else {
                $key = $request->ip();
                $name = '';
            }
            if ( !$post->views || !array_key_exists($key,$views) ) {
                $views[$key] = [
                    'name' => $name,
                    'last_date' => Carbon::now()->format('Y-m-d'),
                    'times' => 1,
                ];
            } else {
                $views[$key]['last_date'] = Carbon::now()->format('Y-m-d');
                $views[$key]['times']++;
            }
            $post->views = $views;
            $post->save();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($locale, $urlName=null)
    {
        $urlName = $urlName==null ? $locale : $urlName;
        $post = Post::where('url_name', $urlName)->first();
        if (!$post) {
            abort(404);
        }
        if (!$this->isOwner($post->user->id)) {
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
            return view('post.equipment_create', compact('post', 'images'));
        } else if ($post->thread == 2) {
            return view('post.service_create', compact('post', 'images'));
        } else if ($post->thread == 3) {
            //TODO
            abort(404);
        }
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $locale, $id=null)
    {
        $id = $id==null ? $locale : $id;
        $post = Post::findOrFail($id);
        if (!$this->isOwner($post->user->id)) {
            abort(403);
        }
        
        $input = $request->all();

        //parse is_urgent
        if ( isset($input['is_urgent']) ) {
            $max = auth()->user()->is_pro ? 300 : 100;
            if (!auth()->user()->partner && !$post->is_urgent && auth()->user()->posts()->where('is_urgent', 1)->get()->count() >= $max) {
                if ($request->wantsJson()) {
                    return abort(400, __('messages.tooManyUrgentPostsError'));
                }
                Session::flash('message-error', __('messages.tooManyUrgentPostsError'));
                return back()->withInput();
            }
        } else {
            $input['is_urgent'] = false;
        }

        //re-create the url name if title was changed
        $input['url_name'] = 
            $post->title == $input['title']
            ? $post->url_name
            : transliteration($input['title'], Post::all()->pluck('url_name')->toArray());

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

        //make lifetime and active_to columns
        if ( array_key_exists('lifetime_changed', $input) ) {
            switch ($input['lifetime']) {
                case '1':
                    $input['active_to'] = Carbon::now()->addMonth()->toDateString();
                break;
                case '2':
                    $input['active_to'] = Carbon::now()->addMonths(2)->toDateString();
                break;
                case '3':
                    $input['active_to'] = null;
                    break;
                default:
                    break;
            }
        }

        // make user_translation column
        $appLanguages = ['uk', 'ru', 'en'];
        $userTitleTranslations = [];
        $userDescTranslations = [];
        /*
        foreach ($appLanguages as $lang) {
            if ( array_key_exists($lang, $input['title_translate']) === false ) {
                $userTitleTranslations[] = $lang;
            }
            if ( array_key_exists($lang, $input['desc_translate']) === false ) {
                $userDescTranslations[] = $lang;
            }
        }
        $input['user_translations'] = ['title' => $userTitleTranslations, 'description' => $userDescTranslations];
        */
        
        // check origin language
        $translate = new TranslateClient(['key' => env('GCP_KEY')]); //create google translation object
        $input['origin_lang'] = $translate->detectLanguage( $input['title'] . '. ' . $input['description'] )['languageCode']; // merge title and description and find out the origin language
        if ($input['origin_lang'] != 'ru' && $input['origin_lang'] != 'en' && $input['origin_lang'] != 'uk') {
            $input['origin_lang'] = 'ru';
        }

        // if there is no cost specified, remove currency
        if ( array_key_exists('cost',$input) && !$input['cost'] ) {
            $input['currency'] = null;
            $input['cost'] = 0;
        }

        // save some old parameters of post
        $input['origin_lang_old'] = $post->origin_lang;
        $input['title_old'] = $post->title;
        $input['description_old'] = $post->description;
        $input['user_translations_old'] = $post->user_translations;

        //add negative is_verified value
        $input['is_verified'] = false;

        //save document
        if ($request->file('doc')) {
            if ($post->doc) {
                //delete old doc
                $input['doc'] = null;
                Storage::delete($post->doc);
            }
            //uplaod new doc
            $name = $request->file('doc')->getClientOriginalName();
            while(auth()->user()->posts()->where('doc', auth()->id().'/'.$name)->get()->isNotEmpty()) {
                $rand = mb_strtolower(Str::random(3));
                $name = substr_replace($name, '-'.$rand, strrpos($name, '.', -1), 0);
            }
            $input['doc'] = $request->file('doc')->storeAs(auth()->id(), $name);
        } else if (isset($input['doc-deleted'])) {
            //delete old doc
            $input['doc'] = null;
            Storage::delete($post->doc);
        }

        // if there was an error while updating, return previous page with error
        if (!$post->update($input)) {
            if ($request->wantsJson()) {
                return abort(400, __('messages.postUploadedError'));
            }
            Session::flash('message-error', __('messages.postEditedError'));
            return back()->withInput();
        }

        // if there is images submited, upload them
        if ( $request->hasFile('images') ) {
            $this->postImageUpload($request->file('images'), $post);
        }

        TranslatePost::dispatch($post, $input, false)->onQueue('translation');
        if ($request->wantsJson()) {
            return true;
        }
        Session::flash('message-success', __('messages.postEdited'));
        return redirect(loc_url(route('profile.posts')));
    }

    public function updateFake()
    {
        Session::flash('message-success', __('messages.postEdited'));
        return redirect(loc_url(route('profile.posts')));
    }

    public function editTranslations($locale, $urlName=null) {
        $urlName = $urlName==null ? $locale : $urlName;
        $post = Post::where('url_name', $urlName)->first();
        if (!$post) {
            abort(404);
        }
        if (!$this->isOwner($post->user->id)) {
            abort(403);
        }
        return view('post.edit_translations', compact('post'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale, $id=null)
    {
        $id = $id==null ? $locale : $id;
        $post = Post::findOrFail($id);
        if ($this->isOwner($post->user->id)) {
            $this->postImagesDelete($post);
            if ($post->doc) {
                Storage::delete($post->doc);
            }
            $post->delete();
            Session::flash('message-success', __('messages.postDeleted'));
        }
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
        if ($this->isOwner($post->user->id)) {
            $this->postImagesDelete($post);
            if ($post->doc) {
                Storage::delete($post->doc);
            }
            $post->delete();
            return true;
        }
        return false;
    }

    public function imgsDel($id)
    {
        $post = Post::findOrFail($id);
        if ($this->isOwner($post->user->id)) {
            $this->postImagesDelete($post);
            return true;
        }
        return false;
    }

    public function imgDel($postId, $imgNo)
    {
        $post = Post::findOrFail($postId);
        if ($this->isOwner($post->user->id)) {
            $this->postImageDelete($post, $imgNo);
            return true;
        }
        return false;
    }

    public function getContacts($postId)
    {
        $post = Post::findOrFail($postId);
        if (auth()->user()->is_standart) {
            $contacts['email'] = $post->user_email;
            $contacts['phone'] = $post->user_phone_intern;
            $contacts['viber'] = $post->viber;
            $contacts['telegram'] = $post->telegram;
            $contacts['whatsapp'] = $post->whatsapp;
            return json_encode($contacts);
        } else {
            return json_encode(false);
        }
    }

    public function getImages($postId)
    {
        $post = Post::findOrFail($postId);
        if ($this->isOwner($post->user->id)) {
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

    public function togglePost($postId) 
    {
        // codes: Outdated(-3), Bag Plan(-2), Bad Auth(-1), Diactivated(0), Activated(1)
        $post = Post::findOrFail($postId);
        if (!$this->isOwner($post->user->id)) {
            return json_encode(-1);
        }
        //disactivate post
        if ( $post->is_active ) {
            $post->is_active = false;
            $post->save();
            return json_encode(0);
        } 
        // the post is outdated
        if ( $post->active_to < Carbon::now() ) {
            return json_encode(-3);
        }
        //if user not subscribed and tryes activate post
        if (!auth()->user()->is_standart) {
            return json_encode(-2);
        }
        //activate post
        $post->is_active = true;
        $post->save();
        return json_encode(1);
    }

    public function import() 
    {
        return view('post.import');
    }

    public function importStore(Request $request) 
    {
        if (!$request->hasFile('import-file')) {
            abort(400, __('messages.importFileRequireError'));
        }
        //check for xlsx file
        if (strtolower($request->file('import-file')->getClientOriginalExtension()) != 'xlsx') {
            abort(400, __('messages.importExtError'));
        }
        $import = Excel::toArray(new PostsImport, $request->file('import-file'));
        //check the structure
        if ( count($import[0][0]) < 17 ) {
            abort(400, __('messages.importStructureError'));
        }
        $import = array_slice($import[0], 2); // remove the header from import file
        $import = array_slice($import, 0, 500); // remove all but first 500 rows
        // check for empty file
        if ($import[0][1] == null) {
            abort(400, __('messages.importEmptyError'));
        }
        // for each row in import file validate the fields
        foreach ($import as $key => $value) {
            //if title is empty consider this row as last one and finish analizing
            if ($value[1] == null) {
                $lastRow = $key;
                break;
            }
            $importError = $this->vaidateExcelRow($key, $value); // validate the row
            //if error detected finish analizing and return an error message
            if ($importError!='') {
                abort(400, $importError);
            }
        }
        //there is not 500 rows, delete the empty ones
        if (isset($lastRow)) {
            $import = array_slice($import, 0, $lastRow);
        }
        //check for maximum posts not necessary cause the file was cut till 500 rows
        //make general orinal language
        $translate = new TranslateClient(['key' => env('GCP_KEY')]); //create google translation object
        $lang = $translate->detectLanguage( $import[0][1] . '. ' . $import[0][2] )['languageCode']; // merge title and description and find out the origin language
        if ($lang != 'ru' && $lang != 'en' && $lang != 'uk') {
            $lang = 'ru';
        }
        // for each row create the post and save it 
        foreach ($import as $key => $row) {
            $translations = ['title' => [], 'description' => []]; // make empty array of user translations
            //make lifetime
            switch ($row[17]) {
                case '1':
                    $activeTo = Carbon::now()->addMonth()->toDateString();
                break;
                case '2':
                    $activeTo = Carbon::now()->addMonths(2)->toDateString();
                break;
                case '3':
                    $activeTo = null;
                    break;
                default:
                    break;
            }
            // make url_name
            $url_name = transliteration($row[1], Post::all()->pluck('url_name')->toArray());
            $input = [
                'origin_lang' => $lang,
                'is_import' => (bool)$row[16],
                'url_name' => $url_name,
                'title' => $row[1],
                'description' => $row[2],
                'thread' => 1,
                'type' => $row[5],
                'role' => $row[6],
                'condition' => $row[7],
                'tag_encoded' => $row[8],
                'region_encoded' => $row[13],
                'user_email' => $row[14],
                'user_phone_raw' => $row[15],
                'lifetime' => $row[17],
                'active_to' => $activeTo,
                'user_translations' => $translations,
            ];
            if ($row[3]) {
                $input['amount'] = $row[3];
            }
            if ($row[6]==2 && $row[4]) {
                $input['company'] = $row[4];
            }
            if ($row[12]) {
                $input['cost'] = $this->costValidate($row[12])['cost'];
                $input['currency'] = $this->costValidate($row[12])['currency'];
            }
            if ($row[9]) {
                $input['manufacturer'] = $row[9];
            }
            if ($row[10]) {
                $input['manufactured_date'] = $row[10];
            }
            if ($row[11]) {
                $input['part_number'] = $row[11];
            }
            $post = new Post($input); // genarate the new Post record
            auth()->user()->posts()->save($post); // save post with respect to user
            TranslatePost::dispatch($post, ['title'=>$row[1], 'description'=>$row[2], 'origin_lang'=>$lang], true)->onQueue('translation'); // dispatch the translation of post
        }
        $firstT = $import[0][1];
        $lastT = $import[count($import)-1][1];
        $response = [
            'total'=>count($import),
            'first'=>$firstT,
            'last'=>$lastT
        ];
        return json_encode($response);
        //return redirect(loc_url(route('home')));
    }

    private function vaidateExcelRow ($key, $row) 
    {
        //check for requiered field
        if ($row[1]!==null && $row[2]!==null && $row[5]!==null && $row[6]!==null && $row[7]!==null && $row[8]!==null && ( $row[14]!==null || $row[15]!==null) && $row[17]!==null ) {
            //validate "type" field
            if ($row[5]==1 || $row[5]==2 || $row[5]==3 || $row[5]==4) {
                //validate "Private/Business" field
                if ($row[6]==1 || $row[6]==2) {
                    //validate "Condition" field
                    if ($row[7]==2 || $row[7]==3 || $row[7]==4) {
                        //validate  "Tag" field
                        if ($this->tagExist($row[8]) && $this->isEquipment($row[8])) {
                            //validate  "region" field
                            if ($row[13]==0 || $row[13]==1 || $row[13]==2 || $row[13]==3 || $row[13]==4 || $row[13]==5 || $row[13]==6 || $row[13]==7 || $row[13]==8 || $row[13]==9 || $row[13]==10 || $row[13]==11 || $row[13]==12 || $row[13]==13 || $row[13]==14 || $row[13]==15 || $row[13]==16 || $row[13]==17 || $row[13]==18 || $row[13]==19 || $row[13]==20 || $row[13]==21 || $row[13]==22 || $row[13]==23 || $row[13]==24 || $row[13]==30) {
                                //validate  "lifetime" field (import is available only for Premium+ so no need to check for unlim lifetime)
                                if ($row[17]==1 || $row[17]==2 || $row[17]==3) {
                                    //validate  "title" field
                                    if (is_string($row[1]) && mb_strlen($row[1])>10 && mb_strlen($row[1])<70) {
                                        //validate  "description" field
                                        if (is_string($row[2]) && mb_strlen($row[2])>10 && mb_strlen($row[2])<9000) {
                                            //validate "amount" field (time consuming solution)
                                            if ($row[3]==null || mb_strlen($row[3]) < 16) {
                                                //validate  "company" field
                                                if ($row[4]==null || ( is_string($row[4]) && mb_strlen($row[4])>5 && mb_strlen($row[4])<200 )) {
                                                    //validate  "manufacturer" field
                                                    if ($row[9]==null || ( is_string($row[9]) && mb_strlen($row[9])>2 && mb_strlen($row[9])<71) ) {
                                                        //validate  "manufactured date" field
                                                        if ($row[10]==null || ( is_string($row[10]) && mb_strlen($row[10])>2 && mb_strlen($row[10])<71 )) {
                                                            //validate  "part number" field
                                                            if ($row[11]==null || ( is_string($row[11]) && mb_strlen($row[11])>2 && mb_strlen($row[11])<71 )) {
                                                                //validate "cost" field
                                                                if ($this->costValidate($row[12])) {
                                                                    //validate  "email" field
                                                                    if (is_string($row[14]) && mb_strlen($row[14])<254 && filter_var($row[14], FILTER_VALIDATE_EMAIL)) {
                                                                        //validate  "phone" field
                                                                        if ($row[15]==null || preg_match('/^0 \([0-9]{2}\) [0-9]{3} [0-9]{2} [0-9]{2}$/', $row[15])) {
                                                                            return '';
                                                                        } else { return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importPhoneError'); }
                                                                    } else { return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importEmailError'); }
                                                                } else { return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importCostError'); }
                                                            } else { return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importPNError'); }
                                                        } else { return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importManufDateError'); }
                                                    } else { return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importManufError'); }
                                                } else { return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importCompanyError'); }
                                            } else { return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importAmountError'); }
                                        } else { return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importDescriptionError'); }
                                    } else { return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importTitleError'); }
                                } else { return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importLifetimeError'); }
                            } else { return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importRegionError'); }
                        } else { return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importTagError'); }
                    } else { return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importConditionError'); }
                } else { return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importRoleError'); }
            } else { return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importTypeError'); }
        } else { return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importCompulsoryError'); }
    }

    private function costValidate ($cost) 
    {
        if (!$cost) {
            return true;
        }
        $curr = substr($cost, -3);
        if ($curr != 'UAH' && $curr != 'USD') {
            return false;
        }
        $cost = preg_replace('/[^0-9.]+/', '', $cost);
        if (!$cost) {
            return false;
        }
        $cost = number_format($cost, 2, '.', ',');
        if (strlen($cost) < 16) {
            return ['cost'=>$cost, 'currency'=>$curr];
        } else {
            return false;
        }
    }

    private function isOwner($authorId) 
    {
        if (auth()->check() && auth()->user()->id == $authorId) {
            return true;
        }
        return false;
    }

    public function deleteAll() 
    {
        $posts = auth()->user()->posts;
        foreach ($posts as $post) {
            $this->postImagesDelete($post);
            $post->delete();
        }
        Session::flash('message-success', __('messages.allPostsDeleted'));
        return redirect(loc_url(route('profile.posts')));
    }

}
