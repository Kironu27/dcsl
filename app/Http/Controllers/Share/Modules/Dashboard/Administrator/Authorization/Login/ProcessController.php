<?php

namespace App\Http\Controllers\Share\Modules\Dashboard\Administrator\Authorization\Login;

//Use Artisan
use Artisan;

//Get Authorization
use Auth;

//Get Authenticates Users
use Illuminate\Foundation\Auth\AuthenticatesUsers;

//Get Timestamp
use Carbon\Carbon;

//Controller Helper
use App\Http\Controllers\Controller;

//Get Database
use DB;

//Get Hash
use Hash;

//Model
use App\Http\Models\YouthNited\MYSQL\Table\Administrator;

//Get Request
use Illuminate\Http\Request;

//Get Session
use Session;

//Get Token Authorization
use App\Http\Helpers\TokenAuthorizationUser;

//Get ValidationException
use Illuminate\Validation\ValidationException;

//Get Class
class ProcessController extends Controller{

  /*
  |--------------------------------------------------------------------------
  | Login Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles authenticating users for the application and
  | redirecting them to your home screen. The controller uses a trait
  | to conveniently provide its functionality to your applications.
  |
  */

  use AuthenticatesUsers;

  /**
   * Where to redirect users after login.
   *
   * @var string
   */

  //Set Lock
  protected $lock;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(){

    //Login Attempt Count Limit
    $this->lock['attempt'] = 3;

     //Duration Lock In minutes
    $this->lock['timeout'] = 1;

    $this->middleware('guest')->except('logout');
    $this->middleware('guest:administrator')->except('logout');

  }

  /**************************************************************************************
    Route Path
  **************************************************************************************/
  public function routePath(){

    //Set Hyperlink
    $this->hyperlink['page']['login'] = config('routing.application.modules.dashboard.administrator.name').'.authorization.login';
    $this->hyperlink['page']['home'] = config('routing.application.modules.dashboard.administrator.name').'.home';

  }

  /**************************************************************************************
    Process Login
  **************************************************************************************/
  public function process(Request $request){
dd(1);
    //Set Token
    $token = new TokenAuthorizationUser();
// dd($request);
    $request->validate([
        'email' => 'required',
        'password' => 'required',
    ]);

    $credentials = $request->only('email','password');

    //Merge Request Guard
    $request->merge(
      [
        'guard'=>$token->encrypter->decrypt($request->authorization_token)
      ]
    );

    //Merge Request Database
    $request->merge(
      [
        'database'=>$token->encrypter->decrypt($request->authorization_code)
      ]
    );

    //Validate Login
    $this->validateLogin($request);

    // If the class is using the ThrottlesLogins trait, we can automatically throttle
    // the login attempts for this application. We'll key this by the username and
    // the IP address of the client making these requests into this application.
    if($this->hasTooManyLoginAttempts($request)){

      //Fire Lock Event
      $this->fireLockoutEvent($request);\

      //Send Lock Response
      $this->sendLockoutResponse($request);

    }

    //Attempt Login
    if($this->attemptLogin($request)){

      //Check loginStatus
      if(!$this->checkLoginStatus($request)){

        //Send Login Status Not Active Response
        return $this->sendLoginStatusResponse($request);

      };

      //Send Login Response
      return $this->sendLoginResponse($request);

    }else{

      //Increment Failed Login
      $this->incrementLoginAttempts($request);

    }

    // If the login attempt was unsuccessful we will increment the number of attempts
    // to login and redirect the user back to the login form. Of course, when this
    // user surpasses their maximum number of attempts they will get locked out.

    //Increment Failed Login
    $this->incrementLoginAttempts($request);

    //Send Failed Login Response
    return $this->sendFailedLoginResponse($request);

  }

  /**
  * Check attempt by user if many attempt failed
  *
  * @param  \Illuminate\Http\Request  $request
  * @return bool
  */
  protected function hasTooManyLoginAttempts(Request $request){

    //Set Login Attempt
    $maxLoginAttempts = $this->lock['attempt'];

    //Set Lock Out Time
    $lockoutTime = $this->lock['timeout'];

    //Return Attempt Response
    return $this->limiter()->tooManyAttempts(
       $this->throttleKey($request),
       $maxLoginAttempts,
       $lockoutTime
    );

  }

