<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $fillable=[
        'bill_id',
        'admin_id',
        'user_id',
        'paid',
        'payby_id',
        'note',
        'created_at',
    ];
    protected $casts = [
		'created_at' => 'datetime:M d Y',
		'updated_at' => 'datetime:M d Y',
	];
    public function bill()
{
	return $this->belongsTo('App\Models\Bill')->ordeBy('created_at','DESC');
}
public function admin()
{
    return $this->belongsTo('App\Models\Admin');
}
public function payby()
{
    return $this->belongsTo('App\Models\Payby');
}
}
