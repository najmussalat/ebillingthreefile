<div class="row">
    <div class="input-field col m12 s12">
        {!!Form::text('diseasename',null, array('id'=>'diseasename','required'))!!}
        {!!Form::label('diseasename',' * Disease ( রোগের নাম )')!!}
        
    </div>
    <div class="col m6 s12 file-field input-field">
        <div class="btn float-right">
            <span>File</span>
            {!!Form::file('diseaseimage', ['accept'=>".jpg,.jpeg,.png"])!!}
            {{-- <input type="file" name="diseaseimage" required> --}}
        </div>
        <div class="file-path-wrapper">
            <input class="file-path validate" type="text">
        </div>
    </div>
     <div class="col m6 s12 file-field input-field">
        
    </div>
    <div class="col m6 s12 file-field input-field">
       * Select Male/Female Or Both
        <p>
           
            <label>
              <input class="with-gap" name="menwomen" value="Male" type="radio"  />
              <span>Male</span>
            </label>
            <label>
                <input class="with-gap" name="menwomen" value="FeMale" type="radio"  />
                <span>Female</span>
              </label>
              <label>
                <input class="with-gap" name="menwomen" value="kids" type="radio"  />
                <span>kids</span>
              </label>
              <label>
                <input class="with-gap" name="menwomen" value="Both" type="radio" checked />
                <span>Both</span>
              </label>
          </p>
    </div>
    
</div>
<div class="row">
    <div class="input-field col s12">
        
    {!!Form::textarea('description',null, array('id'=>'description','class'=>'materialize-textarea', 'data-length'=>'500','rows' => 4, 'cols' => 54,'required'))!!}
    {!!Form::label('description',' * Description (সংক্ষিপ্ত বিবরন)')!!}
</div>

</div>
