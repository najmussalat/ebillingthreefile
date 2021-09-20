<?php

namespace App\Http\Controllers\admin;
use Carbon\Carbon;
use PDF;
use App\Purchase;
use App\Purchdetail;
use App\Saleinvioce;
use App\SalePayment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Buysms;

class PdfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function buysmsinvoice($id){
      $infos = Buysms::with('payment')->find($id);
      
        $pdf = PDF::loadView('pdf.buysmspdf', compact('infos'));
        return $pdf->download('buysms_'.Carbon::now().'.pdf');
  
      }
   
}
