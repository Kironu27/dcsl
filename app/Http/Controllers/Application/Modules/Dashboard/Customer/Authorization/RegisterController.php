<?php

//Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Customer\Authorization;

//Get Authorization
use Auth;

//Get Authenticates Users
use Illuminate\Foundation\Auth\AuthenticatesUsers;

//Get Authorization
use App\Http\Helpers\TokenAuthorizationUser;

//Get Carbon
use \Carbon\Carbon;

use Illuminate\Validation\Rule;

//Controller Helper
use App\Http\Controllers\Controller;

//Get Hash
use Hash;

//Get Mail
use Mail;
use App\Mail\Authorization\VerificationCode;

//Model
use App\Models\DCS\MYSQL\Table\Customer;

//Get Request
use Illuminate\Http\Request;

//Get Class
class RegisterController extends Controller{

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

  //Path Header
	protected $header = [
		'category'=>'Authorization',
		'module'=>'Register',
		'sub'=>'Customer',
		'gate'=>''
	];

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
    $this->asset['images'] = 'images/'.$this->application.'/modules/dashboard/'.$this->user.'/authorization/register/';

    //Set Hyperlink
    $this->hyperlink['page']['login'] = $this->route_link['name'].'register';
    $this->hyperlink['page']['process'] = $this->route_link['name'].'register.process';
    $this->hyperlink['page']['home'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.home';
    $this->hyperlink['page']['success'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.authorization.register.verification.identification';

    //Set Navigation
		$this->hyperlink['navigation'] = $this->navigation['hyperlink'];

  }

  /**************************************************************************************
    Login
  **************************************************************************************/
  public function index(){

    //Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

    //Set Asset
    $asset = $this->asset;

    //Set Token
    $token = new TokenAuthorizationUser();

    //Set Breadcrumb
		$data['title'] = array($this->header['category'],$this->header['module'],$this->header['sub']);

    //Get Authorization Token Guard
    $authorization_token['guard'] = $token->encrypt['guard'][$this->user];

    //Get Authorization Token Database
    $authorization_token['database'] = $token->encrypt['database']['dcs'];

    //Return View
    return view($this->route_link['view'].'.register',compact('data','authorization_token','asset','hyperlink'));

  }

  /**************************************************************************************
    Process
  **************************************************************************************/
  public function process(Request $request){

    //Get Route Path
    $this->routePath();

    //Set Hyperlink
    $hyperlink = $this->hyperlink;

    //Validate
    $validated = $request->validate(
      [
        'name'=>['required'],
        'dob'=>['required','before:-18 years'],
        'gender'=>['required'],
        'email'=>['required','email',Rule::unique('customer', 'email')],
        'contact_no'=>['required'],
        'password'=>['required'],
        // 'password_confirmation'=>['required','min:6','max:7','regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/','same:password_confirmation'],
        'password_confirmation'=>['required','min:6','max:8','same:password_confirmation'],

      ],
      [
        // 'name.required'=>'Please Enter Your Name',
        'dob.required'=>'Please Enter Your Date of Birth',
        'dob.before'=>'Date of Birth Must Be After 15 Years',
        'dob.after'=>'Date of Birth Must Be Before 18 Years',
        'gender.required'=>'Please Select Your Gender',
        'email.required'=>'Please Enter Your Email',
        'email.email'=>'Email Address Invalid',
        'email.unique'=>'Email Address Exist',
        'contact_no.required'=>'Please Enter Your Contact No',
        'password.required'=>'Please Enter Your Password',
        'password.min'=>'Password Must be Minimum Length of 6',
        'password.max'=>'Password Must be Maximum Length of 8',
        // 'password.regex'=>'Password Must be 1 Uppercase, 1 Lower Case, 1 Number And 1 Symbol',
        'password.same'=>'Password and Confirmation Password Not Matched',
        'password_confirmation.required'=>'Please Enter Your Password Confirmation',
      ]
    );
// dd($request->dob);
		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

    //Generate Six Digit Code
    $data['main']['code'] = rand(100000, 999999);

		//Get Model
		$model['customer'] = new Customer();

    //Set Model
    $model['customer']->name = $request->name;
    $model['customer']->dob = $request->dob;
    $model['customer']->gender = $request->gender;
    $model['customer']->email = $request->email;
    $model['customer']->verification_code = $data['main']['code'];
    $model['customer']->password = Hash::make($request->password);
    $model['customer']->contact_no = $request->contact_no;
    $model['customer']->status = 'pending';
    $model['customer']->created_by = Auth::id();
    $model['customer']->created_at = Carbon::now();
    $model['customer']->save();

    //Get Last ID
    $last_id = $model['customer']->customer_id;


    $model['customer']->created_by = $last_id;
    $model['customer']->save();

    //If Failed
    if(!$model['customer']){

      //Return Redirect Error
      return redirect()->route($hyperlink['page']['login'])
                       ->with('alert_type','error')
                       ->with('message','Failed to Register');


    }

    //Success

    //Saved Temporary Session
    $request->session()->put('temporary_user_id',$last_id);


    $data['main']['name'] = $request->name;
// echo $randomCode;

    //Send Email
    // Mail::to('testingproject62@gmail.com')->send(new VerificationCode($data));
    Mail::to($request->email)->send(new VerificationCode($data));

    //Success
    //Return Redirect Success
    return redirect()->route($hyperlink['page']['success']);

                     // ->with('alert_type','success')
                     // ->with('message','Failed to Register');
    //Auth::guard($this->user)->loginUsingId($last_id);

    //Should Use Guard
    //Auth::shouldUse($this->user);

    //Set Session Guard
    //$request->session()->put('guard',$this->user);

    //Redirect to Dashboard
    //return redirect()->intended(route($hyperlink['page']['home']));

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
