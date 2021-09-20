
@extends('layouts.adminMaster')

@section('content')
@section('title', "Create Package")
{{-- @can('Package-Create') --}}
@include('partial.formerror')
                            <!-- Form Advance -->
                            <div class="col s12 m12 l12">
                               
                                <div id="Form-advance" class="card card card-default scrollspy">
                                    <div class="card-content">
                                        <h4 class="card-title">Package Form</h4>
                                     
                                        {!! Form::open(array('url' => 'admin/createpackage','method'=>'POST','files'=>true )) !!}
                                    
                                            @include('admin.package.form')
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
                            </div>
{{-- @endcan --}}
@endsection

@section('script')
<script> 

 $(document).ready(function() {

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