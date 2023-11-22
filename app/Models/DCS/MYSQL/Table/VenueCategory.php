<?php

//Get Model Path
namespace App\Models\DCS\MYSQL\Table;

//Get Auth
use Auth;

//Get Notifiable
use Illuminate\Notifications\Notifiable;

//Get User Authenticatable
use Illuminate\Database\Eloquent\Model;

//Get Database
use DB;

//Get Class
class VenueCategory extends Model{

  //Use Notify
  use Notifiable;

  //Table Name
  protected $table = 'venue_category';

  //Set Incrementing
  public $incrementing = false;

  //Set Timestamp
  public $timestamps = false;

  //Primary Key
  protected $primaryKey = 'venue_category_id';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

  //Column
  protected $fillable = [
    'venue_category_id',
    'name',
    'status',
    'created_at',
    'created_by',
    'updated_by',
    'updated_at',
  ];

  public function selectBox($data = null){

    //Get Query
    $result = DB::connection($this->connection)->table($this->table)
                                               ->select(
                                                  $this->table.'.venue_category_id AS venue_category_id',
                                                  $this->table.'.name AS name',
                                                 )
                                               ->where($this->table.'.status','active');

    //Get Result
    $result = $result->get()
                     ->toarray();

    //Return Result
    return $result;

  }

  public function getList($data = null){

    //Get Query
    $result = DB::connection($this->connection)->table($this->table);

    //Get Result
    $result = $result->select(
                        $this->table.'.venue_category_id AS venue_category_id',
                        $this->table.'.name AS name',
                        $this->table.'.status AS status'
                      );

      //Return Result
      $result = $result->get()
                       ->toarray();

    //Return Result
    return $result;

  }

  public function viewSelected($data){

    //Get Query
    $result = DB::connection($this->connection)->table($this->table);

    //Get Result
    $result = $result->select(
                        $this->table.'.venue_category_id AS venue_category_id',
                        $this->table.'.name AS name',
                        $this->table.'.status AS status',
                        $this->table.'.created_by AS created_by',
                        $this->table.'.created_at AS created_at',
                        $this->table.'.updated_by AS updated_by',
                        $this->table.'.updated_at AS updated_at'
                      )
                    ->first();

    //Return Result
    return $result;

  }

  /**************************************************************************************
    Check Exist
  **************************************************************************************/
  public function checkExist($data){
// dd($data);
    //Get Count
    $result = DB::connection($this->connection)->table($this->table)
                                               ->select($this->table.'.venue_category_id')
                                               ->where($this->table.'.venue_category_id',$data['column']['venue_category_id']);

    //Check Type For Soft and Hard Delete
    if(isset($data['type']) != null && $data['type'] == 'check_status'){$result = $result->where($this->table.'.status','deleted');}

    //Get Count Result
    $result = $result->count();

    //Return Result
    return $result;

  }



}
