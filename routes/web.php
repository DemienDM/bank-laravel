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

Route::get('/', 'UserController@index')->name('users');
Route::get('/user/{id}', 'UserController@view')->where('id', '[0-9]+')->name('user');
Route::get('/deposits', 'DepositController@index')->name('deposits');
Route::get('/deposit/{id}', 'DepositController@view')->where('id', '[0-9]+')->name('deposit');
Route::get('/transactions', 'TransactionController@index')->name('transactions');
Route::get('/statistics', 'StatisticsController@index')->name('statistics');