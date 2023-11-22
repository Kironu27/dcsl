<?php

/*
|--------------------------------------------------------------------------
| Web Routes for Authorization
|--------------------------------------------------------------------------
| Page
|--------------------------------------------------------------------------
*/

/**************************************************************************************
  Redirect Home
**************************************************************************************/
Route::redirect('/','/home');

/**************************************************************************************
  Home
**************************************************************************************/
Route::get('/home',config('routing.application.modules.landing.dcs.controller').'\Home\IndexController@index')->name(config('routing.application.modules.landing.dcs.name').'.home');

/**************************************************************************************
  Event
**************************************************************************************/
Route::prefix('/event')->group(function(){

  /*  Search
  **************************************************************************************/
  Route::get('/search',config('routing.application.modules.landing.dcs.controller').'\Event\IndexController@search')->name(config('routing.application.modules.landing.dcs.name').'.event.search');

  /*  View
  **************************************************************************************/
  Route::get('/view/date/{date}/operation_hour/{operation_hour_id}/venue/{venue_id}/duration/{duration}',config('routing.application.modules.landing.dcs.controller').'\Event\IndexController@view')->name(config('routing.application.modules.landing.dcs.name').'.event.view');

  /*  Booking Authorization
  **************************************************************************************/
  Route::get('/booking/authorization',config('routing.application.modules.landing.dcs.controller').'\Event\BookingController@authorization')->name(config('routing.application.modules.landing.dcs.name').'.event.booking.authorization');

  /*  Booking confirmation
  **************************************************************************************/
  Route::get('/booking/confirmation',config('routing.application.modules.landing.dcs.controller').'\Event\BookingController@confirmation')->name(config('routing.application.modules.landing.dcs.name').'.event.booking.confirmation');

  /*  Booking Process Authorization
  **************************************************************************************/
  Route::get('/booking/process/authorization',config('routing.application.modules.landing.dcs.controller').'\Event\BookingController@processAuthorization')->name(config('routing.application.modules.landing.dcs.name').'.event.booking.process.authorization');

  /*  Get Event Date
  **************************************************************************************/
  Route::get('/get/date/day',config('routing.application.modules.landing.dcs.controller').'\Event\IndexController@getDateDay')->name(config('routing.application.modules.landing.dcs.name').'.event.ajax.getdateday');

});
//End Event
/**************************************************************************************
  About
**************************************************************************************/
Route::get('/about',config('routing.application.modules.landing.dcs.controller').'\About\IndexController@index')->name(config('routing.application.modules.landing.dcs.name').'.about');

/**************************************************************************************
  Contact
**************************************************************************************/
Route::get('/contact',config('routing.application.modules.landing.dcs.controller').'\Contact\IndexController@index')->name(config('routing.application.modules.landing.dcs.name').'.contact');

/**************************************************************************************
  Login Option
**************************************************************************************/
Route::get('/login/option',config('routing.application.modules.landing.dcs.controller').'\Login\OptionController@index')->name(config('routing.application.modules.landing.dcs.name').'.login.option');
