<?php


namespace App\Http\Controllers\Superadmin;
use DB;
use App\Models\Permissions;
use Illuminate\Http\Request;
use Kamaln7\Toastr\Facades\Toastr;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;


class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];
        $permission= Permissions::latest()->paginate(10);
        return view('superadmin.permission.index', ['pageConfigs' => $pageConfigs])->with('permission',$permission)->with('i', (request()->input('page', 1) - 1) * 10); 
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumbs = [
        ['link' => "superadmin", 'name' => "Home"], ['link' => "superadmin/createpermission", 'name' => "Permission"], ['name' => "Create"],
    ];
    $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        return view('superadmin.permission.create',['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:permissions',
            
        ]);

        $list = new Permission();
        $list->name = $request->name;
        $list->guard_name = 'superadmin';
        $list->save();
        if ($list->save()) {
        
            Toastr::success("Permission  Create Successfully", "Well Done");
                return Redirect::to('superadmin/permissionlist'); 
        } else {
            Toastr::warning("Permission  Create Fail", "Sorry");
            return Redirect::to('superadmin/permissionlist'); 
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
        
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $breadcrumbs = [
            ['link' => "superadmin", 'name' => "Home"],['link' => "superadmin/permissionlist", 'name' => "Permission List"], ['link' => "superadmin/editpermission/".$id, 'name' => "Edit Permission"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        $info = Permission::find($id);
        return view('superadmin.permission.edit', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('diseases',$info); 

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
        $this->validate($request, [
            'name' => 'required|unique:permissions,name,'.$id,
            
        ]);

        $list =Permission::find($id);
        $list->name = $request->name;
       $list->save();
        if ($list->save()) {
            Toastr::success("Permission  Update Successfully", "Well Done");
            return Redirect::to('superadmin/permissionlist'); 
    } else {
        Toastr::warning("Permission  Update Fail", "Sorry");
        return Redirect::to('superadmin/permissionlist'); 
    
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Permission::destroy($id)) {
           
            Toastr::info("Permission  Delete Successfully", "Well Done");
                return Redirect::to('superadmin/permissionlist'); 
        } else {
            Toastr::warning("Permission  Delete Fail", "Sorry");
            return Redirect::to('superadmin/permissionlist'); 
        }
    
    }
    public function permissionsearch(Request $request){
        //return response($request->all());exit;
                $output="";
                $searchvalue = Permission::Where('name','LIKE','%%%'.$request->id."%%%")->orwhere('name','LIKE','%'.$request->id."%")->latest()->take(30)->get();
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
