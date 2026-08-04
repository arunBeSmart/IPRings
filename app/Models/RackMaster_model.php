<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RackMaster_model extends Model
{
    use HasFactory;
    protected $table="rack_master";
    protected $fillable = ['storage_location',	'rack_id',	'bin_no',	'bin_name' ,	'active', ];
}
