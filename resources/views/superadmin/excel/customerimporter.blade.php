
@extends('layouts.superadminMaster')
@section('title', "Create Payemnt")

@section('content')
<div class="section">
  <!-- Snow Editor start -->
  <section class="snow-editor">
@include('partial.formerror')
                            <!-- Form Advance -->
                            <div class="col s12 m12 l12">
                               
                                <div id="Form-advance" class="card card card-default scrollspy">
                                    <div class="card-content">
                                        <h4 class="card-title">Select XIsx File </h4>
                                     
                                        {!! Form::open(array('url' => 'superadmin/impotercustomer','method'=>'POST','id'=>'theform','files'=>true )) !!}
                                    
                                           
            
              <div class="col  s12 file-field input-field">
                <div class="btn float-right">
                    <span>Xlsx</span>
                    {!!Form::file('customers',['required'])!!}
                   
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit
                                                            <i class="material-icons right">send</i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                     {!! Form::close() !!}
                                    </div>
                                </div>
                              </section>
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

  

  $(".card .Close").click(function () {
	  $('input#input_text, textarea#metadescription').characterCounter();

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