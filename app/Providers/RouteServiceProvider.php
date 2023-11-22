<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider{
  /**
   * This namespace is applied to your controller routes.
   *
   * In addition, it is set as the URL generator's root namespace.
   *
   * @var string
   */

  //Path Controller
  protected $namespace = 'App\Http\Controllers';

  //Path Base
  protected $path;

  /**
   * Define your route model bindings, pattern filters, etc.
   *
   * @return void
   */
  public function boot(){

    //Parent Boot
    parent::boot();

  }

  /**
   * Define the path for the application route.
   *
   * @return void
   */
  public function setPath(){

    //Configuration
    $this->path['configuration'] = 'routes/configuration/';

    //Authorization - Employee
    $this->path['authorization']['employee'] = 'routes/authorization/employee/';

    //Authorization - Customer
    $this->path['authorization']['customer'] = 'routes/authorization/customer/';

    //Dashboard
    $this->path['dashboard']['employee'] = 'routes/application/modules/dashboard/employee/';
    $this->path['dashboard']['customer'] = 'routes/application/modules/dashboard/customer/';

    //Landing
    $this->path['landing'] = 'routes/application/modules/landing/';

  }

  /**
   * Define the routes for the application.
   *
   * @return void
   */
  public function map(){

    //Set Path
    $this->setPath();

    //Map Web Routes
    $this->mapWebRoutes();

  }

  /**
   * Define the "web" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function mapWebRoutes(){

    //Middleware Web
    Route::middleware('web')->namespace($this->namespace)
                            ->group(function($router){

                              //Configuration
                              require base_path($this->path['configuration'].'web.php');
                              require base_path($this->path['configuration'].'ajax.php');

                              //Authorization - Employee
                              require base_path($this->path['authorization']['employee'].'index.php');

                              // Authorization - Customer
                              require base_path($this->path['authorization']['customer'].'index.php');

                              //Landing
                              require base_path($this->path['landing'].'index.php');

                          });

    /**************************************************************************************
      Middleware - Employee
    **************************************************************************************/
    Route::middleware(['auth:employee'])->namespace($this->namespace)
                                             ->group(function($router){

       /* Employee
       **************************************************************************************/
       Route::prefix('employee')->group(function(){

         /* Dashboard
         **************************************************************************************/
         Route::prefix('dashboard')->group(function(){

           //Dashboard
           require base_path($this->path['dashboard']['employee'].'home/index.php');
           require base_path($this->path['dashboard']['employee'].'manage/index.php');
           require base_path($this->path['dashboard']['employee'].'setup/index.php');
           require base_path($this->path['dashboard']['employee'].'venue/index.php');
           require base_path($this->path['dashboard']['employee'].'account/index.php');
           require base_path($this->path['dashboard']['employee'].'equipment/index.php');

         }); //End Dashboard

       }); //End Administrator

    }); //End Middleware - Administrator

    /**************************************************************************************
      Middleware - Customer
    **************************************************************************************/
    Route::middleware(['auth:customer'])->namespace($this->namespace)
                                        ->group(function($router){

        //Booking
        require base_path($this->path['landing'].'authorization.php');

        /* Customer
        **************************************************************************************/
        Route::prefix('customer')->group(function(){

          /* Dashboard
          **************************************************************************************/
          Route::prefix('dashboard')->group(function(){

            //Dashboard
            require base_path($this->path['dashboard']['customer'].'home/index.php');
            require base_path($this->path['dashboard']['customer'].'announcement/index.php');
            require base_path($this->path['dashboard']['customer'].'account/index.php');
            require base_path($this->path['dashboard']['customer'].'booking/index.php');

          }); //End Dashboard

        }); //End Customer

      }); //End Middleware - Customer

  }

}
