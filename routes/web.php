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

Route::get('/', 'HomeController@index');
Route::get('login', 'Auth\LoginController@showLogin');
Route::post('login', 'Auth\LoginController@authenticate');

Route::group(['prefix' => 'admin', 'as' => 'admin::'], function () {
    Route::get('users', 'UserController@index');
    Route::get('departments', 'DepartmentController@index');
    Route::get('categories', 'CategoryController@index');
    Route::get('books', 'BookController@index');
    Route::get('holidays', 'HolidayController@index');

    Route::get('department/{id}/delete', 'DepartmentController@delete');
    Route::get('category/{id}/delete', 'CategoryController@delete');
    Route::get('book/{id}/delete', 'BookController@delete');
    Route::get('holiday/{id}/delete', 'HolidayController@delete');

    Route::post('users', 'UserController@store');
    Route::post('departments', 'DepartmentController@store');
    Route::post('categories', 'CategoryController@store');
    Route::post('holidays', 'HolidayController@store');
    Route::post('books', 'BookController@store');
});

Route::get('logout', 'Auth\LoginController@logout');

/*   for test template    */
Route::get('/test', function () {
    return view('welcome');
});
