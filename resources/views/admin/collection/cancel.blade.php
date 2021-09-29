
@extends('layouts.adminMaster')

{{-- page styles --}}
@section('title','Collection List')

@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/app-invoice.css')}}">
@endsection

@section('content')
{{-- @can('Merchant-List') --}}
<section class="invoice-view-wrapper section">
  <div class="row">
  
    <!-- invoice view page -->
    <div class="col xl12 m12 s12">
      <div class="card">
        <div class="card-content invoice-print-area">
         
          <div class="card invoice-action-wrapper">
            <div class="card-content" >
              <form>
                <input placeholder="Customer id/Name/Phone" id="search" type="text" class="search-box validate white search-circle">
              </form>
              <div class="invoice-action-btn">
                <a href="#"
                  class="btn indigo waves-effect waves-light display-flex align-items-center justify-content-center">
                  <i class="material-icons mr-4">check</i>
                  <span class="text-nowrap">Search </span>
                </a>
              </div>
              
            </div>
          </div>
          
          <!-- invoice address and contact -->
          <div class="row invoice-info">
            <h3 class="invoice-from center ">Customer Information</h3>
            <div class="col m6 s12">
           
              <div class="invoice-address">
                <span>ID</span>
              </div>
              <div class="invoice-address">
                <span>Name</span>
              </div>
              <div class="invoice-address">
                <span>PPPoE Username</span>
              </div>
              <div class="invoice-address">
                <span>Address</span>
              </div>
            </div>
            <div class="col m6 s12">
              <div class="divider show-on-small hide-on-med-and-up mb-3"></div>
             
              <div class="invoice-address">
                <div id="userid"></div>
               
              </div>
              <div class="invoice-address" id="name">
              
              </div>
              <div class="invoice-address"  id="ppusername">
                
              </div>
              <div class="invoice-address" id="adress">
               
              </div>
              <div class="invoice-address" id="total">
               
              </div>
            </div>
          </div>
          <div class="divider mb-3 mt-3"></div>
          <!-- product details table-->
          <div class="invoice-product-details">
            <table class="striped responsive-table">
              <thead>
                <th>Date</th>
                
                <th>Paid</th>
                <th>Cancel</th>
              </thead>
              <tbody id="dt">
             <tr  id="dd"></tr>
              </tbody>
            </table>
          </div>
          <!-- invoice subtotal -->
          
      </div>
    </div>
    <!-- invoice action  -->
  
  </div>
</section>
            
      
  <!-- Modal Structure -->

  {{-- @endcan --}}
@endsection

@section('page-script')
<script src="{{asset('app-assets/js/scripts/app-invoice.js')}}"></script>

<script>
  
$(document).ready(function () {
  function delay(callback, ms) {
  var timer = 0;
  return function() {
    var context = this, args = arguments;
    clearTimeout(timer);
    timer = setTimeout(function () {
      callback.apply(context, args);
    }, ms || 0);
  };
};
  $('#search').keydown(delay(function (e) {

    $search = $('#search').val();
  $.ajax({
          type: "post",
          url:url+'/admin/searchsinglecustomerbill',
          data: {
              id:$search
             
          },
     
          success: function (data) {
           // console.log(data.result.bill);
           $('#userid').html(null);
            $('#name').html(null);
            $('#ppusername').html(null);
            $('#adress').html(null);
           $('#dd').html(null);
           $('#dt td').html(null);
           $('#userid').append('<span>' + data.result.loginid + '</span>');
            $('#name').append('<span>' + data.result.customername + '</span>');
            $('#ppusername').append('<span>' + data.result.secretname + '</span>');
            $('#adress').append('<span> House No # '+ data.result.houseno + ', '+ data.result.floor + ', '  + data.result.district.district + ', ' +
                            data.result.thana.thana + ', ' + data.result.area.areaname +
                            ', ' + data.result.customermobile + '</span>');
                        $.each(data.result.bill[0].collection, function(key, newvalue){
                        $('#dt').append('<tr><>' + newvalue.updated_at + '</td><td>Collection By </br>' + newvalue.admin['name'] +' Paymenent method </br>' + newvalue.payby['paybyname'] + '</td><td>' + newvalue.paid + '</td><td><button id="Deletepay" paidval="'+newvalue.paid+'" rid="'+newvalue.id+'"><i class="material-icons">cancel</i></button></td></tr>'
                        );

                    });
                        
                   
                   
                
          }
        });
}, 900));


  $(document).on('click','#Deletepay', function(){
             //console.log($(this).attr('paidval'));
             if(!confirm('Sure?')) return;
             $payid = $(this).attr('rid');
             var payamount = $(this).attr('paidval');
            $info_url = url + '/admin/cancelcollection/'+$payid;
             $.ajax({
                 url:$info_url,
                 method: "DELETE",
                 type: "DELETE",
                 data:{
                  payamount
                 },
                 success: function(data){
                     if(data) {
                        toastr.warning('Payment delete');
                         location.reload();
                      // delay();
                
                         }
                 },
                 error:function(data){
                     console.log(data);
                 }
             });
         });
  
});
</script>


@endsection