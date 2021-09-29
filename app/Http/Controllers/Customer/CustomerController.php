<?php
namespace App\Http\Controllers\user;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use App\Mail\Foregatepasword;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function me(){
       $user=Auth::guard('api')->user();
          if($user){
           return response()->json([
                    'success' => true,
                    'user'=>$user,
                     ], 201);
              }
              
       else {
                  return response()->json([
                      'success' => false,

                  ],404);
              }
       
        
    }

    public function logout(Request $request){
         Auth::guard('api')->logout();
   
       return response()->json([
             'success' => true,
              'message'=>'logout success'
         ],201);
       
      
   }



   
    }
