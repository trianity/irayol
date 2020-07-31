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
*/

Route::group(['middleware' => 'setTheme'], function () {
    Route::get('/', 'FrontendController@index')->name('home');
    Route::get('/blog/{slug}', 'FrontendController@showblog')->name('blog.show'); //show the blog page
    Route::get('/{slug}', 'FrontendController@showpage')->name('page.show'); //show the page
});

Route::group(['prefix' => 'admin'], function() {
    //route Auth
    Auth::routes(['register' => false]);
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function() {

    // Change languaje
    Route::get('lang/{lang}', 'HomeController@swap')->name('lang.swap');

    // Dashboard
    Route::get('/home', 'HomeController@index')->name('admin.home'); //main dashboard

    // Blog
    Route::resource('/blog', 'BlogsController', ['except' => ['show']]);

    // Page
    Route::resource('/page', 'PagesController', ['except' => ['show']]);
    Route::post('/page/active', 'PagesController@active')->name('page.active');

    // Menu
    Route::get('/menu',  'MenuController@index')->name('menu.index');
    Route::get('/menu/new/{id}', 'MenuController@new')->name('menu.new');
    Route::get('/menu/edit/{id}', 'MenuController@edit')->name('menu.edit');
    Route::post('/menu/active', 'MenuController@active')->name('menu.active');
    Route::post('/addcustommenu', ['as' => 'haddcustommenu', 'uses' => 'MenuController@addcustommenu']);
    Route::post('/deleteitemmenu', ['as' => 'hdeleteitemmenu', 'uses' => 'MenuController@deleteitemmenu']);
    Route::post('/deletemenug', ['as' => 'hdeletemenug', 'uses' => 'MenuController@deletemenug']);
    Route::post('/menu/create', 'MenuController@createnewmenu')->name('menu.create');
    Route::post('/generatemenucontrol', ['as' => 'hgeneratemenucontrol', 'uses' => 'MenuController@generatemenucontrol']);
    Route::post('/updateitem', ['as' => 'hupdateitem', 'uses' => 'MenuController@updateitem']);

    // Setting
    Route::resource('setting', 'SettingsController');

    // Media
    Route::resource('/media', 'MediaController', ['only' => ['index', 'store', 'destroy']]);

    // Theme
    Route::resource('themes', 'ThemeController')->middleware('setTheme');
    Route::post('theme/active', 'ThemeController@active')->name('theme.active');

    // Addons
    Route::resource('addons', 'AddonsController');
    Route::post('addons/active', 'AddonsController@active')->name('addons.active');

    // Categories
    Route::resource('category', 'CategoriesController');

    // Users
    Route::resource('users', 'UsersController');
    Route::post('users_mass_destroy', ['uses' => 'UsersController@massDestroy', 'as' => 'users.mass_destroy']);

    // Profile
    Route::get('/profile', ['uses' => 'UsersController@profile', 'as' => 'profile.index']);
    Route::get('/profile/edit', ['uses' => 'UsersController@profileEdit', 'as' => 'profile.edit']);
    Route::put('/profile/{user}', ['uses' => 'UsersController@profileUpdate', 'as' => 'profile.update']);

    // Permissions
    Route::resource('permissions', 'PermissionsController');
    Route::post('permissions_mass_destroy', ['uses' => 'PermissionsController@massDestroy', 'as' => 'permissions.mass_destroy']);

    // Roles
    Route::resource('roles', 'RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
});


