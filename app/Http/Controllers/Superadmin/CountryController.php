<?php

namespace App\Http\Controllers\Superadmin;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Division;
use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Support\Facades\Http;
use Kamaln7\Toastr\Facades\Toastr;
class CountryController extends Controller
{
    public function index(){
     
        $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];
            $division=Country::orderBy('countryname','ASC')->paginate(10);
           // dd($thana);exit;
            return view('superadmin.country.index')->with('countryinfo',$division)->with('pageConfigs',$pageConfigs)->with('i', (request()->input('page', 1) - 1) * 10);;
        }
      
      
       public function create(){
     $breadcrumbs = [
            ['link' => "superadmin", 'name' => "Home"], ['link' => "superadmin/countrylist", 'name' => "Country"], ['name' => "Create"],
        ];
      
          $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        
        return view('superadmin.country.create', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
      
        }
      
      
      public function store(Request $request){
         $this->validate($request,[
        'countryname' => 'required|min:3|max:190|unique:countries',

        ]);
          $div = new Country;
          $div->countryname =trim($request->countryname);
           $div->save();
     
      if($div->save()){
      Toastr::success("Country Create Successfully", "Well Done");
                return Redirect::to('superadmin/countrylist'); 
      }
      else{
          Toastr::warning("Country Create Fail", "Sorry");
           return Redirect::to('superadmin/countrylist'); 
      }
          
      }


      public function edit($id){
        $breadcrumbs = [
               ['link' => "superadmin", 'name' => "Home"], ['link' => "superadmin/countrylist", 'name' => "Country"], ['name' => "edit"],
           ];
         
             $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
           $divisioninfo=Country::find($id);
           return view('superadmin.country.edit', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('countryinfo',$divisioninfo);
         
           }



           public function update(Request $request,$id){
            $this->validate($request,[
           'countryname' => 'required|min:3|max:190|unique:countries,countryname,'.$id,
   
           ]);
             $div = Country::find($id);
             $div->countryname =trim($request->countryname);
              $div->save();
        
         if($div->save()){
         Toastr::success("Country Update Successfully", "Well Done");
                   return Redirect::to('superadmin/countrylist'); 
         }
         else{
             Toastr::warning("Country Update Fail", "Sorry");
              return Redirect::to('superadmin/countrylist'); 
         }
             
         }



         public function destroy($id){
         
             $divisioninfo=Country::destroy($id);
            if($divisioninfo){
              Toastr::success("Country Delete Successfully", "Well Done");
                   return Redirect::to('superadmin/countrylist'); 
            }
            else{
              Toastr::warning("Country Delete Fail", "Sorry");
              return Redirect::to('superadmin/countrylist'); 
            }
             }


      public function search(Request $request){
        $output="";
        $searchvalue = Country::Where('countryname','LIKE','%%%'.$request->id."%%%")->orwhere('id','LIKE','%'.$request->id."%")->latest()->get();
        if(count($searchvalue))
{
foreach ($searchvalue as $key => $searchval) {
$output.='<tr>'.
'<td>'.$searchval->id.'</td>'.
'<td>'.$searchval->countryname.'</td>'.
'<td>'.'<a target="_blank" href="'.url('superadmin/editcountry/'.$searchval->id).'" class="btn-floating mb-1 waves-effect waves-light"> <i class="material-icons">edit</i></a>'.'</td>'.
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
