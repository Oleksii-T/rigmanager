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
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PostsImport;

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

        //make lifetime and active_to columns
        switch ($input['lifetime']) {
            case '1':
                $input['active_to'] = Carbon::now()->addMonth()->toDateString();
            break;
            case '2':
                $input['active_to'] = Carbon::now()->addMonths(2)->toDateString();
            break;
            case '3':
                //add check for premium user status
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

    public function import() {
        return view('post.import');
    }

    public function importStore(Request $request) {
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
            //if title is empty cosider this row as last one and finish analizing
            if ($value[1] == null) {
                $lastRow = $key;
                break;
            } 
            $importError = $this->vaidateExcelRow($key, $value); // validate the row
            //if error detected dinish analizing and return an error message
            if ($importError!='') {
                Session::flash('message-error', __('messages.postImportError'));
                Session::flash('import-error', $importError);
                return redirect(loc_url(route('post.import')));
            }
        }
        $import = array_slice($import, 0, $lastRow); // remove empty rows from import file
        $translate = new TranslateClient(['key' => env('GCP_KEY')]); //create google translation object
        $lang = $translate->detectLanguage( $import[0][1] . '. ' . $import[0][2] )['languageCode']; // merge title and description and find out the origin language
        // for each row create the post and save it 
        foreach ($import as $key => $row) {
            $cost = $this->costValidate($row[12]); // transform the cost
            //unset the currency if cost is omited
            if (!$cost) {
                $currency = null;
            }
            //unset the company if not a business choosed
            if ($row[6] != 2) {
                $row[4] = null;
            }
            $translations = ['title' => [], 'description' => []]; // make empty array of user translations
            $viber = $row[18] ? 1 : 0; // fill the viber value
            $telegram = $row[19] ? 1 : 0; // fill the telegram value
            $whatsapp = $row[20] ? 1 : 0; // fill the whatsapp value
            //make lifetime
            switch ($row[21]) {
                case '1':
                    $lifetime = Carbon::now()->addMonth()->toDateString();
                break;
                case '2':
                    $lifetime = Carbon::now()->addMonths(2)->toDateString();
                break;
                case '3':
                    $lifetime = null;
                    break;
                default:
                    break;
            }
            // genarate the new Post record
            $post = new Post([
                'origin_lang' => $lang,
                'user_translations' => $translations,
                'title' => $row[1],
                'description' => $row[2],
                'thread' => $row[3],
                'company' => $row[4],
                'type' => $row[5],
                'role' => $row[6],
                'condition' => $row[7],
                'tag_encoded' => $row[8],
                'manufacturer' => $row[9],
                'manufactured_date' => $row[10],
                'part_number' => $row[11],
                'cost' => $row[12],
                'currency' => $row[13],
                'region_encoded' => $row[14],
                'town' => $row[15],
                'user_email' => $row[16],
                'user_phone_raw' => $row[17],
                'viber' => $viber,
                'telegram' => $telegram,
                'whatsapp' => $whatsapp,
                'lifetime' => $lifetime,
            ]);
            auth()->user()->posts()->save($post); // save post with respect to user
            TranslatePost::dispatch($post, ['title'=>$row[1], 'description'=>$row[2], 'origin_lang'=>$lang], true)->onQueue('translation'); // dispatch the translation of post
        }
        Session::flash('message-success', __('messages.postImportSuccess'));
        return redirect(loc_url(route('home')));
    }

    private function vaidateExcelRow ($key, $row) {
        //chgeck for requiered field
        if ($row[1]!==null && $row[2]!==null && $row[3]!==null && $row[5]!==null && $row[6]!==null && $row[7]!==null && $row[8]!==null && ( $row[16]!==null || $row[17]!==null) && $row[21]!==null ) {
            //validate "Equipment/service" field
            if ($row[3]==1 || $row[3]==2) {
                //validate "type" field
                if ($row[5]==1 || $row[5]==2 || $row[5]==3 || $row[5]==4 || $row[5]==5 || $row[5]==6) {
                    //validate "Private/Business" field
                    if ($row[6]==1 || $row[6]==2) {
                        //validate "Condition" field
                        if ($row[7]==2 || $row[7]==3 || $row[7]==4) {
                            //validate  "Tag" field
                            if ($this->tagExist($row[8])) {
                                // validate is tag is respect the "equipment/service" field
                                //validate  "Currency" field
                                if ($row[13]=='UAH' || $row[13]=='USD' || $row[13]==null) {
                                    //validate  "region" field
                                    if ($row[14]==0 || $row[14]==1 || $row[14]==2 || $row[14]==3 || $row[14]==4 || $row[14]==5 || $row[14]==6 || $row[14]==7 || $row[14]==8 || $row[14]==9 || $row[14]==10 || $row[14]==11 || $row[14]==12 || $row[14]==13 || $row[14]==14 || $row[14]==15 || $row[14]==16 || $row[14]==17 || $row[14]==18 || $row[14]==19 || $row[14]==20 || $row[14]==21 || $row[14]==22 || $row[14]==23 || $row[14]==24) {
                                        //validate  "lifetime" field
                                        if ($row[21]==1 || $row[21]==2 || $row[21]==3) {
                                            //add check for premium user status
                                            //validate  "title" field
                                            if (is_string($row[1]) && mb_strlen($row[1])>10 && mb_strlen($row[1])<70) {
                                                //validate  "description" field
                                                if (is_string($row[2]) && mb_strlen($row[2])>10 && mb_strlen($row[2])<9000) {
                                                    //validate  "company" field
                                                    if ($row[4]==null || ( is_string($row[4]) && mb_strlen($row[4])>5 && mb_strlen($row[4])<200 )) {
                                                        //validate  "manufacturer" field
                                                        if ($row[9]==null || ( is_string($row[9]) && mb_strlen($row[9])>5 && mb_strlen($row[9])<70) ) {
                                                            //validate  "manufactured date" field
                                                            if ($row[10]==null || ( is_string($row[10]) && mb_strlen($row[10])>5 && mb_strlen($row[10])<70 )) {
                                                                //validate  "part number" field
                                                                if ($row[11]==null || ( is_string($row[11]) && mb_strlen($row[11])>3 && mb_strlen($row[11])<70 )) {
                                                                    //validate  "cost" field
                                                                    if ($this->costValidate($row[12])) {
                                                                        //validate  "Currency" field
                                                                        if ($row[13]!=null) {
                                                                            //validate  "town" field
                                                                            if (is_string($row[15]) && mb_strlen($row[15])<100) {
                                                                                //validate  "email" field
                                                                                if (is_string($row[16]) && mb_strlen($row[16])<254 && filter_var($row[16], FILTER_VALIDATE_EMAIL)) {
                                                                                    //validate  "phone" field
                                                                                    if ($row[17]==null || preg_match('/^0 \([0-9]{2}\) [0-9]{3} [0-9]{2} [0-9]{2}$/', $row[17])) {
                                                                                        return '';
                                                                                    } else {
                                                                                        return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importPhoneError');
                                                                                    }
                                                                                } else {
                                                                                    return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importEmailError');
                                                                                }
                                                                            } else {
                                                                                return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importTownError');
                                                                            }
                                                                        } else {
                                                                            return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importCurrencyMError');
                                                                        }
                                                                    } else {
                                                                        return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importCostError');
                                                                    }
                                                                } else {
                                                                    return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importPNError');
                                                                }
                                                            } else {
                                                                return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importManufDateError');
                                                            }
                                                        } else {
                                                            return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importManufError');
                                                        }
                                                    } else {
                                                        return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importCompanyError');
                                                    }
                                                } else {
                                                    return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importDescriptionError');
                                                }
                                            } else {
                                                return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importTitleError');
                                            }
                                        } else {
                                            return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importLifetimeError');
                                        }
                                    } else {
                                        return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importRegionError');
                                    }
                                } else {
                                    return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importCurrencyError');
                                }
                            } else {
                                return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importTagError');
                            }
                        } else {
                            return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importConditionError');
                        }
                    } else {
                        return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importRoleError');
                    }
                } else {
                    return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importTypeError');
                }
            } else {
                return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importThreadError');
            }
        } else {
            return __('ui.post') . ' #' . ($key+1) . '. ' . __('messages.importCompulsoryError');
        }
    }

    private function costValidate ($cost) {
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

}


