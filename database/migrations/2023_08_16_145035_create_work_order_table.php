<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_order', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('order')->nullable();
            $table->date('posting_date')->nullable();
            $table->bigInteger('material_code')->nullable();
            $table->string('material_description')->nullable();
            $table->bigInteger('yield_qty')->nullable();
            $table->string('CUSTOMER_PART_NO')->nullable();
            $table->string('HEAT_CODE')->nullable();
            $table->string('IPR_REF')->nullable();
            $table->string('CUSTOMER_NAME')->nullable();
            $table->integer('SCANNED_QTY')->nullable();
            $table->integer('PACKING_FACTOR')->nullable();
            $table->integer('MASTER_PACKING_FACTOR')->nullable();
            $table->integer('BALANCE_QTY')->nullable();
            $table->integer('STATUS')->nullable();
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work_order');
    }
}
