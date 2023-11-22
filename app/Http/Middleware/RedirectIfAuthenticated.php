<?php

//Get Middleware Path
namespace App\Http\Middleware;

//Get Auth
use Illuminate\Support\Facades\Auth;

//Get Closure
use Closure;

//Get Request
use Illuminate\Http\Request;

//Get Route
use Route;

//Get Token Authorization
use App\Http\Helpers\TokenAuthorizationUser;

//Get Class
class RedirectIfAuthenticated{

  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @param  string|null  $guard
   * @return mixed
   */

  //Set Path
  protected $path;

  //View Path
  protected $route_link;

  //Path Link
  public $hyperlink;

  /**************************************************************************************
    Route Path
  **************************************************************************************/
  public function routePath(){

    //Set Path Homepage
    $this->hyperlink['page']['home']['employee'] = config('routing..application..modules.dashboard.employee.name').'.home';
    $this->hyperlink['page']['home']['customer'] = config('routing..application..modules.dashboard.customer.name').'.home';
    $this->hyperlink['page']['login']['employee'] = config('routing..application..modules.dashboard.employee.name').'.authorization.login';
    $this->hyperlink['page']['login']['customer'] = config('routing..application..modules.dashboard.customer.name').'.authorization.login';

  }

  /**************************************************************************************
    Handle
  **************************************************************************************/
  public function handle($request, Closure $next, $guard = null){

    //Get Route Path
    $this->routePath();

    //Set Hyperlink
    $hyperlink = $this->hyperlink;
// dd(Auth::guard('customer')->check());
    //Set Token
    $token = new TokenAuthorizationUser();
  // dd(session()->all());
  // dd($token->encrypter->decrypt(session()->get('authorization_token')));
      //Guard
      if(session()->has('authorization_token')){


        switch($token->encrypter->decrypt(session()->get('authorization_token'))){

          //Administrator
          case 'employee':

            if(Auth::guard('employee')->check() && session()->has('hold') && session()->get('hold') == 'dcs'){

              return redirect()->route($hyperlink['page']['home']['employee']);

            }

          break;

          case 'customer':

            if(Auth::guard('customer')->check() && session()->has('hold') && session()->get('hold') == 'dcs'){

              return redirect()->route($hyperlink['page']['home']['customer']);

            }

          break;

          default:

          break;

        }

      }
// dd(Auth::guard('employee'),session()->has('hold'));
      //Return Administrator
      if(Auth::guard('employee')->check() && session()->has('holddcs')){
          return redirect()->route($hyperlink['page']['home']['employee']);
      }

        //Return Customer
      if(Auth::guard('customer')->check() && session()->has('hold') && session()->get('hold') == 'dcs'){

          return redirect()->route($hyperlink['page']['home']['customer']);
      }


      //Return Data
      return $next($request);
  }

}
