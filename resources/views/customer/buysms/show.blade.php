@extends('layouts.adminMaster')
{{-- page styles --}}
@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-invoice.css') }}">
@endsection

{{-- page content --}}
@section('content')
@section('title', ' Customer')

{{-- {{dd($customer)}} --}}
<a href="#" class="btn-block btn btn-light-indigo waves-effect waves-light invoice-print">
  <span>Print</span>
</a>
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
                                    <h5 class="indigo-text center mt-3 mb-3">Payment Receipt</h5>

                                </div>
                            </div>
                       
                            <!-- invoice address and contact -->
                            <div class="row invoice-info">
                                <div class="col m6 s12">

                                   
                                    <div class="row">
                                        <div class="col m12 s12">
                                            <p>
                                                Receipt Number  #00 {{$infos->id}}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col m12 s12">
                                            <p>Date: {{ date('M-d-Y', strtotime(@Carbon\Carbon::now())) }}</p>
                                        </div>
                                    </div>
                                  
                                    <h6 class="customer-name" style="color: #6b6f82; font-weight: 700;">Company Name: {{Auth::user()->company}}</h6>
                                    <p class="mb-1">Name:  {{Auth::user()->name}}</p>
                                    <p class="mb-1">Email:  {{Auth::user()->email}}</p>
                                    <p class="mb-1">Address & phone.   {{Auth::user()->address}} . <br> {{Auth::user()->phone}}</p>



                                </div>

                                <div class="col m6 s12">
                                    <div class="row right">
                                        <div class="col m12 s12">
                                            <img 
                                                src="data:image/png;base64,{{ DNS2D::getBarcodePNG(Request::url(), 'QRCODE') }}" />

                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="pad-table mt-8 mb-8">
                                <div class="row">

                                    <table class="bordered">
                                       
                                        <tbody>
                                          
                                            <tr>
                                                <th data-field="id">Amount</th>
                                                <th data-field="name">{{$infos->payamount}}</th>
                                                
                                            </tr>
                                            <tr>
                                                <th data-field="id">Pay By</th>
                                                <th data-field="name">{{@$infos->payment->paymentname}}</th>
                                                
                                            </tr>
                                            <tr>
                                                <th data-field="id">Status</th>
                                                <th data-field="name">@if ($infos->status==0)
                                                    Peding
                                                    @else
                                                    Aproved
                                                @endif</th>
                                                
                                            </tr>

                                        </tbody>
                                    </table>

                                </div>



                            </div>


                            <div class="row">
                                <div class="col m6 s12">
                                 
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
