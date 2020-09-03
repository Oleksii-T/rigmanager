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

    //TESTING PURPOSES ONLY
    Route::POST('example', 'HomeController@example')->name('example');

// general auth routes
Auth::routes(['verify' => true]);

// Laravel Socialite auth routes
Route::get('login/{social}', 'Auth\LoginController@redirectToProvider')->name('login.social');
Route::get('login/{social}/callback', 'Auth\LoginController@handleProviderCallback');

Route::post('contacting', 'HomeController@contactUs')->name('contact.us');
Route::get('contants', 'HomeController@contacts')->name('contacts');

Route::middleware(['auth', 'verified'])->group(function () {
    // posts routes
    Route::patch('posts/images/delete/{post}', 'PostController@imgsDel')->name('posts.imgs.delete');
    Route::patch('posts/images/delete/{post}/{image}', 'PostController@imgDel')->name('posts.img.delete');
    Route::get('category/{tagId}', 'PostController@getTagReadable')->name('get.readble.tag'); //Ajax reqeust
    Route::get('contacts/{postId}', 'PostController@getContacts')->name('get.contacts'); //Ajax reqeust
    Route::delete('posts/a/{post}', 'PostController@destroyAjax')->name('posts.destroy.ajax'); //Ajax reqeust
    Route::get('posts/images/{post}', 'PostController@getImages')->name('get.images'); //Ajax reqeust
    Route::get('posts/store', 'PostController@storeFake')->name('posts.store.fake');
    Route::resource('posts', 'PostController')->except(['index']);
    
    // post filters routes
    Route::post('posts/filter', 'FiltersController@filter')->name('post.filter');

    
    // prifile/user routes
    Route::get('profile/edit', 'UserController@edit')->name('profile.edit');
    Route::patch('profile/update', 'UserController@update')->name('profile.update');
    Route::get('profile/favourites', 'UserController@favourites')->name('profile.favourites');
    Route::get('profile/posts', 'UserController@userPosts')->name('profile.posts');
    Route::get('profile/favourite', 'UserController@addToFav')->name('toFav'); //Ajax reqeust
    Route::patch('profile/image/delete', 'userController@userImageDelete')->name('profile.img.delete');
    Route::get('profile/subscription', 'UserController@subscription')->name('profile.subscription');

    // mailer routes
    Route::get('mailer/edit', 'MailerController@edit')->name('mailer.edit');//remove default parametes
    Route::patch('mailer/update', 'MailerController@update')->name('mailer.update');//remove default parametes
    Route::delete('mailer/destroy', 'MailerController@destroy')->name('mailer.destroy');//remove default parametes
    Route::get('mailer/author/{author}', 'MailerController@toggleAuthor')->name('mailer.toggle.author');// Ajax request
    Route::get('mailer/toggle', 'MailerController@toggle')->name('mailer.toggle');// Ajax request
    Route::get('mailer/tag/{tag}', 'MailerController@addTag')->name('mailer.add.tag');// Ajax request
    Route::get('mailer/text/{text}', 'MailerController@addText')->name('mailer.add.text');// Ajax request
    Route::get('mailer/author/add/{author}', 'MailerController@addAuthor')->name('mailer.add.author');// Ajax request
    Route::resource('mailer', 'MailerController')->except(['show', 'edit', 'update', 'destroy']); 

    Route::get('void', function(){
        return true;
    })->name('void');


    /*== Folloing routes shall be for non-registered users on production stage ==*/

    // home routes
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('faq', 'HomeController@faq')->name('faq');
    Route::get('plans', 'HomeController@plans')->name('plans');
    Route::get('terms', 'HomeController@terms')->name('terms');
    Route::get('privacy', 'HomeController@privacy')->name('privacy');
    Route::get('sitemap', 'HomeController@sitemap')->name('site.map');

    // user routes
    Route::get('emailexists', 'UserController@emailExists')->name('email.exist');

    // post routes

    // search routes
    Route::get('search/text', 'SearchController@searchText')->name('search.text');
    Route::get('search/category/{category}', 'SearchController@searchTag')->name('search.tag');
    Route::get('search/author/{author}', 'SearchController@searchAuthor')->name('search.author');
});

Route::middleware('auth')->group(function () {
    Route::get('profile', 'UserController@index')->name('profile');
    Route::delete('profile/delete', 'UserController@destroy')->name('profile.delete');
});

Route::get('set-locale/{locale}', function ($locale) {
    App::setLocale($locale);
    session()->put('locale', $locale);
    $user = auth()->user();
    $user->language = $locale;
    $user->save();
    return redirect()->back();
})->middleware('check.locale')->name('locale.setting');