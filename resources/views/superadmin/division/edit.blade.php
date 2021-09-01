
@extends('layouts.superadminMaster')
@section('title', "Edit Division")

@section('content')

@include('partial.formerror')
                            <!-- Form Advance -->
                            <div class="col s12 m12 l12">
                               
                                <div id="Form-advance" class="card card card-default scrollspy">
                                    <div class="card-content">
                                        <h4 class="card-title"> Division Update Form</h4>
                                     
                                       
                                        {!! Form::model($divisioninfo, array('url' =>['superadmin/updatedivision/'.$divisioninfo->id], 'method'=>'PATCH','id'=>'theform','files'=>true)) !!}
                                        @include('superadmin.division.form')
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