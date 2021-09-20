<?php
namespace App\Http\Controllers\Superadmin;
use App\Models\Admin;
use App\Models\Buysms;
use App\Models\Payment;
use App\Models\Smssent;
use App\Models\Customer;
use Illuminate\Http\Request;
use Kamaln7\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Contracts\DataTable;
use App\Notifications\Superadminnotification;
use App\Notifications\Adminupdatenotification;

class BuysmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        {
            if (request()->ajax()) {
              return datatables()->of(Buysms::with('admin','payment')->latest())
                ->addColumn('action', function ($data) {
                  $button = '<a title="Edit Sale SMS" href="/superadmin/editsalesms/' . $data->id . '" class="invoice-action-view"><i class="material-icons">edit</i></a>';
                  $button .= '&nbsp;&nbsp;';
                 $button .= '<button type="button" title="Delete"  id="deleteBtn" rid="' . $data->id . '" class="invoice-action-view btn-sm "><i class="material-icons ">delete</i></button>';
                  return $button;
                })
                ->addColumn('status', function($data){
                  if($data->status==0){
                 $button = '<button type="button" rid="'.$data->id.'" class="btn-sm Approved" title="Click for Aprove Status"><i class="material-icons">block</i></button>';
                return $button;
            }
            
            else {
                $button = '<button type="button" title="Aprove  Payment" class=" btn-sm" ><i class="material-icons">beenhere</i> </button>';
                return $button;
            }})
            ->addColumn('admin' ,function($data){
                return $data->admin->name;
            })  
                ->addIndexColumn()
                ->rawColumns(['action','admin','status'])
                ->make(true);
            }
            $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];
        
            return view('superadmin.smssale.index')->with('pageConfigs', $pageConfigs);
    }
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
        $admin=Admin::wherestatus(1)->pluck('name','id');
        $payment=Payment::pluck('paymentname','id');
        return view('superadmin.smssale.create', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('admins',$admin)->with('payment',$payment);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'admin_id' => 'required',
            'payment_id' => 'required',
            'payamount' => 'required',
            ]);
    
           $info= Buysms::create($request->all()+['status'=>1,'superdmin_id'=>Auth::id()]);
                if($info){
                    $buy=Smssent::whereadmin_id($request->admin_id)->first();
                    $buy->blance +=trim($request->payamount);
                    $buy->save();
                }
                if($buy){
                    $data = [
            
                        'admindata' =>'<a class="black-text"  href="'. url('/admin/buysmsdetails/'.$info->id) . '"> Superadmin Sent SMS Blance ' .$info->payamount .'</a>',
                ];
                  
                  Admin::find($info->admin_id)->notify(new Adminupdatenotification($data));
                
                
                    Toastr::success("Buysms Create Successfully", "Done");
                    return Redirect::to('superadmin/salesmslist'); 
                }
                   else{
                    Toastr::warning("Buysms Create Fail ", "Sorry");
                    return Redirect::to('superadmin/salesmslist'); 
                   }     
                   
                    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Buysms  $buysms
     * @return \Illuminate\Http\Response
     */
    public function show(Buysms $buysms)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Buysms  $buysms
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $breadcrumbs = [
            ['link' => "superadmin/dashboard", 'name' => "Home"], ['link' => "superadmin/salesmslist", 'name' => "SMS"], ['name' => "Create"],
        ];
        $sms=Buysms::find($id);
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        $admin=Admin::wherestatus(1)->pluck('name','id');
        $payment=Payment::pluck('paymentname','id');
        return view('superadmin.smssale.edit', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('admins',$admin)->with('payment',$payment)->with('infos',$sms);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Buysms  $buysms
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'admin_id' => 'required',
            'payment_id' => 'required',
            'payamount' => 'required',
            ]);
    
          
           $info= Buysms::find($id);
                if($info->status==1){
                    if($info->payamount>$request->payamount){
                    //dd($info->payamount);
                    $buy=Smssent::whereadmin_id($request->admin_id)->first();
                    $buy->blance -=trim($info->payamount-$request->payamount);
                    $buy->save();
                } 
                   if($info->payamount<$request->payamount){
                   // dd('true2');
                    $buy=Smssent::whereadmin_id($request->admin_id)->first();
                    $buy->blance +=trim($request->payamount-$info->payamount);
                    $buy->save();
                }
                }
                else{
                    if($request->status==1){
                         $buy=Smssent::whereadmin_id($info->admin_id)->first();
                    $buy->blance +=trim($request->payamount);
                    $buy->save();
if($buy){
    
    $data = [
            
        'admindata' =>'<a class="black-text"  href="'. url('/admin/showbuysmsdetails/'.$id) . '"> SMS Application Approved </a>',
];
  
  Admin::find($info->admin_id)->notify(new Adminupdatenotification($data));


                    }
                    }
                }
                Buysms::find($id)->update($request->all()+['superdmin_id'=>Auth::id()]);
                if($info){
                    Toastr::info("Buysms Create Successfully", "Done");
                    return Redirect::to('superadmin/salesmslist'); 
                }
                   else{
                    Toastr::warning("Buysms Create Fail ", "Sorry");
                    return Redirect::to('superadmin/salesmslist'); 
                   }     
                    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buysms  $buysms
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = [
            
            'admindata' =>'<a class="black-text"  href="'. url('/admin/buysmslist/') . '"> Superadmin Delete  Your Buy SMS Request</a>',
    ];
      $info=Buysms::findOrFail($id);
      Admin::find($info->admin_id)->notify(new Adminupdatenotification($data));
      return response(Buysms::findOrFail($id)->delete()); 
    }

    
  public function setapproval($id){
   
    $roomapproval = Buysms::find($id);
    $roomapproval->status=1;
    $roomapproval->save();
    
    if($roomapproval){
        $buy=Smssent::whereadmin_id($roomapproval->admin_id)->first();
                    $buy->blance +=trim($roomapproval->payamount);
                    $buy->save();
if($buy){
    
    $data = [
            
        'admindata' =>'<a class="black-text"  href="'. url('/admin/showbuysmsdetails/'.$roomapproval->id) . '"> SMS Application Approved </a>',
];
  
  Admin::find($roomapproval->admin_id)->notify(new Adminupdatenotification($data));


    return response()->json(['success' => true, 'message' =>'Sms Bill Approved']);
}
   

    }

} 
}
