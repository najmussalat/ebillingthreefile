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


class Sendcustomersms implements ShouldQueue
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
       
        $text= str_replace(['#CUSTOMER_NAME#','#CUSTOMER_ID#','#IP#', '#PPPOE_USERNAME#','#COMPANY_NAME#','#COMPANY_MOBILE#','#MONTH#','#BILL_AMOUNT#','#LAST_DAY_OF_PAY_BILL#'], [$this->data['name'], $this->data['id'],$this->data['ip'],$this->data['oppusername'],$this->data['companyname'],$this->data['companynumber'],$this->data['expeirydate'],$this->data['billamount'],$this->data['exmonth']], $this->data['message']);
    
        if($smssetting->blance>1){
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

 
//    Log::info($sendstatus);
}

// Log::info((strlen('আমার সোনার')));

}
}
