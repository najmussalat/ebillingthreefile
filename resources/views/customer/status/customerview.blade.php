@extends('layouts.adminMaster')
{{-- page styles --}}
@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-invoice.css') }}">
@endsection

{{-- page content --}}
@section('content')
@section('title', ' Customer')

{{-- {{dd($customer)}} --}}
<a href="de"></a>
<section class="invoice-view-wrapper section">
    <div class="row">
        <!-- invoice view page -->
        <div class="col xl12 m12 s12">
            <div class="card">
                <div class="card-content invoice-print-area">

<div class="row">
  <div class="col xl4 m4 s12">
<div class="card card-border z-depth-2">

  <div class="card-content">
    <div class="row">
      <div class="col s2 pr-0 circle">
        <a href="#"><img class="responsive-img circle" src="../../../app-assets/images/user/1.jpg" alt=""></a>
      </div>
      <div class="col s10">
        <a href="#">
          <h6>Tomal</h6>
        </a>
    
      </div>
    </div>
    <hr>

<p>
  Package: 5mbps
</p>
<p>
  Monthly: 500tk
</p>
<p>
  Valid Till: 1 Sept 2021
</p>
  </div>
</div>


<div class="card card-border z-depth-2">
  <div class="card-content">
<p class="mb-5">
  This private Complain system is developed to handle queries & complain of our direct customers. 
</p>
    <a class="waves-effect waves-light btn-large">New Complain</a>
  </div>
</div>



  


  </div>
 
   <div class="col xl8 m8 s12">
<div class="card card-border z-depth-2">
<div class="card-content">


  <h6 class="">Customer Status</h6>

  <div class="statustable">
    <table>
      <thead>
      <tr>
        <th>SL</th>
        <th>DATE</th>
        <th>STATUS</th>
        <th>VIEW </th>
        <th>DOWNLOAD </th>
      </tr>
      </thead>
      <tbody>
      <tr>
        <td>1</td>
        <td>02-09-2021</td>
        <td>Active</td>
        <td><a href="#">View Link</a></td>
        <td><a href="#">Download Link</a></td>
      </tr>
      <tr>
        <td>1</td>
        <td>02-09-2021</td>
        <td>Pending</td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td>1</td>
        <td>02-09-2021</td>
        <td>Active</td>
        <td><a href="#">View Link</a></td>
        <td><a href="#">Download Link</a></td>
      </tr>
  
      </tbody>
    </table>

</div>

</div>

    
  </div>

  <div class="card card-border z-depth-2">
    <div class="card-content">
    
    
      <h6 class=""> Complain History</h6>
    
      <div class="statustable">
        <table>
          <thead>
          <tr>
            <th>Subject</th>
            <th>DATE</th>
            <th>STATUS</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td><a href="#">Ticket Subject</a></td>
            <td>02-09-2021</td>
            <td>Pending</td>
          </tr>
         </tbody>
        </table>
        
    
    </div>
    
    </div>
    
        
      </div>
</div>






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
<script src="{{ asset('app-assets/js/scripts/app-invoice.js') }}"></script>
@endsection
