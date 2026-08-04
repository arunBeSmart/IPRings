<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DuplicateScanModel extends Model
{
    use HasFactory;
    protected $table='duplicate_scan';
    protected $fillable = ['barcode_value',	'barcode_type',	
    'emp',	'work_order_id', ];
}
