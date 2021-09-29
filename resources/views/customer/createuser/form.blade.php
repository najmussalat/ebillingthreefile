<div class="row">
        {!! Form::label('username', ' *New User  Name') !!}
        {!! Form::text('username', null, ['id' => 'username', 'required']) !!}
          {!! Form::label('email', ' * Email') !!}
        {!! Form::email('email', null, ['id' => 'email', 'required']) !!}
        {!! Form::label('Phone', ' * Phone') !!}
        {!! Form::number('phone', null, ['id' => 'Phone', 'required']) !!}
        {!! Form::label('Password', ' * Password') !!}
        {!! Form::password('password', null, ['id' => 'email', 'required']) !!}
        {!! Form::label('retypepassword', ' *Retype Password') !!}
        {!! Form::password('retypepassword', null, ['id' => 'retypepassword', 'required']) !!}
        {!! Form::label('roles', 'Roles *') !!}
        {!!FORM::select('roles[]', $roles, null, array('required','id'=>'roles', 'class'=>'select2 browser-default','multiple'=>true))!!}     
         {!! Form::label('status', 'Status *') !!}
        {!!FORM::select('status',['0'=>'In-Active','1'=>'Active'], 1, array('required','id'=>'roles', 'class'=>''))!!}   
      </div>
     
    