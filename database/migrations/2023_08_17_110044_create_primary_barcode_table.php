<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrimaryBarcodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barcode_primary', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('INVOICE_ID')->nullable();
            $table->integer('WORK_ORDER_ID')->nullable();
            $table->string('SALE_ORDER')->nullable();
            $table->string('SALE_ORDER_ITEM')->nullable();
            $table->string('CUSTOMER_NAME')->nullable();
            $table->string('CUSTOMER_PART_NUMBER')->nullable();
            $table->string('IPR_REF')->nullable();
            $table->integer('SL_NO'); 
            $table->integer('QTY')->nullable();
            $table->decimal('WEIGHT',25,3)->nullable();
            $table->string('EMP')->nullable();
            $table->string('DATE')->nullable();
            $table->string('VALUE',255)->nullable();
            $table->integer('APPROVED')->nullable();
            $table->integer('SECONDARY')->nullable();
            $table->integer('MASTER')->nullable();
            $table->integer('CANCEL')->nullable();
            $table->integer('RACK_MASTER_ID')->nullable();
            $table->integer('DISPATCHED')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barcode_primary');
    }
}
