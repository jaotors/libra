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
    Route::post('users', 'UserController@store');
});

Route::get('logout', 'Auth\LoginController@logout');
