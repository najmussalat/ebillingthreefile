<?php
namespace App\Http\Controllers\Admin;
use App\Models\Admin;
use App\Models\Buysms;
use App\Models\Payment;
use App\Models\Smssent;
use App\Models\Customer;
use Illuminate\Http\Request;
use Kamaln7\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use App\Models\Superadmin;
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
              return datatables()->of(Buysms::with('payment')->whereadmin_id(Auth::id())->latest())
                ->addColumn('action', function ($data) {
                  $button = '<a title="Edit Sale SMS" href="/admin/editbuysms/' . $data->id . '" class="invoice-action-view"><i class="material-icons">edit</i></a>';
                  $button .= '&nbsp;&nbsp;';
                   $button .= '<a title="Print Sale SMS Invoice" href="/admin/showbuysmsdetails/' . $data->id . '" class="invoice-action-view"><i class="material-icons">print</i></a>';
                  $button .= '&nbsp;&nbsp;';
                 $button .= '<a href="/admin/downloadesmsinvoice/'.$data->id.'"  title="Download Invoice As Pdf"  class="invoice-action-view btn-sm"><i class="material-icons ">file_download</i></a>';
                  return $button;
                })
                ->addColumn('status', function($data){
                  if($data->status==0){
                 $button = '<a href="#" disabled  class="btn-sm Approved" title="Pending"><i class="material-icons">block</i></a>';
                return $button;
            }
            
            else {
                $button = '<a href="#" disabled title="Apreoved" class=" btn-sm" ><i class="material-icons">beenhere</i> </a>';
                return $button;
            }})
           
                ->addIndexColumn()
                ->rawColumns(['action','status'])
                ->make(true);
            }
            $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];
        
            return view('admin.buysms.index')->with('pageConfigs', $pageConfigs);
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
            ['link' => "admin/dashboard", 'name' => "Home"], ['link' => "superadmin/buysmslist", 'name' => "SMS"], ['name' => "Create"],
        ];
        
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
         $payment=Payment::pluck('paymentname','id');
        return view('admin.buysms.create', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('payment',$payment);
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
            'payment_id' => 'required',
            'payamount' => 'required',
            ]);
    
           $info= Buysms::create($request->all()+['admin_id'=>Auth::id()]);
                
                if($info){
                    $data = [
            
                        'superadminboady' =>'<a class="black-text"  href="'. url('/superadmin/editsalesms/'.$info->id) . '">'. Auth::user()->name. ' Want To Buy SMS ' .$info->payamount .'TK</a>',
                ];
                  
                  Superadmin::first()->notify(new Superadminnotification($data));
                
                
                    Toastr::success("Buy Request Sent Successfully", "Done");
                    return Redirect::to('admin/buysmslist'); 
                }
                   else{
                    Toastr::warning("Buysms Create Fail ", "Sorry");
                    return Redirect::to('admin/salesmslist'); 
                   }     
                   
                    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Buysms  $buysms
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
        $sms=Buysms::with('payment')->find($id);
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        return view('admin.buysms.show', ['pageConfigs' => $pageConfigs])->with('infos',$sms);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Buysms  $buysms
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sms=Buysms::find($id);
        if($sms->status==0){
        $breadcrumbs = [
            ['link' => "admin/dashboard", 'name' => "Home"], ['link' => "superadmin/buysalelist", 'name' => "SMS"], ['name' => "Edit"],
        ];
       
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        $payment=Payment::pluck('paymentname','id');
        return view('admin.buysms.edit', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('payment',$payment)->with('infos',$sms);
    }
    else{
        Toastr::info("Sorry You Cannot Edit", "Sorry");
        return Redirect::to('admin/buysmslist'); 
    }
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
            'payment_id' => 'required',
            'payamount' => 'required',
            ]);
    
           $info= Buysms::find($id)->update($request->all()+['admin_id'=>Auth::id()]);
                
                if($info){
                    $data = [
            
                        'superadminboady' =>'<a class="black-text"  href="'. url('/superadmin/editsalesms'.$id) . '">'. Auth::user()->name. ' Change  Buy SMS Info </a>',
                ];
                  
                  Superadmin::first()->notify(new Superadminnotification($data));
                
                
                    Toastr::success("Buy Request Update Successfully", "Done");
                    return Redirect::to('admin/buysmslist'); 
                }
                   else{
                    Toastr::warning("Buysms Update Fail ", "Sorry");
                    return Redirect::to('admin/salesmslist'); 
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
        return response(Buysms::findOrFail($id)->delete()); 
    }

    
  public function setapproval($id){
   
    $roomapproval = Buysms::find($id);
    $roomapproval->status=0;
    $roomapproval->save();
    
    if($roomapproval){
        $buy=Smssent::whereadmin_id($roomapproval->admin_id)->first();
                    $buy->blance +=trim($roomapproval->payamount);
                    $buy->save();
if($buy){
    
    $data = [
            
        'admindata' =>'<a class="black-text"  href="'. url('/admin/buysmsdetails/'.$roomapproval->id) . '"> SMS Application Approved </a>',
];
  
  Admin::find($roomapproval->admin_id)->notify(new Adminupdatenotification($data));


    return response()->json(['success' => true, 'message' =>'Sms Bill Approved']);
}
   

    }

} 
}
