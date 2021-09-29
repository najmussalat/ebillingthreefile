<?php

namespace App\Http\Controllers\Admin;
use App\Models\Area;
use App\Models\Thana;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Kamaln7\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class AreaController extends Controller
{
    public function index(){
     
        $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];
            $division=Area::whereadmin_id(Auth::id())->orderBy('areaname','ASC')->paginate(10);
           // dd($thana);exit;
            return view('admin.area.index')->with('areainfo',$division)->with('pageConfigs',$pageConfigs)->with('i', (request()->input('page', 1) - 1) * 10);
        }
      
      
       public function create(){
     $breadcrumbs = [
            ['link' => "admin", 'name' => "Home"], ['link' => "admin/arealist", 'name' => "Area"], ['name' => "Create"],
        ];
      
          $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        $thana=Thana::pluck('thana','id');
        return view('admin.area.create', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('thana', $thana);
      
        }
      
      
      public function store(Request $request){
         $this->validate($request,[
           'thana_id'=>'required',
          'areaname' =>['required','min:1', 'max:60', Rule::unique('areas')->where(function ($query) {
      return $query->where('admin_id', Auth::user()->id);
       })   ], 
       
       
          //'address' => 'required',
          
                     
      ]);
          $div = new Area;
          $div->admin_id =Auth::id();
          $div->thana_id =trim($request->thana_id);
          $div->areaname =trim($request->areaname);
           $div->save();
     
      if($div->save()){
      Toastr::success("Area Created Successfully", "Well Done");
                return Redirect::to('admin/arealist'); 
      }
      else{
          Toastr::warning("Area Create Fail", "Sorry");
           return Redirect::to('admin/arealist'); 
      }
          
      }


      public function edit($id){
        $breadcrumbs = [
               ['link' => "admin", 'name' => "Home"], ['link' => "admin/arealist", 'name' => "Area"], ['name' => "edit"],
           ];
           $thana=Thana::pluck('thana','id');
             $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
           $divisioninfo=Area::whereadmin_id(Auth::id())->find($id);
           return view('admin.area.edit', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('countryinfo',$divisioninfo)->with('thana', $thana);
         
           }



           public function update(Request $request,$id){
            $this->validate($request,[
              'thana_id'=>'required',
              'areaname' =>['required','min:1', 'max:60', Rule::unique('areas')->ignore($id, 'id')->where(function ($query) {
                return $query->where('admin_id', Auth::user()->id);
                 })   ],  
   
           ]);
             $div = Area::find($id);
             $div->thana_id =trim($request->thana_id);
             $div->areaname =trim($request->areaname);
              $div->save();
        
         if($div->save()){
         Toastr::success("Area Updated Successfully", "Well Done");
                   return Redirect::to('admin/arealist'); 
         }
         else{
             Toastr::warning("Area Update Fail", "Sorry");
              return Redirect::to('admin/arealist'); 
         }
             
         }



         public function destroy($id){
         
             $divisioninfo=Area::whereadmin_id(Auth::id())->findOrFail($id)->delete();
            if($divisioninfo){
              Toastr::success("Area Deleted Successfully", "Well Done");
                   return Redirect::to('admin/arealist'); 
            }
            else{
              Toastr::warning("Area Delete Fail", "Sorry");
              return Redirect::to('admin/arealist'); 
            }
             }


      public function search(Request $request){
        $output="";
        $searchvalue = Area::Where('areaname','LIKE','%%%'.$request->id."%%%")->orwhere('id','LIKE','%'.$request->id."%")->latest()->get();
        if(count($searchvalue))
{
foreach ($searchvalue as $key => $searchval) {
$output.='<tr>'.
'<td>'.$searchval->id.'</td>'.
'<td>'.$searchval->areaname.'</td>'.
'<td>'.'<a target="_blank" href="'.url('admin/editarea/'.$searchval->id).'" class="btn-floating mb-1 waves-effect waves-light"> <i class="material-icons">edit</i></a>'.'</td>'.
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
