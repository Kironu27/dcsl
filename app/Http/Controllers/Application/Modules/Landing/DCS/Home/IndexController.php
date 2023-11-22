<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Landing\DCS\Home;

//Get Database
use DB;

//Get Timestamp
use Carbon\Carbon;

//Controller Helper
use App\Http\Controllers\Controller;

//Model
use App\Models\DCS\MYSQL\Table\OperationHour;

//Get Request
use Illuminate\Http\Request;

//Get Class
class IndexController extends Controller{

	//Path Header
	protected $header = [
		'category'=>'Home',
		'module'=>'',
		'sub'=>'',
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
		$this->route_link['view'] = config('routing.application.modules.landing.dcs.view').'.home.';

		//Set Page
		$this->page['sub'] = $this->route_link['view'].'sub.';

		//Set Navigation
		$this->hyperlink['navigation'] = $this->navigation['hyperlink'];

		//Set Hyperlink
		$this->hyperlink['page']['search'] = config('routing.application.modules.landing.dcs.name').'.event.search';
		$this->hyperlink['ajax']['get_date_day'] = config('routing.application.modules.landing.dcs.name').'.event.ajax.getdateday';


	}

	/**************************************************************************************
 		Index
 	**************************************************************************************/
	public function index(Request $request){
// dd(\Auth::guard('customer')->check());

// dd(\Auth::getDefaultDriver());
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
		$model['operation']['hour'] = new OperationHour();
		//
		// //Get Data
		$data['operation']['hour'] = $model['operation']['hour']->getOperationHour(
			[
				'category'=>'today'
			]
		);

		//Return View
		return view($this->route_link['view'].'index',compact('data','page','hyperlink'));

  }

}
