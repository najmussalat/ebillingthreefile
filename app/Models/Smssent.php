<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Smssent extends Model
{
    use Notifiable;
    protected $fillable = [
        'admin_id',
        'user_id',
        'newcustomer',
        'newcustomermessage',
        'billing',
        'billingmessage',
        'payment',
        'paymentmessage',
        'openticket',
        'openticketmessage',
        'assignticket',
        'assignticketmessage',
        'updateticket',
        'updateticketmessage',
        'closeticket',
        'closeticketmessage',
        'problem',
        'employee',
        'employeemessage',
        'problemmessage',
        'username',
        'password',
        'smstype_id',
        'blance',
        'smsrate',
    ];

    public function admin()
    {
        return $this->belongsTo('App\Models\Admin');
    }
    public function smstype()
    {
        return $this->belongsTo('App\Models\Smstype');
    }
    
}
