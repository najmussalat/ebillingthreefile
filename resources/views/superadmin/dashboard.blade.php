
@extends('layouts.superadminMaster')

@section('content')
@section('title', "Hello Superadmin")
{{--     
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
                         <p>Total Admin </p>
                      </div>
                      <div class="col s5 m5 right-align">
                         <h5 class="mb-0 white-text">{{$admin->where('status','=',2)->count('id')}}</h5>
                         <p class="no-margin">New</p>
                         <p>{{$admin->count('id')}}</p>
                      </div>
                   </div>
                </div>
             </div>
          </div>
          <div class="col s12 m6 l6 xl3">
             <div class="card gradient-45deg-red-pink gradient-shadow min-height-100 white-text animate fadeLeft">
                <div class="padding-4">
                   <div class="row">
                      <div class="col s7 m7">
                         <i class="material-icons background-round mt-5">filter_vintage</i>
                         <p>Total Blog</p>
                      </div>
                      <div class="col s5 m5 right-align">
                         <h5 class="mb-0 white-text">{{$blog->where('status','=',2)->count('id')}}</h5>
                         <p class="no-margin">New</p>
                         <p>{{$blog->count('id')}}</p>
                      </div>
                   </div>
                </div>
             </div>
          </div>
          <div class="col s12 m6 l6 xl3">
             <div class="card gradient-45deg-amber-amber gradient-shadow min-height-100 white-text animate fadeRight">
                <div class="padding-4">
                   <div class="row">
                      <div class="col s7 m7">
                         <i class="material-icons background-round mt-5">brightness_2</i>
                         <p>Total Medicine</p>
                      </div>
                      <div class="col s5 m5 right-align">
                         <h5 class="mb-0 white-text">{{$medicine->where('status','=',2)->count('id')}}</h5>
                         <p class="no-margin">Draft</p>
                         <p>{{$medicine->count('id')}}</p>
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
                         <p>Total Disease</p>
                      </div>
                      <div class="col s5 m5 right-align">
                         <h5 class="mb-0 white-text">{{$disease->where('status','=',2)->count('id')}}</h5>
                         <p class="no-margin">Draft</p>
                         <p>{{$disease->count('id')}}</p>
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
            <div class="card gradient-45deg-red-pink gradient-shadow min-height-100 white-text animate fadeLeft">
               <div class="padding-4">
                  <div class="row">
                     <div class="col s7 m7">
                        <i class="material-icons background-round mt-5">filter_vintage</i>
                        <p>Total De-Medi</p>
                     </div>
                     <div class="col s5 m5 right-align">
                        <h5 class="mb-0 white-text">{{$disemedicine->count('id')}}</h5>
                        <p class="no-margin">New</p>
                        <p>{{$disemedicine->count('id')}}</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col s12 m6 l6 xl3">
            <div class="card gradient-45deg-amber-amber gradient-shadow min-height-100 white-text animate fadeRight">
               <div class="padding-4">
                  <div class="row">
                     <div class="col s7 m7">
                        <i class="material-icons background-round mt-5">brightness_2</i>
                        <p> Medicine info</p>
                     </div>
                     <div class="col s5 m5 right-align">
                        <h5 class="mb-0 white-text">{{$medicineinformation->count('id')}}</h5>
                        <p class="no-margin">All</p>
                        <p>{{$medicineinformation->count('id')}}</p>
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
       <div class="col s12 m6 l6 xl3">
          <div class="card gradient-45deg-light-blue-cyan gradient-shadow min-height-100 white-text animate fadeLeft">
             <div class="padding-4">
                <div class="row">
                   <div class="col s7 m7">
                     <i class="material-icons background-round mt-5">perm_identity</i>
                      <p>Category </p>
                   </div>
                   <div class="col s5 m5 right-align">
                      <h5 class="mb-0 white-text">{{$category->count('id')}}</h5>
                      <p class="no-margin">New</p>
                      <p>{{$category->count('id')}}</p>
                   </div>
                </div>
             </div>
          </div>
       </div>
       <div class="col s12 m6 l6 xl3">
          <div class="card gradient-45deg-red-pink gradient-shadow min-height-100 white-text animate fadeLeft">
             <div class="padding-4">
                <div class="row">
                   <div class="col s7 m7">
                      <i class="material-icons background-round mt-5">filter_vintage</i>
                      <p>Total Blog</p>
                   </div>
                   <div class="col s5 m5 right-align">
                      <h5 class="mb-0 white-text">{{$blog->where('status','=',2)->count('id')}}</h5>
                      <p class="no-margin">New</p>
                      <p>{{$blog->count('id')}}</p>
                   </div>
                </div>
             </div>
          </div>
       </div>
       <div class="col s12 m6 l6 xl3">
          <div class="card gradient-45deg-amber-amber gradient-shadow min-height-100 white-text animate fadeRight">
             <div class="padding-4">
                <div class="row">
                   <div class="col s7 m7">
                      <i class="material-icons background-round mt-5">brightness_2</i>
                      <p>Total Medicine</p>
                   </div>
                   <div class="col s5 m5 right-align">
                      <h5 class="mb-0 white-text">{{$medicine->where('status','=',2)->count('id')}}</h5>
                      <p class="no-margin">Draft</p>
                      <p>{{$medicine->count('id')}}</p>
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
                      <p>Total Disease</p>
                   </div>
                   <div class="col s5 m5 right-align">
                      <h5 class="mb-0 white-text">{{$disease->where('status','=',2)->count('id')}}</h5>
                      <p class="no-margin">Draft</p>
                      <p>{{$disease->count('id')}}</p>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
    <!--end container-->
    <marquee>This is basic example of marquee</marquee>

   </div><!-- START RIGHT SIDEBAR NAV -->
    --}}
@endsection