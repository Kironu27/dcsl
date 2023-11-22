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
  Venue
**************************************************************************************/
Route::prefix('/venue')->group(function(){


  /**************************************************************************************
    Booking
  **************************************************************************************/
  Route::prefix('/booking')->group(function(){

    /**************************************************************************************
      Today
    **************************************************************************************/
    Route::prefix('/today')->group(function(){

      /*  List
      **************************************************************************************/
      Route::get('/list',config('routing.application.modules.dashboard.employee.controller').'\Venue\Booking\TodayController@list')->name(config('routing.application.modules.dashboard.employee.name').'.venue.booking.today.list');

      /*  View
      **************************************************************************************/
      Route::get('/view/{id}',config('routing.application.modules.dashboard.employee.controller').'\Venue\Booking\TodayController@view')->name(config('routing.application.modules.dashboard.employee.name').'.venue.booking.today.view');

      /*  Update
      **************************************************************************************/
      Route::post('/update',config('routing.application.modules.dashboard.employee.controller').'\Venue\Booking\TodayController@update')->name(config('routing.application.modules.dashboard.employee.name').'.venue.booking.today.update');

    }); //End Today

    /**************************************************************************************
      Upcoming
    **************************************************************************************/
    Route::prefix('/upcoming')->group(function(){

      /*  List
      **************************************************************************************/
      Route::get('/list',config('routing.application.modules.dashboard.employee.controller').'\Venue\Booking\UpcomingController@list')->name(config('routing.application.modules.dashboard.employee.name').'.venue.booking.upcoming.list');

      /*  View
      **************************************************************************************/
      Route::get('/view/{id}',config('routing.application.modules.dashboard.employee.controller').'\Venue\Booking\UpcomingController@view')->name(config('routing.application.modules.dashboard.employee.name').'.venue.booking.upcoming.view');

      /*  Update
      **************************************************************************************/
      Route::post('/update',config('routing.application.modules.dashboard.employee.controller').'\Venue\Booking\UpcomingController@update')->name(config('routing.application.modules.dashboard.employee.name').'.venue.booking.upcoming.update');

    }); //End Today


    /**************************************************************************************
      Today
    **************************************************************************************/
    Route::prefix('/previous')->group(function(){

      /*  List
      **************************************************************************************/
      Route::get('/list',config('routing.application.modules.dashboard.employee.controller').'\Venue\Booking\PreviousController@list')->name(config('routing.application.modules.dashboard.employee.name').'.venue.booking.previous.list');

      /*  View
      **************************************************************************************/
      Route::get('/view/{id}',config('routing.application.modules.dashboard.employee.controller').'\Venue\Booking\PreviousController@view')->name(config('routing.application.modules.dashboard.employee.name').'.venue.booking.previous.view');

      /*  Update
      **************************************************************************************/
      Route::post('/update',config('routing.application.modules.dashboard.employee.controller').'\Venue\Booking\PreviousController@update')->name(config('routing.application.modules.dashboard.employee.name').'.venue.booking.previous.update');

    }); //End Today


  }); //End Booking

}); //End Venue
