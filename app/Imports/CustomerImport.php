<?php

namespace App\Imports;

use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class CustomerImport implements ToModel,WithHeadingRow,WithValidation
{
    use SkipsFailures;
    public function rules(): array
        {
          
            return [
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
                'monthlyrent' => 'required',
            ];
        }
    public function model(array $row)
    {

       
    
        return new Customer([
            'customername' => $row['customername'],
            'contactperson' => $row['contactperson'],
            'email' => $row['email'],
            'password' =>  Hash::make($row['password']),
            'customermobile' => $row['customermobile'],
            'customeraltmobile' => $row['customeraltmobile'],
             'connectiondate' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['connectiondate'])->format('Y-m-d'),
           'country_id' => $row['country_id'],
            'division_id' => $row['division_id'],
            'district_id' => $row['district_id'],
            'idnumber' => $row['idnumber'],
            'idnumbertype' => $row['idnumbertype'],
             'thana_id' => $row['thana_id'],
            'area_id' => $row['area_id'],
            'buildingname' => $row['buildingname'],
            'houseno' => $row['houseno'],
            'floor' => $row['floor'],
             'ip' => $row['ip'],
            'mac' => $row['mac'],
            'secretname' => $row['secretname'],
            'scrtnamepass' => $row['scrtnamepass'],
            'bandwidth' => $row['bandwidth'],
            'package_id' => $row['package_id'],
            'monthlyrent' => $row['monthlyrent'],
            'due' => $row['due'],
            'addicrg' => $row['addicrg'],
            'discount' => $row['discount'],
            'advance' => $row['advance'],
            'vat' => $row['vat'],
            'total' => $row['total'],
            'admin_id' =>$row['admin_id'],
            'path' => date('Y/m'),
            'status' =>2
            // 'status' =>$row['status'],
        
        ]);



        
    }
    public function columnFormats(): array {
        return [
            'connectiondate' => NumberFormat::FORMAT_DATE_YYYYMMDD
          
        ];
    }
}
