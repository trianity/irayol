<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    // Change languaje
    Route::get('lang/{lang}', [App\Http\Controllers\HomeController::class, 'swap'])->name('lang.swap');

    // Dashboard
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.home'); //main dashboard

    // Blog
    Route::resource('/blog', \App\Http\Controllers\BlogsController::class, ['except' => ['show']]);

    // Page
    Route::resource('/page', \App\Http\Controllers\PagesController::class, ['except' => ['show']]);
    Route::post('/page/active', [App\Http\Controllers\PagesController::class, 'active'])->name('page.active');

    // Menu
    Route::get('/menu', [App\Http\Controllers\MenuController::class, 'index'])->name('menu.index');
    Route::post('/menu', [App\Http\Controllers\MenuController::class, 'store'])->name('menu.store');
    Route::get('/menu/edit/{id}', [App\Http\Controllers\MenuController::class, 'edit'])->name('menu.edit');
    Route::post('/menu/{menu}', [App\Http\Controllers\MenuController::class, 'update'])->name('menu.update');
    Route::delete('/menu/{menu}', [App\Http\Controllers\MenuController::class, 'destroy'])->name('menu.destroy');
    Route::post('/menu/active/{id}', [App\Http\Controllers\MenuController::class, 'active'])->name('menu.active');

    route::get('menu-item', [App\Http\Controllers\MenuItemController::class, 'menuItem'])->name('menu-item');
    route::get('search-menu-item', [App\Http\Controllers\MenuItemController::class, 'menuItemSearch'])->name('search-menu-item');
    route::post('menu-item/save', [App\Http\Controllers\MenuItemController::class, 'menuItemSave'])->name('save-menu-item');
    route::post('menu-item/update', [App\Http\Controllers\MenuItemController::class, 'menuItemUpdate'])->name('update-menu-item');
    route::delete('menu-item/delete', [App\Http\Controllers\MenuItemController::class, 'menuItemDelete'])->name('delete-menu-item');

    //change order on ajax
    route::post('change-menu-order', [App\Http\Controllers\MenuItemController::class, 'changeMenuOrder'])->name('change-menu-order');


    // Setting
    Route::resource('setting', \App\Http\Controllers\SettingsController::class);

    // Media
    Route::resource('/media', \App\Http\Controllers\MediaController::class, ['only' => ['index', 'store', 'destroy']]);

    // Theme
    Route::resource('themes', \App\Http\Controllers\ThemeController::class)->middleware('setTheme');
    Route::post('theme/active', [App\Http\Controllers\ThemeController::class, 'active'])->name('theme.active');

    // Addons
    Route::resource('addons', \App\Http\Controllers\AddonsController::class);
    Route::post('addons/active', [App\Http\Controllers\AddonsController::class, 'active'])->name('addons.active');

    // Categories
    Route::resource('category', \App\Http\Controllers\CategoriesController::class);

    // Users
    Route::resource('users', \App\Http\Controllers\UsersController::class);
    Route::post('users_mass_destroy', [App\Http\Controllers\UsersController::class, 'massDestroy'])->name('users.mass_destroy');

    // Profile
    Route::get('/profile', [App\Http\Controllers\UsersController::class, 'profile'])->name('profile.index');
    Route::get('/profile/edit', [App\Http\Controllers\UsersController::class, 'profileEdit'])->name('profile.edit');
    Route::put('/profile/{user}', [App\Http\Controllers\UsersController::class, 'profileUpdate'])->name('profile.update');

    // Permissions
    Route::resource('permissions', \App\Http\Controllers\PermissionsController::class);
    Route::post('permissions_mass_destroy', [App\Http\Controllers\PermissionsController::class, 'massDestroy'])->name('permissions.mass_destroy');

    // Roles
    Route::resource('roles', \App\Http\Controllers\RolesController::class);
    Route::post('roles_mass_destroy', [App\Http\Controllers\RolesController::class, 'massDestroy'])->name('roles.mass_destroy');
});

Route::group(['middleware' => 'setTheme'], function () {
    Route::get('/', [App\Http\Controllers\FrontendController::class, 'index'])->name('home');
    Route::get('/blog/{slug}', [App\Http\Controllers\FrontendController::class, 'showblog'])->name('blog.show'); //show the blog page
    Route::get('/page/{slug}', [App\Http\Controllers\FrontendController::class, 'showpage'])->name('page.show'); //show the page
    Route::get('/category/{slug}', [App\Http\Controllers\FrontendController::class, 'category'])->name('site.category');
});