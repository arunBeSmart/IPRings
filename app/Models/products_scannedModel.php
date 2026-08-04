<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products_scannedModel extends Model
{
    use HasFactory;
    protected $table='products_scanned';
    protected $fillable=['SALE_ORDER','SALE_ORDER_ITEM','PRODUCT_BARCODE','INVOICE_ID'];

}
