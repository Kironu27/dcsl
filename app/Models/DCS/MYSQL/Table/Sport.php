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
class Sport extends Model{

  //Use Notify
  use Notifiable;

  //Table Name
  protected $table = 'sport';

  //Set Incrementing
  public $incrementing = false;

  //Set Timestamp
  public $timestamps = false;

  //Primary Key
  protected $primaryKey = 'sport_id';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

  //Column
  protected $fillable = [
    'sport_id',
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
                                                  $this->table.'.sport_id AS sport_id',
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
                        $this->table.'.sport_id AS sport_id',
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
                        $this->table.'.sport_id AS sport_id',
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

}
