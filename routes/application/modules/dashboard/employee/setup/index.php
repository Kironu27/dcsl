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
  Setup
**************************************************************************************/
Route::prefix('/setup')->group(function(){

  /**************************************************************************************
    Operation Hour
  **************************************************************************************/
  Route::prefix('/operation/hour')->group(function(){

    /*  New
    **************************************************************************************/
    Route::get('/new',config('routing.application.modules.dashboard.employee.controller').'\Setup\Operation\Hour\IndexController@new')->name(config('routing.application.modules.dashboard.employee.name').'.setup.operation.hour.new');

    /*  Create
    **************************************************************************************/
    Route::post('/create',config('routing.application.modules.dashboard.employee.controller').'\Setup\Operation\Hour\IndexController@create')->name(config('routing.application.modules.dashboard.employee.name').'.setup.operation.hour.create');

    /*  List
    **************************************************************************************/
    Route::get('/list',config('routing.application.modules.dashboard.employee.controller').'\Setup\Operation\Hour\IndexController@list')->name(config('routing.application.modules.dashboard.employee.name').'.setup.operation.hour.list');

    /*  Delete
    **************************************************************************************/
    Route::get('/delete',config('routing.application.modules.dashboard.employee.controller').'\Setup\Operation\Hour\IndexController@delete')->name(config('routing.application.modules.dashboard.employee.name').'.setup.operation.hour.delete');

    /*  View
    **************************************************************************************/
    Route::get('/view/{id}',config('routing.application.modules.dashboard.employee.controller').'\Setup\Operation\Hour\IndexController@view')->name(config('routing.application.modules.dashboard.employee.name').'.setup.operation.hour.view');

    /*  Update
    **************************************************************************************/
    Route::post('/update',config('routing.application.modules.dashboard.employee.controller').'\Setup\Operation\Hour\IndexController@update')->name(config('routing.application.modules.dashboard.employee.name').'.setup.operation.hour.update');

  }); //End Operation Hour

  /**************************************************************************************
    Sport
  **************************************************************************************/
  Route::prefix('/sport')->group(function(){

    /*  New
    **************************************************************************************/
    Route::get('/new',config('routing.application.modules.dashboard.employee.controller').'\Setup\Sport\IndexController@new')->name(config('routing.application.modules.dashboard.employee.name').'.setup.sport.new');

    /*  Create
    **************************************************************************************/
    Route::post('/create',config('routing.application.modules.dashboard.employee.controller').'\Setup\Sport\IndexController@create')->name(config('routing.application.modules.dashboard.employee.name').'.setup.sport.create');

    /*  List
    **************************************************************************************/
    Route::get('/list',config('routing.application.modules.dashboard.employee.controller').'\Setup\Sport\IndexController@list')->name(config('routing.application.modules.dashboard.employee.name').'.setup.sport.list');

    /*  Delete
    **************************************************************************************/
    Route::get('/delete',config('routing.application.modules.dashboard.employee.controller').'\Setup\Sport\IndexController@delete')->name(config('routing.application.modules.dashboard.employee.name').'.setup.sport.delete');

    /*  View
    **************************************************************************************/
    Route::get('/view/{id}',config('routing.application.modules.dashboard.employee.controller').'\Setup\Sport\IndexController@view')->name(config('routing.application.modules.dashboard.employee.name').'.setup.sport.view');

    /*  Update
    **************************************************************************************/
    Route::post('/update',config('routing.application.modules.dashboard.employee.controller').'\Setup\Sport\IndexController@update')->name(config('routing.application.modules.dashboard.employee.name').'.setup.sport.update');

  }); //End Sport

  /**************************************************************************************
    Venue
  **************************************************************************************/
  Route::prefix('/venue')->group(function(){

    /**************************************************************************************
      Category
    **************************************************************************************/
    Route::prefix('/category')->group(function(){

      /*  New
      **************************************************************************************/
      Route::get('/new',config('routing.application.modules.dashboard.employee.controller').'\Setup\Venue\CategoryController@new')->name(config('routing.application.modules.dashboard.employee.name').'.setup.venue.category.new');

      /*  Create
      **************************************************************************************/
      Route::post('/create',config('routing.application.modules.dashboard.employee.controller').'\Setup\Venue\CategoryController@create')->name(config('routing.application.modules.dashboard.employee.name').'.setup.venue.category.create');

      /*  List
      **************************************************************************************/
      Route::get('/list',config('routing.application.modules.dashboard.employee.controller').'\Setup\Venue\CategoryController@list')->name(config('routing.application.modules.dashboard.employee.name').'.setup.venue.category.list');

      /*  Delete
      **************************************************************************************/
      Route::get('/delete',config('routing.application.modules.dashboard.employee.controller').'\Setup\Venue\CategoryController@delete')->name(config('routing.application.modules.dashboard.employee.name').'.setup.venue.category.delete');

      /*  View
      **************************************************************************************/
      Route::get('/view/{id}',config('routing.application.modules.dashboard.employee.controller').'\Setup\Venue\CategoryController@view')->name(config('routing.application.modules.dashboard.employee.name').'.setup.venue.category.view');

      /*  Update
      **************************************************************************************/
      Route::post('/update',config('routing.application.modules.dashboard.employee.controller').'\Setup\Venue\CategoryController@update')->name(config('routing.application.modules.dashboard.employee.name').'.setup.venue.category.update');

    }); //End Category

    /**************************************************************************************
      Home
    **************************************************************************************/
    Route::prefix('/home')->group(function(){

      /*  New
      **************************************************************************************/
      Route::get('/new',config('routing.application.modules.dashboard.employee.controller').'\Setup\Venue\IndexController@new')->name(config('routing.application.modules.dashboard.employee.name').'.setup.venue.home.new');

      /*  Create
      **************************************************************************************/
      Route::post('/create',config('routing.application.modules.dashboard.employee.controller').'\Setup\Venue\IndexController@create')->name(config('routing.application.modules.dashboard.employee.name').'.setup.venue.home.create');

      /*  List
      **************************************************************************************/
      Route::get('/list',config('routing.application.modules.dashboard.employee.controller').'\Setup\Venue\IndexController@list')->name(config('routing.application.modules.dashboard.employee.name').'.setup.venue.home.list');

      /*  Delete
      **************************************************************************************/
      Route::get('/delete',config('routing.application.modules.dashboard.employee.controller').'\Setup\Venue\IndexController@delete')->name(config('routing.application.modules.dashboard.employee.name').'.setup.venue.home.delete');

      /*  View
      **************************************************************************************/
      Route::get('/view/{id}',config('routing.application.modules.dashboard.employee.controller').'\Setup\Venue\IndexController@view')->name(config('routing.application.modules.dashboard.employee.name').'.setup.venue.home.view');

      /*  Update
      **************************************************************************************/
      Route::post('/update',config('routing.application.modules.dashboard.employee.controller').'\Setup\Venue\IndexController@update')->name(config('routing.application.modules.dashboard.employee.name').'.setup.venue.home.update');

    }); //End Home

  }); //End Venue

}); //End Setup
