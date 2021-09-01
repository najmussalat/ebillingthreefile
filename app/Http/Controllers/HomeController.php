<?php

namespace App\Http\Controllers;
use App\Models\Disease;
use App\Models\Medicine;
use App\Models\Blog;
use App\Models\Medicineinformation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    
    
    public function index(){
      $recentmedicine = Cache::remember('recentviewmedicineinformation', 20*600, function () {
        return Medicineinformation::wherestatus(1)->latest()->take(4)->select('title','slug','photo','metadescription','status')->get(); 
        
    });
        
     $news= Cache::remember('newscache', 20*600, function () {
          return Blog::wherestatus(1)->wherecategory_id(3)->select('title','slug','photo','metadescription','status')->latest()->take(4)->get();
        
          }); 
               
        
 
        return response()->json([
            'recentmedicine'=>$recentmedicine,
               'news'=>$news,
            ],200);
}
    public function home(){
    
        $disease= Cache::get('disease', function () {
          return Disease::wherestatus(1)->latest()->take(8)->get();
      
        });
        $medicine= Cache::get('medicine', function () {
          return Medicine::wherestatus(1)->latest()->take(200)->get();
        
          }); 
                 $medicineinfo= Cache::get('medicineinformation', function () {
          return Medicineinformation::wherestatus(1)->latest()->take(20)->select('title','slug','photo','metadescription','status')->get(); 
        
          });
         $blogs= Cache::get('bloginfo', function () {
          return Blog::wherestatus(1)->latest()->take(20)->select('title','slug','photo','metadescription','status')->get();
        
          });
       
        return response()->json([
           
            'disease'=>$disease,
            'medicine'=>$medicine,
            'medicineinformation'=>$medicineinfo,
              'blogs'=>$blogs,
         
            ],200);
}
   

}
