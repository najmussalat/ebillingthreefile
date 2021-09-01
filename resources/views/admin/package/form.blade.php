<div class="row">
    <div class="input-field col m12 s12">
        {!!Form::text('packagename',null, array('id'=>'packagename','required'))!!}
        {!!Form::label('packagename',' Package Name * ')!!}
        
    </div>
    <div class="input-field col m12 s12">
        {!!Form::number('packageprice',null, array('id'=>'packageprice','required','step'=>'any'))!!}
        {!!Form::label('packageprice',' Price *')!!}
        
    </div>
    <div class="input-field col m12 s12">
        
        {!!Form::select('merchant_id',$marchantlist, null, array('id'=>'merchant_id','required','class'=>'select2 browser-default','placeholder'=>'Select One'))!!}
        
    </div>
    
    <div class="input-field col s12">
        
        {!!Form::textarea('description',null, array('id'=>'description','class'=>'materialize-textarea', 'data-length'=>'500','rows' => 4, 'cols' => 54))!!}
        {!! Form::label('description','Description') !!}
    </div>
    

</div>
