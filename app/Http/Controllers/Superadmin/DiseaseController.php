<?php

namespace App\Http\Controllers\Superadmin;
use App\Models\Disease;
use App\Helpers\CommonFx;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Kamaln7\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class DiseaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
 
    //Pageheader set true for breadcrumbs
    $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];
     $disease= Disease::latest()->paginate(15);
        return view('superadmin.disease.index', ['pageConfigs' => $pageConfigs])->with('diseases',$disease)   ->with('i', (request()->input('page', 1) - 1) * 15);

       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumbs = [
            ['link' => "superadmin", 'name' => "Home"], ['link' => "superadmin/diseaselist", 'name' => "Disease"], ['name' => "Create"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        return view('superadmin.disease.create', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
             
//dd($request);exit;

$this->validate($request,[
    'diseasename' => 'required|min:3|max:60|unique:diseases',
    'menwomen' => 'required',
    'description' => 'min:10|max:500',
    'diseaseimage' => 'required|image|mimes:jpeg,jpg|max:8000'
]);
if ($request->hasfile('diseaseimage')) {
    
  
          $name =$request->diseaseimage->getClientOriginalName();
         $name_thumb = "thumb_" .$name;
         $request->diseaseimage->move(storage_path().'/app/files/shares/diseases/', $name);
        // $resizedImage = Image::make(storage_path().'/app/public/files/diseases/' . $name);
       $resizedImage_thumb = Image::make(storage_path().'/app/files/shares/diseases/' . $name)->resize(35, null, function ($constraint) {
           $constraint->aspectRatio();
       });
        // save file as jpg with medium quality
       // $resizedImage->save(storage_path() . '/app/public/dashboardimage/profile/'.$name);
         $resizedImage_thumb->save(storage_path() . '/app/files/shares/diseases/thumbs/'.$name_thumb, 100);
    }
    else{
     $name ='not-found.jpg';
    };

 
    $userinfo = new Disease(array(
       'diseasename' => $request->diseasename,
       'slug' =>CommonFx::make_slug($request->diseasename),
        'menwomen' => $request->menwomen,
        'description' => $request->description,
        'diseaseimage' => $name,
        ));


        if($userinfo->save()){
            Cache::forget('disease');
            $disease=Disease::wherestatus(1)->latest()->take(20)->get();
            Cache::forever('disease',$disease);
          
            Toastr::success("Disease Medicine Create Successfully", "Well Done");
                return Redirect::to('superadmin/diseaselist'); 
            }
            else {
                Toastr::error("Disease Medicine Create Failed", "Sorry");
                return Redirect::to('superadmin/diseaselist'); 
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function show(Disease $disease)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $disease =Disease::find($id);
               $breadcrumbs = [
            ['link' => "superadmin", 'name' => "Home"],['link' => "superadmin/diseaselist", 'name' => "Disease List"], ['link' => "superadmin/editdisease/".$id, 'name' => "Edit Disease"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        
            return view('superadmin.disease.edit', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('diseases',$disease);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
        'diseasename' => 'required|min:3|max:60|unique:diseases,diseasename,'.$id,
         'menwomen' => 'required',
        'description' => 'max:500',
       
        ]);
    
        if ($request->hasfile('diseaseimage')) {
    
  
            $name =$request->diseaseimage->getClientOriginalName();
           $name_thumb = "thumb_" .$name;
           $request->diseaseimage->move(storage_path().'/app/files/shares/diseases/', $name);
          // $resizedImage = Image::make(storage_path().'/app/public/files/diseases/' . $name);
         $resizedImage_thumb = Image::make(storage_path().'/app/files/shares/diseases/' . $name)->resize(35, null, function ($constraint) {
             $constraint->aspectRatio();
         });
          // save file as jpg with medium quality
         // $resizedImage->save(storage_path() . '/app/public/dashboardimage/profile/'.$name);
           $resizedImage_thumb->save(storage_path() . '/app/files/shares/diseases/thumbs/'.$name_thumb, 100);
      }
      else{
       $name =$request->diseaseimage;
      };
   
        $list =  Disease::find($id);
        $list->diseasename = $request->diseasename;
        $list->menwomen = $request->menwomen;
        $list->description= $request->description;
        $list->diseaseimage= $name;
        $list->update();
        if($list->save()){
            Cache::forget('disease');
            $disease=Disease::wherestatus(1)->latest()->take(20)->get();
            Cache::forever('disease',$disease);
          
            Toastr::success("Disease Edit Successfully ", "Well Done");
                return Redirect::to('superadmin/diseaselist'); 
            }
            else {
                Toastr::error("Disease Delete Failed", "Sorry");
                return Redirect::to('superadmin/diseaselist'); 
            }
    

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $disease=Disease::destroy($id);
       if($disease){
        Cache::forget('disease');
        $disease=Disease::wherestatus(1)->latest()->take(20)->get();
        Cache::forever('disease',$disease);
      
        Toastr::success("Disease Delete Successfully ", "Well Done");
        return Redirect::to('superadmin/diseaselist'); 
        }
        else {
            Toastr::error("Disease Delete Failed", "Sorry ");
            return Redirect::to('superadmin/diseaselist'); 
        }
}



    public function setapproval(Request $request){
        $id =$request->id;
        $roomapproval = Disease::find($id);
        if($request->action=="allow"){
            $roomapproval->status=2;
        }
        if($request->action=="deny"){
            $roomapproval->status=1;


        }
            $roomapproval->update();
            if($roomapproval->update()){
                Cache::forget('disease');
        $disease=Disease::wherestatus(1)->latest()->take(20)->get();
        Cache::forever('disease',$disease);
                return response()->json(['success' => true, 'message' =>' !']);
            }



    }
    // $product = Disease::Where('diseasename','LIKE','%%%'.$request->id."%%%")->orwhere('description','LIKE','%'.$request->id."%")->where('admin_id', Auth::user()->id)->select('product_name','product_image','waight_Kg','product_price','id')->latest()->take(30)->get();
public function searchdisease(Request $request){
//return response($request->all());exit;
        $output="";
        $searchvalue = Disease::Where('diseasename','LIKE','%%%'.$request->id."%%%")->orwhere('description','LIKE','%'.$request->id."%")->latest()->take(30)->get();
        if(count($searchvalue))
{
foreach ($searchvalue as $key => $searchval) {
$output.='<tr>'.
'<td>'.$searchval->id.'</td>'.
'<td>'.$searchval->diseasename.'</td>'.
'<td>                     
<img  src='.@asset("storage/app/files/shares/diseases/thumbs/thumb_$searchval->diseaseimage").' class="circle z-depth-2 responsive-img avtar">
</td>'.
'<td>'.$searchval->menwomen.'</td>'.
'<td>'.$searchval->description.'</td>'.
'<td>'.'<a target="_blank" href="'.url('superadmin/editdisease/'.$searchval->id).'" class="btn-floating mb-1 waves-effect waves-light"> <i class="material-icons">edit</i></a>'.'</td>'.
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
