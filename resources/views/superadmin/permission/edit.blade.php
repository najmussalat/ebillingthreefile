
@extends('layouts.superadminMaster')

@section('content')
@section('title', "Edit Permission")
@include('partial.formerror')
                            <!-- Form Advance -->
                            <div class="col s12 m12 l12">
                               
                                <div id="Form-advance" class="card card card-default scrollspy">
                                    <div class="card-content">
                                        <h4 class="card-title">Permission Update Form</h4>
                                     
                                       
                                        {!! Form::model($diseases, array('url' =>['superadmin/updatepermission/'.$diseases->id], 'method'=>'PATCH','files'=>true)) !!}
                                 
                                            @include('superadmin.permission.form')
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Update
                                                            <i class="material-icons right">send</i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                     {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                           
                            </div>
@endsection