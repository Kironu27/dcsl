<?php

//Get Model Path
namespace App\Models\DCS\MYSQL\Table;

//Get User Authenticatable
use Illuminate\Database\Eloquent\Model;

//Get Database
use DB;

//Get Class
class PaymentNetwork extends Model{

  //Table Name
  protected $table = 'payment_network';

  //Set Incrementing
  public $incrementing = false;

  //Set Timestamp
  public $timestamps = false;

  //Primary Key
  protected $primaryKey = 'payment_network_id';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

  //Column
  protected $fillable = [
    'payment_network_id',
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
                                                  $this->table.'.payment_network_id AS payment_network_id',
                                                  $this->table.'.name AS name',
                                                  $this->table.'.status AS status',
                                                )
                                              ->where($this->table.'.status','active')
                                              ->get()
                                              ->toarray();

    //Return Result
    return $result;

  }


}
