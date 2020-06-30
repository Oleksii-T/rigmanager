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

Route::get('/', 'HomeController@index')->name('home');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('posts', 'PostController');
    Route::get('profile/favPosts', 'UserController@favPosts')->name('favPosts');
    Route::get('profile/myPosts', 'UserController@myPosts')->name('myPosts');
    Route::get('profile/favourite', 'UserController@addToFav')->name('toFav');
    Route::get('posts/create', 'PostController@create')->name('posts.create');
    Route::patch('profile/update', 'UserController@update')->name('profile.update');
    Route::get('profile/edit', 'UserController@edit')->name('profile.edit');
});

Route::middleware('auth')->group(function () {
    Route::get('profile', 'UserController@index')->name('profile');
    Route::delete('profile/delete', 'UserController@destroy')->name('profile.delete');
});

Route::get('emailexists', 'UserController@emailExists')->name('email.exist');

Route::get('set-locale/{locale}', function ($locale) {
    App::setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->middleware('check.locale')->name('locale.setting');