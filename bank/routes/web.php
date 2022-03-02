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
})->name('/');
//Route::resource('getlistflytrade','Api\ListFlyTradeController');
Route::post('payment','Controller@payment');
Route::middleware(['api', 'cors'])->group(function () {
    Route::resource('/getlistflytrade', 'Api\ListFlyTradeController');
});
