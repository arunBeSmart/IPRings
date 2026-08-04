<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productsModel extends Model
{
    use HasFactory;
    protected $table="products";
    protected $fillable = ['Customer_name',	'product_name',	'Customer_part_no',	'ipr_Ref_no' ,	'Qty',	'packing_factor',	'Min_Weight',	'Max_Weight'
    ,'REMARKS','REV_LEVEL',
        
    ];
}
