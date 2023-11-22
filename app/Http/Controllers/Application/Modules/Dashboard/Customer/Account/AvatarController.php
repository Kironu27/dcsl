<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Customer\Account;

//Get Auth
use Auth;

//Get Database
use DB;

//Get File
use File;

//Get Timestamp
use Carbon\Carbon;

//Controller Helper
use App\Http\Controllers\Controller;

//Model
use App\Models\DCS\MYSQL\Table\Customer;

//Get Request
use Illuminate\Http\Request;

//Get Storage
use Storage;

//Get Class
class AvatarController extends Controller{

	//Application
  protected $application = 'application';

  //User
  protected $user = 'customer';

	//Path Header
	protected $header = [
		'category'=>'Dashboard',
		'module'=>'Account',
		'sub'=>'Avatar',
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
		$this->route_link['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.account.avatar.';

    //Set Route Name
    $this->route_link['name'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.account.avatar.';

		//Set Image Route
		$this->asset['images'] = '/images/'.$this->application.'/modules/dashboard/'.$this->user.'/pages/account/avatar';

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
    $data['title'] = array($this->header['category'],$this->header['module'],$this->header['sub'],'Profile');

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
        'avatar'=>['required','mimes:png'],
      ],
      [
        'avatar.required'=>'Please Upload Your Image',
        'avatar.mimes'=>'Image must be PNG',
      ]
    );

    //Get Model
    $model['customer'] = new Customer();

    //Get Data
    $data['main'] = $model['customer']::find(Auth::id());

    //If Data Not Found
    if(!$data['main']){
      abort(404);
    }

    $path = 'public/users/customer/'.Auth::id().'/avatar/image.png';

    $request->file('avatar')->storeAs(
        'public/users/customer', Auth::id().'/avatar/image.png'
    );
// dd(  $request->file('avatar')->storeAs(
//       'public/users/customer', Auth::id().'/avatar/image.png'
//   ));
    //Return Redirect Success
    return redirect()->route($hyperlink['page']['view'],$request->id)
                     ->with('alert_type','success')
                     ->with('message','Data Update');


  }

}
