
@extends('layouts.superadminMaster')
@section('title', "Edit District")
@section('content')

@include('partial.formerror')
                            <!-- Form Advance -->
                            <div class="col s12 m12 l12">
                               
                                <div id="Form-advance" class="card card card-default scrollspy">
                                    <div class="card-content">
                                        <h4 class="card-title">District Update Form</h4>
                                     
                                       
                                        {!! Form::model($districtinfo, array('url' =>['superadmin/updatedistrict/'.$districtinfo->id], 'method'=>'PATCH','id'=>'theform','files'=>true)) !!}
                                      
                                    <div class="input-field col m12 s12">
                                        {!!Form::select('division_id',$divisioninfo,null, array('id'=>'district_id','required','class'=>'select2 browser-default','placeholder'=>'Select District'))!!}
        
                                        
                                    </div>
                               
                                    <div class="input-field col m12 s12">
                                        {!!Form::text('district',null, array('id'=>'title','required'))!!}
                                        {!!Form::label('title',' * Division Name * ')!!}
                                        
                                    </div>
                                
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Update
                                                            <i class="material-icons right">send</i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                     {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                           
                            </div>
@endsection

@section('page-script')
<script>
  var route_prefix = "/filemanager";
 </script>
   <!-- CKEditor init -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.5.11/ckeditor.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.5.11/adapters/jquery.js"></script>
  <script>

    $('textarea[name=description]').ckeditor({
      height: 300,
      filebrowserImageBrowseUrl: route_prefix + '?type=Images',
      filebrowserImageUploadUrl: route_prefix + '/upload?type=Images&_token={{csrf_token()}}',
      filebrowserBrowseUrl: route_prefix + '?type=Files',
      filebrowserUploadUrl: route_prefix + '/upload?type=Files&_token={{csrf_token()}}'
      
    });
    
  </script>


<script> 
 
  
 $(document).ready(function() {

    $('input#input_text, textarea#metadescription').characterCounter();

  $(".card .Close").click(function () {
	
    $(this).closest(".card")
        .fadeOut("slow");
});


$(".card-alert .close").click(function () {

    $(this).closest(".card-alert")
        .fadeOut("slow");
});
});

  </script>
  @endsection