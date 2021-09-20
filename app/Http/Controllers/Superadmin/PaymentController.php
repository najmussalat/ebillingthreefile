<?php

namespace App\Http\Controllers\superadmin;
use App\Models\Blog;
use App\Helpers\CommonFx;
use App\Models\Medicine;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Kamaln7\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\ImageManagerStatic as Image;
//use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $infos=Payment::latest()->paginate(10);
        return view('superadmin.payment.index')->with('infos',$infos)->with('i', (request()->input('page', 1) - 1) * 10);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumbs = [
            ['link' => "superadmin", 'name' => "Home"], ['link' => "superadmin/paymentlist", 'name' => "Blog"], ['name' => "Create"],
        ];
        
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        
        return view('superadmin.payment.create', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
    }


    
        public function store(Request $request)
        {
                 
    //return response(dd($request));exit;
    
      $this->validate($request,[
        'paymentname' => 'required|min:3|max:190|unique:payments',
        ]);

    Payment::create( $request->all());
            
                    
                Toastr::info("Payment Create Successfully", "Done");
                return Redirect::to('superadmin/paymentlist'); 
                }

    /**
     * Display the specified resource.
     *
     * @param  \App\Medisine  $disease
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        $payment=Payment::find($id);
         $breadcrumbs = [
            ['link' => "superadmin", 'name' => "Home"], ['link' => "superadmin/paymentlist", 'name' => "Payment"], ['name' => "Edit"],
        ];
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
       return view('superadmin.payment.edit',compact('payment'), ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
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
            'paymentname' => 'required|min:3|max:190|unique:payments,paymentname,'.$id,
            ]);
    
        Payment::find($id)->update( $request->all());
                
                        
                    Toastr::info("Payment Update Successfully", "Done");
                    return Redirect::to('superadmin/paymentlist'); 
                    
    
    }


 
    public function destroy($id)
    {
       Payment::destroy($id);
           
             Toastr::warning("Payment Delete Successfully", "Done");
            return Redirect::to('superadmin/paymentlist'); 

    }

   public function setapproval(Request $request){
        $id =$request->id;
        $roomapproval = Blog::find($id);
        if($request->action=="allow"){
            $roomapproval->status=2;
        }
        if($request->action=="deny"){
            $roomapproval->status=1;


        }
            $roomapproval->update();
            if($roomapproval->update()){
              
                return response()->json(['success' => true, 'message' =>' !']);
            }



    }
    // account active inactive start
   
      public function searchblog(Request $request){
        $output="";
        $searchvalue = Blog::Where('title','LIKE','%%%'.$request->id."%%%")->orwhere('metadescription','LIKE','%'.$request->id."%")->latest()->take(30)->get();
        if(count($searchvalue))
{
foreach ($searchvalue as $key => $searchval) {
$output.='<tr>'.
'<td>'.$searchval->id.'</td>'.
'<td>'.$searchval->title.'</td>'.
'<td>'.$searchval->metadescription.'</td>'.
'<td>'.$searchval->status.'</td>'.
'<td>'.'<a target="_blank" href="'.url('superadmin/editblog/'.$searchval->id).'" class="btn-floating mb-1 waves-effect waves-light"> <i class="material-icons">edit</i></a>'.'</td>'.
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
