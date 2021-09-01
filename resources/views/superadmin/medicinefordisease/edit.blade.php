
@extends('layouts.superadminMaster')

@section('content')
@section('title', "Edit Medicine")
@include('partial.formerror')
                            <!-- Form Advance -->
                            <div class="col s12 m12 l12">
                               
                                <div id="Form-advance" class="card card card-default scrollspy">
                                    <div class="card-content">
                                        <h4 class="card-title">Medicine Update Form</h4>
                                     
                                       
                                        {!! Form::model($disease, array('url' =>['superadmin/updatedisemedicinelist',$disease->id], 'method'=>'PATCH','files'=>true)) !!}
                                       
                                            @include('superadmin.medicinefordisease.form')
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
                        </div>
                           
                            </div>
@endsection

@section('script')
<script> 
 $(document).ready(function() {
    $('input#input_text, textarea#description').characterCounter();
  })

  $(".card .Close").click(function () {
	
    $(this).closest(".card")
        .fadeOut("slow");
});


$(".card-alert .close").click(function () {

    $(this).closest(".card-alert")
        .fadeOut("slow");
});

  </script>
  @endsection