<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Customer\Booking;

//Get Auth
use Auth;

//Get Database
use DB;

//Get Timestamp
use Carbon\Carbon;

//Controller Helper
use App\Http\Controllers\Controller;

//Model
use App\Models\DCS\MYSQL\Table\Booking;
// use App\Models\DCS\MYSQL\Table\BookingPayment;

//Get Request
use Illuminate\Http\Request;

//Get Class
class HistoryController extends Controller{

	//Application
  protected $application = 'application';

  //User
  protected $user = 'customer';

	//Path Header
	protected $header = [
		'category'=>'Dashboard',
		'module'=>'Booking',
		'sub'=>'List',
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
		$this->route_link['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.booking.history.';

    //Set Route Name
    $this->route_link['name'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.booking.history.';

		//Set Image Route
		$this->asset['images'] = '/images/'.$this->application.'/modules/dashboard/'.$this->user.'/pages/booking/history/';

    //Set Navigation
		$this->hyperlink['navigation'] = $this->navigation['hyperlink'];

    //Set Hyperlink
    $this->hyperlink['page']['list'] = $this->route_link['name'].'list';
    $this->hyperlink['page']['view'] = $this->route_link['name'].'view';

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
    $data['title'] = array($this->header['category'],$this->header['module'],'Booking','History',$request->route('id'));

    //Get Model
    $model['booking'] = new Booking();

    //Get Data
    $data['main'] = $model['booking']->getList(
      [
        'column'=>[
          'status'=>'expired',
          'customer_id'=>Auth::guard('customer')->id()
        ]
      ]
    );
// dd();
    //If Data Not Found
    // if(!$data['main']){
    //   abort(404);
    // }
// dd($data['main']);
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
    $data['title'] = array($this->header['category'],$this->header['module'],'View',$request->route('id'));

    //Get Model
    $model['booking']['information'] = new Booking();
    // $model['booking']['payment'] = new BookingPayment();
// dd($request);
    //Get Data
    $data['main'] = $model['booking']['information']->viewSelected(
      [
        'column'=>[
          'group_id'=>$request->id,
          'customer_id'=>Auth::guard('customer')->id()
        ]
      ]
    );

    // $data['booking']['payment'] = $model['booking']['payment']->viewSelected(
    //   [
    //     'column'=>[
    //       'group_id'=>$request->id,
    //       'customer_id'=>Auth::guard('customer')->id()
    //     ]
    //   ]
    // );
// dd($data['booking']['information']);
    //If Data Not Found
    if(!$data['main']){
      abort(404);
    }

		//Return View
		return view($this->route_link['view'].'view.index',compact('data','hyperlink'));

  }

}
