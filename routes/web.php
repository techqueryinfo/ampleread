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
//Route::get('/welcome', 'WelcomeController@welcome')->name('welcome');
 
Route::post('/stayintouch', 'WelcomeController@stayintouch')->name('stayintouch');
Route::get('/stayintouch', 'WelcomeController@stayintouch')->name('stayintouch');

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
    Route::post('book/upload', 'BookController@uploadBook');
    Route::get('book/ebookupload', 'BookController@uploadEbookPage');
    Route::get('book/create', 'BookController@create');
    Route::get('book/publishebook', 'BookController@publish_ebook_page');
    Route::post('book', 'BookController@store');
    Route::post('book/review', 'BookController@add_book_review');
    Route::post('book/author_review', 'BookController@add_author_review');
    Route::resource('book', 'BookController');
    Route::post('paid/discountSave', 'PaidController@discountSave');
    Route::post('paid/deleteDiscount/{id}', 'PaidController@deleteDiscount');
    Route::resource('paid', 'PaidController');
    Route::get('book/readlater/{bookid}/{btitle}', 'BookController@readlater');
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
    // Route::resource('admin/categories', 'Admin\\CategoriesController');
    Route::resource('admin/dashboard', 'Admin\\DashboardController');
    Route::resource('admin/categories', 'Admin\\CategoriesController');
    Route::resource('admin/plans', 'Admin\\PlansController');
    Route::resource('admin/settings', 'Admin\\SettingsController');

    //Route::resource('book', 'BookController');
    Route::get('/category/getsubcategory/{category_id}', 'Admin\\CategoriesController@getsubcategory');
    Route::get('/admin/transaction', 'Admin\\PlansController@transactionView');
    Route::get('admin/books/category/{category_name}', 'BookController@show_books_by_category');
    Route::post('/admin/homepage/special_feature', 'Admin\\HomeController@add_special_feature_book');
    Route::post('/admin/homepage/add_book', 'Admin\\HomeController@add_tags_book');
    Route::post('/admin/homepage/special_feature/{id}', 'Admin\\HomeController@delete_special_feature_book');
    Route::get('/admin/homepage/delete_category/{category_id}', 'Admin\\HomeController@delete_category');
    Route::get('/admin/homepage/{category_id}/{category_slug}', 'Admin\\HomeController@show_books_tag');
    

    Route::resource('admin/homepage', 'Admin\\HomeController');
    Route::resource('admin/review', 'Admin\\BookReviewController');
    Route::resource('admin/message', 'AdminMessageController');
    Route::post('admin/books/category/{id}', 'BookController@deleteCategory');
    Route::post('admin/books/approve/{id}', 'Admin\\BookReviewController@book_approve');
    Route::post('admin/books/decline/{id}', 'Admin\\BookReviewController@book_decline');
});

Route::redirect('/php', '/phpinfo', 301);
Route::get('admin/login', array('as' => 'admin.login', 'uses' => 'Auth\LoginController@showLoginForm'));
Route::get('about-us', 'PagesController@aboutus');
Route::get('test', 'PagesController@test');
Route::get('contact-us', 'PagesController@contactus');
Route::get('career', 'PagesController@career');
Route::get('terms', 'PagesController@terms');
Route::get('privacy', 'PagesController@privacy');
Route::get('help', 'PagesController@help');
Route::get('subscription','PagesController@subscription');
Route::get('book/search/{search_text}', 'BookController@search');
//show subscription plans in front end for users
Route::get('plans', 'Admin\\PlansController@fe_view_plans');
Route::post('profile/payment', 'Admin\\PlansController@do_payment');
Route::post('contact', 'PagesController@contact_us_mail');
Route::get('/books/getsubcategory/{category_id}', 'BookController@getsubcategory');
Route::get('books/category/{category_name}/{sub_category?}', 'BookController@show_books_by_category');
Route::get('book/{id}/author/{authorid}/{authorname}', 'BookController@author_view_page');
Route::get('books/ebook/{id}/{ebooktitle}', 'BookController@view_free_ebook');
Route::get('book/get/{id}', 'BookController@getBookDetail');
Route::post('book/save', 'BookController@saveContent');
Route::post('book/saveimage', 'BookController@saveImage');
Route::get('book/reading/{id}/{ebooktitle}', 'BookController@read_ebook');
Route::get('book/{id}/edit/', 'BookController@saved_ebook_edit');
Route::get('books/type/{book_type}/{category_slug?}/{view_type?}', 'BookController@view_books_type');

Route::get('books/{category_name}/{category_id?}', 'BookController@view_all_books');

Route::get('message', 'AdminMessageController@front_message_view');
Route::get('/getusers', 'AdminMessageController@get_all_users');
Route::get('/message_data', 'AdminMessageController@get_all_messages');
Route::get('/user_messages/{id}', 'AdminMessageController@get_user_messages');
Route::post('save_message', 'AdminMessageController@save_admin_message');
Route::post('payment/paymentProcess', 'PaymentController@paymentProcess');
Route::get('payment/review/{plan_id}', 'PaymentController@review');
