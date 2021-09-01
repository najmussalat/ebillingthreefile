<div class="row">
    <div class="input-field col m12 s12">
        {!!Form::text('title',null, array('id'=>'title','required'))!!}
        {!!Form::label('title',' * Title (টাইটেল) * ')!!}
        
    </div>
    <div class="input-field col m6 s12">
        {!!Form::text('keyword',null, array('id'=>'keyword','required'))!!}
        {!!Form::label('keyword',' Seo Keyword * ')!!}
        
    </div>
    <div class="input-field col m6 s12">
        {!!Form::select('category_id',$categories,null, array('id'=>'category_id','required','class'=>'select2 browser-default'))!!}
       
        
    </div>
    <div class="input-field col m7 s12">
        {!!Form::select('tag[]',$tags,null, array('id'=>'tag','required','class'=>'select2 browser-default','multiple'=>true))!!}
       
        
    </div>
    <div class="col m5 s12 file-field input-field">
        <div class="btn float-right">
            <span>Image</span>
            {!!Form::file('photo', ['accept'=>".jpg,.jpeg,.png"])!!}
           
        </div>
        <div class="file-path-wrapper">
            <input class="file-path validate" type="text">
        </div>
    </div>
 
    <div class="input-field col s12">
        
    {!!Form::textarea('metadescription',null, array('id'=>'metadescription','class'=>'materialize-textarea', 'data-length'=>'160','rows' => 4, 'cols' => 54,'required'))!!}
    {!!Form::label('metadescription',' *Seo Meta-description (Not More Than 160 Word)')!!}
    
</div> 

<div class="input-field col s12">
  
    {!!Form::textarea('description',null, array('id'=>'description','class'=>'materialize-textarea'))!!}
    
    
</div>

 
   
</div>
