<?php

namespace App\Http\Controllers\superadmin;
use App\Models\User;
use App\Models\Admin;
use App\Helpers\CommonFx;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Kamaln7\Toastr\Facades\Toastr;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;
use App\Notifications\Adminupdatenotification;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdmininfoMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];
   $admin= Admin::select('id','created_at','name','status','phone','image','email')->latest()->paginate(10);
   return view('superadmin.createadmin.index',['pageConfigs' => $pageConfigs])->with('admininfo',$admin)   ->with('i', (request()->input('page', 1) - 1) * 10);
  
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumbs = [
            ['link' => "superadmin", 'name' => "Home"], ['link' => "superadmin/adminlist", 'name' => "Admin"], ['name' => "Create"],
        ];
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
     
        $roles = Role::pluck('name','name')->all();
        return view('superadmin.createadmin.create',['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('roles',$roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
//return response(dd($request));exit;


  
    $this->validate($request,[
        'name' => 'required|max:60|min:3',
        'phone' => 'required|numeric|digits:11|unique:admins',
        'roles' => 'required',
        'email' => 'required|email|unique:admins',
        'username' => 'required|min:3|unique:admins',
        'password' => 'required|min:6|max:30', 
        'confirm' => 'required|same:password', 

    ]);
    try {
        DB::beginTransaction();
          
    $userinfo =Admin::create(array(
        'superadmin_id' =>Auth::guard('superadmin')->user()->id,
        'username' => CommonFx::make_slug($request->username),
        'name' => $request->name,
        'phone' => $request->phone,
        'image' => 'not-found.jpg',
        'email' => $request->email,
        'email_verified_at'=>Carbon::now(),
        'gender' => 'male',
        'status' => 1,
        'password' =>Hash::make($request->password)
     
    ));

    $userinfo->assignRole($request->input('roles'));  
   $maildata = [  
            'name'=> $request->name,
            'message' => 'Homeobari Superadmin Want you as a Admin. Your Email '.$request->email.' Your Password '.$request->password. '<a class="black-text"  href="'. url('/login/admin') . '">Login Now</a>',
             'subject'=> 'Account Form Homeobari',
             
           
  ];
    Mail::to($userinfo)->send(new AdmininfoMail($maildata));
    DB::commit();
    Toastr::success("Admin  Create Successfully", "Well Done");
    return Redirect::to('superadmin/adminlist'); 
    }
    catch (\Exception $e) {
        DB::rollBack();
        Toastr::warning("Admin  Create Fail", "Sorry");
        return Redirect::to('superadmin/adminlist'); 
    }
}


    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
   
    public function show(Admin $admin)
    { $admin = Admin::all();
    $te=$admin->getRoleNames();
        return response()->json(['adminrole'=>$te],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $breadcrumbs = [
            ['link' => "superadmin", 'name' => "Home"], ['link' => "superadmin/adminlist", 'name' => "Admin"], ['name' => "Edit"],
        ];
      
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        $roles = Role::pluck('name','name')->all();
        $admin = Admin::find($id);
        $userRole = $admin->roles->pluck('name','name')->all();
        return view('superadmin.createadmin.edit', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('roles',$roles)->with('admin',$admin)->with('userRole',$userRole);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
   
    
        $this->validate($request,[
            'username' => 'required|min:3|unique:admins,username,'.$id,
           // 'phone' => 'required|numeric|digits:11|unique:admins,phone,'.$id,
            'email' => 'required|email|unique:admins,email,'.$id,
            'name' => 'required|min:3',   
            'status' => 'required',   
        
        ]);
        try {
            DB::beginTransaction();
   
        $list =  Admin::find($id);
       $list->name = $request->name;
       $list->username = CommonFx::make_slug($request->username);
        $list->email = $request->email;
        $list->status = $request->status;
        $list->phone = $request->phone;
      
        $list->update();
        if($list->save()){
            DB::table('model_has_roles')->where('model_id',$id)->delete();
            $list->assignRole($request->input('roles'));

        }
          $data= array(
            
            'message' =>'<a class="black-text"  href="'. url('/admin/profile') . '">Superadmin Update Your Info</a>',
             );
               $list->notify(new Adminupdatenotification($data));
        DB::commit();
         Toastr::success("Admin  Update Successfully", "Well Done");
          return Redirect::to('superadmin/adminlist'); 
        }
        catch (\Exception $e) {
            DB::rollBack();
            Toastr::warning("Admin  Update Fail", "Sorry");
          return Redirect::to('superadmin/adminlist'); 
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteadmin=Admin::destroy($id);
     
         $maildata = [  
            'name'=> $deleteadmin->name,
            'message' => 'Homeobari Superadmin Delete Your Account. If You want Recover Your email please Contact 01739898764',
             'subject'=> 'Account Delete',
             
           
  ];
    Mail::to($deleteadmin)->send(new AdmininfoMail($maildata));
      
       if($deleteadmin) {
          
        Toastr::success("Admin  Delete Successfully", "Well Done");
        return Redirect::to('superadmin/adminlist'); 
        } else {
            
            Toastr::warning("Admin  Delete Fail", "Sorry");
          return Redirect::to('superadmin/adminlist'); 
        }
    
    }

  // account active  start


       public function setapproval(Request $request){
        $id =$request->id;
        $roomapproval = Admin::find($id);
        if($request->action=="allow"){
            $roomapproval->status=2;
             $roomapproval->superadmin_id=Auth::guard('superadmin')->user()->id;
              $maildata = [  
            'name'=> $roomapproval->name,
             'subject'=> 'Account Deactive',
             'message' => 'Sorry to Say Your Account has been  Block. if Any question Please Contact 01739898764'
           
  ];
    Mail::to($roomapproval)->send(new AdmininfoMail($maildata));
         
           \DB::table('sessions')->whereuser_id($roomapproval->id)->delete();
                 $roomapproval->update(array('remember_token' =>null));
        }
        if($request->action=="deny"){
            $roomapproval->status=1;
            $roomapproval->superadmin_id=Auth::guard('superadmin')->user()->id;
 $maildata = [  
            'name'=> $roomapproval->name,
            'subject'=> 'Account Active',
             'message' => '<a class="black-text"  href="'. url('/login/admin') . '">Your Account accepted</a>'
           
  ];
  
         Mail::to($roomapproval)->send(new AdmininfoMail($maildata));
     
        }
            $roomapproval->update();
            if($roomapproval->update()){
                
                return response()->json(['success' => true,],201);
            }



    }
    
    // account active inactive area end
    public function deleteusershow(){
        $deleteuser = User::with('admin')->onlyTrashed()->get();
        return view('super_admin.allusers.deleteuser')->with('allusers',$deleteuser);
    }
    public function restoreuser($id){
        User::withTrashed()->find($id)->restore();
     
    }

    public function allrolename(Request $request){
        // return response('hi');
        $role = Role::select('id','name')->get();
        return response()->json(['allrolename'=>$role],200);
    }

    public function adminsearch(Request $request){
        $output="";
        $searchvalue =  Admin::where('name','LIKE','%%%'.urldecode($request->id).'%%%')->orWhere('email','LIKE','%%%'.urldecode($request->id).'%%%')->orWhere('phone','LIKE','%%%'.urldecode($request->id).'%%%')->paginate();;
        if(count($searchvalue))
{
foreach ($searchvalue as $key => $searchval) {
    if($searchval->status==1){
        $info= '<button type="submit"  class="btn-floating mb-1 waves-effect waves-light approved"  rid="'.$searchval->status.'"><i class="material-icons">beenhere</i>   </button>';
    }
    else{
        $info= '<button type="submit"  class="btn-floating mb-1 waves-effect waves-light notapproved"  rid="'.$searchval->status.'"><i class="material-icons">block</i>   </button>';
    }
$output.='<tr>'.
'<td>'.$searchval->id.'</td>'.
'<td>'.$searchval->name.'</td>'.
'<td>'.$searchval->email.'</td>'.
'<td>'.$searchval->phone.'</td>'.
'<td>'. $info.'</td>'.
'<td>'.'<a target="_blank" href="'.url('superadmin/editadmin/'.$searchval->id).'" class="btn-floating mb-1 waves-effect waves-light"> <i class="material-icons">edit</i></a>'.'</td>'.
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
    }


  

