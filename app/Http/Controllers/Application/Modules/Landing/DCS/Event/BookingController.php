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

//Get Mail
use Mail;
use App\Mail\Payment\PaymentCode;

//Model
use App\Models\DCS\MYSQL\Table\OperationHour;
use App\Models\DCS\MYSQL\Table\Venue;
use App\Models\DCS\MYSQL\Table\Customer;
use App\Models\DCS\MYSQL\Table\Booking;
use App\Models\DCS\MYSQL\Table\BookingPayment;
use App\Models\DCS\MYSQL\Table\EquipmentBall;
use App\Models\DCS\MYSQL\Table\EquipmentRacquet;
use App\Models\DCS\MYSQL\Table\PaymentType;
use App\Models\DCS\MYSQL\Table\PaymentNetwork;
use App\Models\DCS\MYSQL\Table\PaymentOnlineBanking;

//Get Request
use Illuminate\Http\Request;

//Get Class
class BookingController extends Controller{

	//Path Header
	protected $header = [
		'category'=>'Landing',
		'module'=>'Event',
		'sub'=>'Booking',
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
		$this->hyperlink['page']['booking']['confirmation'] = $this->route_link['name'].'booking.confirmation';
		$this->hyperlink['page']['booking']['process'] = $this->route_link['name'].'booking.process';
		$this->hyperlink['page']['booking']['authorization'] = $this->route_link['name'].'booking.process.authorization';
		$this->hyperlink['page']['payment'] = $this->route_link['name'].'booking.payment';
		$this->hyperlink['page']['resent'] = $this->route_link['name'].'booking.resent.code';
		$this->hyperlink['page']['booking']['receipt'] = $this->route_link['name'].'booking.receipt';
		$this->hyperlink['page']['login'] = config('routing.application.modules.dashboard.customer.name').'.authorization.login';


		// $this->hyperlink['page']['book'] = $this->route_link['name'].'book';
		// $this->hyperlink['page']['check'] = $this->route_link['name'].'check';
		// $this->hyperlink['page']['process'] = $this->route_link['name'].'process';
		// $this->hyperlink['page']['receipt'] = $this->route_link['name'].'receipt';
		// $this->hyperlink['page']['login'] = config('routing.application.modules.dashboard.customer.name').'.authorization.login';

	}

	/**************************************************************************************
 		Booking Authorization
 	**************************************************************************************/
	public function authorization(Request $request){
// dd($request);
		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

		//Set Page
		$page = $this->page;

		//Set Breadcrumb
		$data['title'] = array($this->header['category']);

		//Check Validation Request
		$validate = $request->validate(
		    [
		        'date' => ['required'],
		        'operation_hour_id' => ['required'],
		        'venue_id' => ['required'],
		        'gear_needed' => ['required', 'in:yes,no'],
		        'racquet' => [
		            function ($attribute, $value, $fail) use ($request) {
		                if ($request->input('gear_needed') == 'yes' && $value == null && $request->input('shuttlecock') == null) {
		                    $fail('If gear is needed, either Racquet or Shuttlecock must be selected.');
		                }
		            },
		        ],
		        'shuttlecock' => [
		            function ($attribute, $value, $fail) use ($request) {
		                if ($request->input('gear_needed') == 'yes' && $value == null && $request->input('racquet') == null) {
		                    $fail('If gear is needed, either Racquet or Shuttlecock must be selected.');
		                }
		            },
		        ],
		    ],
		    [
		        'date.required' => 'Date Required',
		        'operation_hour_id.required' => 'Operation Hour Required',
		        'venue_id.required' => 'Venue required',
		        'gear_needed.required' => 'Gear Needed Required',
		        'gear_needed.in' => 'Gear Needed Must be either "yes" or "no"',
		        'racquet.required' => 'Either Racquet or Shuttlecock must be selected if gear is needed.',
		        'shuttlecock.required' => 'Either Racquet or Shuttlecock must be selected if gear is needed.',
		    ]
		);

		//Set Session Guard
		$request->session()->put('temporary.date',$request->date);
		$request->session()->put('temporary.operation_hour_id',$request->operation_hour_id);
		$request->session()->put('temporary.venue_id',$request->venue_id);
		$request->session()->put('temporary.gear_needed',$request->gear_needed);
		$request->session()->put('temporary.racquet',$request->racquet);
		$request->session()->put('temporary.shuttlecock',$request->shuttlecock);
		$request->session()->put('temporary.duration',$request->duration);

		if(Auth::guard('employee')->check()){

			//Return Redirect Error
			return redirect()->route($hyperlink['page']['view'])
											 ->with('alert_type','error')
											 ->with('message','Employee Should Not Be Booked. Sorry');

		}

// dd(1);
		if(Auth::guard('customer')->check()){

			//Return Redirect Login
			return redirect()->route($hyperlink['page']['booking']['confirmation']);

		}else{



			//Return Redirect Login
			return redirect()->route($hyperlink['page']['login'])
											 ->with('form_redirect','yes');

		}

  }

