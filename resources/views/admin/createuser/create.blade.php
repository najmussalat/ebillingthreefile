@extends('layouts.adminMaster')
@section('title', "Create New User")
{{-- @can('Package-Create') --}}
@section('content')
@include('partial.formerror')
                            <!-- Form Advance -->
                            <div class="col s12 m12 l12">
                               
                                <div id="Form-advance" class="card card card-default scrollspy">
                                    <div class="card-content">
                                                                       
                                  
       {!!Form::open(array('url'=>'admin/createuser','class'=>'user','id'=>'admin','files'=>true))!!}
       @include('admin.createuser.form')
                                    
                                         
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit
                                                            <i class="material-icons right">send</i>
                                                        </button>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                     {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
{{-- @endcan --}}
@endsection

