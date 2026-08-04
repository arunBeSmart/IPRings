<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackingAmendedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packing_amended', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('SALE_ORDER')->nullable();
            $table->string('SALE_ORDER_ITEM')->nullable();
            $table->integer('INVOICE_ID')->nullable();
            $table->string('CUSTOMER_PART_NUMBER')->nullable();
            $table->string('CUSTOMER_NAME')->nullable();
            $table->integer('OLD_PACKING_FACTOR')->nullable();
            $table->integer('AMENDED_PACKING_FACTOR')->nullable();
            $table->integer('OLD_MASTER_PACKING_FACTOR')->nullable();
            $table->integer('AMENDED_MASTER_PACKING_FACTOR')->nullable();
            $table->integer('OLD_BOX_COUNT')->nullable();
            $table->integer('AMENDED_BOX_COUNT')->nullable();
            $table->integer('AMENDED_BY')->nullable()   ;        

                });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packing_amended');
    }
}
