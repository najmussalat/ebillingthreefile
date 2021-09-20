@extends('layouts.adminMaster')
@section('title', 'Buy SMS List')
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

                        <a href="{{ url('admin/createbuysms') }}" class="waves-effect waves-light  btn"><i
                                class="material-icons right">gps_fixed</i> Create New</a>
                    </div>

                    <div class="row">
                        <div class="col s12" style="overflow-x: scroll; scrollbar-width: thin;">
                            <table id="dataTable" class="display table table-striped table-bordered nowrap"
                                style="width: 100%;">
                                <thead>

                                    <tr>
                                        <td>SL</td>
                                        <td>Date</td>
                                        <td>Payamount</td>
                                        <th>Transections</th>
                                        <th>Note</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>



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
          
            $('#dataTable').DataTable({
                // responsive: true,

                processing: true,
                serverSide: true,
                ajax: {
                   
                    url: "{{ url('admin/buysmslist') }}",

                },

                columns: [


                    {
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                    },

                    {
                        data: 'payamount',
                        name: 'payamount',

                    },{
                        data: 'transections',
                        name: 'transections',

                    },
                    {
                        data: 'note',
                        name: 'note',
                       
                    }, {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false
                    },



                    {
                        
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }

                ]

            });
            //Delete Admin
            $(document).on('click', '#deleteBtn', function() {

                if (!confirm('Sure?')) return;
                $id = $(this).attr('rid');
                //console.log($roomid);
                $info_url = url + '/superadmin/deletesalesms/' + $id;
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

           
$(document).on('click','.Approved', function(){
      
             
                $statusid = $(this).attr('rid');
                //console.log($statusid);
                $.ajax({
                    type: "post",
                    url:url+'/superadmin/aprovesalesms/'+ $statusid ,
                    data: {
                       
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
