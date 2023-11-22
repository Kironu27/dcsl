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
Route::prefix('/manage')->group(function(){

  /**************************************************************************************
    Announcement
  **************************************************************************************/
  Route::prefix('/announcement')->group(function(){

    /*  New
    **************************************************************************************/
    Route::get('/new',config('routing.application.modules.dashboard.employee.controller').'\Manage\AnnouncementController@new')->name(config('routing.application.modules.dashboard.employee.name').'.manage.announcement.new');

    /*  Create
    **************************************************************************************/
    Route::post('/create',config('routing.application.modules.dashboard.employee.controller').'\Manage\AnnouncementController@create')->name(config('routing.application.modules.dashboard.employee.name').'.manage.announcement.create');

    /*  List
    **************************************************************************************/
    Route::get('/list',config('routing.application.modules.dashboard.employee.controller').'\Manage\AnnouncementController@list')->name(config('routing.application.modules.dashboard.employee.name').'.manage.announcement.list');

    /*  Delete
    **************************************************************************************/
    Route::get('/delete',config('routing.application.modules.dashboard.employee.controller').'\Manage\AnnouncementController@delete')->name(config('routing.application.modules.dashboard.employee.name').'.manage.announcement.delete');

    /*  View
    **************************************************************************************/
    Route::get('/view/{id}',config('routing.application.modules.dashboard.employee.controller').'\Manage\AnnouncementController@view')->name(config('routing.application.modules.dashboard.employee.name').'.manage.announcement.view');

    /*  Update
    **************************************************************************************/
    Route::post('/update',config('routing.application.modules.dashboard.employee.controller').'\Manage\AnnouncementController@update')->name(config('routing.application.modules.dashboard.employee.name').'.manage.announcement.update');

  }); //End Announcement

  /**************************************************************************************
    Customer
  **************************************************************************************/
  Route::prefix('/customer')->group(function(){

    /*  New
    **************************************************************************************/
    Route::get('/new',config('routing.application.modules.dashboard.employee.controller').'\Manage\CustomerController@new')->name(config('routing.application.modules.dashboard.employee.name').'.manage.customer.new');

    /*  Create
    **************************************************************************************/
    Route::post('/create',config('routing.application.modules.dashboard.employee.controller').'\Manage\CustomerController@create')->name(config('routing.application.modules.dashboard.employee.name').'.manage.customer.create');

    /*  List
    **************************************************************************************/
    Route::get('/list',config('routing.application.modules.dashboard.employee.controller').'\Manage\CustomerController@list')->name(config('routing.application.modules.dashboard.employee.name').'.manage.customer.list');

    /*  Delete
    **************************************************************************************/
    Route::get('/delete',config('routing.application.modules.dashboard.employee.controller').'\Manage\CustomerController@delete')->name(config('routing.application.modules.dashboard.employee.name').'.manage.customer.delete');

    /*  View
    **************************************************************************************/
    Route::get('/view/{id}',config('routing.application.modules.dashboard.employee.controller').'\Manage\CustomerController@view')->name(config('routing.application.modules.dashboard.employee.name').'.manage.customer.view');

    /*  Update
    **************************************************************************************/
    Route::post('/update',config('routing.application.modules.dashboard.employee.controller').'\Manage\CustomerController@update')->name(config('routing.application.modules.dashboard.employee.name').'.manage.customer.update');

  }); //End Customer

  /**************************************************************************************
    Employee
  **************************************************************************************/
  Route::prefix('/employee')->group(function(){

    /*  New
    **************************************************************************************/
    Route::get('/new',config('routing.application.modules.dashboard.employee.controller').'\Manage\EmployeeController@new')->name(config('routing.application.modules.dashboard.employee.name').'.manage.employee.new');

    /*  Create
    **************************************************************************************/
    Route::post('/create',config('routing.application.modules.dashboard.employee.controller').'\Manage\EmployeeController@create')->name(config('routing.application.modules.dashboard.employee.name').'.manage.employee.create');

    /*  List
    **************************************************************************************/
    Route::get('/list',config('routing.application.modules.dashboard.employee.controller').'\Manage\EmployeeController@list')->name(config('routing.application.modules.dashboard.employee.name').'.manage.employee.list');

    /*  Delete
    **************************************************************************************/
    Route::get('/delete',config('routing.application.modules.dashboard.employee.controller').'\Manage\EmployeeController@delete')->name(config('routing.application.modules.dashboard.employee.name').'.manage.employee.delete');

    /*  View
    **************************************************************************************/
    Route::get('/view/{id}',config('routing.application.modules.dashboard.employee.controller').'\Manage\EmployeeController@view')->name(config('routing.application.modules.dashboard.employee.name').'.manage.employee.view');

    /*  Update
    **************************************************************************************/
    Route::post('/update',config('routing.application.modules.dashboard.employee.controller').'\Manage\EmployeeController@update')->name(config('routing.application.modules.dashboard.employee.name').'.manage.employee.update');

  }); //End Employee

}); //End Manage
