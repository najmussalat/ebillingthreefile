{{-- layout --}}
@extends('layouts.fullLayoutMaster')

{{-- page title --}}
@section('title','Verify Phone')

{{-- page style --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/forgot.css')}}">
@endsection

{{-- page content --}}
@section('content')
<div id="forgot-password" class="row">
  <div class="col s12 m6 l4 z-depth-4 offset-m4 card-panel border-radius-6 forgot-card bg-opacity-8">
    {{-- success status --}}
    @if (session('status'))
    <div class="card-alert card green lighten-5">
      <div class="card-content green-text">
        <p>{{ session('status') }}</p>
      </div>
      <button type="button" class="close green-text" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
    @endif
    <form class="login-form" method="POST" action="{{url('admin/adminverifyphone') }}">
      @csrf

      <div class="row">
        <div class="input-field col s12">
          <h5 class="ml-4">Conform Code</h5>
          <p class="ml-4">You check your Phone at Message to get the code</p>
        </div>
         
      </div>
        <h6 >@if ($errors->has('status'))
                   
            <strong class="gradient-45deg-green-teal text-center">{{ $errors->first('status') }}</strong>
            @endif</h6>
      <div class="row">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">person_outline</i>
          <input  type="number"  name="code" class="form-control 
           required  autofocus value="{{ @Request::segment(4) }}>
          <label for="code" class="center-align">Code</label>
          <input type="hidden" name="phone" value="{{ Request::segment(3) }}">
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <button type="submit"
            class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12 mb-1">Verify </button>
        </div>
      </div>
      
    </form>
  </div>
</div>
@endsection


{{-- page script --}}
@section('page-script')
<script src="{{asset('js/scripts/ui-alerts.js')}}"></script>
@endsection