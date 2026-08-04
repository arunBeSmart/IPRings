<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStorageLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storage_location', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('location_code',255)->nullable();
            $table->string('location_name',255)->nullable();
            $table->string('createdby',255)->nullable();
            $table->string('active',1)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('storage_location');
    }
}
