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
              <div class="card-content">
                <div class="input-field col s12 m9">

                </div>


                <div class="col s12 m3 l3 input-field">

                    <a href="http://localhost/ebilling/ibilling-master/public/admin/createcustomer" class="waves-effect waves-light  btn"><i class="material-icons right">gps_fixed</i> Create New</a>
                </div>

                <div class="row">
                    <div class="col s12" style="overflow-x: scroll; scrollbar-width: thin;">
                        <div id="dataTable_wrapper" class="dataTables_wrapper no-footer"><div class="dataTables_length" id="dataTable_length"><label>Show <select name="dataTable_length" aria-controls="dataTable" class=""><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div><div id="dataTable_filter" class="dataTables_filter"><label>Search:<input type="search" class="" placeholder="" aria-controls="dataTable"></label></div><div id="dataTable_processing" class="dataTables_processing" style="display: none;">Processing...</div><table id="dataTable" class="display table table-striped table-bordered nowrap dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="dataTable_info">
                            <thead>

                                <tr role="row"><td class="sorting_asc" rowspan="1" colspan="1" style="width: 18px;" aria-label="SL">SL</td><td class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 67px;" aria-label="ID: activate to sort column ascending">ID</td><th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 77px;" aria-label="Name: activate to sort column ascending">Name</th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 104px;" aria-label="Address">Address</th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 83px;" aria-label="Mobile">Mobile</th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 72px;" aria-label="IP/Username">IP/<br>Username</th><th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 57px;" aria-label="Monthly Rent: activate to sort column ascending">Monthly <br>Rent</th><th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 52px;" aria-label="Previus Due: activate to sort column ascending">Previus <br>Due</th><th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 62px;" aria-label="Discount: activate to sort column ascending">Discount</th><th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 62px;" aria-label="Advance: activate to sort column ascending">Advance</th><th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 52px;" aria-label="Add Charge: activate to sort column ascending">Add <br>Charge</th><th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 42px;" aria-label="Vat %: activate to sort column ascending">Vat %</th><th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 57px;" aria-label="Bill Amount: activate to sort column ascending">Bill <br>Amount</th><th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 69px;" aria-label="Collection Amount: activate to sort column ascending">Collection <br>Amount</th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 35px;" aria-label="Total Due">Total <br>Due</th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 46px;" aria-label="Status">Status</th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 128px;" aria-label="Action">Action</th></tr>
                            </thead>
                            <tbody>



                            <tr role="row" class="odd"><td class="sorting_1">1</td><td>NAQW0002</td><td>sadasdf asdf</td><td>House No- 4-one<br>Natotre<br>dfadsfds<br>adfds</td><td>01739898764</td><td></td><td>300</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>300</td><td>0</td><td>300</td><td><button type="button" rid="12" class="btn-sm Approved" title="Update Status"><i class="material-icons">beenhere</i></button></td><td><button type="button" id="UpdateBillBtn" uid="6" class="invoice-action-view btn-sm" title="Update Bill"><i class="material-icons ">update</i></button>&nbsp;&nbsp;<a title="Edit Customer" href="/admin/editcustomer/12" class="invoice-action-view"><i class="material-icons">edit</i></a>&nbsp;&nbsp;<a target="_blank" href="http://localhost/ebilling/ibilling-master/public/admin/customerprofile/12" class="invoice-action-view" title="See Preview"><i class="material-icons ">remove_red_eye</i></a>&nbsp;&nbsp;<button type="button" title="Inactive Customer" id="deleteBtn" rid="12" class="invoice-action-view btn-sm "><i class="material-icons ">https</i></button></td></tr><tr role="row" class="even"><td class="sorting_1">2</td><td>NAQW0003</td><td>sadasdf asdf</td><td>House No- 4-one<br>Natotre<br>gurudaspur<br>test</td><td>01739898764</td><td></td><td>300</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>300</td><td>0</td><td>300</td><td><button type="button" rid="5" class="btn-sm Approved" title="Update Status"><i class="material-icons">beenhere</i></button></td><td><button type="button" id="UpdateBillBtn" uid="5" class="invoice-action-view btn-sm" title="Update Bill"><i class="material-icons ">update</i></button>&nbsp;&nbsp;<a title="Edit Customer" href="/admin/editcustomer/5" class="invoice-action-view"><i class="material-icons">edit</i></a>&nbsp;&nbsp;<a target="_blank" href="http://localhost/ebilling/ibilling-master/public/admin/customerprofile/5" class="invoice-action-view" title="See Preview"><i class="material-icons ">remove_red_eye</i></a>&nbsp;&nbsp;<button type="button" title="Inactive Customer" id="deleteBtn" rid="5" class="invoice-action-view btn-sm "><i class="material-icons ">https</i></button></td></tr><tr role="row" class="odd"><td class="sorting_1">3</td><td>NAQW0005</td><td>sadasdf asdf</td><td>House No- 4-one<br>Natotre<br>gurudaspur<br>test</td><td>01739898764</td><td></td><td>300</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>300</td><td>0</td><td>300</td><td><button type="button" rid="4" class="btn-sm Approved" title="Update Status"><i class="material-icons">beenhere</i></button></td><td><button type="button" id="UpdateBillBtn" uid="4" class="invoice-action-view btn-sm" title="Update Bill"><i class="material-icons ">update</i></button>&nbsp;&nbsp;<a title="Edit Customer" href="/admin/editcustomer/4" class="invoice-action-view"><i class="material-icons">edit</i></a>&nbsp;&nbsp;<a target="_blank" href="http://localhost/ebilling/ibilling-master/public/admin/customerprofile/4" class="invoice-action-view" title="See Preview"><i class="material-icons ">remove_red_eye</i></a>&nbsp;&nbsp;<button type="button" title="Inactive Customer" id="deleteBtn" rid="4" class="invoice-action-view btn-sm "><i class="material-icons ">https</i></button></td></tr><tr role="row" class="even"><td class="sorting_1">4</td><td>NAQW001</td><td>Zahid</td><td>House No- 4-one<br>Natotre<br>gurudaspur<br>test</td><td>01739898764</td><td></td><td>300</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>300</td><td>0</td><td>300</td><td><button type="button" rid="3" class="btn-sm Approved" title="Update Status"><i class="material-icons">beenhere</i></button></td><td><button type="button" id="UpdateBillBtn" uid="3" class="invoice-action-view btn-sm" title="Update Bill"><i class="material-icons ">update</i></button>&nbsp;&nbsp;<a title="Edit Customer" href="/admin/editcustomer/3" class="invoice-action-view"><i class="material-icons">edit</i></a>&nbsp;&nbsp;<a target="_blank" href="http://localhost/ebilling/ibilling-master/public/admin/customerprofile/3" class="invoice-action-view" title="See Preview"><i class="material-icons ">remove_red_eye</i></a>&nbsp;&nbsp;<button type="button" title="Inactive Customer" id="deleteBtn" rid="3" class="invoice-action-view btn-sm "><i class="material-icons ">https</i></button></td></tr><tr role="row" class="odd"><td class="sorting_1">5</td><td>ASA-00002</td><td>Zahidul Islam</td><td>House No- 4345<br>Natotre<br>dfadsfds<br>adfds</td><td>01739898764</td><td>adfsdaf</td><td>300</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>300</td><td>0</td><td><button type="button" rid="2" class="btn-sm Approved" title="Update Status"><i class="material-icons">beenhere</i></button></td><td><button type="button" id="UpdateBillBtn" uid="2" class="invoice-action-view btn-sm" title="Update Bill"><i class="material-icons ">update</i></button>&nbsp;&nbsp;<a title="Edit Customer" href="/admin/editcustomer/2" class="invoice-action-view"><i class="material-icons">edit</i></a>&nbsp;&nbsp;<a target="_blank" href="http://localhost/ebilling/ibilling-master/public/admin/customerprofile/2" class="invoice-action-view" title="See Preview"><i class="material-icons ">remove_red_eye</i></a>&nbsp;&nbsp;<button type="button" title="Inactive Customer" id="deleteBtn" rid="2" class="invoice-action-view btn-sm "><i class="material-icons ">https</i></button></td></tr></tbody>
                            <tfoot>

                              <tr role="row"><td class="sorting_asc" rowspan="1" colspan="1" style="width: 18px;" aria-label="SL">SL</td><td class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 67px;" aria-label="ID: activate to sort column ascending">ID</td><th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 77px;" aria-label="Name: activate to sort column ascending">Name</th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 104px;" aria-label="Address">Address</th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 83px;" aria-label="Mobile">Mobile</th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 72px;" aria-label="IP/Username">IP/<br>Username</th><th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 57px;" aria-label="Monthly Rent: activate to sort column ascending">Monthly <br>Rent
                                <span style="color: slateblue; display: block">100</span>
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
                              </th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 46px;" aria-label="Status">Status</th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 128px;" aria-label="Action">Action</th></tr>
                            </tfoot>
                        </table><div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">Showing 1 to 5 of 5 entries</div><div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate"><a class="paginate_button previous disabled" aria-controls="dataTable" data-dt-idx="0" tabindex="-1" id="dataTable_previous">Previous</a><span><a class="paginate_button current" aria-controls="dataTable" data-dt-idx="1" tabindex="0">1</a></span><a class="paginate_button next disabled" aria-controls="dataTable" data-dt-idx="2" tabindex="-1" id="dataTable_next">Next</a></div></div>

                    </div>

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
