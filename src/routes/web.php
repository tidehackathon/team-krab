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

Route::get('/', 'App\Http\Controllers\DashboardController@index');

//Route::get('/createTables', 'App\Http\Controllers\DashboardController@createTables');

Route::get('/count', 'App\Http\Controllers\DashboardController@count');
Route::get('/count/testCasesByNation', 'App\Http\Controllers\DashboardController@testCasesByNation');
Route::get('/count/integralIndicators', 'App\Http\Controllers\DashboardController@integralIndicators');



