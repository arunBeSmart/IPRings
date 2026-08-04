<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarcodeMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barcode_master', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            
            $table->integer('INVOICE_ID')->nullable();
            $table->integer('WORK_ORDER_ID')->nullable();
            $table->string('SALE_ORDER')->nullable();
            $table->string('SALE_ORDER_ITEM')->nullable();
            $table->string('CUSTOMER_NAME')->nullable();
            $table->string('CUSTOMER_PART_NUMBER')->nullable();
            $table->string('PART_NUMBER')->nullable();
            $table->integer('QUANTITY')->nullable();
            $table->string('SUPPLIER')->nullable();
            $table->string('VENDOR_BATCH')->nullable();
            $table->string('PART_DESCRIPTION')->nullable();
            $table->string('DELIVERY_NOTE')->nullable();
            $table->string('HEAT_LOT')->nullable();
            $table->string('HEAT_CODE')->nullable();
            $table->string('REV_LEVEL')->nullable();
            $table->string('DATE_MFG')->nullable();
            $table->string('DATE_SHIPPED')->nullable();
            $table->string('EMP')->nullable();
            $table->string('FROM_ADDRESS')->nullable();
            $table->string('TO_ADDRESS')->nullable();
            $table->string('VALUE',255)->nullable();
            $table->integer('APPROVED')->nullable();
            $table->integer('CANCEL')->nullable();
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barcode_master');
    }
}
