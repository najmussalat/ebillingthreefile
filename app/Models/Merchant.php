<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasFactory;
    protected $fillable=[
        'merchantname',
        'status',
    ];
    public function package()
    {
        return $this->hasMany('App\Models\Package');
    }
}
