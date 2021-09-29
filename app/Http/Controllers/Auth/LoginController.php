<?php

namespace App\Http\Controllers\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Superadmin;
use Illuminate\Http\Request;
use Kamaln7\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use App\Notifications\Superadminnotification;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/admin/dashboard';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:customer')->except('logout');
        $this->middleware('guest:superadmin')->except('logout');
    }

    // Login
    public function showLoginForm()
    {
        $pageConfigs = ['bodyCustomClass' => 'login-bg', 'isCustomizer' => false];

        return view('/login/admin', [
            'pageConfigs' => $pageConfigs
        ]);
    }
    public function showLoginuserForm()
    {
        $pageConfigs = ['bodyCustomClass' => 'login-bg', 'isCustomizer' => false];

        return view('auth.loginuser', [
            'pageConfigs' => $pageConfigs
        ]);
    }


    public function adminverifyemail(Request $request)
    {
        // dd($request->all());
        $check = Admin::where('email', $request->email)->wherestatus($request->code)->first();
        if ($check) {
            $check->update(array('email_verified_at' => Carbon::now(), 'status' => 1));
            return redirect('/login/admin')
                ->withErrors([
                    'status' => 'Your Email Verify Done Please Login'
                ]);

            $data = [
                'superadminboady' => $check['name'] . ' Verify Email Successfully With Code',
            ];


            Superadmin::first()->notify(new Superadminnotification($data));
        } else {
            return redirect()->back()
                ->withErrors([
                    'status' => 'Your Email Verify Code Invaild'
                ]);
        }
    }

    public function adminverifyphone(Request $request)
    {
        // dd($request->all());
        $check = Admin::wherephone($request->phone)->whereotp($request->code)->first();
        if ($check) {
            $check->update(array('email_verified_at' => Carbon::now(), 'status' => 1));
            return redirect('/login/admin')
                ->withErrors([
                    'status' => 'Phone Number Verified, Please Login'
                ]);

            $data = [
                'superadminboady' => $check['name'] . ' Verify Email Successfully With Code',
            ];


            Superadmin::first()->notify(new Superadminnotification($data));
        } else {
            return redirect()->back()
                ->withErrors([
                    'status' => 'Your Phone Verify Code Invaild'
                ]);
        }
    }
    public function showEmailveirfyForm()
    {
        $pageConfigs = ['bodyCustomClass' => 'login-bg', 'isCustomizer' => false];

        return view('auth.adminemailverify', [
            'pageConfigs' => $pageConfigs
        ]);
    }
    public function showOTPveirfyForm()
    {
        $pageConfigs = ['bodyCustomClass' => 'login-bg', 'isCustomizer' => false];

        return view('auth.adminotpverify', [
            'pageConfigs' => $pageConfigs
        ]);
    }
    public function logout(Request $request)
    {

        if ($request->user == 'superadmin') {

            $info = Superadmin::find(Auth::guard('superadmin')->user()->id)->update(array('remember_token' => null));

            if ($info) {
                $this->guard()->logout();

                $request->session()->invalidate();

                return $this->loggedOut($request) ?: redirect('/login/superadmin');
            }
        } 
        elseif ($request->user == 'admin') {
            $info = Admin::find(Auth::guard('admin')->user()->id)->update(array('remember_token' => null));

            if ($info) {
                $this->guard()->logout();

                $request->session()->invalidate();

                return $this->loggedOut($request) ?: redirect('/login/admin');
            }
        } elseif ($request->user == 'user') {
            $info = User::find(Auth::id())->update(array('remember_token' => null));

            if ($info) {
                $this->guard()->logout();

                $request->session()->invalidate();

                return $this->loggedOut($request) ?: redirect('/login/user');
            }
        } elseif ($request->user == 'customer') {
            //$info = Customer::find(Auth::id())->update(array('remember_token' => null));

                $this->guard()->logout();

                $request->session()->invalidate();

                return $this->loggedOut($request) ?: redirect('/login/customer');
            }
         else {
            $this->guard()->logout();

            $request->session()->invalidate();

            return $this->loggedOut($request) ?: redirect('/');
        }
    }


    public function showAdminLoginForm()
    {
        $pageConfigs = ['bodyCustomClass' => 'login-bg', 'isCustomizer' => false];
        return view('auth.login', ['url' => 'admin', 'pageConfigs' => $pageConfigs]);
    }

    public function adminLogin(Request $request)
    {

        $this->validate($request, [
            'email'   => 'required|email|exists:admins,email',
            'password' => 'required|min:6'
        ]);
        $remember = (!empty($request->remember)) ? TRUE : FALSE;
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1,], $remember)) {
            $data = [
                'superadminboady' => $request->email . ' Just Login',
            ];


            Superadmin::first()->notify(new Superadminnotification($data));
        }
        Toastr::success("WelCome Administration Panel");
        return redirect()->intended('/admin/dashboard');


        if (!Admin::where('email', $request->email)->first()) {
            return redirect()->back()
                ->withErrors([
                    'email' => Lang::get('auth.email'),
                ]);
        }
        if (!Admin::where('email', $request->email)->where('status', '<>', 2)->first()) {
            return redirect()->back()
                ->withErrors([
                    'status' => Lang::get('auth.status'),
                ]);
        }
        if (!Admin::where('email', $request->email)->where('password', bcrypt($request->password))->first()) {
            return redirect()->back()
                ->withErrors([
                    'password' => Lang::get('auth.password'),
                ]);
        }
    }



    public function showSuperadminLoginForm()
    {
        $pageConfigs = ['bodyCustomClass' => 'login-bg', 'isCustomizer' => false];
        return view('auth.login', ['url' => 'superadmin', 'pageConfigs' => $pageConfigs]);
    }

    public function superadminLogin(Request $request)
    {
        // return $request->all();
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);
        $remember = (!empty($request->remember)) ? TRUE : FALSE;
        if (Auth::guard('superadmin')->attempt(['email' => $request->email, 'password' => $request->password], $remember)) {

            Toastr::success("Welcome  Adminstration Panel");
            return redirect()->intended('/superadmin/dashboard');
        }
        return back()->withInput($request->only('email', 'remember'));
    }


    public function showLogincustomerForm()
    {
        $pageConfigs = ['bodyCustomClass' => 'login-bg', 'isCustomizer' => false];

        return view('auth.logincustomer', [
            'pageConfigs' => $pageConfigs
        ]);
    }
    public function customerLogin(Request $request)
    {
        // return $request->all();
        $this->validate($request, [
            'loginid'   => 'required|exists:customers,loginid',
            'password' => 'required|min:2|max:198'
        ]);
        $remember = (!empty($request->remember)) ? TRUE : FALSE;
        if (Auth::guard('customer')->attempt(['loginid' => $request->loginid, 'password' => $request->password], $remember)) {

            Toastr::success("Welcome  Adminstration Panel");
            return redirect()->intended('/customer/dashboard');
        }
        return back()->withInput($request->only('loginid', 'remember'));
    }
}
