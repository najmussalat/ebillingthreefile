<?php

namespace App\Http\Controllers\Admin;

use App\Models\Smssent;
use App\Models\Customer;
use App\Helpers\CommonFx;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Kamaln7\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use App\Notifications\SmsNotification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Contracts\DataTable;
use Illuminate\Support\Facades\Notification;
use Illuminate\Pagination\LengthAwarePaginator;


class SmsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    //and OTC #OTC#  and #PACKAGE#.Account Will Be Active Until #EXPIRY_DATE#. #OTC# = Installation Charge/OTC (One Time Charge)
    $smssetting = Smssent::firstOrCreate(
      ['admin_id' => Auth::guard('admin')->user()->id],
      ['newcustomermessage' => 'Dear #CUSTOMER_NAME# , your ID is: #CUSTOMER_ID# , ip: #IP# , Username : #PPPOE_USERNAME# , password : #PPPOE_PASSWORD# . Enjoy your new connection. Thanks - #COMPANY_NAME#',
      'billingmessage' => 'Dear #CUSTOMER_NAME# , Your #MONTH# s bill is #BILL_AMOUNT# Tk. Your id #CUSTOMER_ID# . Please pay before #LAST_DAY_OF_PAY_BILL# . Thanks - #COMPANY_NAME#',
      'paymentmessage' => 'Dear #CUSTOMER_NAME# , We got #AMOUNT# Tk. for #IP_OR_USER_NAME_OR_ID# . Your Due #DUE_AMOUNT# Tk. Thanks -#COMPANY_NAME#',
      'openticketmessage' => 'Hello #CUSTOMER_NAME# , Your complain is: #COMPLAINS# , #COMMENT# just arised. Our stuff #EMPLOYEE_NAME# , #EMPLOYEE_MOBILE# will contact with you soon. - Thanks, #COMPANY_NAME# , #COMPANY_MOBILE# .',
      'assignticketmessage' => 'New Complain for #CUSTOMER_NAME# , IP: #IP# , PPPoE Username : #PPPOE_USERNAME# , Mob : #CUSTOMER_MOBILE# , Complain : #COMPLAINS# , Comment : #COMMENT# , Address : #CUSTOMER_ADDRESS# . Solve it quickly.',
      'updateticketmessage' => 'Ticket  #TKTNO# Update:  topic #TOPIC# . #TKT_MSG# ',
      'closeticketmessage' => 'Dear #CUSTOMER_NAME# , Your problem has been resolved. If needed give us a call #COMPANY_MOBILE# . - Thanks, #COMPANY_NAME# .',
      'employeemessage' => 'New Complain for {CUSTOMER_NAME}, IP: {IP}, PPPoE Username : {PPPOE_USERNAME}, Mob : {CUSTOMER_MOBILE}, Complain : {COMPLAINS}, Comment : {COMMENT}, Address : {CUSTOMER_ADDRESS}. Solve it quickly',
      'problemmessage' => 'Dear #CUSTOMER_NAME# , thanks for being with us. Your ID is #CUSTOMER_ID# , IP #IP# , PPPoE Username #PPPOE_USERNAME# . If you have any query let us know. - #COMPANY_NAME# , #COMPANY_MOBILE# --or-- Your #MONTH# s bill is #BILL_AMOUNT# Tk. Please pay before #LAST_DAY_OF_PAY_BILL# . - #COMPANY_NAME# , #COMPANY_MOBILE#'
    
    ],


    );
    $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];
    return view('admin.smsmessage.index')->with('pageConfigs', $pageConfigs)->with('smsmessage', $smssetting);
  }




  public function update(Request $request, $id)
  {
    
    $userinfo = Smssent::whereadmin_id(Auth::user()->id)->find($id)->update(
      $request->all()
        
       );
      
       Toastr::success("Setting  Update Successfully", "Well Done");
       return Redirect::to('admin/smsmessagesetting');
      
      
  }

  
}
