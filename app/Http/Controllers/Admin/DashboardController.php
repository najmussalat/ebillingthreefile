<?php

namespace App\Http\Controllers\Admin;
use notifications;
use App\Models\User;
use App\Models\Admin;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\Medicineinformation;
use App\Http\Controllers\Controller;
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

            $admin= Admin::whereid(Auth::id())->select('id','status')->get(); 
      
            $user=User::whereadmin_id(Auth::id())->select('admin_id','id','status')->get(); 
       
      
        $contact= Contact::whereadmin_id(Auth::id())->select('admin_id','id','status')->get();
     

       
     
       
    
  
   

       return view('admin.dashboard',['pageConfigs' => $pageConfigs], compact('admin','user','contact'));
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
