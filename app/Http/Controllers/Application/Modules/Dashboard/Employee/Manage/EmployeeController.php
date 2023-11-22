<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Employee\Manage;

//Get Auth
use Auth;

//Get Timestamp
use Carbon\Carbon;

//Get Database
use DB;

//Controller Helper
use App\Http\Controllers\Controller;

//Get Hash
use Hash;

//Model
use App\Models\DCS\MYSQL\Table\Employee;

//Get Request
use Illuminate\Http\Request;

//Get Rule
use Illuminate\Validation\Rule;

//Get Class
class EmployeeController extends Controller{

	//Application
  protected $application = 'application';

  //User
  protected $user = 'employee';

	//Path Header
	protected $header = [
		'category'=>'Dashboard',
		'module'=>'Manage',
		'sub'=>'Employee',
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
		$this->route_link['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.manage.employee.';

    //Set Route Name
    $this->route_link['name'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.manage.employee.';

		//Set Image Route
		$this->asset['images'] = '/images/'.$this->application.'/modules/dashboard/'.$this->user.'/pages/employee/';

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
        'email'=>['required','email','unique:customer,email'],
        'role'=>['required'],
        'status'=>['required'],
      ],
      [
        // 'name.required'=>'Please Enter Your Name',
        'name.required'=>'Please Enter Your Name',
        'email.required'=>'Please Enter Your Email',
        'email.email'=>'Email Address Invalid',
        'email.unique'=>'Email Address Exist',
        'role.required'=>'Please Select Role',
        'status.required'=>'Please Select Status',
      ]
    );

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

		//Get Model
		$model['employee'] = new Employee();
// dd(Carbon::parse($request->dob)->format('Ymd'));
    //Set Model
    $model['employee']->name = $request->name;
    $model['employee']->role = $request->role;
    $model['employee']->email = $request->email;
    $model['employee']->password = Hash::make(Carbon::parse($request->dob)->format('Ymd'));
    $model['employee']->status = 'active';
    $model['employee']->created_by = Auth::id();
    $model['employee']->created_at = Carbon::now();
    $model['employee']->save();

    //If Failed
    if(!$model['employee']){

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
		$model['employee'] = new Employee();

    //Get Data
    $data['main'] = $model['employee']->getList();
// dd($data);
// dd($this->route_link['view'].'list.index');
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
    $model['employee'] = new Employee();

    //Get Data
    $data['main'] = $model['employee']::find($request->id);
// dd($data['main']);
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
    $model['employee'] = new Employee();

    //Get Data
    $data['main'] = $model['employee']::find($request->route('id'));
// dd(1);
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
// dd($request->id);
    //Validate

    //Validate
    $validated = $request->validate(
      [
        'name'=>['required'],
        'email'=>['required','email',Rule::unique('employee')->ignore($request->id, 'employee_id')],
        'role'=>['required'],
        'status'=>['required'],
      ],
      [
        // 'name.required'=>'Please Enter Your Name',
        'name.required'=>'Please Enter Your Name',
        'email.required'=>'Please Enter Your Email',
        'email.email'=>'Email Address Invalid',
        'email.unique'=>'Email Address Exist',
        'role.required'=>'Please Select Role',
        'status.required'=>'Please Select Status',
      ]
    );

    //Get Model
    $model['employee'] = new Employee();

    //Get Data
    $data['main'] = $model['employee']::find($request->id);

    //If Data Not Found
    if(!$data['main']){
      abort(404);
    }

    //Set Model
    $data['main']->name = $request->name;
    $data['main']->role = $request->role;
    $data['main']->email = $request->email;
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
