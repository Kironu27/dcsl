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
class OperationHour extends Model{

  //Table Name
  protected $table = 'operation_hour';

  //Set Incrementing
  public $incrementing = true;

  //Set Timestamp
  public $timestamps = false;

  //Primary Key
  protected $primaryKey = 'operation_hour_id';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

  //Column
  protected $fillable = [
    'operation_hour_id',
    'day_id',
    'time',
    'status',
    'created_by',
    'created_at',
    'updated_by',
    'updated_at'
  ];

  public function getList($data = null){
// dd(strtolower(Carbon::now()->format('l')));


    //Get Query
    $result = DB::connection($this->connection)->table($this->table);

    //Get Result
    $result = $result->select(
                        $this->table.'.operation_hour_id AS operation_hour_id',
                        $this->table.'.day_id AS day_id',
                        DB::raw('TIME_FORMAT('.$this->table.'.time,\'%H:%i\') AS time'),
                        $this->table.'.status AS status',
                        $this->table.'.created_by AS created_by',
                        $this->table.'.created_at AS created_at',
                      );
    // print_r($result->tosql());exit();
    //Return Result
    $result = $result->get();

    //Return Result
    return $result;

  }

  public function getOperationHour($data = null){
// dd(strtolower(Carbon::now()->format('l')));


    //Get Query
    $result = DB::connection($this->connection)->table($this->table);

    //Get Result
    $result = $result->select(
                        $this->table.'.operation_hour_id AS operation_hour_id',
                        $this->table.'.day_id AS day_id',
                        DB::raw('TIME_FORMAT('.$this->table.'.time,\'%H:%i\') AS time'),
                        $this->table.'.status AS status',
                        $this->table.'.created_by AS created_by',
                        $this->table.'.created_at AS created_at',
                       )
                     ->where($this->table.'.status','active');
    //Check Booking
    if(isset($data['column']['day_id']) && $data['column']['day_id'] != NULL){$result = $result->where($this->table.'.day_id',$data['column']['day_id']);}
    // print_r($result->tosql());exit();
    //Return Result
    $result = $result->get();

    //Return Result
    return $result;

  }

  public function checkAvailableThatDate($data = null){
// dd(strtolower(Carbon::now()->format('l')));


    //Get Query
    $result = DB::connection($this->connection)->table($this->table);

    //Get Result
    $result = $result->distinct()
                     ->select(
                        'venue.venue_id AS venue_id',
                        'venue.name AS venue_name',
                        'venue.amount AS venue_amount',
                        'venue.venue_category_id AS venue_category',
                        $this->table.'.operation_hour_id AS operation_hour_id',
                        $this->table.'.day_id AS day_id',
                        DB::raw('TIME_FORMAT('.$this->table.'.time,\'%H:%i\') AS time'),
                        $this->table.'.status AS status',
                        $this->table.'.created_by AS created_by',
                        $this->table.'.created_at AS created_at',
                        DB::raw(
                          '
                           IFNULL(
                             (
                                SELECT
                                  booking.customer_id
                                FROM
                                  booking
                                WHERE
                                  booking.booking_date = \''.$data['column']['date'].'\'
                                AND
                                  booking.venue_id = venue.venue_id
                                AND
                                  TIME_FORMAT(booking.booking_time,\'%H:%i\') = TIME_FORMAT('.$this->table.'.time,\'%H:%i\')
                              )
                           ,0) AS customer_id
                          '
                        ),
                        DB::raw(
                          '
                           IFNULL(
                              (
                                SELECT
                                  COUNT(*)
                                FROM
                                  booking
                                WHERE
                                  booking.booking_date = \''.$data['column']['date'].'\'
                                AND
                                    booking.venue_id = venue.venue_id
                                AND
                                  TIME_FORMAT(booking.booking_time,\'%H:%i\') = TIME_FORMAT('.$this->table.'.time,\'%H:%i\')
                              )
                           ,0) AS is_booked
                          '
                        ),
                       )
                     ->crossjoin('venue')
                     ->where($this->table.'.status','active')
                     ->where($this->table.'.day_id',$data['column']['day_id'])
                     ->whereRaw('TIME_FORMAT('.$this->table.'.time,\'%H:%i\') BETWEEN TIME_FORMAT('.$this->table.'.time,\'%H:%i\') AND TIME_FORMAT(ADDTIME( TIME_FORMAT( '.$this->table.'.time, \'%H:%i\' ) , \''.$data['column']['duration'].'\' ), \'%H:%i\')');
                     // ->whereRaw(
                     //   '
                     //    IFNULL(
                     //       (
                     //         SELECT
                     //           COUNT(*)
                     //         FROM
                     //           booking
                     //         WHERE
                     //           booking.booking_date = \''.$data['column']['date'].'\'
                     //         AND
                     //             booking.venue_id = venue.venue_id
                     //         AND
                     //           TIME_FORMAT(booking.booking_time,\'%H:%i\') = TIME_FORMAT('.$this->table.'.time,\'%H:%i\')
                     //       )
                     //    ,0) = 0
                     //   '
                     // );
                     // ->groupBy('');
                     // AND
// dd($data);
    // print_r($result->tosql());exit();
    //Return Result
    $result = $result->get();

    //Return Result
    return $result;

  }

  public function viewSelected($data){

    //Get Query
    $result = DB::connection($this->connection)->table($this->table);

    //Get Result
    $result = $result->select(
                        $this->table.'.operation_hour_id AS operation_hour_id',
                        $this->table.'.day_id AS day_id',
                        $this->table.'.time AS time',
                        $this->table.'.status AS status',
                        $this->table.'.created_by AS created_by',
                        $this->table.'.created_at AS created_at',
                        $this->table.'.updated_by AS updated_by',
                        $this->table.'.updated_at AS updated_at',

                      )
                    ->where($this->table.'.operation_hour_id',$data['column']['id'])
                    ->first();

    //Return Result
    return $result;

  }
  // public function viewSelected($data){
  //
  //   //Get Query
  //   $result = DB::connection($this->connection)->table($this->table)
  //                                              ->select(
  //                                                   $this->table.'.booking_id AS booking_id',
  //                                                   $this->table.'.event_id AS event_id',
  //                                                   $this->table.'.customer_id AS customer_id',
  //                                                   $this->table.'.status AS booking_status',
  //                                                   'event.name AS event_name',
  //                                                   'event_category.name AS event_category_name',
  //                                                   'event.description AS event_description',
  //                                                   'event.price AS event_price',
  //                                                   'event.quota AS event_quota',
  //                                                   'event.date_start AS event_date_start',
  //                                                   'event.date_end AS event_date_end',
  //                                                   'organizer.company_name AS organizer_company_name'
  //                                                )
  //                                              ->leftJoin('event','event.event_id','=',$this->table.'.event_id')
  //                                              ->leftJoin('event_category','event_category.event_category_id','=','event.event_category_id')
  //                                              ->leftJoin('organizer','organizer.organizer_id','=','event.organizer_id')
  //                                              ->leftJoin('booking_payment','booking_payment.booking_id','=',$this->table.'.booking_id');
  //
  //   //Check Booking
  //   if(isset($data['column']['booking_id']) && $data['column']['booking_id'] != NULL){$result = $result->where($this->table.'.booking_id',$data['column']['booking_id']);}
  //
  //   //Get Result
  //   $result = $result->first();
  //
  //   //Return Result
  //   return $result;
  //
  // }

}
