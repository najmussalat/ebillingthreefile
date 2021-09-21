
<div class="row">
    <div class="input-field col m6 s12">
        {!! Form::select('admin_id', $admins, null, ['id' => 'country_id', 'required', 'class' => '']) !!}
        {!! Form::label('admin_id', 'Admin Name *') !!}

    </div> 
      <div class="input-field col m6 s12">
        {!! Form::select('payment_id', $payment, null, ['id' => 'payment_id', 'required', 'class' => '']) !!}
        {!! Form::label('payment_id', 'Payment By *') !!}

    </div>

    

</div>

<div class="row">
    <div class="input-field col m4 s12">
        {!! Form::number('payamount', null, ['id' => 'payamount', 'required']) !!}
        {!! Form::label('payamount', ' * Amount') !!}

    </div>

    <div class="input-field col m4 s12">
        {!! Form::text('transections', null, ['id' => 'transections']) !!}
        {!! Form::label('transections', 'Transections') !!}

    </div>
    <div class="input-field col m4 s12">
        {!! Form::select('status',['0'=>'Pending','1'=>'Aproved'], null, ['id' => 'transections']) !!}
        {!! Form::label('transections', 'Transections') !!}

    </div>

</div>

<div class="row">
    <div class="input-field col m6 s12">
        {!! Form::text('note', null, ['id' => 'note']) !!}
        {!! Form::label('note', 'Note') !!}

    </div>
    <div class="input-field col m6 s12">
        {!! Form::text('phone', null, ['id' => 'phone']) !!}
        {!! Form::label('phone', 'Account /Transections Phone Number') !!}
    </div>

</div>
