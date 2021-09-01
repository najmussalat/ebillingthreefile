{{-- layout --}}
@extends('layouts.fullLayoutMaster')

{{-- page title --}}
@section('title','Register')

{{-- page style --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/register.css')}}">
@endsection

{{-- page content --}}
@section('content')
<div id="register-page" class="row">
  <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 register-card bg-opacity-8">
    <form class="login-form" method="POST" action="{{ url("/register/$url") }}">
      @csrf

      <div class="row">
        <div class="input-field col s12">
          <h4 class="ml-4">Company Registration</h4>
          
        </div>
      </div>
      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">location_city</i>
          <input id="company" type="text" class="@error('company') is-invalid @enderror" name="company" value="{{ old('company') }}"
            required autocomplete="company" autofocus>
          <label for="company" class="center-align">Company Name *</label>
          @error('company')
          <small class="red-text ml-10" role="alert">
            {{ $message }}
          </small>
          @enderror
        </div>
      </div>
      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">location_on</i>
          <input id="address" type="text" class="@error('address') is-invalid @enderror" name="address" value="{{ old('address') }}"
            required autocomplete="address" autofocus>
          <label for="address" class="center-align">Company Address *</label>
          @error('address')
          <small class="red-text ml-10" role="alert">
            {{ $message }}
          </small>
          @enderror
        </div>
      </div>
      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">accessibility</i>
          <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"
            required autocomplete="caddress" autofocus>
          <label for="name" class="center-align">Owner Name *</label>
          @error('name')
          <small class="red-text ml-10" role="alert">
            {{ $message }}
          </small>
          @enderror
        </div>
      </div>
      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">perm_phone_msg</i>
          <input id="phone" type="number" class="@error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}"
            required autocomplete="phone" autofocus>
          <label for="phone" class="center-align">Phone</label>
          @error('phone')
          <small class="red-text ml-10" role="alert">
            {{ $message }}
          </small>
          @enderror
        </div>
      </div>
      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">mail_outline</i>
          <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email"
            value="{{ old('email') }}" required autocomplete="email">
          <label for="email">Email</label>
          @error('email')
          <small class="red-text ml-10" role="alert">
            {{ $message }}
          </small>
          @enderror
        </div>
      </div>
      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">lock_outline</i>
          <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required
            autocomplete="new-password">
          <label for="password">Password</label>
          @error('password')
          <small class="red-text ml-10" role="alert">
            {{ $message }}
          </small>
          @enderror
        </div>
      </div>
      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">lock_outline</i>
          <input id="password-confirm" type="password" name="password_confirmation" required
            autocomplete="new-password">
          <label for="password-confirm">Password again</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <button type="submit"
            class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Register</button>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <p class="margin medium-small"><a href="{{ url('login/admin')}}">Already have an account? Login</a></p>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection