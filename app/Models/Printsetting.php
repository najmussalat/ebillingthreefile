<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Printsetting extends Model
{
    protected $fillable=[
        'admin_id',
        'user_id',
       'customtext',
        'papersetting',
        'singnature',
        
        
    ];
}
