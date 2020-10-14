<?php

// general auth routes
Auth::routes(['verify' => true]);

Route::get('comming_soon', function() {
    return view('work_in_progress');
})->name('in.progress');

// home routes
Route::get('',          'HomeController@index')     ->name('home');
Route::get('faq',       'HomeController@faq')       ->name('faq');
Route::get('plans',     'HomeController@plans')     ->name('plans');
Route::get('terms',     'HomeController@terms')     ->name('terms');
Route::get('privacy',   'HomeController@privacy')   ->name('privacy');
Route::get('sitemap',   'HomeController@sitemap')   ->name('site.map');
Route::get  ('contact-us',      'HomeController@contacts')  ->name('contacts');
Route::post ('contacting',      'HomeController@contactUs') ->name('contact.us');

// search routes
Route::get('search/text',                   'SearchController@searchText')  ->name('search.text');
Route::get('search/category/{category}',    'SearchController@searchTag')   ->name('search.tag');
Route::get('search/author/{author}',        'SearchController@searchAuthor')->name('search.author');

// Laravel Socialite auth routes
Route::get('login/{social}',            'Auth\LoginController@redirectToProvider')->name('login.social');
Route::get('login/{social}/callback',   'Auth\LoginController@handleProviderCallback');

Route::middleware('auth')->group(function () {
    Route::get      ('profile',         'UserController@index')->name('profile');
    Route::delete   ('profile/delete',  'UserController@destroy')->name('profile.delete');
});

Route::middleware('verified')->group(function () {

    // posts routes
    Route::get      ('fake/store',                         'PostController@storeFake')     ->name('posts.store.fake');
    Route::get      ('posts/create/service',                'PostController@serviceCreate') ->name('service.create');
    Route::resource ('posts',                               'PostController')               ->except(['index', 'show']);
    
    // prifile/user routes
    Route::get      ('profile/edit',            'UserController@edit')              ->name('profile.edit');
    Route::get      ('profile/favourites',      'UserController@favourites')        ->name('profile.favourites');
    Route::get      ('profile/posts',           'UserController@userPosts')         ->name('profile.posts');
    Route::get      ('profile/subscription',    'UserController@subscription')      ->name('profile.subscription');
    Route::patch    ('profile/update',          'UserController@update')            ->name('profile.update');

    // mailer routes
    Route::patch    ('profile/mailer/update',           'MailerController@update')      ->name('mailer.update');
    Route::delete   ('profile/mailer/destroy',          'MailerController@destroy')     ->name('mailer.destroy');
    Route::get      ('profile/mailer/edit',             'MailerController@edit')        ->name('mailer.edit');
    Route::resource ('profile/mailer',                  'MailerController')             ->except(['show', 'edit', 'update', 'destroy']); 
});

// posts routes
Route::get          ('posts/{post}',                        'PostController@show')          ->name('posts.show');