	/**************************************************************************************
 		Check
 	**************************************************************************************/
	public function confirmation(Request $request){

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

		//Set Page
		$page = $this->page;

		//Set Breadcrumb
		$data['title'] = array($this->header['category']);

		//Get Model
		$model['venue'] = new Venue();
		$model['operation']['hour'] = new OperationHour();
		$model['equipment']['ball'] = new EquipmentBall();
		$model['equipment']['racquet'] = new EquipmentRacquet();
		$model['payment']['type'] = new PaymentType();
		$model['payment']['network'] = new PaymentNetwork();
		$model['payment']['online']['banking'] = new PaymentOnlineBanking();
// dd($request->session()->all());
		//Get Data
		$data['venue'] = $model['venue']->viewSelected(
			[
				'column'=>[
					'id'=>$request->session()->get('temporary.venue_id')
				]
			]
		);

		// dd(session()->get('temporary.venue_id'));

		$data['operation']['hour'] = $model['operation']['hour']->viewSelected(
			[
				'column'=>[
					'id'=>$request->session()->get('temporary.operation_hour_id')
				]
			]
		);
// dd($request->session()->get('temporary.racquet'));
		$data['equipment']['racquet'] = $model['equipment']['racquet']->viewSelected(
			[
				'column'=>[
					'id'=>$request->session()->get('temporary.racquet')
				]
			]
		);
		// dd($data['equipment']['racquet']);
		$data['equipment']['ball'] = $model['equipment']['ball']->viewSelected(
			[
				'column'=>[
					'id'=>$request->session()->get('temporary.shuttlecock')
				]
			]
		);

		$data['payment']['type'] = $model['payment']['type']->selectBox();
		$data['payment']['online']['banking'] = $model['payment']['online']['banking']->selectBox();
		$data['payment']['network'] = $model['payment']['network']->selectBox();

		//Return View
		return view($this->route_link['view'].'booking.confirmation',compact('data','page','hyperlink'));


  }

	/**************************************************************************************
 		Process Authorization
 	**************************************************************************************/
	public function processAuthorization(Request $request){

		// dd(Auth::guard('customer')->user()->email);

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

		//Set Page
		$page = $this->page;

		// dd(32);
		//Set Breadcrumb
		$data['title'] = array($this->header['category']);

		//Generate Six Digit Code
    $data['main']['code'] = rand(100000, 999999);

		$request->session()->put('temporary.payment_option',$request->payment_option);
		$request->session()->put('temporary.payment_network_id',$request->payment_network_id);
		$request->session()->put('temporary.card_no',$request->card_no);
		$request->session()->put('temporary.card_name',$request->card_name);
		$request->session()->put('temporary.ccv',$request->ccv);
		$request->session()->put('temporary.date_expired',$request->date_expired);
		$request->session()->put('temporary.payment_online_banking_id',$request->payment_online_banking_id);
		$request->session()->put('temporary.total_amount',$request->total_amount);

    //Get Model
		$model['customer'] = new Customer();

    //Get Customer ID
    $data['user'] = $model['customer']::find(Auth::guard('customer')->id());

    $data['user']->payment_code = $data['main']['code'];
    $data['user']->save();

    $data['main']['name'] = $data['user']->name;
    //Send Email
    Mail::to(Auth::guard('customer')->user()->email)->send(new PaymentCode($data));

		// Session::flash('message', 'We Have Sent You The Code. Check Your Email');

		//Return View
		return view($this->route_link['view'].'booking.identification',compact('data','page','hyperlink'));

    // //Return Redirect Success
    // return redirect()->route($hyperlink['page']['payment_verification'])
    //                  ->with('alert_type','success')
    //                  ->with('message','We Have Resent. Check Your Email for Latest Verification Code');

  }

