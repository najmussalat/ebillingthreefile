@extends('layouts.superadmin')
@section('superadmin')
@section('title','Permission')
 
<div class="text-right mb-1"> <button type="button" class=" text-right btn  btn-success rounde" data-toggle="modal" data-target="#exampleModal">
  &nbsp;<i class="fa fa-plus"></i> Add Role Permission
 </button></div>

 <!-- Modal -->
 <div class="modal fade example-modal-sm" id="exampleModal" data-target="#exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" >Create New Permission </h5>
         <h5> @include('partial.ajaxformerror')</h5>
        
       </div>
       <div  class="modal-body">
 
       {!! Form::open(array('route'=>'permission.store','class'=>'form','id'=>'ccccc'))!!}
       {!! Form::hidden('permissionid','', ['id' => 'permissionid']) !!}
 
 
       {!!Form::label('Permission','Permission Name')!!}
       {!!Form::text('name',null, array('id'=>'name','class'=>'form-control','placeholder'=>'Do not use Space'))!!}
 
       
       <div class="modal-footer">
        <button id="close" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         <input type="button" id="addBtn" value="Save Permission" class="btn btn-primary">
 {!! Form::close()!!}
       </div>
     </div>
   </div>
 </div>
 </div>
 
 
 {{-- model area end --}}
 


        <!-- DataTales Example -->
        <div class="row">
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">All Permission Name</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                 <table class="table table-bordered table-striped table-responsive" id="dataTable1">
           <thead>
            <tr>
                
                <th width="35%">First Name</th>
               
                <th width="30%">Action</th>
            </tr>
           </thead>
       </table>
              </div>
            </div>
          </div>

        </div>


@endsection

@section('script')
<script>
$(document).ready(function(){

 $('#dataTable1').DataTable({
  processing: true,
  serverSide: true,
  ajax:{
   url: "{{route('permission.index') }}",
  },
  columns:[
    {
    data: 'name',
    name: 'name',
    
   },
   {
    data: 'action',
    name: 'action',
    orderable:false
   }
  ]
 });



  $("#formerrors").hide();
   clearform();
 
   $("#addBtn").click(function(){
     if($(this).val() == 'Save Permission'){

 
 $.ajax({
                 url:url+'/superadmin/permission',
                 method: "POST",
                 data:{
               name:$("#name").val(),
                  },
                 success:function(data){
                   if(data.success){
                     //alert(data.success);
                      toastr.success(data.message, data.title);
                     //console.log(data);
                   clearform();
                 
                  // jQuery('#exampleModal').modal('');
                  $('#exampleModal').modal('hide');
                     $('#dataTable1').DataTable().ajax.reload();
              }



                   else {
                        $.each(data.errors, function(key, value){
                  			$('#formerrors').show().delay(4000).slideUp(700);
                              $('#formerrors ul').append('<li>'+value+'</li>');
                            });
                    }  
                 },
                 error:function(data){
                   
                   console.log(data);
                 }
 
             });
     }
   });
     //Create end shift
 

 
   //Edit shift
 
   $(document).on('click','#editBtn', function(){
    


             $permissionid = $(this).attr('rid');
              console.log($permissionid);
             // return;
             $info_url = url + '/superadmin/permission/'+$permissionid+'/edit';
              //console.log($info_url);
            // return;
             $.get($info_url,{},function(data){
                      populateForm(data);
                  location.hash = "ccccc";    
                    
    $('#exampleModal').modal('show');
              
    // $('#exampleModal').removeClass(' modal fade');              
             });
         });
         //Edit shift end
 
  //Update shift
  $(document).on('click','#addBtn', function(){

     if($(this).val() == 'Update'){
   
                 $.ajax({
                  url:url+'/superadmin/permission/'+$("#permissionid").val(),
                 method: "PUT",
                 type: "PUT",
                 data:{ name: $("#name").val(),
                 },
                 success: function(data){
                       if(data.success) {
                        toastr.success(data.message, data.title);
                         clearform();
              $('#dataTable1').DataTable().ajax.reload();
               $('#exampleModal').modal('hide');
                
 
                         }
                 },
                 error:function(data){
                     console.log(data);
                    
                 }
             });
             }
           });
              //Update shift end
 


         //Delete exam
         $(document).on('click','#deleteBtn', function(){
             //alert()
             if(!confirm('Sure?')) return;
             $permissionid = $(this).attr('rid');
             //console.log($roomid);
             $info_url = url + '/superadmin/permission/'+$permissionid;
             $.ajax({
                 url:$info_url,
                 method: "DELETE",
                 type: "DELETE",
                 data:{
                 },
                 success: function(data){
                     if(data.success) {
                        toastr.warning(data.message, data.title);
                         //location.reload();
              $('#dataTable1').DataTable().ajax.reload();
                
                         }
                 },
                 error:function(data){
                     console.log(data);
                 }
             });
         });
         //Delete shift end
 
 
 
 
 
 //form populatede
 
 function populateForm(data){
 
             $("#name").val(data.name);
               $("#permissionid").val(data.id);
             $("#addBtn").val('Update');
 
 
         }
         function clearform(){
             $('#ccccc')[0].reset();
             $("#addBtn").val('Save Permission');
         }
 
 $("#close").click(function(){
   clearform();
    
 });
 
 
 });
     

 </script>
    
@endsection