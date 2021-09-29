@extends('layouts.customerMaster')
@section('content')
@section('title', "Hello User")

 <div id="card-stats" class="pt-0">
  <div class="row">
   
    
    
  </div>
</div>

 </div><!-- START RIGHT SIDEBAR NAV -->

@endsection

@section('page-script')

<script>

$( window ).on("load", function() {

 
  $.ajax({
          type: "post",
          url:url+'/admin/checkprofile',
              
          success: function (data) {
            //console.log(data)
           if(data<100){
          $("#name").val(data);
            $('#dd').html(data);
            $('#ProfileModal').modal('open');
          }
          }
     
      });
  
 
});
</script>


@endsection