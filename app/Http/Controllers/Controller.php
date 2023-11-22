<?php

//Get Controller Path
namespace App\Http\Controllers;

//DispatchesJobs
use Illuminate\Foundation\Bus\DispatchesJobs;

//Routing Controller
use Illuminate\Routing\Controller as BaseController;

//Validate Request
use Illuminate\Foundation\Validation\ValidatesRequests;

//Authorize Request
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

//Get Request
use Illuminate\Http\Request;

//Model
//use App\Http\Models\Dashboard\Module\Home\SystemSetting;
// use App\Http\Models\Dashboard\Module\Home\MainSetting;
// use App\Http\Models\Dashboard\Module\Home\Module;

//Get Session
use Auth;

//Get Carbon
use Carbon\Carbon;

//Get Database
use DB;

//Get Helpers
use App\Http\Helpers\Token;

//Get Model
use App\Models\DCS\MYSQL\Table\Booking;

//Get Session
use Session;

//Get Class
class Controller extends BaseController{

  //Use AuthorizesRequests, DispatchesJobs, ValidatesRequests
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  //Set Encrypt Token Form
  protected $encrypt_token_form;

  //Set Encrypter
  protected $encrypter;

  //Set Encrypter
  protected $setting;

  //Set Database Name
  protected $database_name;

  //Set Navigation
  protected $navigation;

  /**************************************************************************************
    Construct
  **************************************************************************************/
  public function __construct(Request $request){

    //Get Model
    $model['booking'] = new Booking();

    //Get Data
    $data['booking'] = $model['booking']::where('booking_date', '<', now()->toDateString())
                                        ->update(['status' => 'expired']);


    //Get Token
    $token = new Token();

    //Set Encrypt Token Form
    $this->encrypt_token_form = $token->encrypt;

    //Set Encrypter
    $this->encrypter = $token->encrypter;

    //Get Navigation
    $this->navigation();

    //Check Authorization Code
    if(session()->has('authorization_code')){

      $guard = $this->encrypter->decrypt(session()->get('authorization_token'));

      \Config::set('database.connections.mysql.database',$this->encrypter->decrypt(session()->get('authorization_code')));

      //Get Guard
      switch($guard){

        //Student
        case 'student':

          //Model
          // $model['setting'] = new \App\Http\Models\IUKL\MYSQL\Table\Setting();
          //
          // //Get Data
          // $this->setting['pagination'] = $model['setting']->getPagination();

        break;

        //Student Franchise
        case 'student_franchise':

          //Model
          // $model['setting'] = new \App\Http\Models\Franchise\MYSQL\Table\Setting();
          //
          // //Get Data
          // $this->setting['pagination'] = $model['setting']->getPagination();

        break;

        default:
          // code...
        break;

      }

    }

  }

