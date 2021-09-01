<?php

namespace App\Http\Controllers\Superadmin;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Thana;
use App\Models\District; 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Kamaln7\Toastr\Facades\Toastr;
class ThanaController extends Controller
{
    public function index(){
     
        $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];
            $thana=Thana::latest()->paginate(30);
           // dd($thana);exit;
            return view('superadmin.thana.index')->with('thanas',$thana)->with('pageConfigs',$pageConfigs)->with('i', (request()->input('page', 1) - 1) * 30);
        }
      
      
       public function create(){
     $breadcrumbs = [
            ['link' => "superadmin", 'name' => "Home"], ['link' => "superadmin/thanalist", 'name' => "Thana"], ['name' => "Create"],
        ];
          $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        $district=District::pluck('district','id');
     $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        
        return view('superadmin.thana.create', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('districts',$district);
      
        }
      
      
      public function store(Request $request){
        // dd($request->all());exit;
          $Thanainfo=explode(",",$request->thana);
         foreach($Thanainfo as $than){
          $div = new Thana;
          $div->district_id =$request->district_id;
          $div->thana = trim($than);
          $div->save();
      }
      if($div->save()){
      Toastr::success("Thana Create Successfully", "Well Done");
                return Redirect::to('superadmin/thanalist'); 
      }
      else{
          Toastr::warning("Thana Create Fail", "Sorry");
           return Redirect::to('superadmin/thanalist'); 
      }
          
      }


      public function edit($id)
      {
        //  dd($id);
           $breadcrumbs = [
              ['link' => "superadmin", 'name' => "Home"], ['link' => "superadmin/thanalist", 'name' => "Thana"], ['name' => "Edit"],
          ];
          //Pageheader set true for breadcrumbs
          $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
          $district=District::pluck('district','id');
          $thanainfo=Thana::find($id);
         return view('superadmin.thana.edit', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('districtinfo',$district)->with('thana',$thanainfo);
      }
  
  
  
      public function update(Request $request,$id){
          $this->validate($request,[
         'district_id' => 'required',
         'thana' => 'required|min:3|max:190|unique:thanas,thana,'.$id,
  
         ]);
           $div = Thana::find($id);
           $div->district_id =$request->district_id;
           $div->thana = trim($request->thana);
           $div->save();
      
       if($div->save()){
       Toastr::success("Thana Update Successfully", "Well Done");
                 return Redirect::to('superadmin/thanalist'); 
       }
       else{
           Toastr::warning("Thana Update Fail", "Sorry");
            return Redirect::to('superadmin/thanalist'); 
       }
           
       }
  
  
  
       public function destroy($id){
       
           $divisioninfo=Thana::destroy($id);
          if($divisioninfo){
            Toastr::success("Thana Delete Successfully", "Well Done");
                 return Redirect::to('superadmin/thanalist'); 
          }
          else{
            Toastr::warning("Thana Delete Fail", "Sorry");
            return Redirect::to('superadmin/thanalist'); 
          }
           }
  
  
    public function search(Request $request){
      $output="";
      $searchvalue = Thana::Where('thana','LIKE','%%%'.$request->id."%%%")->orwhere('id','LIKE','%'.$request->id."%")->latest()->get();
      if(count($searchvalue))
  {
  foreach ($searchvalue as $key => $searchval) {
  $output.='<tr>'.
  '<td>'.$searchval->id.'</td>'.
  '<td>'.$searchval->thana.'</td>'.
  '<td>'.'<a target="_blank" href="'.url('superadmin/editthana/'.$searchval->id).'" class="btn-floating mb-1 waves-effect waves-light"> <i class="material-icons">edit</i></a>'.'</td>'.
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
