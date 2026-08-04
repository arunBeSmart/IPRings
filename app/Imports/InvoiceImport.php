<?php

namespace App\Imports;

use App\Models\InvoiceModel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class InvoiceImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

     //////
      /**
             * Transform a date value into a Carbon object.
             *
             * @return \Carbon\Carbon|null
             */
            public function transformDate($value, $format = 'Y-m-d')
            {
                try {
                    return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
                } catch (\ErrorException $e) {
                    return \Carbon\Carbon::createFromFormat($format, $value);
                }
            }
    //////////////////////
    
    public function model(array $row)
    {
        if(isset($COUNT)){}else {$COUNT=0;}
        
        //echo "<br>".$this->transformDate($row['billing_date']);
        
    
    $selectQ=InvoiceModel::where('BILLING_DOCUMENT','=',$row['billing_document'])
       ->where('BILLING_DATE','=',$this->transformDate($row['billing_date']))
       ->where('SALES_ORDER','=',$row['sales_order'])
       ->where('SALES_ORDER_ITEM','=',$row['sales_order_item'])
       ->where('CUSTOMER_NO','=',$row['customer_no'])
       ->where('CUSTOMER_PART_NUMBER','=',$row['customer_part_number'])
       ->where('ITEM_CODE','=',$row['item_code'])
       ->where('PLANT','=',$row['plant'])
       ->where('BILLED_QTY','=',$row['billed_qty'])->count();
       if(($selectQ==0 or $selectQ=='' ) and ($row['sales_order']!='' and $row['sales_order_item']!=''))
       {
        
echo "<br>".$InvoiceModel=  new InvoiceModel([
                        
                    "BILLING_DOCUMENT" 	 =>$row['billing_document'], 
                    "BILLING_DATE" 	    =>$this->transformDate($row['billing_date']), 
                    "BILLING_DOCUMENT_TYP" 	    =>$row['billing_document_typ'], 
                    "BILLING_DES" 	    =>$row['billing_des'], 
                    "COMPANY_CODE" 	    =>$row['company_code'], 
                    "SALES_ORDER" 	    =>$row['sales_order'], 
                    "SALES_ORDER_ITEM" 	    =>$row['sales_order_item'], 
                    "CUSTOMER_NO" 	    =>$row['customer_no'], 
                    "CUSTOMER_NAME" 	    =>$row['customer_name'], 
                    "CUSTOMER_PO_No" 	    =>$row['customer_po_no'], 
                    "CUSTOMER_PO_Date" 	    =>$this->transformDate($row['customer_po_date']), 
                    "SALES_ORGANISATION" 	    =>$row['sales_organisation'], 
                    "DISTRIBUTION_CHANNEL" 	    =>$row['distribution_channel'], 
                    "DIVISION" 	    =>$row['division'], 
                    "PLANT" 	    =>$row['plant'], 
                    "ITEM_CODE" 	    =>$row['item_code'], 
                    "MATERIAL_NAME" 	    =>$row['material_name'], 
                    "MATERIAL_DESCRIPTION" 	    =>$row['material_description'], 
                    "CUSTOMER_PART_NUMBER" 	    =>$row['customer_part_number'], 
                    "CUSTOMER_PART_NAME" 	    =>$row['customer_part_name'], 
                    "INCOTERMS" 	    =>$row['incoterms'], 
                    "HSN/SAC" 	    =>$row['hsnsac'], 
                    "COUNTRY_NAME" 	    =>$row['country_name'], 
                    "REGION" 	    =>$row['region'], 
                    "ITEM_VALUE" 	    =>$row['item_value'], 
                    "DISCOUNT__PERCENT" 	    =>$row['discount'], 
                    "BILLED_QTY" 	    =>$row['billed_qty'], 
                    "ITEM_TOTALVALUE" 	    =>$row['item_totalvalue'], 
                    "DISCOUNTED_VALUE" 	    =>$row['discounted_value'], 
                    "TOTAL_VALUE_AFTER_DI" 	    =>$row['total_value_after_di'], 
                    "CURRANCY" 	    =>$row['currancy'], 
                    "FI_DOCUMENT" 	    =>$row['fi_document'], 
                    "EXCHANGE_RATE" 	    =>$row['exchange_rate'], 
                    "FINAL_VALUE" 	    =>$row['final_value'], 
                    "JOIG_PERCENT" 	    =>$row['joig'], 
                    "JOIG_TAX_VALUE" 	    =>$row['joig_tax_value'], 
                    "JOCG_PERCENT" 	    =>$row['jocg'], 
                    "JOCG_TAX_VALUE" 	    =>$row['jocg_tax_value'], 
                    "JOSG_PERCENT" 	    =>$row['josg'], 
                    "JOSG_TAX_VALUE" 	    =>$row['josg_tax_value'], 
                    "TOTAL_TAX_ITEM_WISE" 	    =>$row['total_tax_item_wise'], 
                    "PACKING_COST" 	    =>$row['packing_cost'], 
                    "TOTAL_PACKING_COST" 	    =>$row['total_packing_cost'], 
                    "TOTAL_TCS/SALE" 	    =>$row['total_tcssale'], 
                    "TCS_TAX/SALES_PERCENT" 	    =>$row['tcs_taxsales'], 
                    "TCS_TAX_/SCRAP_PERCENT" 	    =>$row['tcs_tax_scrap'], 
                    "TOTAL_TCS/SCRAP" 	    =>$row['total_tcsscrap'], 
                    "TOTAL_INV_VALUE" 	    =>$row['total_inv_value'], 
                    "IRN_NO" 	    =>$row['irn_no'], 
                    "TRANSPORTER_NAME" 	    =>$row['transporter_name'], 
                    "TRANSPORT_MODE" 	    =>$row['transport_mode'], 
                    "TRANSPORTER_NO" 	    =>$row['transporter_no'], 
                    "TRANSPORT_DATE" 	    =>'', //$this->transformDate($row['transport_date']), 
                    "VECHILE_NO" 	    =>$row['vechile_no'], 
                    "EWAY_BILL_NO" 	    =>$row['eway_bill_no'], 
                    "EWAY_BILL_DT" 	    =>'', //$this->transformDate($row['eway_bill_dt']), 
                    "LR_NO" 	    =>$row['lr_no'], 
                    "LR_DATE" 	    =>'',//$this->transformDate($row['lr_date']), 
                    "GRN_NO" 	    =>$row['grn_no'], 
                    "GRN_DATE" 	    =>'',//$this->transformDate($row['grn_date']), 
                    "REMARKS" 	    =>$row['remarks'], 
                //    "IPR_REF" 	    =>$row['ipr_ref'], 
                //    "CUSTOMER_PART_NAME" 	    =>$row['customer_part_name'],   
                                 ]);
        
                         $InvoiceModel->save();
                         $COUNT++;


       }


              

        
    }
}
