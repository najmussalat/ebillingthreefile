<?php
namespace App\Http\Controllers\Superadmin;
use App\Models\Permissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Kamaln7\Toastr\Facades\Toastr;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
public function index()
{
    $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];
    $role= Role::with('permissions')->latest()->paginate(10);
    return view('superadmin.roles.index', ['pageConfigs' => $pageConfigs])->with('roles',$role)->with('i', (request()->input('page', 1) - 1) * 10); 
    
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")

            ->get();
        $permission= Permissions::get();
        $breadcrumbs = [
            ['link' => "superadmin", 'name' => "Home"], ['link' => "superadmin/accountrolelist", 'name' => "Role"], ['name' => "Create"],
        ];
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
            return view('superadmin.roles.create',['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('permission',$permission);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //   dd($request);
        $this->validate($request,[
            
            'name' => 'required|unique:roles',
            'permission' => 'required',

        ]);

        $role = Role::create(['name' => $request->input('name'),'guard_name'=>'superadmin']);
        $role->syncPermissions($request->input('permission'));
        if ($role) {
            Toastr::success("Role  Create Successfully", "Well Done");
            return Redirect::to('superadmin/accountrolelist'); 
    } else {
        Toastr::warning("Role  Create Fail", "Sorry");
        return Redirect::to('superadmin/accountrolelist'); 
    
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")

            ->where("role_has_permissions.role_id",$id)

            ->get();
            return response()->json([
                 'rolepermissiondetails' =>$rolePermissions], 200);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)

        ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')

        ->all();

            $breadcrumbs = [
                ['link' => "superadmin", 'name' => "Home"],['link' => "superadmin/accountrolelist", 'name' => "Role List"], ['link' => "superadmin/editpermission/".$id, 'name' => "Edit Role"],
            ];


            //Pageheader set true for breadcrumbs
            $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        return view('superadmin.roles.edit', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('role',$role)->with('rolePermissions', $rolePermissions)->with('permission',$permission);
     
       

        
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
         $this->validate($request,[
             
             'name' => 'required|unique:roles,name,'.$id,

             'permission' => 'required',
 
         ]);
 
         $role = Role::find($id);
         $role->name=$request->name;
         $role->save();
         $role->syncPermissions($request->input('permission'));
         if ($role) {
            Toastr::success("Role  Update Successfully", "Well Done");
            return Redirect::to('superadmin/accountrolelist'); 
    } else {
        Toastr::warning("Role  Update Fail", "Sorry");
        return Redirect::to('superadmin/accountrolelist'); 
    
         }
     }
     /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Role::destroy($id)) {
           
            Toastr::success("Role  Delete Successfully", "Well Done");
            return Redirect::to('superadmin/accountrolelist'); 
    } else {
        Toastr::warning("Role  Delete Fail", "Sorry");
        return Redirect::to('superadmin/accountrolelist'); 
    
         }

    
    }
    public function rolesearch(Request $request){
        //return response($request->all());exit;
                $output="";
                $searchvalue = Role::Where('name','LIKE','%%%'.$request->id."%%%")->latest()->take(30)->get();
                if(count($searchvalue))
        {
        foreach ($searchvalue as $key => $searchval) {
        $output.='<tr>'.
        '<td>'.$searchval->id.'</td>'.
         '<td>'.$searchval->name.'</td>'.
       '<td>'.'<a target="_blank" href="'.url('superadmin/editpermission/'.$searchval->id).'" class="btn-floating mb-1 waves-effect waves-light"> <i class="material-icons">edit</i></a>'.'</td>'.
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
