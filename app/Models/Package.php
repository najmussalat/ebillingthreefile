<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    protected $fillable=[
        'packagename',
        'packageprice',
        'description',
         'status',
    ];

    public function merchant()
    {
        return $this->belongsTo('App\Models\Merchant');
    }
}
