
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    {!!Form::text('firstname',null,array('required','class'=>'form-control form-control-user','placeholder'=>"First Name"))!!}
                    
                  </div>
                
                </div>
                <h2 class="mt-4">Standalone Image Button</h2>
                <div class="input-group">
                  <span class="input-group-btn">
                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                      <i class="fa fa-picture-o"></i> Choose
                    </a>
                  </span>
                  <input id="thumbnail" class="form-control" type="text" name="filepath">
                </div>
                <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                     {!!Form::label('gender',"Select Gender")!!}
         
             {!!Form::Select('gender', ['male' => 'Male', 'female' => 'Female'], null, ['placeholder' => 'Select Gender','class'=>'form-control form-control-user','id'=>'gender','required'])!!}
                  
                    
                  </div>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                     {!!Form::label('role',"Select Role")!!}
                    {!!Form::select('roles',$roles,null,array('required','class'=>'form-control','id'=>'role'))!!}
                    
                  </div>
                  
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    {!!Form::label('status',"Select Status")!!}
                    {!!Form::Select('gender', ['a-4' => 'A-4', 'a-5' => 'A-5','8cm'=>'8-CM'], null, ['placeholder' => 'Select Paper size','class'=>'form-control','id'=>'gender','required'])!!}
                    
                  </div>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                     {!!Form::label('photo',"Select Photo")!!}
                    {!!Form::file('photo', null,array('required','class'=>'form-control','image'))!!}
                    
                  </div>
                  
                </div>
                  <div class="form-group">
                   {!!Form::tel('phone',null,array('required','class'=>'form-control form-control-user','placeholder'=>"Your Phone"))!!}
                </div>
                <div class="form-group">
                   {!!Form::email('email',null,array('required','class'=>'form-control form-control-user','placeholder'=>"Your Email"))!!}
                </div>
              
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                   {!!Form::password('password',array('required','class'=>'form-control form-control-user','placeholder'=>"Your Pasword"))!!}
                  </div>
                  <div class="col-sm-6">
                    {!!Form::password('repassword',array('required','class'=>'form-control form-control-user','placeholder'=>"Retype Pasword"))!!}
                  </div>
                </div>
                <div class="input-group">
                  <span class="input-group-btn">
                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                      <i class="fa fa-picture-o"></i> Choose
                    </a>
                  </span>
                  <input id="thumbnail" class="form-control" type="text" name="filepath">
                </div>
                <img id="holder" style="margin-top:15px;max-height:100px;">
     