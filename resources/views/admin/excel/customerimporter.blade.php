
@extends('layouts.adminMaster')
@section('title', "Create Customerexcel sheet")

@section('content')
<div class="section">
  <!-- Snow Editor start -->
  <section class="snow-editor">
@include('partial.formerror')
                            <!-- Form Advance -->
                            <div class="col s12 m12 l12">
                               
                                <div id="Form-advance" class="card card card-default scrollspy">
                                    <div class="card-content">
                                        <h4 class="card-title">Select Info To Generate XIsx  </h4>
                                     
                                        {!! Form::open(array('url' => 'admin/makecusomerexcel','method'=>'POST','id'=>'theform','files'=>true )) !!}
                                    
<div class="row">
  <div class="input-field col m4 s12">
      {!! Form::text('password', 12345, ['id' => 'loginpass', 'required']) !!}
      {!! Form::label('loginpass', ' * Login Password') !!}

  </div>

  <div class="input-field col m4 s12">
      {!! Form::text('customername', 'mr', ['id' => 'customername', 'required']) !!}
      {!! Form::label('customername', ' * Customer Name') !!}

  </div>


  <div class="input-field col m4 s12">
      {!! Form::email('email', 'test@gmail.com', ['id' => 'email']) !!}
      {!! Form::label('email', 'Email') !!}

  </div>

</div>
<div class="row">
  <div class="input-field col m4 s12">
      {!! Form::text('customermobile', 88, ['id' => 'customermobile', 'required']) !!}
      {!! Form::label('customermobile', '* Mobile No.') !!}

  </div>

 
  <div class="input-field col m4 s12">
      {!! Form::text('idnumber', null, ['id' => 'idnumber']) !!}
      {!! Form::label('idnumber', '* NID/Passport/Other') !!}
  </div>
  <div class="col m4 s12 file-field input-field" id="idinfo">
     
     <p>

         <label>
             <input class="with-gap" name="idnumbertype" value="NID" type="radio" checked />
             <span>NID</span>
         </label>
         <label>
             <input class="with-gap" name="idnumbertype" value="Passport" type="radio" />
             <span>Passport</span>
         </label>
        </p>
 </div>

</div>
<div class="row">
    <div class="input-field col m4 s12">
        {!! Form::text('contactperson', null, ['id' => 'contactperson']) !!}
        {!! Form::label('contactperson', 'Contact Person') !!}
    </div>

  
    <div class="input-field col m4 s12">
        {!! Form::text('customeraltmobile', null, ['id' => 'customeraltmobile']) !!}
        {!! Form::label('customeraltmobile', 'Alternative Mobile / Phone No.') !!}

    </div>
    <div class="input-field col m4 s12">
        {!! Form::date('connectiondate', null, ['id' => 'connectiondate','required']) !!}
        {!! Form::label('connectiondate', '* Connection Date') !!}
  
    </div>
  

</div>   
<h4 class="card-title">Address</h4>
<div class="row">
  <div class="input-field col m4 s12">
      {!! Form::select('country_id', \App\Helpers\CommonFx::Countryname(), null, ['id' => 'country_id', 'required', 'class' => '']) !!}
      {!! Form::label('country_id', 'Country *') !!}
  </div>
  <div class="input-field col m4 s12">
      {!! Form::select('division_id', \App\Helpers\CommonFx::Divisionname(), null, ['id' => 'division_id', 'required', 'placeholder' => 'Select One']) !!}
      {!! Form::label('division_id', 'Division *') !!}
  </div>
 
      <div class="input-field col m4 s12">
         <select class="select2 browser-default" id="district_id" name="district_id" required>
               <option  value="">Select District *</option>
             </select>
   </div>
       
</div>
      
 <div id="row">

    <div class="input-field col m6 s12">
        <select class="select2 browser-default" id="thana_id" name="thana_id" required>
             <option value="">Select Thana *</option>
           </select>
 
     </div>
     <div class="input-field col m6 s12">
        <select class="select2 browser-default" id="area_id" name="area_id" required>
             <option value="">Select Area *</option>
           </select>
 
     </div>
     </div>



<div class="row">
    
  <div class="input-field col m4 s12">
      {!! Form::text('buildingname', null, ['id' => 'buildingname']) !!}
      {!! Form::label('buildingname', 'Building Name') !!}
  </div>
  <div class="input-field col m4 s12">
      {!! Form::text('houseno', null, ['id' => 'houseno', 'required']) !!}
      {!! Form::label('houseno', '* House No.') !!}
  </div>

  <div class="input-field col m4 s12">
      {!! Form::select('floor', [ 'Ground Floor' => 'Ground Floor',
      '1st Floor' => '1st Floor',
      '2nd Floor' => '2nd Floor',
      '3rd Floor' => '3rd Floor',
      '4th Floor' => '4th Floor',
      '5th Floor' => '5th Floor',
      '6th Floor' => '6th Floor',
      '7th Floor' => '7th Floor',
      '8th Floor' => '8th Floor',
      '9th Floor' => '9th Floor',
      '10th Floor' => '10th Floor',
      '11th Floor' => '11th Floor',
      '12th Floor' => '12th Floor',
      '13th Floor' => '13th Floor',
      '14th Floor' => '15th Floor',
      '16th Floor' => '16th Floor',
      '17th Floor' => '17th Floor',
      '18th Floor' => '18th Floor',
      '19th Floor' => '19th Floor',
      '20th Floor' => '20th Floor',
      '21th Floor' => '21th Floor',
      '22th Floor' => '22th Floor',
      '23th Floor' => '23th Floor',
      '24th Floor' => '24th Floor',
      '25th Floor' => '25th Floor',
      '26th Floor' => '26th Floor',
      '27th Floor' => '27th Floor',
      '28th Floor' => '28th Floor',
      '29th Floor' => '29th Floor',
      '30th Floor' => '30th Floor'], null, ['id' => 'floor_id', 'required', 'class' => '']) !!}
      {!! Form::label('floor', 'Floor *') !!}
  </div>
  </div>


  <div class="row">

