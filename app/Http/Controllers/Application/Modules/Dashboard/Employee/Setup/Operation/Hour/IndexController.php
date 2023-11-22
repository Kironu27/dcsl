<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Employee\Setup\Operation\Hour;

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
		'module'=>'Setup',
		'sub'=>'Operation Hour',
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
		$this->route_link['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.setup.operation.hour.';

    //Set Route Name
    $this->route_link['name'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.setup.operation.hour.';

		//Set Image Route
		$this->asset['images'] = '/images/'.$this->application.'/modules/dashboard/'.$this->user.'/pages/operation/hour/';

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
        'operation_hour_id'=>['required','unique:operation_hour,operation_hour_id'],
        'day_id'=>['required'],
        'time'=>['required'],
        'status'=>['required'],
      ],
      [
        'operation_hour_id.required'=>'Please Enter Your Operation Hour ID',
        'operation_hour_id.unique'=>'Code Already Taken For This Operation Hour',
        'day_id.required'=>'Please Select Your Day',
        'time.required'=>'Please Enter Your Time',
        'status.required'=>'Please Select Status',
      ]
    );

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

		//Get Model
		$model['operation']['hour'] = new OperationHour();

    //Set Model
    $model['operation']['hour']->operation_hour_id = $request->operation_hour_id;
    $model['operation']['hour']->day_id = $request->day_id;
    $model['operation']['hour']->time = Carbon::parse($request->time)->addSecond(0)->format('H:i:s');
    $model['operation']['hour']->status = $request->status;
    $model['operation']['hour']->created_by = Auth::id();
    $model['operation']['hour']->created_at = Carbon::now();
    $model['operation']['hour']->save();

    //If Failed
    if(!$model['operation']['hour']){

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
		$model['operation']['hour'] = new OperationHour();

    //Get Data
    $data['main'] = $model['operation']['hour']->getList();

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
    $model['operation']['hour'] = new OperationHour();

    $array = explode('_', $request->id);

    //Get Data
    $data['main'] = $model['operation']['hour']::where('operation_hour_id',$array[0])
                                               ->where('day_id',$array[1])
                                               ->first();
    //If Data Not Found
    if(!$data['main']){
      abort(404);
    }

    //Get Data
    $data['main'] = $model['operation']['hour']::where('operation_hour_id',$array[0])
                                               ->where('day_id',$array[1])
                                               ->delete();


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
    $model['operation']['hour'] = new OperationHour();

    //Get Data
    $array = explode('_', $request->id);

    //Get Data
    $data['main'] = $model['operation']['hour']::where('operation_hour_id',$array[0])
                                               ->where('day_id',$array[1])
                                               ->first();
// dd($data['main']->sport_id);
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
    $model['operation']['hour'] = new OperationHour();

    //Get Data
    //Get Data
    $array = explode('_', $request->id);
// dd($array);
    //Get Data
    $data['main'] = $model['operation']['hour']::where('operation_hour_id',$array[0])
                                               ->where('day_id',$array[1])
                                               ->first();

    //If Data Not Found
    if(!$data['main']){
      abort(404);
    }

    //Validate
    $validated = $request->validate(
      [
        'day_id'=>['required'],
        'time'=>['required'],
        'status'=>['required'],
      ],
      [
        'day_id.required'=>'Please Select Your Day',
        'time.required'=>'Please Enter Your Time',
        'status.required'=>'Please Select Status',
      ]
    );

    //Set Model
    $data['main']->day_id = $request->day_id;
    $data['main']->time = $request->time;
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
