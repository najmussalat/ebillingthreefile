
@extends('layouts.adminMaster')
@section('title', "Create Customer Invoice")

@section('content')

{{-- @can('Medicineinformation-Create')  --}}

    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                  <div class="input-field col s12 m9">
                   
                </div>
               
                    
                    <div class="col s12 m3 l3 input-field">
                      
                        <a href="{{url('admin/inactivecustomer')}}" class="waves-effect waves-light  btn "><i class="material-icons right">gps_fixed</i> Find Inactive Customer</a>
                    </div>
                   
                    <div class="row">
                        <div class="col s12">
                            <table id="page-length-option" class="display responsive-table">
                                <thead>
                            
                                    <tr>
                                     
                                        <th>ID</th>
                                        <th>Name </th>
                                        <th>Address</th>
                                       <th>Mobile</th>
                                        <th>Identification</th>
                                        <th>Ip/ <br> User</th>
                                        <th>Monthly <br> Rent</th>
                                        <th>Due</th>
                                        <th>Inactive <br> Date</th>
                                        <th>Action</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                  @if(count($infos)>0)
                                  @foreach ($infos as $info)
                                     <tr>
                                     
                                        <td>{{$info->loginid}}</td>
                                        <td>{{$info->customername}}</td>
                                       
                                        <td>{!! 'House No- '. $info->houseno.'<br/>'. $info->district->district.'<br/>'.$info->thana->thana.'<br/>'.$info->area->areaname !!}</td>
                                        <td>{{$info->customermobile}}</td>
                                        <td>{{$info->idnumber}}</td>
                                        <td>{{$info->secretname}}</td>
                                        <td>{{$info->monthlyrent}}</td>
                                         <td>{{$info->due}}</td>
                                         <td>{{ date('d-m-Y', strtotime(@$info->created_at)) }}</td>
                                         <td>
                                             <button  rid="{{$info->id}}" class="btn-floating mb-1 waves-effect waves-light inactive">  <i class="material-icons">edit</i></button>
                                            
                                    </td>
                                       
                                    </tr>
                                   </tbody>
                                <tfoot>
                                  @endforeach
                                  @else
                                 <h3 class="text-danger">Data Not Found</h3>
                                 @endif
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
@section('page-script')
 
<script>
 $(document).ready(function() {

    $(".inactive").click(function(){
        if (!confirm('Sure?')) return;
        $customerid = $(this).attr('rid');
 $.ajax({
     type: "get",
     url:url+'/admin/restorecustomer/'+$customerid,
     data: {
        
     },
     dataType: "json",
     success: function (d) {
       swal({
title: "Nice Work",
text: "collection submit successfully",
timer: 2000,
buttons: false
});
window.location.href = url+'/admin/editcustomer/'+$customerid;

     }
 });

});
});

  </script>
  @endsection