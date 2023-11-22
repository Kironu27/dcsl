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

/*  Home
**************************************************************************************/
Route::get('/home',config('routing.application.modules.dashboard.customer.controller').'\Home\IndexController@index')->name(config('routing.application.modules.dashboard.customer.name').'.home');
