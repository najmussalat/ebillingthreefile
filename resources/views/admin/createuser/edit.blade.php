@extends('layouts.adminMaster')
@section('title', "Create New User")
{{-- @can('Package-Create') --}}
@section('content')
@include('partial.formerror')
                            <!-- Form Advance -->
                            <div class="col s12 m12 l12">
                               
                                <div id="Form-advance" class="card card card-default scrollspy">
                                    <div class="card-content">
                                                            
                                      {!!Form::model($user,array('method'=>'PATCH','url'=>['admin/updateuser/'.$user->id],'class'=>'user','id'=>'admin','files'=>true))!!}
                                      <div class="row">
                                        {!! Form::label('username', ' *New User  Name') !!}
                                        {!! Form::text('username', null, ['id' => 'username', 'required']) !!}
                                          {!! Form::label('email', ' * Email') !!}
                                        {!! Form::email('email', null, ['id' => 'email', 'required']) !!}
                                        {!! Form::label('Phone', ' * Phone') !!}
                                        {!! Form::number('phone', null, ['id' => 'Phone', 'required']) !!}
                                        {!! Form::label('Password', ' * Password') !!}
                                        {!! Form::password('password', null, ['id' => 'password', '']) !!}
                                        {!! Form::label('retypepassword', ' *Retype Password') !!}
                                        {!! Form::password('retypepassword', null, ['id' => 'retypepassword', '']) !!}
                                        {!! Form::label('roles', 'Roles *') !!}
                                        {!!FORM::select('roles[]', $roles, $userRole, array('required','id'=>'roles', 'class'=>'select2 browser-default','multiple'=>true))!!}     
                                         {{-- {!! Form::label('status', 'Status *') !!}
                                        {!!FORM::select('status',['0'=>'In-Active','1'=>'Active'], null, array('required','id'=>'roles', 'class'=>''))!!}    --}}
                                      </div>
                              
                                         
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
{{-- @endcan --}}
@endsection

