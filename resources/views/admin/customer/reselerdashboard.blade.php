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
                    <div class="col s12 m6 l6 xl4">
                        <div class="card gradient-45deg-light-blue-cyan gradient-shadow min-height-100 white-text animate fadeLeft">
                           <div class="padding-5">
                              <div class="row">
                                 <div class="col s7 m7">
                                   <p> 33 / 0 </p>
                                   <p> 0 / 0 </p>
                                 </div>
                                 <div class="col s5 m5 right-align">
                                    <p>[Active]  </p>
                                    <p>[Online]  </p>
                                 </div>
                              </div>
                              <p class="pt-5">
                                  <a href="#" style="color: #fff;"> User Status  [Main / Zone] >  </a>
                              </p>
                              
                           </div>
                        </div>
                     </div>
                     <div class="col s12 m6 l6 xl4">
                        <div class="card gradient-45deg-red-pink gradient-shadow min-height-100 white-text animate fadeLeft">
                            <div class="padding-5">
                                <div class="row">
                                   <div class="col s7 m7">
                                     <p> </p>
                                     <p> </p>
                                   </div>
                                   <div class="col s5 m5 right-align">
                                      <p>[Main]  </p>
                                      <p>[Zone]  </p>
                                   </div>
                                </div>
                                <p class="pt-5">
                                    <a href="#" style="color: #fff;"> New Users >  </a>
                                </p>
                                
                             </div>
                        </div>
                     </div>
                     <div class="col s12 m6 l6 xl4">
                        <div class="card gradient-45deg-amber-amber gradient-shadow min-height-100 white-text animate fadeLeft">
                            <div class="padding-5">
                                <div class="row">
                                   <div class="col s7 m7">
                                     <p> </p>
                                     <p> </p>
                                   </div>
                                   <div class="col s5 m5 right-align">
                                      <p>[Today]  </p>
                                      <p>[August]  </p>
                                   </div>
                                </div>
                                <p class="pt-5">
                                    <a href="#" style="color: #fff;"> Collection [Home] >   </a>
                                </p>
                                
                             </div>
                        </div>
                     </div>
              
                 </div>
                 <div class="row">
                    <div class="col s12 m6 l6 xl4">
                        <div class="card  gradient-45deg-green-teal gradient-shadow min-height-100 white-text animate fadeLeft">
                            <div class="padding-5">
                                <div class="row">
                                   <div class="col s7 m7">
                                     <p> 
                                        -23,355 BDT</p>
                                     <p> </p>
                                   </div>
                                   <div class="col s5 m5 right-align">
                                      <p>[Home]  </p>
                                      <p> [Corporate]  </p>
                                   </div>
                                </div>
                                <p class="pt-5">
                                    <a href="#" style="color: #fff;"> Total Due >  </a>
                                </p>
                                
                             </div>
                        </div>
                     </div>
                     <div class="col s12 m6 l6 xl4">
                        <div class="card gradient-45deg-indigo-purple gradient-shadow min-height-100 white-text animate fadeLeft">
                            <div class="padding-5">
                                <div class="row">
                                   <div class="col s7 m7">
                                     <p> 
                                        </p>
                                     <p> </p>
                                   </div>
                                   <div class="col s5 m5 right-align">
                                      <p>[Open]  </p>
                                      <p> [Closed]  </p>
                                   </div>
                                </div>
                                <p class="pt-5">
                                    <a href="#" style="color: #fff;"> Open Tickets >  </a>
                                </p>
                                
                             </div>
                        </div>
                     </div>
                     <div class="col s12 m6 l6 xl4">
                        <div class="card gradient-45deg-blue-grey-blue gradient-shadow min-height-100 white-text animate fadeLeft">
                            <div class="padding-5">
                                <div class="row">
                                   <div class="col s7 m7">
                                     <p> 
                                        </p>
                                     <p> </p>
                                   </div>
                                   <div class="col s5 m5 right-align">
                                      <p>[Main]  </p>
                                      <p> [Zone] </p>
                                   </div>
                                </div>
                                <p class="pt-5">
                                    <a href="#" style="color: #fff;"> SMS Sent >  </a>
                                </p>
                                
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
