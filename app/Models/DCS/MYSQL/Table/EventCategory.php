<?php

//Get Model Path
namespace App\Models\YouthNited\MYSQL\Table;

//Get Notifiable
use Illuminate\Notifications\Notifiable;

//Get User Authenticatable
use Illuminate\Database\Eloquent\Model;

//Get Database
use DB;

//Get Class
class EventCategory extends Model{

  //Use Notify
  use Notifiable;

  //Table Name
  protected $table = 'event_category';

  //Set Incrementing
  public $incrementing = true;

  //Set Timestamp
  public $timestamps = false;

  //Primary Key
  protected $primaryKey = 'event_category_id';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

  //Column
  protected $fillable = [
    'event_category_id',
    'name',
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
                                                  $this->table.'.event_category_id AS event_category_id',
                                                  $this->table.'.name AS name',
                                                  $this->table.'.status AS status',
                                                )
                                              ->where($this->table.'.status','active')
                                              ->get()
                                              ->toarray();

    //Return Result
    return $result;

  }

  public function getList($data = null){

    //Get Query
    $result = DB::connection($this->connection)->table($this->table);

    //Get Result
    $result = $result->select(
                        $this->table.'.event_category_id AS event_category_id',
                        $this->table.'.name AS name',
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
