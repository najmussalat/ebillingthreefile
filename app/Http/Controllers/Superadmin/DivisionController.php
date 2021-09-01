<?php

namespace App\Http\Controllers\Superadmin;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Division;
use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Support\Facades\Http;
use Kamaln7\Toastr\Facades\Toastr;
class DivisionController extends Controller
{
    public function index(){
     
        $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];
            $division=Division::latest()->paginate(10);
           // dd($thana);exit;
            return view('superadmin.division.index')->with('divisioninfo',$division)->with('pageConfigs',$pageConfigs)->with('i', (request()->input('page', 1) - 1) * 10);;
        }
      
      
       public function create(){
     $breadcrumbs = [
            ['link' => "superadmin", 'name' => "Home"], ['link' => "superadmin/divisionlist", 'name' => "Division"], ['name' => "Create"],
        ];
      
          $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        $country=Country::pluck('countryname','id');
        return view('superadmin.division.create', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('country',$country);
      
        }
      
      
      public function store(Request $request){
         $this->validate($request,[
        'division' => 'required|min:3|max:190|unique:divisions',
        'country_id' => 'required',
        

        ]);
          $div = new Division;
          $div->division =trim($request->division);
          $div->country_id =trim($request->country_id);
           $div->save();
     
      if($div->save()){
      Toastr::success("Division Create Successfully", "Well Done");
                return Redirect::to('superadmin/divisionlist'); 
      }
      else{
          Toastr::warning("Division Create Fail", "Sorry");
           return Redirect::to('superadmin/divisionlist'); 
      }
          
      }


      public function edit($id){
        $breadcrumbs = [
               ['link' => "superadmin", 'name' => "Home"], ['link' => "superadmin/divisionlist", 'name' => "Division"], ['name' => "edit"],
           ];
           $country=Country::pluck('countryname','id');
             $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
           $divisioninfo=Division::find($id);
           return view('superadmin.division.edit', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('divisioninfo',$divisioninfo)->with('country',$country);
         
           }



           public function update(Request $request,$id){
            $this->validate($request,[
           'division' => 'required|min:3|max:190|unique:divisions,division,'.$id,
           'country_id' => 'required',
   
           ]);
             $div = Division::find($id);
             $div->division =trim($request->division);
             $div->country_id =trim($request->country_id);
              $div->save();
        
         if($div->save()){
         Toastr::success("Division Update Successfully", "Well Done");
                   return Redirect::to('superadmin/divisionlist'); 
         }
         else{
             Toastr::warning("Division Update Fail", "Sorry");
              return Redirect::to('superadmin/divisionlist'); 
         }
             
         }



         public function destroy($id){
         
             $divisioninfo=Division::destroy($id);
            if($divisioninfo){
              Toastr::success("Division Delete Successfully", "Well Done");
                   return Redirect::to('superadmin/divisionlist'); 
            }
            else{
              Toastr::warning("Division Delete Fail", "Sorry");
              return Redirect::to('superadmin/divisionlist'); 
            }
             }


      public function search(Request $request){
        $output="";
        $searchvalue = Division::Where('division','LIKE','%%%'.$request->id."%%%")->orwhere('id','LIKE','%'.$request->id."%")->latest()->get();
        if(count($searchvalue))
{
foreach ($searchvalue as $key => $searchval) {
$output.='<tr>'.
'<td>'.$searchval->id.'</td>'.
'<td>'.$searchval->division.'</td>'.
'<td>'.'<a target="_blank" href="'.url('superadmin/editdivision/'.$searchval->id).'" class="btn-floating mb-1 waves-effect waves-light"> <i class="material-icons">edit</i></a>'.'</td>'.
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