	/**************************************************************************************
 		Resent Payment Code
 	**************************************************************************************/
	public function resent(Request $request){

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

		//Set Page
		$page = $this->page;

		// dd(32);

		//Generate Six Digit Code
    $data['main']['code'] = rand(100000, 999999);
// dd(Auth::guard('customer')->id());
    //Get Model
		$model['customer'] = new Customer();
// dd($request->id);
    //Get Customer ID
    $data['user'] = $model['customer']::find(Auth::guard('customer')->id());

    $data['user']->payment_code = $data['main']['code'];
    $data['user']->save();

    $data['main']['name'] = $data['user']->name;
    //Send Email
    Mail::to(Auth::guard('customer')->user()->email)->send(new PaymentCode($data));

    //Return Redirect Success
    return redirect()->route($hyperlink['page']['booking']['authorization'])
                     ->with('alert_type','success')
                     ->with('message','We Have Resent. Check Your Email for Latest Payment Code');

  }

	/**************************************************************************************
 		Payment
 	**************************************************************************************/
	public function payment(Request $request){

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

		//Set Page
		$page = $this->page;

		//Validate
    $validated = $request->validate(
      [
        'payment_code'=>['required'],
      ],
      [
        // 'name.required'=>'Please Enter Your Name',
        'payment_code.required'=>'Please Enter Your Payment Code',
      ]
    );

		//Get Model
    $model['customer'] = new Customer();

    //Get Customer ID
    $data['main'] = $model['customer']::find(Auth::guard('customer')->id());

    //If User Not Exist
    if(!$data['main']){

      //Return Redirect Success
      return redirect()->route($hyperlink['page']['booking']['authorization'])
                       ->with('alert_type','error')
                       ->with('message','User Not Exist');
    }

    //If Verification Code Not Exist
    if($request->payment_code != $data['main']->payment_code){

      //Return Redirect Success
      return redirect()->route($hyperlink['page']['booking']['authorization'])
                       ->with('alert_type','error')
                       ->with('message','Invalid Verification Code');

    }

		// dd($request->session()->get('temporary'));

		$model['operation']['hour'] = new OperationHour();
		$data['operation']['hour'] = $model['operation']['hour']->viewSelected(
			[
				'column'=>[
					'id'=>$request->session()->get('temporary.operation_hour_id')
				]
			]
		);
// dd($request->session()->get('temporary.date'));
		$group_id = (
			Carbon::parse($request->session()->get('temporary.date'))->format('ymd')
			.'_'.
			$data['operation']['hour']->operation_hour_id
			.'_'.
			$request->session()->get('temporary.venue_id')
			.'_'.
			Auth::guard('customer')->id()
		);
		// dd(Carbon::parse($request->session()->get('temporary.date')->format('ymd')));
		// $group_id = (Carbon::parse($request->session()->get('temporary.date')->format('ymd')+'_'+$data['operation']['hour']->operation_hour_id+'_'+$request->session()->get('temporary.venue_id')+'_'+Auth::guard('customer')->id()));
// dd($request->session()->get('temporary.duration'));

		for($x = 0;$x < $request->session()->get('temporary.duration');$x++){

			// echo (Carbon::parse( $data['operation']['hour']->time)->addHour($x)->minute(0)->second(0)->format('H:i:s'));
			$model['booking'] = new Booking();

			$model['booking']->venue_id = $request->session()->get('temporary.venue_id');
			$model['booking']->customer_id = Auth::guard('customer')->id();
			$model['booking']->booking_date = $request->session()->get('temporary.date');
			$model['booking']->group_id = $group_id;
			$model['booking']->booking_time = Carbon::parse( $data['operation']['hour']->time)->addHour($x)->minute(0)->second(0)->format('H:i:s');
			// $model['booking']->booking_time = $data['operation']['hour']->time;
			$model['booking']->booking_duration = $request->session()->get('temporary.duration');
			$model['booking']->gear_needed = (($request->session()->get('temporary.gear_needed') == 'no')?0:1);
			$model['booking']->racquet = $request->session()->get('temporary.racquet');
			$model['booking']->shuttlecock = $request->session()->get('temporary.shuttlecock');
			$model['booking']->status = 'booked';
			$model['booking']->created_by = Auth::guard('customer')->id();
			$model['booking']->created_at = Carbon::now();
			$model['booking']->save();
// echo $x;echo '<br>';
			// code...
		}
// dd(99);


		//Get Last ID
    $last_id = $model['booking']->booking_id;
		//
		$model['payment'] = new BookingPayment();
		$model['payment']->booking_id = $last_id;
		$model['payment']->group_id = $group_id;
		$model['payment']->payment_type_id = $request->session()->get('temporary.payment_option');
		$model['payment']->credit_card_name = $request->session()->get('temporary.card_name');
		$model['payment']->credit_card_number = $request->session()->get('temporary.card_no');
		$model['payment']->ccv = $request->session()->get('temporary.ccv');
		$model['payment']->credit_card_date_expired = $request->session()->get('temporary.date_expired');
		$model['payment']->bank_id = $request->session()->get('temporary.payment_online_banking_id');
		$model['payment']->price = $request->session()->get('temporary.total_amount');
		$model['payment']->status = 'paid';
		$model['payment']->created_by = Auth::guard('customer')->id();
		$model['payment']->created_at = Carbon::now();
		$model['payment']->save();

		$payment_id = $model['payment']->payment_id;

		$request->session()->put('temporary.payment_id',$payment_id);

		//Return Redirect Success
		return redirect()->route($hyperlink['page']['booking']['receipt'])
										 ->with('alert_type','success')
										 ->with('message','Booking Payment Success');

  }

