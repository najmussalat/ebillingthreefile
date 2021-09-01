@extends('layouts.adminMaster')
{{-- page styles --}}
@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-invoice.css') }}">
@endsection

{{-- page content --}}
@section('content')
@section('title', ' Customer')

{{-- {{dd($customer)}} --}}
<a href="de"></a>
<section class="invoice-view-wrapper section">
    <div class="row">
        <!-- invoice view page -->
        <div class="col xl12 m12 s12">
            <div class="card">
                <div class="card-content invoice-print-area">

                    <!-- Page Length Options -->
                    <div class="row">
                        <div class="col s12">

                         
                                <!-- header section -->
                          
                                <!-- logo and title -->
                              
                                    <div class="row">
                                    <div class="col m12 s12">
                                        <h5 class="indigo-text center mt-3 mb-3">Invoice/Bill</h5>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col m12 s12">
                                        <img src="../../../app-assets/images/gallery/pixinvent-logo.png" alt="logo"
                                            width="164" height="46">
                                    </div>
                                </div>

                                <!-- invoice address and contact -->
                                <div class="row invoice-info">
                                    <div class="col m12 s12">
                                        <div class="row">
                                            <div class="col m12 s12">
                                                <p>Issue Date: 1 Aug 2021</p>
                                            </div>
                                        </div>
                                            <div class="row">
                                            <div class="col m12 s12">
                                                <p>
                                                    ID: NAQW103
                                                </p>
                                            </div>
                                        </div>
                                        <h6 class="customer-name" style="color: #6b6f82; font-weight: 700;">Tomal</h6>
                                       
                                       
                                        <p class="mb-1">Address & phone no.</p>
                                        <p class="mb-1">Contact Person: Tomal</p>
                                     <p class="mb-1">Email: </p>
                                       
                                       
                                     
                                    </div>
                                    
                                </div>

                                <div class="pad-table mt-8 mb-8">
                                    <div class="row">
                                        
              <table class="bordered">
                <thead>
                  <tr>
                    <th data-field="id">Description</th>
                    <th data-field="name">Bill of Month</th>
                    <th data-field="price">Item Price</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                        <p>
                            mainulat

                        </p>
                        <p>
                            Connection Date : 16-07-2020
                        </p>
                    </td>
                    <td>Aug 2021</td>
                    <td>
<div class="row">
    <div class="col m12 s12">
        <ul>
            <li class="display-flex justify-content-between">
                <span class="invoice-subtotal-title">Monthly Rent</span>
                <span>00</span>
            </li>
            <li class="display-flex justify-content-between">
                <span class="invoice-subtotal-title">Additional</span>
                <span>00</span>
            </li>
            <li class="display-flex justify-content-between">
                <span class="invoice-subtotal-title">Discount</span>
                <span>00</span>
            </li>
       
            <li class="display-flex justify-content-between">
                <span class="invoice-subtotal-title">Advance</span>
                <span>00</span>
            </li>
            <li style="border: 1px solid"></li>
            <li class="display-flex justify-content-between">
                <span class="invoice-subtotal-title">SUM</span>
                <span>00</span>
            </li>
            <li class="display-flex justify-content-between">
                <span class="invoice-subtotal-title">Vat(%)</span>
                <span>00</span>
            </li>
            <li style="border: 1px solid"></li>
            <li class="display-flex justify-content-between">
                <span class="invoice-subtotal-title">Sum with vat</span>
                <span>00</span>
            </li>
            <li class="display-flex justify-content-between">
                <span class="invoice-subtotal-title">Previous DUE</span>
                <span>00</span>
            </li>
           <li style="border: 1px solid"></li>
            <li class="display-flex justify-content-between">
                <span class="invoice-subtotal-title">Total</span>
                <span>00</span>
            </li>
        </ul>
    </div>
</div>

                    </td>
                  </tr>
                  <tr>
                    <td colspan="3">
                        In Words : Five HundredTaka Only
                    </td>
                   
                  </tr>
                 
                </tbody>
              </table>
            
                                    </div>

               
                
                                </div>


                               <div class="row">
                                   <div class="col m6 s12">
                                       <h6 style="font-weight: 700;">TERMS & CONDITIONS</h6>
                                       <ul>
                                           <li>*Payment shall be made within 7 days from the date of invoice.</li>
                                           <li>*ক্যাশ পেমেন্ট এর ক্ষেত্রে অবশ্যই সিগনেচার করুন।</li>
                                       </ul>
                                   </div>
                                   <div class="col m6 s12">
                                    <p class="right">
                                        <img src="" alt=""> <br>
                                        Authorized Signature
                                    </p>
                                   </div>
                               </div>

                            
                        </div>
                    </div>
                
                </div>
            </div>
        </div>
    </div>
    <!-- invoice action  -->

    </div>
</section>

@endsection
{{-- page scripts --}}
@section('page-script')
<script src="{{ asset('app-assets/js/scripts/app-invoice.js') }}"></script>
@endsection
