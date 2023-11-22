<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

//Controller Helper
use App\Http\Controllers\Controller;

class Authenticate extends Middleware{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request){
      //Get Navigation

        if(!$request->expectsJson()){

          //Check First Segment
          switch($request->segment(1)){

            //Customer
            case 'customer':
              return route(config('routing.application.modules.dashboard.customer.name').'.authorization.login');
            break;

            //Employee
            case 'employee':
              return route(config('routing.application.modules.dashboard.employee.name').'.authorization.login');
            break;

            default:
              // code...
            break;
          }

        }
    }
}
