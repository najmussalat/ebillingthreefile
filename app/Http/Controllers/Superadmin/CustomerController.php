<?php

namespace App\Http\Controllers\Superadmin;

use App\Models\Bill;
use App\Models\Smssent;
use App\Models\Customer;
use App\Helpers\CommonFx;
use Illuminate\Support\Str;
use App\Events\SendsmsEvent;
use Illuminate\Http\Request;
use App\Jobs\Sendcustomersms;
use Illuminate\Validation\Rule;
use Kamaln7\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Event;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Contracts\DataTable;
use Illuminate\Pagination\LengthAwarePaginator;


class CustomerController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    if (request()->ajax()) {
      return datatables()->of(Customer::with('admin','district','thana','area','bill.collection'))
        ->addColumn('action', function ($data) {
          $button ='<button type="button" id="UpdateBillBtn" style="border:0; background: none; padding: 0 !important; margin: 0 !important" uid="' . $data->bill[0]->id . '" class="invoice-action-view btn-sm" title="Update Bill"><i class="material-icons" style="font-size: 16px; color: #F77B00;">sync</i></button>'; 
          $button .= '&nbsp;&nbsp;';
          $button .= '<a title="Edit Customer" href="/superadmin/editcustomer/' . $data->id . '" class="btn-sm" style="border:0; background: none; padding: 0 !important"><i class="material-icons" style="font-size: 16px; color: #9B01BA;">edit</i></a>';
          $button .= '&nbsp;&nbsp;';
          $button .= '<a target="_blank" style="border:0; background: none; padding: 0 !important" href="' . url('admin/customerprofile', $data->id) . '" class="btn-sm" title="See Preview"><i class="material-icons " style="font-size: 16px; color: #16A66C;">remove_red_eye</i></a>';
        //  $button .= '&nbsp;&nbsp;';
        //   $button .= '<button type="button" title="Inactive Customer"  id="deleteBtn" rid="' . $data->id . '" class="invoice-action-view btn-sm "><i class="material-icons ">https</i></button>';
          return $button;
        })
        ->addColumn('status', function($data){
          if($data->status==1){
         $button = '<button type="button" rid="'.$data->id.'" class="btn-sm Approved" title="Update Status"><i class="material-icons">beenhere</i></button>';
        return $button;
    }
    
    else {
        $button = '<button type="button" title="Update Status" class=" btn-sm Notapproved" rid="'.$data->id.'"><i class="material-icons">block</i> </button>';
        return $button;
    }})
    
      ->addColumn('monthlyrent' ,function($data){
       
        return $data->bill[0]->monthlyrent;
    })  
        ->addColumn('due' ,function($data){
        return $data->bill[0]->due;
    }) 
      ->addColumn('discount' ,function($data){
        return $data->bill[0]->discount;
    }) 
        ->addColumn('advance' ,function($data){
        return $data->bill[0]->advance;
    }) 
    ->addColumn('addicrg' ,function($data){
        return $data->bill[0]->addicrg;
    })
     ->addColumn('vat' ,function($data){
        return $data->bill[0]->vat;
    }) 
      ->addColumn('billamount' ,function($data){
        return $data->bill[0]->total;
    })
    ->addColumn('collection' ,function($data){
      return $data->bill[0]->collection->sum('paid');
  })
  ->addColumn('duetotal' ,function($data){
    return (($data->bill[0]->total));
})
      ->addColumn('address' ,function($data){
        return 'House No- '. @$data->houseno.'<br/>'. @$data->district->district.'<br/>'.@$data->thana->thana.'<br/>'.@$data->area->areaname;
    })
   
        ->addIndexColumn()
        ->rawColumns(['action','duetotal','status','address'])
        
