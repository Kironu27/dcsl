<?php // Code within app\Helpers\Helper.php

//Get Helper Path
namespace App\Http\Helpers;

//Routing Controller
use Illuminate\Routing\Controller as BaseController;

//Class Name
class TokenAuthorizationUser{

  //Set Data Transport
  public $data;

  //Set Encrypt
  public $encrypt;
  public $encrypter;

  /**************************************************************************************
    Construct
  **************************************************************************************/
  public function __construct(){

    //Get Encrypter
    $this->encrypter = app('Illuminate\Contracts\Encryption\Encrypter');

    //Create Token
    $this->encrypt['guard']['employee'] = $this->encrypter->encrypt('employee');
    $this->encrypt['guard']['customer']  = $this->encrypter->encrypt('customer');

    //Database
    $this->encrypt['database']['dcs']  = $this->encrypter->encrypt('dcs');

  }

}
