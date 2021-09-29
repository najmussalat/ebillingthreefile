
@extends('layouts.adminMaster')
@section('title', "Create Customer Invoice")

@section('content')

{{-- @can('Medicineinformation-Create')  --}}
<div class="section">
  <div class="col s12 m12 l12">
                               
    <div id="Form-advance" class="card card card-default scrollspy">
        <div class="card-content">
            <h4 class="card-title">Find Customer</h4>
         
            {!! Form::open(array('url' => 'admin/billlocationwise','method'=>'GET' )) !!}
        
             
                    <div class="row">
                        <div class="row">
                            <div class="input-field col m4 s12">
                                {!! Form::select('country_id', CommonFx::Countryname(), null, ['id' => 'country_id', 'required', 'class' => '']) !!}
                                {!! Form::label('country_id', 'Country *') !!}
                            </div>
                            <div class="input-field col m4 s12">
                                {!! Form::select('division_id', CommonFx::Divisionname(), null, ['id' => 'division_id', 'required', 'placeholder' => 'Select One']) !!}
                                {!! Form::label('division_id', 'Division *') !!}
                            </div>
                           
                                <div class="input-field col m4 s12">
                                   <select class="select2 browser-default" id="district_id" name="district_id" >
                                         <option  value="">Select District *</option>
                                       </select>
                             </div>
                                 
                            
                                 <div class="input-field col m6 s12">
                                    <select class="select2 browser-default" id="thana_id" name="thana_id" >
                                         <option value="">Select Thana *</option>
                                       </select>
                             
                                 </div>
                                 <div class="input-field col m6 s12">
                                    <select class="select2 browser-default" id="area_id" name="area_id" >
                                         <option value="">Select Area *</option>
                                       </select>
                             
                                 </div>
                           
                        </div>
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


  <section>

                           
{{-- @endcan --}}
@endsection
@section('page-script')
 
<script>
 $(document).ready(function() {
 // for  change category change subcategory value
 $('#division_id').change(function(){
            $('#district_id').empty();

    var divisionid = $(this).val();

    $.ajax({
        type: "GET",
        url: url + '/getdistrict/'+divisionid,
        data:{},
        dataType: "JSON",
        success:function(data) {
           if(data){
                    // $('#district_id').empty();
                   //console.log(data);
                    $.each(data, function(key, value){
                       // alert(key);
                        $('#district_id').append('<option value="'+value.id+'">' + value.district + '</option>');

                    });
                    $('#district_id').append(' <option  value="" selected disabled>Select District *</option>');
                }

            },
    });

});

//for thana
        $('#district_id').change(function(){
            $('#thana_id').empty();

    var districtid = $(this).val();

    $.ajax({
        type: "GET",
        url: url + '/getthana/'+districtid,
        data:{},
        dataType: "JSON",
        success:function(data) {
           if(data){
                 
                    $.each(data, function(key, value){
                       // alert(key);
                        $('#thana_id').append('<option value="'+value.id+'">' + value.thana + '</option>');

                    });
                    $('#thana_id').append(' <option  value="" selected disabled>Select Thana *</option>');
                }

            },
    });
    });

//for area
$('#thana_id').change(function(){
            $('#area_id').empty();

    var thanaid = $(this).val();

    $.ajax({
        type: "GET",
        url: url + '/getarea/'+thanaid,
        data:{},
        dataType: "JSON",
        success:function(data) {
           if(data){
                 
                    $.each(data, function(key, value){
                       // alert(key);
                        $('#area_id').append('<option value="'+value.id+'">' + value.areaname + '</option>');

                    });
                    $('#area_id').append(' <option  value="" selected disabled>Select Area *</option>');
                }

            },
    });
    });
});

  </script>
  @endsection