
@extends('layouts.adminMaster')

@section('content')
@section('title', "Edit Customer")
{{-- @can('Package-Edit') --}}
@include('partial.formerror')
                            <!-- Form Advance -->
                            <div class="col s12 m12 l12">
                               
                                <div id="Form-advance" class="card card card-default scrollspy">
                                    <div class="card-content">
                                        <h4 class="card-title">Customer Update Form</h4>
                                     
                                       
                                        {!! Form::model($info, array('url' =>['admin/updatecustomer',$info->id], 'method'=>'PATCH','files'=>true)) !!}
                                        <h4 class="card-title">Personal Information</h4>
                                        <div class="row">
                                            <div class="input-field col m12 s12">
                                                {!! Form::text('loginid', null, ['id' => 'loginid', 'required']) !!}
                                                {!! Form::label('loginid', '* Login ID (Customer ID)') !!}
                                        
                                            </div>
                                        
                                        </div>
                                       
<div class="row">
    <div class="input-field col m6 s12">
        {!! Form::text('oldpassword', null, ['id' => 'loginpass', '']) !!}
        {!! Form::label('loginpass', ' * Login Password') !!}

    </div>

    <div class="input-field col m6 s12">
        {!! Form::text('repassword', null, ['id' => 'logtrtypepass', '']) !!}
        {!! Form::label('logtrtypepass', '* Retype password') !!}

    </div>

