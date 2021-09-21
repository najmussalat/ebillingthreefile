<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Authenticatable 
{
    use Notifiable;
    use SoftDeletes;
    use HasRoles;
 
        protected $dates = ['deleted_at'];
         protected $guard = 'user';
        protected $fillable = ['admin_id',
            'username','phone','email','image','remember_token','status','password' ];

        protected $hidden = [
            'password', 'remember_token',
        ];
        public function gender(){
            return $this->belongsTo('App\Gender');
        }
         public function admin(){
            return $this->belongsTo('App\Admin','admin_id','id');
        }
        
        public function accessories(){
            return $this->hasMany('App\Accessories');
        }

     
        public function status(){
            return $this->belongsTo('App\Status');
        }
        
        public function accounttype()
        {
            return $this->belongsTo('App\Accounttype');
        }
     
        public function userreview(){
            return $this->hasOne('App\Userreview');
            }
        
        protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    
}