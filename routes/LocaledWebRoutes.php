<?php

// general auth routes
Auth::routes(['verify' => true]);

// home routes
Route::get('home.html', function() {
    return redirect(loc_url(route('home')));
});
Route::get('index.html', function() {
    return redirect(loc_url(route('home')));
});
Route::get ('',                     'HomeController@index')     ->name('home');
Route::get ('faq',                  'HomeController@faq')       ->name('faq');
Route::get ('plans',                'HomeController@plans')     ->name('plans');
Route::get ('terms',                'HomeController@terms')     ->name('terms');
Route::get ('privacy',              'HomeController@privacy')   ->name('privacy');
Route::get ('sitemap',              'HomeController@sitemap')   ->name('site.map');
Route::get ('blog',                 'HomeController@blog')      ->name('blog');
Route::get ('about-us',             'HomeController@aboutUs')   ->name('about.us');
Route::get ('import-rules',         'HomeController@import')    ->name('import.rules');
Route::get ('contact-us',           'HomeController@contacts')  ->name('contacts');
Route::get ('catalog',              'HomeController@catalog')   ->name('catalog');
Route::post('contacting',           'HomeController@contactUs') ->name('contact.us');

//post route
Route::get ('list',           'SearchController@list')  ->name('list');

//subscription required
Route::get('plans/error', function() {
    return view('errors.subscription_required');
})->name('subscription.required');

// post filters routes
Route::post         ('filter',                              'FiltersController@filter')         ->name('post.filter'); //Ajax reqeust

// search routes
Route::get('search/',                       'SearchController@search')      ->name('search');       //search by text/author/type

// Laravel Socialite auth routes
Route::get('login/{social}',            'Auth\LoginController@redirectToProvider')->name('login.social');
Route::get('login/{social}/callback',   'Auth\LoginController@handleProviderCallback');

Route::middleware('auth')->group(function () {
    Route::get      ('profile',         'UserController@index')->name('profile');
    Route::delete   ('profile/delete',  'UserController@destroy')->name('profile.delete');
});

Route::middleware('verified')->group(function () {

    Route::middleware('admin')->group(function () {
        Route::get('admin/overview', 'AdminController@index') ->name('admin.panel');
        Route::get('admin/user-access', 'AdminController@userAccess') ->name('admin.user-access');
        Route::get('admin/login-as', 'AdminController@loginAs') ->name('admin.login.as');
        Route::get('admin/mailers', 'AdminController@mailers') ->name('admin.mailers');
        Route::get('admin/graths', 'AdminController@graphs') ->name('admin.graphs');
        Route::get('admin/unverified-posts', 'AdminController@unverifiedPosts') ->name('admin.unverified-posts');
    });

    //change subscriptiob routes
    Route::post('plans/change', 'SubscriptionController@update') ->name('plans.update');
    Route::get('plans/cancel', 'SubscriptionController@cancel') ->name('plans.cancel');
    
    //posts routes
    Route::delete   ('posts/delete-all',    'PostController@deleteAll')     ->name('posts.delete');

    // mailer routes
    Route::get      ('profile/mailer',          'MailerController@index')           ->name('mailer.index');
    Route::get      ('mailer/deactivate-all',   'MailerController@deactivateAll')   ->name('mailers.deactivate');
    Route::delete   ('mailer/delete-all',       'MailerController@deleteAll')       ->name('mailers.delete');
    Route::delete   ('profile/mailer/{mailer}', 'MailerController@destroy')         ->name('mailer.destroy');

    // profile/user routes
    Route::get      ('profile/edit',            'UserController@edit')              ->name('profile.edit');
    Route::get      ('profile/favourites',      'UserController@favourites')        ->name('profile.favourites');
    Route::get      ('profile/posts',           'UserController@userPosts')         ->name('profile.posts');
    Route::get      ('profile/subscription',    'UserController@subscription')      ->name('profile.subscription');
    Route::patch    ('profile/update',          'UserController@update')            ->name('profile.update');
    Route::patch    ('profile/update/pass',     'UserController@updatePass')        ->name('profile.update.pass');

    Route::middleware('plan.standart')->group(function () {
        //posts routes
        Route::get      ('posts/create/service','PostController@serviceCreate') ->name('service.create');
        Route::get      ('posts/create/tender', 'PostController@tenderCreate')  ->name('tender.create');
        Route::get      ('posts/{post}/edit/translations', 'PostController@editTranslations')  ->name('posts.trans.edit');
        Route::resource ('posts',               'PostController')               ->except(['index', 'show']);
        
        // mailer routes
        Route::resource ('profile/mailer',          'MailerController')                 ->except(['create', 'index', 'destroy']);
    });

    // posts import routes
    Route::middleware('plan.pro')->group(function () {
        Route::get      ('posts/create/import',  'PostController@import')        ->name('post.import');
        Route::post     ('posts/import/upload',  'PostController@importStore')   ->name('import.upload');
    });
});

// posts routes
Route::get          ('posts/{post}',                        'PostController@show')          ->name('posts.show');

//search of tags
require base_path().'/routes/TagsWebRoutes.php';
