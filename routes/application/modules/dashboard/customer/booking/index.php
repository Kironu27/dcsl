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
  Booking
**************************************************************************************/
Route::prefix('/booking')->group(function(){

  /**************************************************************************************
    Active
  **************************************************************************************/
  Route::prefix('/active')->group(function(){

    /*  List
    **************************************************************************************/
    Route::get('/list',config('routing.application.modules.dashboard.customer.controller').'\Booking\ActiveController@list')->name(config('routing.application.modules.dashboard.customer.name').'.booking.active.list');

    /*  View
    **************************************************************************************/
    Route::get('/view/id/{id}',config('routing.application.modules.dashboard.customer.controller').'\Booking\ActiveController@view')->name(config('routing.application.modules.dashboard.customer.name').'.booking.active.view');

  }); //End Active

  /**************************************************************************************
    History
  **************************************************************************************/
  Route::prefix('/history')->group(function(){

    /*  List
    **************************************************************************************/
    Route::get('/list',config('routing.application.modules.dashboard.customer.controller').'\Booking\HistoryController@list')->name(config('routing.application.modules.dashboard.customer.name').'.booking.history.list');

    /*  View
    **************************************************************************************/
    Route::get('/view/id/{id}',config('routing.application.modules.dashboard.customer.controller').'\Booking\HistoryController@view')->name(config('routing.application.modules.dashboard.customer.name').'.booking.history.view');

  }); //End History

}); //End Manage
