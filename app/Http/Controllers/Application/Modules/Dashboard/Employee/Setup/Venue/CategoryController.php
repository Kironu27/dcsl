<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Employee\Setup\Venue;

//Get Auth
use Auth;

//Get Database
use DB;

//Get Timestamp
use Carbon\Carbon;

//Controller Helper
use App\Http\Controllers\Controller;

//Model
use App\Models\DCS\MYSQL\Table\VenueCategory;

//Get Request
use Illuminate\Http\Request;

//Get Class
class CategoryController extends Controller{

	//Application
  protected $application = 'application';

  //User
  protected $user = 'employee';

	//Path Header
	protected $header = [
		'category'=>'Dashboard',
		'module'=>'Setup',
		'sub'=>'Venue Category',
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
		$this->route_link['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.setup.venue.category.';

    //Set Route Name
    $this->route_link['name'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.setup.venue.category.';

		//Set Image Route
		$this->asset['images'] = '/images/'.$this->application.'/modules/dashboard/'.$this->user.'/pages/setup/venue/category/';

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
        'name'=>['required'],
        'status'=>['required'],
      ],
      [
        'id.unique'=>'Code Already Taken For This Venue Category Code',
        'name.required'=>'Please Enter Your Venue Category Name',
        'status.required'=>'Please Select Status',
      ]
    );

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

		//Get Model
		$model['venue']['category'] = new VenueCategory();

    $check['exist'] = $model['venue']['category']->checkExist(
      [
        'column'=>[
          'venue_category_id'=>str_replace(' ', '_', $request->name)
        ]
      ]
    );

    if($check['exist']){

      //Return Redirect Success
      return redirect()->route($hyperlink['page']['new'])
                       ->with('alert_type','error')
                       ->with('message','Data Exist');

    }
    // dd($check['exist'],str_replace(' ', '_', strtoupper($request->name)) );

    //Set Model
    $model['venue']['category']->venue_category_id = str_replace(' ', '_', strtoupper($request->name));
    $model['venue']['category']->name = $request->name;
    $model['venue']['category']->status = $request->status;
    $model['venue']['category']->created_by = Auth::id();
    $model['venue']['category']->created_at = Carbon::now();
    $model['venue']['category']->save();

    //If Failed
    if(!$model['venue']['category']){

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
		$model['venue']['category'] = new VenueCategory();

    //Get Data
    $data['main'] = $model['venue']['category']->getList();

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
    $model['venue']['category'] = new VenueCategory();

    //Get Data
    $data['main'] = $model['venue']['category']::find($request->id);
    // dd( $data['main']);
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
    $model['venue']['category'] = new VenueCategory();

    //Get Data
    $data['main'] = $model['venue']['category']::find($request->route('id'));
// dd($data['main']->venue_category_id);
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
    $model['venue']['category'] = new VenueCategory();

    //Get Data
    $data['main'] = $model['venue']['category']::find($request->id);

    //If Data Not Found
    if(!$data['main']){
      abort(404);
    }

    //Validate
    $validated = $request->validate(
      [
        'name'=>['required'],
        'status'=>['required'],
      ],
      [
        'name.required'=>'Please Enter Your Sport Name',
        'status.required'=>'Please Select Status',
      ]
    );

    //Set Model
    $data['main']->name = $request->name;
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
