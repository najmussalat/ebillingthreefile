<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $fillable = [
       'id','d','country_id'
    ];
    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }
    public function district()
    {
        return $this->hasMany('App\Models\District');
    }
}
