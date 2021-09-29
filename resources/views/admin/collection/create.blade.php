@extends('layouts.adminMaster')

@section('content')
@section('title', 'Create Payment')
{{-- @can('Disease-Merchant') --}}

@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-invoice.css') }}">
@endsection

@section('content')
    {{-- @can('Merchant-List') --}}
    <section class="invoice-view-wrapper section">
        <div class="row">
            <div class="col xl3 m4 s12">
                <div class="card invoice-action-wrapper">
                    <div class="card-content" id="dd">
                        <form>
                            <input placeholder="Customer id/Name/Phone" id="search" type="text"
                                class="search-box validate white search-circle">
                        </form>
                        <div class="invoice-action-btn">
                            <a href="#"
                                class="btn indigo waves-effect waves-light display-flex align-items-center justify-content-center">
                                <i class="material-icons mr-4">check</i>
                                <span class="text-nowrap">Search </span>
                            </a>
                        </div>
                        <div class="invoice-action-btn">
                            <a href="#" class="btn-block btn btn-light-indigo waves-effect waves-light invoice-print">
                                <span>Print</span>
                            </a>
                        </div>


                    </div>
                </div>
            </div>
            <!-- invoice view page -->
            <div class="col xl9 m8 s12">
                <div class="card">
                    <div class="card-content invoice-print-area">



                        <!-- invoice address and contact -->
                        <div class="row invoice-info">
                            <h3 class="invoice-from center ">Customer Information</h3>
                            <div class="col m6 s12">

                                <div class="invoice-address">
                                    <span>ID</span>
                                </div>
                                <div class="invoice-address">
                                    <span>Name</span>
                                </div>
                                <div class="invoice-address">
                                    <span>PPPoE Username</span>
                                </div>
                                <div class="invoice-address">
                                    <span>Address</span>
                                </div>
                            </div>
                            <div class="col m6 s12">
                                <div class="divider show-on-small hide-on-med-and-up mb-3"></div>

                                <div class="invoice-address">
                                    <div id="userid"></div>

                                </div>
                                <div class="invoice-address" id="name">

                                </div>
                                <div class="invoice-address" id="ppusername">

                                </div>
                                <div class="invoice-address" id="adress">

                                </div>
                                <div class="invoice-address" id="total">

                                </div>
                            </div>
                        </div>
                        <div class="divider mb-3 mt-3"></div>
                        <!-- product details table-->
                        <div class="invoice-product-details">
                            <table class="striped responsive-table">
                                <thead>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Monthly Rent</td>

                                        <td class="indigo-text right-align" id="monthlyrent"></td>
                                    </tr>
                                    <tr>
                                        <td>Previus Due</td>

                                        <td class="indigo-text right-align" id="due"></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Total Payable</strong></td>

                                        <td class="indigo-text right-align" id="intotal"></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Collected Amount (Paid)</strong></td>

                                        <td class="input-field right-align"><input type="number" required name="collection"
                                                class=" right-align" id="collection"></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Current Payable Amount</strong></td>

                                        <td class="indigo-text right-align" id="paybleamount"></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Collection By</strong></td>

                                        <td class="">
                                            {!! Form::select('payby', \App\Helpers\CommonFx::Payname(), null, ['id' => 'payby', 'required', 'class' => 'indigo-text right-align', 'placeholder' => '* Select One']) !!}

                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Invoice No</strong><input type="text" id="invoicesl"
                                                style="border: 1px solid #ddd"></td>
                                        <td><strong>Note</strong><input type="text" id="note"    style="border: 1px solid #ddd"></td>

                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td class="indigo-text right-align"><button
                                                class="btn indigo waves-effect waves-light page-footer"
                                                id="collectionsubmit">Submit</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- invoice subtotal -->

                    </div>
                </div>
                <!-- invoice action  -->

            </div>
    </section>


    <!-- Modal Structure -->

    {{-- @endcan --}}
@endsection

