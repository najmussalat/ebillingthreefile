
@extends('layouts.superadminMaster')

@section('content')
@section('title', "Edit Admin")
@include('partial.formerror')
                            <!-- Form Advance -->
                            <div class="col s12 m12 l12">
                               
                                <div id="Form-advance" class="card card card-default scrollspy">
                                    <div class="card-content">
                                        <h4 class="card-title">Admin Update Form</h4>
                                        {!!Form::model($admin,array('method'=>'PUT','url'=>['superadmin/updateadmin',$admin->id],'class'=>'user','id'=>'admin','files'=>true))!!}
                                        <div class="row">
                                          <div class="input-field col m12 s12">
                                              {!!Form::text('name',null, array('id'=>'name','required'))!!}
                                              {!!Form::label('name',' *  Name ')!!}
                                              
                                          </div>
                                          <div class="input-field col m12 s12">
                                            {!!Form::text('username',null, array('id'=>'username','required'))!!}
                                            {!!Form::label('username',' * User Name ')!!}
                                            
                                        </div>
                                        <div class="input-field col m12 s12">
                                            {!!FORM::select('status', ['1' => 'Active', '2' => 'Inactive'], null, array('required','id'=>'status', 'class'=>'select2 browser-default'))!!}    
                                          </div>
                                          <div class="input-field col m12 s12">
                                              {!!Form::email('email',null, array('id'=>'email','required'))!!}
                                              {!!Form::label('email',' Email')!!}
                                              
                                          </div>
                                          <div class="input-field col m12 s12">
                                            {!!Form::number('phone',null, array('id'=>'phone','required'))!!}
                                            {!!Form::label('phone',' Phone *')!!}
                                            
                                        </div>
                                          <div class="input-field col m12 s12">
                                            {!!FORM::select('roles[]', $roles, $userRole, array('required','id'=>'roles', 'class'=>'select2 browser-default','multiple'=>true))!!}    
                                          </div>
                                        
                                       
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
                        </div>
                           
                            </div>
@endsection

@section('script')
<script> 
 $(document).ready(function() {
    $('input#input_text, textarea#description').characterCounter();
  })

  $(".card .Close").click(function () {
	
    $(this).closest(".card")
        .fadeOut("slow");
});


$(".card-alert .close").click(function () {

    $(this).closest(".card-alert")
        .fadeOut("slow");
});

  </script>
  @endsection