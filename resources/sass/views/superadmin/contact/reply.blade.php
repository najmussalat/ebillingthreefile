{{-- layout extend --}}
@extends('layouts.superadminMaster')

{{-- page title --}}
@section('title','Reply Email')

{{-- vendor styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/flag-icon/css/flag-icon.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/quill/quill.snow.css')}}">
@endsection

{{-- page styles --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/app-sidebar.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/app-email-content.css')}}">
@endsection

{{-- main page content --}}
@section('content')
<!-- Sidebar Area Starts -->
<div class="email-overlay"></div>
<div class="sidebar-left sidebar-fixed">
  <div class="sidebar">
    <div class="sidebar-content">
      <div class="sidebar-header">
        <div class="sidebar-details">
          <h5 class="m-0 sidebar-title"><i class="material-icons app-header-icon text-top">mail_outline</i> Mailbox</h5>
          <div class="row valign-wrapper mt-10 pt-2 animate fadeLeft">
            <div class="col s3 media-image">
              <img src="{{asset('images/user/2.jpg')}}" alt="" class="circle z-depth-2 responsive-img">
              <!-- notice the "circle" class -->
            </div>
            <div class="col s9">
              <p class="m-0 subtitle font-weight-700">Lawrence Collins</p>
              <p class="m-0 text-muted">lawrence.collins@xyz.com</p>
            </div>
          </div>
        </div>
      </div>
      <div id="sidebar-list" class="sidebar-menu list-group position-relative animate fadeLeft">
        <div class="sidebar-list-padding app-sidebar sidenav" id="email-sidenav">
          <ul class="email-list display-grid">
            <li class="sidebar-title">Folders</li>
            <li ><a href="#!" class="text-sub"><i class="material-icons mr-2"> mail_outline </i> Inbox</a>
            </li>
            <li class="active"><a href="#!" class="text-sub"><i class="material-icons mr-2"> send </i> Sent</a></li>
            <li><a href="#!" class="text-sub"><i class="material-icons mr-2"> description </i> Draft</a></li>
            <li><a href="#!" class="text-sub"><i class="material-icons mr-2"> info_outline </i> Span</a></li>
            <li><a href="#!" class="text-sub"><i class="material-icons mr-2"> delete </i> Trash</a></li>
            <li class="sidebar-title">Filters</li>
            <li><a href="#!" class="text-sub"><i class="material-icons mr-2"> star_border </i> Starred</a></li>
            <li><a href="#!" class="text-sub"><i class="material-icons mr-2"> label_outline </i> Important</a></li>
            <li class="sidebar-title">Labels</li>
            <li><a href="#!" class="text-sub"><i class="purple-text material-icons small-icons mr-2">
                  fiber_manual_record </i> Note</a></li>
            <li><a href="#!" class="text-sub"><i class="amber-text material-icons small-icons mr-2">
                  fiber_manual_record </i> Paypal</a></li>
            <li><a href="#!" class="text-sub"><i class="light-green-text material-icons small-icons mr-2">
                  fiber_manual_record </i> Invoice</a></li>
          </ul>
        </div>
      </div>
      <a href="#" data-target="email-sidenav" class="sidenav-trigger hide-on-large-only"><i
          class="material-icons">menu</i></a>
    </div>
  </div>
</div>
<!-- Sidebar Area Ends -->
<!-- Content Area Starts -->
<div class="app-email-content">
  <div class="content-area content-right">
    <div class="app-wrapper">
      @include('partial.formerror')
      <div class="card card-default scrollspy border-radius-6 fixed-width">
        <div class="card-content pt-0">
          <div class="row">
            <div class="col s12">
              <!-- Email Header -->
              <div class="email-header">
                <div class="subject">
                  <div class="back-to-mails">
                    <a href="{{url('superadmin/emaillist')}}"><i class="material-icons">arrow_back</i></a>
                  </div>
                  <div class="email-title">{{@$contactinfo->subject}}</div>
                </div>
                <div class="header-action">
                 
                  <div class="favorite">
                    <i class="material-icons">star_border</i>
                  </div>
                  <div class="email-label">
                    <i class="material-icons">label_outline</i>
                  </div>
                </div>
              </div>
              <!-- Email Header Ends -->
              <hr>
              <!-- Email Content -->
              <div class="email-content">
                <div class="list-title-area">
                  <div class="user-media">
                    <img src="{{asset('images/user/9.jpg')}}" alt="" class="circle z-depth-2 responsive-img avtar">
                    <div class="list-title">
                      <span class="name">{{@$contactinfo->name}}</span>
                      <span class="to-person">to me</span>
                    </div>
                  </div>
                  <div class="title-right">
                    <span class="mail-time">{{@$contactinfo->created_at}}</span>
                    <i class="material-icons">reply</i>
                    <i class="material-icons">more_vert</i>
                  </div>
                </div>
                <div class="email-desc">
				{{@$contactinfo->message}}
                </div>
              </div>
              <!-- Email Content Ends -->
              <hr>
              <!-- Email Footer -->
              
            
                <div class="forward-box d-none">
                  <hr>
                  {!! Form::open(array('url' => 'superadmin/replyemail','method'=>'POST','id'=>'Emailform','files'=>true )) !!}
                  <input type="hidden" name="id" value="{{$contactinfo->id}}">
                    <div class="input-field col s12">
                      <i class="material-icons prefix"> person_outline </i>
                      <input id="email" type="email" name="email" class="validate" value="{{@$contactinfo->email}}">
                      <label for="email">To</label>
                    </div>
                    <div class="input-field col s12">
                      <i class="material-icons prefix"> title </i>
                      <input id="subject" required type="text" name="subject" class="validate"  value="{{@$contactinfo->subject}}">
                      <label for="subject">Subject</label>
                    </div>
                    <div class="input-field col s12">
                      <div class="snow-container mt-2">
                        <div class="forward-email"></div>
                        <div class="forward-email-toolbar">
                          <span class="ql-formats mr-0">
                            <button class="ql-bold"></button>
                            <button class="ql-italic"></button>
                            <button class="ql-underline"></button>
                            <button class="ql-link"></button>
                            <button class="ql-image"></button>
                          </span>
                        </div>
                      </div>
                    </div>
                    <div class="input-field col s12">
                      <button type="submit" class="btn forward-btn right">Send</button>
                    </div>
                {!! Form::close() !!}
                </div>
              </div>
              <!-- Email Footer Ends -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Content Area Ends -->
@endsection
{{-- vendor scripts --}}
@section('vendor-script')
<script src="{{asset('app-assets/vendors/sortable/jquery-sortable-min.js')}}"></script>
<script src="{{asset('app-assets/vendors/quill/quill.min.js')}}"></script>
@endsection
{{-- page scripts --}}
@section('page-script')
<script src="{{asset('app-assets/js/scripts/app-email-content.js')}}"></script>
<script>$("#Emailform").on("submit", function () {
  var hvalue = $('.ql-editor').html();
  $(this).append("<textarea name='reply'  style='display:none'>"+hvalue+"</textarea>");
 });</script>
@endsection