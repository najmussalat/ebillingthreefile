<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use SoftDeletes;
        protected $dates = ['deleted_at'];
         protected $guard = 'api';
        protected $fillable = ['admin_id',
            'name','username','phone','email','image','otp','api_token' ];

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


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}