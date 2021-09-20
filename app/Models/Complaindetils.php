<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaindetils extends Model
{
    use HasFactory;

    public function complain()
    {
        return $this->belongsTo('App\Models\Complain');
    }
}
