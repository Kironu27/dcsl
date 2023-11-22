<?php

//Get Path
namespace App\Http\Controllers\Share\Modules\Dashboard\Customer\Authorization\Logout;

//Get Authorization
use Auth;

//Get Authorization
use App\Http\Helpers\TokenAuthorizationUser;

//Get Timestamp
use Carbon\Carbon;

//Controller Helper
use App\Http\Controllers\Controller;

//Model
use App\Http\Models\General\MYSQL\Table\Office;
use App\Http\Models\IUKL\MYSQL\Table\Customer;


//Get Request
use Illuminate\Http\Request;

//Get Class
class ProcessController extends Controller{

  /**************************************************************************************
    Route Path
  **************************************************************************************/
  public function routePath(){

    //Set Hyperlink
    $this->hyperlink['page']['login']['customer'] = config('routing.iukl.modules.dashboard.customer.name').'.authorization.login';

    //Logout
    $this->hyperlink['page']['logout']['customer'] = config('routing.iukl.modules.dashboard.customer.name').'.authorization.logout';

  }

  /**
   * Get the guard to be used during authentication.
   *
   * @return \Illuminate\Contracts\Auth\StatefulGuard
   */
  protected function guard($guard){return Auth::guard($guard);}

  /**************************************************************************************
    Logout
  **************************************************************************************/
  public function logout(Request $request){

    //Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

    //Set Token
    $token = new TokenAuthorizationUser();

    //Get Guard
    $guard = $token->encrypter->decrypt(session()->get('authorization_token'));

    //Check Guard
    switch($guard){

       //Customer
       case 'customer':

        //Unset Guard
        Auth::guard($guard)
            ->logout();

        //Unset Session
        $request->session()->invalidate();

        //Redirect to Login
        return redirect()->route($this->hyperlink['page']['login'][$guard]);

      break;

      //If Failed
      default:

        //Return Failed
        abort(404);

      break;

    }

    //Return Failed
    abort(404);

  }

}
