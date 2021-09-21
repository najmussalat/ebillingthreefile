<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable=[
        'customer_id',
        'monthlyrent',
        'due',
        'addicrg',
        'discount',
        'advance',
        'vat',
        'paid',
        'total',
        
    ];
    protected $casts = [
		'created_at' => 'datetime:M d Y',
		'updated_at' => 'datetime:M d Y',
	];
    public function collection()
    {
        return $this->hasMany('App\Models\Collection');
    }
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }
}
