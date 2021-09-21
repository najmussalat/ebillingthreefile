
@extends('layouts.superadminMaster')

@section('content')
@section('title', "Edit SMS Sale")
{{-- @can('Package-Edit') --}}
@include('partial.formerror')
                            <!-- Form Advance -->
                            <div class="col s12 m12 l12">
                               {{-- {{dd($infos->id)}} --}}
                                <div id="Form-advance" class="card card card-default scrollspy">
                                    <div class="card-content">
                                        <h4 class="card-title"> Update Form</h4>
                                     
                                       
                                        {!! Form::model($infos, array('url' =>['superadmin/updatesalesms',$infos->id], 'method'=>'PATCH','files'=>true)) !!}
                                       
                                        @include('superadmin.smssale.form')
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Update
                                                    <i class="material-icons right">send</i>
                                                </button>
                                            </div>
                                        </div>
                                     {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
 {{-- @endcan --}}
@endsection


@section('page-script')
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