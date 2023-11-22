<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Landing\DCS\About;

//Get Database
use DB;

//Get Timestamp
use Carbon\Carbon;

//Controller Helper
use App\Http\Controllers\Controller;

//Get Request
use Illuminate\Http\Request;

//Get Class
class IndexController extends Controller{

	//Path Header
	protected $header = [
		'category'=>'Home',
		'module'=>'About',
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
		$this->route_link['view'] = config('routing.application.modules.landing.dcs.view').'.about.';

		//Set Page
		$this->page['sub'] = $this->route_link['view'].'sub.';

		//Set Navigation
		$this->hyperlink['navigation'] = $this->navigation['hyperlink'];

	}

	/**************************************************************************************
 		Index
 	**************************************************************************************/
	public function index(Request $request){

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

		//Set Hyperlink
		$page = $this->page;

		//Set Breadcrumb
		$data['title'] = array($this->header['category'],$this->header['module']);

		//Return View
		return view($this->route_link['view'].'index',compact('data','page','hyperlink'));

  }

}
