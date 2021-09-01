<?php
namespace App\Http\Controllers\Superadmin;
use App\Models\Superadmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
class SuperadminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   
    public function logout(Request $request) {
       Auth::guard('superadmin')->logout();
        return response()->json([
            'success' =>true,
             ], 200);
      }
    public function profile(){
       // return response('hi');
      $superadmin=Auth::guard('superadmin')->user();
      //dd($superadmin);
      if($superadmin){
          return response()->json([
              'success'=>true,
              'message'=>'Superadmin Info',
              'superadmininfo'=>$superadmin,
          ],200);
      }
      else{
          return response()->json([
              'success'=>false,
              'message'=>'Superadmin Not Found2'],404);
      }
    }

   
    }
