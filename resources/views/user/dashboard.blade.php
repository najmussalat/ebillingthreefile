@extends('layouts.userMaster')
@section('content')
@section('title', "Hello User")
 <div class="section">
  <!--card stats start-->

  <div id="card-stats" class="pt-0">
     <div class="row">
        <div class="col s12 m6 l6 xl3">
           <div class="card gradient-45deg-light-blue-cyan gradient-shadow min-height-100 white-text animate fadeLeft">
              <div class="padding-4">
                 <div class="row">
                    <div class="col s7 m7">
                      <i class="material-icons background-round mt-5">perm_identity</i>
                       <p>Memeber</p>
                    </div>
                    <div class="col s5 m5 right-align">
                       <h5 class="mb-0 white-text">Total</h5>
                       <p class="no-margin"> {{@$user->count('id')}}</p>
                       <p>User</p>
                    </div>
                 </div>
              </div>
              
           </div>
        </div>
        <div class="col s12 m6 l6 xl3">
          <div class="card gradient-45deg-light-blue-cyan gradient-shadow min-height-100 white-text animate fadeLeft">
             <div class="padding-4">
                <div class="row">
                   <div class="col s7 m7">
                     <i class="material-icons background-round mt-5">sms</i>
                      <p>Sms</p>
                   </div>
                   <div class="col s5 m5 right-align">
                      <h5 class="mb-0 white-text">Balance: </h5>
                      <p class="no-margin">{{@$smsinfo->blance}} Tk</p>
                      <p>Rate: <br>{{@$smsinfo->smsrate}} Tk</p>
                   </div>
                </div>
             </div>
             
          </div>
       </div>
       <div class="col s12 m6 l6 xl3">
        <div class="card gradient-45deg-light-blue-cyan gradient-shadow min-height-100 white-text animate fadeLeft">
           <div class="padding-4">
              <div class="row">
                 <div class="col s7 m7">
                   <i class="material-icons background-round mt-5">sms</i>
                    <p>Sms</p>
                 </div>
                 <div class="col s5 m5 right-align">
                    <h5 class="mb-0 white-text">Balance: </h5>
                    <p class="no-margin">{{@$smsinfo->blance}} Tk</p>
                    <p>Rate: <br>{{@$smsinfo->smsrate}} Tk</p>
                 </div>
              </div>
           </div>
           
        </div>
     </div>
     
        
     </div>
  </div>
  <!--card stats end-->
  <div id="card-stats" class="pt-0">
    <div class="row">
       <div class="col s12 m6 l6 xl3">
          <div class="card gradient-45deg-light-blue-cyan gradient-shadow min-height-100 white-text animate fadeLeft">
             <div class="padding-4">
                <div class="row">
                   <div class="col s7 m7">
                     <i class="material-icons background-round mt-5">perm_identity</i>
                      <p>Total User </p>
                   </div>
                   <div class="col s5 m5 right-align">
                      <h5 class="mb-0 white-text">{{$user->where('status','=',2)->count('id')}}</h5>
                      <p class="no-margin">New</p>
                      <p>{{$user->count('id')}}</p>
                   </div>
                </div>
             </div>
          </div>
       </div>
     
    
       <div class="col s12 m6 l6 xl3">
          <div class="card gradient-45deg-green-teal gradient-shadow min-height-100 white-text animate fadeRight">
             <div class="padding-4">
                <div class="row">
                   <div class="col s7 m7">
                      <i class="material-icons background-round mt-5">bug_report</i>
                      <p>Total Email</p>
                   </div>
                   <div class="col s5 m5 right-align">
                      <h5 class="mb-0 white-text">{{$contact->where('status','=',2)->count('id')}}</h5>
                      <p class="no-margin">Unread</p>
                      <p>{{$contact->count('id')}}</p>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
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