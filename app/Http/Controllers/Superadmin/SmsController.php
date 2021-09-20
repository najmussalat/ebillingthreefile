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
use App\Models\Smssent;
use App\Models\Smstype;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class SmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];
   $infos= Smssent::with('admin')->latest()->paginate(10);
   return view('superadmin.sms.index',['pageConfigs' => $pageConfigs])->with('infos',$infos)   ->with('i', (request()->input('page', 1) - 1) * 10);
  
      
    }

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
            ['link' => "superadmin", 'name' => "Home"], ['link' => "superadmin/smssettinglist", 'name' => "SMS"], ['name' => "Edit"],
        ];
      
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
       $smstype=Smstype::pluck('maskingnonmasking','id');
        $infos = Smssent::with('smstype')->find($id);
        return view('superadmin.sms.edit', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('smsmessage',$infos)->with('smstype',$smstype);
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
            'username' => 'required|min:3|max:60',
            'password' => 'required|min:3|max:60',
           'smsrate' => 'required',
           
        
        ]);
        Smssent::find($id)->update( $request->all());
                
                        
        Toastr::info("Sms Update Successfully", "Done");
        return Redirect::to('superadmin/smssettinglist');  
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


public function smstype(){
    $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];
    $infos= Smstype::latest()->paginate(10);
    return view('superadmin.sms.smstypeindex',['pageConfigs' => $pageConfigs])->with('infos',$infos)   ->with('i', (request()->input('page', 1) - 1) * 10);
   
}
public function createsmstype(){
    $breadcrumbs = [
        ['link' => "superadmin/dashboard", 'name' => "Home"], ['link' => "superadmin/smsstypelist", 'name' => "SMS Type"], ['name' => "Edit"],
    ];
  
    $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
    
    return view('superadmin.sms.smstypecreate', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
   
}
public function smstypestore(Request $request){
    
    $this->validate($request,[
        'maskingnonmasking' => 'required|min:3|max:190',
        'charge' => 'required',
      
       
    
    ]);
    Smstype::create( $request->all());
            
                    
    Toastr::info("Sms Type Create Successfully", "Done");
    return Redirect::to('superadmin/smstypelist');  
}

public function editsmstype($id){
    
    
    $infos=Smstype::find($id);
            
    $breadcrumbs = [
        ['link' => "superadmin/dashboard", 'name' => "Home"], ['link' => "superadmin/smsstypelist", 'name' => "SMS Type"], ['name' => "Edit"],
    ];
  
    $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
    
    return view('superadmin.sms.updatesmstype', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('infos',$infos);
}
public function smstypeupdate(Request $request,$id){
    
    $this->validate($request,[
        'maskingnonmasking' => 'required|min:3|max:190',
        'charge' => 'required',
      
       
    
    ]);
    Smstype::find($id)->update( $request->all());
            
                    
    Toastr::info("Sms Type Update Successfully", "Done");
    return Redirect::to('superadmin/smstypelist');  
}


    }


  

