{{-- layout --}}
@extends('layouts.fullLayoutMaster')

{{-- page title --}}
@section('title','User Forgot Password')

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
    <form class="login-form" method="POST" action="{{ route('admin.password.request')}}">
      @csrf
   <input type="hidden" name="token" value="{{ $token }}">
      <div class="row">
        <div class="input-field col s12">
          <h5 class="ml-4">Verify Email</h5>
          <p class="ml-4">Please Type YOur Email Address</p>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">person_outline</i>
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
            value="{{ old('email') }}" required autocomplete="email" autofocus>
          <label for="email" class="center-align">Email</label>
          @error('email')
          <span class="red-text ml-10" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
          <div class="input-field col s12">
          <i class="material-icons prefix pt-2">lock_outline</i>
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"
            value="{{ old('password') }}" required autocomplete="password" autofocus>
          <label for="email" class="center-align">New Password</label>
          @error('password')
          <span class="red-text ml-10" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        
          <div class="input-field col s12">
          <i class="material-icons prefix pt-2">lock_outline</i>
          <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"
            value="{{ old('password_confirmation') }}" required autocomplete="password_confirmation" autofocus>
          <label for="email" class="center-align">Confirm Password</label>
          @error('password_confirmation')
          <span class="red-text ml-10" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        
      </div>
      <div class="row">
        <div class="input-field col s12">
          <button type="submit"
            class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12 mb-1">Reset
            Password</button>
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