<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Employee\Home;

//Get Database
use DB;

//Get Timestamp
use Carbon\Carbon;

//Get File
use File;

//Controller Helper
use App\Http\Controllers\Controller;

//Model
use App\Models\DCS\MYSQL\Table\Customer;
use App\Models\DCS\MYSQL\Table\Employee;
use App\Models\DCS\MYSQL\View\Report;

//Get Request
use Illuminate\Http\Request;

//Get Class
class IndexController extends Controller{

	//Application
  protected $application = 'application';

  //User
  protected $user = 'employee';

	//Path Header
	protected $header = [
		'category'=>'Dashboard',
		'module'=>'Home',
		'sub'=>'',
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
		$this->route_link['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.home.';

		//Set Image Route
		$this->asset['images'] = '/images/'.$this->application.'/modules/dashboard/'.$this->user.'/pages/home/';

    //Set Navigation
		$this->hyperlink['navigation'] = $this->navigation['hyperlink'];

		//Set Hyperlink

	}

	/**************************************************************************************
 		Index
 	**************************************************************************************/
	public function index(Request $request){

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

		//Set Breadcrumb
		$data['title'] = array($this->header['category']);

    // dd(\Session::all());
// echo asset('storage/file.txt');
// dd(\Storage::get('public/2.png'));
		//Get Model
		$model['customer'] = new Customer();
    $model['employee'] = new Employee();
		$model['report'] = new Report();
    //
    //
		// // $model['announcement'] = new Announcement();
    //
		//Get Data
		$data['customer']['total']['registered']['overall'] = $model['customer']->getTotal(
      [
        'column'=>[
          'status'=>'active'
        ]
      ]
    );
 // dd($data);
    $data['customer']['total']['registered']['this_month'] = $model['customer']->getTotal(
      [
        'category'=>'this_month',
        'column'=>[
          'status'=>'active'
        ]
      ]
    );

    //Get Data
		$data['employee']['total']['registered']['overall'] = $model['employee']->getTotal(
      [
        'column'=>[
          'status'=>'active'
        ]
      ]
    );
 // dd($data);
    $data['employee']['total']['registered']['this_month'] = $model['employee']->getTotal(
      [
        'category'=>'this_month',
        'column'=>[
          'status'=>'active'
        ]
      ]
    );

    $data['report']['annual']['booked'] = $model['report']->getAnnualTotalBooked();
    $data['report']['annual']['price'] = $model['report']->getAnnualTotalPrice();
    // print_r($data['report']['annual']['price']);exit();
    // $dataJson = json_encode($data);
    // dd(json_encode($data['report']));
    //
    // $data['customer']['total']['registered']['today'] = $model['customer']->getTotal(
    //   [
    //     'category'=>'today',
    //     'column'=>[
    //       'status'=>'active'
    //     ]
    //   ]
    // );
    //
    // $data['organizer']['total']['registered']['overall'] = $model['organizer']->getTotal(
    //   [
    //     'column'=>[
    //       'status'=>'active'
    //     ]
    //   ]
    // );
    //
    // $data['organizer']['total']['registered']['today'] = $model['organizer']->getTotal(
    //   [
    //     'category'=>'today',
    //     'column'=>[
    //       'status'=>'active'
    //     ]
    //   ]
    // );
    //
    // //Get Data
    // $data['event'] = $model['event']->getList();

    // dd($data['event']);
    // dd($data);

// dd($this->route_link['view'].'index');
		//Return View
		return view($this->route_link['view'].'index',compact('data','hyperlink'));

  }

}
