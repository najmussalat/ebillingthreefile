<div class="row">

    <div class="input-field col m12 s12">
        {!!Form::select('district_id',$districts,null, array('id'=>'district_id','required','class'=>'select2 browser-default','placeholder'=>'Select District'))!!}
        
        
    </div>
    <div class="input-field col m12 s12">
        <i class="material-icons prefix">mode_edit</i>
          {!!Form::textarea('thana',null, array('id'=>'thana','class'=>'materialize-textarea','required', 'placeholder'=>'Every Thana Name Must Be , Secperate'))!!}
          <label for="thana">Thana Name</label>
    </div>
