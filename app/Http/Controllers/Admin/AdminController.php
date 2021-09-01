<?php

namespace App\Http\Controllers\admin;
use App\Models\Admin;
use App\Models\Superadmin;
use Illuminate\Http\Request;
use Kamaln7\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Notifications\Adminupdatenotification;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    
     public function profile(){
        $info=Admin::find(Auth::user()->id);
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['name' => "User Profile Page"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('admin.profile.index', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('admininfoid',$info);
     }
   
     public function updateprofilephoto(Request $request){
          $this->validate($request,[
       'photo' => 'mimes:jpeg,jpg,png|required|max:500',
       
            
    
        ]);
        if ($request->hasfile('photo')) {
            $info=Admin::find(Auth::user()->id);
         //  dd($info);exit;
            if($info->image !=='not-found.jpg'){
               
                $imagepath=(storage_path().'/app/files/shares/profileimage/').$info->image;
                $thumbimagepath=(storage_path().'/app/files/shares/profileimage/thumbs/').$info->image;
              if(file_exists( $imagepath) && ($thumbimagepath) ){
                  unlink($imagepath) && unlink($thumbimagepath);
          
              }
            }
          $name='admin_'.Auth::user()->id.'_'.$request->photo->getClientOriginalName();
           $request->photo->move(storage_path().'/app/files/shares/profileimage/', $name);
         
         $resizedImage_thumb = Image::make(storage_path().'/app/files/shares/profileimage/'.$name)->resize(35, null, function ($constraint) {
             $constraint->aspectRatio();
         });
         
           $resizedImage_thumb->save(storage_path() . '/app/files/shares/profileimage/thumbs/'.$name, 100);
      }
      else{
       $name ='not-found.jpg';
      };
      $userinfo = Admin::find(Auth::user()->id)->update(array(
        'image' => $name ,
       ));
  if($userinfo){
    Toastr::info("Image  Update Successfully", "Well Done");
    return Redirect::to('admin/profile'); 
  }
     }



     public function updateprofileinfo(Request $request,$id){

        $this->validate($request,[
       //'email' => 'required|email|unique:admins,email,'.$id,
       'phone' => 'required|unique:admins,phone,'.$id,
            
    
        ]);
        $userinfo = Admin::find(Auth::user()->id)->update(
          $request->all()
            
           );
      if($userinfo){
           $data= array(
            
            'message' =>'<a class="black-text"  href="'. url('/superadmin/editadmin/'.$id) . '">'.Auth::user()->name. ' Change Profile</a>',
             );
             
      Superadmin::first()->notify(new Adminupdatenotification($data));
        Toastr::info("Profile Update Successfully", "Well Done");
        return Redirect::to('admin/profile'); 
      }

     } 
        public function updatepassword(Request $request){
            
            $this->validate($request,[
            'password' => 'required|min:6|max:30', 
            'confirm' => 'required|same:password', 
        
            ]);
            if(!Hash::check($request->oldpassword, Auth::user()->password)){
              Toastr::info("Old Password wrong", "Sorry");
                return back();
   
           }else{
   
            Admin::find(Auth::user()->id)->update(array('remember_token' =>null));
        $userinfo = Admin::find(Auth::user()->id)->update(array(
            'password' =>Hash::make($request->confirm),
            ));
        }
      if($userinfo){
        Auth::logout();
        
                    $request->session()->invalidate();
                    Toastr::info("Password Update Successfully", "Well Done");
                    return Redirect::to('login/admin');
                
                    }     }



  public function checkprofile(){

$check=Admin::find(Auth::id());

$name=is_null($check->name)?0:10;
$phone =is_null($check->phone)?0:10;
$username=is_null($check->web)?0:10;
$gender=is_null($check->company)?0:10;
$address=is_null($check->address)?0:10;
$email=is_null($check->email)?0:10;
$country =is_null($check->country)?0:10;
$profession=is_null($check->status)?0:10;
$aboutyou=is_null($check->id )?0:10;
$image=($check->image=='not-found.jpg')?0:10;
$total=($name+$gender+$image+$phone+$username+$address+$email+$country+$profession+$aboutyou);
return response()->json([$total],200);
                    }   

}

