<?php

namespace App\Http\Controllers\Auth;

use App\Models\Admin;
use App\Models\Smssent;
use App\Helpers\CommonFx;
use Illuminate\Http\Request;
use Kamaln7\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         $this->middleware('guest');
        $this->middleware('guest:admin');
        $this->middleware('guest:superadmin');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'digits_between:11,35', 'min:3', 'max:60', 'unique:admins'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */


    public function showAdminRegisterForm()
    {
        $pageConfigs = ['bodyCustomClass' => 'forgot-bg', 'isCustomizer' => false];
        return view('auth.register', ['url' => 'admin',
            'pageConfigs' => $pageConfigs
        ]);
     
    }

    protected function createAdmin(Request $request)
    {
        $this->validator($request->all())->validate();
        $admin= Admin::create([
            'name' => $request['name'],
            'phone' => $request['phone'],
            'company' => $request['company'],
            'address' => $request['address'],
            'email' => strtolower(trim($request['email'])),
            'image' =>'not-found.jpg',
            'status'=>2,
            'otp'=>mt_rand(10000, 99999),
             'password' => Hash::make($request['password']),
        ]);

        $smssetting = Smssent::create(
            ['admin_id' => $admin->id,
            'newcustomermessage' => 'Dear #CUSTOMER_NAME# , your ID is: #CUSTOMER_ID# , ip: #IP# , Username : #PPPOE_USERNAME# , password : #PPPOE_PASSWORD# . Enjoy your new connection. Thanks - #COMPANY_NAME#',
            'billingmessage' => 'Dear #CUSTOMER_NAME# , Your #MONTH# s bill is #BILL_AMOUNT# Tk. Your id #CUSTOMER_ID# . Please pay before #LAST_DAY_OF_PAY_BILL# . Thanks - #COMPANY_NAME#',
            'paymentmessage' => 'Dear #CUSTOMER_NAME# , We got #AMOUNT# Tk. for #IP_OR_USER_NAME_OR_ID# . Your Due #DUE_AMOUNT# Tk. Thanks -#COMPANY_NAME#',
            'openticketmessage' => 'Hello #CUSTOMER_NAME# , Your complain is: #COMPLAINS# , #COMMENT# just arised. Our stuff #EMPLOYEE_NAME# , #EMPLOYEE_MOBILE# will contact with you soon. - Thanks, #COMPANY_NAME# , #COMPANY_MOBILE# .',
            'assignticketmessage' => 'New Complain for #CUSTOMER_NAME# , IP: #IP# , PPPoE Username : #PPPOE_USERNAME# , Mob : #CUSTOMER_MOBILE# , Complain : #COMPLAINS# , Comment : #COMMENT# , Address : #CUSTOMER_ADDRESS# . Solve it quickly.',
            'updateticketmessage' => 'Ticket  #TKTNO# Update:  topic #TOPIC# . #TKT_MSG# ',
            'closeticketmessage' => 'Dear #CUSTOMER_NAME# , Your problem has been resolved. If needed give us a call #COMPANY_MOBILE# . - Thanks, #COMPANY_NAME# .',
            'employeemessage' => 'New Complain for {CUSTOMER_NAME}, IP: {IP}, PPPoE Username : {PPPOE_USERNAME}, Mob : {CUSTOMER_MOBILE}, Complain : {COMPLAINS}, Comment : {COMMENT}, Address : {CUSTOMER_ADDRESS}. Solve it quickly',
            'problemmessage' => 'Dear #CUSTOMER_NAME# , thanks for being with us. Your ID is #CUSTOMER_ID# , IP #IP# , PPPoE Username #PPPOE_USERNAME# . If you have any query let us know. - #COMPANY_NAME# , #COMPANY_MOBILE# --or-- Your #MONTH# s bill is #BILL_AMOUNT# Tk. Please pay before #LAST_DAY_OF_PAY_BILL# . - #COMPANY_NAME# , #COMPANY_MOBILE#'
          
          ]);

          return Redirect::to('admin/verificationphone/'.$admin->phone);
       // return Redirect::to('admin/verificationlink/'.$admin->email);
        
 
    // if($admin) {
    //         Auth::guard('admin')->attempt(['email' => $request['email'], 'password' => $request['password']]);
    //         Toastr::success("WelCome Administration Panel");
    //         return redirect()->intended('/admin/dashboard');
    //     }
    }
}
