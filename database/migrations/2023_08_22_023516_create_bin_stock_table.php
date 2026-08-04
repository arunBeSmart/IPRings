<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBinStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bin_stock', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('WORK_ORDER_ID')->nullable();
            $table->bigInteger('PRIMARY_ID')->nullable();
            $table->bigInteger('SECONDARY_ID')->nullable();
            $table->bigInteger('MASTER_ID')->nullable();
            $table->bigInteger('QTY')->nullable();
            $table->integer('PACKING_FACTOR')->nullable();
            $table->integer('MASTER_PACKING_FACTOR')->nullable();
            $table->integer('STORAGE_LOCATION_ID')->nullable();
            $table->integer('RACK_MASTER_ID')->nullable();
            $table->string('CUSTOMER_NAME')->nullable();
            $table->string('CUSTOMER_PART_NO')->nullable();
            $table->string('MATRIAL_CODE')->nullable();
            $table->string('MATERIAL_DESCRIPTION')->nullable();
            $table->integer('ACTIVE')->nullable();
            $table->integer('DISPATCHED')->nullable();
            $table->integer('INVOICE_ID')->nullable();
            $table->integer('LOCKED')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bin_stock');
    }
}
