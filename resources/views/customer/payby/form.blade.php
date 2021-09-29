<div class="row">
    <div class="input-field col m12 s12">
        {!!Form::text('paybyname',null, array('id'=>'paybyname','required','placeholder'=>'Bikas/Nagad/Other'))!!}
        {!!Form::label('paybyname',' Payment Method * ')!!}
        
    </div>
    
    
    <div class="input-field col s12">
        
        {!!Form::textarea('description',null, array('id'=>'description','class'=>'materialize-textarea', 'data-length'=>'500','rows' => 4, 'cols' => 54))!!}
        {!! Form::label('description','Description') !!}
    </div>
    

</div>
