<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Employee\Equipment\Racquet;

//Get Auth
use Auth;

//Get Database
use DB;

//Get Timestamp
use Carbon\Carbon;

//Controller Helper
use App\Http\Controllers\Controller;

//Model
use App\Models\DCS\MYSQL\Table\Sport;
use App\Models\DCS\MYSQL\Table\EquipmentRacquet;

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
		'module'=>'Equipment',
		'sub'=>'Ball',
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
		$this->route_link['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.equipment.racquet.';

    //Set Route Name
    $this->route_link['name'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.equipment.racquet.';

		//Set Image Route
		$this->asset['images'] = '/images/'.$this->application.'/modules/dashboard/'.$this->user.'/pages/equipment/racquet/';

    //Set Navigation
		$this->hyperlink['navigation'] = $this->navigation['hyperlink'];

		//Set Hyperlink
		$this->hyperlink['page']['new'] = $this->route_link['name'].'new';
		$this->hyperlink['page']['create'] = $this->route_link['name'].'create';
    $this->hyperlink['page']['list'] = $this->route_link['name'].'list';
    $this->hyperlink['page']['delete'] = $this->route_link['name'].'delete';
    $this->hyperlink['page']['view'] = $this->route_link['name'].'view';
    $this->hyperlink['page']['update'] = $this->route_link['name'].'update';
	}

  /**************************************************************************************
 		New
 	**************************************************************************************/
	public function new(Request $request){

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

    //Get Model
		$model['sport'] = new Sport();

    //Get Data
    $data['sport'] = $model['sport']->selectBox();

		//Set Breadcrumb
		$data['title'] = array($this->header['category'],$this->header['module'],$this->header['sub'],'New');

		//Return View
		return view($this->route_link['view'].'new.index',compact('data','hyperlink'));

  }

  /**************************************************************************************
 		List
 	**************************************************************************************/
	public function create(Request $request){

    //Validate
    $validated = $request->validate(
      [
        'sport_id'=>['required'],
        'name'=>['required'],
        'quantity'=>['required'],
        'amount'=>['required'],
        'status'=>['required'],
      ],
      [
        'sport_id.required'=>'Please Select Your Sport ID',
        'name.required'=>'Please Enter Name',
        'quantity.required'=>'Please Enter Your Quantity',
        'amount.required'=>'Please Enter Your Amount',
        'status.required'=>'Please Select Status',
      ]
    );

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

		//Get Model
		$model['equipment']['racquet'] = new EquipmentRacquet();

    //Set Model
    $model['equipment']['racquet']->name = $request->name;
    $model['equipment']['racquet']->sport_id = $request->sport_id;
    $model['equipment']['racquet']->quantity = $request->quantity;
    $model['equipment']['racquet']->amount = $request->amount;
    $model['equipment']['racquet']->status = $request->status;
    $model['equipment']['racquet']->created_by = Auth::id();
    $model['equipment']['racquet']->created_at = Carbon::now();
    $model['equipment']['racquet']->save();

    //If Failed
    if(!$model['equipment']['racquet']){

      //Return Redirect Success
      return redirect()->route($hyperlink['page']['new'])
                       ->with('alert_type','error')
                       ->with('message','Create Data Failed');


    }

    //Return Redirect Success
    return redirect()->route($hyperlink['page']['list'])
                     ->with('alert_type','success')
                     ->with('message','Data Created');


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
    $data['title'] = array($this->header['category'],$this->header['module'],$this->header['sub']);

		//Get Model
    $model['equipment']['racquet'] = new EquipmentRacquet();

    //Get Data
    $data['main'] = $model['equipment']['racquet']->getList();

		//Return View
		return view($this->route_link['view'].'list.index',compact('data','hyperlink'));

  }

  /**************************************************************************************
 		Delete
 	**************************************************************************************/
	public function delete(Request $request){

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

    //Get Model
    $model['equipment']['racquet'] = new EquipmentRacquet();

    //Get Data
    $data['main'] = $model['equipment']['racquet']::find($request->id);

    //If Data Not Found
    if(!$data['main']){
      abort(404);
    }

    //Delete Data
    $data['main']->delete();

    //Return Redirect Success
    return redirect()->route($hyperlink['page']['list'])
                     ->with('alert_type','success')
                     ->with('message','Data Deleted');


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
    $data['title'] = array($this->header['category'],$this->header['module'],$this->header['sub'],'View',$request->route('id'));

    //Get Model
    $model['sport'] = new Sport();
    $model['equipment']['racquet'] = new EquipmentRacquet();

    //Get Data
    $data['sport'] = $model['sport']->selectBox();
    $data['main'] = $model['equipment']['racquet']::find($request->route('id'));
// dd($data['main']);
    //If Data Not Found
    if(!$data['main']){
      abort(404);
    }

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

    //Get Model
    $model['equipment']['racquet'] = new EquipmentRacquet();

    //Get Data
    $data['main'] = $model['equipment']['racquet']::find($request->id);
// dd($data['main'],$request->id);
    //If Data Not Found
    if(!$data['main']){
      abort(404);
    }

    //Validate
    $validated = $request->validate(
      [
        'sport_id'=>['required'],
        'name'=>['required'],
        'quantity'=>['required'],
        'amount'=>['required'],
        'status'=>['required'],
      ],
      [
        'sport_id.required'=>'Please Select Your Sport ID',
        'name.required'=>'Please Enter Name',
        'quantity.required'=>'Please Enter Your Quantity',
        'amount.required'=>'Please Enter Your Amount',
        'status.required'=>'Please Select Status',
      ]
    );

    //Set Model
    $data['main']->sport_id = $request->sport_id;
    $data['main']->name = $request->name;
    $data['main']->quantity = $request->quantity;
    $data['main']->amount = $request->amount;
    $data['main']->status = $request->status;
    $data['main']->updated_by = Auth::id();
    $data['main']->updated_at = Carbon::now();
    $data['main']->save();

    //If Failed
    if(!$data['main']){

      //Return Redirect Success
      return redirect()->route($hyperlink['page']['view'],$request->id)
                       ->with('alert_type','error')
                       ->with('message','Update Data Failed');

    }

    //Return Redirect Success
    return redirect()->route($hyperlink['page']['view'],$request->id)
                     ->with('alert_type','success')
                     ->with('message','Data Update');


  }

}
