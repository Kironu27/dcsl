<?php

//Get Model Path
namespace App\Models\DCS\MYSQL\Table;

//Get Auth
use Auth;

//Get User Authenticatable
use Illuminate\Database\Eloquent\Model;

//Get Database
use DB;

//Get Class
class EquipmentBall extends Model{

  //Table Name
  protected $table = 'equipment_ball';

  //Set Incrementing
  public $incrementing = true;

  //Set Timestamp
  public $timestamps = false;

  //Primary Key
  protected $primaryKey = 'equipment_ball_id';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

  //Column
  protected $fillable = [
    'sport_id',
    'equipment_ball_id',
    'name',
    'type',
    'quantity',
    'amount',
    'status',
    'created_by',
    'created_at',
    'updated_by',
    'updated_at'
  ];

  public function selectBox($data = null){

    //Get Query
    $result = DB::connection($this->connection)->table($this->table)
                                               ->select(
                                                  $this->table.'.sport_id AS sport_id',
                                                  $this->table.'.equipment_ball_id AS equipment_ball_id',
                                                  $this->table.'.name AS name',
                                                  $this->table.'.type AS type',
                                                  $this->table.'.quantity AS quantity',
                                                  $this->table.'.amount AS amount',
                                                  $this->table.'.status AS status',
                                                )
                                              ->where($this->table.'.status','active');

    //Check Category
    if(isset($data['column']['category']) && $data['column']['category'] != NULL){$result = $result->where($this->table.'.category',$data['column']['category']);}

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
                        $this->table.'.equipment_ball_id AS equipment_ball_id',
                        $this->table.'.name AS name',
                        $this->table.'.type AS type',
                        $this->table.'.quantity AS quantity',
                        $this->table.'.amount AS amount',
                        $this->table.'.status AS status',
                      )
                      ->leftJoin('sport','sport.sport_id','=',$this->table.'.sport_id')
                      ->orderBy('sport.name','asc')
                      ->orderBy($this->table.'.name','asc');

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
                        $this->table.'.equipment_ball_id AS equipment_ball_id',
                        $this->table.'.name AS name',
                        $this->table.'.type AS type',
                        $this->table.'.quantity AS quantity',
                        $this->table.'.amount AS amount',
                        $this->table.'.status AS status',
                        $this->table.'.created_by AS created_by',
                        $this->table.'.created_at AS created_at',
                        $this->table.'.updated_by AS updated_by',
                        $this->table.'.updated_at AS updated_at',
                      )
                    ->leftJoin('sport','sport.sport_id','=',$this->table.'.sport_id')
                    ->where($this->table.'.equipment_ball_id',$data['column']['id'])
                    ->first();

    //Return Result
    return $result;

  }


}
