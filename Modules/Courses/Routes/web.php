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

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::resource('/courses', 'CoursesController');
    Route::get('/course/{id}', 'CoursesController@section')->name('course.section');

    Route::resource('/sections', 'SectionsController', ['except' => ['index']]);
    Route::get('/section/{id}', 'SectionsController@classe')->name('section.classe');

    Route::resource('/classes', 'ClassesController', ['except' => ['index']] );
});