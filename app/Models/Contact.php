<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
  use SoftDeletes;
  protected $dates = ['deleted_at'];
  protected $fillable=[
        
     'admin_id','superadmin_id','email','name','subject','reply','message','status'       
        ];
}
