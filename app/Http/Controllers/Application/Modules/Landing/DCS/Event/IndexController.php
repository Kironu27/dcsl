<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Landing\DCS\Event;

//Get Auth
use Auth;

//Get Database
use DB;

//Get Timestamp
use Carbon\Carbon;

//Controller Helper
use App\Http\Controllers\Controller;

//Model
use App\Models\DCS\MYSQL\Table\OperationHour;
use App\Models\DCS\MYSQL\Table\Venue;

use App\Models\DCS\MYSQL\Table\EquipmentBall;
use App\Models\DCS\MYSQL\Table\EquipmentRacquet;

//Get Request
use Illuminate\Http\Request;

//Get Class
class IndexController extends Controller{

	//Path Header
	protected $header = [
		'category'=>'Landing',
		'module'=>'Event',
		'sub'=>'Search',
		'gate'=>''
	];

	//Route Link
	protected $route_link;

	//Asset
	public $asset;

	//Page
	public $page;

	//Hyperlink
	public $hyperlink;

	/**************************************************************************************
		Route Path
	**************************************************************************************/
	public function routePath(){

		//Set Route View
		$this->route_link['view'] = config('routing.application.modules.landing.dcs.view').'.event.';

		//Set Route Name
		$this->route_link['name'] = config('routing.application.modules.landing.dcs.name').'.event.';

		//Set Page
		$this->page['sub'] = $this->route_link['view'];

		//Set Navigation
		$this->hyperlink['navigation'] = $this->navigation['hyperlink'];

		//Set Hyperlink
		$this->hyperlink['page']['search'] = $this->route_link['name'].'search';
		$this->hyperlink['page']['view'] = $this->route_link['name'].'view';
		$this->hyperlink['page']['booking']['authorization'] = $this->route_link['name'].'booking.authorization';
		$this->hyperlink['page']['login'] = config('routing.application.modules.dashboard.customer.name').'.authorization.login';

		// $this->hyperlink['page']['book'] = $this->route_link['name'].'book';
		// $this->hyperlink['page']['check'] = $this->route_link['name'].'check';
		// $this->hyperlink['page']['process'] = $this->route_link['name'].'process';
		// $this->hyperlink['page']['receipt'] = $this->route_link['name'].'receipt';
		// $this->hyperlink['page']['login'] = config('routing.application.modules.dashboard.customer.name').'.authorization.login';

	}

	/**************************************************************************************
 		Get Date Day
 	**************************************************************************************/
	public function getDateDay(Request $request){

		$day = Carbon::parse($request->date)->format('l');

		//Get Model
		$model['operation']['hour'] = new OperationHour();

		$data['operation']['hour'] = $model['operation']['hour']->getOperationHour(
			[
				'column'=>[
					'day_id'=>$day
				]
			]
		);
		// dd($data);

		return response()->json(array('data'=>$data['operation']['hour']), 200);
	}
	/**************************************************************************************
 		Search
 	**************************************************************************************/
	public function search(Request $request){
// dd($request);
		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

		//Set Hyperlink
		$page = $this->page;

		//Set Page Sub
		$page['sub'] .= '.list.sub';

		//Set Breadcrumb
		$data['title'] = array($this->header['category'],$this->header['module'],$this->header['sub']);

		$day = Carbon::parse($request->date)->format('l');
		$duration = Carbon::parse($request->time)->addHour($request->duration)->minute(0)->format('H:i');
// dd(Carbon::parse($request->time));
		// dd(Carbon::now()->addHours(6)->format('H:i'));
		// dd(Carbon::parse($request->time)->addHour($request->duration)->minute(0)->format('H:i'));
		//Get Model
		$model['slot']['available'] = new OperationHour();

		//Get Data
		$data['slot']['available'] = $model['slot']['available']->checkAvailableThatDate(
			[
				'column'=>[
					'date'=>$request->date,
					'day_id'=>$day,
					'duration'=>$duration

				]
			]
		);
// dd(	$data['slot']['available'] );
		//Return View
		return view($this->route_link['view'].'search.index',compact('data','page','hyperlink'));

  }

	/**************************************************************************************
 		View
 	**************************************************************************************/
	public function view(Request $request){

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;
// dd($hyperlink);
		//Set Hyperlink
		$page = $this->page;

		//Set Breadcrumb
		$data['title'] = array($this->header['category']);

		//Get Model
		$model['venue'] = new Venue();
		$model['operation']['hour'] = new OperationHour();
		$model['equipment']['ball'] = new EquipmentBall();
		$model['equipment']['racquet'] = new EquipmentRacquet();

		//Get Data
		$data['venue'] = $model['venue']->viewSelected(
			[
				'column'=>[
					'id'=>$request->venue_id
				]
			]
		);

		$data['operation']['hour'] = $model['operation']['hour']->viewSelected(
			[
				'column'=>[
					'id'=>$request->operation_hour_id
				]
			]
		);

		$data['equipment']['ball'] = $model['equipment']['ball']->selectBox();
		$data['equipment']['racquet'] = $model['equipment']['racquet']->selectBox();


// dd($data['venue']);
		// $data['check'] = $model['event']->checkBooking(
		// 	[
		// 		'column'=>$request->route('id')
		// 	]
		// );

		//Return View
		return view($this->route_link['view'].'view.index',compact('data','page','hyperlink'));

  }

}
