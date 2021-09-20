@if($configData['mainLayoutType'] === 'vertical-modern-menu')
{{-- vertical-modern-menu breadcrumb --}}
<div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
  <!-- Search for small screen-->
  <div class="container">
    <div class="row">
      <div class="col s10 m6 l6">
       
        @if(isset($breadcrumbs))
        <ol class="breadcrumbs mb-0">
          @foreach ($breadcrumbs as $breadcrumb)
          <li class="breadcrumb-item {{ !isset($breadcrumb['link']) ? 'active' :''}}">
            @if(isset($breadcrumb['link']) && ($breadcrumb['link'] !== 'javascript:void(0)'))
            <a href="{{url($breadcrumb['link'])}}">@endif{{$breadcrumb['name']}}@if(isset($breadcrumb['link']))</a>
            @endif
          </li>
          @endforeach
        </ol>
        @endif
      </div>
      
    </div>
  </div>
</div>
@elseif($configData['mainLayoutType'] === 'vertical-menu-nav-dark')
{{-- vertical-menu-nav-dark breadcrumb --}}
<div class="breadcrumbs-inline pt-3 pb-1" id="breadcrumbs-wrapper">
  <!-- Search for small screen-->
  <div class="container">
    <div class="row">
      <div class="col s10 m6 l6 breadcrumbs-left">
      
        @if(isset($breadcrumbs))
        <ol class="breadcrumbs mb-0">
          @foreach ($breadcrumbs as $breadcrumb)
          <li class="breadcrumb-item {{ !isset($breadcrumb['link']) ? 'active' :''}}">
            @if(isset($breadcrumb['link']) && ($breadcrumb['link'] !== 'javascript:void(0)'))
            <a href="{{$breadcrumb['link']}}">@endif{{$breadcrumb['name']}}@if(isset($breadcrumb['link']))</a>
            @endif
          </li>
          @endforeach
        </ol>
        @endif
      </div>
     
    </div>
  </div>
</div>
@elseif($configData['mainLayoutType'] === 'vertical-gradient-menu')
{{-- vertical-gradient-menu breadcrumb --}}
<div class="pt-3 pb-1" id="breadcrumbs-wrapper">
  <!-- Search for small screen-->
  <div class="container">
    <div class="row">
    >
      <div class="col s12 m6 l6 right-align-md">
        @if(isset($breadcrumbs))
        <ol class="breadcrumbs mb-0">
          @foreach ($breadcrumbs as $breadcrumb)
          <li class="breadcrumb-item {{ !isset($breadcrumb['link']) ? 'active' :''}}">
            @if(isset($breadcrumb['link']) && ($breadcrumb['link'] !== 'javascript:void(0)'))
            <a href="{{$breadcrumb['link']}}">@endif{{$breadcrumb['name']}}@if(isset($breadcrumb['link']))</a>
            @endif
          </li>
          @endforeach
        </ol>
        @endif
      </div>
    </div>
  </div>
</div>

@elseif($configData['mainLayoutType'] === 'vertical-dark-menu')
{{-- vertical-dark-menu --}}
<div id="breadcrumbs-wrapper" data-image="{{asset('images/gallery/breadcrumb-bg.jpg')}}">
  <!-- Search for small screen-->
  <div class="container">
    <div class="row">
    
      <div class="col s12 m6 l6 right-align-md">
        @if(isset($breadcrumbs))
        <ol class="breadcrumbs mb-0">
          @foreach ($breadcrumbs as $breadcrumb)
          <li class="breadcrumb-item {{ !isset($breadcrumb['link']) ? 'active' :''}}">
            @if(isset($breadcrumb['link']) && $breadcrumb['link'] !== 'javascript:void(0)')
            <a href="{{url($breadcrumb['link'])}}">@endif{{$breadcrumb['name']}}@if(isset($breadcrumb['link']))</a>
            @endif
          </li>
          @endforeach
        </ol>
        @endif
      </div>
    </div>
  </div>
</div>
@elseif($configData['mainLayoutType'] === 'horizontal-menu')
{{-- horizontal-menu --}}
<div class="pt-1 pb-0" id="breadcrumbs-wrapper">
  <!-- Search for small screen-->
  <div class="container">
    <div class="row">
     
      <div class="col s12 m6 l6 right-align-md">
        @if(isset($breadcrumbs))
        <ol class="breadcrumbs mb-0">
          @foreach ($breadcrumbs as $breadcrumb)
          <li class="breadcrumb-item {{ !isset($breadcrumb['link']) ? 'active' :''}}">
            @if(isset($breadcrumb['link']) && ($breadcrumb['link'] !== 'javascript:void(0)'))
            <a href="{{url($breadcrumb['link'])}}">@endif{{$breadcrumb['name']}}@if(isset($breadcrumb['link']))</a>
            @endif
          </li>
          @endforeach
        </ol>
        @endif
      </div>
    </div>
  </div>
</div>
@endif