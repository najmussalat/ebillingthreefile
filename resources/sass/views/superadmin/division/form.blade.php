<div class="row">
  
  <div class="input-field col m12 s12">
    {!!Form::select('country_id',$country,null, array('id'=>'country_id','required','class'=>'select2 browser-default','placeholder'=>'Select Country'))!!}
    
    
</div>
  <div class="input-field col m12 s12">
    {!!Form::text('division',null, array('id'=>'title','required'))!!}
    {!!Form::label('title',' * Division Name * ')!!}
    
</div>
</div>
  