	/**************************************************************************************
 		Receipt
 	**************************************************************************************/
	public function receipt(Request $request){

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

		//Set Page
		$page = $this->page;

		//Set Breadcrumb
		$data['title'] = array($this->header['category']);

		//Get Model
		$model['venue'] = new Venue();
		$model['operation']['hour'] = new OperationHour();
		$model['equipment']['ball'] = new EquipmentBall();
		$model['equipment']['racquet'] = new EquipmentRacquet();
		$model['payment']['type'] = new PaymentType();
		$model['payment']['network'] = new PaymentNetwork();
		$model['payment']['online']['banking'] = new PaymentOnlineBanking();

		//Get Data
		$data['venue'] = $model['venue']->viewSelected(
			[
				'column'=>[
					'id'=>$request->session()->get('temporary.venue_id')
				]
			]
		);

		$data['operation']['hour'] = $model['operation']['hour']->viewSelected(
			[
				'column'=>[
					'id'=>$request->session()->get('temporary.operation_hour_id')
				]
			]
		);

		$data['equipment']['racquet'] = $model['equipment']['racquet']->viewSelected(
			[
				'column'=>[
					'id'=>$request->session()->get('temporary.racquet')
				]
			]
		);
		// dd($data['equipment']['racquet']);
		$data['equipment']['ball'] = $model['equipment']['ball']->viewSelected(
			[
				'column'=>[
					'id'=>$request->session()->get('temporary.shuttlecock')
				]
			]
		);

		$data['payment']['type'] = $model['payment']['type']->selectBox();
		$data['payment']['online']['banking'] = $model['payment']['online']['banking']->selectBox();
		$data['payment']['network'] = $model['payment']['network']->selectBox();
		//Return View
		return view($this->route_link['view'].'booking.receipt',compact('data','page','hyperlink'));
dd(32);
		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

		//Set Page
		$page = $this->page;

		//Set Breadcrumb
		$data['title'] = array('Receipt');

		//Get Model
		$model['booking'] = new Booking();

		//Get Data
		$data['main'] = $model['booking']->viewSelected(
			[
				'column'=>[
					'booking_id'=>$request->route('id')
				]
			]
		);

		//Return View
		return view($this->route_link['view'].'receipt.index',compact('data','page','hyperlink'));

	}


}
