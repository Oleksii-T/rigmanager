<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['prefix' => 'admin/voyager'], function () {
    Voyager::routes();
});

if (env('APP_ENV') === 'production') {
    URL::forceScheme('https');
}

// maintenance route
if (env('MAINTENANCE')) {
    Route::group(['middleware' => 'make.locale'], function() {
        Route::get('{any}', function() {
            return view('home.maintenance');
        })->where('any', '.*');
    });
}

// auth routes
Route::get          ('ajax/emailexists',                         'UserController@emailExists')       ->name('email.exist'); //Ajax reqeust
Route::get          ('ajax/usernameexists',                      'UserController@userNameExists')    ->name('username.exist'); //Ajax reqeust

//import file download
Route::get('download/posts-import', function() {
    $file = public_path().'/rigmanager-import.xlsx';
    if (file_exists($file)) {
        return response()->download($file);
    }
    abort(404);
})->name('download.post.import');

//post`s document download
Route::get('download/post-document/{post}', function($post) {
    $file = public_path().'/storage/'.App\Post::findOrFail($post)->doc;
    if (file_exists($file)) {
        return response()->download($file);
    } else {
        dd($file);
    }
    abort(404);
})->name('download.post.doc');

//post views counter
Route::post('ajax/post/viewed','PostController@viewed')->name('post.viewed'); //Ajax reqeust

// mailer routes
Route::post     ('ajax/mailer/toggle/{mailer}',         'MailerController@toggle')          ->name('mailer.toggle');// Ajax request
Route::post     ('ajax/mailer/create',                  'MailerController@createBySearchRequest')->name('mailer.create.by.search');// Ajax request
Route::get      ('ajax/mailer/author/{author}',         'MailerController@createByAuthor')       ->name('mailer.create.by.author');// Ajax request

Route::middleware('verified')->group(function () {

    //admin routes
    Route::middleware('admin')->group(function () {
        Route::get('admin/overview', 'AdminController@index') ->name('admin.panel');
        Route::get('admin/user-access', 'AdminController@userAccess') ->name('admin.user-access');
        Route::get('admin/login-as', 'AdminController@loginAs') ->name('admin.login.as');
        Route::get('admin/mailers', 'AdminController@mailers') ->name('admin.mailers');
        Route::get('admin/graths', 'AdminController@graphs') ->name('admin.graphs');
        Route::get('admin/unverified-posts', 'AdminController@unverifiedPosts') ->name('admin.up');
        Route::get('admin/unverified-posts/history', 'AdminController@unverifiedPostsHistory') ->name('admin.uph');
        Route::get('admin/unverified-posts/verify/{post}', 'AdminController@verifyPost') ->name('admin.verify');
        Route::get('admin/post/edit/{post}/{user}', 'AdminController@editPost') ->name('admin.post.edit');
    });

    // user routes
    Route::get      ('ajax/profile/favourite',              'UserController@addToFav')          ->name('toFav'); //Ajax reqeust
    Route::patch    ('ajax/profile/image/delete',                'UserController@userImageDelete')   ->name('profile.img.delete'); //Ajax reqeust
    
    // post routes
    Route::post     ('ajax/posts/toggle/status/{post}',     'PostController@togglePost')        ->name('post.toggle'); //Ajax reqeust

    Route::middleware('plan.standart')->group(function () {
        // post routes
        Route::get      ('ajax/contacts/{postId}',              'PostController@getContacts')       ->name('get.contacts'); //Ajax reqeust
        Route::get      ('ajax/posts/images/{post}',            'PostController@getImages')         ->name('get.images'); //Ajax reqeust
        Route::patch    ('ajax/posts/images/delete/{post}',          'PostController@imgsDel')           ->name('posts.imgs.delete'); //Ajax reqeust
        Route::patch    ('ajax/posts/images/delete/{post}/{image}',  'PostController@imgDel')            ->name('posts.img.delete'); //Ajax reqeust
    });
});

Route::group(['middleware' => 'make.locale'], function() {
    Route::get('set-locale/{lang}', function ($newLocale) {
        $user = auth()->user();
        if ($user) {
            $user->language = $newLocale;
            $user->save();
        }
        $url = url()->previous();
        $base = route('home');
        $url = str_replace($base, "", $url);
        $url = $base . '/' . $newLocale . $url;
        if( substr($url, -1)=='/' ){
            $url = substr($url, 0, -1);
        }
        return redirect($url);
    })->name('locale.setting');

    require base_path().'/routes/LocaledWebRoutes.php';
});

Route::group(['prefix' => '{locale?}', 'middleware' => ['make.locale', 'check.locale']], function() {
    Route::get('set-locale/{lang}', function ($oldLocale, $newLocale) {
        $user = auth()->user();
        if ($user) {
            $user->language = $newLocale;
            $user->save();
        }
        $url = url()->previous();
        $base = route('home');
        $url = str_replace($base, "", $url); //remove url base
        $url = substr($url, 3);// remove locale of url
        if ($newLocale == 'uk') {
            $url = $base . $url;
        } else {
            $url = $base . '/' . $newLocale . $url;
        }
        return redirect($url);
    })->name('locale.setting');

    require base_path().'/routes/LocaledWebRoutes.php';
});