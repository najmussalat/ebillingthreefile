<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable=[
        'thana_id','areaname','admin_id'
    ];
    
    public function thana()
    {
        return $this->belongsTo('App\Models\Thana');
    }
    public function customer()
    {
        return $this->hasMany('App\Models\Customer');
    }
}
