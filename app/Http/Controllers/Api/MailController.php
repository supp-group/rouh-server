<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
//use App\Providers\MailConfigServiceProvider;
use Illuminate\Http\Request; 
use DB;
//use Config;
use Mail;
use  App\Mail\VerifyEmail;
use App;
class MailController extends Controller
{
    public function viewForm()
    {
        return view('mail.add');
    }

    public function create(Request $request)
    {
     
   
    }

    public function sendMail($mailTo )
    {
        $mailTo = "najyms@gmail.com";
        $app = App::getInstance();
        $app->register('App\Providers\MailConfigServiceProvider');
        $bcc="support@oras.orasweb.com";
        Mail::to( $mailTo)->bcc($bcc)->send(new VerifyEmail( ));
      
/*
        Mail::send(array(),array(), function($message) use ($content,$mailTo)
        {
            $message->to($mailTo)
                    ->subject('Test Dynamic SMTP Config')
                    ->from(Config::get('mail.from.address'),Config::get('mail.from.name'))
                    //->setBody($content);
                    ->html($content);
           
            echo 'Mail Sent Successfully';
        });
        */
    }
}
