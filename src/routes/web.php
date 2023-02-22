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

//Route::get("/", function () {
//    return view("welcome");
//});

Route::get('/', 'App\Http\Controllers\DashboardController@index');
Route::get('/count', 'App\Http\Controllers\DashboardController@count');
Route::get('/testCasesByNation', 'App\Http\Controllers\DashboardController@testCasesByNation');
Route::get('/integralIndicators', 'App\Http\Controllers\DashboardController@integralIndicators');



