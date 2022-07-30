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

Route::get('/restaurant', function () {
    return view('index');
});

Route::get('/restaurant/write','RestaurantController@writePage')->name('write');
Route::get('/restaurant/check','RestaurantController@checkPage')->name('check');
Route::get('/restaurant/join','RestaurantController@joinPage')->name('join');
Route::get('/restaurant/QA','RestaurantController@QAPage')->name('QA');
Route::get('/restaurant/QA/{id}','RestaurantController@viewPage')->name('view');


Route::post('/application','RestaurantController@application')->name('application');
Route::post('/review','RestaurantController@review')->name('review');
