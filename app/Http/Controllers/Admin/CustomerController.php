<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use App\Helpers\CommonFx;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Kamaln7\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

   
  public function invoicesettingtwo()
  {
    $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];

    return view('admin.customer.invoicesettingtwo')->with('pageConfigs', $pageConfigs);
  }
  public function padinvoice()
  {
    $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];

    return view('admin.customer.padinvoice')->with('pageConfigs', $pageConfigs);
  }
  public function threebillperpage()
  {
    $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];

    return view('admin.customer.threebillperpage')->with('pageConfigs', $pageConfigs);
  }
  public function twobillperpage()
  {
    $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];

    return view('admin.customer.twobillperpage')->with('pageConfigs', $pageConfigs);
  }

  public function invoicesetting()
  {
    $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];

    return view('admin.customer.invoicesetting')->with('pageConfigs', $pageConfigs);
  }
  public function invoice()
  {
    $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];

    return view('admin.customer.invoice')->with('pageConfigs', $pageConfigs);
  }
  public function reselerdashboard()
  {
    $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];

    return view('admin.customer.reselerdashboard')->with('pageConfigs', $pageConfigs);
  }
  public function contact()
  {
    $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];

    return view('admin.customer.contact')->with('pageConfigs', $pageConfigs);
  }
  public function ticketdetail()
  {
    $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];

    return view('admin.customer.ticketdetail')->with('pageConfigs', $pageConfigs);
  }
  public function packages()
  {
    $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];

    return view('admin.customer.packages')->with('pageConfigs', $pageConfigs);
  }
  public function ncrreference()
  {
    $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];

    return view('admin.customer.ncrreference')->with('pageConfigs', $pageConfigs);
  }
  public function newconnectionrqst()
  {
    $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];

    return view('admin.customer.newconnectionrqst')->with('pageConfigs', $pageConfigs);
  }
  public function tickethistory()
  {
    $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];

    return view('admin.customer.tickethistory')->with('pageConfigs', $pageConfigs);
  }
  public function paymenthistory()
  {
    $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];

    return view('admin.customer.paymenthistory')->with('pageConfigs', $pageConfigs);
  }
  public function openticket()
  {
    $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];

    return view('admin.customer.openticket')->with('pageConfigs', $pageConfigs);
  }

   public function customerpaynow()
  {
    $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];

    return view('admin.customer.customerpaynow')->with('pageConfigs', $pageConfigs);
  }


  public function show( $id)
  {
    $customer=Customer::first();
    $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];

    $customer=Customer::first();
    return view('admin.customer.show')->with('pageConfigs', $pageConfigs)->with('customer',$customer);
  }
  public function view( $id)
  {
    $customer=Customer::first();
    $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];

    $customer=Customer::first();
    return view('admin.customer.viewuser')->with('pageConfigs', $pageConfigs)->with('customer',$customer);
  }
  public function index(Request $request)
  {
    if (request()->ajax()) {
      return datatables()->of(Customer::latest())
        ->addColumn('action', function ($data) {
          $button = '<a  href="/admin/editcustomer/' . $data->id . '" class="invoice-action-view"><i class="material-icons">edit</i></a>';
          $button .= '&nbsp;&nbsp;';
          $button .= '<a target="_blank" href="' . url('admin/customerprofile', $data->id) . '" class="invoice-action-view"><i class="material-icons ">remove_red_eye</i></a>';

          $button .= '&nbsp;&nbsp;';
          $button .= '<button type="button" name="delete" id="deleteBtn" rid="' . $data->id . '" class="invoice-action-view btn-sm"><i class="material-icons ">delete_forever</i></button>';
          return $button;
        })

        ->rawColumns(['action'])
        ->make(true);
    }
    $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];

    return view('admin.customer.index')->with('pageConfigs', $pageConfigs);
  }

  public function create()
  {
    $breadcrumbs = [
      ['link' => "admin/dashboard", 'name' => "Home"], ['link' => "admin/merchantlist", 'name' => "Customer"], ['name' => "Create"],
    ];

    $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];

    return view('admin.customer.create', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
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
      'loginid' => 'required',
      'package_id' => 'required',
      'password' => 'required',
      'total' => 'required',
      'repassword' => 'required|same:password',
      'monthlyrent' => 'required',
      'loginid' => ['required', 'min:1', 'max:60', Rule::unique('customers')->where(function ($query) {
        return $query->where('admin_id', Auth::user()->id);
      })],



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
      'loginid' =>  $request->loginid,
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
      'path' => date('Y/m'),
      'photo' => $name,
      'infoimage' => $infoname,
    ));

    if ($customerinfo) {
      Toastr::success("Customer Create Successfully", "Well Done");
      return Redirect::to('admin/customerlist');
    } else {
      Toastr::warning("Customer Create Fail", "Sorry");
      return Redirect::to('admin/createmerchant');
    }
  }

  public function edit($id)
  {
    $breadcrumbs = [
      ['link' => "admin/dashboard", 'name' => "Home"], ['link' => "admin/customerlist", 'name' => "Customer"], ['name' => "edit"],
    ];

    $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
    $infos = Customer::whereadmin_id(Auth::id())->find($id);
    return view('admin.customer.edit', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('info', $infos);
  }

  public function update(Request $request, $id)
  {
    $customer = Customer::whereadmin_id(Auth::id())->find($id);
    if ($request->hasfile('photo')) {

      if (!is_dir(storage_path() . "/app/files/shares/uploads/". $customer->path ."thumbs/")) {
        mkdir(storage_path() .  "/app/files/shares/uploads/". $customer->path."thumbs/", 0777, true);
      }

      $ex = $request->photo->extension();
      $rand = uniqid(CommonFx::make_slug(Str::limit($request->customername, 40)));
      $name = $rand . "." . $ex;

      $top = $request->photo->move(storage_path('/app/files/shares/uploads/'.$customer->path), $name);

      $resizedImage_thumbs = Image::make(storage_path() . '/app/files/shares/uploads/'.$customer->path . $name)->resize(35, null, function ($constraint) {
        $constraint->aspectRatio();
      });

      $resizedImage_thumbs->save(storage_path() . '/app/files/shares/uploads/' . $customer->path . 'thumbs/' . $name, 60);

      // }



    } else {
      $name = 'not-found.jpg';
    };
    if ($request->hasfile('infoimage')) {

      if (!is_dir(storage_path() . "/app/files/shares/uploads/" .$customer->path . "thumbs/")) {
        mkdir(storage_path() .  "/app/files/shares/uploads/" .$customer->path . "thumbs/", 0777, true);
      }

      $ex = $request->infoimage->extension();
      $rand = uniqid(CommonFx::make_slug(Str::limit($request->customername, 30)));
      $infoname = $rand . "." . $ex;

      $top = $request->infoimage->move(storage_path('/app/files/shares/uploads/' . $customer->path), $infoname);

      $resizedImage_thumbs = Image::make(storage_path() . '/app/files/shares/uploads/' . $customer->path . $infoname)->resize(35, null, function ($constraint) {
        $constraint->aspectRatio();
      });

      $resizedImage_thumbs->save(storage_path() . '/app/files/shares/uploads/' . $customer->path . 'thumbs/' . $infoname, 60);

      // }



    } else {
      $infoname = 'not-found.jpg';
    };
    $this->validate($request, [
      'customername' => 'required|min:3|max:190',
      'customermobile' => 'required|min:10|max:30',
      'houseno' => 'required|min:1|max:160',
      'floor' => 'required|min:1|max:160',
      'district_id' => 'required',
      'thana_id' => 'required',
      'area_id' => 'required',
      'loginid' => 'required',
      'package_id' => 'required',
       'monthlyrent' => 'required',
      'loginid' => ['required', 'min:1', 'max:60', Rule::unique('customers')->ignore($id, 'id')->where(function ($query) {
        return $query->where('admin_id', Auth::user()->id);
      })],

    ]);
    //dd($request->all());
    $info = Customer::whereadmin_id(Auth::id())->find($id)->update(array(
      'customername' => $request->customername,
      'contactperson' => $request->contactperson,
      'email' => $request->email,
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
      Toastr::success("Customer Update Successfully", "Well Done");
      return Redirect::to('admin/customerlist');
    } else {
      Toastr::warning("Customer Create Fail", "Sorry");
      return Redirect::to('admin/customerlist');
    }
  }

  public function destroy($id)
  {

    return response(Customer::whereadmin_id(Auth::id())->delete($id)) ; 
   
  }
  }

  