</div>
                                        
                                        <div class="row">
                                            <div class="input-field col m6 s12">
                                                {!! Form::text('customername', null, ['id' => 'customername', 'required']) !!}
                                                {!! Form::label('customername', ' * Customer Name') !!}
                                        
                                            </div>
                                        
                                            <div class="input-field col m6 s12">
                                                {!! Form::text('contactperson', null, ['id' => 'contactperson']) !!}
                                                {!! Form::label('contactperson', 'Contact Person') !!}
                                        
                                            </div>
                                        
                                        </div>
                                        
                                        <div class="row">
                                            <div class="input-field col m12 s12">
                                                {!! Form::email('email', null, ['id' => 'customeremail']) !!}
                                                {!! Form::label('customeremail', 'Email') !!}
                                        
                                            </div>
                                        
                                            {{-- <div class="input-field col m6 s12">
                                                {!! Form::text('customeridno', null, ['id' => 'customeridno']) !!}
                                                {!! Form::label('customeridno', 'Id No.') !!}
                                        
                                            </div> --}}
                                        
                                        </div>
                                        <div class="row">
                                            <div class="input-field col m6 s12">
                                                {!! Form::text('customermobile', null, ['id' => 'customermobile', 'required']) !!}
                                                {!! Form::label('customermobile', '* Mobile No.') !!}
                                        
                                            </div>
                                        
                                            <div class="input-field col m6 s12">
                                                {!! Form::text('customeraltmobile', null, ['id' => 'customeraltmobile']) !!}
                                                {!! Form::label('customeraltmobile', 'Alternative Mobile / Phone No.') !!}
                                        
                                            </div>
                                        
                                        </div>
                                        <div class="row">
                                            <div class="input-field col m6 s12">
                                                {!! Form::text('customerprofession', null, ['id' => 'customerprofession']) !!}
                                                {!! Form::label('customerprofession', 'Professional Detail') !!}
                                            </div>
                                        </div>
                                         <div class="row" id="idinfo">
                                            <div class="input-field col m4 s12">
                                                {!! Form::text('idnumber', null, ['id' => 'idnumber']) !!}
                                                {!! Form::label('idnumber', ' * NID/Passport/Other') !!}
                                            </div>
                                            <div class="col m4 s12 file-field input-field" >
                                               
                                               <p>
                                        
                                                   <label>
                                                       <input class="with-gap" name="idnumbertype" value="NID" type="radio" {{ ($info->idnumbertype=="NID")? "checked" : "" }} />
                                                       <span>NID</span>
                                                   </label>
                                                   <label>
                                                       <input class="with-gap" name="idnumbertype" value="Passport" type="radio" {{ ($info->idnumbertype=="Passport")? "checked" : ""}}/>
                                                       <span>Passport</span>
                                                   </label>
                                                   <label>
                                                    <input id="idnumbertype" class="with-gap" name="idnumbertype" value="Other" type="radio"  {{ ($info->idnumbertype=="Other")? "checked" : ""}}/>
                                                    <span>Other</span>
                                                </label>
                                              
                                               </p>
                                           </div>
                                           <div class="input-field col m4 s12 otyertiype-hide">
                                            {!! Form::text('otheridtype', null, ['id' => 'otheridtype']) !!}
                                            {!! Form::label('otheridtype', '* Other') !!}
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
                                                   <select class="select2 browser-default" id="district_id" name="district_id">
                                                         <option  value="">Select District *</option>
                                                       </select>
                                             </div>
                                                 
                                            
                                                 <div class="input-field col m6 s12">
                                                    <select class="select2 browser-default" id="thana_id" name="thana_id">
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
                                           
                                            <div class="input-field col m6 s12">
                                                {!! Form::text('buildingname', null, ['id' => 'buildingname']) !!}
                                                {!! Form::label('buildingname', 'Building Name') !!}
                                            </div>
                                            <div class="input-field col m6 s12">
                                                {!! Form::text('houseno', null, ['id' => 'houseno', 'required']) !!}
                                                {!! Form::label('houseno', '* House No.') !!}
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            
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
                                               
                                            <div class="input-field col m4 s12">
                                                {!! Form::text('post', null, ['id' => 'post']) !!}
                                                {!! Form::label('post', 'Post') !!}
                                            </div>
                                            <div class="input-field col m4 s12">
                                                {!! Form::text('apt', null, ['id' => 'apt']) !!}
                                                {!! Form::label('apt', 'Apt') !!}
                                            </div>
                                        </div>
                                        
                                        <h4 class="card-title">Internet</h4>
                                        <div class="row">
                                          <div class="input-field col m6 s12">
                                              {!! Form::date('connectiondate', null, ['id' => 'connectiondate']) !!}
                                              {!! Form::label('connectiondate', 'Connection Date') !!}
                                        
                                          </div>
                                        
                                        </div>
                                        
                                        <div class="row">
                                        <div class="input-field col m6 s12">
                                          {!! Form::select('mikrotic_id', ['2'=>'Select','mikrotic' => 'Mikrotic'], 2, ['id' => 'mikrotic_id', 'class' => '']) !!}
                                          {!! Form::label('mikrotic_id', 'Mikrotik') !!}
                                        </div>
                                        
                                        </div>
                                        <div class="row">
                                        <div class="input-field col m6 s12 static-show">
                                            {!! Form::text('ip', null, ['id' => 'ipname']) !!}
                                            {!! Form::label('ipname', '* IP') !!}
                                        
                                        </div>
                                        
                                        
                                        <div class="input-field col m6 s12">
                                          {!! Form::select('type_id', ['pppoe' => 'PPPoE', 'static' => 'Static'], null, ['id' => 'type_id', 'placeholder' => 'Select']) !!}
                                          {!! Form::label('type_id', '* Type') !!}
                                        </div>
                                        
                                        <div class="input-field col m6 s12 static-hide">
                                        {!! Form::select('profile_id', ['undefimed' => 'undefined', 'uni' => 'und'], null, ['id' => 'profile_id', 'class' => '']) !!}
                                        {!! Form::label('profile_id', '* Profile') !!}
                                        </div>
                                        
                                        </div>
                                        
                                        
                                        <div class="row">
                                        <div class="input-field col m6 s12">
                                        {!! Form::text('mac', null, ['id' => 'mac']) !!}
                                        {!! Form::label('mac', ' MAC') !!}
                                        
                                        </div>
                                        
                                        </div>
                                        
                                        
                                        <div class="row static-show">
                                        
                                        <div class="input-field col m6 s12">
                                        {!! Form::text('sqn', null, ['id' => 'sqn']) !!}
                                        {!! Form::label('sqn', 'Simple Queues > Name') !!}
                                        
                                        </div>
                                        <div class="input-field col m6 s12">
                                        {!! Form::text('interfacename', null, ['id' => 'interfacename']) !!}
                                        {!! Form::label('interfacename', '* Interface Name') !!}
                                        
                                        </div>
                                        
                                        </div>
                                        
                                        
                                        <div class="row static-hide">
                                        
                                        <div class="input-field col m6 s12">
                                        {!! Form::text('secretname', null, ['id' => 'secretname']) !!}
                                        {!! Form::label('secretname', '* Secrets > Name') !!}
                                        
                                        </div>
                                        <div class="input-field col m6 s12">
                                        {!! Form::text('scrtnamepass', null, ['id' => 'scrtnamepass']) !!}
                                        {!! Form::label('scrtnamepass', 'Password') !!}
                                        
                                        </div>
                                        
                                        </div>
                                        
                                        
                                        <div class="row static-hide">
                                        
                                        
                                        <div class="input-field col m6 s12">
                                        {!! Form::text('ppcomment', null, ['id' => 'ppcomment']) !!}
                                        {!! Form::label('ppcomment', 'Comment') !!}
                                        
                                        </div>
                                        <div class="input-field col m6 s12">
                                        {!! Form::text('remoteaddress', null, ['id' => 'remoteaddress']) !!}
                                        {!! Form::label('remoteaddress', 'PPPoE Remote Address') !!}
                                        
                                        </div>
                                        
                                        </div>
                                        
                                        <div class="row static-show">
                                        <div class="input-field col m6 s12">
                                        {!! Form::text('bandwidth', null, ['id' => 'bandwidth']) !!}
                                        {!! Form::label('bandwidth', '* Bandwidth') !!}
                                        
                                        </div>
                                        
                                        <div class="input-field col m6 s12">
                                        {!! Form::text('comment', null, ['id' => 'comment']) !!}
                                        {!! Form::label('comment', 'Comment') !!}
                                        
                                        </div>
                                        
                                        </div>
                                        
                                        
                                        <div class="row">
                                        <div class="input-field col m6 s12">
                                        {{-- {!! Form::select('package_id', \App\Helpers\CommonFx::Packageame(), null, ['id' => 'package_id', 'placeholder' => 'Select One']) !!} --}}
                                        
                                        <select name="package_id" id="package_id" placeholder="Select One">
                                        @foreach (CommonFx::Packageame() as  $value)
                                            <option value="{{$value->id}}" {{ ( $value->id == $info->package_id) ? 'selected' : ''}}>{{$value->packagename}} &nbsp; &nbsp; {{$value->packageprice}}</option>
                                        @endforeach
                                        </select>
                                        {!! Form::label('package_id', '* Package') !!}
                                        </div>
                                        
                                        <div class="input-field col m3 s12 mikrotic-hide">
                                        {!! Form::select('atd_day', ['selectday' => 'select day'], null, ['id' => 'atd1_id', 'class' => '']) !!}
                                        {!! Form::label('atd_month', 'Auto Temporary Disable') !!}
                                        </div>
                                        <div class="input-field col m3 s12 mikrotic-hide">
                                        {!! Form::select('atd2_id', ['selectmonth' => 'select month'], null, ['id' => 'atd2_id', 'class' => '']) !!}
                                        {{-- {!! Form::label('', '') !!} --}}
                                        </div>
                                        
                                        </div>
                                        
                                        <h4 class="card-title">Billing</h4>
                                        
                                        <div class="row">
                                        <div class="input-field col m6 s12">
                                        {!! Form::number('monthlyrent', null, ['id' => 'monthlyrent', 'required','placeholder'=>'select package']) !!}
                                        {!! Form::label('monthlyrent', '* Monthly Rent',['class' => 'active']) !!}
                                        
                                        </div>
                                        
                                        <div class="input-field col m6 s12">
                                        {!! Form::number('due', null, ['id' => 'due']) !!}
                                        {!! Form::label('due', 'Due') !!}
                                        
                                        </div>
                                        
                                        </div>
                                        
                                        
                                        <div class="row">
                                        <div class="input-field col m6 s12">
                                        {!! Form::number('addicrg', null, ['id' => 'addicrg']) !!}
                                        {!! Form::label('addicrg', 'Additional Charge') !!}
                                        
                                        </div>
                                        
                                        <div class="input-field col m6 s12">
                                        {!! Form::number('discount', null, ['id' => 'discount']) !!}
                                        {!! Form::label('discount', 'Discount') !!}
                                        
                                        </div>
                                        
                                        </div>
                                        <div class="row">
                                        <div class="input-field col m6 s12">
                                        {!! Form::number('advance', null, ['id' => 'advance']) !!}
                                        {!! Form::label('advance', 'Advance') !!}
                                        
                                        </div>
                                        
                                        <div class="input-field col m6 s12">
                                        {!! Form::number('vat', null, ['id' => 'vat']) !!}
                                        {!! Form::label('vat', 'VAT (%)') !!}
                                        
                                        </div>
                                        
                                        </div>
                                        <div class="row">
                                        <div class="input-field col m6 s12">
                                        {!! Form::number('total', null, ['id' => 'total','step'=>'any']) !!}
                                      
                                        {{-- {!! Form::label('total', 'Total') !!} --}}
                                        
                                        </div>
                                        </div>
                                        
                                        <h4 class="card-title">Official Information</h4>
                                        
                                        <div class="row">
                                        <div class="col m4 s12 file-field input-field">
                                        Billing Type
                                        <p>
                                            <label>
                                                <input class="with-gap" name="prepaidpostpaid" value="Prepaid" type="radio" {{ ($info->prepaidpostpaid=="Prepaid")? "checked" : "" }} />
                                                <span>Pre Paid</span>
                                                </label>
                                                <label>
                                                <input class="with-gap" name="prepaidpostpaid" value="Postpaid" type="radio" {{ ($info->prepaidpostpaid=="Postpaid")? "checked" : "" }}  />
                                                <span>Post Paid</span>
                                                </label>
                                        </p>
                                        </div>
                                        
                                        
                                        <div class="col m4 s12 file-field input-field">
                                        Type of Connection
                                        <p>
                                        
                                            <label>
                                                <input class="with-gap" name="connection" value="Wired" type="radio" {{ ($info->connection=="Wired")? "checked" : "" }}  />
                                                <span>Wired</span>
                                                </label>
                                                <label>
                                                <input class="with-gap" name="connection" value="Wireless" type="radio"  {{ ($info->connection=="Wireless")? "checked" : "" }}/>
                                                <span>Wireless</span>
                                                </label>
                                                
                                        
                                        </p>
                                        </div>
                                        <div class="col m4 s12 file-field input-field">
                                        Type of Connectivity
                                        <p>
                                        
                                        
                                            <label>
                                                <input class="with-gap" name="connectivity" value="Shared" type="radio" {{ ($info->connectivity=="Shared")? "checked" : "" }}/>
                                                <span>Shared</span>
                                                </label>
                                                <label>
                                                <input class="with-gap" name="connectivity" value="Dedicated" type="radio" {{ ($info->connectivity=="Dedicated")? "checked" : "" }}/>
                                                <span>Dedicated</span>
                                                </label>
                                                
                                        </p>
                                        </div>
                                        
                                        
                                        
                                        </div>
                                        
                                        <div class="row">
                                        <div class="input-field col m6 s12">
                                        {!! Form::select('clienttype_id',  [ 'Home' => 'Home',
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
                                        
                                        <div class="input-field col m6 s12">
                                        {!! Form::text('dlp', null, ['id' => 'dlp']) !!}
                                        {!! Form::label('dlp', 'Distribution Location Point') !!}
                                        
                                        </div>
                                        
                                        </div>
                                        
                                        
                                        <div class="row">
                                        
                                        
                                        <div class="input-field col m6 s12">
                                        {!! Form::text('description', null, ['id' => 'description']) !!}
                                        {!! Form::label('description', 'Description') !!}
                                        
                                        </div>
                                        
                                        
                                        <div class="input-field col m6 s12">
                                        {!! Form::text('note', null, ['id' => 'note']) !!}
                                        {!! Form::label('note', 'Note') !!}
                                        
                                        </div>
                                        
                                        </div>
                                        <div class="row">
                                        <div class="input-field col m4 s12">
                                        {!! Form::select('connectedby', CommonFx::Connect(), null, ['id' => 'connectedby', 'placeholder' => 'Select Employee']) !!}
                                        {!! Form::label('connectedby', 'Connected By') !!}
                                        </div>
                                        
                                        <div class="input-field col m4 s12">
                                        {!! Form::text('sdeposite', null, ['id' => 'sdeposite']) !!}
                                        {!! Form::label('sdeposite', 'Security Deposit') !!}
                                        
                                        </div>
                                        <div class="input-field col m4 s12">
                                            {!! Form::select('status', ['1' => 'Active', '2' => 'Pending'], null, ['id' => 'status', 'class' => '']) !!}
                                            {!! Form::label('status', '* Customer Status ') !!}
                                            </div>
                                        </div>  
                                        
                                        <div class="row">
                                        
                                            <div class="col m5 s12 file-field input-field">
                                                <div class="btn float-right">
                                                    <span>Customer Photo</span>
                                                    {!!Form::file('photo', ['accept'=>".jpg,.jpeg,.png"])!!}
                                                   
                                                </div>
                                                <div class="file-path-wrapper">
                                                    <input class="file-path validate" type="text">
                                                </div>
                                            </div> 
                                        <div class="col m6 s12 file-field input-field">
                                            <div class="btn float-right">
                                                <span>Customer Info</span>
                                                {!!Form::file('infoimage', ['accept'=>".jpg,.jpeg,.png"])!!}
                                               
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text">
                                            </div>
                                        </div> 
                                        
                                        </div>
                                        
                                        </div>
                                        
                                        
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
//alert('{{$info->idnumbertype}}');
var otherareainfo = '{{$info->idnumbertype}}';
if(otherareainfo='Other'){
    $('.static-hide').show(); 
}
//console.log('{{$info->email}}');
    var divisionid = $("#division_id").val();
    var districtid = '{{$info->district_id}}';
    var thanaid = '{{$info->thana_id}}';
    var areaid = '{{$info->area_id}}';
    $("#total").val('{{$info->total}}');
    $.ajax({
        type: "GET",
        url: url + '/getcustomerinfo/',
        data:{divisionid,districtid,thanaid},
      dataType: "JSON",
        success:function(data) {
           if(data){
            $('#district_id').html(null);
           $('#thana_id').html(null);
                   $.each(data.dis, function(key, value){
                      // console.log(districtid);
                       if(value.id==districtid){
                        $('#district_id').append('<option value="'+value.id+'" selected>' + value.district + '</option>');
                       }else{
                        $('#district_id').append('<option value="'+value.id+'">' + value.district + '</option>');
                       }
 
                    });
                   
                    $.each(data.than, function(key, value){
                       // console.log(thanaid)
                        if(value.id==thanaid){
                        $('#thana_id').append('<option value="'+value.id+'" selected>' + value.thana + '</option>');
                       }else{
                        $('#thana_id').append('<option value="'+value.id+'">' + value.thana + '</option>');
                       }
                       
                    });
                    $.each(data.area, function(key, value){
                       // console.log(thanaid)
                        if(value.id==areaid){
                        $('#area_id').append('<option value="'+value.id+'" selected>' + value.areaname + '</option>');
                       }else{
                        $('#area_id').append('<option value="'+value.id+'">' + value.areaname + '</option>');
                       }
                       
                    });
                   
                }

            },
    });



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
                   console.log(data);
                    $.each(data, function(key, value){
                       // alert(key);
                        $('#district_id').append('<option value="'+value.id+'">' + value.district + '</option>');

                    });
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

        var total=isNaN((Number($("#monthlyrent").val()) + Number($("#due").val()) + Number($("#addicrg").val()))-(Number($("#advance").val())+Number($("#discount").val())))? 0 :((Number($("#monthlyrent").val()) + (Number($("#due").val()) + Number($("#addicrg").val()))-(Number($("#advance").val())+Number($("#discount").val()))))+((Number($("#monthlyrent").val())+Number($("#addicrg").val())) *  Number($("#vat").val()))/100;
        $("#total").val(total);
       
    });



});

  </script>
  @endsection