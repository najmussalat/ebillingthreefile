<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    protected $fillable=[
        
        'admin_id' ,'user_id','customer_id','complainheding','complainmessage','status'      
        ];
        protected $casts = [
            'created_at' => 'datetime:M d Y',
        ];
        public function admin()
        {
            return $this->belongsTo('App\Models\Admin');
        }
        public function customer()
        {
            return $this->belongsTo('App\Models\Customer');
        }
        public function complaindetils()
{
	return $this->hasMany('App\Models\Complaindetils');
}
}
