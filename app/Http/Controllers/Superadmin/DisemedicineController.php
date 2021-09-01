<?php

namespace App\Http\Controllers\Superadmin;
use App\Models\Disease;
use App\Models\Medicine;
use App\Models\Disemedicine;
use Illuminate\Http\Request;
use Kamaln7\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class DisemedicineController extends Controller
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
        $medicine= Disemedicine::with('disease')->latest()->paginate(10);
        return view('superadmin.medicinefordisease.index',['pageConfigs' => $pageConfigs])->with('medicinefordisease',$medicine)   ->with('i', (request()->input('page', 1) - 1) * 2);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumbs = [
            ['link' => "superadmin", 'name' => "Home"], ['link' => "superadmin/disemedicinelist", 'name' => "Diseasemedicine"], ['name' => "Create"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
      $medicines=Medicine::pluck('medicinename','medicinename');
      $diseases= Disease::whereuse(1)->wheredmuse(0)->pluck('diseasename','id');
        return view('superadmin.medicinefordisease.create', compact('medicines','diseases','pageConfigs','breadcrumbs'));
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
    'disease_id' => 'required|unique:disemedicines',
    'medicine' => 'required',
    
    
]);
 //dd($request->all());exit;

    $userinfo = new Disemedicine(array(
       'disease_id' => $request->disease_id,
       'medicine' => json_encode($request->medicine, JSON_FORCE_OBJECT),
    
        ));


        if($userinfo->save()){
            Disease::find($request->disease_id)->update(array('dmuse' =>1));
            Toastr::success("Disease Create Successfully ", "Well Done");
            return Redirect::to('superadmin/disemedicinelist');
             
        }
        else {
            Toastr::error("Disease Create Failed", "Sorry ");
            return Redirect::to('superadmin/disemedicinelist');
        }
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Disemedicine  $disease
     * @return \Illuminate\Http\Response
     */
    public function show(Disemedicine $disease)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Disemedicine  $disease
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $breadcrumbs = [
            ['link' => "superadmin", 'name' => "Home"], ['link' => "superadmin/editdisemedicinelist", 'name' => "Diseasemedicine"], ['name' => "Edit"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        $medicines=Medicine::pluck('medicinename','medicinename');
        //$diseases= Disease::pluck('diseasename','id');
        $diseases= Disease::whereuse(1)->pluck('diseasename','id');
      
        $disease =Disemedicine::find($id);
        return view('superadmin.medicinefordisease.edit', compact('medicines','diseases','disease','breadcrumbs','pageConfigs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Disemedicine  $disease
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'disease_id' => 'required|unique:disemedicines,disease_id,'.$id,
         'medicine' => 'required',
       
        ]);
    
        $list =  Disemedicine::find($id);
        $list->disease_id = $request->disease_id;
        $list->medicine = $request->medicine;
       
        $list->update();
        if($list->save()){
            
            Toastr::info("Disease Update Successfully ", "Well Done");
            return Redirect::to('superadmin/disemedicinelist');
        }
        else {
            Toastr::error("Disease Update Failed", "Sorry ");
            return Redirect::to('superadmin/disemedicinelist');
        }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Disemedicine  $disease
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   $disease=Disemedicine::find($id);
        Disease::find($disease->disease_id)->update(array('dmuse' =>0));
    
       if($disease){
        Disemedicine::destroy($id);
        Toastr::warning("Disease delete Successfully ", "Well Done");
        return Redirect::to('superadmin/disemedicinelist');
    }
    else {
        Toastr::danger("Disease delete Failed", "Sorry");
        return Redirect::to('superadmin/disemedicinelist');
    }
    }


    public function searchdisemedicine(Request $request){
        $output="";
        $searchvalue = Disemedicine::Where('medicine','LIKE','%%%'.$request->id."%%%")->orwhere('medicinbn','LIKE','%'.$request->id."%")->latest()->take(30)->get();
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
