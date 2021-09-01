<div class="row">

    <div class="input-field col m12 s12">
        {!!Form::select('division',$division,null, array('id'=>'district_id','required','class'=>'select2 browser-default','placeholder'=>'Select District'))!!}
        
        
    </div>
    <div class="input-field col m12 s12">
        <i class="material-icons prefix">mode_edit</i>
          {!!Form::textarea('district',null, array('id'=>'thana','class'=>'materialize-textarea','required', 'placeholder'=>'Every District Name Must Be , Secperate'))!!}
          <label for="thana">District Name</label>
    </div>
