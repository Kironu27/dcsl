<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Employee\Manage;

//Get Auth
use Auth;

//Get Database
use DB;

//Get Timestamp
use Carbon\Carbon;

//Controller Helper
use App\Http\Controllers\Controller;

//Model
use App\Models\DCS\MYSQL\Table\Announcement;

//Get Request
use Illuminate\Http\Request;

//Get Class
class AnnouncementController extends Controller{

	//Application
  protected $application = 'application';

  //User
  protected $user = 'employee';

	//Path Header
	protected $header = [
		'category'=>'Dashboard',
		'module'=>'Manage',
		'sub'=>'Announcement',
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
		$this->route_link['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.manage.announcement.';

    //Set Route Name
    $this->route_link['name'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.manage.announcement.';

		//Set Image Route
		$this->asset['images'] = '/images/'.$this->application.'/modules/dashboard/'.$this->user.'/pages/announcement/';

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
        'title'=>['required'],
        'description'=>['required'],
        'status'=>['required'],
      ],
      [
        'title.required'=>'Please Enter Your Title',
        'description.required'=>'Please Enter Your Description',
        'status.required'=>'Please Select Status',
      ]
    );

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

		//Get Model
		$model['announcement'] = new Announcement();

    //Set Model
    $model['announcement']->title = $request->title;
    $model['announcement']->description = $request->description;
    $model['announcement']->target = $request->target;
    $model['announcement']->status = $request->status;
    $model['announcement']->created_by = Auth::id();
    $model['announcement']->created_at = Carbon::now();
    $model['announcement']->save();

    //If Failed
    if(!$model['announcement']){

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
		$model['announcement'] = new Announcement();

    //Get Data
    $data['main'] = $model['announcement']->getList();

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
    $model['announcement'] = new Announcement();

    //Get Data
    $data['main'] = $model['announcement']::find($request->id);

    //If Data Not Found
    if(!$data['main']){
      abort(404);
    }

    //Delete Data
    $data['main']->delete();

    //If Failed
    if(!$data['main']){

      //Return Redirect Success
      return redirect()->route($hyperlink['page']['view'],$request->id)
                       ->with('alert_type','error')
                       ->with('message','Delete Data Failed');

    }

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
    $model['announcement'] = new Announcement();

    //Get Data
    $data['main'] = $model['announcement']::find($request->route('id'));

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
    $model['announcement'] = new Announcement();

    //Get Data
    $data['main'] = $model['announcement']::find($request->id);

    //If Data Not Found
    if(!$data['main']){
      abort(404);
    }

    //Set Model
    $data['main']->title = $request->title;
    $data['main']->description = $request->description;
    $data['main']->target = $request->target;
    $data['main']->status = $request->status;
    $data['main']->created_by = Auth::id();
    $data['main']->created_at = Carbon::now();
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
