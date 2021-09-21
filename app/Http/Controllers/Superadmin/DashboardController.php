<?php
namespace App\Http\Controllers\Superadmin;

use App\Models\User;
use App\Models\Admin;
use App\Models\Contact;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Contracts\Cache\Factory;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
       
        $pageConfigs = ['navbarLarge' => false];

        $admin= Cache::remember('admincache', 22*60, function () {
           return Admin::select('id','status')->get(); 
        });

        
        $user= Cache::remember('usercache', 22*60, function () {
            return User::select('id','status')->get(); 
        });
      
       
        $contact= Cache::remember('contactcache', 22*60, function () {
            return Contact::select('id','status')->get();
        });

    

  

       return view('superadmin.dashboard',['pageConfigs' => $pageConfigs], compact('admin','user','contact'));
    }

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
