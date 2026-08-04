<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('BILLING_DOCUMENT')->nullable();
            $table->date('BILLING_DATE')->nullable();
            $table->string('BILLING_DOCUMENT_TYP')->nullable();
            $table->string('BILLING_DES')->nullable();
            $table->string('COMPANY_CODE')->nullable();
            $table->string('SALES_ORDER')->nullable();
            $table->string('SALES_ORDER_ITEM')->nullable();
            $table->string('CUSTOMER_NO')->nullable();
            $table->string('CUSTOMER_NAME')->nullable();
            $table->string('CUSTOMER_PO_No')->nullable();
            $table->dateTime('CUSTOMER_PO_Date')->nullable();
            $table->string('SALES_ORGANISATION')->nullable();
            $table->string('DISTRIBUTION_CHANNEL')->nullable();
            $table->string('DIVISION')->nullable();
            $table->string('PLANT')->nullable();
            $table->string('ITEM_CODE')->nullable();
            $table->string('MATERIAL_NAME')->nullable();
            $table->string('MATERIAL_DESCRIPTION')->nullable();
            $table->string('CUSTOMER_PART_NUMBER')->nullable();
            $table->string('CUSTOMER_PART_NAME')->nullable();
            $table->string('IPR_REF')->nullable();
            $table->string('INCOTERMS')->nullable();
            $table->string('HSN/SAC')->nullable();
            $table->string('COUNTRY_NAME')->nullable();
            $table->string('REGION')->nullable();
            $table->string('ITEM_VALUE')->nullable();
            $table->string('DISCOUNT__PERCENT')->nullable();
            $table->bigInteger('BILLED_QTY')->nullable();            
            $table->integer('PACKING_FACTOR')->nullable();
            $table->integer('master_packing_factor')->nullable();
            $table->integer('PACKING_BOX_COUNT')->nullable();
            $table->string('ITEM_TOTALVALUE')->nullable();
            $table->string('DISCOUNTED_VALUE')->nullable();
            $table->string('TOTAL_VALUE_AFTER_DI')->nullable();
            $table->string('CURRANCY')->nullable();
            $table->string('FI_DOCUMENT')->nullable();
            $table->string('EXCHANGE_RATE')->nullable();
            $table->string('FINAL_VALUE')->nullable();
            $table->string('JOIG_PERCENT')->nullable();
            $table->string('JOIG_TAX_VALUE')->nullable();
            $table->string('JOCG_PERCENT')->nullable();
            $table->string('JOCG_TAX_VALUE')->nullable();
            $table->string('JOSG_PERCENT')->nullable();
            $table->string('JOSG_TAX_VALUE')->nullable();
            $table->string('TOTAL_TAX_ITEM_WISE')->nullable();
            $table->string('PACKING_COST')->nullable();
            $table->string('TOTAL_PACKING_COST')->nullable();
            $table->string('TOTAL_TCS/SALE')->nullable();
            $table->string('TCS_TAX/SALES_PERCENT')->nullable();
            $table->string('TCS_TAX_/SCRAP_PERCENT')->nullable();
            $table->string('TOTAL_TCS/SCRAP')->nullable();
            $table->string('TOTAL_INV_VALUE')->nullable();
            $table->string('IRN_NO')->nullable();
            $table->string('TRANSPORTER_NAME')->nullable();
            $table->string('TRANSPORT_MODE')->nullable();
            $table->string('TRANSPORTER_NO')->nullable();
            $table->dateTime('TRANSPORT_DATE')->nullable();
            $table->string('VECHILE_NO')->nullable();
            $table->string('EWAY_BILL_NO')->nullable();
            $table->dateTime('EWAY_BILL_DT')->nullable();
            $table->string('LR_NO')->nullable();
            $table->dateTime('LR_DATE')->nullable();
            $table->string('GRN_NO')->nullable();
            $table->dateTime('GRN_DATE')->nullable();
            $table->string('REMARKS')->nullable();
            $table->bigInteger('SCANNED_QTY')->nullable();
            $table->string('STATUS')->nullable();
            $table->string('HEAT_CODE')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice');
    }
}
