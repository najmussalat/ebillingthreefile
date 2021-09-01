<div class="row">
    <div class="input-field col m12 s12">
        
        {!!Form::select('disease_id',$diseases, null, array('id'=>'disease_id','required','class'=>'select2 browser-default'))!!}
        
    </div>
    <div class="input-field col m12 s12">
    
        {!!Form::select('medicine[]',$medicines, null, array('id'=>'medicine','required','class'=>'select2 browser-default','multiple'=>true))!!}
     
        
    </div>
    
    

</div>
