<?php

namespace App\Http\Controllers\Admin;
use Validator;
use App\Models\Area;
use App\Models\Bill;
use App\Models\User;
use App\Models\Thana;
use App\Models\Complain;
use App\Models\Customer;
use App\Helpers\CommonFx;
use App\Jobs\Sendsuersms;
use App\Models\Collection;
use App\Models\Complaintext;
use Illuminate\Http\Request;
use App\Models\Complaindetils;
use Illuminate\Validation\Rule;
//use Illuminate\Database\Query\Builder;
use Kamaln7\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\Redirect;
use App\Notifications\Customernotification;
 use Illuminate\Database\Eloquent\Builder;

class ComplainController extends Controller
{
    public function index(){
      // dd(Complain::with('admin','customer')->get());
      if (request()->ajax()) {
        return datatables()->of(Complain::with('admin','customer')->whereadmin_id(Auth::id())->latest())
          ->addColumn('action', function ($data) {
            $button = '<a title="Edit Or Aprove Complain" href="/admin/editcomplain/' . $data->id . '" class="invoice-action-view"><i class="material-icons">edit</i></a>';
            $button .= '&nbsp;&nbsp;';
            $button .= '<a title="Reply Message" href="/admin/replycomplain/' . $data->id . '" class="iinvoice-action-view btn-sm"><i class="material-icons">reply_all</i></a>';
            $button .= '&nbsp;&nbsp;';
            $button .= '<button type="button" title="Delete Complain"  id="deleteBtn" rid="' . $data->id . '" class="invoice-action-view btn-sm"><i class="material-icons ">delete_forever
            </i></button>';
            return $button;
          })
          ->addColumn('customerid' ,function($data){
            return $data->customer->loginid;
        }) 
        ->addColumn('phone' ,function($data){
          return $data->customer->customermobile;
      }) 
           ->addColumn('name' ,function($data){
          return $data->customer->customername;
      })
      ->addColumn('adminname' ,function($data){
          return $data->admin->name;
      })  ->addColumn('complaintitle' ,function($data){
        
            foreach(json_decode($data->complainheding) as  $v)
            {
              return ($v.' ...');
            }
          ;
      }) 
          ->addColumn('status', function($data){
            if($data->status==0){
           $button = '<a href="#" disabled  class="btn-sm " title="Not Open"><i class="material-icons">block</i></a>';
          return $button;
      }
      elseif($data->status==1){
        $button = '<a href="#" disabled  class="btn-sm Approved" title="Pending"><i class="material-icons">comment</i></a>';
       return $button;
   }
   
      
      else {
          $button = '<a href="#" disabled title="Close" class=" btn-sm" ><i class="material-icons">done_all</i> </a>';
          return $button;
      }})
     
          ->addIndexColumn()
          ->rawColumns(['action','status','customerid','phone','name','adminname','complaintitle',''])
          ->make(true);
      }
      $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];
  
