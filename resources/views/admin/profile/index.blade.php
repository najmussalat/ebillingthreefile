@extends('layouts.adminMaster')

@section('content')
@section('title', "Profile")
 
{{-- vendor styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/select2/select2-materialize.css')}}">
@endsection

{{-- page style --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/page-users.css')}}">
@endsection

{{-- page content --}}
@section('content')

<!-- users edit start -->
<div class="section users-edit">
  <div class="card">
    <div class="card-content">
      <!-- <div class="card-body"> -->
      <ul class="tabs mb-2 row">
        <li class="tab">
          <a class="display-flex align-items-center active" id="account-tab" href="#account">
            <i class="material-icons mr-1">person_outline</i><span>Account</span>
          </a>
        </li>
        <li class="tab">
          <a class="display-flex align-items-center" id="information-tab" href="#information">
            <i class="material-icons mr-2">error_outline</i><span>Password</span>
          </a>
        </li>
      </ul>
      <div class="divider mb-3"></div>
      <div class="row">
        <div class="col s12" id="account">
          <!-- users edit media object start -->
          <div class="media display-flex align-items-center mb-2">
            <a class="mr-2" href="#">
              <img src="{{@asset('storage/app/files/shares/profileimage/'.Auth::user()->image)}}" alt="users avatar" class="z-depth-4 circle"
                height="64" width="64">
            </a>
            <div class="media-body">
              <h5 class="media-heading mt-0">{{Auth::user()->name}}</h5>
              <div class="user-edit-btns display-flex">
                <a href="#Profilephoto" class="btn-small indigo modal-trigger">Change</a>
              
              </div>
            </div>
          </div>
      
          <!-- Modal Structure -->
          <div id="Profilephoto" class="modal modal-fixed-footer">
            <div class="modal-content">
              <h4>Change  Photo</h4>
              <p>Upload  Photo</p>

              {!! Form::open(array('url' => 'admin/updateprofilephoto','method'=>'POST','id'=>'theform','files'=>true )) !!}
              <div class="col  s12 file-field input-field">
                <div class="btn float-right">
                    <span>Photo</span>
                    {!!Form::file('photo', ['accept'=>".jpg,.jpeg,.png"])!!}
                   
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
              <div class="row">
                <div class="input-field col s12">
                    <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Update
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
       
 {!! Form::close() !!}
            </div>
            <div class="modal-footer">
              <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Close</a>
            </div>
          </div>
          <!-- users edit media object ends -->
          @include('partial.formerror')
          <!-- users edit account form start -->
          {!! Form::model($admininfoid, array('url' =>['admin/updateprofileinfo/'.$admininfoid->id], 'method'=>'PATCH','id'=>'accountForm','files'=>true)) !!}
         
            <div class="row">
              <div class="col s12 m6">
                <div class="row">
                  <div class="input-field col s12">
                    <i class="material-icons prefix pt-2">mail_outline</i>
                    <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email"
                      value="{{ $admininfoid->email }}" required autocomplete="email" disabled>
                    <label for="email">Email</label>
                    @error('email')
                    <small class="red-text ml-10" role="alert">
                      {{ $message }}
                    </small>
                    @enderror
                  </div>
                    <div class="input-field col s12">
                      <i class="material-icons prefix pt-2">accessibility</i>
                      <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name"  value="{{$admininfoid->name }}"
                        required autocomplete="caddress" autofocus>
                      <label for="name" class="center-align"> Name *</label>
                      @error('name')
                      <small class="red-text ml-10" role="alert">
                        {{ $message }}
                      </small>
                      @enderror
                    </div>
                 
                     <div class="input-field col s12">
                      <i class="material-icons prefix pt-2">branding_watermark</i>
                      <input id="company" type="text" class="@error('company') is-invalid @enderror" name="company"  value="{{$admininfoid->company}}"
                        required autocomplete="company" autofocus>
                      <label for="company" class="center-align"> Company  *</label>
                      @error('company')
                      <small class="red-text ml-10" role="alert">
                        {{ $message }}
                      </small>
                      @enderror
                    </div>
                    <div class="input-field col s12">
                      <i class="material-icons prefix pt-2">web</i>
                      <input id="web" type="text" class="@error('name') is-invalid @enderror" name="web"  value="{{$admininfoid->web }}"
                        required autocomplete="web" autofocus>
                      <label for="web" class="center-align"> Web *</label>
                      @error('web')
                      <small class="red-text ml-10" role="alert">
                        {{ $message }}
                      </small>
                      @enderror
                    </div>             
               
                </div>
              </div>
              <div class="col s12 m6">
                <div class="row">
                  <div class="input-field col s12">
                    <i class="material-icons prefix pt-2">phone</i>
                    <input id="phone" type="text" class="@error('phone') is-invalid @enderror" name="phone"  value="{{$admininfoid->phone }}"
                      required autocomplete="phone" autofocus>
                    <label for="mobile_no" class="center-align">Phone Number *</label>
                    @error('phone')
                    <small class="red-text ml-10" role="alert">
                      {{ $message }}
                    </small>
                    @enderror
                  </div>
                 
                      <div class="input-field col s12">
                      <i class="material-icons prefix pt-2">places</i>
                      <input id="address" type="text" class="@error('address') is-invalid @enderror" name="address"  value="{{$admininfoid->address }}"
                        required autocomplete="address" autofocus>
                      <label for="address" class="center-align"> Address *</label>
                      @error('address')
                      <small class="red-text ml-10" role="alert">
                        {{ $message }}
                      </small>
                      @enderror
                    </div>
                  
                
                  <div class="row margin">
                    <div class="input-field col s12">
                      <i class="material-icons prefix pt-2">flag</i>
                     {{-- {{dd(\App\Helpers\CommonFx::Country())  }} --}}
            {!!Form::select('country',\App\Helpers\CommonFx::Country(),$admininfoid->country) !!}
                      <label for="password-confirm">Country</label>
                    </div>
                  </div>
                   <div class="row margin">
                    <div class="input-field col s12">    
                    
             
      </div>
      
                  </div>
              <div class="col s12 display-flex justify-content-end mt-3">
                <button type="submit" class="btn indigo">
                  Update Info</button>
                
              </div>
            </div>
        {!! Form::close() !!}
          <!-- users edit account form ends -->
        </div>
        </div>
        </div>
        <div class="col s12" id="information">
          <!-- users edit Info form start -->
          {!! Form::open(array('url' => 'admin/updatepassword','method'=>'POST','id'=>'infotabForm')) !!}
         
            <div class="row margin">
              <div class="input-field col s12">
                <i class="material-icons prefix pt-2">lock_outline</i>
                <input id="oldpassword" type="password" class="@error('oldpassword') is-invalid @enderror" name="oldpassword" required
                  autocomplete="oldpassword">
                <label for="oldpassword">Old Password</label>
                @error('oldpassword')
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
                  autocomplete="password">
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
                <input id="confirm" type="password" class="@error('confirm') is-invalid @enderror" name="confirm" required
                  autocomplete="confirm">
                <label for="confirm">Confirm Password</label>
                @error('confirm')
                <small class="red-text ml-10" role="alert">
                  {{ $message }}
                </small>
                @enderror
              </div>
            </div>
            
            <div class="row">
              <div class="input-field col s12">
                <button type="submit"
                  class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Update Password</button>
              </div>
            </div>
            {!! Form::close() !!}
          <!-- users edit Info form ends -->
        </div>
      </div>
      <!-- </div> -->
    </div>
  </div>
</div>
<!-- users edit ends -->
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
<script src="{{asset('app-assets/vendors/select2/select2.full.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/jquery-validation/jquery.validate.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
<script src="{{asset('app-assets/js/scripts/page-users.js')}}"></script>
@endsection