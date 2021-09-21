@extends('layouts.adminMaster')
@section('title', ' Customer List')
{{-- vendor styles --}}
@section('vendor-style')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/flag-icon/css/flag-icon.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/data-tables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/data-tables/css/select.dataTables.min.css') }}">
@endsection
{{-- page style --}}
@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/data-tables.css') }}">
    <style>
td{
    border: 1px solid #ddd;
    white-space: normal !important;
    padding: 5px !important;
    text-align: center;
  

  
  
}
table.dataTable thead th, table.dataTable thead td{
    padding: 5px !important;
}
th{
    border: 1px solid #ddd;
    padding: 5px !important;
    text-align: left;
}
.card-content{
    padding: 10px !important;
}

table.dataTable thead .sorting{
    background-image: none;
}
table.dataTable thead .sorting_asc{
    background-image: none;
}
.sorting-icon{
    display: flex;
    align-items: center;
    
}
.sorting-icon i{
    font-size: 15px !important;
    margin-left: auto
}

    </style>
@endsection
@section('content')

    {{-- @can('Customer-Create') --}}

    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <div class="input-field col s12 m6">

                    </div>


                    <div class="col s12 m3 l3 input-field">
                  
                        <a href="{{ url('admin/createcustomer') }}" class="waves-effect waves-light  btn"><i
                                class="material-icons right">gps_fixed</i> Create  Customer</a>
                               
                    </div> <div class="col s12 m3 l3 input-field">
                  
                        <button data-target="SendSms" class="btn modal-trigger"> Send Sms <i
                            class="material-icons right">sms</i></button>
                    </div>

                    <div class="row">
                        <div class="col s12" style="">
                            <table id="dataTable" class="display table table-striped table-bordered nowrap"
                                style="width: 100%; font-size: 13px; font-family: serif;">
                                <thead>

                                    <tr>
                                        <td><span class="sorting-icon">SL <i class="material-icons dp48">arrow_downward</i></span></td>
                                        <td><span class="sorting-icon">ID <i class="material-icons dp48">swap_vert</i></span></td>
                                        <th><span class="sorting-icon">Name <i class="material-icons dp48">swap_vert</i></span></th>
                                        <th><span class="sorting-icon">Address <i class="material-icons dp48">swap_vert</i></span></th>
                                        <th>Mobile</th>
                                        <th>IP/<br>Username</th>
                                        <th><span class="sorting-icon">Monthly <br>Rent <i class="material-icons dp48">swap_vert</i></span></th>
                                        <th> <span class="sorting-icon">Previus <br>Due <i class="material-icons dp48">swap_vert</i></span></th>
                                        <th><span class="sorting-icon">Discount <i class="material-icons dp48">swap_vert</i></span></th>
                                        <th><span class="sorting-icon">Advance <i class="material-icons dp48">swap_vert</i></span></th>
                                        <th><span class="sorting-icon">Add <br>Charge  <i class="material-icons dp48">swap_vert</i></span></th>
                                        <th><span class="sorting-icon">Vat % <i class="material-icons dp48">swap_vert</i></span></th>
                                        <th><span class="sorting-icon">Bill <br>Amount <i class="material-icons dp48">swap_vert</i></span></th>
                                        <th><span class="sorting-icon">Collection <br>Amount <i class="material-icons dp48">swap_vert</i></span></th>
                                        <th>Total <br>Due</th>
                                        {{-- <th>Status</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>



                                </tbody>
                                <tfoot>
                                    <tr role="row" style="position: sticky; bottom: 0; background: #fff;"><td class="sorting_asc" rowspan="1" colspan="1" style="width: 18px;" aria-label="SL">SL</td><td class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 67px;" aria-label="ID: activate to sort column ascending">ID</td><th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 77px;" aria-label="Name: activate to sort column ascending">Name</th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 104px;" aria-label="Address">Address</th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 83px;" aria-label="Mobile">Mobile</th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 72px;" aria-label="IP/Username">IP/<br>Username</th><th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 57px;" aria-label="Monthly Rent: activate to sort column ascending">Monthly <br>Rent
                                      <span style="color: slateblue; display: block">{{CommonFx::Totalcustomerinfo()->sum('monthlyrent')}}</span>
                                    </th><th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 52px;" aria-label="Previus Due: activate to sort column ascending">Previus <br>Due
                                      <span style="color: slateblue; display: block">100</span>
                                    </th><th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 62px;" aria-label="Discount: activate to sort column ascending">Discount
                                      <span style="color: slateblue; display: block">100</span>
                                    </th><th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 62px;" aria-label="Advance: activate to sort column ascending">Advance
                                      <span style="color: slateblue; display: block">100</span>
                                    </th><th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 52px;" aria-label="Add Charge: activate to sort column ascending">Add <br>Charge
                                      <span style="color: slateblue; display: block">100</span>
                                    </th><th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 42px;" aria-label="Vat %: activate to sort column ascending">Vat %</th><th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 57px;" aria-label="Bill Amount: activate to sort column ascending">Bill <br>Amount
                                      <span style="color: slateblue; display: block">100</span>
                                    </th><th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 69px;" aria-label="Collection Amount: activate to sort column ascending">Collection <br>Amount
                                      <span style="color: slateblue; display: block">100</span>
                                    </th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 35px;" aria-label="Total Due">Total <br>Due
                                      <span style="color: slateblue; display: block">100</span>
                                    </th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 128px;" aria-label="Action">Action</th></tr>
                                   
                                       
                                      
                                </tfoot>
                            </table>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="UpdateBill" class="modal">
        <div class="modal-content">


            <div class="row">
                <div class="input-field col m6 s12">
                    {!! Form::number('monthlyrent', null, ['id' => 'monthlyrent', 'class' => 'validate', 'placeholder' => 'placeholder']) !!}
                    {!! Form::label('active', 'Monthly Charge') !!}

                </div>
                <div class="input-field col m6 s12">
                    {!! Form::number('addicrg', null, ['id' => 'addicrg', 'class' => 'validate', 'placeholder' => 'placeholder']) !!}
                    {!! Form::label('addicrg', 'Additional Charge') !!}

                </div>

                <div class="input-field col m6 s12">
                    {!! Form::number('discount', null, ['id' => 'discount', 'class' => 'validate', 'placeholder' => 'placeholder']) !!}
                    {!! Form::label('discount', 'Discount') !!}

                </div>
                <div class="input-field col m6 s12">
                    {!! Form::number('due', null, ['id' => 'due', 'class' => 'validate', 'placeholder' => 'placeholder']) !!}
                    {!! Form::label('due', 'Due') !!}

                </div>

            </div>
            <div class="row">
                <div class="input-field col m6 s12">
                    {!! Form::number('advance', null, ['id' => 'advance', 'class' => 'validate', 'placeholder' => 'placeholder']) !!}
                    {!! Form::label('advance', 'Advance') !!}

                </div>

                <div class="input-field col m6 s12">
                    {!! Form::number('vat', null, ['id' => 'vat', 'class' => 'validate', 'placeholder' => 'placeholder']) !!}
                    {!! Form::label('vat', 'VAT (%)') !!}

                </div>
                <input type="hidden" value="" id="billid">
                <input type="hidden" value="" id="customerid">
            </div>
            <div class="row">
                <div class="input-field col m6 s12">
                    {!! Form::number('total', null, ['id' => 'total', 'step' => 'any']) !!}

                </div>
                <div class="input-field col m6 s12">
                    <button class="btn cyan waves-effect waves-light right" type="button" id="Updatemodal">Update
                        <i class="material-icons right">send</i>
                    </button>
                </div>


            </div>


        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
        </div>
    </div>


    <div id="SendSms" class="modal">
        <div class="modal-content">


            <div class="row">
                <div class="input-field col m12 s12">
                    {!!Form::textarea('problemmessage',@CommonFx::sentallcustomersms()->problemmessage, array('id'=>'problemmessage','class'=>'materialize-textarea', 'data-length'=>'160','rows' => 4, 'cols' => 54,'required'))!!}
           
                    {!! Form::label('active', 'Sent Message All Active Customer') !!}

                </div>
                

            
                  
                </div>


            </div>

        <div class="modal-footer">
            <button class="btn cyan waves-effect waves-light right" type="button" id="Sendsmssubmit">Send
                <i class="material-icons right">send</i>
            </button>
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
        </div>
    </div>


    {{-- @endcan --}}
@endsection
{{-- vendor scripts --}}
@section('vendor-script')
    <script src="{{ asset('vendors/data-tables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('vendors/data-tables/js/dataTables.select.min.js') }}"></script>
@endsection


@section('page-script')
    <script src="{{ asset('app-assets/js/scripts/data-tables.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".sidenav-main").addClass("nav-collapsed");
            $("#main").addClass("main-full");
            $(".sidenav-main").hover(function() {
                $(".sidenav-main").toggleClass("nav-collapsed");
            });

            $('#dataTable').DataTable({
                // responsive: true,

                processing: true,
                serverSide: true,
                ajax: {
                    // url:"{{ url('admin/pendingcustomerlist') }}",
                    url: "{{ url('admin/customerlist') }}",

                },

                columns: [


                    {
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'loginid',
                        name: 'loginid',
                    },

                    {
                        data: 'customername',
                        name: 'customername',

                    },
                    {
                        data: 'address',
                        name: 'area.areaname',
                       
                      
                    },

                    {
                        data: 'customermobile',
                        name: 'customermobile',
                        orderable: false
                    },
                    {
                        data: 'secretname',
                        name: 'secretname',
                        orderable: false
                    },
                    {
                        data: 'monthlyrent',
                        name: 'monthlyrent',

                    },
                    {
                        data: 'due',
                        name: 'due',

                    },
                    {
                        data: 'discount',
                        name: 'discount',

                    },
                    {
                        data: 'advance',
                        name: 'advance',

                    },
                    {
                        data: 'addicrg',
                        name: 'addicrg',

                    },
                    {
                        data: 'vat',
                        name: 'vat',

                    },
                    {
                        data: 'billamount',
                        name: 'billamount',

                    },
                    {
                        data: 'collection',
                        name: 'collection',

                    },
                    {
                        data: 'duetotal',
                        name: 'duetotal',
                        orderable: false
                    },
//  {
//                         data: 'status',
//                         name: 'status',
//                         orderable: false
//                     },


                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    }

                ]

            });
            //Delete Admin
            $(document).on('click', '#deleteBtn', function() {

                if (!confirm('Sure?')) return;
                $customerid = $(this).attr('rid');
                //console.log($roomid);
                $info_url = url + '/admin/deletecustomer/' + $customerid;
                $.ajax({
                    url: $info_url,
                    method: "DELETE",
                    type: "DELETE",
                    data: {},
                    success: function(data) {
                        if (data) {
                            toastr.warning('customer Inactive');
                            //location.reload();
                            $('#dataTable').DataTable().ajax.reload();

                        }
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });

            //Delete Admin end
//sent sms
$(document).on('click', '#Sendsmssubmit', function() {

if (!confirm('Are You Confirm  ?')) return;
;
$info_url = url + '/admin/sendsmscustomer';
$.ajax({
    url: $info_url,
    method: "post",
    type: "POST",
    data: {
        smsmessage:$('#problemmessage').val()
    },
    success: function(data) {
        if (data) {
            toastr.info('Request Process');
            $('#SendSms').modal('close');
        }
    },
    error: function(data) {
        console.log(data);
    }
});
});


//sent sms

            $(document).on('click', '#UpdateBillBtn', function() {

                $billid = $(this).attr('uid');
                //console.log($roomid);
                $info_url = url + '/admin/findbill/' + $billid;
                $.ajax({
                    url: $info_url,
                    method: "get",
                    type: "GET",
                    data: {},
                    success: function(data) {
                        if (data) {
                            //   console.log(data);

                            $("#billid").val(data.info.id);
                            $("#customerid").val(data.info.customer_id);
                            $("#monthlyrent").val(data.info.monthlyrent);
                            $("#addicrg").val(data.info.addicrg);
                            $("#discount").val(data.info.discount);
                            $("#due").val(data.info.due);
                            $("#advance").val(data.info.advance);
                            $("#vat").val(data.info.vat);
                            $("#total").val(data.info.total);
                            $('#UpdateBill').modal('open');
                        }
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });
            $("#monthlyrent,#due,#addicrg,#discount,#advance,#vat").keyup(function() {

                var total = isNaN((Number($("#monthlyrent").val()) + Number($("#due").val()) + Number($(
                    "#addicrg").val())) - (Number($("#advance").val()) + Number($("#discount")
                    .val()))) ? 0 : ((Number($("#monthlyrent").val()) + (Number($("#due").val()) +
                    Number($(
                        "#addicrg").val())) - (Number($("#advance").val()) + Number($(
                        "#discount")
                    .val())))) + ((Number($("#monthlyrent").val()) + Number($("#addicrg").val())) *
                    Number($("#vat").val())) / 100;
                $("#total").val(total);
                console.log(total);
            });
            $(document).on('click', '#Updatemodal', function() {
                if ($("#monthlyrent").val() == '') {

                    alert('Monthly Charge Is Required');
                    $("#monthlyrent").focus();
                    return false;

                }
                if ($("#addicrg").val() == '') {
                    alert('Additional Charge Is Required');
                    $("#addicrg").focus();
                    return false;

                }
                if ($("#discount").val() == '') {
                    alert('discount  Is Required');
                    $("#discount").focus();
                    return false;

                }
                if ($("#due").val() == '') {
                    alert('due  Is Required');
                    $("#due").focus();
                    return false;

                }
                if ($("#advance").val() == '') {
                    alert('advance  Is Required');
                    $("#advance").focus();
                    return false;

                }
                if ($("#vat").val() == '') {
                    alert('vat  Is Required');
                    $("#vat").focus();
                    return false;

                }
                if ($("#total").val() == '') {
                    alert('total  Is Required');
                    $("#total").focus();
                    return false;

                }
                $info_url = url + '/admin/updatebillcustomer';
                $.ajax({
                    url: $info_url,
                    method: "POST",
                    type: "POST",
                    data: {
                        customerid: $("#customerid").val(),
                        billid: $("#billid").val(),
                        monthlyrent: $("#monthlyrent").val(),
                        addicrg: $("#addicrg").val(),
                        due: $("#due").val(),
                        discount: $("#discount").val(),
                        advance: $("#advance").val(),
                        vat: $("#vat").val(),
                        total: $("#total").val(),
                    },
                    success: function(data) {
                        if (data) {
                            toastr.warning('Update Successfully');
                            $('#UpdateBill').modal('close');
                            $('#dataTable').DataTable().ajax.reload();

                        }
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });
// admin status active in active


$(document).on('click','.Approved', function(){
      
                //alert(5);
                $statusid = $(this).attr('rid');
                //console.log($statusid);
                $.ajax({
                    type: "post",
                    url:url+'/admin/customerstatus',
                    data: {
                        id:$statusid,
                        action:"allow"
                    },
                    dataType: "json",
                    success: function (d) {
                        toastr.success(d.message);
                        $('#dataTable').DataTable().ajax.reload();
        
                    }
                });
        
            
        });
        
        });
    </script>


@endsection
