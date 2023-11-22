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
  Manage
**************************************************************************************/
Route::prefix('/account')->group(function(){

  /**************************************************************************************
    Avatar
  **************************************************************************************/
  Route::prefix('/avatar')->group(function(){

    /*  View
    **************************************************************************************/
    Route::get('/view',config('routing.application.modules.dashboard.customer.controller').'\Account\AvatarController@view')->name(config('routing.application.modules.dashboard.customer.name').'.account.avatar.view');

    /*  Update
    **************************************************************************************/
    Route::post('/update',config('routing.application.modules.dashboard.customer.controller').'\Account\AvatarController@update')->name(config('routing.application.modules.dashboard.customer.name').'.account.avatar.update');

  }); //End Avatar

  /**************************************************************************************
    Profile
  **************************************************************************************/
  Route::prefix('/profile')->group(function(){

    /*  View
    **************************************************************************************/
    Route::get('/view',config('routing.application.modules.dashboard.customer.controller').'\Account\ProfileController@view')->name(config('routing.application.modules.dashboard.customer.name').'.account.profile.view');

    /*  Update
    **************************************************************************************/
    Route::post('/update',config('routing.application.modules.dashboard.customer.controller').'\Account\ProfileController@update')->name(config('routing.application.modules.dashboard.customer.name').'.account.profile.update');

  }); //End Profile

  /**************************************************************************************
    Booking
  **************************************************************************************/
  Route::prefix('/booking')->group(function(){

    /*  List
    **************************************************************************************/
    Route::get('/list',config('routing.application.modules.dashboard.customer.controller').'\Account\BookingController@list')->name(config('routing.application.modules.dashboard.customer.name').'.account.booking.list');

    /*  View
    **************************************************************************************/
    Route::get('/view/{id}',config('routing.application.modules.dashboard.customer.controller').'\Account\BookingController@view')->name(config('routing.application.modules.dashboard.customer.name').'.account.booking.view');

    /*  Receipt
    **************************************************************************************/
    Route::get('/receipt/{id}',config('routing.application.modules.dashboard.customer.controller').'\Account\BookingController@receipt')->name(config('routing.application.modules.dashboard.customer.name').'.account.booking.receipt');


  }); //End Profile

  /**************************************************************************************
    Change Password
  **************************************************************************************/
  Route::prefix('/change/password')->group(function(){

    /*  View
    **************************************************************************************/
    Route::get('/view',config('routing.application.modules.dashboard.customer.controller').'\Account\ChangePasswordController@view')->name(config('routing.application.modules.dashboard.customer.name').'.account.change_password.view');

    /*  Update
    **************************************************************************************/
    Route::post('/update',config('routing.application.modules.dashboard.customer.controller').'\Account\ChangePasswordController@update')->name(config('routing.application.modules.dashboard.customer.name').'.account.change_password.update');

  }); //End Announcement

}); //End Manage
