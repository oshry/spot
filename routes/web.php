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

Route::get('/', function () {
    return view('welcome');
});
//Route::get('users', 'UsersController@index');

Route::resource('status','StatusCRUDController');
Route::get('request/{id}/showitems', 'RequestCRUDController@showitems');
Route::resource('request','RequestCRUDController');
Route::get('main','MainController@index');
