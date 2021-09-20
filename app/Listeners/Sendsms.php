<?php

namespace App\Listeners;

use App\Models\Smssent;
use App\Events\SendsmsEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Sendsms implements ShouldQueue
{
   
    use Queueable, SerializesModels;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
       
    }

    /**
     * Handle the event.
     *
     * @param  SendsmsExent  $event
     * @return void
     */
    public function handle(SendsmsEvent $event)
    {
        $smssetting=Smssent::whereadmin_id(Auth::id())->firstOrFail();
          
        $text= 'hi';
 

  if($smssetting){
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
}
