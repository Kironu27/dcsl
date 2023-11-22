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
class Bank extends Model{

  //Use Notify
  use Notifiable;

  //Table Name
  protected $table = 'bank';

  //Set Incrementing
  public $incrementing = false;

  //Set Timestamp
  public $timestamps = false;

  //Primary Key
  protected $primaryKey = 'bank_id';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

  //Column
  protected $fillable = [
    'bank_id',
    'category',
    'name',
    'display_name',
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
                                                  $this->table.'.bank_id AS bank_id',
                                                  $this->table.'.category AS category',
                                                  $this->table.'.name AS name',
                                                  $this->table.'.display_name AS display_name',
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

}
