<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Customer\Account;

//Get Auth
use Auth;

//Get Database
use DB;

//Get Timestamp
use Carbon\Carbon;

//Controller Helper
use App\Http\Controllers\Controller;

//Get Hash
use \Hash;

//Model
use App\Models\DCS\MYSQL\Table\Customer;

//Get Request
use Illuminate\Http\Request;

//Get Class
class ChangePasswordController extends Controller{

	//Application
  protected $application = 'application';

  //User
  protected $user = 'customer';

	//Path Header
	protected $header = [
		'category'=>'Dashboard',
		'module'=>'Account',
		'sub'=>'Change Password',
		'gate'=>''
	];

	//Route Link
	protected $route_link;

	//Asset
	public $asset;

	//Hyperlink
	public $hyperlink;

	/**************************************************************************************
		Route Path
	**************************************************************************************/
	public function routePath(){

		//Set Route View
		$this->route_link['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.account.change_password.';

    //Set Route Name
    $this->route_link['name'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.account.change_password.';

		//Set Image Route
		$this->asset['images'] = '/images/'.$this->application.'/modules/dashboard/'.$this->user.'/pages/account/change_password';

    //Set Navigation
		$this->hyperlink['navigation'] = $this->navigation['hyperlink'];

		//Set Hyperlink
    $this->hyperlink['page']['view'] = $this->route_link['name'].'view';
    $this->hyperlink['page']['update'] = $this->route_link['name'].'update';
	}

  /**************************************************************************************
 		View
 	**************************************************************************************/
	public function view(Request $request){

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

		//Set Breadcrumb
    $data['title'] = array($this->header['category'],$this->header['module'],$this->header['sub'],'Change Password');

		//Return View
		return view($this->route_link['view'].'view.index',compact('data','hyperlink'));

  }

  /**************************************************************************************
 		Update
 	**************************************************************************************/
	public function update(Request $request){

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

    //Validate
    $validated = $request->validate(
      [
        'password_current'=>['required'],
        // 'password_new'=>['required','min:6','max:7','regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/','same:password_confirmation'],
        'password_new'=>['required','min:6','max:7','same:password_confirmation'],

        'password_confirmation'=>['required'],
      ],
      [
        'password_current.required'=>'Please Enter Your Current Password',
        'password_new.required'=>'Please Enter Your New Password',
        'password_new.min'=>'New Password Must be Minimum Length of 6',
        'password_new.max'=>'New Password Must be Maximum Length of 7',
        // 'password_new.regex'=>'Password Must be 1 Uppercase, 1 Lower Case, 1 Number And 1 Symbol',
        'password_new.same'=>'New Password and Confirmation Password Not Matched',
        'password_confirmation.required'=>'Please Enter Your Confirmation Password',
      ]
    );

    //Get Model
    $model['customer'] = new Customer();

    //Get Data
    $data['main'] = $model['customer']::find($request->id);

    //If Data Not Found
    if(!$data['main']){
      abort(404);
    }
// dd($request->password_current);
    //Check Password Current Matched From Password Database
    if(!Hash::check($request->password_current,$data['main']->password)){

      //Return Redirect Error
      return redirect()->route($hyperlink['page']['view'],$request->id)
                       ->with('alert_type','error')
                       ->with('message','Password Current Invalid');

    }
    //If Password Not Matched
    else{
// dd(32);
      //Check Password New Mathed With Password Current
      if(Hash::check($request->password_new,$data['main']->password)){

        //Return Redirect Error
        return redirect()->route($hyperlink['page']['view'],$request->id)
                         ->with('alert_type','error')
                         ->with('message','New Password Cannot Same With Current Password');
      }

      //If Not Matched Proceed
      else{

        //Set Model
        $data['main']->password = Hash::make($request->password_new);
        $data['main']->updated_by = Auth::id();
        $data['main']->updated_at = Carbon::now();
        $data['main']->save();

        //If Failed
        if(!$data['main']){

          //Return Redirect Error
          return redirect()->route($hyperlink['page']['view'],$request->id)
                           ->with('alert_type','error')
                           ->with('message','Update Password Failed');

        }

        //Return Redirect Success
        return redirect()->route($hyperlink['page']['view'],$request->id)
                         ->with('alert_type','success')
                         ->with('message','Password Updated');
      }

    }

  }

}
