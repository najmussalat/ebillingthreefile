@extends('layouts.adminMaster')
@section('title', 'Customer List')
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
@endsection
@section('content')

    {{-- @can('Customer-Create') --}}

    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <div class="input-field col s12 m9">

                    </div>


                    <div class="col s12 m3 l3 input-field">

                        <a href="{{ url('admin/createcustomer') }}" class="waves-effect waves-light  btn "><i
                                class="material-icons right">gps_fixed</i> Create New</a>
                    </div>

                    <div class="row">
                        <div class="col s12">
                            <div style="overflow-x: scroll">
                                <table id="dataTable"
                                    class="display table table-striped table-bordered nowrap dataTable no-footer"
                                    style="width: 1400px; font-size: 10px !important;" role="grid"
                                    aria-describedby="dataTable_info">
                                    <thead>

                                        <tr role="row">
                                            <td class="sorting_asc" rowspan="1" colspan="1" aria-label="SL"
                                                style="width: 12px;">SL</td>
                                            <td class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="ID: activate to sort column ascending"
                                                style="width: 45px;">ID</td>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Name: activate to sort column ascending"
                                                style="width: 46px;">Name</th>
                                            <th class="sorting_disabled" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Address: activate to sort column ascending"
                                                style="width: 39px;">Address</th>
                                            <th class="sorting_disabled" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Mobile: activate to sort column ascending"
                                                style="width: 50px;">Mobile</th>
                                            <th class="sorting_disabled" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="IP/Username: activate to sort column ascending"
                                                style="width: 94px;">IP/<br>Username</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Monthly Rent: activate to sort column ascending"
                                                style="width: 38px;">Monthly <br>Rent</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Previus Due: activate to sort column ascending"
                                                style="width: 35px;">Previus <br>Due</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Discount: activate to sort column ascending"
                                                style="width: 41px;">Discount</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Advance: activate to sort column ascending"
                                                style="width: 42px;">Advance</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Add Charge: activate to sort column ascending"
                                                style="width: 35px;">Add <br>Charge</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Vat: activate to sort column ascending"
                                                style="width: 17px;">Vat</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Bill Amount: activate to sort column ascending"
                                                style="width: 38px;">Bill <br>Amount</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1"
                                                aria-label="Collection Amount: activate to sort column ascending"
                                                style="width: 46px;">Collection <br>Amount</th>
                                            <th class="sorting" rowspan="1" colspan="1" aria-label="Total  Due"
                                                style="width: 24px;">Total <br>Due</th>
                                            <td class="sorting_asc" rowspan="1" colspan="1" aria-label="SL"
                                                style="width: 12px;">Update <br> Bill</td>
                                            <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="Action"
                                                style="width: 83px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>



                                        <tr role="row" class="odd">
                                            <td class="sorting_1">1</td>
                                            <td>ASA-000002</td>
                                            <td>Zahidul Islam</td>
                                            <td>4345</td>
                                            <td>01739898764</td>
                                            <td>adfsdaf</td>
                                            <td>300</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>1200</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>-900</td>
                                            <td>1</td>
                                            <td><a href="/admin/editcustomer/2" class="invoice-action-view"><i
                                                        class="material-icons">edit</i></a>&nbsp;&nbsp;<a target="_blank"
                                                    href="http://localhost/admin/customerprofile/2"
                                                    class="invoice-action-view"><i
                                                        class="material-icons ">remove_red_eye</i></a>&nbsp;&nbsp;<button
                                                    type="button" name="delete" id="deleteBtn" rid="2"
                                                    class="invoice-action-view btn-sm"><i
                                                        class="material-icons ">delete_forever</i></button></td>
                                        </tr>
                                        <tr role="row" class="even">
                                            <td class="sorting_1">2</td>
                                            <td>ASA-000001</td>
                                            <td>Zahid</td>
                                            <td>4345</td>
                                            <td>01856054702</td>
                                            <td>admin1234@gmail.com</td>
                                            <td>4444</td>
                                            <td>8440</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>12884</td>
                                            <td>1</td>
                                            <td><a href="/admin/editcustomer/1" class="invoice-action-view"><i
                                                        class="material-icons">edit</i></a>&nbsp;&nbsp;<a target="_blank"
                                                    href="http://localhost/admin/customerprofile/1"
                                                    class="invoice-action-view"><i
                                                        class="material-icons ">remove_red_eye</i></a>&nbsp;&nbsp;<button
                                                    type="button" name="delete" id="deleteBtn" rid="1"
                                                    class="invoice-action-view btn-sm"><i
                                                        class="material-icons ">delete_forever</i></button></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>

                                    </tfoot>
                                </table>



                            </div>
                        </div>

                    </div>
                </div>

            </div>
           
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

//             $(".sidenav-main").addClass("nav-collapsed");
//             $("#main").addClass("main-full");
//             $(".sidenav-main").hover(function(){
//                 $(".sidenav-main").toggleClass("nav-collapsed");
// });
 
            $('#dataTable').DataTable({

                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('admin/customerlist') }}",

                },

                columns: [

                    {
                        data: 'uuid',
                        name: 'uuid',

                    },
                    {
                        data: 'connectiondate',
                        name: 'connectiondate',


                    },
                    {
                        data: 'customername',
                        name: 'customername',

                    },


                    {
                        data: 'customermobile',
                        name: 'customermobile',

                    }, {
                        data: 'houseno',
                        name: 'houseno',

                    },

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
                            toastr.warning('customer delete');
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

        });
    </script>


@endsection