@section('page-script')
    <script src="{{ asset('app-assets/js/scripts/app-invoice.js') }}"></script>

    <script>
        $(document).ready(function() {
            // clearform();
            function delay(callback, ms) {
                var timer = 0;
                return function() {
                    var context = this,
                        args = arguments;
                    clearTimeout(timer);
                    timer = setTimeout(function() {
                        callback.apply(context, args);
                    }, ms || 0);
                };
            };
            $('#search').keydown(delay(function(e) {
                //console.log($('#search').val());
                $search = $('#search').val();
                $.ajax({
                    type: "post",
                    url: url + '/admin/searchsinglecustomer',
                    data: {
                        id: $search

                    },

                    success: function(data) {
                        //console.log(data.result.collection[0]);
                        $('#userid').html(null);
                        $('#name').html(null);
                        $('#ppusername').html(null);
                        $('#adress').html(null);
                        $('#monthlyrent').html(null);
                        $('#due').html(null);
                        $('#intotal').html(null);
                        $('#totall').html(null);
                        $('#collection').val(null);
                        $('#paybleamount').html(null);
                        $('#collectionid').removeAttr('value');
                        $('#userid').append('<span>' + data.result.loginid + '</span>');
                        $('#name').append('<span>' + data.result.customername + '</span>');
                        $('#ppusername').append('<span>' + data.result.secretname +
                            '</span>');
                        $('#adress').append('<span> House No # '+ data.result.houseno + ', '+ data.result.floor + ', '  + data.result.district.district + ', ' +
                            data.result.thana.thana + ', ' + data.result.area.areaname +
                            ', ' + data.result.customermobile + '</span>');
                        $('#monthlyrent').append('<span>' + data.result.bill[0]
                            .monthlyrent + '</span>');
                        $('#due').append('<span>' + data.result.bill[0].due + '</span>');
                        $('#intotal').append('<input type="hidden" value="' + data.result
                            .bill[0].total +
                            '" id="totall"/><input type="hidden" value="' + data.result
                            .bill[0].id + '" id="collectionid" />' + '<span>' + data
                            .result.bill[0].total + '</span>');
                            $('#collection').val( data
                            .result.bill[0].total);
                            $('#collection').focus();
                            $("#paybleamount").html('<strong>' + data
                            .result.bill[0].total + '</strong>');

                    }
                });
            }, 900));
            $("#collection").keyup(function() {
                //console.log($('#collectionid').val());


                var ttotal = $("#totall").val() - $("#collection").val();
              //  console.log($("#collection").val());
                $("#paybleamount").html('<strong>' + ttotal.toFixed(2) + '</strong>');

            });

            $("#collectionsubmit").on('click', function() {
                // console.log($("#payby").val());
                if ($("#collection").val() == '') {

                    alert('Collected Amount (Paid) Is Required');
                    $("#collection").focus();
                    return false;

                }
                if ($("#payby").val() == '') {
                    // console.log($("#collection").val());
                    alert('Select Minimum One collection Amount');
                    $("#payby").focus();
                    return false;

                }
                $.ajax({
                    //url:url+'/admin/updatecollection/'+$("#collectionid").val(),
                    url: url + '/admin/createcollection',
                    method: "POST",
                    type: "POST",
                    data: {
                        billid: $("#collectionid").val(),
                        paid: $("#collection").val(),
                        invoice: $("#invoicesl").val(),
                        payby: $("#payby").val(),
                        note: $("#note").val(),
                        totall: $("#totall").val(),
                        
                       

                    },
                    success: function(d) {

                        if (d) {
                            $("#search").focus();
                            swal({
                                title: "Collection Done",
                                text: "collection submit successfully",
                                timer: 2000,
                                buttons: false
                            });

                            $('#userid').html(null);
                            $('#name').html(null);
                            $('#ppusername').html(null);
                            $('#adress').html(null);
                            $('#monthlyrent').html(null);
                            $('#due').html(null);
                            $('#intotal').html(null);
                            $('#totall').html(null);
                            $('#collection').val(null);
                            $('#paybleamount').html(null);
                            $('#collectionid').removeAttr('value');
                        } else {
                            $.each(d.errors, function(key, value) {
                                $("#collection").focus();
                                toastr.warning(value);
                            });
                        }

                    },
                    error: function(d) {

                        toastr.warning('Bii Allready Paid');
                    }
                });

            });
            //Update shift end



        });
    </script>


@endsection
