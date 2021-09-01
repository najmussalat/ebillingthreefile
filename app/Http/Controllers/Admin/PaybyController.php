<?php

namespace App\Http\Controllers\Admin;

use App\Models\Package;
use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Kamaln7\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use App\Models\Payby;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Pagination\LengthAwarePaginator;

class PaybyController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];
    $info = Payby::whereadmin_id(Auth::guard('admin')->user()->id)->latest()->paginate(10);
    return view('admin.payby.index')->with('infos', $info)->with('pageConfigs', $pageConfigs)->with('i', (request()->input('page', 1) - 1) * 10);
  }

  public function create()
  {
    $breadcrumbs = [
      ['link' => "admin/dashboard", 'name' => "Home"], ['link' => "admin/paybylist", 'name' => "Payment Method"], ['name' => "Create"],
    ];

    $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
  
    return view('admin.payby.create', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
  }

  public function store(Request $request)
  {
    $this->validate($request, [
     'paybyname' => ['required', 'min:1', 'max:60', Rule::unique('paybies')->where(function ($query) {
        return $query->where('admin_id', Auth::user()->id);
      })],




    ]);
    $div = new Payby();
    $div->admin_id = Auth::id();
    $div->paybyname = trim($request->paybyname);
     $div->description = trim($request->description);
    $div->save();

    if ($div->save()) {
      Toastr::success("Payby Create Successfully", "Well Done");
      return Redirect::to('admin/paybylist');
    } else {
      Toastr::warning("Payby Create Fail", "Sorry");
      return Redirect::to('admin/createapaybylist');
    }
  }

  public function edit($id)
  {
   
    $breadcrumbs = [
      ['link' => "admin", 'name' => "Home"], ['link' => "admin/paybylist", 'name' => "Payby"], ['name' => "edit"],
    ];

    $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
   $infos = Payby::whereadmin_id(Auth::id())->find($id);
    return view('admin.payby.edit', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('info', $infos);
  }

  public function update(Request $request, $id)
  {
    $this->validate($request, [
     'paybyname' => ['required', 'min:1', 'max:60', Rule::unique('paybies')->ignore($id, 'id')->where(function ($query) {
        return $query->where('admin_id', Auth::user()->id);
      })],




    ]);
    $div = Payby::whereadmin_id(Auth::id())->find($id);
    $div->admin_id = Auth::id();
    $div->paybyname = trim($request->paybyname);
     $div->description = trim($request->description);
    $div->save();

    if ($div->save()) {
      Toastr::success("Payby Update Successfully", "Well Done");
      return Redirect::to('admin/paybylist');
    } else {
      Toastr::warning("Payby Update Fail", "Sorry");
      return Redirect::to('admin/createpayby');
    }
  }

  public function destroy($id)
  {

    $divisioninfo = Payby::whereadmin_id(Auth::id())->findOrFail($id)->delete();
    //dd($divisioninfo);
    if ($divisioninfo) {
      Toastr::success("Package Delete Successfully", "Well Done");
      return Redirect::to('admin/paybylist');
    } else {
      Toastr::warning("Payby Delete Fail", "Sorry");
      return Redirect::to('admin/paybylist');
    }
  }

  public function search(Request $request)
  {
    $output = "";
    $searchvalue = Payby::Where('paybyname', 'LIKE', '%%%' . $request->id . "%%%")->orwhere('id', 'LIKE', '%' . $request->id . "%")->latest()->get();
    if (count($searchvalue)) {
      foreach ($searchvalue as $key => $searchval) {
        $output .= '<tr>' .
          '<td>' . $searchval->id . '</td>' .
          '<td>' . $searchval->paybyname . '</td>' .
          '<td>' . $searchval->description . '</td>' .
          '<td>' . '<a target="_blank" href="' . url('admin/editpayby/' . $searchval->id) . '" class="btn-floating mb-1 waves-effect waves-light"> <i class="material-icons">edit</i></a>' . '</td>' .
          '</tr>';
      }
      return Response($output);
    } else {
      $output .= '<tr>'
        . '<td><h1>Sorry</h1></td>' .
        '<td><h1>NO </h1></td>' .
        '<td><h1>Data</h1></td>' .
        '<td><h1> Found</h1></td>' .
        '<td><h1>Type</h1></td>' .
        '<td><h1> Another</h1></td>' .
        '<td><h1>Info</h1></td>' .
        '</tr>';
      return Response($output);
    }
  }
}
