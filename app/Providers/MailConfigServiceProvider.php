<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
    use DB;
    use Config;
    use Mail;
    

class MailConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        
           
        $config = array(
            'driver'     => 'smtp',
            'host'       => 'mail.oras.orasweb.com',
            'port'       => '587',
            'from'       => array('address' =>'support@oras.orasweb.com', 'name' => 'rouh-app'),
            'encryption' => '',
            'username'   => 'support@oras.orasweb.com',
            'password'   => '[vOxZJbSHfwB',
            'sendmail'   => '/usr/sbin/sendmail -bs',
            'pretend'    => false,
            'timeout' => null,
            'local_domain' => env('MAIL_EHLO_DOMAIN'),
            'verify_peer' => false, // <== This is needed here
        );
        Config::set('mail', $config);   
    }
    /*
    public function register(): void
    {
        $mail = DB::table('mail')->first();
            if ($mail) {
                $config = array(
                    'driver'     => $mail->driver,
                    'host'       => $mail->host,
                    'port'       => $mail->port,
                    'from'       => array('address' => $mail->from_address, 'name' => $mail->from_name),
                    'encryption' => $mail->encryption,
                    'username'   => $mail->username,
                    'password'   => $mail->password,
                    'sendmail'   => '/usr/sbin/sendmail -bs',
                    'pretend'    => false,
                );
                Config::set('mail', $config);
            }
    }
    */
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
   
    }
}
