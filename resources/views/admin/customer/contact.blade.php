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

                        <div class="col m12 s12">
                            <h4 style="font-weight: 700;">Contact Us</h4>
                            <div class="row">
                                <div class="col m6 s12">
                                   <form action="">

                                    <div class="row">
                                        <div class="input-field col s12">
                                          <input id="contactname" type="text" class="validate">
                                          <label for="contactname" data-error="wrong" data-success="right">Full Name</label>
                                         
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="input-field col s12">
                                          <input id="contacemail" type="email" class="validate">
                                          <label for="contacemail" data-error="wrong" data-success="right">Email</label>
                                         
                                        </div>
                                      </div>

                                      <div class="row">
                                        <div class="input-field col s12">
                                            <textarea id="textarea2" class="materialize-textarea" style="height: 100px;"></textarea>
                                            <label for="textarea2">Message</label>
                                        </div>
                                    </div>

                                    <div class="right">
                                        <a class="waves-effect waves-light  btn">Send</a>
                                    </div>
                                   </form>
                                </div>
                                <div class="col m6 s12">
                                    <p>
                                        Address: 48 Kalibari Road, Jhalokathi
                                    </p>
                                        <p>
                                            phone: 01933444123
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
