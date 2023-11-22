<?php

/*
|--------------------------------------------------------------------------
| Web Routes for Authorization
|--------------------------------------------------------------------------
| Page
|--------------------------------------------------------------------------
*/


/*  Booking Payment
**************************************************************************************/
Route::post('/booking/payment',config('routing.application.modules.landing.dcs.controller').'\Event\BookingController@payment')->name(config('routing.application.modules.landing.dcs.name').'.event.booking.payment');

/*  Booking Receipt
**************************************************************************************/
Route::get('/booking/receipt',config('routing.application.modules.landing.dcs.controller').'\Event\BookingController@receipt')->name(config('routing.application.modules.landing.dcs.name').'.event.booking.receipt');

/*  Booking Receipt
**************************************************************************************/
Route::get('/booking/resent/code',config('routing.application.modules.landing.dcs.controller').'\Event\BookingController@resent')->name(config('routing.application.modules.landing.dcs.name').'.event.booking.resent.code');
