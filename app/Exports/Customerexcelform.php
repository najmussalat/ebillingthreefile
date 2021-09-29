<?php

namespace App\Exports;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class Customerexcelform implements FromView
{
    public function  __construct($request)
    {
        $this->password= $request->password;
        $this->customername= $request->customername;
        $this->idnumbertype= $request->idnumbertype;
        $this->email= $request->email;
        $this->customermobile= $request->customermobile;
        $this->contactperson= $request->contactperson;
        $this->customeraltmobile= $request->customeraltmobile;
        $this->connectiondate= $request->connectiondate;
        $this->idnumber= $request->idnumber;
        $this->country_id= $request->country_id;
        $this->division_id= $request->division_id;
        $this->district_id= $request->district_id;
        $this->thana_id= $request->thana_id;
        $this->area_id= $request->area_id;
        $this->houseno= $request->houseno;
        $this->buildingname= $request->buildingname;
        $this->floor= $request->floor;
        $this->package_id= $request->package_id;
        $this->monthlyrent= $request->monthlyrent;
        $this->due= $request->due;
        $this->addicrg= $request->addicrg;
        $this->discount= $request->discount;
        $this->advance= $request->advance;
        $this->vat= $request->vat;
        $this->total= $request->total;
        $this->secretname= $request->secretname;
        $this->scrtnamepass= $request->scrtnamepass;
        $this->ip= $request->ip;
        $this->mac= $request->mac;
        $this->bandwidth= $request->bandwidth;
        $this->clienttype_id= $request->clienttype_id;
        $this->status= $request->status;
        $this->admin_id=Auth::id();
    }
    public function view(): View
    {
        return view('excel.index', [
            'admin_id' =>  $this->admin_id,
            'customername' =>  $this->customername,
            'password' =>  $this->password,
            'email' =>  $this->email,
            'customermobile' =>  $this->customermobile,
            'contactperson' =>  $this->contactperson,
            'customeraltmobile' =>  $this->customeraltmobile,
            'connectiondate' =>  $this->connectiondate,
            'idnumber' =>  $this->idnumber,
            'idnumbertype' =>  $this->idnumbertype,
            'country_id' =>  $this->country_id,
            'division_id' =>  $this->division_id,
            'district_id' =>  $this->district_id,
            'thana_id' =>  $this->thana_id,
            'area_id' =>  $this->area_id,
            'buildingname' =>  $this->buildingname,
            'houseno' =>  $this->houseno,
            'floor' =>  $this->floor,
            'clienttype_id' =>  $this->clienttype_id,
            'secretname' =>  $this->secretname,
            'scrtnamepass' =>  $this->scrtnamepass,
            'ip' =>  $this->ip,
            'mac' =>  $this->mac,
            'bandwidth' =>  $this->bandwidth,
            'package_id' =>  $this->package_id,
            'monthlyrent' =>  $this->monthlyrent,
            'due' =>  $this->due,
            'addicrg' =>  $this->addicrg,
            'discount' =>  $this->discount,
            'advance' =>  $this->advance,
            'vat' =>  $this->vat,
            'total' =>  $this->total,
            'status' =>  $this->status,
          
        ]);
    }
}