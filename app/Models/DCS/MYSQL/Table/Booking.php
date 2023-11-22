<?php

//Get Model Path
namespace App\Models\DCS\MYSQL\Table;

//Get Auth
use Auth;

//Get Carbon
use Carbon\Carbon;

//Get Database
use DB;

//Get User Authenticatable
use Illuminate\Database\Eloquent\Model;



//Get Class
class Booking extends Model{

  //Table Name
  protected $table = 'booking';

  //Set Incrementing
  public $incrementing = true;

  //Set Timestamp
  public $timestamps = false;

  //Primary Key
  protected $primaryKey = 'booking_id';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

  //Column
  protected $fillable = [
    'booking_id',
    'venue_id',
    'customer_id',
    'booking_date',
    'booking_time',
    'booking_duration',
    'gear_needed',
    'racquet',
    'group_id',
    'shuttlecock',
    'status',
    'created_by',
    'created_at',
    'updated_by',
    'updated_at'
  ];

  public function getList2($data = null){
// dd(Carbon::now()->format('Y-m-d'));
    //Get Query
    $result = DB::connection($this->connection)->table($this->table);

    //Get Result
    $result = $result->select(
                        $this->table.'.booking_id AS booking_id',
                        $this->table.'.group_id AS group_id',
                        $this->table.'.venue_id AS venue_id',
                        $this->table.'.booking_date AS booking_date',
                        $this->table.'.booking_time AS booking_time',
                        $this->table.'.booking_duration AS booking_duration',
                        $this->table.'.gear_needed AS gear_needed',
                        $this->table.'.racquet AS racquet',
                        $this->table.'.shuttlecock AS shuttlecock',
                        $this->table.'.customer_id AS customer_id',
                        $this->table.'.status AS status',
                        $this->table.'.created_by AS created_by',
                        $this->table.'.created_at AS created_at',
                        'venue.name AS venue_name',
                       )
                     ->leftJoin('venue','venue.venue_id','=',$this->table.'.venue_id');
    if(isset($data['category']) && $data['category'] != null){

      switch ($data['category']) {
        case 'today':
          $result = $result->whereIn($this->table.'.status',['booked','active'])
                           ->where($this->table.'.booking_date',Carbon::now()->format('Y-m-d'));
        break;

        case 'previous':
          $result = $result->whereDate($this->table.'.booking_date', '<', Carbon::now()->toDateString());
        break;

        case 'upcoming':

        $result = $result->whereDate($this->table.'.booking_date', '>', Carbon::now()->toDateString());

        break;

        default:
          // code...
          break;
      }


    }
    //Check Filter
    if(isset($data['column']['customer_id']) && $data['column']['customer_id'] != NULL){$result = $result->where($this->table.'.customer_id',$data['column']['customer_id']);}
    if(isset($data['column']['status']) && $data['column']['status'] != NULL){
      if($data['column']['status'] == 'active'){
        $result = $result->whereIn($this->table.'.status',['booked','active']);
      }else{
        $result = $result->where($this->table.'.status',$data['column']['status']);
      }

    }


    $result = $result->groupBy($this->table.'.group_id');
// print_r($result->toSql());exit();
    //Return Result
    $result = $result->get()
                     ->toarray();

    //Return Result
    return $result;

  }

  public function getList($data = null){

    // dd($data);

    //Get Query
    $result = DB::connection($this->connection)->table($this->table);

    //Get Result
    $result = $result->select(
                        $this->table.'.booking_id AS booking_id',
                        $this->table.'.group_id AS group_id',
                        $this->table.'.venue_id AS venue_id',
                        $this->table.'.booking_date AS booking_date',
                        $this->table.'.booking_time AS booking_time',
                        $this->table.'.booking_duration AS booking_duration',
                        $this->table.'.gear_needed AS gear_needed',
                        $this->table.'.racquet AS racquet',
                        $this->table.'.shuttlecock AS shuttlecock',
                        $this->table.'.customer_id AS customer_id',
                        $this->table.'.status AS status',
                        $this->table.'.created_by AS created_by',
                        $this->table.'.created_at AS created_at',
                        'venue.name AS venue_name',
                       )
                     ->leftJoin('venue','venue.venue_id','=',$this->table.'.venue_id');

    //Check Filter
    if(isset($data['column']['customer_id']) && $data['column']['customer_id'] != NULL){$result = $result->where($this->table.'.customer_id',$data['column']['customer_id']);}
    if(isset($data['column']['status']) && $data['column']['status'] != NULL){
      if($data['column']['status'] == 'active'){
        $result = $result->whereIn($this->table.'.status',['booked','active']);
      }else{
        $result = $result->where($this->table.'.status',$data['column']['status']);
      }

    }

    // $result = $result->groupBy($this->table.'.group_id');
// print_r($result->toSql());exit();
    //Return Result
    $result = $result->get()
                     ->toarray();
                     // dd($result);

    //Return Result
    return $result;

  }

  public function viewSelected($data){

    //Get Query
    $result = DB::connection($this->connection)->table($this->table);

    //Get Query
    $result = $result->select(
                        $this->table.'.booking_id AS booking_id',
                        $this->table.'.group_id AS group_id',
                        $this->table.'.venue_id AS venue_id',
                        $this->table.'.booking_date AS booking_date',
                        $this->table.'.booking_time AS booking_time',
                        $this->table.'.booking_duration AS booking_duration',
                        $this->table.'.gear_needed AS gear_needed',
                        $this->table.'.racquet AS racquet',
                        $this->table.'.shuttlecock AS shuttlecock',
                        $this->table.'.customer_id AS customer_id',
                        $this->table.'.status AS status',
                        $this->table.'.created_by AS created_by',
                        $this->table.'.created_at AS created_at',
                        'venue.name AS venue_name',
                        'venue.venue_category_id AS venue_category_id',
                        'venue.amount AS venue_amount',
                        'equipment_ball.name as equipment_ball_name',
                        'equipment_ball.type as equipment_ball_type',
                        'equipment_ball.quantity as equipment_ball_quantity',
                        'equipment_ball.amount as equipment_ball_amount',
                        'equipment_racquet.name as equipment_racquet_name',
                        'equipment_racquet.quantity as equipment_racquet_quantity',
                        'equipment_racquet.amount as equipment_racquet_amount',
                        'booking_payment.payment_id AS payment_id',
                        'booking_payment.price AS payment_price',
                       )
                     ->leftJoin('venue','venue.venue_id','=',$this->table.'.venue_id')
                     ->leftJoin('booking_payment','booking_payment.group_id','=',$this->table.'.group_id')
                     ->leftJoin('equipment_ball','equipment_ball.equipment_ball_id','=',$this->table.'.shuttlecock')
                     ->leftJoin('equipment_racquet','equipment_racquet.equipment_racquet_id','=',$this->table.'.racquet');

                     if(isset($data['column']['group_id']) && $data['column']['group_id'] != NULL){$result = $result->where($this->table.'.group_id',$data['column']['group_id']);}
                     if(isset($data['column']['customer_id']) && $data['column']['customer_id'] != NULL){$result = $result->where($this->table.'.customer_id',$data['column']['customer_id']);}
// dd($result->first());
    //Get Result
    $result = $result->first();

    //Return Result
    return $result;

  }

}
