<?php

namespace App\Http\Controllers\Superadmin;
use App\Models\Medicine;
use Kamaln7\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Redirect;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];
        $medicine= Medicine::latest()->simplePaginate(15);
        return view('superadmin.medicine.index',['pageConfigs' => $pageConfigs])->with('medicines',$medicine)->with('i', (request()->input('page', 1) - 1) * 2);

       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumbs = [
            ['link' => "superadmin", 'name' => "Home"], ['link' => "superadmin/medicinelist", 'name' => "Medicine"], ['name' => "Create"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        return view('superadmin.medicine.create', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
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
    'medicinename' => 'required|min:3|max:60|unique:medicines',
    'color' => 'required',
    'minides' => 'max:500',
    'medicinbn' => 'min:3|max:60',
    
]);
  
 
    $userinfo = new Medicine(array(
        'medicinename' => $request->medicinename,
        'medicinbn' => $request->medicinbn,
        'color' => $request->color,
        'minides' => $request->minides,
        ));


        if($userinfo->save()){
            Cache::forget('medicine');
            $medicine=Medicine::wherestatus(1)->latest()->take(200)->get();
            Cache::forever('medicine',$medicine);
            Toastr::success("Medicine Create Successfully", "Well Done");
          
            return Redirect::to('superadmin/medicinelist'); 
        }
        else {
            Toastr::error("Disease Create Failed", "Sorry ");
            return Redirect::to('superadmin/medicinelist'); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Medicine  $disease
     * @return \Illuminate\Http\Response
     */
    public function show(Medicine $disease)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Medicine  $disease
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $breadcrumbs = [
            ['link' => "superadmin", 'name' => "Home"], ['link' => "superadmin/medicinelist", 'name' => "Medicine"], ['name' => "Edit"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        $medicine =Medicine::find($id);
        return view('superadmin.medicine.edit', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('medicines',$medicine);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Medicine  $disease
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
       $this->validate($request,[
        'medicinename' => 'required|min:3|max:60|unique:medicines,medicinename,'.$id,
        'color' => 'required',
        'minides' => 'max:500',
        'medicinbn' => 'min:3|max:60',
        
    ]);
      
    
        $userinfo = Medicine::find($id)->update(array(
            'medicinename' => $request->medicinename,
            'medicinbn' => $request->medicinbn,
            'color' => $request->color,
            'minides' => $request->minides,
            ));
    
    
            if($userinfo){
                Cache::forget('medicine');
                $medicine=Medicine::wherestatus(1)->latest()->take(200)->get();
                Cache::forever('medicine',$medicine);
                Toastr::info("Medicine Update Successfully", "Well Done");
                return Redirect::to('superadmin/medicinelist'); 
            }
            else {
                Toastr::error("Disease Create Failed", "Sorry ");
                return Redirect::to('superadmin/medicinelist'); 
            }
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Medicine  $disease
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete=Medicine::destroy($id);
        
        if($delete){
          
                Cache::forget('medicine');
                $medicine=Medicine::wherestatus(1)->latest()->take(200)->get();
                Cache::forever('medicine',$medicine);
                Toastr::warning("Medicine Delete Successfully", "Well Done");
                return Redirect::to('superadmin/medicinelist'); 
            }
            else {
                Toastr::error("Disease Create Failed", "Sorry");
                return Redirect::to('superadmin/medicinelist'); 
            }
    }

    

    public function setapproval(Request $request){
        $id =$request->id;
        $roomapproval = Medicine::find($id);
        if($request->action=="allow"){
            $roomapproval->status=2;
        }
        if($request->action=="deny"){
            $roomapproval->status=1;


        }
            $roomapproval->update();
            if($roomapproval->update()){
                Cache::forget('medicine');
               $medicine=Medicine::wherestatus(1)->latest()->take(200)->get();
                Cache::forever('medicine',$medicine);
                return response()->json(['success' => true, 'message' =>' !']);
            }



    }

// $product = Disease::Where('diseasename','LIKE','%%%'.$request->id."%%%")->orwhere('description','LIKE','%'.$request->id."%")->where('admin_id', Auth::user()->id)->select('product_name','product_image','waight_Kg','product_price','id')->latest()->take(30)->get();
public function searchmedicine(Request $request){
    //return response($request->all());exit;
            $output="";
            $searchvalue = Medicine::Where('medicinename','LIKE','%%%'.$request->id."%%%")->orwhere('medicinbn','LIKE','%'.$request->id."%")->latest()->take(30)->get();
            if(count($searchvalue))
    {
    foreach ($searchvalue as $key => $searchval) {
    $output.='<tr>'.
    '<td>'.$searchval->id.'</td>'.
    '<td>'.$searchval->medicinename.'</td>'.
    '<td>'.$searchval->medicinbn.'</td>'.
    '<td>'.$searchval->minides.'</td>'.
    '<td>'.'<a target="_blank" href="'.url('superadmin/editmedicinelist/'.$searchval->id).'" class="btn-floating mb-1 waves-effect waves-light"> <i class="material-icons">edit</i></a>'.'</td>'.
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
