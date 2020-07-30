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

// general auth routes
Auth::routes(['verify' => true]);
// Laravel Socialite auth routes
Route::get('login/{social}', 'Auth\LoginController@redirectToProvider')->name('login.social');
Route::get('login/{social}/callback', 'Auth\LoginController@handleProviderCallback');

Route::middleware(['auth', 'verified'])->group(function () {
    // posts routes
    Route::resource('posts', 'PostController')->except(['index']);
    Route::patch('posts/images/delete/{post}', 'PostController@imgsDel')->name('posts.imgs.delete');
    Route::get('category/{tagId}', 'PostController@getTagPathAsString')->name('get.readble.tag'); //Ajax reqeust
    
    // prifile/user routes
    Route::get('profile/edit', 'UserController@edit')->name('profile.edit');
    Route::patch('profile/update', 'UserController@update')->name('profile.update');
    Route::get('profile/favPosts', 'UserController@favPosts')->name('favPosts');
    Route::get('profile/myPosts', 'UserController@myPosts')->name('myPosts');
    Route::get('profile/favourite', 'UserController@addToFav')->name('toFav'); //Ajax reqeust
    Route::patch('profile/image/delete', 'userController@userImageDelete')->name('profile.img.delete');
    Route::get('profile/subscription', 'UserController@subscription')->name('profile.subscription');

    // mailer routes
    Route::resource('mailer', 'MailerController')->except(['show', 'edit', 'update', 'destroy']); 
    Route::get('mailer/edit', 'MailerController@edit')->name('mailer.edit');//remove default parametes
    Route::patch('mailer/update', 'MailerController@update')->name('mailer.update');//remove default parametes
    Route::delete('mailer/destroy', 'MailerController@destroy')->name('mailer.destroy');//remove default parametes
    Route::get('mailer/author/{author}', 'MailerController@addRemoveAuthor')->name('mailer.add.remove.author');// Ajax request
    Route::get('mailer/toggle', 'MailerController@toggle')->name('mailer.toggle');// Ajax request


    // Folloing routes shall be for non-registered users on production stage
    // home routes
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('faq', 'HomeController@faq')->name('faq');
    Route::get('plans', 'HomeController@plans')->name('plans');
    Route::get('contants', 'HomeController@contacts')->name('contacts');
    Route::get('terms', 'HomeController@terms')->name('terms');
    Route::get('privacy', 'HomeController@privacy')->name('privacy');
    Route::get('sitemap', 'HomeController@sitemap')->name('site.map');
    // user routes
    Route::get('emailexists', 'UserController@emailExists')->name('email.exist');
    // post routes
    Route::get('search', 'PostController@search')->name('search');
    Route::get('search/category/{category}', 'PostController@searchTag')->name('searchTag');
    Route::get('search/author/{author}', 'PostController@searchAuthor')->name('searchAuthor');
});

Route::middleware('auth')->group(function () {
    Route::get('profile', 'UserController@index')->name('profile');
    Route::delete('profile/delete', 'UserController@destroy')->name('profile.delete');
});

Route::get('set-locale/{locale}', function ($locale) {
    App::setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->middleware('check.locale')->name('locale.setting');