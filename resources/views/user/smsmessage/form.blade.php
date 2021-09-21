<div class="row card">
 
        <div class="col m12 s12 file-field input-field">
            New Customer Sent SMS 
            <p>
                <label>
                    <input class="with-gap" name="newcustomer" value="1" type="radio" {{ ($smsmessage->newcustomer=="1")? "checked" : "" }} />
                    <span>Yes</span>
                    </label>
                    <label>
                    <input class="with-gap" name="newcustomer" value="0" type="radio" {{ ($smsmessage->newcustomer=="0")? "checked" : "" }}  />
                    <span>No</span>
                    </label>
            </p>
            </div>
            <div class="input-field col s12">
        
                {!!Form::textarea('newcustomermessage',null, array('id'=>'newcustomermessage','class'=>'materialize-textarea', 'data-length'=>'160','rows' => 4, 'cols' => 54,'required'))!!}
               
              
    </div>
    
   
</div>

<div class="row card">
 
    <div class="col m12 s12 file-field input-field">
        Billing Sent SMS 
        <p>
            <label>
                <input class="with-gap" name="billing" value="1" type="radio" {{ ($smsmessage->billing=="1")? "checked" : "" }} />
                <span>Yes</span>
                </label>
                <label>
                <input class="with-gap" name="billing" value="0" type="radio" {{ ($smsmessage->billing=="0")? "checked" : "" }}  />
                <span>No</span>
                </label>
        </p>
        </div>
        <div class="input-field col s12">
    
            {!!Form::textarea('billingmessage',null, array('id'=>'billingmessage','class'=>'materialize-textarea', 'data-length'=>'160','rows' => 4, 'cols' => 54,'required'))!!}
           
          
</div>
</div>

<div class="row card">
 
    <div class="col m12 s12 file-field input-field">
        Payment Sent SMS 
        <p>
            <label>
                <input class="with-gap" name="payment" value="1" type="radio" {{ ($smsmessage->payment=="1")? "checked" : "" }} />
                <span>Yes</span>
                </label>
                <label>
                <input class="with-gap" name="payment" value="0" type="radio" {{ ($smsmessage->payment=="0")? "checked" : "" }}  />
                <span>No</span>
                </label>
        </p>
        </div>
        <div class="input-field col s12">
    
            {!!Form::textarea('paymentmessage',null, array('id'=>'paymentmessage','class'=>'materialize-textarea', 'data-length'=>'160','rows' => 4, 'cols' => 54,'required'))!!}
           
          
</div>

</div>
<div class="row card">
 
    <div class="col m12 s12 file-field input-field">
        Complain  Sent SMS 
        <p>
            <label>
                <input class="with-gap" name="openticket" value="1" type="radio" {{ ($smsmessage->openticket=="1")? "checked" : "" }} />
                <span>Yes</span>
                </label>
                <label>
                <input class="with-gap" name="openticket" value="0" type="radio" {{ ($smsmessage->openticket=="0")? "checked" : "" }}  />
                <span>No</span>
                </label>
        </p>
        </div>
        <div class="input-field col s12">
    
            {!!Form::textarea('openticketmessage',null, array('id'=>'openticketmessage','class'=>'materialize-textarea', 'data-length'=>'160','rows' => 4, 'cols' => 54,'required'))!!}
           
          
</div>

</div>
<div class="row card">
 
    <div class="col m12 s12 file-field input-field">
        Complain Aprove Sent SMS 
        <p>
            <label>
                <input class="with-gap" name="assignticket" value="1" type="radio" {{ ($smsmessage->assignticket=="1")? "checked" : "" }} />
                <span>Yes</span>
                </label>
                <label>
                <input class="with-gap" name="assignticket" value="0" type="radio" {{ ($smsmessage->assignticket=="0")? "checked" : "" }}  />
                <span>No</span>
                </label>
        </p>
        </div>
        <div class="input-field col s12">
    
            {!!Form::textarea('assignticketmessage',null, array('id'=>'assignticketmessage','class'=>'materialize-textarea', 'data-length'=>'160','rows' => 4, 'cols' => 54,'required'))!!}
           
          
</div>

</div>
<div class="row card">
 
    <div class="col m12 s12 file-field input-field">
        Complain Update Sent SMS 
        <p>
            <label>
                <input class="with-gap" name="updateticket" value="1" type="radio" {{ ($smsmessage->updateticket=="1")? "checked" : "" }} />
                <span>Yes</span>
                </label>
                <label>
                <input class="with-gap" name="updateticket" value="0" type="radio" {{ ($smsmessage->updateticket=="0")? "checked" : "" }}  />
                <span>No</span>
                </label>
        </p>
        </div>
        <div class="input-field col s12">
    
            {!!Form::textarea('updateticketmessage',null, array('id'=>'updateticketmessage','class'=>'materialize-textarea', 'data-length'=>'160','rows' => 4, 'cols' => 54,'required'))!!}
           
          
</div>

</div>
<div class="row card">
 
    <div class="col m12 s12 file-field input-field">
        Complain Close Sent SMS 
        <p>
            <label>
                <input class="with-gap" name="closeticket" value="1" type="radio" {{ ($smsmessage->closeticket=="1")? "checked" : "" }} />
                <span>Yes</span>
                </label>
                <label>
                <input class="with-gap" name="closeticket" value="0" type="radio" {{ ($smsmessage->closeticket=="0")? "checked" : "" }}  />
                <span>No</span>
                </label>
        </p>
        </div>
        <div class="input-field col s12">
    
            {!!Form::textarea('closeticketmessage',null, array('id'=>'closeticketmessage','class'=>'materialize-textarea', 'data-length'=>'160','rows' => 4, 'cols' => 54,'required'))!!}
           
          
</div>

</div>
<div class="row card">
    <div class="col m12 s12 file-field input-field">
        Any Other   SMS 
        <p>
            <label>
                <input class="with-gap" name="problem" value="1" type="radio" {{ ($smsmessage->problem=="1")? "checked" : "" }} />
                <span>Yes</span>
                </label>
                <label>
                <input class="with-gap" name="problem" value="0" type="radio" {{ ($smsmessage->problem=="0")? "checked" : "" }}  />
                <span>No</span>
                </label>
        </p>
        </div>
        <div class="input-field col s12">
    <p>Other</p>
            {!!Form::textarea('problemmessage',null, array('id'=>'problemmessage','class'=>'materialize-textarea', 'data-length'=>'160','rows' => 4, 'cols' => 54,'required'))!!}
           
          
</div>

</div>

