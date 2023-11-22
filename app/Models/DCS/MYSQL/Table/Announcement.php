<?php

//Get Model Path
namespace App\Models\DCS\MYSQL\Table;

//Get Notifiable
use Illuminate\Notifications\Notifiable;

//Get User Authenticatable
use Illuminate\Database\Eloquent\Model;

//Get Database
use DB;

//Get Class
class Announcement extends Model{

  //Use Notify
  use Notifiable;

  //Table Name
  protected $table = 'announcement';

  //Set Incrementing
  public $incrementing = true;

  //Set Timestamp
  public $timestamps = false;

  //Primary Key
  protected $primaryKey = 'announcement_id';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

  //Column
  protected $fillable = [
    'announcement_id',
    'title',
    'description',
    'target',
    'status',
    'created_by',
    'created_at',
    'updated_by',
    'updated_at'
  ];

  public function getList($data = null){

    //Get Query
    $result = DB::connection($this->connection)->table($this->table);

    //Get Result
    $result = $result->select(
                        $this->table.'.announcement_id AS announcement_id',
                        $this->table.'.title AS title',
                        $this->table.'.description AS description',
                        $this->table.'.target AS target',
                        $this->table.'.status AS status',
                        $this->table.'.created_by AS created_by',
                        $this->table.'.created_at AS created_at'
                      );

    //Check Status
    if(isset($data['column']['target']) && $data['column']['target'] != NULL){$result = $result->whereIn($this->table.'.target',$data['column']['target']);}
    if(isset($data['column']['status']) && $data['column']['status'] != NULL){$result = $result->where($this->table.'.status',$data['column']['status']);}
// dd($result->toSQL());
    //Return Result
    $result = $result->get()
                     ->toarray();
// dd($result);
    //Return Result
    return $result;

  }

}
