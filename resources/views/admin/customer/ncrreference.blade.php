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
                                <div class="card-content invoice-print-area pt-0 pb-0">
                                    <h4 style="font-weight: 700;">New Connection Request/Reference</h4>
                                    <div class="row">
                                        <form class="col s12">

                                          <div class="row">
                                            <div class="input-field col s12">
                                              <input id="ncfname" type="text" class="validate">
                                              <label for="ncfname" data-error="wrong" data-success="right">Your Friend's Name</label>
                                             
                                            </div>
                                          </div>

                                          <div class="row">
                                            <div class="input-field col s12">
                                              <input id="ncfphone" type="tel" class="validate">
                                              <label for="ncfphone" data-error="wrong" data-success="right">Your Friend's Phone</label>
                                             
                                            </div>
                                          </div>

                                          <div class="row">
                                            <div class="input-field col s12">
                                              <input id="ncfemail" type="email" class="validate">
                                              <label for="ncfemail" data-error="wrong" data-success="right">Your Friend's Email</label>
                                             
                                            </div>
                                          </div>

                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <select>
                                                        <option value="" disabled selected>Choose your option</option>
                                                        <option value="1">Option 1</option>
                                                        <option value="2">Option 2</option>
                                                        <option value="3">Option 3</option>
                                                    </select>
                                                    <label>Your Friend's Location</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                              <div class="input-field col s12">
                                                <input id="ncfaddress" type="text" class="validate">
                                                <label for="ncfaddress" data-error="wrong" data-success="right">Your Friend's Address</label>
                                               
                                              </div>
                                            </div>

                                            <div class="right">
                                                <a class="waves-effect waves-light  btn">Submit</a>
                                            </div>
                                        </form>

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
    <!-- invoice action  -->

    </div>
</section>

@endsection
{{-- page scripts --}}
@section('page-script')
<script src="{{ asset('app-assets/js/scripts/app-invoice.js') }}"></script>
@endsection
