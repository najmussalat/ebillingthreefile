<?php

namespace App\Http\Controllers\Admin;
use notifications;
use App\Models\User;
use App\Models\Admin;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\Medicineinformation;
use App\Http\Controllers\Controller;
use App\Models\Complain;
use App\Models\Customer;
use App\Models\Smssent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
 public function __construct()
    {
        $this->middleware('verified');
    }
    
    public function index()
    { 
       
        $pageConfigs = ['navbarLarge' => false];

           
            $user=User::whereadmin_id(Auth::id())->select('admin_id','id','status')->get(); 
       
      
        $contact= Contact::whereadmin_id(Auth::id())->select('admin_id','id','status')->get();
        $smsinfo= Smssent::whereadmin_id(Auth::id())->select('admin_id','id','blance','smsrate')->first();
        $customer= Customer::whereadmin_id(Auth::id())->select('admin_id','id','status')->get();
        $complain= Complain::whereadmin_id(Auth::id())->select('admin_id','id','status')->get();
     

       return view('admin.dashboard',['pageConfigs' => $pageConfigs], compact('user','contact','smsinfo','customer','complain'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deletenotification()
    {
        $notification=auth()->user()->notifications()->delete();
        if($notification){
          //  $notification->destroy();
            return response()->json(['success'=>true],201);
        }
        else{
            return response()->json(['success'=>false],404);
        }
    }

    public function seennotification(){
        auth()->user()->unreadNotifications->markAsRead();
      return response()->json(['success'=>true],201);
        
        
    }
}
