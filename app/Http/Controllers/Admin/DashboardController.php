<?php

namespace App\Http\Controllers\Admin;
use notifications;
use App\Models\User;
use App\Models\Admin;
use App\Models\Contact;
use App\Models\Smssent;
use App\Models\Complain;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Exports\Customerexcelform;
use Kamaln7\Toastr\Facades\Toastr;
use App\Models\Medicineinformation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;

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


    public function customerexcel(){
        
        $pageConfigs = ['navbarLarge' => false];
        
        return view('admin.excel.customerimporter',['pageConfigs' => $pageConfigs]); 
    }

    public function makecusomerexcelform(Request $request){
    
         return  Excel::download(new Customerexcelform($request),'customer.xlsx');

                       return Redirect::to('admin/customerexcelform'); 
            }

}
