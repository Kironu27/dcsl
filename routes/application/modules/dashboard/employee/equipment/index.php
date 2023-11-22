<?php
/**************************************************************************************
  Equipment
**************************************************************************************/
Route::prefix('/equipment')->group(function(){

  /**************************************************************************************
    Ball
  **************************************************************************************/
  Route::prefix('/ball')->group(function(){

    /*  New
    **************************************************************************************/
    Route::get('/new',config('routing.application.modules.dashboard.employee.controller').'\Equipment\Ball\IndexController@new')->name(config('routing.application.modules.dashboard.employee.name').'.equipment.ball.new');

    /*  Create
    **************************************************************************************/
    Route::post('/create',config('routing.application.modules.dashboard.employee.controller').'\Equipment\Ball\IndexController@create')->name(config('routing.application.modules.dashboard.employee.name').'.equipment.ball.create');

    /*  List
    **************************************************************************************/
    Route::get('/list',config('routing.application.modules.dashboard.employee.controller').'\Equipment\Ball\IndexController@list')->name(config('routing.application.modules.dashboard.employee.name').'.equipment.ball.list');

    /*  Delete
    **************************************************************************************/
    Route::get('/delete',config('routing.application.modules.dashboard.employee.controller').'\Equipment\Ball\IndexController@delete')->name(config('routing.application.modules.dashboard.employee.name').'.equipment.ball.delete');

    /*  View
    **************************************************************************************/
    Route::get('/view/{id}',config('routing.application.modules.dashboard.employee.controller').'\Equipment\Ball\IndexController@view')->name(config('routing.application.modules.dashboard.employee.name').'.equipment.ball.view');

    /*  Update
    **************************************************************************************/
    Route::post('/update',config('routing.application.modules.dashboard.employee.controller').'\Equipment\Ball\IndexController@update')->name(config('routing.application.modules.dashboard.employee.name').'.equipment.ball.update');

  }); //End Ball

  /**************************************************************************************
    Racquet
  **************************************************************************************/
  Route::prefix('/racquet')->group(function(){

    /*  New
    **************************************************************************************/
    Route::get('/new',config('routing.application.modules.dashboard.employee.controller').'\Equipment\Racquet\IndexController@new')->name(config('routing.application.modules.dashboard.employee.name').'.equipment.racquet.new');

    /*  Create
    **************************************************************************************/
    Route::post('/create',config('routing.application.modules.dashboard.employee.controller').'\Equipment\Racquet\IndexController@create')->name(config('routing.application.modules.dashboard.employee.name').'.equipment.racquet.create');

    /*  List
    **************************************************************************************/
    Route::get('/list',config('routing.application.modules.dashboard.employee.controller').'\Equipment\Racquet\IndexController@list')->name(config('routing.application.modules.dashboard.employee.name').'.equipment.racquet.list');

    /*  Delete
    **************************************************************************************/
    Route::get('/delete',config('routing.application.modules.dashboard.employee.controller').'\Equipment\Racquet\IndexController@delete')->name(config('routing.application.modules.dashboard.employee.name').'.equipment.racquet.delete');

    /*  View
    **************************************************************************************/
    Route::get('/view/{id}',config('routing.application.modules.dashboard.employee.controller').'\Equipment\Racquet\IndexController@view')->name(config('routing.application.modules.dashboard.employee.name').'.equipment.racquet.view');

    /*  Update
    **************************************************************************************/
    Route::post('/update',config('routing.application.modules.dashboard.employee.controller').'\Equipment\Racquet\IndexController@update')->name(config('routing.application.modules.dashboard.employee.name').'.equipment.racquet.update');

  }); //End Ball

}); //End Equipment
