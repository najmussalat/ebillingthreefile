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
                        <div class="col xl4 m4 s12">
                            <h5>
                                Printing Page Setup
                            </h5>
                           
                                <div class="mt-8" style="padding: 10px; border: 1px solid #ddd;">
                                    <h6 class="mt-0">With Header</h6>
                                    <label>
                                        <input class="with-gap" name="papersetting" value="onewithheadin" type="radio"  {{ ($printset->papersetting=="onewithheadin")? "checked" : "" }} />
                                        <span>1 Bill per page</span>
                                    </label>

                                    <label>
                                        <input class="with-gap" name="papersetting" type="radio" value="twowithheadin" type="radio"  {{ ($printset->papersetting=="twowithheadin")? "checked" : "" }}/>
                                        <span>2 Bill per page</span>
                                    </label>

                                    <label>
                                        <input class="with-gap" name="papersetting" type="radio"  value="threewithheadin" type="radio"  {{ ($printset->papersetting=="threewithheadin")? "checked" : "" }}/>
                                        <span>3 Bill per page</span>
                                    </label>

                                    <label>
                                        <input class="with-gap" name="papersetting" type="radio" value="padwithheadin" type="radio"  {{ ($printset->papersetting=="padwithheadin")? "checked" : "" }} />
                                        <span>Pad</span>
                                    </label>
                                </div>

                                {{-- <div class="mt-8" style="padding: 10px; border: 1px solid #ddd;">
                                    <h6 class="mt-0">Without Header</h6>
                                    <label>
                                        <input class="with-gap" name="papersetting" value="oneheadin" type="radio"  {{ ($printset->papersetting=="oneheadin")? "checked" : "" }} />
                                        <span>1 Bill per page</span>
                                    </label>

                                    <label>
                                        <input class="with-gap" name="papersetting" type="radio" value="twoheadin" type="radio"  {{ ($printset->papersetting=="twoheadin")? "checked" : "" }}/>
                                        <span>2 Bill per page</span>
                                    </label>

                                    <label>
                                        <input class="with-gap" name="papersetting" type="radio"  value="threeheadin" type="radio"  {{ ($printset->papersetting=="threeheadin")? "checked" : "" }}/>
                                        <span>3 Bill per page</span>
                                    </label>

                                    <label>
                                        <input class="with-gap" name="papersetting" type="radio" value="padheadin" type="radio"  {{ ($printset->papersetting=="padheadin")? "checked" : "" }} />
                                        <span>Pad</span>
                                    </label>
                                </div> --}}


                                <div class="row">
                                    <div class="input-field col s12">
                                        {!! Form::text('customtext', null, ['id' => 'otheridtype']) !!}
                                     
                                      <label for="otheridtype" data-error="wrong" data-success="right">Customise text for money receipt</label>
                                      <span class="helper-text" data-error="wrong" data-success="right">Max 50 characters allowed</span>
                                    </div>
                                  </div>
                                 

                           
                                <div class="file-field input-field">
                                    <div class="btn float-right">
                                        <span>Signature</span>
                                        {!!Form::file('photo', ['accept'=>".jpg,.jpeg,.png"])!!}
                                       
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                    </div>
                                  
                                </div>
                                <button type="submit" class="waves-effect waves-light  btn">Submit</button>
                        </div>
                        <div class="col xl8 m8 s12">
                            <!-- Page Length Options -->
                            <div class="row">
                                <div class="col s12">


                                    <!-- header section -->

                                    <!-- logo and title -->
                                    <div class="row invoice-logo-title">
                                        <div class="col m6 s12 display-flex invoice-logo mt-1 push-m6">
                                            <img src="../../../app-assets/images/gallery/pixinvent-logo.png" alt="logo"
                                                width="164" height="46">
                                        </div>
                                        <div class="col m6 s12 pull-m6">
                                            <h5 class="indigo-text">Office Doccument</h5>

                                        </div>
                                    </div>

                                    <!-- invoice address and contact -->
                                    <div class="row invoice-info">
                                        <div class="col m6 s12">
                                            <div class="row">
                                                <div class="col m6 s6">
                                                    <p>1 Aug 2021</p>
                                                </div>
                                                <div class="col m6 s6">
                                                    <p>
                                                        ID: NAQW103
                                                    </p>
                                                </div>
                                            </div>
                                            <h6 class="customer-name" style="color: #6b6f82; font-weight: 700;">Tomal
                                            </h6>

                                            <p class="mb-1">Contact Person: Tomal</p>
                                            <p class="mb-1">Address & phone no.</p>
                                            <p class="mb-1">Internal ID: 7331151071</p>


                                            <p class="mb-1">
                                                Billing Month : Aug 2021
                                            </p>
                                            <p class="mb-1">
                                                Due Month's List : Jul 2021 : 1000TK
                                            </p>

                                        </div>
                                        <div class="col m6 s12">
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

                                    <!-- product details table-->


                                </div>
                            </div>
                            <div class="divider mb-1 mt-1"></div>
                            <!-- Page Length Options -->
                            <div class="row">
                                <div class="col s12">


                                    <!-- header section -->

                                    <!-- logo and title -->
                                    <div class="row invoice-logo-title">
                                        <div class="col m6 s12 display-flex invoice-logo mt-1 push-m6">
                                            <img src="../../../app-assets/images/gallery/pixinvent-logo.png" alt="logo"
                                                width="164" height="46">
                                        </div>
                                        <div class="col m6 s12 pull-m6">
                                            <h5 class="indigo-text">Money Receipt</h5>

                                        </div>
                                    </div>

                                    <!-- invoice address and contact -->
                                    <div class="row invoice-info">
                                        <div class="col m6 s12">
                                            <div class="row">
                                                <div class="col m6 s6">
                                                    <p>1 Aug 2021</p>
                                                </div>
                                                <div class="col m6 s6">
                                                    <p>
                                                        ID: NAQW103
                                                    </p>
                                                </div>
                                            </div>
                                            <h6 class="customer-name" style="color: #6b6f82; font-weight: 700;">Tomal
                                            </h6>

                                            <p class="mb-1">Contact Person: Tomal</p>
                                            <p class="mb-1">Address & phone no.</p>
                                            <p class="mb-1">Internal ID: 7331151071</p>


                                            <p class="mb-1">
                                                Billing Month : Aug 2021
                                            </p>
                                            <p class="mb-1">
                                                Due Month's List : Jul 2021 : 1000TK
                                            </p>

                                        </div>
                                        <div class="col m6 s12">
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

                                    <!-- product details table-->


                                </div>
                            </div>
                            <div class="divider mb-1 mt-1"></div>
                            <!-- Page Length Options -->
                            <div class="row">
                                <div class="col s12">


                                    <!-- header section -->

                                    <!-- logo and title -->
                                    <div class="row invoice-logo-title">
                                        <div class="col m6 s12 display-flex invoice-logo mt-1 push-m6">
                                            <img src="../../../app-assets/images/gallery/pixinvent-logo.png" alt="logo"
                                                width="164" height="46">
                                        </div>
                                        <div class="col m6 s12 pull-m6">
                                            <h5 class="indigo-text">Invoice</h5>

                                        </div>
                                    </div>

                                    <!-- invoice address and contact -->
                                    <div class="row invoice-info">
                                        <div class="col m6 s12">
                                            <div class="row">
                                                <div class="col m6 s6">
                                                    <p>1 Aug 2021</p>
                                                </div>
                                                <div class="col m6 s6">
                                                    <p>
                                                        ID: NAQW103
                                                    </p>
                                                </div>
                                            </div>
                                            <h6 class="customer-name" style="color: #6b6f82; font-weight: 700;">Tomal
                                            </h6>

                                            <p class="mb-1">Contact Person: Tomal</p>
                                            <p class="mb-1">Address & phone no.</p>
                                            <p class="mb-1">Internal ID: 7331151071</p>


                                            <p class="mb-1">
                                                Billing Month : Aug 2021
                                            </p>
                                            <p class="mb-1">
                                                Due Month's List : Jul 2021 : 1000TK
                                            </p>

                                        </div>
                                        <div class="col m6 s12">
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
                                    <!-- product details table-->

                                    <p>Note: Please take money receipt while payingmoney. You might need to show this
                                        money receipt if we ask for
                                    <p>

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



    </div>
</section>

@endsection
{{-- page scripts --}}
@section('page-script')
<script src="{{ asset('app-assets/js/scripts/app-invoice.js') }}"></script>
@endsection
