<?php

namespace App\Notifications;

use App\Models\Smssent;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SmsNotification extends Notification
{
    use Queueable;
    private $data;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
       $smsinfo=$data;
       //dd($smsinfo);
       $smssetting=Smssent::whereadmin_id(Auth::id())->firstOrFail();
         
             $text= str_replace(['#USERNAME#', '#EXPIRY_DATE#','#CUSTOMER_ID#'], [$smsinfo['name'], $smsinfo['id'],$smsinfo['id']], $smssetting->billingmessage);
      
    
       if($smsinfo['type']=='newcustomer' && $smssetting->newcustomer==1){
       // $number=$smsinfo->phone;
        $number='01739898764';
      $dataall= array(
        'username'=>"mtshoes",
        'password'=>"76PCMA9D",
        'number'=>"$number",
        'message'=>"$text"
        );
  
    $url = "http://66.45.237.70/api.php";
        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($dataall));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $smsresult = curl_exec($ch);
        $p = explode("|",$smsresult);
        $sendstatus = $p[0];

    }
}
public function via($notifiable)
{
    return ['database'];
}

}
