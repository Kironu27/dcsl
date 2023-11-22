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
    Route::get('/view',config('routing.application.modules.dashboard.employee.controller').'\Account\AvatarController@view')->name(config('routing.application.modules.dashboard.employee.name').'.account.avatar.view');

    /*  Update
    **************************************************************************************/
    Route::post('/update',config('routing.application.modules.dashboard.employee.controller').'\Account\AvatarController@update')->name(config('routing.application.modules.dashboard.employee.name').'.account.avatar.update');

  }); //End Profile

  /**************************************************************************************
    Profile
  **************************************************************************************/
  Route::prefix('/profile')->group(function(){

    /*  View
    **************************************************************************************/
    Route::get('/view',config('routing.application.modules.dashboard.employee.controller').'\Account\ProfileController@view')->name(config('routing.application.modules.dashboard.employee.name').'.account.profile.view');

    /*  Update
    **************************************************************************************/
    Route::post('/update',config('routing.application.modules.dashboard.employee.controller').'\Account\ProfileController@update')->name(config('routing.application.modules.dashboard.employee.name').'.account.profile.update');

  }); //End Profile

  /**************************************************************************************
    Change Password
  **************************************************************************************/
  Route::prefix('/change/password')->group(function(){

    /*  View
    **************************************************************************************/
    Route::get('/view',config('routing.application.modules.dashboard.employee.controller').'\Account\ChangePasswordController@view')->name(config('routing.application.modules.dashboard.employee.name').'.account.change_password.view');

    /*  Update
    **************************************************************************************/
    Route::post('/update',config('routing.application.modules.dashboard.employee.controller').'\Account\ChangePasswordController@update')->name(config('routing.application.modules.dashboard.employee.name').'.account.change_password.update');

  }); //End Announcement

}); //End Manage
