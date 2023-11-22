<?php

//Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Employee\Authorization;

//Get Authorization
use App\Http\Helpers\TokenAuthorizationUser;

//Controller Helper
use App\Http\Controllers\Controller;

//Get Hash
use Hash;

//Get Model
use App\Models\DCS\MYSQL\Table\Employee;

//Get Mail
use Mail;
use App\Mail\Authorization\ForgotPassword;

//Get Request
use Illuminate\Http\Request;

//Get Class
class ForgotPasswordController extends Controller{

  //Path Header
	protected $header = [
		'category'=>'Authorization',
		'module'=>'Forgot Password',
		'sub'=>'Employee',
		'gate'=>''
	];

  //Application
  protected $application = 'application';

  //User
  protected $user = 'employee';

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
    $this->hyperlink['page']['forgot'] = $this->route_link['name'].'forgot';
    $this->hyperlink['page']['process'] = $this->route_link['name'].'forgot.process';
    $this->hyperlink['page']['home'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.home';

    //Set Navigation
		$this->hyperlink['navigation'] = $this->navigation['hyperlink'];

  }

  /**************************************************************************************
    Index
  **************************************************************************************/
  public function index(){

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

    //Get Authorization Token Database
    $authorization_token['database'] = $token->encrypt['database']['dcs'];

    //Return View
    return view($this->route_link['view'].'.forgot',compact('authorization_token','asset','hyperlink','data'));

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
        'email'=>['required','email'],
      ],
      [
        'email.required'=>'Please Enter Your Email',
        'email.email'=>'Email Address Invalid',
      ]
    );

    //Get Model
		$model['employee'] = new Employee();

		//Get Data
		$data['main'] = $model['employee']->viewSelected(['column'=>['email'=>$request->email]]);

    $data['main'] = $model['employee']::find($data['main']->employee_id);
    $data['main']->password = Hash::make('Qwe123$');
		$data['main']->is_reset = 1;
    $data['main']->save();
		$data['category'] = 'employee';
// dd($data['main']->name);
    Mail::to($request->email)->send(new ForgotPassword($data));

    //Return Redirect Success
    return redirect()->route($hyperlink['page']['forgot'])
                     ->with('alert_type','success')
                     ->with('message','An Email Has Sent For Your Forgotten Password');

  }


}
