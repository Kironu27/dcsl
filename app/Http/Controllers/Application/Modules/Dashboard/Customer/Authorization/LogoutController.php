<?php

//Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Customer\Authorization;

//Get Authorization
use Auth;

//Get Authenticates Users
use Illuminate\Foundation\Auth\AuthenticatesUsers;

//Get Authorization
use App\Http\Helpers\TokenAuthorizationUser;

//Controller Helper
use App\Http\Controllers\Controller;

//Get Request
use Illuminate\Http\Request;

//Get Session
use Session;

//Get Class
class LogoutController extends Controller{

  //Application
  protected $application = 'application';

  //User
  protected $user = 'customer';

  //View Path
  protected $route_link;

  //Path Link
  public $hyperlink;

  //Asset
  public $asset;

  //Token
  public $token;

  /**************************************************************************************
    Construct
  **************************************************************************************/
  public function __construct(){

    //Set Middleware
    $this->middleware('guest')->except('logout');
    $this->middleware('guest:'.$this->user)->except('logout');

    //Check Navigation
    $this->navigation();

  }

  /**************************************************************************************
    Route Path
  **************************************************************************************/
  public function routePath(){

    //Set View
    $this->route_link['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.authorization.';

    //Set Path
    $this->route_link['name'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.authorization.';

    //Set Hyperlink
    $this->hyperlink['page']['login'] = $this->route_link['name'].'login';

    //Set Navigation
		$this->hyperlink['navigation'] = $this->navigation['hyperlink'];

  }

  /**************************************************************************************
    Logout
  **************************************************************************************/
  public function index(){

    //Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

    //Authorization Destroy
    Auth::guard(Session::get('guard'))->logout();

    //Session Flush
    Session::flush();

    //Return Redirect
    return redirect()->route($hyperlink['page']['login']);

  }

}
