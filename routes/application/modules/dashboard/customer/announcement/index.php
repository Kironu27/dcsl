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

/**************************************************************************************
  Announcement
**************************************************************************************/
Route::prefix('/announcement')->group(function(){

  /*  View
  **************************************************************************************/
  Route::get('/view/{id}',config('routing.application.modules.dashboard.customer.controller').'\Announcement\IndexController@view')->name(config('routing.application.modules.dashboard.customer.name').'.announcement.view');


}); //End Announcement
