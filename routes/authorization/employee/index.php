<?php

/*
|--------------------------------------------------------------------------
| Web Routes for Authorization
|--------------------------------------------------------------------------
| Page
|--------------------------------------------------------------------------
*/

/**************************************************************************************
  Employee
**************************************************************************************/
Route::prefix('/employee')->group(function(){

  /**************************************************************************************
    Login
  **************************************************************************************/
  Route::prefix('/login')->group(function(){

    /*  Login
    **************************************************************************************/
    Route::get('/',config('routing.application.modules.dashboard.employee.controller').'\Authorization\LoginController@index')->name(config('routing.application.modules.dashboard.employee.name').'.authorization.login');

    /*  Process
    **************************************************************************************/
    Route::post('/process',config('routing.application.modules.dashboard.employee.controller').'\Authorization\LoginController@process')->name(config('routing.application.modules.dashboard.employee.name').'.authorization.login.process');

  }); //End Login

  /**************************************************************************************
    Logout
  **************************************************************************************/
  Route::prefix('/logout')->group(function(){

    /*  Logout
    **************************************************************************************/
    Route::get('/',config('routing.application.modules.dashboard.employee.controller').'\Authorization\LogoutController@index')->name(config('routing.application.modules.dashboard.employee.name').'.authorization.logout');

  }); //End Logout

  /**************************************************************************************
    Forgot
  **************************************************************************************/
  Route::prefix('/forgot')->group(function(){

    /*  Forgot
    **************************************************************************************/
    Route::get('/',config('routing.application.modules.dashboard.employee.controller').'\Authorization\ForgotPasswordController@index')->name(config('routing.application.modules.dashboard.employee.name').'.authorization.forgot');

    /*  Process
    **************************************************************************************/
    Route::post('/process',config('routing.application.modules.dashboard.employee.controller').'\Authorization\ForgotPasswordController@process')->name(config('routing.application.modules.dashboard.employee.name').'.authorization.forgot.process');

  }); //End Forgot

}); //End Administrator
