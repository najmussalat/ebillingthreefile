@extends('layouts.adminMaster')
{{-- page styles --}}
@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-invoice.css') }}">
    <style>

@media print  {
  html, body,section {
    width: 210mm;
    height: 297mm;
    page-break-after: always;
  }
  /* ... the rest of the rules ... */
}

    </style>
@endsection

{{-- page content --}}
@section('content')
@section('title', ' Monthly Print')
{{ $customers->links() }}
<a href="#" class="btn-block btn btn-light-indigo waves-effect waves-light invoice-print">
    <span>Print</span>
</a>
@if (CommonFx::printsetting()->papersetting == 'onewithheadin')
    @foreach ($customers as $customer)
        <section class="invoice-view-wrapper sectionone">
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
                                    <div class="row invoice-logo-title">
                                        <div class="col m6 s12 display-flex invoice-logo mt-1 push-m6">
                                            <img width="62" height="50"
                                                src="data:image/png;base64,{{ DNS2D::getBarcodePNG(Request::url(), 'QRCODE') }}" />

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
                                                    <p>{{ date('M-d-Y', strtotime(@Carbon\Carbon::now())) }}</p>
                                                </div>
                                                <div class="col m6 s6">
                                                    <p>
                                                        ID: {{ @$customer->loginid }}
                                                    </p>
                                                </div>
                                            </div>
                                            <h6 class="customer-name" style="color: #6b6f82; font-weight: 700;">
                                                {{ @$customer->loginid }}</h6>

                                            <p class="mb-1">Contact Person: {{ @$customer->customername }}.
                                            </p>
                                            <p class="mb-1">Address & phone no:
                                                {{ @$customer->customerphone }},
                                                {{ @$customer->houseno }},
                                                {{ @$customer->district->district }},{{ @$customer->thana->thana }},{{ @$customer->area->areaname }}
                                            </p>
                                            <p class="mb-1">Internal ID: 7331151071</p>

                                            <div style="border:1px solid; padding:5px">
                                                <p class="mb-1">
                                                    Billing Month :
                                                    {{ date('M-Y', strtotime(@Carbon\Carbon::now())) }}
                                                </p>
                                                <p class="mb-1">
                                                    Due Month's List : @foreach (@$customer->bill as $due)
                                                        @if (@$due->total > 0)
                                                            {{ date('M-y', strtotime(@$due->created_at)) }} :
                                                            {{ $due->total }}TK,
                                                        @endif
                                                    @endforeach
                                                </p>

                                            </div>

                                        </div>

                                        <div class="col m6 s12">
                                            <ul>
                                                <li class="display-flex justify-content-between">
                                                    <span class="invoice-subtotal-title">Monthly Rent</span>
                                                    <span>{{ @$customer->bill[0]->monthlyrent }}</span>
                                                </li>
                                                <li class="display-flex justify-content-between">
                                                    <span class="invoice-subtotal-title">Additional</span>
                                                    <span>{{ @$customer->bill[0]->addicrg }}</span>
                                                </li>
                                                <li class="display-flex justify-content-between">
                                                    <span class="invoice-subtotal-title">Discount</span>
                                                    <span>{{ @$customer->bill[0]->discount }}</span>
                                                </li>

                                                <li class="display-flex justify-content-between">
                                                    <span class="invoice-subtotal-title">Advance</span>
                                                    <span>{{ @$customer->bill[0]->advance }}</span>
                                                </li>
                                                <li style="border: 1px solid"></li>
                                                <li class="display-flex justify-content-between">
                                                    <span class="invoice-subtotal-title">SUM</span>
                                                    <span>{{ @$customer->bill[0]->monthlyrent + @$customer->bill[0]->addicrg - (@$customer->bill[0]->advance + @$customer->bill[0]->discount) }}</span>
                                                </li>
                                                <li class="display-flex justify-content-between">
                                                    <span class="invoice-subtotal-title">Vat(%)</span>
                                                    <span>{{ @$customer->bill[0]->vat }}</span>
                                                </li>
                                                <li style="border: 1px solid"></li>
                                                <li class="display-flex justify-content-between">
                                                    <span class="invoice-subtotal-title">Sum with vat</span>
                                                    <span>{{ ((@$customer->bill[0]->monthlyrent + @$customer->bill[0]->addicrg) * @$customer->bill[0]->vat) / 100 + (@$customer->bill[0]->monthlyrent + @$customer->bill[0]->addicrg - @$customer->bill[0]->discount) }}</span>
                                                </li>
                                                <li class="display-flex justify-content-between">
                                                    <span class="invoice-subtotal-title">Previous DUE</span>
                                                    <span>{{ @$customer->bill[0]->due }}</span>
                                                </li>
                                                <li style="border: 1px solid"></li>
                                                <li class="display-flex justify-content-between">
                                                    <span class="invoice-subtotal-title">Total</span>
                                                    <span>{{ @$customer->bill[0]->total }}</span>
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
                                            <img wwidth="62" height="50"
                                                src="data:image/png;base64,{{ DNS2D::getBarcodePNG(Request::url(), 'QRCODE') }}" />

                                        </div>
                                        <div class="col m6 s12 pull-m6">
                                            <h5 class="indigo-text">Money Receipet</h5>

                                        </div>
                                    </div>

                                    <!-- invoice address and contact -->
                                    <div class="row invoice-info">
                                        <div class="col m6 s12">
                                            <div class="row">
                                                <div class="col m6 s6">
                                                    <p>{{ date('M-d-Y', strtotime(@Carbon\Carbon::now())) }}</p>
                                                </div>
                                                <div class="col m6 s6">
                                                    <p>
                                                        ID: {{ @$customer->loginid }}
                                                    </p>
                                                </div>
                                            </div>
                                            <h6 class="customer-name" style="color: #6b6f82; font-weight: 700;">
                                                {{ @$customer->loginid }}</h6>

                                            <p class="mb-1">Contact Person: {{ @$customer->customername }}.
                                            </p>
                                            <p class="mb-1">Address & phone no:
                                                {{ @$customer->customerphone }},
                                                {{ @$customer->houseno }},
                                                {{ @$customer->district->district }},{{ @$customer->thana->thana }},{{ @$customer->area->areaname }}
                                            </p>
                                            <p class="mb-1">Internal ID: 7331151071</p>


                                            <div style="border:1px solid; padding:5px">
                                                <p class="mb-1">
                                                    Billing Month :
                                                    {{ date('M-Y', strtotime(@Carbon\Carbon::now())) }}
                                                </p>
                                                <p class="mb-1">
                                                    Due Month's List : @foreach (@$customer->bill as $due)
                                                        @if (@$due->total > 0)
                                                            {{ date('M-y', strtotime(@$due->created_at)) }} :
                                                            {{ $due->total }}TK,
                                                        @endif
                                                    @endforeach
                                                </p>

                                            </div>

                                        </div>
                                        <div class="col m6 s12">
                                            <ul>
                                                <li class="display-flex justify-content-between">
                                                    <span class="invoice-subtotal-title">Monthly Rent</span>
                                                    <span>{{ @$customer->bill[0]->monthlyrent }}</span>
                                                </li>
                                                <li class="display-flex justify-content-between">
                                                    <span class="invoice-subtotal-title">Additional</span>
                                                    <span>{{ @$customer->bill[0]->addicrg }}</span>
                                                </li>
                                                <li class="display-flex justify-content-between">
                                                    <span class="invoice-subtotal-title">Discount</span>
                                                    <span>{{ @$customer->bill[0]->discount }}</span>
                                                </li>

                                                <li class="display-flex justify-content-between">
                                                    <span class="invoice-subtotal-title">Advance</span>
                                                    <span>{{ @$customer->bill[0]->advance }}</span>
                                                </li>
                                                <li style="border: 1px solid"></li>
                                                <li class="display-flex justify-content-between">
                                                    <span class="invoice-subtotal-title">SUM</span>
                                                    <span>{{ @$customer->bill[0]->monthlyrent + @$customer->bill[0]->addicrg - (@$customer->bill[0]->advance + @$customer->bill[0]->discount) }}</span>
                                                </li>
                                                <li class="display-flex justify-content-between">
                                                    <span class="invoice-subtotal-title">Vat(%)</span>
                                                    <span>{{ @$customer->bill[0]->vat }}</span>
                                                </li>
                                                <li style="border: 1px solid"></li>
                                                <li class="display-flex justify-content-between">
                                                    <span class="invoice-subtotal-title">Sum with vat</span>
                                                    <span>{{ ((@$customer->bill[0]->monthlyrent + @$customer->bill[0]->addicrg) * @$customer->bill[0]->vat) / 100 + (@$customer->bill[0]->monthlyrent + @$customer->bill[0]->addicrg) }}</span>
                                                </li>
                                                <li class="display-flex justify-content-between">
                                                    <span class="invoice-subtotal-title">Previous DUE</span>
                                                    <span>{{ @$customer->bill[0]->due }}</span>
                                                </li>
                                                <li style="border: 1px solid"></li>
                                                <li class="display-flex justify-content-between">
                                                    <span class="invoice-subtotal-title">Total</span>
                                                    <span>{{ @$customer->bill[0]->total }}</span>
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
                                            <img width="62" height="50"
                                                src="data:image/png;base64,{{ DNS2D::getBarcodePNG(Request::url(), 'QRCODE') }}" />

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
                                                    <p>{{ date('M-d-Y', strtotime(@Carbon\Carbon::now())) }}</p>
                                                </div>
                                                <div class="col m6 s6">
                                                    <p>
                                                        ID: {{ @$customer->loginid }}
                                                    </p>
                                                </div>
                                            </div>
                                            <h6 class="customer-name" style="color: #6b6f82; font-weight: 700;">
                                                {{ @$customer->loginid }}</h6>

                                            <p class="mb-1">Contact Person: {{ @$customer->customername }}.
                                            </p>
                                            <p class="mb-1">Address & phone no:
                                                {{ @$customer->customerphone }},
                                                {{ @$customer->houseno }},
                                                {{ @$customer->district->district }},{{ @$customer->thana->thana }},{{ @$customer->area->areaname }}
                                            </p>
                                            <p class="mb-1">Internal ID: 7331151071</p>

                                            <div style="border:1px solid; padding:5px">
                                                <p class="mb-1">
                                                    Billing Month :
                                                    {{ date('M-Y', strtotime(@Carbon\Carbon::now())) }}
                                                </p>
                                                <p class="mb-1">
                                                    Due Month's List : @foreach (@$customer->bill as $due)
                                                        @if (@$due->total > 0)
                                                            {{ date('M-y', strtotime(@$due->created_at)) }} :
                                                            {{ $due->total }}TK,
                                                        @endif
                                                    @endforeach
                                                </p>

                                            </div>
                                        </div>
                                        <div class="col m6 s12">
                                            <ul>
                                                <li class="display-flex justify-content-between">
                                                    <span class="invoice-subtotal-title">Monthly Rent</span>
                                                    <span>{{ @$customer->bill[0]->monthlyrent }}</span>
                                                </li>
                                                <li class="display-flex justify-content-between">
                                                    <span class="invoice-subtotal-title">Additional</span>
                                                    <span>{{ @$customer->bill[0]->addicrg }}</span>
                                                </li>
                                                <li class="display-flex justify-content-between">
                                                    <span class="invoice-subtotal-title">Discount</span>
                                                    <span>{{ @$customer->bill[0]->discount }}</span>
                                                </li>

                                                <li class="display-flex justify-content-between">
                                                    <span class="invoice-subtotal-title">Advance</span>
                                                    <span>{{ @$customer->bill[0]->advance }}</span>
                                                </li>
                                                <li style="border: 1px solid"></li>
                                                <li class="display-flex justify-content-between">
                                                    <span class="invoice-subtotal-title">SUM</span>
                                                    <span>{{ @$customer->bill[0]->monthlyrent + @$customer->bill[0]->addicrg - (@$customer->bill[0]->advance + @$customer->bill[0]->discount) }}</span>
                                                </li>
                                                <li class="display-flex justify-content-between">
                                                    <span class="invoice-subtotal-title">Vat(%)</span>
                                                    <span>{{ @$customer->bill[0]->vat }}</span>
                                                </li>
                                                <li style="border: 1px solid"></li>
                                                <li class="display-flex justify-content-between">
                                                    <span class="invoice-subtotal-title">Sum with vat</span>
                                                    <span>{{ ((@$customer->bill[0]->monthlyrent + @$customer->bill[0]->addicrg) * @$customer->bill[0]->vat) / 100 + (@$customer->bill[0]->monthlyrent + @$customer->bill[0]->addicrg - @$customer->bill[0]->discount) }}</span>
                                                </li>
                                                <li class="display-flex justify-content-between">
                                                    <span class="invoice-subtotal-title">Previous DUE</span>
                                                    <span>{{ @$customer->bill[0]->due }}</span>
                                                </li>
                                                <li style="border: 1px solid"></li>
                                                <li class="display-flex justify-content-between">
                                                    <span class="invoice-subtotal-title">Total</span>
                                                    <span>{{ @$customer->bill[0]->total }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <!-- product details table-->
                                    <p>Note: {{ CommonFx::printsetting()->customtext }}
                                    <p>

                                    <p class="right">
                                        <img src="{{ @url('storage/app/files/shares/singnaturephoto/thumbs/' . CommonFx::printsetting()->singnature) }}"
                                            alt=""> <br>
                                        Authorized Signature
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            

            <!-- invoice action  -->

            </div>
           <span id="footer"></span>
        </section>
    @endforeach
@elseif (CommonFx::printsetting()->papersetting=='twowithheadin')
    @foreach ($customers as $customer)
        <section class="invoice-view-wrapper section">

            <div class="row">
                <!-- invoice view page -->
                <div class="col xl12 m12 s12">
                    <div class="card">
                        <div class="card-content invoice-print-area">


                            <div class="row" style="display: flex">
                                <div style="width: 30%;">

                                    <div class="row">
                                        <div class="col s12">


                                            <!-- header section -->

                                            <div class="row">
                                                <div class="col m12 s12">
                                                    <img width="62" height="50"
                                                        src="data:image/png;base64,{{ DNS2D::getBarcodePNG(Request::url(), 'QRCODE') }}" />
                                                </div>
                                                <div class="col m12 s12">
                                                    <h6 class="indigo-text">Office Doccument</h6>
                                                </div>
                                            </div>

                                            <!-- invoice address and contact -->
                                            <div class="row invoice-info">
                                                <div class="col m6 s12">
                                                    <div class="row">
                                                        <div class="col m12 s12">
                                                            <p>{{ date('M-d-Y', strtotime(@Carbon\Carbon::now())) }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col m12 s12">
                                                            <p>
                                                                ID: {{ @$customer->loginid }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <h6 class="customer-name"
                                                        style="color: #6b6f82; font-weight: 700;">
                                                        {{ @$customer->customername }}</h6>

                                                    <p class="mb-1">Address & phone no.
                                                        {{ @$customer->customerphone }},
                                                        {{ @$customer->houseno }},
                                                        {{ @$customer->area->areaname }}</p>

                                                    <p class="mb-1">
                                                        Billing Month :
                                                        {{ date('M-Y', strtotime(@Carbon\Carbon::now())) }}
                                                    </p>
                                                    <p class="mb-1">

                                                        Due Month's List : @foreach (@$customer->bill as $due)
                                                            @if (@$due->total > 0)
                                                                {{ date('M-y', strtotime(@$due->created_at)) }} :
                                                                {{ $due->total }}TK,
                                                            @endif
                                                        @endforeach
                                                    </p>

                                                </div>
                                                <div class="col m6 s12">
                                                    <ul>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Monthly Rent</span>
                                                            <span>{{ @$customer->bill[0]->monthlyrent }}</span>
                                                        </li>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Additional</span>
                                                            <span>{{ @$customer->bill[0]->addicrg }}</span>
                                                        </li>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Discount</span>
                                                            <span>{{ @$customer->bill[0]->discount }}</span>
                                                        </li>

                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Advance</span>
                                                            <span>{{ @$customer->bill[0]->advance }}</span>
                                                        </li>
                                                        <li style="border: 1px solid"></li>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">SUM</span>
                                                            <span>{{ @$customer->bill[0]->monthlyrent + @$customer->bill[0]->addicrg - (@$customer->bill[0]->advance + @$customer->bill[0]->discount) }}</span>
                                                        </li>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Vat(%)</span>
                                                            <span>{{ @$customer->bill[0]->vat }}</span>
                                                        </li>
                                                        <li style="border: 1px solid"></li>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Sum with vat</span>
                                                            <span>{{ ((@$customer->bill[0]->monthlyrent + @$customer->bill[0]->addicrg) * @$customer->bill[0]->vat) / 100 + (@$customer->bill[0]->monthlyrent + @$customer->bill[0]->addicrg - @$customer->bill[0]->discount) }}</span>
                                                        </li>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Previous DUE</span>
                                                            <span>{{ @$customer->bill[0]->total }}</span>
                                                        </li>
                                                        <li style="border: 1px solid"></li>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Total</span>
                                                            <span>{{ @$customer->bill[0]->total }}</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!-- product details table-->

                                        </div>
                                    </div>
                                </div>
                                <div style="width: 30%;">

                                    <div class="row">
                                        <div class="col s12">


                                            <!-- header section -->

                                            <div class="row">
                                                <div class="col m12 s12">
                                                    <img width="62" height="50"
                                                        src="data:image/png;base64,{{ DNS2D::getBarcodePNG(Request::url(), 'QRCODE') }}" />
                                                </div>
                                                <div class="col m12 s12">
                                                    <h6 class="indigo-text">Money Receipt</h6>
                                                </div>
                                            </div>

                                            <!-- invoice address and contact -->
                                            <div class="row invoice-info">
                                                <div class="col m6 s12">
                                                    <div class="row">
                                                        <div class="col m12 s12">
                                                            <p>{{ date('M-d-Y', strtotime(@Carbon\Carbon::now())) }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col m12 s12">
                                                            <p>
                                                                ID: {{ @$customer->loginid }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <h6 class="customer-name"
                                                        style="color: #6b6f82; font-weight: 700;">
                                                        {{ @$customer->customername }}</h6>

                                                    <p class="mb-1">Address & phone no.
                                                        {{ @$customer->customerphone }},
                                                        {{ @$customer->houseno }},
                                                        {{ @$customer->area->areaname }}</p>

                                                    <p class="mb-1">
                                                        Billing Month :
                                                        {{ date('M-Y', strtotime(@Carbon\Carbon::now())) }}
                                                    </p>
                                                    <p class="mb-1">
                                                        Due Month's List : @foreach (@$customer->bill as $due)
                                                            @if (@$due->total > 0)
                                                                {{ date('M-y', strtotime(@$due->created_at)) }} :
                                                                {{ $due->total }}TK,
                                                            @endif
                                                        @endforeach
                                                    </p>

                                                </div>
                                                <div class="col m6 s12">
                                                    <ul>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Monthly Rent</span>
                                                            <span>{{ @$customer->bill[0]->monthlyrent }}</span>
                                                        </li>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Additional</span>
                                                            <span>{{ @$customer->bill[0]->addicrg }}</span>
                                                        </li>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Discount</span>
                                                            <span>{{ @$customer->bill[0]->discount }}</span>
                                                        </li>

                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Advance</span>
                                                            <span>{{ @$customer->bill[0]->advance }}</span>
                                                        </li>
                                                        <li style="border: 1px solid"></li>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">SUM</span>
                                                            <span>{{ @$customer->bill[0]->monthlyrent + @$customer->bill[0]->addicrg - (@$customer->bill[0]->advance + @$customer->bill[0]->discount) }}</span>
                                                        </li>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Vat(%)</span>
                                                            <span>{{ @$customer->bill[0]->vat }}</span>
                                                        </li>
                                                        <li style="border: 1px solid"></li>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Sum with vat</span>
                                                            <span>{{ ((@$customer->bill[0]->monthlyrent + @$customer->bill[0]->addicrg) * @$customer->bill[0]->vat) / 100 + (@$customer->bill[0]->monthlyrent + @$customer->bill[0]->addicrg - @$customer->bill[0]->discount) }}</span>
                                                        </li>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Previous DUE</span>
                                                            <span>{{ @$customer->bill[0]->total }}</span>
                                                        </li>
                                                        <li style="border: 1px solid"></li>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Total</span>
                                                            <span>{{ @$customer->bill[0]->total }}</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!-- product details table-->

                                        </div>
                                    </div>
                                </div>
                                <div style="width: 33.33%;">
                                    <div class="row">
                                        <div class="col s12">


                                            <!-- header section -->

                                            <div class="row">
                                                <div class="col m12 s12">
                                                    <img width="62" height="50"
                                                        src="data:image/png;base64,{{ DNS2D::getBarcodePNG(Request::url(), 'QRCODE') }}" />
                                                </div>
                                                <div class="col m12 s12">
                                                    <h6 class="indigo-text">Invoice</h6>
                                                </div>
                                            </div>

                                            <!-- invoice address and contact -->
                                            <div class="row invoice-info">
                                                <div class="col m6 s12">
                                                    <div class="row">
                                                        <div class="col m12 s12">
                                                            <p>{{ date('M-d-Y', strtotime(@Carbon\Carbon::now())) }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col m12 s12">
                                                            <p>
                                                                ID: {{ @$customer->loginid }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <h6 class="customer-name"
                                                        style="color: #6b6f82; font-weight: 700;">
                                                        {{ @$customer->customername }}</h6>

                                                    <p class="mb-1">Address & phone no.
                                                        {{ @$customer->customerphone }},
                                                        {{ @$customer->houseno }},
                                                        {{ @$customer->area->areaname }}</p>

                                                    <p class="mb-1">
                                                        Billing Month :
                                                        {{ date('M-Y', strtotime(@Carbon\Carbon::now())) }}
                                                    </p>
                                                    <p class="mb-1">
                                                        Due Month's List : @foreach (@$customer->bill as $due)
                                                            @if (@$due->total > 0)
                                                                {{ date('M-y', strtotime(@$due->created_at)) }} :
                                                                {{ $due->total }}TK,
                                                            @endif
                                                        @endforeach
                                                    </p>

                                                </div>
                                                <div class="col m6 s12">
                                                    <ul>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Monthly Rent</span>
                                                            <span>{{ @$customer->bill[0]->monthlyrent }}</span>
                                                        </li>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Additional</span>
                                                            <span>{{ @$customer->bill[0]->addicrg }}</span>
                                                        </li>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Discount</span>
                                                            <span>{{ @$customer->bill[0]->discount }}</span>
                                                        </li>

                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Advance</span>
                                                            <span>{{ @$customer->bill[0]->advance }}</span>
                                                        </li>
                                                        <li style="border: 1px solid"></li>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">SUM</span>
                                                            <span>{{ @$customer->bill[0]->monthlyrent + @$customer->bill[0]->addicrg - (@$customer->bill[0]->advance + @$customer->bill[0]->discount) }}</span>
                                                        </li>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Vat(%)</span>
                                                            <span>{{ @$customer->bill[0]->vat }}</span>
                                                        </li>
                                                        <li style="border: 1px solid"></li>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Sum with vat</span>
                                                            <span>{{ ((@$customer->bill[0]->monthlyrent + @$customer->bill[0]->addicrg) * @$customer->bill[0]->vat) / 100 + (@$customer->bill[0]->monthlyrent + @$customer->bill[0]->addicrg - @$customer->bill[0]->discount) }}</span>
                                                        </li>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Previous DUE</span>
                                                            <span>{{ @$customer->bill[0]->total }}</span>
                                                        </li>
                                                        <li style="border: 1px solid"></li>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Total</span>
                                                            <span>{{ @$customer->bill[0]->total }}</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!-- product details table-->
                                            <p>
                                                {{ CommonFx::printsetting()->customtext }}
                                            <p>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="divider mb-3 mt-3"></div>


                        </div>
                    </div>
                </div>
            </div>
           

        </section>
    @endforeach
@elseif (CommonFx::printsetting()->papersetting=='threewithheadin')
    @foreach ($customers as $customer)
        <section class="invoice-view-wrapper section">

            <div class="row">
                <!-- invoice view page -->
                <div class="col xl12 m12 s12">
                    <div class="card">
                        <div class="card-content invoice-print-area">


                            <div class="row" style="display: flex">
                                <div style="width: 50%;">

                                    <div class="row">
                                        <div class="col s12">


                                            <!-- header section -->



                                            <!-- invoice address and contact -->
                                            <div class="row invoice-info">
                                                <div class="col m6 s12">
                                                    <div class="row">
                                                        <div class="col m12 s12">
                                                            <img width="62" height="50"
                                                                src="data:image/png;base64,{{ DNS2D::getBarcodePNG(Request::url(), 'QRCODE') }}" />
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col m12 s12">
                                                            <p>{{ date('M-d-Y', strtotime(@Carbon\Carbon::now())) }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col m12 s12">
                                                            <p>
                                                                ID: {{ @$customer->loginid }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <h6 class="customer-name"
                                                        style="color: #6b6f82; font-weight: 700;">
                                                        {{ @$customer->customername }}</h6>

                                                    <p class="mb-1">Address & phone no.
                                                        {{ @$customer->customerphone }},
                                                        {{ @$customer->houseno }},
                                                        {{ @$customer->area->areaname }}</p>

                                                    <p class="mb-1">
                                                        Billing Month :
                                                        {{ date('M-Y', strtotime(@Carbon\Carbon::now())) }}
                                                    </p>
                                                    // mark:2

                                                </div>
                                                <div class="col m6 s12">
                                                    <ul>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Monthly Rent</span>
                                                            <span>{{ @$customer->bill[0]->monthlyrent }}</span>
                                                        </li>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Additional</span>
                                                            <span>{{ @$customer->bill[0]->addicrg }}</span>
                                                        </li>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Discount</span>
                                                            <span>{{ @$customer->bill[0]->discount }}</span>
                                                        </li>

                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Advance</span>
                                                            <span>{{ @$customer->bill[0]->advance }}</span>
                                                        </li>
                                                        <li style="border: 1px solid"></li>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">SUM</span>
                                                            <span>{{ @$customer->bill[0]->monthlyrent + @$customer->bill[0]->addicrg - (@$customer->bill[0]->advance + @$customer->bill[0]->discount) }}</span>
                                                        </li>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Vat(%)</span>
                                                            <span>{{ @$customer->bill[0]->vat }}</span>
                                                        </li>
                                                        <li style="border: 1px solid"></li>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Sum with vat</span>
                                                            <span>{{ ((@$customer->bill[0]->monthlyrent + @$customer->bill[0]->addicrg) * @$customer->bill[0]->vat) / 100 + (@$customer->bill[0]->monthlyrent + @$customer->bill[0]->addicrg - @$customer->bill[0]->discount) }}</span>
                                                        </li>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Previous DUE</span>
                                                            <span>{{ @$customer->bill[0]->total }}</span>
                                                        </li>
                                                        <li style="border: 1px solid"></li>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Total</span>
                                                            <span>{{ @$customer->bill[0]->total }}</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!-- product details table-->

                                        </div>
                                    </div>
                                </div>
                                <div style="width: 50%;">

                                    <div class="row">
                                        <div class="col s12">


                                            <!-- header section -->

                                            <!-- logo and title -->



                                            <!-- invoice address and contact -->
                                            <div class="row invoice-info">
                                                <div class="col m6 s12">
                                                    <div class="row">
                                                        <div class="col m12 s12">
                                                            <img width="62" height="50"
                                                                src="data:image/png;base64,{{ DNS2D::getBarcodePNG(Request::url(), 'QRCODE') }}" />
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col m12 s12">
                                                            <h6 class="indigo-text">Money Receipt </h6>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col m12 s12">
                                                            <p>{{ date('M-d-Y', strtotime(@Carbon\Carbon::now())) }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col m12 s12">
                                                            <p>
                                                                ID: {{ @$customer->loginid }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <h6 class="customer-name"
                                                        style="color: #6b6f82; font-weight: 700;">
                                                        {{ @$customer->customername }}</h6>



                                                    <p class="mb-1">Address & phone no.
                                                        {{ @$customer->customerphone }},
                                                        {{ @$customer->houseno }},
                                                        {{ @$customer->area->areaname }}</p>

                                                    <p class="mb-1">
                                                        Billing Month :
                                                        {{ date('M-Y', strtotime(@Carbon\Carbon::now())) }}
                                                    </p>


                                                </div>
                                                <div class="col m6 s12">
                                                    <ul>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Monthly Rent</span>
                                                            <span>{{ @$customer->bill[0]->monthlyrent }}</span>
                                                        </li>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Additional</span>
                                                            <span>{{ @$customer->bill[0]->addicrg }}</span>
                                                        </li>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Discount</span>
                                                            <span>{{ @$customer->bill[0]->discount }}</span>
                                                        </li>

                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Advance</span>
                                                            <span>{{ @$customer->bill[0]->advance }}</span>
                                                        </li>
                                                        <li style="border: 1px solid"></li>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">SUM</span>
                                                            <span>{{ @$customer->bill[0]->monthlyrent + @$customer->bill[0]->addicrg - (@$customer->bill[0]->advance + @$customer->bill[0]->discount) }}</span>
                                                        </li>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Vat(%)</span>
                                                            <span>{{ @$customer->bill[0]->vat }}</span>
                                                        </li>
                                                        <li style="border: 1px solid"></li>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Sum with vat</span>
                                                            <span>{{ ((@$customer->bill[0]->monthlyrent + @$customer->bill[0]->addicrg) * @$customer->bill[0]->vat) / 100 + (@$customer->bill[0]->monthlyrent + @$customer->bill[0]->addicrg - @$customer->bill[0]->discount) }}</span>
                                                        </li>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Previous DUE</span>
                                                            <span>{{ @$customer->bill[0]->total }}</span>
                                                        </li>
                                                        <li style="border: 1px solid"></li>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Total</span>
                                                            <span>{{ @$customer->bill[0]->total }}</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col m6 s12">
                                                    <p>
                                                        Note: {{ CommonFx::printsetting()->customtext }}
                                                    </p>
                                                </div>
                                                <div class="col m6 s12">

                                                    <p class="right">
                                                        <img
                                                            src="{{ @url('storage/app/files/shares/singnaturephoto/thumbs/' . CommonFx::printsetting()->singnature) }}">
                                                        <br>
                                                        Authorized Signature
                                                    </p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>



                            <div class="divider mb-3 mt-3"></div>


                        </div>
                    </div>
                </div>
            </div>
            <!-- invoice action  -->


        </section>
    @endforeach
@elseif (CommonFx::printsetting()->papersetting=='padwithheadin')
    @foreach ($customers as $customer)
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
                                            <img width="62" height="50"
                                                src="data:image/png;base64,{{ DNS2D::getBarcodePNG(Request::url(), 'QRCODE') }}" />
                                        </div>
                                    </div>

                                    <!-- invoice address and contact -->
                                    <div class="row invoice-info">
                                        <div class="col m12 s12">
                                            <div class="row">
                                                <div class="col m12 s12">
                                                    <p>Issue Date:
                                                        {{ date('M-d-Y', strtotime(@Carbon\Carbon::now())) }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col m12 s12">
                                                    <p>
                                                        ID: {{ @$customer->loginid }}
                                                    </p>
                                                </div>
                                            </div>
                                            <h6 class="customer-name" style="color: #6b6f82; font-weight: 700;">
                                                {{ @$customer->customername }}</h6>


                                            <p class="mb-1">Address & phone no.
                                                {{ @$customer->customerphone }},
                                                {{ @$customer->houseno }},
                                                {{ @$customer->district->district }},{{ @$customer->thana->thana }},{{ @$customer->area->areaname }}
                                            </p>
                                            <p class="mb-1">Contact Person:
                                                {{ @$customer->contactperson }}</p>
                                            <p class="mb-1">Email: {{ @$customer->email }} </p>



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
                                                                {{ @$customer->description }}

                                                            </p>
                                                            <p>
                                                                Connection Date : {{ @$customer->created_at }}
                                                            </p>
                                                        </td>
                                                        <td> {{ date('M-Y', strtotime(@Carbon\Carbon::now())) }}
                                                        </td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col m12 s12">
                                                                    <ul>
                                                                        <li
                                                                            class="display-flex justify-content-between">
                                                                            <span
                                                                                class="invoice-subtotal-title">Monthly
                                                                                Rent</span>
                                                                            <span>{{ @$customer->bill[0]->monthlyrent }}</span>
                                                                        </li>
                                                                        <li
                                                                            class="display-flex justify-content-between">
                                                                            <span
                                                                                class="invoice-subtotal-title">Additional</span>
                                                                            <span>{{ @$customer->bill[0]->addicrg }}</span>
                                                                        </li>
                                                                        <li
                                                                            class="display-flex justify-content-between">
                                                                            <span
                                                                                class="invoice-subtotal-title">Discount</span>
                                                                            <span>{{ @$customer->bill[0]->discount }}</span>
                                                                        </li>

                                                                        <li
                                                                            class="display-flex justify-content-between">
                                                                            <span
                                                                                class="invoice-subtotal-title">Advance</span>
                                                                            <span>{{ @$customer->bill[0]->advance }}</span>
                                                                        </li>
                                                                        <li style="border: 1px solid"></li>
                                                                        <li
                                                                            class="display-flex justify-content-between">
                                                                            <span
                                                                                class="invoice-subtotal-title">SUM</span>
                                                                            <span>{{ @$customer->bill[0]->monthlyrent + @$customer->bill[0]->addicrg - (@$customer->bill[0]->advance + @$customer->bill[0]->discount) }}</span>
                                                                        </li>
                                                                        <li
                                                                            class="display-flex justify-content-between">
                                                                            <span
                                                                                class="invoice-subtotal-title">Vat(%)</span>
                                                                            <span>{{ @$customer->bill[0]->vat }}</span>
                                                                        </li>
                                                                        <li style="border: 1px solid"></li>
                                                                        <li
                                                                            class="display-flex justify-content-between">
                                                                            <span class="invoice-subtotal-title">Sum
                                                                                with vat</span>
                                                                            <span>{{ ((@$customer->bill[0]->monthlyrent + @$customer->bill[0]->addicrg) * @$customer->bill[0]->vat) / 100 + (@$customer->bill[0]->monthlyrent + @$customer->bill[0]->addicrg - @$customer->bill[0]->discount) }}</span>
                                                                        </li>
                                                                        <li
                                                                            class="display-flex justify-content-between">
                                                                            <span
                                                                                class="invoice-subtotal-title">Previous
                                                                                DUE</span>
                                                                            <span>{{ @$customer->bill[0]->due }}</span>
                                                                        </li>
                                                                        <li style="border: 1px solid"></li>
                                                                        <li
                                                                            class="display-flex justify-content-between">
                                                                            <span
                                                                                class="invoice-subtotal-title">Total</span>
                                                                            <span>{{ @$customer->bill[0]->total }}</span>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">
                                                            In Words : {{ @$customer->bill[0]->total }} Taka Only
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
                                                <li>* {{ CommonFx::printsetting()->customtext }}</li>
                                            </ul>
                                        </div>
                                        <div class="col m6 s12">
                                            <p class="right">
                                                <img src="{{ @url('storage/app/files/shares/singnaturephoto/thumbs/' . CommonFx::printsetting()->singnature) }}"
                                                    alt=""> <br>
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

         
        </section>
    @endforeach
@else
    
@endif

@endsection
{{-- page scripts --}}
@section('page-script')
<script src="{{ asset('app-assets/js/scripts/app-invoice.js') }}"></script>
<script>
    //   window.print();
</script>
@endsection
