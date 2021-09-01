
@extends('layouts.superadminMaster')
@section('title', "Edit Medicineinformation")
{{-- vendor styles --}}

  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
@section('content')

@include('partial.formerror')
                            <!-- Form Advance -->
                            <div class="col s12 m12 l12">
                               
                                <div id="Form-advance" class="card card card-default scrollspy">
                                    <div class="card-content">
                                        <h4 class="card-title">Medicineinformation Update Form</h4>
                                     
                                       
                                        {!! Form::model($medicineinfoid, array('url' =>['superadmin/updatemedicineinformation/'.$medicineinfoid->id], 'method'=>'PATCH','id'=>'theform','files'=>true)) !!}
                                       <input type="hidden" name="oldphoto" value="{{$medicineinfoid->photo}}">
                                            @include('superadmin.medicineinformation.form')
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
  var route_prefix = "/den/filemanager";
 </script>
   <!-- CKEditor init -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.5.11/ckeditor.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.5.11/adapters/jquery.js"></script>
  <script>

    $('textarea[name=description]').ckeditor({
      height: 500,
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