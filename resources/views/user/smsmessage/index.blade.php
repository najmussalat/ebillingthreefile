
@extends('layouts.adminMaster')
@section('title', "Sms Setting")

@section('content')

{{-- @can('Medicineinformation-Create')  --}}
<div class="section">
  <!-- Snow Editor start -->
  <section class="snow-editor">
@include('partial.formerror')
                            <!-- Form Advance -->
                            <div class="col s12 m12 l12">
                               
                                <div id="Form-advance" class="card card card-default scrollspy">
                                    <div class="card-content">
                                        <h4 class="card-title">SMS Message</h4>
                                        <h5 class="card-title">Total Amount: {{$smsmessage->blance}} TK</h5>
                                        <h5 class="card-title">Total SMS: {{$smsmessage->blance/$smsmessage->smsrate}}, Per SMS {{$smsmessage->smsrate}} TK</h5>
                                     
                                        {!! Form::model($smsmessage, array('url' =>['admin/updatesmssetting/'.$smsmessage->id], 'method'=>'PATCH','id'=>'theform','files'=>true)) !!}
                                    
                                            @include('admin.smsmessage.form')
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        
                                                        <button data-target="ExampleModal" class="btn modal-trigger">Example Message In Bangla</button>
                                                        <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Update
                                                            <i class="material-icons right">send</i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                     {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
          </div>
         
          <div id="ExampleModal" class="modal">
              <div class="modal-content">
      
      
                  <div class="row">
                      <div class="input-field col m12 s12">
                        <p>Ex: New Customer <p>
        <p>  #CUSTOMER_NAME# , আপনার ID: #CUSTOMER_ID# , ip: #IP#, username : #PPPOE_USERNAME# , password : #PPPOE_PASSWORD# । আমাদের ইন্টারনেট সংযোগ নেওয়ার জন্য ধন্যবাদ - #COMPANY_NAME# .</p>
                          
                          
                </div>
                <div class="input-field col m12 s12">
                        <p>Ex: All Customer <p>
        <p>  #CUSTOMER_NAME#, আমাদের সাথে থাকার জন্য ধন্যবাদ। আপনার আইডি #CUSTOMER_ID# , IP #IP# , PPPoE Username #PPPOE_USERNAME#। আপনার যদি কোন প্রশ্ন থাকে তবে আমাদের জানান। - #COMPANY_NAME# #COMPANY_MOBILE# -- অথাবা -- #CUSTOMER_NAME# , আপনার #MONTH# মাসের বিল #BILL_AMOUNT# টাকা। বিল দেয়ার শেষ দিন #LAST_DAY_OF_PAY_BILL# । #COMPANY_NAME# #COMPANY_MOBILE# </p>
                          
                          
                </div> 
                    <div class="input-field col m12 s12">
                        <p>Ex: Bill Generate <p>
        <p> #CUSTOMER_NAME# , আপনার #MONTH# মাসের বিল #BILL_AMOUNT#/=, আপনার ID- #CUSTOMER_ID# । আপনি #LAST_DAY_OF_PAY_BILL# তারিখের মধ্যে টাকা পরিশোধ করুন। ধন্যবাদ - #COMPANY_NAME#</p>
                          
                          
                </div> 
                    <div class="input-field col m12 s12">
                        <p>Ex: Payment Collection <p>
        <p> #CUSTOMER_NAME# , আমরা #AMOUNT# টাকা পেয়েছি। আপনার username/IP #IP_OR_USER_NAME_OR_ID# , বকেয়া #DUE_AMOUNT#। ধন্যবাদ - #COMPANY_NAME# </p>
                          
                          
                </div>

       <div class="input-field col m12 s12">
                        <p>Ex: New Complain SMS (To Customer) <p>
        <p> প্রিয় #CUSTOMER_NAME#, আপনার অভিযোগ #COMPLAINS# , #COMMENT# পেয়েছি। আমাদের স্টাফ #EMPLOYEE_NAME# , #EMPLOYEE_MOBILE# আপনার সাথে যোগাযোগ করবে। - ধন্যবাদ #COMPANY_NAME# , #COMPANY_MOBILE# । </p>
                          
                          
                </div> 
                 <div class="input-field col m12 s12">
                        <p>Ex: New Complain SMS (To Support Staff) <p>
        <p> নতুন অভিযোগ নাম: #CUSTOMER_NAME#, IP: #IP# , PPPoE Username : #PPPOE_USERNAME#, মোবা: #CUSTOMER_MOBILE# , অভিযোগ: #COMPLAINS#, মন্তব্য: #COMMENT#, ঠিকানা: #CUSTOMER_ADDRESS# । এটি দ্রুত সমাধান করুন। </p>
                          
                          
                </div>
                <div class="input-field col m12 s12">
                        <p>Ex:Update Complain SMS (To Customer) <p>
        <p> .... </p>
                          
                          
                </div>
                <div class="input-field col m12 s12">
                        <p>Ex:Close Complain SMS (To Customer) <p>
        <p> প্রিয় #CUSTOMER_NAME# , আপনার সমস্যাটি সমাধান করা হয়েছে। প্রয়োজন হলে আমাদের কল করুন #COMPANY_MOBILE#। - ধন্যবাদ, #COMPANY_NAME# । </p>
                          
                          
                </div>
      
                      </div>
                      </div>
                      
              <div class="modal-footer">
                  <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Close
                    <i class="material-icons right">send</i></a>
              </div>
          </div>
{{-- @endcan --}}
@endsection


@section('page-script')
<script> 
 

 $(document).ready(function() {
  $('input#input_text, textarea#metadescription').characterCounter();

  

  $(".card .Close").click(function () {
	
    $(this).closest(".card")
        .fadeOut("slow");
});


$(".card-alert .close").click(function () {

    $(this).closest(".card-alert")
        .fadeOut("slow");
});
});

  </script>
  @endsection