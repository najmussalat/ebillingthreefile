<?php

namespace App\Jobs;
use App\Helpers\CommonFx;
use App\Models\Smssent;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class Sendsuersms implements ShouldQueue
{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
protected $data;
 public $timeout = 7200; // 2 hours
    public function __construct($data)
    {
     
        $this->data=$data;
    }

    public function handle()
    {
        $smssetting=Smssent::whereadmin_id($this->data['admin_id'])->firstOrFail();
        if(($smssetting->employee==1) && ($smssetting->blance>1)){
          $text= str_replace(['#CUSTOMER_NAME#','#IP#', '#PPPOE_USERNAME#','#CUSTOMER_MOBILE#','#COMPLAINS#','#COMMENT#','#CUSTOMER_ADDRESS#'], [$this->data['customername'], $this->data['ip'],$this->data['oppusername'],$this->data['customerphone'],$this->data['customercomplain'],$this->data['customercomment'],$this->data['address']], $smssetting->employeemessage);
    
    
            $number=$this->data['number'];
           $dataall= array(
             'username'=>$smssetting->username,
             'password'=>$smssetting->password,
             'number'=>$number,
             'message'=>$text
             );
             $smssetting->blance -=$smssetting->smsrate *(CommonFx::Smscount($text));
             $smssetting->save();


$url = "http://66.45.237.70/api.php";
   $ch = curl_init(); // Initialize cURL
   curl_setopt($ch, CURLOPT_URL,$url);
   curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($dataall));
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   $smsresult = curl_exec($ch);
   $p = explode("|",$smsresult);
   $sendstatus = $p[0];

 
   Log::info($sendstatus);
}

// Log::info((strlen('আমার সোনার')));

}
}