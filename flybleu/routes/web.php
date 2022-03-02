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
Route::post('confirmBuy2','CustomerController@confirmBuy2');
Route::post('check_seat','CustomerController@check_seat');
Route::post('preview','CustomerController@preview');
Route::post('preview2','CustomerController@preview2');
Route::post('finish_payment','CustomerController@finish_payment')->name('finish_payment');
Route::post('finish_payment2','CustomerController@finish_payment2')->name('finish_payment2');


Route::get('payment','CustomerController@payment')->name('payment');
Route::get('payment2','CustomerController@payment2')->name('payment2');
Route::get('re_payment/{id}','CustomerController@re_payment')->name('re_payment');
Route::get('re_payment2/{id}','CustomerController@re_payment2')->name('re_payment2');
Route::get('historyBuy','CustomerController@historyBuy')->name('historyBuy');
Route::get('cancel_ticket/{id_seat}{type}','CustomerController@cancel_ticket')->name('cancel_ticket');
Route::get('print_ticket/{id_seat}{type}','CustomerController@print_ticket')->name('print_ticket');

Route::get('customer','AdminController@customer')->name('customer');
Route::post('search_customer','AdminController@search_customer');
Route::get('create_account','AdminController@create_account')->name('create_account');
Route::post('create_account','AdminController@postCreate_account');
Route::get('view_history/{id}','AdminController@view_history')->name('view_history');
