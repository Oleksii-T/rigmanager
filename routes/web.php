<?php

use Illuminate\Support\Facades\Route;

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

// maintenance route
if (env('MAINTENANCE')) {
    Route::group(['middleware' => 'make.locale'], function() {
        Route::get('{any}', function() {
            return view('home.maintenance');
        })->where('any', '.*');
    });
}

// auth routes
Route::get          ('emailexists',                         'UserController@emailExists')       ->name('email.exist'); //Ajax reqeust
Route::get          ('usernameexists',                      'UserController@userNameExists')    ->name('username.exist'); //Ajax reqeust

//impoer file download
Route::get('download/posts-import', function() {
    $file = public_path().'/rigmanager-import.xlsx';
    return response()->download($file);
})->name('download.post.import');

Route::middleware('verified')->group(function () {

    // post routes
    Route::get      ('ajax/contacts/{postId}',              'PostController@getContacts')       ->name('get.contacts'); //Ajax reqeust
    Route::get      ('ajax/posts/images/{post}',            'PostController@getImages')         ->name('get.images'); //Ajax reqeust
    Route::patch    ('posts/images/delete/{post}',          'PostController@imgsDel')           ->name('posts.imgs.delete'); //Ajax reqeust
    Route::patch    ('posts/images/delete/{post}/{image}',  'PostController@imgDel')            ->name('posts.img.delete'); //Ajax reqeust
    Route::delete   ('ajax/posts/a//{post}',                'PostController@destroyAjax')       ->name('posts.destroy.ajax'); //Ajax reqeust
    Route::post     ('ajax/posts/toggle/status/{post}',     'PostController@togglePost')        ->name('post.toggle'); //Ajax reqeust

    // user routes
    Route::get      ('ajax/profile/favourite',              'UserController@addToFav')          ->name('toFav'); //Ajax reqeust
    Route::patch    ('profile/image/delete',                'UserController@userImageDelete')   ->name('profile.img.delete'); //Ajax reqeust
    Route::get      ('user/is_premium',                     'UserController@isPremium')         ->name('user.is.premium'); //Ajax reqeust

    // mailer routes
    Route::get      ('ajax/mailer/author/{author}',         'MailerController@toggleAuthor')    ->name('mailer.toggle.author');// Ajax request
    Route::get      ('ajax/mailer/toggle',                  'MailerController@toggle')          ->name('mailer.toggle');// Ajax request
    Route::post     ('ajax/mailer/create',                  'MailerController@createBySearchRequest')->name('mailer.create.by.search');// Ajax request
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
        return redirect($url);
    })->name('locale.setting');

    require base_path().'/routes/LocaledWebRoutes.php';
});

Route::group(['prefix' => '{locale?}', 'middleware' => 'make.locale'], function() {
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