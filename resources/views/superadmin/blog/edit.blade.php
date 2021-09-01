
@extends('layouts.superadminMaster')
@section('title', "Edit Blog")
{{-- vendor styles --}}

  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
@section('content')

@include('partial.formerror')
                            <!-- Form Advance -->
                            <div class="col s12 m12 l12">
                               
                                <div id="Form-advance" class="card card card-default scrollspy">
                                    <div class="card-content">
                                        <h4 class="card-title">Blog Update Form</h4>
                                     
                                       
                                        {!! Form::model($blogid, array('url' =>['superadmin/updateblog/'.$blogid->id], 'method'=>'PATCH','id'=>'theform','files'=>true)) !!}
                                       <input type="hidden" name="oldphoto" value="{{$blogid->photo}}">
                                       <div class="input-field col m12 s12">
                                        {!!Form::text('title',null, array('id'=>'title','required'))!!}
                                        {!!Form::label('title',' * Title (টাইটেল) * ')!!}
                                        
                                    </div>
                                    <div class="input-field col m12 s12">
                                        {!!Form::text('keyword',null, array('id'=>'keyword','required'))!!}
                                        {!!Form::label('keyword',' Seo Keyword * ')!!}
                                        
                                    </div>
                                    <div class="input-field col m6 s12">
                                        {!!Form::select('category_id',$categories,null, array('id'=>'category_id','required','class'=>'select2 browser-default'))!!}
                                       
                                        
                                    </div>
                                  
                                    <div class="col m6 s12 file-field input-field">
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