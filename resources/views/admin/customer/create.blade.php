
@extends('layouts.adminMaster')

@section('content')
@section('title', "Create Customer")
{{-- @can('Package-Create') --}}
@include('partial.formerror')
                            <!-- Form Advance -->
                            <div class="col s12 m12 l12">
                               
                                <div id="Form-advance" class="card card card-default scrollspy">
                                    <div class="card-content">
                                                                       
                                        {!! Form::open(array('url' => 'admin/createcustomer','method'=>'POST','files'=>true )) !!}
                                    
                                            @include('admin.customer.form')
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



// for random value


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

    //for package
    $('#package_id').change(function(){
            $('#monthlyrent').empty();

    var packageid = $(this).val();

    $.ajax({
        type: "GET",
        url: url + '/gettpackageinfo/'+packageid,
        data:{},
        dataType: "JSON",
        success:function(data) {
           if(data){
                 $('#monthlyrent').val(data.packageprice);
                  $('#total').val(data.packageprice);
                  $('#intotal').val(data.packageprice);
                   
                }

            },
    });


});

$(function() {
    $('.static-show').hide(); 
    $('#type_id').change(function(){
        // alert();
        if($('#type_id').val() == 'static') {
            $('.static-show').show(); 
            $('.static-hide').hide(); 
        } else {
            $('.static-hide').show(); 
            $('.static-show').hide(); 
        } 
    });
});

$(function() {
    $('.mikrotic-hide').hide(); 
    $('#mikrotic_id').change(function(){
        // alert();
        if($('#mikrotic_id').val() == 'mikrotic') {
            $('.mikrotic-hide').show(); 
        } else {
            $('.mikrotic-hide').hide(); 
        } 
    });
});

$(function() {
    $('.otyertiype-hide').hide(); 
    $('#idinfo').click(function(){
    
        if($('#idnumbertype').is(':checked')) {
            $('.otyertiype-hide').show(); 
        } else {
            $('.otyertiype-hide').hide(); 
        } 
    });
});
//mark:val
    $("#monthlyrent,#due,#addicrg,#discount,#advance,#vat").keyup(function(){
    // console.log(Number($("#advance").val()));
        var total=isNaN((Number($("#monthlyrent").val()) + Number($("#due").val()) + Number($("#addicrg").val()))-(Number($("#advance").val())+Number($("#discount").val())))? 0 :((Number($("#monthlyrent").val()) + (Number($("#due").val()) + Number($("#addicrg").val()))-(Number($("#advance").val())+Number($("#discount").val()))))+((Number($("#monthlyrent").val())+Number($("#addicrg").val())) *  Number($("#vat").val()))/100;
        $("#total").val(total);
        $("#intotal").val(total);
    });



});

  </script>
  @endsection