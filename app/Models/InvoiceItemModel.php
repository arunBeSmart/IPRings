<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItemModel extends Model
{
    use HasFactory;
    protected $table='invoice_items';
}
