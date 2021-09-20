@extends('layouts.admin')
@section('title', "Create New Admin")
@section('admin')
        
<div class="row">
    <div class="col s12">
      <div id="html-validations" class="card card-tabs">
        <div class="card-content">
          <div class="card-title">
            <div class="row">
              <div class="col s12 m6 l10">
                <h4 class="card-title">HTML Validation Example</h4>
              </div>
              <div class="col s12 m6 l2">
              </div>
            </div>
          </div>
          <div id="html-view-validations">
            <form class="formValidate0" id="formValidate0" method="get">
              <div class="row">
                <div class="input-field col s12">
                  <label for="uname0">Username*</label>
                  <input class="validate" required id="uname0" name="uname0" type="text">
                </div>
                <div class="input-field col s12">
                  <label for="cemail0">E-Mail *</label>
                  <input class="validate" required id="cemail0" type="email" name="cemail0">
                </div>
                <div class="input-field col s12">
                  <label for="password0">Password *</label>
                  <input class="validate" required id="password0" type="password" name="password0">
                </div>
                <div class="input-field col s12">
                  <label for="cpassword0">Confirm Password *</label>
                  <input class="validate" required id="cpassword0" type="password" name="cpassword0">
                </div>
                <div class="input-field col s12">
                  <label for="curl0">URL *</label>
                  <input class="validate" required id="curl0" type="url" name="curl0">
                </div>
                <div class="col s12">
                  <label for="role">Role</label>
                  <select class="error validate" id="role" name="role" required>
                    <option value="" disabled selected>Choose your profile</option>
                    <option value="1">Manager</option>
                    <option value="2">Developer</option>
                    <option value="3">Business</option>
                  </select>
                  <div class="input-field">
                  </div>
                </div>
                <div class="input-field col s12">
                  <textarea id="ccomment0" name="ccomment0" class="materialize-textarea validate" required></textarea>
                  <label for="ccomment0">Your comment *</label>
                </div>
                <div class="col s12">
                  <p>Gender</p>
                  <p>
                    <label>
                      <input class="validate" required name="gender0" type="radio" checked />
                      <span>Male</span>
                    </label>
                  </p>

                  <label>
                    <input class="validate" required name="gender0" type="radio" />
                    <span>Female</span>
                  </label>
                  <div class="input-field">
                  </div>
                </div>
                <div class="col s12">
                  <label for="tnc_select1">T&C *</label>
                  <p>
                    <label>
                      <input class="validate" required id="tnc_select1" type="checkbox" />
                      <span>Please agree to our policies</span>
                    </label>
                  </p>
                  <div class="input-field">
                  </div>
                </div>
                <div class="input-field col s12">
                  <button class="btn waves-effect waves-light right" type="submit" name="action">Submit
                    <i class="material-icons right">send</i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card o-hidden border-0 shadow-lg my-5">
    <a  class=" btn  btn-success rounde" href="{{url('admin/admin')}}">View Users </a>
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      
      <div class="row">
        {{-- <div class="col-lg-5 d-none d-lg-block"></div> --}}
        <div class="col-lg-7">
          <div class="p-5">
            <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4">Add Admin Account!</h1>
               <h3 class=" text-warning">@include('partial.formerror')</h3>
              </div>

   
           {!!Form::open(array('route'=>'admin.store','class'=>'user','id'=>'admin','files'=>true))!!}
            @include('admin.createadmin.form')
             
              {!!Form::submit('Register',array('class'=>'btn btn-primary btn-user btn-block'))!!}
             
            
            
          </div>
        </div>
      </div>
    </div>
  </div>
  {!!Form::close()!!}
                                        
@endsection