        ->make(true);
    }
    $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];

    return view('superadmin.customer.index')->with('pageConfigs', $pageConfigs);
  }
  public function pendingcustomer(Request $request)
  {
    if (request()->ajax()) {
      return datatables()->of(Customer::with('district','thana','area','bills.collection')->whereadmin_id(Auth::guard('admin')->user()->id)->wherestatus(2))
        ->addColumn('action', function ($data) {
          $button ='<button type="button" id="UpdateBillBtn" uid="' . $data->bills[0]->id . '" class="invoice-action-view btn-sm" title="Update Bill"><i class="material-icons ">update</i></button>'; 
          $button .= '&nbsp;&nbsp;';
          $button .= '<a title="Edit Customer" href="/admin/editcustomer/' . $data->id . '" class="invoice-action-view" title="Edit Customer"><i class="material-icons">edit</i></a>';
          $button .= '&nbsp;&nbsp;';
          $button .= '<a target="_blank" href="' . url('admin/customerprofile', $data->id) . '" class="invoice-action-view" title="See Preview"><i class="material-icons ">remove_red_eye</i></a>';

          // $button .= '&nbsp;&nbsp;';
          // $button .= '<button type="button" title="Inactive Customer"  id="deleteBtn" rid="' . $data->id . '" class="invoice-action-view btn-sm"><i class="material-icons ">https</i></button>';
          return $button;
        })
        ->addColumn('status', function($data){
          if($data->status==1){
         $button = '<button type="button" title="Update Status" rid="'.$data->id.'" class="btn-sm Approved"><i class="material-icons">beenhere</i></button>';
        return $button;
    }
    
    else {
        $button = '<button type="button" title="Update Status" class=" btn-sm Notapproved" rid="'.$data->id.'"><i class="material-icons">block</i> </button>';
        return $button;
    }})
        ->addColumn('monthlyrent' ,function($data){
          return $data->bills[0]->monthlyrent;
      })  
      ->addColumn('due' ,function($data){
        return $data->bills[0]->due;
    }) 
      ->addColumn('discount' ,function($data){
        return $data->bills[0]->discount;
    }) 
        ->addColumn('advance' ,function($data){
        return $data->bills[0]->advance;
    }) 
    ->addColumn('addicrg' ,function($data){
        return $data->bills[0]->addicrg;
    })
     ->addColumn('vat' ,function($data){
        return $data->bills[0]->vat;
    }) 
      ->addColumn('billamount' ,function($data){
        return $data->bills[0]->total;
    })
    ->addColumn('collection' ,function($data){
      return $data->bills[0]->collection->sum('paid');
  })
  ->addColumn('duetotal' ,function($data){
    return ($data->bills[0]->total);
})
      ->addColumn('address' ,function($data){
        return 'House No- '. @$data->houseno.'<br/>'. @$data->district->district.'<br/>'.@$data->thana->thana.'<br/>'.@$data->area->areaname;
    })
        ->addIndexColumn()
        ->rawColumns(['action','duetotal','status','address'])
        ->make(true);
    }
    $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];

    return view('admin.customer.pendingcustomer')->with('pageConfigs', $pageConfigs);
  }
  public function create()
  {
    $breadcrumbs = [
      ['link' => "admin/dashboard", 'name' => "Home"], ['link' => "admin/customerlist", 'name' => "Customer"], ['name' => "Create"],
    ];

    $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];

    return view('admin.customer.create', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
  }
  public function inactivecustomer()
  {
    $breadcrumbs = [
      ['link' => "admin/dashboard", 'name' => "Home"], ['link' => "admin/inactivecustomer", 'name' => "Customer"], ['name' => "Inacitve"],
    ];

    $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];

    return view('admin.customer.inacitve', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
  }
   public function findinactivecustomer(Request $request)
  {
    if($request->to==!null && $request->from==null){
   
      $info=Customer::whereadmin_id(Auth::id())->wherecountry_id($request->country_id)->whereDate('created_at', '=', $request->to)->wherestatus(3)->get();
    }
    elseif($request->to==null && $request->from==!null){
      $info=Customer::whereadmin_id(Auth::id())->wherecountry_id($request->country_id)->whereDate('updated_at', '=', $request->from)->wherestatus(3)->get();
    }
     elseif($request->to==!null && $request->from==!null){
      $info=Customer::whereadmin_id(Auth::id())->wherecountry_id($request->country_id)->whereBetween('created_at', array($request->to, $request->from))->wherestatus(3)->get();
    }
    
 else{

  $info=Customer::whereadmin_id(Auth::id())->wherecountry_id($request->country_id)->wherestatus(3)->get();
 }

    $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];

    return view('admin.customer.inactivecustomerlist')->with('pageConfigs', $pageConfigs)->with('infos', $info);
  }
  public function restorecustomer($id){
    
    Customer::withTrashed()->find($id)->restore();
      
              return response()->json(['success' => true]);
        
  
  
  
  }
  public function store(Request $request)
  {
    $this->validate($request, [
      'customername' => 'required|min:3|max:190',
      'customermobile' => 'required|min:10|max:30',
      'houseno' => 'required|min:1|max:160',
      'floor' => 'required|min:1|max:160',
      'district_id' => 'required',
      'thana_id' => 'required',
      'area_id' => 'required',
      'package_id' => 'required',
      'password' => 'required',
      'idnumbertype' => 'required',
      'total' => 'required',
      'repassword' => 'required|same:password',
      'monthlyrent' => 'required',
      // 'loginid' => ['required', 'min:1', 'max:60', Rule::unique('customers')->where(function ($query) {
      //   return $query->where('admin_id', Auth::user()->id);
      // })],



    ]);
    if ($request->hasfile('photo')) {

      if (!is_dir(storage_path() . "/app/files/shares/uploads/" . date('Y/m/') . "thumbs/")) {
        mkdir(storage_path() .  "/app/files/shares/uploads/" . date('Y/m/') . "thumbs/", 0777, true);
      }

      $ex = $request->photo->extension();
      $rand = uniqid(CommonFx::make_slug(Str::limit($request->customername, 40)));
      $name = $rand . "." . $ex;

      $top = $request->photo->move(storage_path('/app/files/shares/uploads/' . date('Y/m')), $name);

      $resizedImage_thumbs = Image::make(storage_path() . '/app/files/shares/uploads/' . date('Y/m/') . $name)->resize(35, null, function ($constraint) {
        $constraint->aspectRatio();
      });

      $resizedImage_thumbs->save(storage_path() . '/app/files/shares/uploads/' . date('Y/m/') . 'thumbs/' . $name, 60);

      // }



    } else {
      $name = 'not-found.jpg';
    };
    if ($request->hasfile('infoimage')) {

      if (!is_dir(storage_path() . "/app/files/shares/uploads/" . date('Y/m/') . "thumbs/")) {
        mkdir(storage_path() .  "/app/files/shares/uploads/" . date('Y/m/') . "thumbs/", 0777, true);
      }

      $ex = $request->infoimage->extension();
      $rand = uniqid(CommonFx::make_slug(Str::limit($request->customername, 30)));
      $infoname = $rand . "." . $ex;

      $top = $request->infoimage->move(storage_path('/app/files/shares/uploads/' . date('Y/m')), $infoname);

      $resizedImage_thumbs = Image::make(storage_path() . '/app/files/shares/uploads/' . date('Y/m/') . $infoname)->resize(35, null, function ($constraint) {
        $constraint->aspectRatio();
      });

      $resizedImage_thumbs->save(storage_path() . '/app/files/shares/uploads/' . date('Y/m/') . 'thumbs/' . $infoname, 60);

      // }



    } else {
      $infoname = 'not-found.jpg';
    };
    $customerinfo = Customer::create(array(
      'customername' => $request->customername,
      'contactperson' => $request->contactperson,
      'email' => $request->email,
      'password' =>  Hash::make($request->password),
      'customermobile' => $request->customermobile,
      'customeraltmobile' => $request->customeraltmobile,
      'customerprofession' => $request->customerprofession,
      'customerprofession' => $request->customerprofession,
      'country_id' => $request->country_id,
      'division_id' => $request->division_id,
      'district_id' => $request->district_id,
      'idnumber' => $request->idnumber,
      'idnumbertype' => $request->idnumbertype,
      'otheridtype' => $request->otheridtype,
      'thana_id' => $request->thana_id,
      'area_id' => $request->area_id,
      'buildingname' => $request->buildingname,
      'houseno' => $request->houseno,
      'floor' => $request->floor,
      'post' => $request->post,
      'apt' => $request->apt,
      'connectiondate' => $request->connectiondate,
      'mikrotic_id' => $request->mikrotic_id,
      'ip' => $request->ip,
      'type_id' => $request->type_id,
      'profile_id' => $request->profile_id,
      'sqn' => $request->sqn,
      'interfacename' => $request->interfacename,
      'mac' => $request->mac,
      'secretname' => $request->secretname,
      'scrtnamepass' => $request->scrtnamepass,
      'bandwidth' => $request->bandwidth,
      'ppcomment' => $request->ppcomment,
      'atd_day' => $request->atd_day,
      'atd_month' => $request->atd_month,
      'remoteaddress' => $request->remoteaddress,
      'comment' => $request->comment,
      'package_id' => $request->package_id,
      'monthlyrent' => $request->monthlyrent?:0,
      'due' => $request->due?:0,
      'addicrg' => $request->addicrg?:0,
      'discount' => $request->discount?:0,
      'advance' => $request->advance?:0,
      'vat' => $request->vat?:0,
      'total' => $request->total?:0,
      'prepaidpostpaid' => $request->prepaidpostpaid,
      'connection' => $request->connection,
      'connectivity' => $request->connectivity,
      'clienttype' => $request->clienttype,
      'dlp' => $request->dlp,
      'admin_id' => Auth::guard('admin')->user()->id,
      'description' => $request->description,
      'note' => $request->note,
      'status' => $request->status,
      'connectedby' => $request->connectedby,
      'sdeposite' => $request->sdeposite,
      'path' => date('Y/m'),
      'photo' => $name,
      'infoimage' => $infoname,
    ));

    if ($customerinfo) {
     if($request->status==1){
      Toastr::success("Customer Create Successfully", "Well Done");
      return Redirect::to('admin/customerlist');
     }
     else{
      Toastr::success("Customer Create Successfully", "Well Done");
      return Redirect::to('admin/pendingcustomerlist');
     }
      
    } else {
      Toastr::warning("Customer Create Fail", "Sorry");
      return Redirect::to('admin/customerlist');
    }
  }

  public function edit($id)
  {
    //dd($id);
    $breadcrumbs = [
      ['link' => "admin/dashboard", 'name' => "Home"], ['link' => "admin/customerlist", 'name' => "Customer"], ['name' => "edit"],
    ];

    $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
    $infos = Customer::whereadmin_id(Auth::id())->find($id);
    return view('admin.customer.edit', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('info', $infos);
  } 
  public function show($id)
  {
    $breadcrumbs = [
      ['link' => "admin/dashboard", 'name' => "Home"], ['link' => "admin/customerlist", 'name' => "Customer"], ['name' => "Show"],
    ];

    $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
    $infos = Customer::whereadmin_id(Auth::id())->find($id);
    return view('admin.customer.show', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('customer', $infos);
  }

  public function update(Request $request, $id)
  {
    //dd($request->all());
    $customer = Customer::whereadmin_id(Auth::id())->find($id);
    if ($request->hasfile('photo')) {

      if (!is_dir(storage_path() . "/app/files/shares/uploads/". $customer->path ."thumbs/")) {
        mkdir(storage_path() .  "/app/files/shares/uploads/". $customer->path."thumbs/", 0777, true);
      }

      $ex = $request->photo->extension();
      $rand = uniqid(CommonFx::make_slug(Str::limit($request->customername, 40)));
      $name = $rand . "." . $ex;

      $top = $request->photo->move(storage_path('/app/files/shares/uploads/'.$customer->path.'/'), $name);

      $resizedImage_thumbs = Image::make(storage_path() . '/app/files/shares/uploads/'.$customer->path.'/'.$name)->resize(35, null, function ($constraint) {
        $constraint->aspectRatio();
      });

      $resizedImage_thumbs->save(storage_path() . '/app/files/shares/uploads/' . $customer->path.'/thumbs/' . $name, 60);

      // }



    } else {
      $name = 'not-found.jpg';
    };
    if ($request->hasfile('infoimage')) {

      if (!is_dir(storage_path() . "/app/files/shares/uploads/" .$customer->path . "/thumbs/")) {
        mkdir(storage_path() .  "/app/files/shares/uploads/" .$customer->path . "/thumbs/", 0777, true);
      }

      $ex = $request->infoimage->extension();
      $rand = uniqid(CommonFx::make_slug(Str::limit($request->customername, 30)));
      $infoname = $rand . "." . $ex;

      $top = $request->infoimage->move(storage_path('/app/files/shares/uploads/' . $customer->path.'/'), $infoname);

      $resizedImage_thumbs = Image::make(storage_path() . '/app/files/shares/uploads/' . $customer->path.'/'. $infoname)->resize(35, null, function ($constraint) {
        $constraint->aspectRatio();
      });

      $resizedImage_thumbs->save(storage_path() . '/app/files/shares/uploads/' . $customer->path . '/thumbs/' . $infoname, 60);

      // }



    } else {
      $infoname = 'not-found.jpg';
    };
    if($request->oldpassword==null){
     $password=$customer->password;
    $this->validate($request, [
      'customername' => 'required|min:3|max:190',
      'customermobile' => 'required|min:10|max:30',
      'houseno' => 'required|min:1|max:160',
      'floor' => 'required|min:1|max:160',
      'district_id' => 'required',
      'thana_id' => 'required',
      'area_id' => 'required',
      'package_id' => 'required',
       'monthlyrent' => 'required',
       'loginid' => 'required|min:3|max:60|unique:customers,loginid,'.$id,
      

    ]);
  }
  else{
    $this->validate($request, [
      'customername' => 'required|min:3|max:190',
      'customermobile' => 'required|min:10|max:30',
      'houseno' => 'required|min:1|max:160',
      'floor' => 'required|min:1|max:160',
      'district_id' => 'required',
      'thana_id' => 'required',
      'area_id' => 'required',
      'package_id' => 'required',
       'monthlyrent' => 'required',
       'loginid' => 'required|min:3|max:60|unique:customers,loginid,'.$id,
       'oldpassword' => 'required',
       'repassword' => 'required|same:oldpassword',

    ]);
    $password=Hash::make($request->oldpassword);
  }
    $info = Customer::whereadmin_id(Auth::id())->find($id)->update(array(
      'customername' => $request->customername,
      'contactperson' => $request->contactperson,
      'email' => $request->email,
      'password' =>  $password,
      'loginid' =>  $request->loginid,
     'customermobile' => $request->customermobile,
      'customeraltmobile' => $request->customeraltmobile,
      'customerprofession' => $request->customerprofession,
      'customerprofession' => $request->customerprofession,
      'country_id' => $request->country_id,
      'division_id' => $request->division_id,
      'district_id' => $request->district_id,
      'idnumber' => $request->idnumber,
      'idnumbertype' => $request->idnumbertype,
      'otheridtype' => $request->otheridtype,
      'thana_id' => $request->thana_id,
      'area_id' => $request->area_id,
      'buildingname' => $request->buildingname,
      'houseno' => $request->houseno,
      'floor' => $request->floor,
      'post' => $request->post,
      'apt' => $request->apt,
      'connectiondate' => $request->connectiondate,
      'mikrotic_id' => $request->mikrotic_id,
      'ip' => $request->ip,
      'type_id' => $request->type_id,
      'profile_id' => $request->profile_id,
      'sqn' => $request->sqn,
      'interfacename' => $request->interfacename,
      'mac' => $request->mac,
      'secretname' => $request->secretname,
      'scrtnamepass' => $request->scrtnamepass,
      'bandwidth' => $request->bandwidth,
      'ppcomment' => $request->ppcomment,
      'atd_day' => $request->atd_day,
      'atd_month' => $request->atd_month,
      'remoteaddress' => $request->remoteaddress,
      'comment' => $request->comment,
      'package_id' => $request->package_id,
      'monthlyrent' => $request->monthlyrent,
      'due' => $request->due,
      'addicrg' => $request->addicrg,
      'discount' => $request->discount,
      'advance' => $request->advance,
      'vat' => $request->vat,
      'total' => $request->total,
      'prepaidpostpaid' => $request->prepaidpostpaid,
      'connection' => $request->connection,
      'connectivity' => $request->connectivity,
      'clienttype' => $request->clienttype,
      'dlp' => $request->dlp,
      'admin_id' => Auth::guard('admin')->user()->id,
      'description' => $request->description,
      'note' => $request->note,
      'status' => $request->status,
      'connectedby' => $request->connectedby,
      'sdeposite' => $request->sdeposite,
      'path' => $customer->path,
      'photo' => $name,
      'infoimage' => $infoname,
    ));
    if ($info) {
      if($request->status==1){
        Toastr::success("Customer Update Successfully", "Well Done");
        return Redirect::to('admin/customerlist');
       }
       else{
        Toastr::success("Customer Update Successfully", "Well Done");
        return Redirect::to('admin/pendingcustomerlist');
       }
     
     
    } else {
      Toastr::warning("Customer Create Fail", "Sorry");
      return Redirect::to('admin/customerlist');
    }
  }

  public function destroy($id)
  {
   $info= Customer::whereadmin_id(Auth::id())->find($id);
$info->status=3;
$info->save();
    return response($info) ; 
   
  } 
   public function findbill($id)
  {
   
    $info=Bill::findOrFail($id);
    $customer=Customer::find($info->customer_id);
    return response()->json([
      'suceess'=>true,
    'info'=>$info,
    'customer'=>$customer,
    ],201);
   
   
  }
   public function updatebillcustomer(Request $request)
  {
// return response($request->all());
     $info=Bill::findOrFail($request->billid)->update(
      [
      'monthlyrent' => $request->monthlyrent,
       'due' => $request->due,
       'addicrg' => $request->addicrg,
       'discount' => $request->discount,
       'advance' => $request->advance,
        'vat' => $request->vat,
       'total' => $request->total
    
  ]);
  return response($info);
  if($info){
    Customer::findOrFail($request->customerid)->update(
      [
      'monthlyrent' => $request->monthlyrent,
       'due' => $request->due,
       'addicrg' => $request->addicrg,
       'discount' => $request->discount,
       'advance' => $request->advance,
        'vat' => $request->vat,
       'total' => $request->total
    
  ]);
  }
    return response()->json([
      'suceess'=>true,
    ],201);
   
   
  }



  public function setapproval(Request $request){
    $id =$request->id;
    $roomapproval = Customer::find($id);
    if($request->action=="allow"){
        $roomapproval->status=2;
    }
    if($request->action=="deny"){
        $roomapproval->status=1;
        $smsinfo=['name'=>$roomapproval->customername,'mobile'=>$roomapproval->customermobile,'id'=>$roomapproval->loginid,'ip'=>$roomapproval->ip,'oppusername'=>$roomapproval->secretname,'opppassword'=>$roomapproval->scrtnamepass,'monthlypayment'=>$roomapproval->monthlyrent];
         CommonFx::sentsmscustomer($smsinfo);

    }
        $roomapproval->update();
        if($roomapproval->update()==true){
            return response()->json(['success' => true, 'message' =>'Customer Approved Updated!']);
        }



} 
public function sendsmscustomer(Request $request){
  $customers=Customer::whereadmin_id(Auth::id())->wherestatus(2)->get();
foreach($customers as $customer){

$data = [
  'admin_id'=>Auth::id(),
  'message' =>$request->smsmessage,
  'name'=>$customer->customername,
  'number'=>$customer->customermobile,
  'id'=>$customer->loginid,
  'ip'=>$customer->ip,
  'opppassword'=>$customer->opppasswordip,
  'oppusername'=>$customer->oppusername,
  'companyname'=>Auth::user()->company,
  'companynumber'=>Auth::user()->phone,
  'billamount'=>$customer->total,
  'expeirydate'=>$customer->atd_day,
  'exmonth'=>$customer->atd_month
 
];

Sendcustomersms::dispatch($data);
}

 return response()->json(['success' => true]);

  }



  }

  