  /**
  * Attempt to increment attempt count by user if many attempt failed
  *
  * @param  \Illuminate\Http\Request  $request
  * @return bool
  */
  protected function incrementLoginAttempts(Request $request){

    //Get Hit Limiter Login Attempt
    $this->limiter()->hit(
      $this->throttleKey($request),
      $this->decayMinutes()
    );

  }

  /**
  * Attempt to lock User if many attempt failed
  *
  * @param  \Illuminate\Http\Request  $request
  * @return bool
  */

  protected function sendLockoutResponse(Request $request){

    //Second Limiter
    $seconds = $this->limiter()->availableIn(
      $this->throttleKey($request)
    );

    throw ValidationException::withMessages(
      [
        'error'=>'Too many login attempts. <br> Please try again in '.$seconds.' seconds.'
      ]
    )->status(423);

  }

  /**
    * Attempt to validate log the user into the application.
    *
    * @param  \Illuminate\Http\Request $request
    * @return bool
  */
  protected function validateLogin(Request $request){
      $this->validate($request, [
        $this->username() => ['required','string'],
        'password' => ['required','string'],
    ]);
  }

  /**
   * Attempt to log the user into the application.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return bool
   */
  protected function attemptLogin(Request $request){

    //Check Session
    //Session::put('database',$request->database);
    Session::put('authorization_code',$request->authorization_code);
    Session::put('authorization_token',$request->authorization_token);

    //Set Connection
    $this->setConnection($request->database);
// dd($token->encrypter->decrypt($request->authorization_code));
    //Auth Attempt True
    if(
        $this->guard($request->guard)->attempt(
        $this->credentials($request),
        $request->has('remember')
      )
    ){
// dd(Auth::guard());
      //Should Use Guard
      Auth::shouldUse($request->guard);

      //Return True
      return true;

    }

    //Return False
    return false;

  }

  /**
   * Get the needed authorization credentials from the request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  protected function credentials(Request $request){

    //Get Guard
    switch($request->guard){

      //Administrator
      case 'administrator':

        //Set Field
        $field = 'email';
        // $field = filter_var($request->input($this->username()), FILTER_VALIDATE_EMAIL) ?'email':'administrator_id';

      break;

      //If Failed
      default:

        abort(500,'10005');

      break;

    }

    //Merge Request
    $request->merge([$field => $request->input($this->username())]);

    //Return Request
    return $request->only($field,'password');

  }

  /**
   * Send the response after the user was authenticated.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  protected function sendLoginResponse(Request $request){

    //Regenerate Session
    $request->session()->regenerate();

    //Return authenticated
    return $this->authenticated($request);

  }

  /**
   * The user has been authenticated.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  mixed  $user
   * @return mixed
   */
  protected function authenticated(Request $request){

    //Get Route Path
    $this->routePath();

    //Set Hyperlink
    $hyperlink = $this->hyperlink;

    //Should Use Guard
    Auth::shouldUse($request->guard);

    //Get Request Guard
    switch ($request->guard){

      //Administrator
      case 'administrator':

        //Redirect to Dashboard
        return redirect()->intended(route($hyperlink['page']['home'][$request->guard]));

      break;

      //If Failed
      default:

        //Return Error
        abort(404);

      break;

    }

    //Return Error
    abort(404);

  }

  /**
   * Get the failed login response instance.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Symfony\Component\HttpFoundation\Response
   *
   * @throws ValidationException
   */
  protected function sendFailedLoginResponse(Request $request){

    //Return Message
    return redirect()->back()
                     ->withInput($request->except('password','_token'))
                     ->withErrors(
                        [
                          'error'=>'Invalid Email / ID or Password'
                        ]
                      );
  }

  /**
   * Check the Login Status
   *
   * @return string
   */

  public function checkLoginStatus(Request $request){

    //Return True
    return true;

  }


  /**
   * Send the Login Status Response
   *
   * @return string
   */

  public function sendLoginStatusResponse(Request $request){

    //Get Route Path
    $this->routePath();

    //Set Message
    $message = null;

    //Check Status
    switch($status){

      //Active
      case 'active':
        // code...
      break;

      default:

        //Get Message
        $message = 'Administrator is '.$status.'. Please Contact Support';

        //Unset Guard
        Auth::guard($request->guard)->logout();

        //Unset Session
        $request->session()
                ->invalidate();

      break;

    }

    //Return Error
    return redirect()->back()
                     ->withInput($request->except('password','_token'))
                     ->withErrors(
                        [
                          'error'=>$message
                        ]
                      );


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
