<?php

//Get Model Path
namespace App\Models\DCS\MYSQL\Table;

//Get User Authenticatable
use Illuminate\Database\Eloquent\Model;

//Get Database
use DB;

//Get Class
class PaymentOnlineBanking extends Model{

  //Table Name
  protected $table = 'payment_online_banking';

  //Set Incrementing
  public $incrementing = false;

  //Set Timestamp
  public $timestamps = false;

  //Primary Key
  protected $primaryKey = 'payment_online_banking_id';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

  //Column
  protected $fillable = [
    'payment_online_banking_id',
    'category',
    'name',
    'display_name',
    'status',
    'remark',
    'created_by',
    'created_at',
    'updated_by',
    'updated_at',
    'deleted_by',
    'deleted_at'
  ];

  public function selectBox($data = null){

    //Get Query
    $result = DB::connection($this->connection)->table($this->table)
                                               ->select(
                                                  $this->table.'.payment_online_banking_id AS payment_online_banking_id',
                                                  $this->table.'.category AS category',
                                                  $this->table.'.name AS name',
                                                  $this->table.'.display_name AS display_name',
                                                  $this->table.'.status AS status',
                                                )
                                              ->where($this->table.'.status','active')
                                              ->get()
                                              ->toarray();

    //Return Result
    return $result;

  }


}
