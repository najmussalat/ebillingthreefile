<?php

namespace App\Http\Controllers;
use App\Models\Area;
use App\Models\Thana;
use App\Models\Country;
use App\Models\Package;
use App\Models\District;
use App\Models\Division;
use Illuminate\Http\Request;
use Kamaln7\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Smstype;
use Illuminate\Support\Facades\Auth;
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
        public function area($id){
            return response()->json(Area::whereadmin_id(Auth::guard('admin')->user()->id)->wherethana_id($id)->select('id','areaname')->get()->toArray());
        
            
                } 
                public function smstype($id){
            return response()->json(Smstype::find($id));
        
            
                }
        
        public function package($id){
    return response()->json(Package::select('id','packageprice')->find($id));

    
        }     
        public function payment($id){
    return response()->json(Payment::select('id','note')->find($id));

    
        }
         public function customerinfo(Request $request){
            $district=District::wheredivision_id($request->divisionid)->select('id','district')->get();
              $thana=Thana::wheredistrict_id($request->districtid)->select('id','thana')->get()->toArray();
              $area=Area::wherethana_id($request->thanaid)->select('id','areaname')->get()->toArray();
    return response()->json([
        
        'dis'=>$district,
        'than'=>$thana,
        'area'=>$area
    ]);

    
        }
      
      
     


}