  /**************************************************************************************
    Navigation
  **************************************************************************************/
  public function navigation(){

    //Set Navigation
    $this->navigation = [
      'hyperlink'=>[

        'header'=>[
          'home'=>config('routing.application.modules.landing.dcs.name').'.home',
          'about'=>config('routing.application.modules.landing.dcs.name').'.about',
          'contact'=>config('routing.application.modules.landing.dcs.name').'.contact',
          'login_option'=>config('routing.application.modules.landing.dcs.name').'.login.option',
          'register'=>config('routing.application.modules.dashboard.customer.name').'.authorization.register'
        ],
        'authorization'=>[
          'employee'=>[
            'login'=>config('routing.application.modules.dashboard.employee.name').'.authorization.login',
            'forgot'=>config('routing.application.modules.dashboard.employee.name').'.authorization.forgot',
            'home'=>config('routing.application.modules.dashboard.employee.name').'.home',
            'header'=>[
              'account'=>[
                'avatar'=>config('routing.application.modules.dashboard.employee.name').'.account.avatar.view',
                'profile'=>config('routing.application.modules.dashboard.employee.name').'.account.profile.view',
                'change_password'=>config('routing.application.modules.dashboard.employee.name').'.account.change_password.view',
                'logout'=>config('routing.application.modules.dashboard.employee.name').'.authorization.logout'
              ]
            ],
            'panel'=>[
                'home'=>config('routing.application.modules.dashboard.employee.name').'.home',
                'manage'=>[
                  'announcement'=>config('routing.application.modules.dashboard.employee.name').'.manage.announcement.list',
                  'customer'=>config('routing.application.modules.dashboard.employee.name').'.manage.customer.list',
                  'employee'=>config('routing.application.modules.dashboard.employee.name').'.manage.employee.list',
                ],
                'setup'=>[
                  'sport'=>config('routing.application.modules.dashboard.employee.name').'.setup.sport.list',
                  'operation_hour'=>config('routing.application.modules.dashboard.employee.name').'.setup.operation.hour.list',
                  'venue'=>config('routing.application.modules.dashboard.employee.name').'.setup.venue.category.list',
                  'venue_category'=>config('routing.application.modules.dashboard.employee.name').'.setup.venue.home.list'
                ],
                'venue'=>[
                  'booking'=>[
                    'today'=>config('routing.application.modules.dashboard.employee.name').'.venue.booking.today.list',
                    'upcoming'=>config('routing.application.modules.dashboard.employee.name').'.venue.booking.upcoming.list',
                    'previous'=>config('routing.application.modules.dashboard.employee.name').'.venue.booking.previous.list',
                  ]
                ],
                'equipment'=>[
                  'ball'=>config('routing.application.modules.dashboard.employee.name').'.equipment.ball.list',
                  'racquet'=>config('routing.application.modules.dashboard.employee.name').'.equipment.racquet.list'
                ]
            ]
          ],

          'customer'=>[
            'login'=>config('routing.application.modules.dashboard.customer.name').'.authorization.login',
            'forgot'=>config('routing.application.modules.dashboard.customer.name').'.authorization.forgot',
            'register'=>config('routing.application.modules.dashboard.customer.name').'.authorization.register',
            'home'=>config('routing.application.modules.dashboard.customer.name').'.home',
            'header'=>[
              'account'=>[
                'avatar'=>config('routing.application.modules.dashboard.customer.name').'.account.avatar.view',
                'profile'=>config('routing.application.modules.dashboard.customer.name').'.account.profile.view',
                'change_password'=>config('routing.application.modules.dashboard.customer.name').'.account.change_password.view',
                'logout'=>config('routing.application.modules.dashboard.customer.name').'.authorization.logout'
              ]
            ],
            'panel'=>[
                'home'=>config('routing.application.modules.dashboard.customer.name').'.home',
                'account'=>[
                  'avatar'=>config('routing.application.modules.dashboard.customer.name').'.account.avatar.view',
                  'profile'=>config('routing.application.modules.dashboard.customer.name').'.account.profile.view',
                  'change_password'=>config('routing.application.modules.dashboard.customer.name').'.account.change_password.view',
                ],
                'booking'=>[
                  'active'=>config('routing.application.modules.dashboard.customer.name').'.booking.active.list',
                  'history'=>config('routing.application.modules.dashboard.customer.name').'.booking.history.list'
                ],
            ]
          ],

        ],

        'social'=>[
          'facebook'=>'#',
          'twitter'=>'#',
          'dribbble'=>'#',
          'behance'=>'#',
        ]
      ]
    ];

  }

  /**************************************************************************************
    Check Browser
  **************************************************************************************/
  public function checkBrowser(){

    $browser = [];

    $browser['application'] = ['Opera','Edg','Chrome','Safari','Firefox','MSIE','Trident'];

    $agent = $_SERVER['HTTP_USER_AGENT'];

    foreach ($browser['application'] as $web_browser) {
        if (strpos($agent, $web_browser) !== false) {
            $browser['user']['application'] = $web_browser;
            break;
        }
    }

    //Get Browser User Application
    switch ($browser['user']['application']){

      case 'MSIE':
          $browser['user']['application_name'] = 'Internet Explorer';
      break;

      case 'Trident':
        $browser['user']['application_name'] = 'Internet Explorer';
      break;

      case 'Edg':
        $browser['user']['application_name'] = 'Microsoft Edge';
      break;

    }

    //Return Browser
    return $browser;

    echo "You are using ".$browser['user']['application_name']." browser";


  }

  /**************************************************************************************
    Set Connection
  **************************************************************************************/
  public function setConnection($data){
// dd(env('DB_USERNAME'));
    //Set Mysql Connection
    \Config::set('database.connections.mysql', [
        'driver' => 'mysql',
        'host' => env('DB_HOST'),
        'database' => $data,
        'username' => env('DB_USERNAME'),
        'password' => env('DB_PASSWORD')
    ]);

    //Database Purge
    DB::purge('mysql');

    //Database Reconnect
    DB::reconnect('mysql');

  }

  /**************************************************************************************
    Encryption Data
  **************************************************************************************/
  public function encryptionData($data){

		//Password Encrypt Key
		$encrypt['key'] = 'Y0u7NiTeD';

    //Set Algorithm
		$encrypt['algorithm'] = 'AES-128-ECB';

		/*********************************************************************************
			Student Encryption
		*********************************************************************************/
		//String to Encrypt
		$encrypt['data'] = $data['encrypt'];

		//Encrypt Level One
		$encrypt['level_one'] = openssl_encrypt($encrypt['data'],$encrypt['algorithm'],$encrypt['key']);

		//Encrypt Level Two
		$encrypt['level_two'] = base64_encode($encrypt['level_one']);

		//Get Result
		$result = $encrypt['level_two'];

		//Return Result
		return $result;

	}

}
