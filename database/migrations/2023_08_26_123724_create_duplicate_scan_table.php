<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDuplicateScanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('duplicate_scan', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('work_order_id')->nullable();
            $table->string('barcode_value')->nullable();
            $table->string('barcode_type')->nullable();
            $table->integer('emp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('duplicate_scan');
    }
}
