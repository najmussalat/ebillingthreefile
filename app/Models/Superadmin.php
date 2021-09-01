<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Superadmin extends  Authenticatable 
{
    use  Notifiable;
    
       
       //use SoftDeletes;

       protected $guard = 'superadmin';
        protected $dates = ['deleted_at'];
       
        
        protected $fillable = ['superadminname',
            'image','phone','email','deleted_at','remember_token'
        ];

        protected $hidden = [
            'password', 'remember_token',
        ];
        public function admin()
        {
            return $this->hasMany('App\Admin');
        }
        
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
   
    }