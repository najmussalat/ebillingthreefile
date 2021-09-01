
@extends('layouts.superadminMaster')

@section('content')
@section('title', "Command List")
    
<div class="section">
    <!--card stats start-->
    <div id="card-stats" class="pt-0">
       <div class="row">
          <div class="col s12 m6 l6 xl3">
             <div class="card gradient-45deg-light-blue-cyan gradient-shadow min-height-100 white-text animate fadeLeft">
                <div class="padding-4">
                   <a href="{{url('superadmin/cacheclear')}}" class="active">
                   <div class="row">
                      <div class="col s7 m7">
                        <i class="material-icons background-round mt-5">filter_vintage</i>
                         <p>All Cache  </p>
                      </div>
                      <div class="col s5 m5 right-align">
                         <!-- <h5 class="mb-0 white-text"></h5> -->
                         <p class="no-margin">Clear </p>
                         <!-- <p></p> -->
                      </div>
                   </div>
                  </a>
                </div>
             </div>
          </div>
          <div class="col s12 m6 l6 xl3">
            <div class="card gradient-45deg-red-pink gradient-shadow min-height-100 white-text animate fadeLeft">
               <div class="padding-4">
                  <a href="{{url('superadmin/cache')}}" class="text-white">
                  <div class="row">
                     <div class="col s7 m7">
                       <i class="material-icons background-round mt-5">filter_vintage</i>
                        <p> Cache All </p>
                     </div>
                     <div class="col s5 m5 right-align">
                        <!-- <h5 class="mb-0 white-text"></h5> -->
                        <p class="no-margin">Cache </p>
                        <!-- <p></p> -->
                     </div>
                  </div>
                 </a>
               </div>
            </div>
         </div>
         <div class="col s12 m6 l6 xl3">
            <div class="card gradient-45deg-amber-amber gradient-shadow min-height-100 white-text animate fadeRight">
               <div class="padding-4">
                  <a href="{{url('superadmin/databckup')}}" class="text-white">
                  <div class="row">
                     <div class="col s7 m7">
                       <i class="material-icons background-round mt-5">filter_vintage</i>
                        <p>Data Backup </p>
                     </div>
                     <div class="col s5 m5 right-align">
                        <!-- <h5 class="mb-0 white-text"></h5> -->
                        <p class="no-margin">Backup </p>
                        <!-- <p></p> -->
                     </div>
                  </div>
                 </a>
               </div>
            </div>
         </div>
         <div class="col s12 m6 l6 xl3">
            <div class="card gradient-45deg-green-teal gradient-shadow min-height-100 white-text animate fadeRight">
               <div class="padding-4">
                  <a href="{{url('superadmin/databasecacheclear')}}" class="text-white">
                  <div class="row">
                     <div class="col s7 m7">
                       <i class="material-icons background-round mt-5">filter_vintage</i>
                        <p>Database Cache </p>
                     </div>
                     <div class="col s5 m5 right-align">
                        <!-- <h5 class="mb-0 white-text"></h5> -->
                        <p class="no-margin">Clear </p>
                        <!-- <p></p> -->
                     </div>
                  </div>
                 </a>
               </div>
            </div>
         </div>
       </div>
       <div class="row">
         <div class="col s12 m6 l6 xl3">
            <div class="card gradient-45deg-light-blue-cyan gradient-shadow min-height-100 white-text animate fadeLeft">
               <div class="padding-4">
                  <a href="{{url('superadmin/migratedata')}}" class="active">
                  <div class="row">
                     <div class="col s7 m7">
                       <i class="material-icons background-round mt-5">filter_vintage</i>
                        <p>Migration </p>
                     </div>
                     <div class="col s5 m5 right-align">
                        <!-- <h5 class="mb-0 white-text"></h5> -->
                        <p class="no-margin">Run </p>
                        <!-- <p></p> -->
                     </div>
                  </div>
                 </a>
               </div>
            </div>
         </div>
         <div class="col s12 m6 l6 xl3">
           <div class="card gradient-45deg-red-pink gradient-shadow min-height-100 white-text animate fadeLeft">
              <div class="padding-4">
                 <a href="{{url('superadmin/routerclear')}}" class="text-white">
                 <div class="row">
                    <div class="col s7 m7">
                      <i class="material-icons background-round mt-5">filter_vintage</i>
                       <p>All Route  </p>
                    </div>
                    <div class="col s5 m5 right-align">
                       <!-- <h5 class="mb-0 white-text"></h5> -->
                       <p class="no-margin">Clear </p>
                       <!-- <p></p> -->
                    </div>
                 </div>
                </a>
              </div>
           </div>
        </div>
        <div class="col s12 m6 l6 xl3">
           <div class="card gradient-45deg-amber-amber gradient-shadow min-height-100 white-text animate fadeRight">
              <div class="padding-4">
                 <a href="{{url('superadmin/telescopeclear')}}" class="text-white">
                 <div class="row">
                    <div class="col s7 m7">
                      <i class="material-icons background-round mt-5">filter_vintage</i>
                       <p>Sitemonitor </p>
                    </div>
                    <div class="col s5 m5 right-align">
                       <!-- <h5 class="mb-0 white-text"></h5> -->
                       <p class="no-margin">Clear </p>
                       <!-- <p></p> -->
                    </div>
                 </div>
                </a>
              </div>
           </div>
        </div>
        <div class="col s12 m6 l6 xl3">
           <div class="card gradient-45deg-green-teal gradient-shadow min-height-100 white-text animate fadeRight">
              <div class="padding-4">
                 <a href="{{url('superadmin/allsitemap')}}" class="text-white">
                 <div class="row">
                    <div class="col s7 m7">
                      <i class="material-icons background-round mt-5">filter_vintage</i>
                       <p>Site Map </p>
                    </div>
                    <div class="col s5 m5 right-align">
                       <!-- <h5 class="mb-0 white-text"></h5> -->
                       <p class="no-margin">Generate </p>
                       <!-- <p></p> -->
                    </div>
                 </div>
                </a>
              </div>
           </div>
        </div>
      </div>
      <div class="row">   
         <div class="col s12 m6 l6 xl3">
            <div class="card gradient-45deg-light-blue-cyan gradient-shadow min-height-100 white-text animate fadeLeft">
               <div class="padding-4">
                  <a href="{{url('superadmin/eventclear')}}" class="active">
                  <div class="row">
                     <div class="col s7 m7">
                       <i class="material-icons background-round mt-5">filter_vintage</i>
                        <p>Event </p>
                     </div>
                     <div class="col s5 m5 right-align">
                        <!-- <h5 class="mb-0 white-text"></h5> -->
                        <p class="no-margin">Clear </p>
                        <!-- <p></p> -->
                     </div>
                  </div>
                 </a>
               </div>
            </div>
         </div>
         <div class="col s12 m6 l6 xl3">
           <div class="card gradient-45deg-red-pink gradient-shadow min-height-100 white-text animate fadeLeft">
              <div class="padding-4">
                 <a href="{{url('superadmin/queuework')}}" class="text-white">
                 <div class="row">
                    <div class="col s7 m7">
                      <i class="material-icons background-round mt-5">filter_vintage</i>
                       <p>Queue Run</p>
                    </div>
                    <div class="col s5 m5 right-align">
                       <!-- <h5 class="mb-0 white-text"></h5> -->
                       <p class="no-margin">start </p>
                       <!-- <p></p> -->
                    </div>
                 </div>
                </a>
              </div>
           </div>
        </div>
        <div class="col s12 m6 l6 xl3">
           <div class="card gradient-45deg-amber-amber gradient-shadow min-height-100 white-text animate fadeRight">
              <div class="padding-4">
                 <a href="{{url('superadmin/configclear')}}" class="text-white">
                 <div class="row">
                    <div class="col s7 m7">
                      <i class="material-icons background-round mt-5">filter_vintage</i>
                       <p>All Config </p>
                    </div>
                    <div class="col s5 m5 right-align">
                       <!-- <h5 class="mb-0 white-text"></h5> -->
                       <p class="no-margin">Clear  </p>
                       <!-- <p></p> -->
                    </div>
                 </div>
                </a>
              </div>
           </div>
        </div>
        <div class="col s12 m6 l6 xl3">
           <div class="card gradient-45deg-green-teal gradient-shadow min-height-100 white-text animate fadeRight">
              <div class="padding-4">
                 <a href="{{url('superadmin/dbseeder')}}" class="text-white">
                 <div class="row">
                    <div class="col s7 m7">
                      <i class="material-icons background-round mt-5">filter_vintage</i>
                       <p>Seeder </p>
                    </div>
                    <div class="col s5 m5 right-align">
                       <!-- <h5 class="mb-0 white-text"></h5> -->
                       <p class="no-margin">Command </p>
                       <!-- <p></p> -->
                    </div>
                 </div>
                </a>
              </div>
           </div>
        </div>
      </div>
    </div>
    <!--card stats end-->
 
 
    <!--end container-->


   </div><!-- START RIGHT SIDEBAR NAV -->
  
@endsection