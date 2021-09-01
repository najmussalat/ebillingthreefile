<?php

namespace App\Http\Controllers\Admin;

use App\Models\Package;
use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Kamaln7\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Pagination\LengthAwarePaginator;

class PackageController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];
    $info = Package::whereadmin_id(Auth::guard('admin')->user()->id)->latest()->paginate(10);
    return view('admin.package.index')->with('infos', $info)->with('pageConfigs', $pageConfigs)->with('i', (request()->input('page', 1) - 1) * 10);
  }

  public function create()
  {
    $breadcrumbs = [
      ['link' => "admin", 'name' => "Home"], ['link' => "admin/packagelist", 'name' => "Package"], ['name' => "Create"],
    ];

    $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
    $category = Merchant::whereadmin_id(Auth::id())->pluck('merchantname', 'id');
    return view('admin.package.create', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('marchantlist', $category);
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'packageprice' => 'required|min:1|max:190',
      'merchant_id' => 'required',
      'packagename' => ['required', 'min:1', 'max:60', Rule::unique('packages')->where(function ($query) {
        return $query->where('admin_id', Auth::user()->id);
      })],




    ]);
    $div = new Package;
    $div->admin_id = Auth::id();
    $div->packagename = trim($request->packagename);
    $div->packageprice = trim($request->packageprice);
    $div->merchant_id = trim($request->merchant_id);
    $div->description = trim($request->description);
    $div->save();

    if ($div->save()) {
      Toastr::success("Package Create Successfully", "Well Done");
      return Redirect::to('admin/packagelist');
    } else {
      Toastr::warning("Package Create Fail", "Sorry");
      return Redirect::to('admin/createpackage');
    }
  }

  public function edit($id)
  {
    $breadcrumbs = [
      ['link' => "admin", 'name' => "Home"], ['link' => "admin/merchantlist", 'name' => "Package"], ['name' => "edit"],
    ];

    $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
    $category = Merchant::whereadmin_id(Auth::id())->pluck('merchantname', 'id');
    $infos = Package::whereadmin_id(Auth::id())->find($id);
    return view('admin.package.edit', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('info', $infos)->with('marchantlist', $category);
  }

  public function update(Request $request, $id)
  {
    $this->validate($request, [
      'packageprice' => 'required|min:1|max:190',
      'merchant_id' => 'required',
      'packagename' => ['required', 'min:1', 'max:60', Rule::unique('packages')->ignore($id, 'id')->where(function ($query) {
        return $query->where('admin_id', Auth::user()->id);
      })],




    ]);
    $div = Package::whereadmin_id(Auth::id())->find($id);
    $div->admin_id = Auth::id();
    $div->packagename = trim($request->packagename);
    $div->packageprice = trim($request->packageprice);
    $div->merchant_id = trim($request->merchant_id);
    $div->description = trim($request->description);
    $div->save();

    if ($div->save()) {
      Toastr::success("Package Update Successfully", "Well Done");
      return Redirect::to('admin/packagelist');
    } else {
      Toastr::warning("Package Create Fail", "Sorry");
      return Redirect::to('admin/createpackage');
    }
  }

  public function destroy($id)
  {

    $divisioninfo = Package::whereadmin_id(Auth::id())->delete($id);
    if ($divisioninfo) {
      Toastr::success("Package Delete Successfully", "Well Done");
      return Redirect::to('admin/packageslist');
    } else {
      Toastr::warning("Package Delete Fail", "Sorry");
      return Redirect::to('admin/packageslist');
    }
  }

  public function search(Request $request)
  {
    $output = "";
    $searchvalue = Package::Where('packagename', 'LIKE', '%%%' . $request->id . "%%%")->orwhere('id', 'LIKE', '%' . $request->id . "%")->latest()->get();
    if (count($searchvalue)) {
      foreach ($searchvalue as $key => $searchval) {
        $output .= '<tr>' .
          '<td>' . $searchval->id . '</td>' .
          '<td>' . $searchval->packagename . '</td>' .
          '<td>' . $searchval->packageprice . '</td>' .
          '<td>' . '<a target="_blank" href="' . url('admin/editpackage/' . $searchval->id) . '" class="btn-floating mb-1 waves-effect waves-light"> <i class="material-icons">edit</i></a>' . '</td>' .
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
