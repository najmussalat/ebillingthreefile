<?php

namespace App\Http\Controllers\Auth;

use App\Models\Admin;
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
        return Redirect::to('admin/verificationphone/'.$admin->phone);
       // return Redirect::to('admin/verificationlink/'.$admin->email);
        
 
    // if($admin) {
    //         Auth::guard('admin')->attempt(['email' => $request['email'], 'password' => $request['password']]);
    //         Toastr::success("WelCome Administration Panel");
    //         return redirect()->intended('/admin/dashboard');
    //     }
    }
}
