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
      ['newcustomermessage' => 'Welcom to #CUSTOMER_NAME#, Your  ID #CUSTOMER_ID#.Your Monthly Bill #RATE# TK .Thanks To billing.com',
      'billingmessage' => ' প্রিয় #CUSTOMER_NAME# আপনার লাইন #EXPIRY_DATE# তারিখে মেয়াদউত্তীর্ণ হবে। অনুগ্রহ করে আপনার বিল পরিশোধ করুন। বিকাশ। 017.... . Ref ID #CUSTOMER_ID#',
      'paymentmessage' => 'Dear User, We have received #AMOUNT#Tk for #CUSTOMER_ID#. Your account will be active until #EXPIRY_DATE#  also Due #DUE#. Visit: portal.maxim-billing.com',
      'openticketmessage' => 'Ticket#  #TKTNO#. Complain: #TOPIC#. #USERNAME#, #MOBILE#, Addr= #ADDRESS#, details:  #DETAIL#, mobile no #MOBILE#',
      'assignticketmessage' => ' Ticket#  #TKTNO#. Complain: #TOPIC#. #USERNAME#, #MOBILE#, Addr= #ADDRESS#, details:  #DETAIL#',
      'updateticketmessage' => 'Ticket # #TKTNO# Update:  topic #TOPIC#. #TKT_MSG#',
      'closeticketmessage' => ' Ticket # #TKTNO# closed:  topic #TOPIC#. #TKT_MSG#',
      'problemmessage' => 'Dear Custoer  #name# Our ..... Line '
    
    ],


    );
    $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];
    return view('admin.smsmessage.index')->with('pageConfigs', $pageConfigs)->with('smsmessage', $smssetting);
  }

  public function create()
  {
    $breadcrumbs = [
      ['link' => "admin/dashboard", 'name' => "Home"], ['link' => "admin/merchantlist", 'name' => "Customer"], ['name' => "Create"],
    ];

    $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];

    return view('admin.customer.create', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'customername' => 'required|min:3|max:190',
      'customermobile' => 'required|min:10|max:30',
      'houseno' => 'required|min:1|max:160',
      'floor' => 'required|min:1|max:160',
      'district_id' => 'required',
      'thana_id' => 'required',
      'area_id' => 'required',
      'package_id' => 'required',
      'password' => 'required',
      'total' => 'required',
      'repassword' => 'required|same:password',
      'monthlyrent' => 'required',
      // 'loginid' => ['required', 'min:1', 'max:60', Rule::unique('customers')->where(function ($query) {
      //   return $query->where('admin_id', Auth::user()->id);
      // })],



    ]);
  
    $customerinfo = Customer::create(array(
      'customername' => $request->customername,
      'contactperson' => $request->contactperson
      
    ));

    if ($customerinfo) {
      Toastr::success("Customer Create Successfully", "Well Done");
      return Redirect::to('admin/customerlist');
    } else {
      Toastr::warning("Customer Create Fail", "Sorry");
      return Redirect::to('admin/createmerchant');
    }
  }



  public function update(Request $request, $id)
  {
    
    $userinfo = Smssent::whereadmin_id(Auth::user()->id)->find($id)->update(
      $request->all()
        
       );
      
       Toastr::success("Setting  Update Successfully", "Well Done");
       return Redirect::to('admin/smsmessagesetting');
      
      
  }

  public function destroy($id)
  {

    return response(Customer::whereadmin_id(Auth::id())->delete($id));
  }
}
