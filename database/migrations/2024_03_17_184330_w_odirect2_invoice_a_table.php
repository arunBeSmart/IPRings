<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class WOdirect2InvoiceATable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('WOdirect2Invoice', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('CUSTOMER_PART_NUMBER')->nullable();
            $table->string('IPR_REF_NO')->nullable();
            $table->bigInteger('WORK_ORDER_ID')->nullable();
            $table->bigInteger('INVOICE_ID');
            $table->bigInteger('QTY');
            $table->string('QRCODE_VALUE');
            $table->bigInteger('CANCEL');

            //'CUSTOMER_PART_NUMBER','IPR_REF_NO','WORK_ORDER_ID','INVOICE_ID','QTY','QRCODE_VALUE','CANCEL'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('WOdirect2Invoice');
    }
}
