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


<div class="row" style="display: flex">
    <div style="width: 30%;">
           
        <div class="row">
            <div class="col s12">

             
                    <!-- header section -->
              
                    <div class="row">
                        <div class="col m12 s12">
                            <img src="../../../app-assets/images/gallery/pixinvent-logo.png" alt="logo"
                            width="164" height="46">
                        </div>
                        <div class="col m12 s12">
                            <h6 class="indigo-text">Office Doccument</h6>
                        </div>
                    </div>

                    <!-- invoice address and contact -->
                    <div class="row invoice-info">
                        <div class="col m6 s12">
                            <div class="row">
                                <div class="col m12 s12">
                                    <p>1 Aug 2021</p>
                                </div>
                            </div>
                                <div class="row">
                                <div class="col m12 s12">
                                    <p>
                                        ID: NAQW103
                                    </p>
                                </div>
                            </div>
                            <h6 class="customer-name" style="color: #6b6f82; font-weight: 700;">Tomal</h6>
                          
                            <p class="mb-1">Address & phone no.</p>
                         <p class="mb-1">Internal ID: 7331151071</p>
                           
                           
                            <p class="mb-1">
                                Billing Month : Aug 2021
                            </p>
                            <p class="mb-1">
                                Due Month's List : Jul 2021 : 1000TK
                            </p>
                        
                        </div>
                        <div class="col m6 s12">
                            <ul>
                                <li class="display-flex justify-content-between">
                                    <span class="invoice-subtotal-title">Monthly Rent</span>
                                    <span>00</span>
                                </li>
                                <li class="display-flex justify-content-between">
                                    <span class="invoice-subtotal-title">Additional</span>
                                    <span>00</span>
                                </li>
                                <li class="display-flex justify-content-between">
                                    <span class="invoice-subtotal-title">Discount</span>
                                    <span>00</span>
                                </li>
                           
                                <li class="display-flex justify-content-between">
                                    <span class="invoice-subtotal-title">Advance</span>
                                    <span>00</span>
                                </li>
                                <li style="border: 1px solid"></li>
                                <li class="display-flex justify-content-between">
                                    <span class="invoice-subtotal-title">SUM</span>
                                    <span>00</span>
                                </li>
                                <li class="display-flex justify-content-between">
                                    <span class="invoice-subtotal-title">Vat(%)</span>
                                    <span>00</span>
                                </li>
                                <li style="border: 1px solid"></li>
                                <li class="display-flex justify-content-between">
                                    <span class="invoice-subtotal-title">Sum with vat</span>
                                    <span>00</span>
                                </li>
                                <li class="display-flex justify-content-between">
                                    <span class="invoice-subtotal-title">Previous DUE</span>
                                    <span>00</span>
                                </li>
                               <li style="border: 1px solid"></li>
                                <li class="display-flex justify-content-between">
                                    <span class="invoice-subtotal-title">Total</span>
                                    <span>00</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- product details table-->

            </div>
        </div>
    </div>
    <div style="width: 30%;">
        
        <div class="row">
            <div class="col s12">

             
                    <!-- header section -->
              
                    <!-- logo and title -->
                   
                    <div class="row">
                        <div class="col m12 s12">
                            <img src="../../../app-assets/images/gallery/pixinvent-logo.png" alt="logo"
                            width="164" height="46">
                        </div>
                        <div class="col m12 s12">
                            <h6 class="indigo-text">Money Receipt </h6>
                        </div>
                    </div>

                    <!-- invoice address and contact -->
                    <div class="row invoice-info">
                        <div class="col m6 s12">
                            <div class="row">
                                <div class="col m12 s12">
                                    <p>1 Aug 2021</p>
                                </div>
                            </div>
                                <div class="row">
                                <div class="col m12 s12">
                                    <p>
                                        ID: NAQW103
                                    </p>
                                </div>
                            </div>
                            <h6 class="customer-name" style="color: #6b6f82; font-weight: 700;">Tomal</h6>
                           
                           

                            <p class="mb-1">Address & phone no.</p>
                         <p class="mb-1">Internal ID: 7331151071</p>
                           
                           
                            <p class="mb-1">
                                Billing Month : Aug 2021
                            </p>
                            <p class="mb-1">
                                Due Month's List : Jul 2021 : 1000TK
                            </p>
                        
                        </div>
                        <div class="col m6 s12">
                            <ul>
                                <li class="display-flex justify-content-between">
                                    <span class="invoice-subtotal-title">Monthly Rent</span>
                                    <span>00</span>
                                </li>
                                <li class="display-flex justify-content-between">
                                    <span class="invoice-subtotal-title">Additional</span>
                                    <span>00</span>
                                </li>
                                <li class="display-flex justify-content-between">
                                    <span class="invoice-subtotal-title">Discount</span>
                                    <span>00</span>
                                </li>
                           
                                <li class="display-flex justify-content-between">
                                    <span class="invoice-subtotal-title">Advance</span>
                                    <span>00</span>
                                </li>
                                <li style="border: 1px solid"></li>
                                <li class="display-flex justify-content-between">
                                    <span class="invoice-subtotal-title">SUM</span>
                                    <span>00</span>
                                </li>
                                <li class="display-flex justify-content-between">
                                    <span class="invoice-subtotal-title">Vat(%)</span>
                                    <span>00</span>
                                </li>
                                <li style="border: 1px solid"></li>
                                <li class="display-flex justify-content-between">
                                    <span class="invoice-subtotal-title">Sum with vat</span>
                                    <span>00</span>
                                </li>
                                <li class="display-flex justify-content-between">
                                    <span class="invoice-subtotal-title">Previous DUE</span>
                                    <span>00</span>
                                </li>
                               <li style="border: 1px solid"></li>
                                <li class="display-flex justify-content-between">
                                    <span class="invoice-subtotal-title">Total</span>
                                    <span>00</span>
                                </li>
                            </ul>
                        </div>
                    </div>
             
            </div>
        </div>
    </div>
    <div style="width: 33.33%;">
        <div class="row">
            <div class="col s12">

             
                    <!-- header section -->
              
                    <!-- logo and title -->
                 

                    <div class="row">
                        <div class="col m12 s12">
                            <img src="../../../app-assets/images/gallery/pixinvent-logo.png" alt="logo"
                            width="164" height="46">
                        </div>

                        <div class="col m12 s12">
                            <h6 class="indigo-text">Invoice</h6>
                        </div>
                    </div>

                    <!-- invoice address and contact -->
                    <div class="row invoice-info">
                        <div class="col m6 s12">
                            <div class="row">
                                <div class="col m12 s12">
                                    <p>1 Aug 2021</p>
                                </div>
                            </div>
                                <div class="row">
                                <div class="col m12 s12">
                                    <p>
                                        ID: NAQW103
                                    </p>
                                </div>
                            </div>
                            <h6 class="customer-name" style="color: #6b6f82; font-weight: 700;">Tomal</h6>
                           
                          
                            <p class="mb-1">Address & phone no.</p>
                         <p class="mb-1">Internal ID: 7331151071</p>
                           
                           
                            <p class="mb-1">
                                Billing Month : Aug 2021
                            </p>
                            <p class="mb-1">
                                Due Month's List : Jul 2021 : 1000TK
                            </p>
                        
                        </div>
                        <div class="col m6 s12">
                            <ul>
                                <li class="display-flex justify-content-between">
                                    <span class="invoice-subtotal-title">Monthly Rent</span>
                                    <span>00</span>
                                </li>
                                <li class="display-flex justify-content-between">
                                    <span class="invoice-subtotal-title">Additional</span>
                                    <span>00</span>
                                </li>
                                <li class="display-flex justify-content-between">
                                    <span class="invoice-subtotal-title">Discount</span>
                                    <span>00</span>
                                </li>
                           
                                <li class="display-flex justify-content-between">
                                    <span class="invoice-subtotal-title">Advance</span>
                                    <span>00</span>
                                </li>
                                <li style="border: 1px solid"></li>
                                <li class="display-flex justify-content-between">
                                    <span class="invoice-subtotal-title">SUM</span>
                                    <span>00</span>
                                </li>
                                <li class="display-flex justify-content-between">
                                    <span class="invoice-subtotal-title">Vat(%)</span>
                                    <span>00</span>
                                </li>
                                <li style="border: 1px solid"></li>
                                <li class="display-flex justify-content-between">
                                    <span class="invoice-subtotal-title">Sum with vat</span>
                                    <span>00</span>
                                </li>
                                <li class="display-flex justify-content-between">
                                    <span class="invoice-subtotal-title">Previous DUE</span>
                                    <span>00</span>
                                </li>
                               <li style="border: 1px solid"></li>
                                <li class="display-flex justify-content-between">
                                    <span class="invoice-subtotal-title">Total</span>
                                    <span>00</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- product details table-->

                    <p>Note: Please take money receipt while payingmoney. You might need to show this money receipt if we ask for<p>

            </div>
        </div>
    </div>
