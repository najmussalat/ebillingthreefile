<?php

namespace App\Http\Controllers\Superadmin;
use App\Models\Disease;
use App\Helpers\CommonFx;
use App\Models\Medicine;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Kamaln7\Toastr\Facades\Toastr;
use App\Models\Medicineinformation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Redirect;

class MedicineinformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicineinformation=Medicineinformation::with('disease')->latest()->paginate(10);
        return view('superadmin.medicineinformation.index')->with('medicineinformation',$medicineinformation)->with('i', (request()->input('page', 1) - 1) * 10);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumbs = [
            ['link' => "superadmin", 'name' => "Home"], ['link' => "superadmin/medicineinformationlist", 'name' => "Medicineinformation"], ['name' => "Create"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        $diseases= Disease::whereuse(1)->pluck('diseasename','id');
        return view('superadmin.medicineinformation.create', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('diseases',$diseases);
    }


    
        public function store(Request $request)
        {
                 
   // return response(dd($request));exit;
    
    $this->validate($request,[
        'title' => 'required|min:3|max:160|unique:medicineinformations',
       'keyword' => 'required',
        'metadescription' => 'required',
        'disease_id' => 'required',
        // 'medicineinfo' => 'required',
        'description' => 'min:3|required',
        'photo' => 'required|image|mimes:jpeg,jpg|max:8000'
    ]);
        try {
            DB::beginTransaction();
            if ($request->hasfile('photo')) {
    
  
                $name =$request->photo->getClientOriginalName();
               $name_thumb = "thumb_" .$name;
               $request->photo->move(storage_path().'/app/files/shares/medicineinformation/', $name);
              // $resizedImage = Image::make(storage_path().'/app/public/files/diseases/' . $name);
             $resizedImage_thumb = Image::make(storage_path().'/app/files/shares/medicineinformation/' . $name)->resize(35, null, function ($constraint) {
                 $constraint->aspectRatio();
             });
              // save file as jpg with medium quality
             // $resizedImage->save(storage_path() . '/app/public/dashboardimage/profile/'.$name);
               $resizedImage_thumb->save(storage_path() . '/app/files/shares/medicineinformation/thumbs/'.$name_thumb, 100);
          }
          else{
           $name ='not-found.jpg';
          };
            $userinfo =Medicineinformation::create(array(
            'title' => $request->title,
            'slug' =>CommonFx::make_slug($request->title),
            'keyword' => $request->keyword,
            'photo' => $name,
            'minides' => $request->minides,
            'disease_id' => $request->disease_id,
            'metadescription' => $request->metadescription,
            // 'medicineinfo' => $request->medicineinfo,
             'superadmin_id' => Auth::guard('superadmin')->user()->id,
            'description' => $request->description,
                ));
         DB::commit();
                Disease::find($request->disease_id)->update(array('use' =>2));
                Cache::forget('medicineinformation');
                $medicineinfo=Medicineinformation::wherestatus(1)->latest()->take(20)->select('title','slug','photo','metadescription')->get();
                Cache::forever('medicineinformation',$medicineinfo);
                Toastr::success("Medicineinformation Create Successfully", "Well Done");
            return Redirect::to('superadmin/medicineinformationlist'); 
                }
                catch (\Exception $e) {
                    DB::rollBack();
                    Toastr::warning("Medicineinformation Create Successfully Fail", "Sorry Done");
                   return Redirect::to('superadmin/medicineinformationlist'); 
                }
            }

    /**
     * Display the specified resource.
     *
     * @param  \App\Medisine  $disease
     * @return \Illuminate\Http\Response
     */
    public function show(Medisine $disease)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Medisine  $disease
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $breadcrumbs = [
            ['link' => "superadmin", 'name' => "Home"], ['link' => "superadmin/medicineinformationlist", 'name' => "Medicineinformation"], ['name' => "Edit"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        $diseases= Disease::whereuse(1)->pluck('diseasename','id');
       $medicineinfoid =Medicineinformation::find($id);
        $diseases= Disease::whereuse(1)->pluck('diseasename','id');
        return view('superadmin.medicineinformation.edit', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('diseases',$diseases)->with('medicineinfoid',$medicineinfoid);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Medisine  $disease
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
        'title' => 'required|min:3|max:190|unique:medicineinformations,title,'.$id,
        'keyword' => 'required|min:3|max:190',
        'metadescription' => 'required|min:3|max:160',
         'disease_id' => 'required',
       'description' => 'min:3|required',
        ]);
        try {
            DB::beginTransaction();
     if ($request->hasfile('photo')) {
    
  
                $name =$request->photo->getClientOriginalName();
               $name_thumb = "thumb_" .$name;
               $request->photo->move(storage_path().'/app/files/shares/medicineinformation/', $name);
              // $resizedImage = Image::make(storage_path().'/app/public/files/diseases/' . $name);
             $resizedImage_thumb = Image::make(storage_path().'/app/files/shares/medicineinformation/' . $name)->resize(35, null, function ($constraint) {
                 $constraint->aspectRatio();
             });
              // save file as jpg with medium quality
             // $resizedImage->save(storage_path() . '/app/public/dashboardimage/profile/'.$name);
               $resizedImage_thumb->save(storage_path() . '/app/files/shares/medicineinformation/thumbs/'.$name_thumb, 100);
          }
          else{
           $name =$request->oldphoto;
          };
$info= Medicineinformation::find($id);
if($request->disease_id != $info->disease_id){
    Medicineinformation::find($info->id)->update(array('use' => 1));
    
}
else{
    Medicineinformation::find($request->disease_id)->update(array('use' => 2));
}
        $list =  Medicineinformation::find($id);
        $list->title = $request->title;
        $list->keyword = $request->keyword;
        $list->metadescription= $request->metadescription;
        $list->disease_id= $request->disease_id;
        $list->description= $request->description;
        $list->photo= $name;
        $list->update();
            
        DB::commit();
        Cache::forget('medicineinformation');
        $medicineinfo=Medicineinformation::wherestatus(1)->latest()->take(20)->select('title','slug','photo','metadescription')->get();
        Cache::forever('medicineinformation',$medicineinfo);
        Toastr::success("Medicineinformation Update Successfully ", "Well Done");
         return Redirect::to('superadmin/medicineinformationlist'); 
        }
        catch (\Exception $e) {
            DB::rollBack();
            Toastr::warning("Medicineinformation Create Successfully Fail", "Sorry Done");
                  return Redirect::to('superadmin/medicineinformationlist'); 
        }
    }


 
    public function destroy($id)
    {
        $delete=Medicineinformation::destroy($id);
        
      
        if($delete) {
            Cache::forget('medicineinformation');
            $medicineinfo=Medicineinformation::wherestatus(1)->latest()->take(20)->select('title','slug','photo','metadescription')->get();
            Cache::forever('medicineinformation',$medicineinfo);
             Toastr::danger("Medicineinformation Delete Successfully", "Done");
            return Redirect::to('superadmin/medicineinformationlist'); 
         } else {
              Toastr::warning("Medicineinformation Delete Successfully Fail", "Sorry Done");
             return Redirect::to('superadmin/medicineinformationlist'); 
         }
    }

   public function setapproval(Request $request){
        $id =$request->id;
        $roomapproval = Medicineinformation::find($id);
        if($request->action=="allow"){
            $roomapproval->status=2;
        }
        if($request->action=="deny"){
            $roomapproval->status=1;


        }
            $roomapproval->update();
            if($roomapproval->update()){
                Cache::forget('disease');
        $medicineinfo=Medicineinformation::wherestatus(1)->latest()->take(20)->select('title','slug','photo','metadescription')->get();
       Cache::forever('medicineinformation',$medicineinfo);
                return response()->json(['success' => true, 'message' =>' !']);
            }



    }
    // account active inactive start
   
      public function searchmedicine(Request $request){
        $output="";
        $searchvalue = Medicineinformation::Where('title','LIKE','%%%'.$request->id."%%%")->orwhere('metadescription','LIKE','%'.$request->id."%")->latest()->take(30)->get();
        if(count($searchvalue))
{
foreach ($searchvalue as $key => $searchval) {
$output.='<tr>'.
'<td>'.$searchval->id.'</td>'.
'<td>'.$searchval->title.'</td>'.
'<td>'.$searchval->metadescription.'</td>'.
'<td>'.$searchval->status.'</td>'.
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
