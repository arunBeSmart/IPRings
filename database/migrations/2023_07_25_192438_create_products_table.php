<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('product_name')->nullable();
            $table->string('Customer_name')->nullable();
            $table->string('Customer_part_no')->nullable();
            $table->integer('material_code')->nullable();
            $table->string('ipr_Ref_no' )->nullable();
            $table->double('Qty',10)->nullable();
            $table->double('packing_factor',10)->nullable();
            $table->double('master_packing_factor',10)->nullable();
            $table->double('Min_Weight',10,3)->nullable();
            $table->double('Max_Weight',10,3)->nullable();
            $table->string('REMARKS')->nullable();
            $table->string('MODEL')->nullable();$table->string('REV_LEVEL')->nullable();
            $table->string('ACTIVE')->nullable();
            $table->integer('updated_by')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
