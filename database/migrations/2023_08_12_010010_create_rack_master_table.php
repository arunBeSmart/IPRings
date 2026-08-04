<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRackMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rack_master', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('storage_location')->nullable();
            $table->string('rack_id')->nullable();
            
            $table->string('bin_no')->nullable();
            $table->string('bin_name')->nullable();
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
        Schema::dropIfExists('rack_master');
    }
}
