
<div class="row">

      <div class="input-field col m6 s12">
        {!! Form::select('payment_id', $payment, null, ['id' => 'payment_id', 'required', 'placeholder' => 'Select Payment']) !!}
        {!! Form::label('payment_id', 'Payment By *') !!}

    </div>

    <div class="input-field col m6 s12">
      <h5 id="showtransectionmessage">Sent Amount System</h5>

    </div> 

</div>

<div class="row">
    <div class="input-field col m6 s12">
        {!! Form::number('payamount', null, ['id' => 'payamount', 'required']) !!}
        {!! Form::label('payamount', ' * Amount') !!}

    </div>

    <div class="input-field col m6 s12">
        {!! Form::text('transections', null, ['id' => 'transections']) !!}
        {!! Form::label('transections', 'Transections Id') !!}

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
