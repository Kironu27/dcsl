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
class VerificationController extends Controller{

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
		'module'=>'Verification',
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
    $this->asset['images'] = 'images/'.$this->application.'/modules/dashboard/'.$this->user.'/authorization/register/verification';

    //Set Hyperlink
    $this->hyperlink['page']['identification'] = $this->route_link['name'].'register.verification.identification';
    $this->hyperlink['page']['resent'] = $this->route_link['name'].'register.verification.resent';
    $this->hyperlink['page']['process'] = $this->route_link['name'].'register.verification.process';
    $this->hyperlink['page']['home'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.home';

    //Set Navigation
		$this->hyperlink['navigation'] = $this->navigation['hyperlink'];

  }

  /**************************************************************************************
    Identification
  **************************************************************************************/
  public function identification(){

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
    return view($this->route_link['view'].'identification',compact('data','authorization_token','asset','hyperlink'));

  }

  /**************************************************************************************
    Resent
  **************************************************************************************/
  public function resent(Request $request){

    //Get Route Path
    $this->routePath();

    //Set Hyperlink
    $hyperlink = $this->hyperlink;

    //Generate Six Digit Code
    $data['main']['code'] = rand(100000, 999999);

    //Get Model
		$model['customer'] = new Customer();
// dd($request->id);
    //Get Customer ID
    $data['user'] = $model['customer']::find($request->id);

    $data['user']->verification_code = $data['main']['code'];
    $data['user']->save();
    //If User Not Exist
    if(!$data['user']){

      //Return Redirect Success
      return redirect()->route($hyperlink['page']['identification'])
                       ->with('alert_type','error')
                       ->with('message','User Not Exist');
    }
    $data['main']['name'] = $data['user']->name;
    //Send Email
    Mail::to($data['user']->email)->send(new VerificationCode($data));

    //Return Redirect Success
    return redirect()->route($hyperlink['page']['identification'])
                     ->with('alert_type','success')
                     ->with('message','We Have Resent. Check Your Email for Latest Verification Code');

  }

  /**************************************************************************************
    Process
  **************************************************************************************/
  public function process(Request $request){
// dd($request);
    //Get Route Path
    $this->routePath();

    //Set Hyperlink
    $hyperlink = $this->hyperlink;

    //Set Hyperlink
    $hyperlink = $this->hyperlink;

    //Validate
    $validated = $request->validate(
      [
        'verification_code'=>['required'],
      ],
      [
        // 'name.required'=>'Please Enter Your Name',
        'verification_code.required'=>'Please Enter Your Verification Code',
      ]
    );
// dd($request->dob);

    //Get Model
    $model['customer'] = new Customer();

    //Get Customer ID
    $data['main'] = $model['customer']::find($request->id);

    //If User Not Exist
    if(!$data['main']){

      //Return Redirect Success
      return redirect()->route($hyperlink['page']['identification'])
                       ->with('alert_type','error')
                       ->with('message','User Not Exist');
    }

    //If Verification Code Not Exist
    if($request->verification_code != $data['main']->verification_code){

      //Return Redirect Success
      return redirect()->route($hyperlink['page']['identification'])
                       ->with('alert_type','error')
                       ->with('message','Invalid Verification Code');

    }

    Auth::guard($this->user)->loginUsingId($request->id);

    //Set Session Guard
    $request->session()->put('guard',$this->user);

    //Redirect to Dashboard
    return redirect()->intended(route($hyperlink['page']['home']));

  }



}
