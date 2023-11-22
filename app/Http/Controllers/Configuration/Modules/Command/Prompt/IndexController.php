<?php

//Get Controller Path
namespace App\Http\Controllers\Configuration\Modules\Command\Prompt;

//Controller Helper
use App\Http\Controllers\Controller;

//Get Artisan
Use Artisan;

//Get Request
use Illuminate\Http\Request;

//Get Class
class IndexController extends Controller{

	//Path Header
	protected $header = [
		'category'=>'configuration',
		'module'=>'command',
		'sub'=>'prompt',
		'gate'=>''
	];

	//View Path
	protected $view;

	//Hyperlink
  public $hyperlink;

	/**************************************************************************************
		Route Path
	**************************************************************************************/
	public function routePath(){

		//Set View
		$this->view = config('routing.configuration.modules.view').'.command.prompt.';

		//Set Hyperlink
		$this->hyperlink['page']['route']['list'] = config('routing.configuration.modules.name').'.route.list';
		$this->hyperlink['page']['home'] = config('routing.application.modules.landing.dcs.name').'.home';
		$this->hyperlink['ajax']['configuration'] = config('routing.configuration.modules.name').'.ajax.configuration.by.type';

	}

	/**************************************************************************************
 		Index
 	**************************************************************************************/
	public function index(Request $request){

		//Get Route Path
    $this->routePath();

		//Set Hyperlink
    $hyperlink = $this->hyperlink;

		//Return View
		return view($this->view.'index',compact('hyperlink'));

  }

}
