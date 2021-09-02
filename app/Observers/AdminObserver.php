<?php

namespace App\Observers;

use App\Models\Admin;
use App\Models\Superadmin;
use App\Mail\AdmininfoMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use App\Notifications\Superadminnotification;

class AdminObserver
{
    /**
     * Handle the Admin "created" event.
     *
     * @param  \App\Models\Admin  $admin
     * @return void
     */
    public function created(Admin $admin)
    {
        $url = "http://66.45.237.70/api.php";
        $number=$admin->phone;
        $text=("Dear ".$admin->name .', '." Ebill verify OTP ".$admin->otp);
        $data= array(
        'username'=>"mtshoes",
        'password'=>"76PCMA9D",
        'number'=>"$number",
        'message'=>"$text"
        );
        //dd($data); exit;
        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $smsresult = curl_exec($ch);
        $p = explode("|",$smsresult);
        $sendstatus = $p[0];
        $data = [
            'name' => $admin['name'],
            'superadminboady' => $admin['name'].' Want to Admin',
    ];
    $superAdmins = Superadmin::first();

        $superAdmins->notify(new Superadminnotification($data));
    $maildata= array(
             
            'name'=> $admin->name,
            'subject'=>'Verify Your Email',
            'message' => 'Your Request Has Been Submit Succesfully. Please  use the code '. $admin->otp .  ' for email varification or Click the link '  .'<a target="_blank"  href="'. url('/login/adminvarificationlink/'. $admin->email.'/'. $admin->status) . '">Varify Now</a>'. ' .Thank You',
             );
           
              Mail::to($admin)->send(new AdmininfoMail($maildata));
           
    }

    
}
