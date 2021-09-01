<?php

namespace App\Http\Controllers;
use App\Models\Thana;
use App\Models\Country;
use App\Models\Package;
use App\Models\District;
use App\Models\Division;
use Illuminate\Http\Request;
use Kamaln7\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class OnchangeController extends Controller
{
    public function index(){
     
       
        }
      
      
       public function district($id){
    return response()->json( District::wheredivision_id($id)->select('id','district')->get()->toArray());

    
        }
         public function thana($id){
    return response()->json( Thana::wheredistrict_id($id)->select('id','thana')->get()->toArray());

    
        }
        
        public function package($id){
    return response()->json(Package::select('id','packageprice')->find($id));

    
        }
         public function customerinfo(Request $request){
            
             $district=District::wheredivision_id($request->divisionid)->select('id','district')->get();
              $thana=Thana::wheredistrict_id($request->districtid)->select('id','thana')->get()->toArray();
    return response()->json([
        
        'dis'=>$district,
        'than'=>$thana
    ]);

    
        }
      
      
     


}
