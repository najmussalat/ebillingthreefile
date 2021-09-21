@extends('layouts.adminMaster')
@section('content')
@section('title', "Hello Admin")
 <div class="section">
  <!--card stats start-->
  <div id="card-stats" class="pt-0">
     <div class="row">

  
   
        <div class="col s12 m6 l6 xl3">
           
           <div class="card animate fadeLeft">
            <div class="card-content cyan white-text">
               <p class="card-stats-title"><i class="material-icons">person_outline</i> Total</p>
               <h4 class="card-stats-number white-text">{{@$user->count('id')}}</h4>
               <p class="card-stats-compare">
                  <i class="material-icons">keyboard_arrow_up</i> User
                  <span class="cyan text text-lighten-5"></span>
               </p>
            </div>
           
         </div>
        </div>
        <div class="col s12 m6 l6 xl3">
           
           <div class="card animate fadeLeft">
            <div class="card-content cyan white-text">
               <p class="card-stats-title"><i class="material-icons">sms</i> Balance</p>
               <h4 class="card-stats-number white-text">{{@$smsinfo->blance}} Tk</h4>
               <p class="card-stats-compare">
                  <i class="material-icons">keyboard_arrow_up</i> {{@$smsinfo->smsrate}} Tk
                  <span class="cyan text text-lighten-5"> Per SMS</span>
               </p>
            </div>
           
         </div>
        </div>
      
        <div class="col s12 m6 l6 xl3">
           
         <div class="card animate fadeLeft">
          <div class="card-content cyan white-text">
             <p class="card-stats-title"><i class="material-icons">accessibility</i>Active Customer</p>
             <h4 class="card-stats-number white-text">{{@$customer->count('id')}} </h4>
             <p class="card-stats-compare">
                <i class="material-icons">keyboard_arrow_up</i>Inactive {{@$customer->where('status',2)->count('id')}}
                <span class="cyan text text-lighten-5">Customer</span>
             </p>
          </div>
         
       </div>
      </div>
      <div class="col s12 m6 l6 xl3">
           
         <div class="card animate fadeLeft">
          <div class="card-content cyan white-text">
             <p class="card-stats-title"><i class="material-icons">accessibility</i> Complain</p>
             <h4 class="card-stats-number white-text">{{@$complain->count('id')}} </h4>
             <p class="card-stats-compare">
                <i class="material-icons">keyboard_arrow_up</i>Pending {{@$complain->where('status',2)->count('id')}}
                <span class="cyan text text-lighten-5">Complain</span>
             </p>
          </div>
         
       </div>
      </div>
        
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