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
class BookingPayment extends Model{

  //Use Notify
  use Notifiable;

  //Table Name
  protected $table = 'booking_payment';

  //Set Incrementing
  public $incrementing = true;

  //Set Timestamp
  public $timestamps = false;

  //Primary Key
  protected $primaryKey = 'payment_id';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

  //Column
  protected $fillable = [
    'payment_id',
    'booking_id',
    'group_id',
    'payment_type_id',
    'bank_id',
    'credit_card_name',
    'credit_card_number',
    'ccv',
    'credit_card_date_expired',
    'price',
    'status',
    'created_by',
    'created_at',
    'updated_by',
    'updated_at'
  ];

}
