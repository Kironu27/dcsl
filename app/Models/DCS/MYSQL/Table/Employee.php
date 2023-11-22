<?php

//Get Model Path
namespace App\Models\DCS\MYSQL\Table;

//Get User Authenticatable
use Illuminate\Foundation\Auth\User as Authenticatable;

//Get Authorization
use Auth;

//Get Carbon
use \Carbon\Carbon;

//Get Database
use DB;

// Get Audit
use OwenIt\Auditing\Contracts\Auditable;

//Get Class
class Employee extends Authenticatable{

  //Table Name
  protected $table = 'employee';

  //Set Incrementing
  public $incrementing = true;

  //Set Timestamp
  public $timestamps = false;

  //Primary Key
  protected $primaryKey = 'employee_id';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

  //Column
  protected $fillable = [
    'employee_id',
    'name',
    'email',
    'contact_no',
    'dob',
    'role',
    'password',
    'status',
    'is_reset',
    'created_by',
    'created_at',
    'updated_by',
    'updated_at'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password'
  ];

  public function viewSelected($data){

    //Get Query
    $result = DB::connection($this->connection)->table($this->table)
                                               ->where($this->table.'.email',$data['column']['email'])
                                               ->first();

    //Return Result
    return $result;

  }

  public function getTotal($data){

    //Get Query
    $result = DB::connection($this->connection)->table($this->table);
// dd(Carbon::now()->format('Y-m-d'));
    //Get Result

   $result = $result->where($this->table.'.status',$data['column']['status']);
// print_r($result->tosql());exit();
  //Check Status
  if(isset($data['category']) && $data['category'] != NULL){
// dd(Carbon::now()->format('Y-m-d'));
    switch($data['category']){
      case 'today':
        $result = $result->select(DB::raw(
                            'IFNULL('.$this->table.'.status,\'active\') AS status'),
                            DB::raw('IFNULL(COUNT(*),0) as total')
                          )
                         ->where(DB::raw('DATE_FORMAT(created_at, \'%Y-%m-%d\')'),Carbon::now()->format('Y-m-d'));
                          // print_r($result->tosql());exit();
        // code...
      break;

      case 'this_month':
        $result = $result->select(
                            DB::raw('IFNULL('.$this->table.'.status,\'active\') AS status'),
                            DB::raw('COUNT(*) as total')
                          )
                         ->where(DB::raw('DATE_FORMAT(created_at, \'%Y-%m\')'),Carbon::now()->format('Y-m'));
// dd($result->get());
                         // print_r($result->tosql());exit();
        // code...
      break;

      default:
        // code...
        break;
    }

  }else{

    $result = $result->select(
                      // DB::raw('DATE_FORMAT(created_at, \'%Y-%m-%d\')'),
                        $this->table.'.status AS status',
                        DB::raw('COUNT(*) as total')
                      );

  }

    $result = $result->groupBy($this->table.'.status')
                     ->first();

    //Return Result
    return $result;

  }

  public function getList($data = null){

    //Get Query
    $result = DB::connection($this->connection)->table($this->table);

    //Get Result
    $result = $result->select(
                        $this->table.'.employee_id AS employee_id',
                        $this->table.'.name AS name',
                        $this->table.'.email AS email',
                        $this->table.'.status AS status',
                        $this->table.'.created_by AS created_by',
                        $this->table.'.created_at AS created_at'
                      );

    //Check Status
    if(isset($data['column']['status']) && $data['column']['status'] != NULL){$result = $result->where($this->table.'.status',$data['column']['status']);}

    //Return Result
    $result = $result->get()
                     ->toarray();

    //Return Result
    return $result;

  }

}
