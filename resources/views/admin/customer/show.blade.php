
@extends('layouts.adminMaster')
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
              <img src="{{asset('images/gallery/pixinvent-logo.png')}}" alt="logo" height="46" width="164">
            </div>
            <div class="col m6 s12 pull-m6">
        
              <div class="row">
                  <div class="col m12 s12">
                    <table class="responsive-table">
           
                        <tbody>
                          <tr style="border: 0;">
                            <td>Customer ID:</td>
                            <td style="align-items: center; display: flex;">{{$customer->package_id}}  <a href="exchange" class="ml-5"><i class="material-icons">swap_horiz</i></a> <a href="delete" class="ml-5"><i class="material-icons">delete</i></a></td>
                          </tr>
                          <tr style="border: 0;">
                            <td>Login ID:</td>
                            <td>{{$customer->loginid}}</td>
                          </tr>
                          <tr style="border: 0;">
                              <td>MAC Address:</td>
                              <td>{{$customer->mac}} <a class="btn ml-5" style="background: #ddd">Change</a></td>
                            </tr>
                            <tr style="border: 0;">
                              <td>Customer Name:</td>
                              <td  style="align-items: center; display: flex;">{{$customer->customername}} <a href="home" class="ml-5"><i class="material-icons">home</i></a></td>
                            </tr>
                            <tr style="border: 0;">
                              <td>Contact No:</td>
                              <td>{{$customer->contactperson}} <a class="btn ml-5" style="background: #ddd">Change</a></td>
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
                  <td>{{$customer->package_id}}</td>
                </tr>
                <tr>
                  <td>Connection Status: </td>
                  <td>{{$customer->connection}} <a class="btn ml-5" style="background: #ddd">Change</a> <a class="btn ml-5" style="background: #ddd">Change and sms send</a></td>
                </tr>
                <tr>
                    <td>Account Status: </td>
                    <td>@if($customer->status==1)Acitve
                    @else Pending @endif <a class="btn ml-5" style="background: #ddd">Permanent Disable</a></td>
                  </tr>
                  <tr>
                    <td>EXPIRY DATE: </td>
                    <td>{{$customer->connectiondate}} <a href="#">Update grace time</a></td>
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
                    <td>{{$customer->ip}} <a class="btn ml-5" style="background: #ddd">Edit</a></td>
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
                  <td> <a class="btn ml-5" style="background: #ddd">Edit</a></td>
                </tr>
                <tr>
                  <td>ADDRESS: </td>
                  <td>{{$customer->remoteaddress}} <a class="btn ml-5" style="background: #ddd">Edit</a></td>
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
                    <td>{{$customer->connectiondate}} <a class="btn ml-5" style="background: #ddd">Edit</a></td>
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
<script src="{{asset('app-assets/js/scripts/app-invoice.js')}}"></script>
@endsection