@extends('layouts.superadmin')
@section('superadmin')
@section('title','Gender')
 
<div class="text-right mb-1"> <button type="button" class=" text-right btn  btn-success rounde" data-toggle="modal" data-target="#exampleModal">
  &nbsp;<i class="fa fa-plus"></i> Add New Gender
 </button></div>

 <!-- Modal -->
 <div class="modal fade example-modal-sm" id="exampleModal" data-target="#exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" >Create New Gender </h5>
         <h5> @include('partial.ajaxformerror')</h5>
        
       </div>
       <div  class="modal-body">
 
       {!! Form::open(array('route'=>'gender.store','class'=>'form','id'=>'ccccc'))!!}
       {!! Form::hidden('genderid','', ['id' => 'genderid']) !!}
 
 
       {!!Form::label('Permission','Gender Name')!!}
       {!!Form::text('name',null, array('id'=>'gender','class'=>'form-control','placeholder'=>'Male Or Female'))!!}
 
       
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
 <div class="row  mt-2 shadow-lg p-3 mb-5 bg-white rounded">
  <div class="table-responsive ">
                 <table class="table " id="dataTable1">
                   <thead>
            <tr class="" >
                
                <th scope="col">Gender Name</th>
               
                <th scope="col">Action</th>
            </tr>
           </thead>
 <tbody>
  
 </tbody>
        </table>
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
   url: "{{route('gender.index') }}",
  },
  columns:[
    {
    data: 'gender',
    name: 'gender',
    
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
     if($(this).val() == 'Save Gender'){

 
 $.ajax({
                 url:url+'/superadmin/gender',
                 method: "POST",
                 data:{
               gender:$("#gender").val(),
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
    


             $genderid = $(this).attr('rid');
              console.log($genderid);
             // return;
             $info_url = url + '/superadmin/gender/'+$genderid+'/edit';
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
                  url:url+'/superadmin/gender/'+$("#genderid").val(),
                 method: "PUT",
                 type: "PUT",
                 data:{ gender: $("#gender").val(),
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
             $genderid = $(this).attr('rid');
             //console.log($roomid);
             $info_url = url + '/superadmin/gender/'+$genderid;
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
 
             $("#gender").val(data.gender);
               $("#genderid").val(data.id);
             $("#addBtn").val('Update');
 
 
         }
         function clearform(){
             $('#ccccc')[0].reset();
             $("#addBtn").val('Save Gender');
         }
 
 $("#close").click(function(){
   clearform();
    
 });
 
 
 });
     

 </script>

 @endsection