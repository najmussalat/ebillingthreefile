<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaintext extends Model
{
    use HasFactory;
    protected $fillable=['complaintitle','admin_id'];
}
