<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WOdirect2InvoiceModel extends Model
{
    use HasFactory;
    protected $table="WOdirect2Invoice";
    protected $fillable = ['CUSTOMER_PART_NUMBER','IPR_REF_NO','WORK_ORDER_ID','INVOICE_ID','QTY','QRCODE_VALUE','CANCEL']; 
}
