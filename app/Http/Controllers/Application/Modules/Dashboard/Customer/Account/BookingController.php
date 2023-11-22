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

//Model
use App\Models\Youthnited\MYSQL\Table\Booking;

//Get Request
use Illuminate\Http\Request;

//Get Class
class BookingController extends Controller{

	//Application
  protected $application = 'application';

  //User
  protected $user = 'customer';

	//Path Header
	protected $header = [
		'category'=>'Dashboard',
		'module'=>'Account',
		'sub'=>'Profile',
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
		$this->route_link['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.account.booking.';

    //Set Route Name
    $this->route_link['name'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.account.booking.';

		//Set Image Route
		$this->asset['images'] = '/images/'.$this->application.'/modules/dashboard/'.$this->user.'/pages/account/booking';

    //Set Navigation
		$this->hyperlink['navigation'] = $this->navigation['hyperlink'];

		//Set Hyperlink
    $this->hyperlink['page']['list'] = $this->route_link['name'].'list';
    $this->hyperlink['page']['view'] = $this->route_link['name'].'view';
    $this->hyperlink['page']['receipt'] = $this->route_link['name'].'receipt';

	}

  /**************************************************************************************
    List
  **************************************************************************************/
  public function list(Request $request){

    //Get Route Path
    $this->routePath();

    //Set Hyperlink
    $hyperlink = $this->hyperlink;

    //Set Breadcrumb
    $data['title'] = array($this->header['category'],$this->header['module'],$this->header['sub'],'Profile');

    //Get Model
    $model['booking'] = new Booking();

    //Get Data
    $data['main'] = $model['booking']->getList();

    //Return View
    return view($this->route_link['view'].'list.index',compact('data','hyperlink'));

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

    //Get Model
    $model['booking'] = new Booking();

    //Get Data
    $data['main'] = $model['booking']->viewSelected(
      [
        'column'=>[
          'booking_id'=>$request->route('id')
        ]
      ]
    );

		//Return View
		return view($this->route_link['view'].'view.index',compact('data','hyperlink'));

  }

  /**************************************************************************************
 		Receipt
 	**************************************************************************************/
	public function receipt(Request $request){

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

		//Set Breadcrumb
    $data['title'] = array($this->header['category'],$this->header['module'],$this->header['sub'],'Profile');

    //Get Model
    $model['booking'] = new Booking();

    //Get Data
    $data['main'] = $model['booking']->viewSelected(
      [
        'column'=>[
          'booking_id'=>$request->route('id')
        ]
      ]
    );

		//Return View
		return view($this->route_link['view'].'receipt.index',compact('data','hyperlink'));

  }


}
