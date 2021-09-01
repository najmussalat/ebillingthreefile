<div class="row">
    <div class="input-field col m12 s12">
        {!!Form::text('medicinename',null, array('id'=>'medicinename','required'))!!}
        {!!Form::label('medicinename',' * Medicine Name ( English) * ')!!}
        
    </div>
    <div class="input-field col m12 s12">
        {!!Form::text('medicinbn',null, array('id'=>'medicinbn','required'))!!}
        {!!Form::label('medicinbn',' Medicine Name (ওষুধ) ')!!}
        
    </div>
    
    <div class="input-field col m12 s12">
        {!!Form::select('color',['primary' => 'Primary', 'success' => 'Success','warning'=>'Warning','danger'=>'Danger','dark'=>'Dark','info'=>'Info'], 'success', array('id'=>'color','required','class'=>'select2 browser-default'))!!}
       
        
    </div>
  
 
    <div class="input-field col s12">
        
    {!!Form::textarea('minides',null, array('id'=>'minides','class'=>'materialize-textarea', 'data-length'=>'500','rows' => 4, 'cols' => 54,'required'))!!}
    {!!Form::label('minides',' * Description (সংক্ষিপ্ত বিবরন)')!!}
</div>

</div>
