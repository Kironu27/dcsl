<?php

namespace App\Mail\Authorization;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;


//Models
// use App\Models\status_permohonan_user as StatusPermohonanUser;
// use App\Models\User;
// use App\Models\Dean;



//Get Authorization
use Auth;

use View;

//Get Class
class VerificationCode extends Mailable{

  //Get Queue, Serializable
  use Queueable, SerializesModels;

  //Set Encrypt Token Form
  protected $encrypt_token_form;

  //Set Encrypter
  protected $encrypter;

  //Get Mail
  public $mail = [
    'subject'=>'Verification Code',
    'view'=>'application\\mail\\authorization\\'
  ];

  //Get Data
  public $data;

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct($data){

    $this->data = $data;


  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build(Request $request){

    $data = $this->data;

    //Get markdown
    return $this->markdown($this->mail['view'].'.verification_code',compact('data'))
                ->from('no-reply@dcsl.com','Verification Code for Registration')
                // ->to($data['main']->email)
                ->to($request->email)
                ->subject($this->mail['subject']);

    // dd($this->data);

    // switch($data['category']){
    //
    //   case 'customer':
    //
    //     //Get markdown
    //     return $this->markdown($this->mail['view'].'.index',compact('data'))
    //                 ->from('no-reply@dcsl.com','Authorization Reset Password')
    //                 // ->to($data['main']->email)
    //                 ->to('testingproject62@gmail.com')
    //                 ->subject($this->mail['subject']);
    //
    //   break;
    //
    //   case 'employee':
    //   break;
    //
    // }

  }

}
