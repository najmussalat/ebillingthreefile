<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable=[
        
        'category' ,'id'      
        ];

        public function blog()
        {
            return $this->hasOne('App\Models\Blog');
        }
}
