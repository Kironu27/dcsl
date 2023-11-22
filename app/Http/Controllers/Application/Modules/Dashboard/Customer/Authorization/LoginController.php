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

//Get Class
class LoginController extends Controller{

  //Path Header
	protected $header = [
		'category'=>'Authorization',
		'module'=>'Login',
		'sub'=>'Customer',
		'gate'=>''
	];

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

    //Set Asset
    $this->asset['images'] = 'images/'.$this->application.'/modules/dashboard/'.$this->user.'/authorization/login/';

    //Set Hyperlink
    $this->hyperlink['page']['login'] = $this->route_link['name'].'login';
    $this->hyperlink['page']['process'] = $this->route_link['name'].'login.process';
    $this->hyperlink['page']['home'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.home';
    $this->hyperlink['page']['booking']['confirmation'] = config('routing.application.modules.landing.dcs.name').'.event.booking.confirmation';

    //Set Navigation
		$this->hyperlink['navigation'] = $this->navigation['hyperlink'];

  }

  /**************************************************************************************
    Login
  **************************************************************************************/
  public function index(Request $request){

    //Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

    //Set Asset
    $asset = $this->asset;

    //Set Breadcrumb
		$data['title'] = array($this->header['category'],$this->header['module'],$this->header['sub']);

    //Set Token
    $token = new TokenAuthorizationUser();

    //Get Authorization Token Guard
    $authorization_token['guard'] = $token->encrypt['guard'][$this->user];
// dd($request->session()->get('booking.booking_redirect'));
    //Get Authorization Token Database
    $authorization_token['database'] = $token->encrypt['database']['dcs'];

    //Return View
    return view($this->route_link['view'].'.login',compact('authorization_token','asset','hyperlink','data'));

  }

  /**************************************************************************************
    Process
  **************************************************************************************/
  public function process(Request $request){

    //Get Route Path
    $this->routePath();

    //Set Hyperlink
    $hyperlink = $this->hyperlink;

    //Check Validation Request
    $validate = $request->validate(

      //Check Validation
      [
        'email'=>['required','email'],
        'password'=>['required'],
      ],

      //Error Message
      [
        'email.required'=>'Email required',
        'email.email'=>'Email is not Valid',
        'password.required'=>'Password required',
      ]
     );

     //Check Validate
     if($validate){

       if(
           $this->guard($this->user)->attempt(
           $this->credentials($request)
         )
       ){

         //Should Use Guard
         Auth::shouldUse($this->user);

         //Set Session Guard
         $request->session()->put('guard',$this->user);

         //Check Session Guard
         if($request->has('redirect')){

           //Redirect to Dashboard
           return redirect()->intended(route($hyperlink['page']['booking']['confirmation']));

         }

         //Redirect to Dashboard
         return redirect()->intended(route($hyperlink['page']['home']));

         //Return True
         return true;

       }

			 //Check Session Guard
			 if($request->has('redirect')){

				 //Return Redirect Error
				 return redirect()->route($hyperlink['page']['login'])
				 									->with('form_redirect','yes')
													->with('alert_type','error')
													->with('message','Invalid Email or Password');

			 }
       //Return Redirect Error
       return redirect()->route($hyperlink['page']['login'])
                        ->with('alert_type','error')
                        ->with('message','Invalid Email or Password');

     }

  }

  /**
   * Get the needed authorization credentials from the request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  protected function credentials(Request $request){
// dd();
    //Field
    $field = filter_var($request->get($this->username()), FILTER_VALIDATE_EMAIL)
            ? $this->username()
            : 'username';

    //Return Request
    return [
      $field => $request->get($this->username()),
      'password' => $request->password,
    ];

  }

  /**
   * Get the login username to be used by the controller.
   *
   * @return string
   */
  public function username(){return 'email';}

  /**
   * Log the user out of the application.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */

  /**
   * Get the guard to be used during authentication.
   *
   * @return \Illuminate\Contracts\Auth\StatefulGuard
   */
  protected function guard($guard){return Auth::guard($guard);}

}
