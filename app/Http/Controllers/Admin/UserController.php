<?php

namespace App\Http\Controllers\admin;
use App\Models\User;
use App\Models\Superadmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Kamaln7\Toastr\Facades\Toastr;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Notifications\Adminupdatenotification;
use Intervention\Image\ImageManagerStatic as Image;

class UserController extends Controller
{
  public function index(){
    $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];
        $blog=User::whereadmin_id(Auth::guard('admin')->user()->id)->latest()->paginate(10);
        return view('admin.createuser.index')->with('usersinfo',$blog)->with('pageConfigs',$pageConfigs)->with('i', (request()->input('page', 1) - 1) * 10);
    
  }
    
     public function create(){
      $roles = Role::whereadmin_id(Auth::id())->pluck('name','name')->all();
      $breadcrumbs = [
        ['link' => "admin/dashboard", 'name' => "Home"], ['link' => "admin/userlist", 'name' => "User"], ['name' => "Create"],
    ];
  
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('admin.createuser.create', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('roles',$roles);
     }


     public function store(Request $request){
// dd($request->all());
      $this->validate($request,[
     'email' => 'required|email|unique:users',
     'username' => 'required|min:2|max:198',
     'phone' => 'required',
     'password' => 'required|min:6|max:30', 
     'retypepassword' => 'required|same:password', 
          
  
      ]);
      $userinfo = User::create([
        'admin_id'=>Auth::id(),
        'username'=>$request->username,
        'phone'=>$request->phone,
        'email'=>strtolower(trim($request->email)),
        // 'status'=>trim($request->status),
        'image'=>trim('not-found.jpg'),
        'password' =>Hash::make($request->password),
      ]);
    if($userinfo){
        
    $userinfo->assignRole($request->input('roles'));  
      Toastr::info("User Create Successfully", "Well Done");
      return Redirect::to('admin/userlist'); 
    }
    else{
      Toastr::info("User Create Fain", "Well Done");
      return Redirect::to('admin/createuser'); 
    }

   } 
   public function edit($id)
   {
       $breadcrumbs = [
           ['link' => "admin", 'name' => "Home"], ['link' => "admin/userlist", 'name' => "User"], ['name' => "Edit"],
       ];
     
       $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
       $roles = Role::whereadmin_id(Auth::id())->pluck('name','name')->all();
       $user = User::find($id);
       $userRole = $user->roles->pluck('name','name')->all();
       return view('admin.createuser.edit', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('roles',$roles)->with('user',$user)->with('userRole',$userRole);
   }


   
   public function update(Request $request,$id){
  
     $info=User::find($id);
    if($request->password==null){
    
 $passoword=$info->password;
          $this->validate($request,[
         'email' => 'required|email|unique:users,email,'.$id,
         'username' => 'required|min:2|max:198',
         'phone' => 'required',
]);
        }
        else{
            $this->validate($request,[
              'email' => 'required|email|unique:users,email,'.$id,
              'username' => 'required|min:2|max:198',
              'phone' => 'required',
              'password' => 'required|min:6|max:30', 
              'retypepassword' => 'required|same:password', 
                
               ]);
               
          $passoword=Hash::make($request->password);
          }
          $userinfo = User::find($id)->update([
            'admin_id'=>Auth::id(),
            'username'=>$request->username,
            'phone'=>$request->phone,
            'email'=>strtolower(trim($request->email)),
            // 'status'=>trim($request->status),
           'password' =>$passoword,
          ]);
        if($userinfo){
          DB::table('model_has_roles')->where('model_id',$id)->delete();
          $info->assignRole($request->input('roles'));
          Toastr::info("User Update Successfully", "Well Done");
          return Redirect::to('admin/userlist'); 
        }
        else{
          Toastr::info("User Update Fain", "Well Done");
          return Redirect::to('admin/createuser'); 
        }
    
       } 


       
    public function search(Request $request){
      $output="";
      $searchvalue = User::Where('username','LIKE','%%%'.$request->id."%%%")->orwhere('id','LIKE','%'.$request->id."%")->orwhere('email','LIKE','%'.$request->id."%")->orwhere('phone','LIKE','%'.$request->id."%")->latest()->get();
      if(count($searchvalue))
  {
  foreach ($searchvalue as $key => $searchval) {
  $output.='<tr>'.
  '<td>'.$searchval->id.'</td>'.
  '<td>'.$searchval->username.'</td>'.
  '<td>'.$searchval->email.'</td>'.
  '<td>'.$searchval->phone.'</td>'.
  '<td>'.'<a target="_blank" href="'.url('admin/edituser/'.$searchval->id).'" class="btn-floating mb-1 waves-effect waves-light"> <i class="material-icons">edit</i></a>'.'</td>'.
  '</tr>';
  }
  return Response($output);
  }
  else{
  $output.='<tr>'
  .'<td><h1>Sorry</h1></td>'.
  '<td><h1>NO </h1></td>'.
  '<td><h1>Data</h1></td>'.
  '<td><h1> Found</h1></td>'.
  '<td><h1>Type</h1></td>'.
  '<td><h1> Another</h1></td>'.
  '<td><h1>Info</h1></td>'.
  '</tr>';
  return Response( $output);
  
  }
    }
    public function destroy($id){
       
      $divisioninfo=User::whereadmin_id(Auth::id())->findOrFail($id)->delete();
     if($divisioninfo){
       Toastr::success("User Delete Successfully", "Well Done");
       return Redirect::to('admin/userlist'); 
     }
     else{
       Toastr::warning("User Delete Fail", "Sorry");
       return Redirect::to('admin/userlist'); 
     }
      }

}

