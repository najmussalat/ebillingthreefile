<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
	use SoftDeletes, Notifiable;
	protected $fillable=[
	'loginid',
	'customername',
	'contactperson',
	'email',
	'customermobile',
	'customeraltmobile',
	'customerprofession',
	'buildingname',
	'idnumber',
	'idnumbertype',
	'otheridtype',
	'houseno',
	'floor',
	'post',
	'apt',
	'connectiondate',
	'mikrotic_id',
	'ip',
	'type_id',
	'profile_id',
	'mac',
	'sqn',
	'secretname',
	'interfacename',
	'scrtnamepass',
	'bandwidth',
	'ppcomment',
	'remoteaddress',
	'comment',
	'atd_day',
	'atd_month',
	'monthlyrent',
	'due',
	'addicrg',
	'discount',
	'advance',
	'vat',
	'total',
	'prepaidpostpaid',
	'connection',
	'connectivity',
	'clienttype',
	'dlp',
	'description',
	'connectedby',
	'admin_id',
	'country_id',
	'division_id',
	'district_id',
	'thana_id',
	'area_id',
	'package_id',
	'note',
	'photo',
	'infoimage',
	'path',
	'status',
	'password'
	];
	protected $hidden = [
		'password', 'remember_token',
	];
	protected $dates = ['deleted_at'];
	protected $casts = [
		'created_at' => 'datetime:M d Y',
	];
public static function boot()
{
    parent::boot();
    self::creating(function ($model) {
       $model->loginid = IdGenerator::generate(['table' => 'customers','field'=>'loginid', 'length' => 8, 'prefix' =>'NAQW']);
    });
}
public function package()
{
	return $this->belongsTo('App\Models\Package');
}

public function district()
{
	return $this->belongsTo('App\Models\District');
}
public function thana()
{
	return $this->belongsTo('App\Models\Thana');
}
public function area()
{
	return $this->belongsTo('App\Models\Area');
}

public function bill()
{
	return $this->hasMany('App\Models\Bill')->whereMonth('created_at', date('m'))
	->whereYear('created_at', date('Y'));
}
public function complain()
{
	return $this->hasMany('App\Models\Complain');
}
}