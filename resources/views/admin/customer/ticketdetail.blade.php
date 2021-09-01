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

                    <div class="row">

                        <div class="col m2 s12"></div>
                        <div class="col m8 s12">
                            <div class="card card-panel">
                                <div class="card-content invoice-print-area">
                                    <h4>Ticket Details </h4>
                                   

                                    <div class="row mt-4">
                                      <div class="col m12 s12">
                                          <p>
                                            <span style="font-weight: 700; color: #000;">Ticket No :</span> L3-11Aug2018-03159 <span style="font-weight: 700; color: #000;"> Date :</span> 11-08-2018 <span style="font-weight: 700; color: #000;">Category :</span> Billing Query 
                                          </p>
<h6 style="font-weight: 700;">Complain Description : </h6>
<p>.Hi, We Have Paid Bill Via BKash Today From 01771116688, TRX ID: 5HB2ZOX4H4. Please restore the connection as soon as possible. Btw, we receive billing sms every month and last month the deadline was 12th of July. But this month we do not receive any billing sms, please take care of this issue too. Thanks. </p>
                                      </div>
                                        
                                    </div>
                                  


                                </div>

                            </div>
                        </div>
                        <div class="col m2 s12"></div>
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