      return view('admin.complain.index')->with('pageConfigs', $pageConfigs);

     
        }
      
      
       public function create(){
     $breadcrumbs = [
            ['link' => "admin", 'name' => "Home"], ['link' => "admin/complainlist", 'name' => "Complain"], ['name' => "Create"],
        ];
      
          $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        
        return view('admin.complain.create', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
      
        }

       public function opencomplainsetting(){
        if (request()->ajax()) {
          return datatables()->of(Complaintext::whereadmin_id(Auth::id())->latest())
            ->addColumn('action', function ($data) {
              $button = '<button title="Edit Title" id="editBtn" rid="' . $data->id . '" class="invoice-action-view"><i class="material-icons">edit</i></button>';
              $button .= '&nbsp;&nbsp;';
               $button .= '<button title="Delete Title" id="deleteBtn"  rid="' . $data->id . '" class="invoice-action-view"><i class="material-icons">delete_forever</i></button>';
                  return $button;
            })
        
       
            ->addIndexColumn()
            ->rawColumns(['action','status'])
            ->make(true);
          }
        $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];
    
        return view('admin.complain.complainsetting')->with('pageConfigs', $pageConfigs);

}
      

             public function storecomplainsetting(Request $request){
              $this->validate($request, [
              'complaintitle' => ['required', 'min:1', 'max:198', Rule::unique('complaintexts')->where(function ($query) {
        return $query->where('admin_id', Auth::user()->id);
      })],
    ]);
    $info= Complaintext::create($request->all()+['admin_id'=>Auth::id()]);
    if ($info) {
         
         return response()->json(['success' => true]);
     } else {
         return response()->json(['success' => false]);
     }
      
        }
             public function updatecomplainsetting(Request $request,$id){
              $this->validate($request, [
              'complaintitle' => ['required', 'min:1', 'max:198', Rule::unique('complaintexts')->where(function ($query) {
        return $query->where('admin_id', Auth::user()->id);
      })],
    ]);
    $info= Complaintext::find($id)->update($request->all()+['admin_id'=>Auth::id()]);
    if ($info) {
         
         return response()->json(['success' => true]);
     } else {
         return response()->json(['success' => false]);
     }
      
        }
      
             public function editcomplainsetting($id){
           
    $info= Complaintext::find($id);
    return response()->json($info);
    
        }
        public function deletecomplainsetting($id){
           
    $info= Complaintext::destroy($id);
    return response()->json($info);
    
        }
      
      
      public function store(Request $request){
        // dd($request->all());exit;
        $this->validate($request,[
          
          'customer_id' => 'required|min:1',
          'complainmessage' => 'max:198',
           'complainheding' => 'required',
         ]);
          $pay= new Complain();
          $pay->customer_id =trim($request->customer_id);
         $pay->admin_id =Auth::id();
         $pay->complainmessage =trim($request->complainmessage);
         $pay->status =trim(1);
         $pay->complainheding =json_encode($request->complainheding, JSON_FORCE_OBJECT);
         $pay->save();
          
       if($pay){
        $info=User::whereadmin_id(Auth::id())->first();
        if($info){
         $customer= Customer::with('area')->find($request->customer_id);
         $requestuser= $request->users;
          for ($i = 0; $i < count($requestuser); $i++) {
          
            $user=User::find($requestuser[$i]);
          
              $data = [
                'admin_id'=>Auth::id(),
                'customercomplain' =>$request->complainheding[0],
                'customercomment' =>$request->complainmessage,
                'customername'=>$customer->customername,
                'customerphone'=>$customer->customermobile,
                'number'=>$user->phone,
                'address'=>$customer->area->areaname,
                'id'=>$customer->loginid,
                'ip'=>$customer->ip,
                'oppusername'=>$customer->oppusername,
              ];
              
              Sendsuersms::dispatch($data);
              }
            }
       
        $info= new Complaindetils();
        $info->complain_id =trim($pay->id);
       $info->messageby =Auth::user()->name;
       $info->adminseen =1;
       $info->message =trim($request->complainmessage?:'No Comversation text');
       $info->save();
       }
      
       $data = [
            
        'customerdata' =>'<a class="black-text"  href="'. url('/customer/complaindetails/'.$pay->id) . '">'. Auth::user()->name. 'Create A Complain For You </a>',
];

Customer::find($request->customer_id)->notify(new Customernotification($data));
$cus=Customer::find($request->customer_id);
       $smsinfo=['name'=>$cus->customername,'mobile'=>$cus->customermobile,'complain'=>$request->complainheding[0],'message'=>$request->complainmessage];
       CommonFx::Sendsmsopencomplain($smsinfo);
       Toastr::success("Complate Create Successfully", "Well Done");
       return Redirect::to('admin/complainlist'); 
          
      }


      public function edit($id){
        $breadcrumbs = [
               ['link' => "admin/dashboard", 'name' => "Home"], ['link' => "admin/complainlist", 'name' => "Complain"], ['name' => "edit"],
           ];
          
             $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
           $complain=Complain::whereadmin_id(Auth::id())->find($id);
           $compiainin=json_decode($complain->complainheding,TRUE);
           return view('admin.complain.edit', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('info',$complain)->with('complaininfo',$compiainin);
         
           }




public function show($id){
$info=Complain::with('customer','complaindetils')->whereadmin_id(Auth::id())->find($id);
if($info->status==0){
  $info->update(['admin_id'=>Auth::id(),'status'=>1]);
 return view('admin.complain.show')->with('infos',$info); 
}
else{
  return view('admin.complain.show')->with('infos',$info); 
}

}

         public function destroy($id){
         
             $divisioninfo=Complain::whereadmin_id(Auth::id())->findOrFail($id)->delete();
             return response()->json([
              'success'=>false
            
            ],201);
             }


      public function searchsinglecustomer(Request $request){
        if(! $request->id==null){
        $searchvalue = Customer::with('district','thana','area','bill.collection')->whereadmin_id(Auth::id())->Where('loginid','LIKE','%'.$request->id."%")->orwhere('customermobile','LIKE','%'.$request->id."%")->orwhere('customername','LIKE','%'.$request->id."%")->orwhere('secretname','LIKE','%'.$request->id."%")->orwhere('id','LIKE','%'.$request->id."%")->first();
        
        if($searchvalue)
{
return response()->json([
  'result'=>$searchvalue

],200);
}
}
   else{
    return response()->json([
      'success'=>false
    
    ],204 );
   }
    
      }


      public function update(Request $request,$id){
        // dd($request->all());exit;
        $this->validate($request,[
          
          'customer_id' => 'required|min:1',
          'complainmessage' => 'max:198',
           'complainheding' => 'required',
         ]);
          $pay=Complain::find($id);
          $pay->customer_id =trim($request->customer_id);
         $pay->admin_id =Auth::id();
         $pay->complainmessage =trim($request->complainmessage);
        $pay->complainheding =json_encode($request->complainheding, JSON_FORCE_OBJECT);
         $pay->save();
       
       Toastr::success("Complate Update Successfully", "Well Done");
       return Redirect::to('admin/complainlist'); 
          
      }

   public function replycomplain(Request $request){
$info=Complaindetils::find($request->id);
$info->replymessage=$request->replymessage;
  $info->adminseen=1;
  $info->save();

return response()->json([
  'success'=>true
],200);
      }
   public function addcomplaintext(Request $request){
$info=new Complaindetils;
$info->replymessage=$request->replysms;
$info->complain_id=$request->id;
  $info->adminseen=1;
  $info->save();
if($info){
$complain=Complain::find($request->id);
  $data = [
            
    'customerdata' =>'<a class="black-text"  href="'. url('/customer/complaindetails/'.$complain->id) . '">'. Auth::user()->name. 'Reply Your Complain  </a>',
];

Customer::find($complain->customer_id)->notify(new Customernotification($data));
$cus=Customer::find($complain->customer_id);

   $smsinfo=['name'=>$cus->customername,'tktno'=>$request->id,'mobile'=>$cus->customermobile,'complain'=>json_decode($complain->complainheding,TRUE),'message'=>$request->replysms];
   CommonFx::Sendsmsopencomplainupdate($smsinfo);
}
return response()->json([
  'success'=>true
  ],200);
      }
      public function closecomplain($id){
        $complain=Complain::find($id);
         $complain->status=2;
          $complain->save();
         
          $data = [
                    
            'customerdata' =>'<a class="black-text"  href="'. url('/customer/complaindetails/'.$complain->id) . '">'. Auth::user()->name. ' Close Your Complain  </a>',
        ];
        
        Customer::find($complain->customer_id)->notify(new Customernotification($data));
        $cus=Customer::find($complain->customer_id);
        
           $smsinfo=['name'=>$cus->customername,'mobile'=>$cus->customermobile];
           CommonFx::Sendsmsopencomplainclose($smsinfo);
        
        return response()->json([
          'success'=>true
        ],200);
              }
}
