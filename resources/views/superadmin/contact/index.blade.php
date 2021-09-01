
@extends('layouts.superadminMaster')

@section('content')
@section('title', "Contact List")

{{-- vendor styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/flag-icon/css/flag-icon.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/quill/quill.snow.css')}}">
@endsection

{{-- page styles --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/app-sidebar.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/app-email.css')}}">
@endsection

{{-- page content --}}
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
            <li class="active"><a href="#!" class="text-sub"><i class="material-icons mr-2"> mail_outline </i> Inbox</a>
            </li>
            <li><a href="#!" class="text-sub"><i class="material-icons mr-2"> send </i> Sent</a></li>
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
<div class="app-email">
  <div class="content-area content-right">
    <div class="app-wrapper">
      <div class="app-search">
        <i class="material-icons mr-2 search-icon">search</i>
        <input type="text" placeholder="Search Mail" class="app-filter" id="email_filter">
      </div>
      <div class="card card card-default scrollspy border-radius-6 fixed-width">
        <div class="card-content p-0 pb-2">
          <div class="email-header">
            <div class="left-icons">
              <span class="header-checkbox">
                <label>
                  <input type="checkbox" onClick="toggle(this)" />
                  <span></span>
                </label>
              </span>
              <span class="action-icons">
                <i class="material-icons">refresh</i>
                <i class="material-icons">mail_outline</i>
                <i class="material-icons">label_outline</i>
                <i class="material-icons">folder_open</i>
                <i class="material-icons">info_outline</i>
                <i class="material-icons delete-mails">delete</i>
              </span>
            </div>
            <div class="list-content"></div>
            <div class="email-action">
              <span class="email-options"><i class="material-icons grey-text">more_vert</i></span>
            </div>
          </div>
          <div class="collection email-collection">
            @if(count($contactus)>0)
            @foreach ($contactus as $contact)
            
            <div class="email-brief-info collection-item animate fadeUp delay-1">
              <div class="list-left">
                <label>
                  <input type="checkbox" name="foo" />
                  <span></span>
                </label>
                <div class="favorite">
                  <i class="material-icons">star_border</i>
                </div>
                <div class="email-label">
                  <i class="material-icons">label_outline</i>
                </div>
              </div>
              <a class="list-content" href="{{url('superadmin/replymail/'.$contact->id) }}">
                <div class="list-title-area">
                  <div class="user-media">
                    <img src="{{asset('images/user/not-found.jpg')}}" alt="" class="circle z-depth-2 responsive-img avtar tooltipped" data-position="bottom"  data-tooltip="{{$contact->name}}">
                    <div class="list-title">{{$contact->subject}}</div>
                  </div>
                  
                </div>
                <div class="list-desc">{{$contact->message}}</div>
              </a>
              <div class="list-right">
                <div class="list-date">{{$contact->created_at->diffForHumans()}} </div>
              </div>
            </div>
            @endforeach
            @else
            <div class="no-data-found collection-item">
              <h6 class="center-align font-weight-500">No Results Found</h6>
            </div>
           @endif
            
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Content Area Ends -->

<!-- Add new email popup -->
<div style="bottom: 54px; right: 19px;" class="fixed-action-btn direction-top">
  <a class="btn-floating btn-large primary-text gradient-shadow compose-email-trigger" href="#">
    <i class="material-icons">add</i>
  </a>
</div>
<!-- Add new email popup Ends-->

<!-- email compose sidebar -->
<div class="email-compose-sidebar">
  <div class="card quill-wrapper">
    <div class="card-content pt-0">
      <div class="card-header display-flex pb-2">
        <h3 class="card-title">NEW MESSAGE</h3>
        <div class="close close-icon">
          <i class="material-icons">close</i>
        </div>
      </div>
      <div class="divider"></div>
      <!-- form start -->
      <form class="edit-email-item mt-10 mb-10">
        <div class="input-field">
          <input type="email" class="edit-email-item-title validate" id="edit-item-from" value="user@example.com"
            disabled>
          <label for="edit-item-from">From</label>
        </div>
        <div class="input-field">
          <input type="email" class="edit-email-item-date" id="edit-item-to">
          <label for="edit-item-to">To</label>
        </div>
        <div class="input-field">
          <input type="text" class="edit-email-item-date" id="edit-item-subject">
          <label for="edit-item-subject">Subject</label>
        </div>
        <div class="input-field">
          <input type="email" class="edit-email-item-date" id="edit-item-CC">
          <label for="edit-item-CC">CC</label>
        </div>
        <div class="input-field">
          <input type="email" class="edit-email-item-date" id="edit-item-BCC">
          <label for="edit-item-BCC">BCC</label>
        </div>
        <!-- Compose mail Quill editor -->
        <div class="input-field">
          <div class="snow-container mt-2">
            <div class="compose-editor"></div>
            <div class="compose-quill-toolbar">
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
        <div class="file-field input-field">
          <div class="btn btn-file">
            <span>Attach File</span>
            <input type="file">
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text">
          </div>
        </div>
      </form>
      <div class="card-action pl-0 pr-0 right-align">
        <button type="reset" class="btn-small waves-effect waves-light cancel-email-item mr-1">
          <i class="material-icons left">close</i>
          <span>Cancel</span>
        </button>
        <button class="btn-small waves-effect waves-light send-email-item">
          <i class="material-icons left">send</i>
          <span>Send</span>
        </button>
      </div>
      <!-- form start end-->
    </div>
  </div>
</div>
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
<script src="{{asset('app-assets/vendors/sortable/jquery-sortable-min.js')}}"></script>
<script src="{{asset('app-assets/vendors/quill/quill.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
<script src="{{asset('app-assets/js/scripts/app-email.js')}}"></script>
<script>
$(document).ready(function(){
  $('.tooltipped').tooltip();
  
});

</script>
@endsection