<?php

namespace App\Http\Controllers\Auth;
use App\Helpers\helpers;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Password;

class AdminForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    public function showLinkRequestForm() {
        $pageConfigs = ['bodyCustomClass' => 'register-bg', 'isCustomizer' => false];
       return view('auth.passwords.admin-email')->with('pageConfigs',$pageConfigs);
    }

    //defining which password broker to use, in our case its the admins
    protected function broker() {
        return Password::broker('admins');
    }
}