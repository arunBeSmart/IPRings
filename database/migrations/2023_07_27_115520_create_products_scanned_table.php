<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsScannedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_scanned', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('SALE_ORDER')->nullable();
            $table->string('SALE_ORDER_ITEM')->nullable();
            $table->string('PRODUCT_BARCODE')->nullable();
            $table->string('PRIMARY_BARCODE')->nullable();
            $table->string('SECONDARY_BARCODE')->nullable();
            $table->string('CUSTOMER_PART_NO')->nullable();
            $table->integer('INVOICE_ID')->nullable();
            $table->bigInteger('WORK_ORDER_ID')->nullable();
            $table->integer('PRIMARY_BARCODE_APPROVED')->nullable();
            $table->integer('CANCEL')->nullable();
            $table->integer('VISION_PERCENT')->nullable();
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_scanned');
    }
}
