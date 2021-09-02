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
                                    <h5 class="indigo-text center mt-3 mb-3">Payment Receipt</h5>

                                </div>
                            </div>
                       
                            <!-- invoice address and contact -->
                            <div class="row invoice-info">
                                <div class="col m6 s12">

                                   
                                    <div class="row">
                                        <div class="col m12 s12">
                                            <p>
                                                Receipt Number
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col m12 s12">
                                            <p>Date: 1 Aug 2021</p>
                                        </div>
                                    </div>
                                  
                                    <h6 class="customer-name" style="color: #6b6f82; font-weight: 700;">Company Name</h6>
                                    <p class="mb-1">Name: </p>
                                    <p class="mb-1">Email: </p>
                                    <p class="mb-1">Address & phone no.</p>



                                </div>

                                <div class="col m6 s12">
                                    <div class="row right">
                                        <div class="col m12 s12">
                                            <img src="../../../app-assets/images/gallery/pixinvent-logo.png" alt="logo"
                                                width="164" height="46">
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
                                                <th data-field="name">1000</th>
                                                
                                            </tr>
                                            <tr>
                                                <th data-field="id">Pay By</th>
                                                <th data-field="name">Bkash</th>
                                                
                                            </tr>
                                            <tr>
                                                <th data-field="id">Expiry Date</th>
                                                <th data-field="name">--</th>
                                                
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
