<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\Disease;
use App\Models\Medicineinformation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
class ImageUploadController extends Controller
{
  
public function index(Request $request){
            
            $name= $request->image->getClientOriginalName();
         //$name =date('Y-m-d')."_". time().$rand.".".$request->image->extension();  
      //    $top= $request->image->move(storage_path('app/files/shares/'), $name); //for live serve 
         $top= $request->image->move(storage_path('/app/public/files/shares/'), $name); 
         $response = new \StdClass;
  $response->link= "http://127.0.0.1:8000/app/public/files/shares/" . $name;  //for liveserver
  $response->link= "http://127.0.0.1:8000/storage/files/shares/" . $name; 
        echo stripslashes(json_encode($response));
}

public function newindex(Request $request){
            
  $path =storage_path('app/files/shares/'.date('Y/m'));
  if($path){
     // echo stripslashes(json_encode($path)); exit;
  
          $name= $request->image->getClientOriginalName();
          //$name =date('Y-m-d')."_". time().$rand.".".$request->image->extension();  
          $top= $request->image->move(storage_path('app/files/shares/'.date('Y/m')), $name); 
          $response = new \StdClass;
   $response->link= "https://bikebd.com/den/storage/app/files/shares/".date('Y/m').'/' . $name; 
         echo stripslashes(json_encode($response));
  }
  else{
      File::makeDirectory($path, $mode = 0777, true, true);
      $name= $request->image->getClientOriginalName();
          //$name =date('Y-m-d')."_". time().$rand.".".$request->image->extension();  
          $top= $request->image->move(storage_path('app/files/shares/'.date('Y/m')), $name); 
          $response = new \StdClass;
   $response->link= "https://bikebd.com/den/storage/app/files/shares/".date('Y/m').'/' . $name; 
         echo stripslashes(json_encode($response));
  }
// public function index(Request $request){
   
//  $rand = mt_rand(100000, 999999);
//             $name= uniqid('photo_',true).$rand.'.'.$request->image->extension();
//          //$name =date('Y-m-d')."_". time().$rand.".".$request->image->extension();  
//          $top= $request->image->move(storage_path('app/files/shares/'), $name); 
//          $response = new \StdClass;
//   $response->link= "/storage/app/files/shares/" . $name;
//         echo stripslashes(json_encode($response));
// }



public function blogpostimageresize(){
  $blog= Blog::select('id','photo')->get();
  
    for ($i = 0; $i <count($blog); $i++) {
            //$full_image_path =Image::make(storage_path().'/app/files/shares/images/productimages/'.$blog[$i]['featureimage']);

       $full_image_path =storage_path().'/app/files/shares/blog/'.$blog[$i]['photo'];
       $strpos = strpos($full_image_path,'.');
    $sub = substr($full_image_path,0,$strpos);
   $ex = explode('/',$sub)[10];
  // return response($ex);exit;
  $img= Image::make($full_image_path);   
      $uploadpath = storage_path().'/app/files/shares/blog/orginal/';
  $imgname = $ex.'.'.'webp';
  
$img->save($uploadpath.$imgname,60);
        
        $list=Blog::find($blog[$i]['id']);
         $list->photo =$imgname;
      $list->save();
       
       
    }



}

public function diseasepostimageresize(){
  $blog= Disease::select('id','diseaseimage')->get();
  
    for ($i = 0; $i <count($blog); $i++) {
            //$full_image_path =Image::make(storage_path().'/app/files/shares/images/productimages/'.$blog[$i]['featureimage']);

       $full_image_path =storage_path().'/app/files/shares/diseases/'.$blog[$i]['diseaseimage'];
       $strpos = strpos($full_image_path,'.');
    $sub = substr($full_image_path,0,$strpos);
   $ex = explode('/',$sub)[10];
  // return response($ex);exit;
  $img= Image::make($full_image_path);   
      $uploadpath = storage_path().'/app/files/shares/diseases/orginal/';
  $imgname = $ex.'.'.'webp';
  
$img->save($uploadpath.$imgname,60);
        
        $list=Disease::find($blog[$i]['id']);
         $list->diseaseimage =$imgname;
      $list->save();
       
       
    }



}

public function medicinepostimageresize(){
  $blog= Medicineinformation::select('id','photo')->get();
  
    for ($i = 0; $i <count($blog); $i++) {
            //$full_image_path =Image::make(storage_path().'/app/files/shares/images/productimages/'.$blog[$i]['featureimage']);

       $full_image_path =storage_path().'/app/files/shares/medicineinformation/'.$blog[$i]['photo'];
       $strpos = strpos($full_image_path,'.');
    $sub = substr($full_image_path,0,$strpos);
   $ex = explode('/',$sub)[10];
  // return response($ex);exit;
  $img= Image::make($full_image_path);   
      $uploadpath = storage_path().'/app/files/shares/medicineinformation/orginal/';
  $imgname = $ex.'.'.'webp';
  
$img->save($uploadpath.$imgname,60);
        
        $list=Medicineinformation::find($blog[$i]['id']);
         $list->photo =$imgname;
      $list->save();
       
       
    }



}


public function blogimageresize(){
  $blog= Blog::select('id','photo')->get();
  
    for ($i = 0; $i <count($blog); $i++) {
      
      $full_image_path =storage_path().'/app/files/shares/blog/'.$blog[$i]['photo'];
    //  return response($full_image_path);exit;
      $resized_image_path = storage_path().'/app/files/shares/blog/thumb/'.$blog[$i]['photo'];
$waterMarkUrl = storage_path().'/app/files/shares/backend/watermark.png';

       
      $img = Image::make($full_image_path)->resize(330, 232);
      $img->insert($waterMarkUrl, 'bottom-right', 5, 5);
      $img->save($resized_image_path,60);
         
            
       
    }



}


}

