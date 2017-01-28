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


Route::group(['prefix' => 'opac', 'as' => 'opac::'], function () {
    Route::get('/', 'OpacController@index');
    Route::get('search', 'OpacController@search');
    Route::get('reservation', 'OpacController@reservation');
    Route::get('book/{id}/view', 'OpacController@book');
    Route::get('book/{id}/reserve', 'OpacController@reserve');
    Route::get('book/{id}/remove', 'OpacController@remove');
});

Route::group(['prefix' => 'admin', 'as' => 'admin::'], function () {
    Route::get('users', 'UserController@index');
    Route::get('departments', 'DepartmentController@index');
    Route::get('categories', 'CategoryController@index');
    Route::get('books', 'BookController@index');
    Route::get('holidays', 'HolidayController@index');
    Route::get('logs', 'LogController@index');

    Route::get('department/{id}/delete', 'DepartmentController@delete');
    Route::get('category/{id}/delete', 'CategoryController@delete');
    Route::get('book/{id}/delete', 'BookController@delete');
    Route::get('holiday/{id}/delete', 'HolidayController@delete');

    Route::post('users', 'UserController@store');
    Route::post('departments', 'DepartmentController@store');
    Route::post('categories', 'CategoryController@store');
    Route::post('holidays', 'HolidayController@store');
    Route::post('books', 'BookController@store');

    Route::get('user/{id}', 'UserController@edit');
    Route::get('holiday/{id}', 'HolidayController@edit');
    Route::get('book/{id}', 'BookController@edit');
    Route::get('category/{id}', 'CategoryController@edit');
    Route::get('department/{id}', 'DepartmentController@edit');

    Route::put('users', 'UserController@update');
    Route::put('holidays', 'HolidayController@update');
    Route::put('books', 'BookController@update');
    Route::put('categories', 'CategoryController@update');
    Route::put('departments', 'DepartmentController@update');

    Route::get('weeds', 'BookController@trashIndex');
    Route::get('weed/{id}', 'BookController@trashRestore');

    Route::get('borrow', 'BorrowController@index');
    Route::get('borrow/search', 'BorrowController@search');
    Route::get('borrow/{id}/borrow', 'BorrowController@borrow');
    Route::post('borrow/reserve', 'BorrowController@reserve');

    Route::get('return', 'ReturnController@index');
    Route::get('return/search', 'ReturnController@search');
    Route::post('return/books', 'ReturnController@returnBooks');
    Route::get('return/print/{id}', 'ReturnController@printReceipt');
});

Route::get('logout', 'Auth\LoginController@logout');

/*   for test template    */
Route::get('/test', function () {
    return view('welcome');
});

Route::get('/topbar', function () {
    return view('topbar');
});
