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

Auth::routes(['verify' => true]);

Route::get('login/{social}', 'Auth\LoginController@redirectToProvider')->name('login.social');
Route::get('login/{social}/callback', 'Auth\LoginController@handleProviderCallback');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('posts', 'PostController');
    Route::get('profile/favPosts', 'UserController@favPosts')->name('favPosts');
    Route::get('profile/myPosts', 'UserController@myPosts')->name('myPosts');
    Route::get('profile/favourite', 'UserController@addToFav')->name('toFav');
    Route::patch('profile/image/delete', 'userController@userImageDelete')->name('profile.img.delete');
    Route::get('posts/create', 'PostController@create')->name('posts.create');
    Route::patch('posts/images/delete/{post}', 'PostController@imgsDel')->name('post.imgs.delete');
    Route::patch('profile/update', 'UserController@update')->name('profile.update');
    Route::get('profile/edit', 'UserController@edit')->name('profile.edit');
    Route::get('category/{tagId}', 'PostController@getTagPathAsString')->name('get.readble.tag');

    /* Folloing routes shall be for non-registered users on production stage */
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('about', 'HomeController@about')->name('about');
    Route::get('emailexists', 'UserController@emailExists')->name('email.exist');
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