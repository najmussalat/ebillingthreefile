<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payby extends Model
{
    protected $fillable=[
        'admin_id',
        'user_id',
        'paybyname',
        'description'
        
    ];

    public function collection()
    {
        return $this->hasOne('App\Models\Collection');
    }
}
