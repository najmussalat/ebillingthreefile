<?php

namespace App\Http\Controllers\Admin;
use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Kamaln7\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Pagination\LengthAwarePaginator;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
     {
      $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];
      $info=Merchant::whereadmin_id(Auth::guard('admin')->user()->id)->latest()->paginate(10);
      return view('admin.merchant.index')->with('infos',$info)->with('pageConfigs',$pageConfigs)->with('i', (request()->input('page', 1) - 1) * 10);
     }
 
     public function create(){
      $breadcrumbs = [
             ['link' => "admin", 'name' => "Home"], ['link' => "admin/merchantlist", 'name' => "Merchant"], ['name' => "Create"],
         ];
       
           $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
         
         return view('admin.merchant.create', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
       
         }
 
         public function store(Request $request){
          $this->validate($request,[
            
           'merchantname' =>['required','min:1', 'max:60', Rule::unique('merchants')->where(function ($query) {
       return $query->where('admin_id', Auth::user()->id);
        })   ], 
        
        
           //'address' => 'required',
           
                      
       ]);
           $div = new Merchant;
           $div->admin_id =Auth::id();
           $div->merchantname =trim($request->merchantname);
            $div->save();
      
       if($div->save()){
       Toastr::success("Merchant Create Successfully", "Well Done");
                 return Redirect::to('admin/merchantlist'); 
       }
       else{
           Toastr::warning("Merchant Create Fail", "Sorry");
            return Redirect::to('admin/createmerchant'); 
       }
           
       }
    
       public function edit($id){
        $breadcrumbs = [
               ['link' => "admin", 'name' => "Home"], ['link' => "admin/merchantlist", 'name' => "Merchant"], ['name' => "edit"],
           ];
         
             $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
           $infos=Merchant::whereadmin_id(Auth::id())->find($id);
           return view('admin.merchant.edit', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('info',$infos);
         
           }

           public function update(Request $request,$id){
            $this->validate($request,[
              
             'merchantname' =>['required','min:1', 'max:60', Rule::unique('merchants')->ignore($id, 'id')->where(function ($query) {
         return $query->where('admin_id', Auth::user()->id);
          })   ], 
          
          
             
                        
         ]);
             $div = Merchant::whereadmin_id(Auth::id())->find($id) ;
             $div->admin_id =Auth::id();
             $div->merchantname =trim($request->merchantname);
              $div->save();
        
         if($div->save()){
         Toastr::success("Merchant Update Successfully", "Well Done");
                   return Redirect::to('admin/merchantlist'); 
         }
         else{
             Toastr::warning("Merchant Create Fail", "Sorry");
              return Redirect::to('admin/createmerchant'); 
         }
             
         }
   
         public function destroy($id){
         
          $divisioninfo=Merchant::whereadmin_id(Auth::id())->delete($id);
         if($divisioninfo){
           Toastr::success("Merchant Delete Successfully", "Well Done");
                return Redirect::to('admin/merchantlist'); 
         }
         else{
           Toastr::warning("Merchant Delete Fail", "Sorry");
           return Redirect::to('admin/merchantlist'); 
         }
          }

          public function search(Request $request){
            $output="";
            $searchvalue = Merchant::Where('merchantname','LIKE','%%%'.$request->id."%%%")->orwhere('id','LIKE','%'.$request->id."%")->latest()->get();
            if(count($searchvalue))
    {
    foreach ($searchvalue as $key => $searchval) {
    $output.='<tr>'.
    '<td>'.$searchval->id.'</td>'.
    '<td>'.$searchval->merchantname.'</td>'.
    '<td>'.'<a target="_blank" href="'.url('admin/editmerchant/'.$searchval->id).'" class="btn-floating mb-1 waves-effect waves-light"> <i class="material-icons">edit</i></a>'.'</td>'.
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
