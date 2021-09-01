<?php

namespace App\Http\Controllers\Superadmin;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Division;
use App\Models\District;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Kamaln7\Toastr\Facades\Toastr;
class DistrictController extends Controller
{
    public function index(){
     
        $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];
            $division=District::latest()->paginate(15);
            return view('superadmin.district.index',['pageConfigs',$pageConfigs])->with('divisioninfo',$division)->with('i', (request()->input('page', 1) - 1) * 15);
        }
      
      
       public function create(){
        
     $breadcrumbs = [
            ['link' => "superadmin", 'name' => "Home"], ['link' => "superadmin/districtlist", 'name' => "District"], ['name' => "Create"],
        ];
          $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
          $division=Division::pluck('division','id');
        return view('superadmin.district.create', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('division', $division);
      
        }
      
      
      public function store(Request $request){
         $this->validate($request,[
        'division' => 'required',

        ]);
        $districtfo=explode(",",$request->district);
        foreach($districtfo as $district){
         $div = new District;
         $div->division_id =$request->division;
         $div->district = trim($district);
         $div->save();
     }
     if($div->save()){
     Toastr::success("District Create Successfully", "Well Done");
               return Redirect::to('superadmin/districtlist'); 
     }
     else{
         Toastr::warning("District Create Fail", "Sorry");
          return Redirect::to('superadmin/districtlist'); 
     }
     
      
          
      }
      
      
       public function edit($id)
    {
      //  dd($id);
         $breadcrumbs = [
            ['link' => "superadmin", 'name' => "Home"], ['link' => "superadmin/districtlist", 'name' => "District"], ['name' => "Edit"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        $division=Division::pluck('division','id');
        $district=District::find($id);
       return view('superadmin.district.edit', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('districtinfo',$district)->with('divisioninfo',$division);
    }



    public function update(Request $request,$id){
        $this->validate($request,[
       'division_id' => 'required',
       'district' => 'required|min:3|max:190|unique:districts,district,'.$id,

       ]);
         $div = District::find($id);
         $div->division_id =$request->division_id;
         $div->district = trim($request->district);
         $div->save();
    
     if($div->save()){
     Toastr::success("District Update Successfully", "Well Done");
               return Redirect::to('superadmin/districtlist'); 
     }
     else{
         Toastr::warning("District Update Fail", "Sorry");
          return Redirect::to('superadmin/districtlist'); 
     }
         
     }



     public function destroy($id){
     
         $divisioninfo=District::destroy($id);
        if($divisioninfo){
          Toastr::success("District Delete Successfully", "Well Done");
               return Redirect::to('superadmin/districtlist'); 
        }
        else{
          Toastr::warning("District Delete Fail", "Sorry");
          return Redirect::to('superadmin/districtlist'); 
        }
         }


  public function search(Request $request){
    $output="";
    $searchvalue = District::Where('district','LIKE','%%%'.$request->id."%%%")->orwhere('id','LIKE','%'.$request->id."%")->latest()->get();
    if(count($searchvalue))
{
foreach ($searchvalue as $key => $searchval) {
$output.='<tr>'.
'<td>'.$searchval->id.'</td>'.
'<td>'.$searchval->district.'</td>'.
'<td>'.'<a target="_blank" href="'.url('superadmin/editdistrict/'.$searchval->id).'" class="btn-floating mb-1 waves-effect waves-light"> <i class="material-icons">edit</i></a>'.'</td>'.
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
