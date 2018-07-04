<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
| Middleware options can be located in `app/Http/Kernel.php`
|
*/

// Homepage Route
Route::get('/', 'WelcomeController@welcome')->name('welcome');
Route::get('/api', 'API\ApiController@index');
// Authentication Routes
Auth::routes();

// Public Routes
Route::group(['middleware' => ['web', 'activity']], function () {

    // Activation Routes
    Route::get('/activate', ['as' => 'activate', 'uses' => 'Auth\ActivateController@initial']);

    Route::get('/activate/{token}', ['as' => 'authenticated.activate', 'uses' => 'Auth\ActivateController@activate']);
    Route::get('/activation', ['as' => 'authenticated.activation-resend', 'uses' => 'Auth\ActivateController@resend']);
    Route::get('/exceeded', ['as' => 'exceeded', 'uses' => 'Auth\ActivateController@exceeded']);

    // Socialite Register Routes
    Route::get('/social/redirect/{provider}', ['as' => 'social.redirect', 'uses' => 'Auth\SocialController@getSocialRedirect']);
    Route::get('/social/handle/{provider}', ['as' => 'social.handle', 'uses' => 'Auth\SocialController@getSocialHandle']);

    // Route to for user to reactivate their user deleted account.
    Route::get('/re-activate/{token}', ['as' => 'user.reactivate', 'uses' => 'RestoreUserController@userReActivate']);
});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'activity']], function () {

    // Activation Routes
    Route::get('/activation-required', ['uses' => 'Auth\ActivateController@activationRequired'])->name('activation-required');
    Route::get('/logout', ['uses' => 'Auth\LoginController@logout'])->name('logout');

    //Route::post('book/save', 'BookController@saveContent');
    Route::get('book/create', 'BookController@create');
    Route::post('book', 'BookController@store');
    Route::resource('book', 'BookController');
    Route::post('paid/discountSave', 'PaidController@discountSave');
    Route::post('paid/deleteDiscount/{id}', 'PaidController@deleteDiscount');
    Route::resource('paid', 'PaidController');
});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'activity', 'twostep']], function () {

    //  Homepage Route - Redirect based on user role is in controller.
    Route::get('/home', ['as' => 'public.home',   'uses' => 'UserController@index']);

    // Show users profile - viewable by other users.
    Route::get('profile/{username}', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@show',
    ]);
    // Show users profile - viewable by other users.
    Route::get('subscription/{username}', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@subscription',
    ]);
});

// Registered, activated, and is current user routes.
Route::group(['middleware' => ['auth', 'activated', 'currentUser', 'activity', 'twostep']], function () {

    // User Profile and Account Routes
    Route::resource(
        'profile',
        'ProfilesController', [
            'only' => [
                'show',
                'edit',
                'update',
                'create',
            ],
        ]
    );
    Route::put('profile/{username}/updateUserAccount', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@updateUserAccount',
    ]);
    Route::put('profile/{username}/updateUserPassword', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@updateUserPassword',
    ]);
    Route::delete('profile/{username}/deleteUserAccount', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@deleteUserAccount',
    ]);

    // Route to show user avatar
    Route::get('images/profile/{id}/avatar/{image}', [
        'uses' => 'ProfilesController@userProfileAvatar',
    ]);

    // Route to upload user avatar.
    Route::post('avatar/upload', ['as' => 'avatar.upload', 'uses' => 'ProfilesController@upload']);
});

// Registered, activated, and is admin routes.
Route::group(['middleware' => ['auth', 'activated', 'role:admin', 'activity', 'twostep']], function () {
    Route::resource('/users/deleted', 'SoftDeletesController', [
        'only' => [
            'index', 'show', 'update', 'destroy',
        ],
    ]);

    Route::resource('users', 'UsersManagementController', [
        'names' => [
            'index'   => 'users',
            'destroy' => 'user.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);
    Route::post('search-users', 'UsersManagementController@search')->name('search-users');

    Route::resource('themes', 'ThemesManagementController', [
        'names' => [
            'index'   => 'themes',
            'destroy' => 'themes.destroy',
        ],
    ]);

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    Route::get('routes', 'AdminDetailsController@listRoutes');
    Route::get('active-users', 'AdminDetailsController@activeUsers');

    Route::resource('admin/categories', 'Admin\\CategoriesController');
    Route::resource('admin/dashboard', 'Admin\\DashboardController');
    Route::resource('admin/categories', 'Admin\\CategoriesController');
    Route::resource('admin/plans', 'Admin\\PlansController');
    Route::resource('admin/settings', 'Admin\\SettingsController');
    // Route::resource('book', 'BookController');
    Route::get('/admin/transaction', 'Admin\\PlansController@transactionView');
    Route::get('admin/books/category/{category_name}', 'BookController@show_books_by_category');

    
    Route::post('/admin/homepage/special_feature', 'Admin\\HomeController@add_special_feature_book');
    Route::post('/admin/homepage/add_book', 'Admin\\HomeController@add_tags_book');
    Route::post('/admin/homepage/special_feature/{id}', 'Admin\\HomeController@delete_special_feature_book');
    Route::get('/admin/homepage/{category_name}', 'Admin\\HomeController@show_books_tag');
    Route::resource('admin/homepage', 'Admin\\HomeController');
    Route::post('admin/books/category/{id}', 'BookController@deleteCategory');
});

Route::redirect('/php', '/phpinfo', 301);
Route::get('admin/login', array('as' => 'admin.login', 'uses' => 'Auth\LoginController@showLoginForm'));

Route::get('about-us', 'PagesController@aboutus');
Route::get('contact-us', 'PagesController@contactus');
Route::get('career', 'PagesController@career');
Route::get('terms', 'PagesController@terms');
Route::get('privacy', 'PagesController@privacy');
Route::get('help', 'PagesController@help');
Route::get('subscription/{username}', [
    'as'   => '{username}',
    'uses' => 'ProfilesController@subscription',
]);
//show subscription plans in front end for users
Route::get('plans', 'Admin\\PlansController@fe_view_plans');
Route::post('profile/payment', 'Admin\\PlansController@do_payment');
Route::post('contact', 'PagesController@contact_us_mail');
Route::get('books/category/{category_name}', 'BookController@show_books_by_category');
Route::get('books/ebook/{id}/{ebooktitle}', 'BookController@view_free_ebook');
Route::get('book/get/{id}', 'BookController@getBookDetail');
Route::post('book/save', 'BookController@saveContent');