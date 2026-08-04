<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packing_amended_model extends Model
{
    use HasFactory;
    protected $table='packing_amended';
    protected $fillable=['SALE_ORDER','SALE_ORDER_ITEM','INVOICE_ID','CUSTOMER_PART_NUMBER','CUSTOMER_NAME',
'OLD_PACKING_FACTOR','AMENDED_PACKING_FACTOR','OLD_BOX_COUNT','AMENDED_BOX_COUNT','AMENDED_BY'];
}
