<?php

namespace App\Models;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Customer extends Model
{
	use SoftDeletes;
	protected $fillable=[
	'uuid',
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
	'password'
	];
	protected $hidden = [
		'password', 'remember_token',
	];
	protected $dates = ['deleted_at'];
public static function boot()
{
    parent::boot();
    self::creating(function ($model) {
        $model->uuid = IdGenerator::generate(['table' => 'customers','field'=>'uuid', 'length' => 10, 'prefix' =>'ASA-']);
    });
}
}