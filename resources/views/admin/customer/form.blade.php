<h4 class="card-title">Personal Information</h4>


<div class="row">
    <div class="input-field col m6 s12">
        {!! Form::text('password', null, ['id' => 'loginpass', 'required']) !!}
        {!! Form::label('loginpass', ' * Login Password') !!}

    </div>

    <div class="input-field col m6 s12">
        {!! Form::text('repassword', null, ['id' => 'logtrtypepass', 'required']) !!}
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
    <div class="input-field col m6 s12">
        {!! Form::email('email', null, ['id' => 'email']) !!}
        {!! Form::label('email', 'Email') !!}

    </div>
    <div class="input-field col m6 s12">
        {!! Form::text('customerprofession', null, ['id' => 'customerprofession']) !!}
        {!! Form::label('customerprofession', 'Professional Detail') !!}
    </div>

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
    <div class="input-field col m4 s12">
        {!! Form::text('idnumber', null, ['id' => 'idnumber','required']) !!}
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
           <label>
            <input class="with-gap " name="idnumbertype" value="Other" type="radio" id="idnumbertype" />
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
           <select class="select2 browser-default" id="district_id" name="district_id" required>
                 <option  value="">Select District *</option>
               </select>
     </div>
         
    
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
{{-- {!! Form::select('package_id', , null, ['id' => 'package_id', 'placeholder' => 'Select One']) !!} --}}
<select name="package_id" id="package_id" placeholder="Select One">
    <option  selected disabled>Select One</option>
@foreach (CommonFx::Packageame() as  $value)
    <option value="{{$value->id}}">{{$value->packagename}} &nbsp; &nbsp; {{$value->packageprice}}</option>
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
{!! Form::number('totalshow', null, ['id' => 'total','disabled','step'=>'any']) !!}
<input type="hidden" name="total"  id="intotal" value="">
{{-- {!! Form::label('total', 'Total') !!} --}}

</div>
</div>

<h4 class="card-title">Official Information</h4>

<div class="row">
<div class="col m4 s12 file-field input-field">
Billing Type
<p>
    <label>
        <input class="with-gap" name="prepaidpostpaid" value="Prepaid" type="radio" checked/>
        <span>Pre Paid</span>
        </label>
        <label>
        <input class="with-gap" name="prepaidpostpaid" value="Postpaid" type="radio" />
        <span>Post Paid</span>
        </label>
</p>
</div>


<div class="col m4 s12 file-field input-field">
Type of Connection
<p>

    <label>
        <input class="with-gap" name="connection" value="Wired" type="radio" checked/>
        <span>Wired</span>
        </label>
        <label>
        <input class="with-gap" name="connection" value="Wireless" type="radio" />
        <span>Wireless</span>
        </label>
        

</p>
</div>
<div class="col m4 s12 file-field input-field">
Type of Connectivity
<p>


    <label>
        <input class="with-gap" name="connectivity" value="Shared" type="radio" checked/>
        <span>Shared</span>
        </label>
        <label>
        <input class="with-gap" name="connectivity" value="Dedicated" type="radio" />
        <span>Dedicated</span>
        </label>
        
</p>
</div>



</div>

<div class="row">
<div class="input-field col m6 s12">
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
{!! Form::select('connectedby',CommonFx::Connect(), null, ['id' => 'connectedby',  'placeholder' => 'Select Employee']) !!}
{!! Form::label('connectedby', 'Connected By') !!}
</div>

<div class="input-field col m4 s12">
{!! Form::text('sdeposite', null, ['id' => 'sdeposite']) !!}
{!! Form::label('sdeposite', 'Security Deposit') !!}

</div>
<div class="input-field col m4 s12">
    {!! Form::select('status', ['1' => 'Active', '2' => 'Pending'], 2, ['id' => 'status', 'class' => '']) !!}
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
