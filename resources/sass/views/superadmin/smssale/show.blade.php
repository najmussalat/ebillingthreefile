
@extends('layouts.superadminMaster')
{{-- page styles --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/app-invoice.css')}}">
@endsection

{{-- page content --}}
@section('content')
@section('title', " Customer")

{{-- {{dd($customer)}} --}}
<a href="de"></a>
<section class="invoice-view-wrapper section">
  <div class="row">
    <!-- invoice view page -->
    <div class="col xl12 m12 s12">
      <div class="card">
        <div class="card-content invoice-print-area">
          <!-- header section -->
          <div class="row">
            <div class="col m12 s12">
                <h4 class="indigo-text center mb-4 mt-2">CUSTOMER INFORMATION</h4>
             
            </div>
        </div>
          <!-- logo and title -->
          <div class="row mt-3 invoice-logo-title">
            <div class="col m6 s12 display-flex invoice-logo mt-1 push-m6">
              <img  src="{{@url('storage/app/files/shares/uploads/'.$customer->path.'/'.$customer->photo)}}" width="100px">
             
            </div>
            <div class="col m6 s12 pull-m6">
        
              <div class="row">
                  <div class="col m12 s12">
                    <table class="responsive-table">
           
                        <tbody>
                          <tr style="border: 0;">
                            <td>Customer ID:</td>
                            <td style="align-items: center; display: flex;">{{$customer->id}}  <a href="exchange" class="ml-5"><i class="material-icons">swap_horiz</i></a> <button id="deleteBtn" rid="{{$customer->id}}" class="ml-5"><i class="material-icons">delete</i></button></td>
                          </tr>
                          <tr style="border: 0;">
                            <td>Login ID:</td>
                            <td>{{$customer->loginid}}</td>
                          </tr>
                          <tr style="border: 0;">
                              <td>MAC Address:</td>
                              <td>{{$customer->mac}} <a class="btn ml-5" href="{{url('admin/editcustomer/'.$customer->id)}}" style="background: #ddd">Change</a></td>
                            </tr>
                            <tr style="border: 0;">
                              <td>Customer Name:</td>
                              <td  style="align-items: center; display: flex;">{{$customer->customername}} <a  href="{{url('admin/customerlist'.$customer->id)}}" class="ml-5"><i class="material-icons">home</i></a></td>
                            </tr>
                            <tr style="border: 0;">
                              <td>Contact No:</td>
                              <td>{{$customer->contactperson}} <a  href="{{url('admin/editcustomer/'.$customer->id)}}" class="btn ml-5" style="background: #ddd">Change</a></td>
                            </tr>
        
                           
                        </tbody>
                      </table>
        
                  </div>
                 
              </div>

            
             
            </div>
          </div>
         
       
          <div class="divider mb-3 mt-3"></div>

          <div class="row">
            <div class="col m12 s12">
                <h4 class="indigo-text center mb-4 mt-2">CONNECTION STATUS/INFO</h4>
             
            </div>
        </div>
          <!-- product details table-->
          <div class="invoice-product-details">
            <table class="striped responsive-table">
           
              <tbody>
                <tr>
                  <td>PACKAGE:</td>
                  <td>{{$customer->package->packagename}}</td>
                </tr>
                <tr>
                  <td>Connection Status: </td>
                  <td>{{$customer->connection}} <a href="{{url('admin/editcustomer/'.$customer->id)}}" class="btn ml-5" style="background: #ddd">Change</a> <a href="{{url('admin/editcustomer/'.$customer->id)}}" class="btn ml-5" style="background: #ddd">Change and sms send</a></td>
                </tr>
                <tr>
                    <td>Account Status: </td>
                    <td>@if($customer->status==1)Acitve
                    @else Pending @endif <a href="{{url('admin/editcustomer/'.$customer->id)}}" class="btn ml-5" style="background: #ddd">Permanent Disable</a></td>
                  </tr>
                  <tr>
                    <td>EXPIRY DATE: </td>
                    <td>{{$customer->connectiondate}} <a href="{{url('admin/editcustomer/'.$customer->id)}}">Update grace time</a></td>
                  </tr>
                  <tr>
                    <td>BILL CYCLE: </td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>Balance: </td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>Permanent Discount: </td>
                    <td>{{$customer->discount}}</td>
                  </tr>
                  <tr>
                    <td>IP Address: </td>
                    <td>{{$customer->ip}} <a href="{{url('admin/editcustomer/'.$customer->id)}}" class="btn ml-5" style="background: #ddd">Edit</a></td>
                  </tr>
             
              </tbody>
            </table>
          </div>

          
          <div class="divider mb-3 mt-3"></div>

          <div class="row">
            <div class="col m12 s12">
                <h4 class="indigo-text center mb-4 mt-2">LOCATION</h4>
              
            </div>
        </div>

        <table class="striped responsive-table">
           
            <tbody>
              <tr>
                <td>SDT/ZONE NAME: </td>
                <td>{{$customer->area_id}}</td>
              </tr>
              <tr>
                <td>POP/AREA:</td>
                <td></td>
              </tr>
              <tr>
                  <td>Account Manager:</td>
                  <td></td>
                </tr>
                <tr>
                  <td>VLAN/BOX & SW Port: </td>
                  <td> <a href="{{url('admin/editcustomer/'.$customer->id)}}" class="btn ml-5" style="background: #ddd">Edit</a></td>
                </tr>
                <tr>
                  <td>ADDRESS: </td>
                  <td>{{$customer->remoteaddress}} <a href="{{url('admin/editcustomer/'.$customer->id)}}" class="btn ml-5" style="background: #ddd">Edit</a></td>
                </tr>

               
            </tbody>
          </table>
        <div class="divider mb-3 mt-3"></div>

        <div class="row">
          <div class="col m12 s12">
              <h4 class="indigo-text center mb-4 mt-2">OTHERS</h4>
            
          </div>
      </div>

          <!-- product details table-->
          <div class="invoice-product-details">
            <table class="striped responsive-table">
           
              <tbody>
                <tr>
                  <td>Online Session Details:</td>
                  <td></td>
                </tr>
                <tr>
                  <td>Last Logged Out</td>
                  <td></td>
                </tr>
                <tr>
                    <td>Mikrotik:</td>
                    <td>{{$customer->mikrotic_id}}</td>
                  </tr>
                  <tr>
                    <td>Creation Date:</td>
                    <td>{{$customer->connectiondate}} <a href="{{url('admin/editcustomer/'.$customer->id)}}" class="btn ml-5" style="background: #ddd">Edit</a></td>
                  </tr>
                  <tr>
                    <td>Ref/Remarks:</td>
                    <td></td>
                  </tr>
                 
              </tbody>
            </table>
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
    
    <script>
        $(document).ready(function() {
       
            $(document).on('click', '#deleteBtn', function() {

                if (!confirm('Sure?')) return;
                $customerid = $(this).attr('rid');
                //console.log($roomid);
                $info_url = url + '/admin/deletecustomer/' + $customerid;
                $.ajax({
                    url: $info_url,
                    method: "DELETE",
                    type: "DELETE",
                    data: {},
                    success: function(data) {
                        if (data) {
                            toastr.warning('customer delete');
                            window.close();

                        }
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });
            });

            //Delete Admin end
</script>

@endsection
