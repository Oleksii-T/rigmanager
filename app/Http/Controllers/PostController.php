<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\ImageUploader;
use App\Http\Controllers\Traits\Subscription;
use Google\Cloud\Translate\TranslateClient;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Traits\Tags;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\App;
use App\Http\Requests\PostRequest;
use App\Jobs\MailersAnalizePost;
use Illuminate\Http\Request;
use App\Imports\PostsImport;
use Illuminate\Support\Str;
use App\Jobs\TranslatePost;
use Carbon\Carbon;
use App\Post;
use App\User;

class PostController extends Controller
{
    use ImageUploader, Tags, Subscription;

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
     * @param  App\Http\Requests\PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        //check for maximum posts
        $max = $this->isPremiumPlus() ? 500 : 200;
        if (auth()->user()->posts->count() >= $max) {
            if ($request->wantsJson()) {
                return abort(111, __('messages.tooManyPostsError'));
            }
            Session::flash('message-error', __('messages.tooManyPostsError'));
            return back()->withInput();
        }

        $input = $request->all();

        //check for max urgent posts
        if ( isset($input['is_urgent']) ) {
            $max = $this->isPremiumPlus() ? 300 : 100;
            if (auth()->user()->posts()->where('is_urgent', 1)->get()->count() >= $max) {
                if ($request->wantsJson()) {
                    return abort(111, __('messages.tooManyUrgentPostsError'));
                }
                Session::flash('message-error', __('messages.tooManyUrgentPostsError'));
                return back()->withInput();
            }
        }

