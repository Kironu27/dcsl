<?php

/*
|--------------------------------------------------------------------------
| Web Routes for Authorization
|--------------------------------------------------------------------------
| Page
|--------------------------------------------------------------------------
*/

/**************************************************************************************
  Customer
**************************************************************************************/
Route::prefix('/customer')->group(function(){

  /**************************************************************************************
    Register
  **************************************************************************************/
  Route::prefix('/register')->group(function(){

    /*  Register
    **************************************************************************************/
    Route::get('/',config('routing.application.modules.dashboard.customer.controller').'\Authorization\RegisterController@index')->name(config('routing.application.modules.dashboard.customer.name').'.authorization.register');

    /*  Process
    **************************************************************************************/
    Route::post('/process',config('routing.application.modules.dashboard.customer.controller').'\Authorization\RegisterController@process')->name(config('routing.application.modules.dashboard.customer.name').'.authorization.register.process');

    /**************************************************************************************
      Verification
    **************************************************************************************/
    Route::prefix('/verification')->group(function(){

      /*  Identification
      **************************************************************************************/
      Route::get('/identification',config('routing.application.modules.dashboard.customer.controller').'\Authorization\VerificationController@identification')->name(config('routing.application.modules.dashboard.customer.name').'.authorization.register.verification.identification');

      /*  Resent
      **************************************************************************************/
      Route::get('/resent',config('routing.application.modules.dashboard.customer.controller').'\Authorization\VerificationController@resent')->name(config('routing.application.modules.dashboard.customer.name').'.authorization.register.verification.resent');

      /*  Process
      **************************************************************************************/
      Route::post('/process',config('routing.application.modules.dashboard.customer.controller').'\Authorization\VerificationController@process')->name(config('routing.application.modules.dashboard.customer.name').'.authorization.register.verification.process');


    }); //End Verification


  }); //End Register

  /**************************************************************************************
    Login
  **************************************************************************************/
  Route::prefix('/login')->group(function(){

    /*  Login
    **************************************************************************************/
    Route::get('/',config('routing.application.modules.dashboard.customer.controller').'\Authorization\LoginController@index')->name(config('routing.application.modules.dashboard.customer.name').'.authorization.login');

    /*  Process
    **************************************************************************************/
    Route::post('/process',config('routing.application.modules.dashboard.customer.controller').'\Authorization\LoginController@process')->name(config('routing.application.modules.dashboard.customer.name').'.authorization.login.process');

  }); //End Login

  /**************************************************************************************
    Logout
  **************************************************************************************/
  Route::prefix('/logout')->group(function(){

    /*  Logout
    **************************************************************************************/
    Route::get('/',config('routing.application.modules.dashboard.customer.controller').'\Authorization\LogoutController@index')->name(config('routing.application.modules.dashboard.customer.name').'.authorization.logout');

  }); //End Logout

  /**************************************************************************************
    Forgot
  **************************************************************************************/
  Route::prefix('/forgot')->group(function(){

    /*  Forgot
    **************************************************************************************/
    Route::get('/',config('routing.application.modules.dashboard.customer.controller').'\Authorization\ForgotPasswordController@index')->name(config('routing.application.modules.dashboard.customer.name').'.authorization.forgot');

    /*  Process
    **************************************************************************************/
    Route::post('/process',config('routing.application.modules.dashboard.customer.controller').'\Authorization\ForgotPasswordController@process')->name(config('routing.application.modules.dashboard.customer.name').'.authorization.forgot.process');

  }); //End Forgot

}); //End Customer
