<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StorageLocation_model extends Model
{
    use HasFactory;
    protected $table="storage_location";
    protected $fillable = ['location_code',	'location_name',	'active',	 ];
}