        if ( !$input['cost'] ) {
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
        if ($input['origin_lang'] != 'ru' && $input['origin_lang'] != 'en' && $input['origin_lang'] != 'uk') {
            $input['origin_lang'] = 'ru';
        }

        $post = new Post($input);
        if (!auth()->user()->posts()->save($post)) {
            if ($request->wantsJson()) {
                return abort(111, __('messages.postUploadedError'));
            }
            Session::flash('message-error', __('messages.postUploadedError'));
            return back()->withInput();
        }
        if ($request->hasFile('images')) {
            $this->postImageUpload($request->file('images'), $post);
        }
        MailersAnalizePost::dispatch($post, auth()->user()->id)->onQueue('mailer');
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
    public function show($locale, $urlName=null)
    {
        $urlName = $urlName==null ? $locale : $urlName;
        $post = Post::where('url_name', $urlName)->first();
        if (!$post) {
            abort(404);
        }
        if (!$post->is_active && !$this->isOwner($post->user->id)) {
            return view('post.inactive');
        }
        $translated = [];
        if ( App::getLocale() != $post->origin_lang ) {
            $translated['title'] = 'title_'.App::getLocale();
            $translated['description'] = 'description_'.App::getLocale();
        }
        if (auth()->check()) {
            $premium = $this->isPremium();
        } else {
            $premium = false;
        }
        return view('post.show', compact('post', 'translated', 'premium'));
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
            $max = $this->isPremiumPlus() ? 300 : 100;
            if ( !$post->is_urgent && auth()->user()->posts()->where('is_urgent', 1)->get()->count() >= $max) {
                if ($request->wantsJson()) {
                    return abort(111, __('messages.tooManyUrgentPostsError'));
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
        if ($input['lifetime_changed']) {
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
        if ($input['origin_lang'] != 'ru' && $input['origin_lang'] != 'en' && $input['origin_lang'] != 'uk') {
            $input['origin_lang'] = 'ru';
        }

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

        //add negative is_verified value
        $input['is_verified'] = false;

        // if there was an error while updating, return previous page with error
        if (!$post->update($input)) {
            if ($request->wantsJson()) {
                return abort(111, __('messages.postUploadedError'));
            }
            Session::flash('message-error', __('messages.postEditedError'));
            return back()->withInput();
        }

        // if there is images submited, upload them
        if ( $request->hasFile('images')) {
            $this->postImageUpload($request->file('images'), $post);
        }

        TranslatePost::dispatch($post, $input, false)->onQueue('translation');
        Session::flash('message-success', __('messages.postEdited'));
        return redirect(loc_url(route('profile.posts')));
    }

    public function updateFake()
    {
        Session::flash('message-success', __('messages.postEdited'));
        return redirect(loc_url(route('profile.posts')));
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
        if ($this->isSubscribed()) {
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
        $post = Post::findOrFail($postId);
        if ($this->isOwner($post->user->id)) {
            if ( $post->is_active ) {
                //disactivate post
                $post->is_active = false;
                $post->save();
                return json_encode(0);
            } else {
                if ( $post->active_to < Carbon::now() ) {
                    // the post is outdated
                    return json_encode(-1);
                }
                //activate post
                $post->is_active = true;
                $post->save();
                return json_encode(1);
            }
        }
        abort(403);
    }

    public function import() 
    {
        return view('post.import');
    }

    public function importStore(Request $request) 
    {
        //check for xlsx file
        if (strtolower($request->file('import-file')->getClientOriginalExtension()) != 'xlsx') {
            Session::flash('message-error', __('messages.postImportError'));
            Session::flash('import-error', __('messages.importExtError'));
            return redirect(loc_url(route('post.import')));
        }
        $import = Excel::toArray(new PostsImport, $request->file('import-file'));
        //check the structure
        if (count($import[0]) < 502 || count($import[0][0]) < 22) {
            Session::flash('message-error', __('messages.postImportError'));
            Session::flash('import-error', __('messages.importStructureError'));
            return redirect(loc_url(route('post.import')));
        }
        $import = array_slice($import[0], 2); // remove the header from import file
        $import = array_slice($import, 0, 500); // remove all but first 500 rows
        // check for empty file
        if ($import[0][1] == null) {
            Session::flash('message-error', __('messages.postImportError'));
            Session::flash('import-error', __('messages.importEmptyError'));
            return redirect(loc_url(route('post.import')));
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
                Session::flash('message-error', __('messages.postImportError'));
                Session::flash('import-error', $importError);
                return redirect(loc_url(route('post.import')));
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
            $viber = $row[19] ? 1 : 0; // fill the viber value
            $telegram = $row[20] ? 1 : 0; // fill the telegram value
            $whatsapp = $row[21] ? 1 : 0; // fill the whatsapp value
            $translations = ['title' => [], 'description' => []]; // make empty array of user translations
            //make lifetime
            switch ($row[22]) {
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
                'url_name' => $url_name,
                'title' => $row[1],
                'description' => $row[2],
                'thread' => $row[4],
                'type' => $row[6],
                'role' => $row[7],
                'condition' => $row[8],
                'tag_encoded' => $row[9],
                'region_encoded' => $row[15],
                'user_email' => $row[17],
                'user_phone_raw' => $row[18],
                'viber' => $viber,
                'telegram' => $telegram,
                'whatsapp' => $whatsapp,
                'lifetime' => $row[22],
                'active_to' => $activeTo,
                'user_translations' => $translations,
            ];
            if ($row[3]) {
                $input['amount'] = $row[3];
            }
            if ($row[7]==2 && $row[5]) {
                $input['company'] = $row[5];
            }
            if ($row[13]) {
                $input['cost'] = $row[13];
                $input['currency'] = $row[14];
            }
            if ($row[16]) {
                $input['town'] = $row[16];
            }
            if ($row[10]) {
                $input['manufacturer'] = $row[10];
            }
            if ($row[11]) {
                $input['manufactured_date'] = $row[11];
            }
            if ($row[12]) {
                $input['part_number'] = $row[12];
            }
            $post = new Post($input); // genarate the new Post record
            auth()->user()->posts()->save($post); // save post with respect to user
            TranslatePost::dispatch($post, ['title'=>$row[1], 'description'=>$row[2], 'origin_lang'=>$lang], true)->onQueue('translation'); // dispatch the translation of post
        }
        Session::flash('message-success', __('messages.postImportSuccess'));
        return redirect(loc_url(route('home')));
    }

    private function vaidateExcelRow ($key, $row) 
    {
        //check for requiered field
        if ($row[1]!==null && $row[2]!==null && $row[4]!==null && $row[6]!==null && $row[7]!==null && $row[8]!==null && $row[9]!==null && ( $row[17]!==null || $row[18]!==null) && $row[22]!==null ) {
            //validate "Equipment/service" field
            if ($row[4]==1 || $row[4]==2) {
                //validate "type" field
                if ($row[6]==1 || $row[6]==2 || $row[6]==3 || $row[6]==4 || $row[6]==5 || $row[6]==6) {
                    //validate "Private/Business" field
                    if ($row[7]==1 || $row[7]==2) {
                        //validate "Condition" field
                        if ($row[8]==2 || $row[8]==3 || $row[8]==4) {
                            //validate  "Tag" field
                            if ($this->tagExist($row[9])) {
                                // validate is tag is respect the "equipment/service" field
                                if (($row[4]==1 && $this->isEquipment($row[4])) || ($row[4]==2 && $this->isService($row[4]))) {
                                    //validate  "Currency" field
                                    if ($row[14]=='UAH' || $row[14]=='USD' || $row[14]==null) {
                                        //validate  "region" field
                                        if ($row[15]==0 || $row[15]==1 || $row[15]==2 || $row[15]==3 || $row[15]==4 || $row[15]==5 || $row[15]==6 || $row[15]==7 || $row[15]==8 || $row[15]==9 || $row[15]==10 || $row[15]==11 || $row[15]==12 || $row[15]==13 || $row[15]==14 || $row[15]==15 || $row[15]==16 || $row[15]==17 || $row[15]==18 || $row[15]==19 || $row[15]==20 || $row[15]==21 || $row[15]==22 || $row[15]==23 || $row[15]==24) {
                                            //validate  "lifetime" field (import is available only for Premium+ so no need to check for unlim lifetime)
                                            if ($row[22]==1 || $row[22]==2 || $row[22]==3) {
                                                //validate  "title" field
                                                if (is_string($row[1]) && mb_strlen($row[1])>10 && mb_strlen($row[1])<70) {
                                                    //validate  "description" field
                                                    if (is_string($row[2]) && mb_strlen($row[2])>10 && mb_strlen($row[2])<9000) {
                                                        //validate "amount" field (time consuming solution)
                                                        if ($row[3]==null || ( strlen($row[3]) < 10 && filter_var($row[3], FILTER_VALIDATE_INT) !== false )) {
                                                            //validate  "company" field
                                                            if ($row[5]==null || ( is_string($row[5]) && mb_strlen($row[5])>5 && mb_strlen($row[5])<200 )) {
                                                                //validate  "manufacturer" field
                                                                if ($row[10]==null || ( is_string($row[10]) && mb_strlen($row[10])>5 && mb_strlen($row[10])<70) ) {
                                                                    //validate  "manufactured date" field
                                                                    if ($row[11]==null || ( is_string($row[11]) && mb_strlen($row[11])>3 && mb_strlen($row[11])<70 )) {
                                                                        //validate  "part number" field
                                                                        if ($row[12]==null || ( is_string($row[12]) && mb_strlen($row[12])>3 && mb_strlen($row[12])<70 )) {
                                                                            //validate "cost" field
                                                                            if ($this->costValidate($row[13])) {
                                                                                //validate  "Currency" field if "Cost" is not empty
                                                                                if ( ($row[13]!=null && $row[14]!=null) || $row[13]==null ) {
                                                                                    //validate  "town" field
                                                                                    if ($row[16]==null || ( is_string($row[16]) && mb_strlen($row[16])<=100 )) {
                                                                                        //validate  "email" field
                                                                                        if (is_string($row[17]) && mb_strlen($row[17])<254 && filter_var($row[17], FILTER_VALIDATE_EMAIL)) {
                                                                                            //validate  "phone" field
                                                                                            if ($row[18]==null || preg_match('/^0 \([0-9]{2}\) [0-9]{3} [0-9]{2} [0-9]{2}$/', $row[18])) {
                                                                                                return '';
                                                                                            } else { return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importPhoneError'); }
                                                                                        } else { return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importEmailError'); }
                                                                                    } else { return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importTownError'); }
                                                                                } else { return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importCurrencyMError'); }
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
                                    } else { return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importCurrencyError');  }
                                } else { return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importTagEqualThredError'); }
                            } else { return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importTagError'); }
                        } else { return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importConditionError'); }
                    } else { return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importRoleError'); }
                } else { return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importTypeError'); }
            } else { return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importThreadError'); }
        } else { return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importCompulsoryError'); }
    }

    private function costValidate ($cost) 
    {
        if (!$cost) {
            return true;
        }
        $cost = preg_replace('/[^0-9.]+/', '', $cost);
        $occ = substr_count ($cost, '.');
        if ($occ!=0) {
            //remove all dots but one
            if ($occ != 1) {
                for ($i=1; $i < $occ; $i++) { 
                    $pos = strpos($cost, '.');
                    if ($pos !== false) {
                        $cost = substr_replace($cost, '', $pos, 1);
                    }
                }
            }
            //remove all coins but one
            $dot = strpos($cost, '.');
            $length = strlen ($cost);
            $diff = $length-$dot;
            if ($diff==1) {
                $cost = $cost . '00';
            } else if ($diff==2) {
                $cost = $cost . '0';
            } else if ($diff>3) {
                $cost = substr($cost, 0, -1*($diff-3));
            }
        }
        if (strlen($cost) > 0 && strlen($cost) < 100) {
            return $cost;
        } else {
            return false;
        }
    }

    private function isOwner($authorId) 
    {
        if (auth()->user()->id != $authorId) {
            return false;
        }
        return true;
    }

    public function deleteAll() 
    {
        $posts = auth()->user()->posts;
        foreach ($posts as $post) {
            $this->postImagesDelete($post);
            $post->delete();
        }
        return true;
    }

}


