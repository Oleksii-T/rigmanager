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
Route::get('login/{social}',            'Auth\LoginController@redirectToProvider')->name('login.social');
Route::get('login/{social}/callback',   'Auth\LoginController@handleProviderCallback');

// home routes
Route::post('contacting',   'HomeController@contactUs')->name('contact.us');
Route::get('contact-us',      'HomeController@contacts')->name('contacts');

// user routes
Route::get('emailexists', 'UserController@emailExists')->name('email.exist');
Route::get('usernameexists', 'UserController@userNameExists')->name('username.exist');

Route::middleware(['auth', 'verified'])->group(function () {
    // posts routes
    Route::patch    ('posts/images/delete/{post}',          'PostController@imgsDel')       ->name('posts.imgs.delete');
    Route::patch    ('posts/images/delete/{post}/{image}',  'PostController@imgDel')        ->name('posts.img.delete');
    Route::get      ('ajax/category/{tagId}',               'PostController@getTagReadable')->name('get.readble.tag'); //Ajax reqeust
    Route::get      ('ajax/contacts/{postId}',              'PostController@getContacts')   ->name('get.contacts'); //Ajax reqeust
    Route::delete   ('ajax/posts/a/{post}',                 'PostController@destroyAjax')   ->name('posts.destroy.ajax'); //Ajax reqeust
    Route::get      ('ajax/posts/images/{post}',            'PostController@getImages')     ->name('get.images'); //Ajax reqeust
    Route::get      ('posts/store',                         'PostController@storeFake')     ->name('posts.store.fake');
    Route::post     ('posts/toggle/status/{post}',          'PostController@togglePost')    ->name('post.toggle'); //Ajax reqeust
    Route::get      ('posts/create/service',                'PostController@serviceCreate') ->name('service.create');
    Route::resource ('posts',                               'PostController')               ->except(['index']);
    
    // post filters routes
    Route::post('filter', 'FiltersController@filter')->name('post.filter');

    // prifile/user routes
    Route::get      ('profile/edit',            'UserController@edit')              ->name('profile.edit');
    Route::patch    ('profile/update',          'UserController@update')            ->name('profile.update');
    Route::get      ('profile/favourites',      'UserController@favourites')        ->name('profile.favourites');
    Route::get      ('profile/posts',           'UserController@userPosts')         ->name('profile.posts');
    Route::get      ('ajax/profile/favourite',  'UserController@addToFav')          ->name('toFav'); //Ajax reqeust
    Route::patch    ('profile/image/delete',    'UserController@userImageDelete')   ->name('profile.img.delete'); //Ajax reqeust
    Route::get      ('profile/subscription',    'UserController@subscription')      ->name('profile.subscription');

    // mailer routes
    Route::get      ('profile/mailer/edit',             'MailerController@edit')        ->name('mailer.edit');//removed default parametes
    Route::patch    ('profile/mailer/update',           'MailerController@update')      ->name('mailer.update');//removed default parametes
    Route::delete   ('profile/mailer/destroy',          'MailerController@destroy')     ->name('mailer.destroy');//removed default parametes
    Route::get      ('ajax/mailer/author/{author}',     'MailerController@toggleAuthor')->name('mailer.toggle.author');// Ajax request
    Route::get      ('ajax/mailer/toggle',              'MailerController@toggle')      ->name('mailer.toggle');// Ajax request
    Route::get      ('ajax/mailer/tag/{tag}',           'MailerController@addTag')      ->name('mailer.add.tag');// Ajax request
    Route::get      ('ajax/mailer/text/{text}',         'MailerController@addText')     ->name('mailer.add.text');// Ajax request
    Route::get      ('ajax/mailer/author/add/{author}', 'MailerController@addAuthor')   ->name('mailer.add.author');// Ajax request
    Route::resource ('profile/mailer',                  'MailerController')             ->except(['show', 'edit', 'update', 'destroy']); 


    /*== Folloing routes shall be for non-registered users on production stage ==*/

    // home routes
    Route::get('',          'HomeController@index')     ->name('home');
    Route::get('faq',       'HomeController@faq')       ->name('faq');
    Route::get('plans',     'HomeController@plans')     ->name('plans');
    Route::get('terms',     'HomeController@terms')     ->name('terms');
    Route::get('privacy',   'HomeController@privacy')   ->name('privacy');
    Route::get('sitemap',   'HomeController@sitemap')   ->name('site.map');

    // post routes

    // search routes
    Route::get('search/text',                   'SearchController@searchText')  ->name('search.text');
    Route::get('search/category/{category}',    'SearchController@searchTag')   ->name('search.tag');
    Route::get('search/author/{author}',        'SearchController@searchAuthor')->name('search.author');
});

Route::middleware('auth')->group(function () {
    Route::get      ('profile',         'UserController@index')->name('profile');
    Route::delete   ('profile/delete',  'UserController@destroy')->name('profile.delete');
});

Route::get('set-locale/{locale}', function ($locale) {
    App::setLocale($locale);
    session()->put('locale', $locale);
    $user = auth()->user();
    if ($user) {
        $user->language = $locale;
        $user->save();
    }
    return redirect()->back();
})->middleware('check.locale')->name('locale.setting');