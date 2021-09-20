<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

 <style>
.preloader {
position: absolute;
top: 0;
left: 0;
width: 100%;
height: 100%;
z-index: 9999;
background-image: url('{{asset('/den/storage/app/files/shares/backend/preloader.gif')}}');
background-repeat: no-repeat; 
background-color: #FFF;
background-position: center;
}
 </style>

<body
  class="{{$configData['mainLayoutTypeClass']}} @if(!empty($configData['bodyCustomClass']) && isset($configData['bodyCustomClass'])) {{$configData['bodyCustomClass']}} @endif @if($configData['isMenuCollapsed'] && isset($configData['isMenuCollapsed'])){{'menu-collapse'}} @endif"
  data-open="click" data-menu="vertical-modern-menu" data-col="2-columns">

  <!-- BEGIN: Header-->
  <header class="page-topbar" id="header">
    @include('panels.superadminnavbar')
  </header>
  <!-- END: Header-->

  <!-- BEGIN: SideNav-->
  @include('panels.superadminsidebar')
  <!-- END: SideNav-->

  <!-- BEGIN: Page Main-->
  <div id="main">
    <div class="row">
      @if ($configData["navbarLarge"] === true)
      @if(($configData["mainLayoutType"]) === 'vertical-modern-menu')
      {{-- navabar large  --}}
      <div
        class="content-wrapper-before @if(!empty($configData['navbarBgColor'])) {{$configData['navbarBgColor']}} @else {{$configData["navbarLargeColor"]}} @endif">
      </div>
      @else
      {{-- navabar large  --}}
      <div class="content-wrapper-before {{$configData["navbarLargeColor"]}}">
      </div>
      @endif
      @endif


      @if($configData["pageHeader"] === true && isset($breadcrumbs))
      {{--  breadcrumb --}}
      @include('panels.breadcrumb')
      @endif
      <div class="col s12">
        <div class="container">
          <!-- END RIGHT SIDEBAR NAV -->
  {!! @Toastr::render() !!}  <!-- toastr   Notification -->
          {{-- main page content --}}
          @yield('content')

          {{-- right sidebar --}}
          @include('pages.sidebar.customizer')
        </div>
        {{-- overlay --}}
        <div class="content-overlay"></div>
      </div>
    </div>
  </div>
  <!-- END: Page Main-->


  {{-- footer  --}}
  @include('panels.footer')
  {{-- vendor and page scripts --}}
  @include('panels.scripts')
</body>