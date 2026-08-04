<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\barcodePrimary_model;
use App\Models\barcodeSecondary_model;
use App\Models\MasterBarcode_model;
use App\Models\InvoiceModel;
use App\Models\InvoiceItemModel;
use App\Models\Packing_amended_model;
use App\Models\productsModel;
use App\Models\products_scannedModel;
use App\Models\RackMaster_model;
use App\Models\ScanDATA_model;
use App\Models\StorageLocation_model;
use App\Models\work_order_model;
use App\Models\BinStockModel;
use App\Models\DuplicateScanModel;
use App\Models\UsersModel;

class DashboardController extends Controller
{
    //
    public function dashboardView()
    {
        $DATA=productsModel::orderBy('ipr_Ref_no')->get();
        $DATA=compact('DATA'); 
       return view('welcome')->with($DATA); 
    }
    public function getDashboardView(Request $request)
    {
       $product_id=$request['product_id'];
       $report_type=$request['report_type'];
      if($report_type=='FROM_TO')
      { // fromDate,toDate
        $fromDate=  $request['fromDate'];
        $toDate= $request['toDate'];
    }elseif($report_type=='MONTHLY')
      { //trnMonth, 
        if($request['trnMonth']<10)
        {$request['trnMonth']="0".$request['trnMonth'];}
        
        $request['trnYear'];
        $fromDate=$request['trnYear'].'-'.$request['trnMonth'].'-01';
        $toDate= date("Y-m-t", strtotime($fromDate));
    }else
      {   $request['trnYear'];
        $fromDate=$request['trnYear'].'-01-01';
        $toDate=$request['trnYear'].'-12-31';
    }
    $PRODUCTS_ARRAY=productsModel::where('id','=',$product_id)->get();
    foreach($PRODUCTS_ARRAY as $PRODUCTS)
    {
    $customer_part_number=$PRODUCTS->Customer_part_no;  
    $IPR_Ref=$PRODUCTS->ipr_Ref_no;
    $Customer_name=$PRODUCTS->Customer_name;
    $product_name=$PRODUCTS->product_name;
    $SCAN_TYPE=$PRODUCTS->SCAN_TYPE;
    }
    //echo "<br>".$fromDate;
     //echo "<br>".$toDate;
        $INVOICES=InvoiceModel::where('CUSTOMER_PART_NUMBER','=',$customer_part_number)
        ->where('BILLING_DATE','>=',$fromDate)
        ->where('BILLING_DATE','<=',$toDate)
        ->count();
        $WORKORDERS=work_order_model::where('CUSTOMER_PART_NO','=',$customer_part_number)
        ->where('posting_date','>=',$fromDate)
        ->where('posting_date','<=',$toDate)
        ->count();
        $AMENDS=work_order_model::join('packing_amended','work_order.id','=','packing_amended.WORK_ORDER_ID')
        ->where('work_order.CUSTOMER_PART_NO','=',$customer_part_number)
        ->where('work_order.posting_date','>=',$fromDate)
        ->where('work_order.posting_date','<=',$toDate)
        ->count();
        $DUPLICATES=DuplicateScanModel::where('created_at','>=',$fromDate)
        ->where('created_at','<=',$toDate)
        ->where('barcode_value','like','%'.$customer_part_number.'%')->
        count();
        $AMENDS1=Packing_amended_model::count();
       //  $SCAN_TYPE;
       if($SCAN_TYPE=='PRIMARY')
       {$PACKED_QTY=barcodePrimary_model::
        where('created_at','>=',$fromDate)
        ->where('created_at','<=',$toDate)
        ->where('CUSTOMER_PART_NUMBER','=',$customer_part_number)
        ->whereNull('CANCEL') 
        ->sum('QTY');  }
       elseif($SCAN_TYPE=='SECONDARY')
       {$PACKED_QTY=barcodeSecondary_model::select('sum(QTY)')
        ->where('created_at','>=',$fromDate)
        ->where('created_at','<=',$toDate)
        ->where('CUSTOMER_PART_NUMBER','=',$customer_part_number)
        ->whereNull('CANCEL') 
        ->sum('QTY');  }
       elseif($SCAN_TYPE=='PART')
       {$PACKED_QTY=products_scannedModel::where('created_at','>=',$fromDate)
        ->where('created_at','<=',$toDate)
        ->where('CUSTOMER_PART_NO','=',$customer_part_number)
        ->whereNull('CANCEL') 
        ->count();}
       else
       {}
       $YIELD_QTY=work_order_model::where('CUSTOMER_PART_NO','=',$customer_part_number)
       ->sum('yield_qty');
       $SCANNED_QTY=work_order_model::where('CUSTOMER_PART_NO','=',$customer_part_number)
       ->sum('SCANNED_QTY');
       $INWARD_AWAITING_PACKING_QTY=$YIELD_QTY-$SCANNED_QTY;
       $FG_INWARD_QTY=work_order_model::where('CUSTOMER_PART_NO','=',$customer_part_number)
        ->where('posting_date','>=',$fromDate)
        ->where('posting_date','<=',$toDate)
        ->sum('yield_qty');
        $INVOICE_DISPATCHED_QTY=InvoiceModel::where('CUSTOMER_PART_NUMBER','=',$customer_part_number)
        ->where('updated_at','>=',$fromDate)
        ->where('updated_at','<=',$toDate)
        ->sum('SCANNED_QTY');
        $BILLED_QTY=InvoiceModel::where('CUSTOMER_PART_NUMBER','=',$customer_part_number)
        ->sum('BILLED_QTY');
        $BILL_DISPATCHED_QTY=InvoiceModel::where('CUSTOMER_PART_NUMBER','=',$customer_part_number)
        ->sum('SCANNED_QTY');
        $SALES_VALUE_OF_MONTH=InvoiceModel::where('CUSTOMER_PART_NUMBER','=',$customer_part_number)
        ->where('updated_at','>=',$fromDate)
        ->where('updated_at','<=',$toDate)
        ->where('STATUS','=','COMPLETED')
        ->sum('SCANNED_QTY');
        $VALUE_OF_FINISHED_GOODS=work_order_model::where('CUSTOMER_PART_NO','=',$customer_part_number)
        ->where('posting_date','>=',$fromDate)
        ->where('posting_date','<=',$toDate)
        ->sum('yield_qty');
        
        $INVOICE_QTY_NEED_AFTER_PACKING=$BILLED_QTY-$BILL_DISPATCHED_QTY;
        $QTY_HOLD_REQ_LONG_TERM_QTY= $SALES_PLAN_OF_MONTH=0;
        

        $DATA=[
            'INVOICES'=>$INVOICES,
            'WORKORDERS'=>$WORKORDERS,
            'DUPLICATES'=>$DUPLICATES,
            'AMENDS'=>$AMENDS,
            'PACKED_QTY'=>$PACKED_QTY,
            'INWARD_AWAITING_PACKING_QTY'=>$INWARD_AWAITING_PACKING_QTY,
            'FG_INWARD_QTY'=>$FG_INWARD_QTY,
            'INVOICE_DISPATCHED_QTY'=>$INVOICE_DISPATCHED_QTY,
            'INVOICE_QTY_NEED_AFTER_PACKING'=>$INVOICE_QTY_NEED_AFTER_PACKING,
            'QTY_HOLD_REQ_LONG_TERM_QTY'=>$QTY_HOLD_REQ_LONG_TERM_QTY,
            'SALES_VALUE_OF_MONTH'=>$SALES_VALUE_OF_MONTH,
            'VALUE_OF_FINISHED_GOODS'=>$VALUE_OF_FINISHED_GOODS,
            'SALES_PLAN_OF_MONTH'=>$SALES_PLAN_OF_MONTH,

        ];
        return view('dashboard/dashboard')->with($DATA); 
    }
}
