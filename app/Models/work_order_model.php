<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class work_order_model extends Model
{
    use HasFactory;
    protected $table="work_order";
    protected $fillable = [
        'order',
        'posting_date',
        'material_code',
        'material_description',
        'yield_qty',
    ];
}
