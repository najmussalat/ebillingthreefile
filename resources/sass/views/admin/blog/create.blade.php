
@extends('layouts.adminMaster')
@section('title', "Create Blog")

@section('content')
@can('Blog-Create')
<div class="section">
  <!-- Snow Editor start -->
  <section class="snow-editor">
@include('partial.formerror')
                            <!-- Form Advance -->
                            <div class="col s12 m12 l12">
                               
                                <div id="Form-advance" class="card card card-default scrollspy">
                                    <div class="card-content">
                                        <h4 class="card-title">Blog Form</h4>
                                     
                                        {!! Form::open(array('url' => 'admin/createblog','method'=>'POST','id'=>'theform','files'=>true )) !!}
                                    
                                            @include('admin.blog.form')
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
                           
@endcan               
@endsection
@section('page-script')
<script>
  var route_prefix = "/den/filemanager";
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