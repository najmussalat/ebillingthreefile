<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buysms extends Model
{
protected $fillable=[
    'superdmin_id',
    'admin_id',
    'payment_id',
    'payamount',
    'phone',
    'transections',
    'note',
    'status',
];
protected $casts = [
    'created_at' => 'datetime:M d Y',
];
public function admin()
    {
        return $this->belongsTo('App\Models\Admin');
    }
    public function payment()
    {
        return $this->belongsTo('App\Models\Payment');
    }

}