<div class="input-field col m3 s12">
{!! Form::text('secretname', null, ['id' => 'secretname']) !!}
{!! Form::label('secretname', '* Secrets > Name') !!}

</div>
<div class="input-field col m3 s12">
{!! Form::text('scrtnamepass', null, ['id' => 'scrtnamepass']) !!}
{!! Form::label('scrtnamepass', 'Secrets Password') !!}

</div>
<div class="input-field col m3 s12">
    {!! Form::text('ip', null, ['id' => 'ipname']) !!}
    {!! Form::label('ipname', '* IP') !!}

</div>
<div class="input-field col m3 s12">
    {!! Form::text('mac', null, ['id' => 'mac']) !!}
    {!! Form::label('mac', ' MAC') !!}
    
    </div>
</div>


<div class="row">
<div class="input-field col m4 s12">
{{-- {!! Form::select('package_id', , null, ['id' => 'package_id', 'placeholder' => 'Select One']) !!} --}}
<select name="package_id" id="package_id" placeholder="Select One" required>
  <option  selected disabled>Select One</option>
@foreach (CommonFx::Packageame() as  $value)
  <option value="{{$value->id}}">{{$value->packagename}} &nbsp; &nbsp; {{$value->packageprice}}</option>
@endforeach
</select>

{!! Form::label('package_id', '* Package') !!}
</div>


<div class="input-field col m4 s12">
{!! Form::number('monthlyrent', null, ['id' => 'monthlyrent', 'required','placeholder'=>'select package']) !!}
{!! Form::label('monthlyrent', '* Monthly Rent',['class' => 'active']) !!}

</div>

<div class="input-field col m4 s12">
{!! Form::number('due', 0, ['id' => 'due']) !!}
{!! Form::label('due', 'Due') !!}

</div>

</div>


<div class="row">
<div class="input-field col m4 s12">
{!! Form::number('addicrg', 0, ['id' => 'addicrg']) !!}
{!! Form::label('addicrg', 'Additional Charge') !!}

</div>

<div class="input-field col m4 s12">
{!! Form::number('discount', 0, ['id' => 'discount']) !!}
{!! Form::label('discount', 'Discount') !!}

</div>

<div class="input-field col m4 s12">
{!! Form::number('advance', 0, ['id' => 'advance']) !!}
{!! Form::label('advance', 'Advance') !!}

</div>

<div class="input-field col m6 s12">
{!! Form::number('vat', 0, ['id' => 'vat']) !!}
{!! Form::label('vat', 'VAT (%)') !!}

</div>


<div class="input-field col m6 s12">
{!! Form::number('totalshow', 0, ['id' => 'total','disabled','step'=>'any']) !!}
<input type="hidden" name="total"  id="intotal" value="">
{{-- {!! Form::label('total', 'Total') !!} --}}

</div>
</div>


<div class="row">
<div class="input-field col m4 s12">
{!! Form::select('clienttype_id', [ 'Home' => 'Home',
'Corporate' => 'Corporate',
'BWA' => '2nd Floor',
'3rd Floor' => 'BWA',
'Category-A' => 'Category-A',
'Category-B' => 'Category-C',
'Category-C' => 'Category-C',
'ICX' => 'ICX',
'IGW' => 'IGW',
'IIG' => 'IIG',
'ILDC' => 'ILDC',
'ISP-Central Zone' => 'ISP-Central Zone',
'ISP-Nationwide' => 'ISP-Nationwide',
'ISP-Zonal' => 'ISP-Zonal',
'NTTN' => 'NTTN'
], null, ['id' => 'clienttype_id', 'class' => '']) !!}
{!! Form::label('clienttype_id', 'Type of Client') !!}
</div>
<div class="input-field col m4 s12">
    {!! Form::text('bandwidth', null, ['id' => 'bandwidth']) !!}
    {!! Form::label('bandwidth', '* Bandwidth') !!}
    
    </div>

<div class="input-field col m4 s12">
  {!! Form::select('status', ['2' => 'Pending'], 2, ['id' => 'status', 'class' => '']) !!}
  {!! Form::label('status', '* Customer Status ') !!}
  </div>
</div>  



</div>
                                           
           
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Generate 
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