</div>

                   
                   
                    <div class="divider mb-3 mt-3"></div>
                   

                    <div class="row" style="display: flex">
                        <div style="width: 30%;">
                               
                            <div class="row">
                                <div class="col s12">
                    
                                 
                                        <!-- header section -->
                                  
                                        <div class="row">
                                            <div class="col m12 s12">
                                                <img src="../../../app-assets/images/gallery/pixinvent-logo.png" alt="logo"
                                                width="164" height="46">
                                            </div>
                                            <div class="col m12 s12">
                                                <h6 class="indigo-text">Office Doccument</h6>
                                            </div>
                                        </div>
                    
                                        <!-- invoice address and contact -->
                                        <div class="row invoice-info">
                                            <div class="col m6 s12">
                                                <div class="row">
                                                    <div class="col m12 s12">
                                                        <p>1 Aug 2021</p>
                                                    </div>
                                                </div>
                                                    <div class="row">
                                                    <div class="col m12 s12">
                                                        <p>
                                                            ID: NAQW103
                                                        </p>
                                                    </div>
                                                </div>
                                                <h6 class="customer-name" style="color: #6b6f82; font-weight: 700;">Tomal</h6>
                                               
                                               
                                                <p class="mb-1">Address & phone no.</p>
                                             <p class="mb-1">Internal ID: 7331151071</p>
                                               
                                               
                                                <p class="mb-1">
                                                    Billing Month : Aug 2021
                                                </p>
                                                <p class="mb-1">
                                                    Due Month's List : Jul 2021 : 1000TK
                                                </p>
                                            
                                            </div>
                                            <div class="col m6 s12">
                                                <ul>
                                                    <li class="display-flex justify-content-between">
                                                        <span class="invoice-subtotal-title">Monthly Rent</span>
                                                        <span>00</span>
                                                    </li>
                                                    <li class="display-flex justify-content-between">
                                                        <span class="invoice-subtotal-title">Additional</span>
                                                        <span>00</span>
                                                    </li>
                                                    <li class="display-flex justify-content-between">
                                                        <span class="invoice-subtotal-title">Discount</span>
                                                        <span>00</span>
                                                    </li>
                                               
                                                    <li class="display-flex justify-content-between">
                                                        <span class="invoice-subtotal-title">Advance</span>
                                                        <span>00</span>
                                                    </li>
                                                    <li style="border: 1px solid"></li>
                                                    <li class="display-flex justify-content-between">
                                                        <span class="invoice-subtotal-title">SUM</span>
                                                        <span>00</span>
                                                    </li>
                                                    <li class="display-flex justify-content-between">
                                                        <span class="invoice-subtotal-title">Vat(%)</span>
                                                        <span>00</span>
                                                    </li>
                                                    <li style="border: 1px solid"></li>
                                                    <li class="display-flex justify-content-between">
                                                        <span class="invoice-subtotal-title">Sum with vat</span>
                                                        <span>00</span>
                                                    </li>
                                                    <li class="display-flex justify-content-between">
                                                        <span class="invoice-subtotal-title">Previous DUE</span>
                                                        <span>00</span>
                                                    </li>
                                                   <li style="border: 1px solid"></li>
                                                    <li class="display-flex justify-content-between">
                                                        <span class="invoice-subtotal-title">Total</span>
                                                        <span>00</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- product details table-->
                    
                                </div>
                            </div>
                        </div>
                        <div style="width: 30%;">
                            
                            <div class="row">
                                <div class="col s12">
                    
                                 
                                        <!-- header section -->
                                  
                                        <!-- logo and title -->
                                       
                                        <div class="row">
                                            <div class="col m12 s12">
                                                <img src="../../../app-assets/images/gallery/pixinvent-logo.png" alt="logo"
                                                width="164" height="46">
                                            </div>
                                            <div class="col m12 s12">
                                                <h6 class="indigo-text">Money Receipt </h6>
                                            </div>
                                        </div>
                    
                                        <!-- invoice address and contact -->
                                        <div class="row invoice-info">
                                            <div class="col m6 s12">
                                                <div class="row">
                                                    <div class="col m12 s12">
                                                        <p>1 Aug 2021</p>
                                                    </div>
                                                </div>
                                                    <div class="row">
                                                    <div class="col m12 s12">
                                                        <p>
                                                            ID: NAQW103
                                                        </p>
                                                    </div>
                                                </div>
                                                <h6 class="customer-name" style="color: #6b6f82; font-weight: 700;">Tomal</h6>
                                               
                                            
                                                <p class="mb-1">Address & phone no.</p>
                                             <p class="mb-1">Internal ID: 7331151071</p>
                                               
                                               
                                                <p class="mb-1">
                                                    Billing Month : Aug 2021
                                                </p>
                                                <p class="mb-1">
                                                    Due Month's List : Jul 2021 : 1000TK
                                                </p>
                                            
                                            </div>
                                            <div class="col m6 s12">
                                                <ul>
                                                    <li class="display-flex justify-content-between">
                                                        <span class="invoice-subtotal-title">Monthly Rent</span>
                                                        <span>00</span>
                                                    </li>
                                                    <li class="display-flex justify-content-between">
                                                        <span class="invoice-subtotal-title">Additional</span>
                                                        <span>00</span>
                                                    </li>
                                                    <li class="display-flex justify-content-between">
                                                        <span class="invoice-subtotal-title">Discount</span>
                                                        <span>00</span>
                                                    </li>
                                               
                                                    <li class="display-flex justify-content-between">
                                                        <span class="invoice-subtotal-title">Advance</span>
                                                        <span>00</span>
                                                    </li>
                                                    <li style="border: 1px solid"></li>
                                                    <li class="display-flex justify-content-between">
                                                        <span class="invoice-subtotal-title">SUM</span>
                                                        <span>00</span>
                                                    </li>
                                                    <li class="display-flex justify-content-between">
                                                        <span class="invoice-subtotal-title">Vat(%)</span>
                                                        <span>00</span>
                                                    </li>
                                                    <li style="border: 1px solid"></li>
                                                    <li class="display-flex justify-content-between">
                                                        <span class="invoice-subtotal-title">Sum with vat</span>
                                                        <span>00</span>
                                                    </li>
                                                    <li class="display-flex justify-content-between">
                                                        <span class="invoice-subtotal-title">Previous DUE</span>
                                                        <span>00</span>
                                                    </li>
                                                   <li style="border: 1px solid"></li>
                                                    <li class="display-flex justify-content-between">
                                                        <span class="invoice-subtotal-title">Total</span>
                                                        <span>00</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                 
                                </div>
                            </div>
                        </div>
                        <div style="width: 33.33%;">
                            <div class="row">
                                <div class="col s12">
                    
                                 
                                        <!-- header section -->
                                  
                                        <!-- logo and title -->
                                     
                    
                                        <div class="row">
                                            <div class="col m12 s12">
                                                <img src="../../../app-assets/images/gallery/pixinvent-logo.png" alt="logo"
                                                width="164" height="46">
                                            </div>
                    
                                            <div class="col m12 s12">
                                                <h6 class="indigo-text">Invoice</h6>
                                            </div>
                                        </div>
                    
                                        <!-- invoice address and contact -->
                                        <div class="row invoice-info">
                                            <div class="col m6 s12">
                                                <div class="row">
                                                    <div class="col m12 s12">
                                                        <p>1 Aug 2021</p>
                                                    </div>
                                                </div>
                                                    <div class="row">
                                                    <div class="col m12 s12">
                                                        <p>
                                                            ID: NAQW103
                                                        </p>
                                                    </div>
                                                </div>
                                                <h6 class="customer-name" style="color: #6b6f82; font-weight: 700;">Tomal</h6>
                                               
                                               
                                                <p class="mb-1">Address & phone no.</p>
                                             <p class="mb-1">Internal ID: 7331151071</p>
                                               
                                               
                                                <p class="mb-1">
                                                    Billing Month : Aug 2021
                                                </p>
                                                <p class="mb-1">
                                                    Due Month's List : Jul 2021 : 1000TK
                                                </p>
                                            
                                            </div>
                                            <div class="col m6 s12">
                                                <ul>
                                                    <li class="display-flex justify-content-between">
                                                        <span class="invoice-subtotal-title">Monthly Rent</span>
                                                        <span>00</span>
                                                    </li>
                                                    <li class="display-flex justify-content-between">
                                                        <span class="invoice-subtotal-title">Additional</span>
                                                        <span>00</span>
                                                    </li>
                                                    <li class="display-flex justify-content-between">
                                                        <span class="invoice-subtotal-title">Discount</span>
                                                        <span>00</span>
                                                    </li>
                                               
                                                    <li class="display-flex justify-content-between">
                                                        <span class="invoice-subtotal-title">Advance</span>
                                                        <span>00</span>
                                                    </li>
                                                    <li style="border: 1px solid"></li>
                                                    <li class="display-flex justify-content-between">
                                                        <span class="invoice-subtotal-title">SUM</span>
                                                        <span>00</span>
                                                    </li>
                                                    <li class="display-flex justify-content-between">
                                                        <span class="invoice-subtotal-title">Vat(%)</span>
                                                        <span>00</span>
                                                    </li>
                                                    <li style="border: 1px solid"></li>
                                                    <li class="display-flex justify-content-between">
                                                        <span class="invoice-subtotal-title">Sum with vat</span>
                                                        <span>00</span>
                                                    </li>
                                                    <li class="display-flex justify-content-between">
                                                        <span class="invoice-subtotal-title">Previous DUE</span>
                                                        <span>00</span>
                                                    </li>
                                                   <li style="border: 1px solid"></li>
                                                    <li class="display-flex justify-content-between">
                                                        <span class="invoice-subtotal-title">Total</span>
                                                        <span>00</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- product details table-->
                    
                                        <p>Note: Please take money receipt while payingmoney. You might need to show this money receipt if we ask for<p>
                    
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
