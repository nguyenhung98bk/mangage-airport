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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('bookticket','CustomerController@getBookticket')->name('bookticket');
Route::post('bookticket','CustomerController@postBookticket');

Route::post('confirmBuy1','CustomerController@confirmBuy1');
Route::post('preview','CustomerController@preview');
Route::post('finish_payment','CustomerController@finish_payment')->name('finish_payment');


Route::get('payment','CustomerController@payment')->name('payment');
Route::get('re_payment/{id}','CustomerController@re_payment')->name('re_payment');
Route::get('historyBuy','CustomerController@historyBuy')->name('historyBuy');
