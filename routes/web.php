<?php

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

Route::get('/', 'UsersController@login');

Route::get('/index', 'UsersController@index');

Route::get('/users', 'UsersController@create')->name('user.create');

Route::post('/users', 'UsersController@store')->name('user.store');

Route::get('/users/{user}', 'UsersController@edit')->name('user.edit');

Route::post('/users/{user}', 'UsersController@update')->name('user.update');

Route::delete('/users/{user}', 'UsersController@destroy')->name('user.destroy');

Route::post('/index', 'UsersController@index')->name('user.index');

Route::get('/chat', 'UsersController@chat')->name('user.chat');

Route::get('/login', 'UsersController@login')->name('user.login');

Route::get('/logout', 'UsersController@logout')->name('user.logout');

Route::post('/check', 'UsersController@check')->name('user.check');
