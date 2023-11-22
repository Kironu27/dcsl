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
use App\Models\DCS\MYSQL\Table\Customer;

//Get Request
use Illuminate\Http\Request;

//Get Rule
use Illuminate\Validation\Rule;

//Get Class
class CustomerController extends Controller{

	//Application
  protected $application = 'application';

  //User
  protected $user = 'employee';

	//Path Header
	protected $header = [
		'category'=>'Dashboard',
		'module'=>'Manage',
		'sub'=>'Customer',
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
		$this->route_link['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.manage.customer.';

    //Set Route Name
    $this->route_link['name'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.manage.customer.';

		//Set Image Route
		$this->asset['images'] = '/images/'.$this->application.'/modules/dashboard/'.$this->user.'/pages/customer/';

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
        'dob'=>['required','before:-18 years'],
        'gender'=>['required'],
        'email'=>['required','email','unique:customer,email'],
        'contact_no'=>['required'],
      ],
      [
        // 'name.required'=>'Please Enter Your Name',
        'dob.required'=>'Please Enter Your Date of Birth',
        'dob.before'=>'Date of Birth Must Be After 15 Years',
        'dob.after'=>'Date of Birth Must Be Before 18 Years',
        'gender.required'=>'Please Select Your Gender',
        'email.required'=>'Please Enter Your Email',
        'email.email'=>'Email Address Invalid',
        'email.unique'=>'Email Address Exist',
        'contact_no.required'=>'Please Enter Your Contact No',
      ]
    );

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

		//Get Model
		$model['customer'] = new Customer();
// dd(Carbon::parse($request->dob)->format('Ymd'));
    //Set Model
    $model['customer']->name = $request->name;
    $model['customer']->dob = $request->dob;
    $model['customer']->gender = $request->gender;
    $model['customer']->email = $request->email;
    // $model['customer']->verification_code = $data['main']['code'];
    $model['customer']->password = Hash::make(Carbon::parse($request->dob)->format('Ymd'));
    $model['customer']->contact_no = $request->contact_no;
    $model['customer']->status = 'active';
    $model['customer']->created_by = Auth::id();
    $model['customer']->created_at = Carbon::now();
    $model['customer']->save();

    //If Failed
    if(!$model['customer']){

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
		$model['customer'] = new Customer();

    //Get Data
    $data['main'] = $model['customer']->getList();
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
    $model['customer'] = new Customer();

    //Get Data
    $data['main'] = $model['customer']::find($request->id);
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
    $model['customer'] = new Customer();

    //Get Data
    $data['main'] = $model['customer']::find($request->route('id'));
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
        'dob'=>['required','before:-18 years'],
        'gender'=>['required'],
        'email'=>['required','email',Rule::unique('customer')->ignore($request->id, 'customer_id')],
        'contact_no'=>['required'],
      ],
      [
        // 'name.required'=>'Please Enter Your Name',
        'dob.required'=>'Please Enter Your Date of Birth',
        'dob.before'=>'Date of Birth Must Be After 15 Years',
        'dob.after'=>'Date of Birth Must Be Before 18 Years',
        'gender.required'=>'Please Select Your Gender',
        'email.required'=>'Please Enter Your Email',
        'email.email'=>'Email Address Invalid',
        'email.unique'=>'Email Address Exist',
        'contact_no.required'=>'Please Enter Your Contact No',
      ]
    );

    //Get Model
    $model['customer'] = new Customer();

    //Get Data
    $data['main'] = $model['customer']::find($request->id);

    //If Data Not Found
    if(!$data['main']){
      abort(404);
    }

    //Set Model
    $data['main']->name = $request->name;
    $data['main']->dob = $request->dob;
    $data['main']->gender = $request->gender;
    $data['main']->email = $request->email;
    // $model['customer']->verification_code = $data['main']['code'];
    $data['main']->contact_no = $request->contact_no;
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
