<?php

namespace App\Http\Controllers;

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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\ImportExcelController;

use App\Imports\InvoiceImport;
use App\Imports\ImportWorkOrder;

use Pdf;
use Session;

class InvoiceController extends Controller
{
    public function invoiceList()
    {
        echo self::updateNewInvoice();
        
        $invoices = InvoiceModel::where('BILLING_DATE','>',date('Y-m-d',strtotime('-10 days')))->get();

        $invoices = compact('invoices');
        return view('/invoice/invoice')->with($invoices);
    }
    public function autoAddInvoiceTriggered()
    {
        echo ImportExcelController::autoAddInvoiceTriggered();
        echo   "<script>$('#myModal').modal('hide');
        getPeriodInvoiceList();</script>";


    }
    public function manualInvoiceFileUpload(Request $request)
    {
        return view('/invoice/manualInvoiceFileUpload');
    }
    public function upload_invoice_file_manual(Request $request)
    {
        Excel::import(new InvoiceImport, ($request->file));
        echo self::updateNewInvoice();
        $invoices = InvoiceModel::where('BILLING_DATE','>=',$request['fromDate'])
        ->where('BILLING_DATE','<=',$request['toDate'])
        ->get();

        $invoices = compact('invoices');
        return view('/invoice/invoiceFiltered')->with($invoices);
    }
    public function getPeriodInvoiceList(Request $request) 
    {
        echo self::updateNewInvoice();
        $invoices = InvoiceModel::where('BILLING_DATE','>=',$request['fromDate'])
        ->where('BILLING_DATE','<=',$request['toDate'])
        ->get();

        $invoices = compact('invoices');
        return view('/invoice/invoiceFiltered')->with($invoices);

    }
    public function getSLNOfromPrimary($PRIMARY_ID)
    {
        $SLNOS=products_scannedModel::where('PRIMARY','=',$PRIMARY_ID)
        ->whereNull('CANCEL');
        $SLNOS= compact('SLNOS');
        return $SLNOS;
    }
    public function printInvoiceDetails(Request $request)
    {
        //$request['INVOICE_ID'];
        $INVOICE_ID=$request['INVOICE_ID'];
        $INVOICE=[ 'INVOICE_ID'=>$INVOICE_ID];
        $PRIMARY=barcodePrimary_model::select('barcode_primary.*','barcode_secondary.SL_NO  as SECSLNO')->
        join('barcode_secondary','barcode_secondary.id','=','barcode_primary.SECONDARY')
        ->where('barcode_secondary.INVOICE_ID','=', $request['INVOICE_ID'])
        ->where('barcode_primary.INVOICE_ID','=', $request['INVOICE_ID'])
        ->whereNull('barcode_secondary.CANCEL')
        ->whereNull('barcode_primary.CANCEL')
        ->whereNotNull('barcode_secondary.APPROVED')
        ->whereNotNull('barcode_primary.APPROVED')
        ->get();
        $PRIMARY=compact('PRIMARY','INVOICE');
       

       
        $pdf = PDF::loadView('/invoice/invoice_Report', $PRIMARY);
        $pdf->set_paper('A4', 'LANDSCAPE');
        $pdf->set_option("isPhpEnabled", true);
        //$pdf->stream();
        //$dom_pdf = $pdf->getDomPDF();
        //$canvas = $dom_pdf ->get_canvas();
        //$canvas->page_text(0,0, " Page {PAGE_NUM} of {PAGE_COUNT}", NULL,  10, array(333,3330,3333));
            
        //return $pdf->stream();
        return $pdf->stream();
      

      
    }
    public function workOrder()
    {
        echo self::ItemsPackingBoxQty();        
        $WORKORDERS = work_order_model::where('posting_date','>',date('Y-m-d',strtotime('-10 days')))
        ->WHERE('STATUS', '=', 1)
        ->get();
        $WORKORDERS = compact('WORKORDERS');
        return view('/workOrders/workOrders')->with($WORKORDERS);
    }
    public function getPeriodWorkOrderList(Request $request) 
    {
        echo self::ItemsPackingBoxQty();  
        $WORKORDERS = work_order_model::where('posting_date','>=',$request['fromDate'])
        ->where('posting_date','<=',$request['toDate'])
        ->get();

        $WORKORDERS = compact('WORKORDERS');
        return view('/workOrders/workOrdersFiltered')->with($WORKORDERS);

    }

    public function updateNewInvoice()
    {

        $invoices=InvoiceModel::whereNull('IPR_REF')->count();
        if($invoices>0)
        {
            $PRODUCTS = productsModel::where('ACTIVE','=',1)->get();
            foreach ($PRODUCTS AS $PRODUCT)
            {
                $invoices=InvoiceModel::whereNull('IPR_REF')
                ->where('MATERIAL_NAME','=',$PRODUCT->material_code)
                ->update(['IPR_REF'=>$PRODUCT->ipr_Ref_no]);
            }

        }
    }
    public function updateSecondaryToBinstock(Request $request)
    {
        $barcode_Secondary_id = $request['barcode_secondary_id'];
        $UPDATE = barcodeSecondary_model::find($barcode_Secondary_id);
        $UPDATE->RACK_MASTER_ID = $request['rack_master_id'];
        $UPDATE->save();

        $STORAGE_LOCATION_ID=RackMaster_model::where('id','=',$request['rack_master_id'])
        ->value('storage_location');
        $SECONDARY=barcodeSecondary_model::WHERE('id','=',$request['barcode_secondary_id'])->first();
        $WORK_ORDER_ID= $SECONDARY['WORK_ORDER_ID'];
        $CUSTOMER_NAME= $SECONDARY['CUSTOMER_NAME'];
        $CUSTOMER_PART_NO= $SECONDARY['CUSTOMER_PART_NUMBER'];
        $QTY= $SECONDARY['QTY'];
        $WORK_ORDER=work_order_model::where('id','=', $WORK_ORDER_ID)->first();
         $MATRIAL_CODE=$WORK_ORDER['material_code'];
         $MATERIAL_DESCRIPTION=$WORK_ORDER['material_description'];
         $PACKING_FACTOR=$WORK_ORDER['PACKING_FACTOR'];
         $MASTER_PACKING_FACTOR=$WORK_ORDER['MASTER_PACKING_FACTOR'];


        $BINSTOCK=new BinStockModel;
        $BINSTOCK->SECONDARY_ID=$request['barcode_secondary_id'];//
        $BINSTOCK->STORAGE_LOCATION_ID=$STORAGE_LOCATION_ID;//
        $BINSTOCK->RACK_MASTER_ID=$request['rack_master_id'];//\
        $BINSTOCK->ACTIVE=1;//
        $BINSTOCK->QTY=$QTY;//
        $BINSTOCK->WORK_ORDER_ID=$WORK_ORDER_ID;//
        $BINSTOCK->CUSTOMER_NAME=$CUSTOMER_NAME;//
        $BINSTOCK->CUSTOMER_PART_NO=$CUSTOMER_PART_NO;//
        $BINSTOCK->MATRIAL_CODE=$MATRIAL_CODE;
        $BINSTOCK->MATERIAL_DESCRIPTION=$MATERIAL_DESCRIPTION;
        $BINSTOCK->PACKING_FACTOR=$PACKING_FACTOR;
        $BINSTOCK->MASTER_PACKING_FACTOR=$MASTER_PACKING_FACTOR;
        $BINSTOCK->ACTIVE=1;//
        $BINSTOCK->save();
        echo "<script>$('#barcodeScanIn').prop('disabled',false);
        $('#barcodeScanIn').focus();
        updateScannedCode('check');</script>";

    }
    public function updatePrimaryToBinstock(Request $request)
    {
        $barcode_Primary_id = $request['barcode_primary_id'];
        $UPDATE = barcodePrimary_model::find($barcode_Primary_id);
        $UPDATE->RACK_MASTER_ID = $request['rack_master_id'];
        $UPDATE->save();

        $STORAGE_LOCATION_ID=RackMaster_model::where('id','=',$request['rack_master_id'])
        ->value('storage_location');
        $SECONDARY=barcodePrimary_model::WHERE('id','=',$request['barcode_primary_id'])->first();
        $WORK_ORDER_ID= $SECONDARY['WORK_ORDER_ID'];
        $CUSTOMER_NAME= $SECONDARY['CUSTOMER_NAME'];
        $CUSTOMER_PART_NO= $SECONDARY['CUSTOMER_PART_NUMBER'];
        $QTY= $SECONDARY['QTY'];
        $WORK_ORDER=work_order_model::where('id','=', $WORK_ORDER_ID)->first();
         $MATRIAL_CODE=$WORK_ORDER['material_code'];
         $MATERIAL_DESCRIPTION=$WORK_ORDER['material_description'];
         $PACKING_FACTOR=$WORK_ORDER['PACKING_FACTOR'];
         $MASTER_PACKING_FACTOR=$WORK_ORDER['MASTER_PACKING_FACTOR'];


        $BINSTOCK=new BinStockModel;
        $BINSTOCK->PRIMARY_ID=$request['barcode_primary_id'];//
        $BINSTOCK->STORAGE_LOCATION_ID=$STORAGE_LOCATION_ID;//
        $BINSTOCK->RACK_MASTER_ID=$request['rack_master_id'];//\
        $BINSTOCK->ACTIVE=1;//
        $BINSTOCK->QTY=$QTY;//
        $BINSTOCK->WORK_ORDER_ID=$WORK_ORDER_ID;//
        $BINSTOCK->CUSTOMER_NAME=$CUSTOMER_NAME;//
        $BINSTOCK->CUSTOMER_PART_NO=$CUSTOMER_PART_NO;//
        $BINSTOCK->MATRIAL_CODE=$MATRIAL_CODE;
        $BINSTOCK->MATERIAL_DESCRIPTION=$MATERIAL_DESCRIPTION;
        $BINSTOCK->PACKING_FACTOR=$PACKING_FACTOR;
        $BINSTOCK->MASTER_PACKING_FACTOR=$MASTER_PACKING_FACTOR;
        $BINSTOCK->ACTIVE=1;//
         $BINSTOCK->save();

    }
    public function binStock()
    {
      self::updateOldStocklLocked();
       $DETAILS = StorageLocation_model::where('active', '=', 1)->get();
       $DETAILS=compact('DETAILS');
        return view('workOrders/binStock')->with($DETAILS);
    }
    public function mapStockToInvoice(Request $request)
    {
        self::updateOldStocklLocked();
        $INVOICE=InvoiceModel::where('id','=', $request['INVOICE_ID'])->first();
        $CUTOMER_NAME=$INVOICE['CUSTOMER_NAME'];
        $CUTOMER_PART_NO=$INVOICE['CUSTOMER_PART_NUMBER'];
        $MATERIAL_CODE=$INVOICE['MATERIAL_NAME'];
        $MATERIAL_DESCRIPTION=$INVOICE['MATERIAL_DESCRIPTION'];
         $STOCK=BinStockModel::select(
            'bin_stock.*',
            'work_order.order',
            'storage_location.location_code',
            'storage_location.location_name',
            'rack_master.rack_id',
            'rack_master.bin_name',
            'rack_master.bin_no'
            
            )->where('bin_stock.CUSTOMER_PART_NO','=',$CUTOMER_PART_NO)
        ->whereNull('bin_stock.DISPATCHED')
        ->whereNull('bin_stock.INVOICE_ID')
        ->where('bin_stock.ACTIVE','=',1)
        ->join('rack_master','rack_master.id','=','bin_stock.RACK_MASTER_ID')
        ->join('storage_location','storage_location.id','=','bin_stock.STORAGE_LOCATION_ID')
        ->join('work_order','bin_stock.WORK_ORDER_ID','=','work_order.id')
        ->get();
        
        $DATA=compact('INVOICE','STOCK');
      
        return view('invoice/mapStockToInvoice')->with($DATA);
    }
    public function confirmMappStkToInvoice(Request $request)
    {
       
        $INVOICE_ID= $request['INVOICE_ID'];
        $HEAT_CODE= $request['HEAT_CODE'];
        if($HEAT_CODE=='')  {  echo "<font color='red'>Please Enter HEAT CODE..</font>";exit(); }
        if($request['SUPPLIER']=='')  {  echo "<font color='red'>Please Enter SUPPLIER..</font>";exit(); }
        if($request['DELIVERY_NOTE']=='')  {  echo "<font color='red'>Please Enter DELIVERY_NOTE..</font>";exit(); }
        if($request['HEAT_LOT']=='')  {  echo "<font color='red'>Please Enter HEAT_LOT..</font>";exit(); }
        if($request['REV_LEVEL']=='')  {  echo "<font color='red'>Please Enter REV_LEVEL..</font>";exit(); }
        if($request['DATE_MFG']=='')  {  echo "<font color='red'>Please Enter DATE_MFG ..</font>";exit(); }
        if($request['DATE_SHIPPED']=='')  {  echo "<font color='red'>Please Enter DATE_SHIPPED..</font>";exit(); }
        if($request['FROM_ADDRESS']=='')  {  echo "<font color='red'>Please Enter FROM_ADDRESS..</font>";exit(); }
        if($request['TO_ADDRESS']=='')  {  echo "<font color='red'>Please Enter TO_ADDRESS..</font>";exit(); }
      if(strlen($request['REV_LEVEL'])!=2)
      {
        echo "<font color='red'>Please Enter REV LEVEL (2 letters only allowed)..</font>";exit(); 
      }
    
        $BILLED_QTY= $request['BILLED_QTY'];
        $YET_TO_ASSIGN_QTY= $request['YET_TO_ASSIGN_QTY'];
        $ASSIGNED_QTY= $request['ASSIGNED_QTY'];
      ////ARRAY BEGINS
      $BINSTOCK_ID_ARRAY= json_decode(stripslashes($request['BINSTOCK']));      
      $BINSTOCK_QTY_ARRAY= json_decode(stripslashes($request['QTY'])); 
      $BINSTOCK_QTY_ASSIGNED_ARRAY= json_decode(stripslashes($request['ASSIGNED'])); 
      $COUNT=count($BINSTOCK_ID_ARRAY);
      
      $insufficientQTYFlag=0;
      if($BILLED_QTY==$ASSIGNED_QTY)
      {
       
        for($x=0;$x<$COUNT;$x++)
        {            
            if($BINSTOCK_QTY_ASSIGNED_ARRAY[$x]>0)
            {
                // if 2 user working on same time, will double hit the QTY
                //so checking
                $currentQTY=BinStockModel::where('id','=', $BINSTOCK_ID_ARRAY[$x])
                ->value('QTY');
                if($currentQTY<$BINSTOCK_QTY_ASSIGNED_ARRAY[$x])
                {
                    $insufficientQTYFlag++; 
                }      
            }
            
            
        }
       
        if($insufficientQTYFlag==0)
        {
            $SELECT=InvoiceModel::where('id','=',$INVOICE_ID)->first();
           
            $INSERT=new MasterBarcode_model;
            $INSERT->INVOICE_ID=$INVOICE_ID;//
            $INSERT->CUSTOMER_NAME=$SELECT->CUSTOMER_NAME;//
            $INSERT->CUSTOMER_PART_NUMBER=$SELECT->CUSTOMER_PART_NUMBER;//
            $INSERT->PART_DESCRIPTION=$SELECT->MATERIAL_DESCRIPTION;//
            $INSERT->QUANTITY=$ASSIGNED_QTY;//
            $INSERT->HEAT_CODE=$HEAT_CODE;//
            $INSERT->SUPPLIER=$request['SUPPLIER'];
            $INSERT->VENDOR_BATCH='';
            $INSERT->DELIVERY_NOTE=$request['DELIVERY_NOTE'];
            $INSERT->HEAT_LOT=$request['HEAT_LOT'];
            $INSERT->REV_LEVEL=$request['REV_LEVEL'];
            $INSERT->DATE_MFG=$request['DATE_MFG'];
            $INSERT->DATE_SHIPPED=$request['DATE_SHIPPED'];
            $INSERT->FROM_ADDRESS=$request['FROM_ADDRESS'];
            $INSERT->TO_ADDRESS=$request['TO_ADDRESS'];
            $INSERT->EMP= Session::get('createdby_id');;
            $INSERT->save();
            
             $MASTER_ID=$INSERT->id;
           

            for($x=0;$x<$COUNT;$x++)
            {
                
                if($BINSTOCK_QTY_ASSIGNED_ARRAY[$x]>0)
                {
                   
                    $INSERT=new InvoiceItemModel;
                    $INSERT->INVOICE_ID= $INVOICE_ID;
                    $INSERT->BINSTOCK_ID= $BINSTOCK_ID_ARRAY[$x];
                    $INSERT->ASSIGNED_QTY= $BINSTOCK_QTY_ASSIGNED_ARRAY[$x];
                    $INSERT->ACTIVE= 1;
                    $INSERT->save();

                    $BINSTOCK=BinStockModel::where('id','=', $BINSTOCK_ID_ARRAY[$x])
                    ->first();
                    $currentQty=$BINSTOCK->QTY;
                    $SECONDARY=$BINSTOCK->SECONDARY_ID;
                    $updateQty=$currentQty-$BINSTOCK_QTY_ASSIGNED_ARRAY[$x];

                    $UPDATE=BinStockModel::find( $BINSTOCK_ID_ARRAY[$x]);
                    $UPDATE->QTY= $updateQty;
                    if($updateQty<=0)
                    {
                        $UPDATE->ACTIVE= 0;  
                        $UPDATE->DISPATCHED=1;                       

                    }
                    $UPDATE->INVOICE_ID=$INVOICE_ID;
                    $UPDATE->MASTER_ID=$MASTER_ID;
                    $UPDATE->save();
                    

                    $UPDATE1=barcodeSecondary_model::find($SECONDARY);
                    $UPDATE1->MASTER=$MASTER_ID;
                    $UPDATE1->DISPATCHED=1;
                    $UPDATE1->INVOICE_ID=$INVOICE_ID;
                    $UPDATE1->save();
                    
                   
                    $UPDATE2=barcodePrimary_model::where('SECONDARY','=',$SECONDARY)
                    ->update([
                        'MASTER'=>$MASTER_ID,
                        'DISPATCHED'=>1,
                        'INVOICE_ID'=>$INVOICE_ID
                    ]);
                   
                   
                       
                    $UPDATE3=products_scannedModel::
                    where('SECONDARY_BARCODE','=',$SECONDARY)
                   ->update(
                    ['INVOICE_ID'=>$INVOICE_ID]  );
                    
 
                        }
               
    
            }
            $UPDATE_INVOICE=InvoiceModel::find($INVOICE_ID);
            $UPDATE_INVOICE->STATUS='COMPLETED';
            $UPDATE_INVOICE->HEAT_CODE= $HEAT_CODE;
            $UPDATE_INVOICE->SCANNED_QTY= $ASSIGNED_QTY;
            $UPDATE_INVOICE->save();

            
            echo "<script>$('#myModal').modal('hide');
            getPeriodInvoiceList();</script>";
             $URL_LINK=url('printMasterLabel').'?INVOICE_ID='.$INVOICE_ID;
                    echo "<script>PrintAndClose('". $URL_LINK."')</script>";

           

        }
        else 
        {
            echo "INSUFFICINEt QTY";
        }


      }else
      {
        echo "<font color='red'>CANNOT UPADTE.. BILLED QTY and ASSIGNED QTY not matching..</font>";
      }
    }
   
    public function viewBinStock(Request $request)
    {
        $RACK_MASTER_ID=$request['RACK_MASTER_ID'];
        $STORAGE_LOCATION_ID=$request['STORAGE_LOCATION_ID'];
        $LOCATIONS = StorageLocation_model::find($STORAGE_LOCATION_ID)->first();
        $RACKS = RackMaster_model::find($RACK_MASTER_ID)->first();
         $STOCK=BinStockModel::where('RACK_MASTER_ID','=',$RACK_MASTER_ID)
        ->whereNull('DISPATCHED')
        ->where('ACTIVE','=',1)
        ->get();
        $DATA=compact('STOCK','LOCATIONS','RACKS');
        
        return view('workOrders/stockOfBin')->with($DATA);

    }
    
    public function listItems(Request $request)
    {
        $invoicesItems = InvoiceModel::select('*')
            ->where('SALES_ORDER', '=', $request['SALE_ORDER'])
            ->get();

        $invoicesItems = compact('invoicesItems');
        return view('/invoice/invoiceItems')->with($invoicesItems);
    }
    public function ItemsPackingBoxQty()
    {
        $workOrderITEMS = work_order_model::whereNull('PACKING_FACTOR')
            ->orWhere('PACKING_FACTOR', '=', 0)
            ->get();
        foreach ($workOrderITEMS as $ITMES) {
            $workOrderId = $ITMES['id'];
            $material_code = $ITMES['material_code'];

            $FACTORS = productsModel::
                where('material_code', '=', $material_code)
                ->where('ACTIVE', '=', 1)->first();
                if($FACTORS['packing_factor']>0){
                $MPF=round(round($FACTORS['master_packing_factor'])/round($FACTORS['packing_factor']));}
                else
                {$MPF=0;}


            $Update = work_order_model::find($workOrderId);
            $Update->CUSTOMER_NAME = $FACTORS['Customer_name'];
            $Update->material_description = $FACTORS['product_name'];
            $Update->CUSTOMER_PART_NO = $FACTORS['Customer_part_no'];
            $Update->PACKING_FACTOR = round($FACTORS['packing_factor']);

            $Update->MASTER_PACKING_FACTOR = $MPF;
            $Update->IPR_REF = $FACTORS['ipr_Ref_no'];
            $Update->STATUS = '1';
            $Update->SCANNED_QTY = '0';
            $Update->BALANCE_QTY = $FACTORS['yield_qty'];
            $Update->SAVE();

        }

    }
    public function amend_packing(Request $request)
    {
        $DATA = work_order_model::where('id', '=', $request['work_order_id'])->first();
        $DATA = compact('DATA');
        //exit();
        return view('workOrders/packing_amend')->with($DATA);

    }
    public function prepareInvoiceItems(Request $request)
    {
        $DATA = work_order_model::where('id', '=', $request['work_order_id'])->first();
        $DATA = compact('DATA');
        return view('invoice/prepareInvoiceItems')->with($DATA);

    }
    public function getBinStockMappedToInvoice(Request $request)
    {

        $CUSTOMER_PART_NO=$request['CUSTOMER_PART_NO'];
        $barcodeScanIn=$request['barcodeScanIn'];
    }

    public function update_amended(Request $request)
    {

        $work_order_id = $request['work_order_id'];
        $HEAT_CODE = $request['HEAT_CODE'];
        $OLD_PACKING_FACTOR = $request['OLD_PACKING_FACTOR'];
        $AMENDED_PACKING_FACTOR = $request['AMENDED_PACKING_FACTOR'];
        $OLD_MASTER_PACKING_FACTOR = $request['OLD_MASTER_PACKING_FACTOR'];
        $AMENDED_MASTER_PACKING_FACTOR = $request['AMENDED_MASTER_PACKING_FACTOR'];
        $CREATED_BY = Session::get('createdby_id');

        $WORKORDER = work_order_model::find($work_order_id);
        $WORKORDER->PACKING_FACTOR = $AMENDED_PACKING_FACTOR;
        $WORKORDER->MASTER_PACKING_FACTOR = $AMENDED_MASTER_PACKING_FACTOR;
        $WORKORDER->HEAT_CODE = $HEAT_CODE;
        $WORKORDER->save();

        $INSERT = new Packing_amended_model;
        $INSERT->AMENDED_BY = $CREATED_BY;
        $INSERT->HEAT_CODE = $HEAT_CODE;
        $INSERT->WORK_ORDER_ID = $work_order_id;
        $INSERT->OLD_PACKING_FACTOR = $OLD_PACKING_FACTOR;
        $INSERT->AMENDED_PACKING_FACTOR = $AMENDED_PACKING_FACTOR;
        $INSERT->OLD_MASTER_PACKING_FACTOR = $OLD_MASTER_PACKING_FACTOR;
        $INSERT->AMENDED_MASTER_PACKING_FACTOR = $AMENDED_MASTER_PACKING_FACTOR;
        $INSERT->save();

        echo "<script>$('#myModal').modal('hide'); pageLoad('workOrder');</script>";
    }
    
    public function prepareWorkOrderType(Request $request)
    {
        $DATA =[
            'work_order_id'=>$request['work_order_id'],
            
        ];      
        return view('workOrders/prepareWorkOrderType')->with($DATA);

    }
    public function prepareWorkOrderByPartScan(Request $request)
    {
         $DATA = work_order_model::where('id', '=', $request['work_order_id'])->first();
        $DATA = compact('DATA');
        return view('workOrders/prepareWorkOrderByPartScan')->with($DATA);

    }
    public function prepareWorkOrderByPrimaryScan(Request $request)
    {
         $DATA = work_order_model::where('id', '=', $request['work_order_id'])->first();
        $LOCATIONS = StorageLocation_model::where('active', '=', 1)->get();
        $RACKS = RackMaster_model::where('active', '=', 1)->get();
        $THISDATA = compact('DATA','LOCATIONS','RACKS');
        return view('workOrders/prepareWorkOrderByPrimaryScan')->with($THISDATA);

    }
    public function prepareWorkOrderBySecondaryScan(Request $request)
    {
         $DATA = work_order_model::where('id', '=', $request['work_order_id'])->first();
        $LOCATIONS = StorageLocation_model::where('active', '=', 1)->get();
        $RACKS = RackMaster_model::where('active', '=', 1)->get();
        $THISDATA = compact('DATA','LOCATIONS','RACKS');
        return view('workOrders/prepareWorkOrderBySecondaryScan')->with($THISDATA);

    }
    public function updateScannedSecondaryCode(Request $request)
    {
        $space= strpos($request['barCodeValue'],' ');
        if($space >0)
        {}else { echo "<font color='red'>Wrong Part scanned.. Please check ..
         </font><script>$('#barcodeScanIn').val('');
         $('#barcodeScanIn').focus();</script>";
     exit();
         }
      $request['WORK_ORDER_ID'];
      $BARCODE=$request['barCodeValue'];
      $BARCODE=str_replace('  ',' 0 ',$BARCODE);
      $EXPLODED=explode(' ',$BARCODE);
      echo "<br>PART NO: ". $CUSTOMER_PART_NO=$EXPLODED[0];
      echo "<br>IPR_REF: ".$IPR_REF=$EXPLODED[1];
      echo "<br>WEIGHT: ".$WEIGHT=$EXPLODED[2];
      $QTYDATE=$EXPLODED[3];
      $TIME=$EXPLODED[4];
      echo "<br>SLNO: ".$SLNO=$EXPLODED[5];
      echo "<br>EMP: ".$EMP=$EXPLODED[6];
      $date=substr($QTYDATE,-10);
      echo "<br>DATE: ".$DATE=$date. ' '.$TIME;  
      echo "<br>QTY: ".$QTY= str_replace($date,'',$QTYDATE);           
      $CHECK=barcodeSecondary_model::where('WORK_ORDER_ID','=',$request['WORK_ORDER_ID'])
      ->where('VALUE','=',$request['barCodeValue'])
      ->where('SL_NO','=',$SLNO)
      ->where('DATE','=',$DATE)
      ->count();
      if($CHECK==0 AND $EMP!='' AND $EMP!=0 and $request['CUSTOMER_PART_NO'] == $CUSTOMER_PART_NO)
      {
        $SECONDARY = new barcodeSecondary_model;
        $SECONDARY->WORK_ORDER_ID = $request['WORK_ORDER_ID'];
        $SECONDARY->CUSTOMER_NAME = $request['CUSTOMER_NAME'];
        $SECONDARY->CUSTOMER_PART_NUMBER = $request['CUSTOMER_PART_NO'];
        $SECONDARY->IPR_REF = $IPR_REF;
        $SECONDARY->SL_NO =$SLNO;
        $SECONDARY->VALUE =$request['barCodeValue'];
      
        $SECONDARY->WEIGHT = $WEIGHT;
        $SECONDARY->EMP = Session::get('createdby_id');
        $SECONDARY->DATE =$DATE;
        $SECONDARY->QTY = $QTY;
        $SECONDARY->RACK_MASTER_ID=$request['RACK_MASTER_ID'];;
        $SECONDARY->APPROVED=1;
        $SECONDARY->save();
        $SECONDARY_ID = $SECONDARY->id;

        $BINSTOCK=new BinStockModel;
        $BINSTOCK->SECONDARY_ID=$SECONDARY_ID;//
        $BINSTOCK->STORAGE_LOCATION_ID=$request['STORAGE_LOCATION_ID'];//
        $BINSTOCK->RACK_MASTER_ID=$request['RACK_MASTER_ID'];//\
        $BINSTOCK->ACTIVE=1;//
        $BINSTOCK->QTY=$QTY;//
        $BINSTOCK->WORK_ORDER_ID=$request['WORK_ORDER_ID'];//
        $BINSTOCK->CUSTOMER_NAME=$request['CUSTOMER_NAME'];//
        $BINSTOCK->CUSTOMER_PART_NO=$request['CUSTOMER_PART_NO'];//
        $BINSTOCK->MATRIAL_CODE=$request['MATERIAL_CODE'];
        $BINSTOCK->MATERIAL_DESCRIPTION=$request['MATERIAL_DESCRIPTION'];
        $BINSTOCK->PACKING_FACTOR=$request['PACKING_FACTOR'];
        $BINSTOCK->MASTER_PACKING_FACTOR=$request['MASTER_PACKING_FACTOR'];
        $BINSTOCK->save();


       
        echo self::scannedProductsInWorkOrder($request);
        echo "<script>$('#barcodeScanIn').val('');$('#barcodeScanIn').focus();</script>";

      }else{

        $INSERT=new DuplicateScanModel;
        $INSERT->barcode_value=$request['barCodeValue'];
        $INSERT->barcode_type='SECONDARY_BARCODE';
        $INSERT->work_order_id= $request['WORK_ORDER_ID'];
        $INSERT->created_at=date('Y-m-d H:i:s');
        $INSERT->emp=Session::get('createdby_id');
        $INSERT->save();

        echo "<br><font color='red' >Duplicate SCAN Attempted..</font>";
        echo self::scannedProductsInWorkOrder($request);
        echo "<script>$('#barcodeScanIn').val('');invalidScan();
        $('#barcodeScanIn').focus();</script>";

      }    

    }
    public function updateScannedPrimaryCode(Request $request)
    {
       $space= strpos($request['barCodeValue'],' ');
       if($space >0)
       {}else { echo "<font color='red'>Wrong Part scanned.. Please check ..
        </font><script>$('#barcodeScanIn').val('');
        $('#barcodeScanIn').focus();</script>";
                exit();
        }
      $request['WORK_ORDER_ID'];
      $BARCODE=$request['barCodeValue'];
      $BARCODE=str_replace('  ',' 0 ',$BARCODE);
      $EXPLODED=explode(' ',$BARCODE);
      echo "<br>PART NO: ". $CUSTOMER_PART_NO=$EXPLODED[0];
      echo "<br>IPR: ".$IPR_REF=$EXPLODED[1];
      echo "<br>WEIGHT: ".$WEIGHT=$EXPLODED[2];
      $QTYDATE=$EXPLODED[3];
      $TIME=$EXPLODED[4];
      echo "<br>SLNO: ".$SLNO=$EXPLODED[5];
      echo "<br>EMP: ".$EMP=$EXPLODED[6];
      $date=substr($QTYDATE,-10);
      echo "<br>DATE: ".$DATE=$date. ' '.$TIME;  
      echo "<br>QTY: ".$QTY= str_replace($date,'',$QTYDATE);           
      
      $CHECK=barcodeSecondary_model::where('WORK_ORDER_ID','=',$request['WORK_ORDER_ID'])
      ->whereNull('APPROVED')
      ->whereNull('CANCEL')
      ->count();
      if($CHECK>0)
      {
        echo "<script>$('#barcodeScanIn').val('');$('#barcodeScanIn').focus();
        updateScannedCode('".$request['barCodeValue']."');</script>";
        exit();

      }

      $CHECK=barcodePrimary_model::where('WORK_ORDER_ID','=',$request['WORK_ORDER_ID'])
      ->where('VALUE','=',$request['barCodeValue'])
      ->where('SL_NO','=',$SLNO)
      ->where('DATE','=',$DATE)
      ->count();
      if($CHECK==0 AND $EMP!='' AND $EMP!=0 and $request['CUSTOMER_PART_NO'] == $CUSTOMER_PART_NO)
      {
        $PRIMARY = new barcodePrimary_model;
        $PRIMARY->WORK_ORDER_ID = $request['WORK_ORDER_ID'];
        $PRIMARY->CUSTOMER_NAME = $request['CUSTOMER_NAME'];
        $PRIMARY->CUSTOMER_PART_NUMBER = $request['CUSTOMER_PART_NO'];
        $PRIMARY->IPR_REF = $IPR_REF;
        $PRIMARY->SL_NO =$SLNO;
        $PRIMARY->VALUE =$request['barCodeValue'];
      
        $PRIMARY->WEIGHT = $WEIGHT;
        $PRIMARY->EMP = Session::get('createdby_id');
        $PRIMARY->DATE =$DATE;
        $PRIMARY->QTY = $QTY;
        $PRIMARY->APPROVED=1;
        $PRIMARY->save();
        $PRIMARY_ID = $PRIMARY->id;

        echo self::scannedProductsInWorkOrder($request);

        echo "<script>$('#barcodeScanIn').val('');$('#barcodeScanIn').focus();
        updateScannedCode('check');</script>";

      }else{

        $INSERT=new DuplicateScanModel;
        $INSERT->barcode_value=$request['barCodeValue'];
        $INSERT->barcode_type='PRIMARY';
        $INSERT->work_order_id= $request['WORK_ORDER_ID'];
        $INSERT->created_at=date('Y-m-d H:i:s');
        $INSERT->emp=Session::get('createdby_id');
        $INSERT->save();
        echo self::scannedProductsInWorkOrder($request);

        echo "<br><font color='red' >Duplicate SCAN Attempted..</font>";
        echo "<script>$('#barcodeScanIn').val('');invalidScan();
        $('#barcodeScanIn').focus(); updateScannedCode('check');</script>";

      }    

    }
    public function partBarCodeDetails($BARCODE)
    {
        $ScanString = substr($BARCODE, 1, 4);
        $YearString = substr($BARCODE, 5, 2);
            $dayString = substr($BARCODE, 7, 3);
            $ProductionSequnceNo = substr($BARCODE, 10, 4);

            $ScanString_i = substr($BARCODE, 0, 1);
            if( $ScanString_i=='i' or  $ScanString_i=='I')
            { $MANUFACTURER="IP Rings";}else {$MANUFACTURER="OTHERS";}
             $YEAR='20'.$YearString;
            $DATEString=strtotime($YEAR.'-01-01')+(( $dayString-1)*(24*60*60));
             $DATE_MANUFATURED=date('d-m-Y',$DATEString);
        $PRODUCT=   productsModel::where('Customer_part_no','like','%'.$ScanString) ->first();
    
        echo "<table id='".$BARCODE."'  class='table table-bordered table-striped table-colored-header table-responsive table-striped table-hover'>
        <tbody><tr><td>  </td></tr><tr></td><table border='1'  width='90%'><thead><tr><th colspan='6'>PART PRODUCTION DETAILS</th></tr></thead><tbody><tr>
        <th>SCANNED BARCODE  </th> <td>".$BARCODE."</td>
        <th>Part Name </th> <td>".$PRODUCT->product_name."</td>
        <th>IPR REF no.</th> <td>".$PRODUCT->ipr_Ref_no."</td> </tr><tr>

        <th>Customer Part No </th> <td>".$PRODUCT->Customer_part_no."</td>
        <th>Customer Name</th> <td>".$PRODUCT->Customer_name."</td> 
        <th>Manufacturer</th> <td>". $MANUFACTURER."</td> </tr><tr>

        <th>Production Date </th> <td>".$DATE_MANUFATURED."</td>
        <th>Production Sequence</th> <td>".$ProductionSequnceNo."</td> 
        <th>Item Code</th> <td>".$PRODUCT->material_code."</td> </tr>
        ";
        
    }
    public function partNumberTracing($BARCODE)
    {
        
        echo self::partBarCodeDetails($BARCODE);
         $CHECK = products_scannedModel::where('PRODUCT_BARCODE', '=', $BARCODE)
                ->whereNull('CANCEL')->count();
                if( $CHECK>0)
                {
                    $DATA = products_scannedModel::where('PRODUCT_BARCODE', '=', $BARCODE)
                ->whereNull('CANCEL')->first();
               $WORK_ORDER_ID= $DATA->WORK_ORDER_ID;
               $SECONDARY_BARCODE= $DATA->SECONDARY_BARCODE;
               $PRIMARY_BARCODE= $DATA->PRIMARY_BARCODE;
               $CUSTOMER_PART_NO=$DATA->CUSTOMER_PART_NO;
               if($PRIMARY_BARCODE!=NULL)
               {
                $PRIMARY= barcodePrimary_model::WHERE('id','=',$PRIMARY_BARCODE)->first();
                echo "<hr>".$BARCODE." >> <a target='_blank' href='" . url('primaryLablePrint') . "?data=" . $PRIMARY_BARCODE . "'><button class='box-button'>
                PRIMARY ".$PRIMARY_BARCODE."</button></a>";
                $User=UsersModel::where('id','=',$PRIMARY->EMP)->value('name');

                echo "<tr>
                <th>PRIMARY BOX SLNO</th><td>".$PRIMARY->id."</td>
                <th>PRIMARY PACKED BY </th><td>".$User."</td>
                <th>PRIMARY PACKED TIME</th><td>".$PRIMARY->DATE."</td>
                </tr>";

               }
               if($SECONDARY_BARCODE!=NULL)
               {
                echo " >> <a target='_blank' href='" . url('secondaryLablePrint') . "?data=" . $SECONDARY_BARCODE . "'><button class='master-box-button'><hr>
                SECONDARY ".$SECONDARY_BARCODE."</button></a>";
                
                $BINSTOCK=BinStockModel::where('SECONDARY_ID','=',$SECONDARY_BARCODE)->first();
                $INVOICE_ID=$BINSTOCK->INVOICE_ID;
                $RACK_MASTER_ID=$BINSTOCK->RACK_MASTER_ID;
                $STORAGE_LOCATION_ID=$BINSTOCK->STORAGE_LOCATION_ID;

                
                $SECONDARY= barcodeSecondary_model::WHERE('id','=',$SECONDARY_BARCODE)->first();
               
                $User=UsersModel::where('id','=',$SECONDARY->EMP)->value('name');

                echo "<tr>
                <th>SECONDARY BOX SLNO</th><td>".$SECONDARY->id."</td>
                <th>SECONDARY PACKED BY </th><td>".$User."</td>
                <th>SECONDARY PACKED TIME</th><td>".$SECONDARY->DATE."</td>
                </tr>";


                 }
                
               if($WORK_ORDER_ID>0){
                echo self::getWorkOrderLoadDetails($WORK_ORDER_ID); 

               }
               if($INVOICE_ID!=NULL and $INVOICE_ID!='' and $INVOICE_ID!=0)
               {          
                echo self::getInvoiceLoadDetails($INVOICE_ID,$CUSTOMER_PART_NO);          
               } 
               if($SECONDARY_BARCODE!=NULL)  {
                echo self::getStorageLocationLoadDetails($RACK_MASTER_ID,$STORAGE_LOCATION_ID);


               }
               ECHO "</table></td></tr></tbody></table><script>
               $(document).ready(function() {
                       document.title = 'IP RINGS - Traceability -BARCODE:".$BARCODE." ';
                   });
                 $(document).ready(function(){
                 var empDataTable = $('#".$BARCODE."').DataTable({
                    dom: 'Blfrtip',
                    buttons: [
                      {
                         extend: 'copy'
                      },
                      {
                         extend: 'pdf',
                         exportOptions: {
                           columns: [0] // Column index which needs to export
                         }
                      },
                      {
                         extend: 'csv',
                      },
                      {
                         extend: 'excel',
                      }
                      ,
                      {
                         extend: 'print',
                      }
                      ,
                      {
                         extend: 'colvis',
                      }
                    ]
               
                 });
               
               });
               </script>";
                }else 
                {
                    echo "<br><font color='red'>
                    This Product Not Scanned Yet..
                    It is not linked in any WORK_ORDERS / INVOICES..</font>";
                }

    }
    public function tracePrimaryLabel($BARCODE)
    {
        echo "<br>This is Barcode Value of PRIMARY BOX<br>";
        $PRIMARY=barcodePrimary_model::where('VALUE','=',$BARCODE)
        ->whereNull('CANCEL')->first();
        $PRIMARY_BARCODE=$PRIMARY->id;
        $CUSTOMER_PART_NO=$PRIMARY->CUSTOMER_PART_NUMBER;

        $PRODUCT=   productsModel::where('Customer_part_no','=',$CUSTOMER_PART_NO) ->first();

        echo "<table id='".$BARCODE."'  class='table table-bordered table-striped table-colored-header table-responsive table-striped table-hover'>
        <tbody><tr><td>  </td></tr><tr></td><table border='1'  width='90%'><thead><tr><th colspan='6'>PART PRODUCTION DETAILS</th></tr></thead><tbody><tr>
        <th>SCANNED BARCODE  </th> <td> </td>
        <th>Part Name </th> <td>".$PRODUCT->product_name."</td>
        <th>IPR REF no.</th> <td>".$PRODUCT->ipr_Ref_no."</td> </tr><tr>

        <th>Customer Part No </th> <td>".$PRODUCT->Customer_part_no."</td>
        <th>Customer Name</th> <td>".$PRODUCT->Customer_name."</td> 
        <th>Manufacturer</th> <td>IP RINGS</td> </tr><tr>
        ";
        $PRIMARY= barcodePrimary_model::WHERE('id','=',$PRIMARY_BARCODE)->first();
        $WORK_ORDER_ID=$PRIMARY->WORK_ORDER_ID;
        $User=UsersModel::where('id','=',$PRIMARY->EMP)->value('name');

        echo "<tr>
        <th>PRIMARY BOX SLNO</th><td>".$PRIMARY->id."</td>
        <th>PRIMARY PACKED BY </th><td>".$User."</td>
        <th>PRIMARY PACKED TIME</th><td>".$PRIMARY->DATE."</td>
        </tr>";

        $SECONDARY_BARCODE=$SECONDARY=$PRIMARY->SECONDARY;
        echo "<a target='_blank' href='" . url('primaryLablePrint') . "?data=" . $PRIMARY_BARCODE . "'><button class='box-button'>
        PRIMARY ".$PRIMARY_BARCODE."</button></a>";
        if($SECONDARY!=Null)
        {
            echo "--><a target='_blank' href='" . url('secondaryLablePrint') . "?data=" . $SECONDARY . "'><button class='master-box-button'><hr>
            SECONDARY ".$SECONDARY."</button></a>";
           
             
             $BINSTOCK=BinStockModel::where('SECONDARY_ID','=',$SECONDARY)->first();
             $INVOICE_ID=$BINSTOCK->INVOICE_ID;
             $RACK_MASTER_ID=$BINSTOCK->RACK_MASTER_ID;
             $STORAGE_LOCATION_ID=$BINSTOCK->STORAGE_LOCATION_ID;

             
             $SECONDARY= barcodeSecondary_model::WHERE('id','=',$SECONDARY_BARCODE)->first();
            
             $User=UsersModel::where('id','=',$SECONDARY->EMP)->value('name');

             echo "<tr>
             <th>SECONDARY BOX SLNO</th><td>".$SECONDARY->id."</td>
             <th>SECONDARY PACKED BY </th><td>".$User."</td>
             <th>SECONDARY PACKED TIME</th><td>".$SECONDARY->DATE."</td>
             </tr>";


              }
             
            if($WORK_ORDER_ID>0){
             echo self::getWorkOrderLoadDetails($WORK_ORDER_ID); 

            }
            if($INVOICE_ID!=NULL and $INVOICE_ID!='' and $INVOICE_ID!=0)
            {          
             echo self::getInvoiceLoadDetails($INVOICE_ID,$PRODUCT->Customer_part_no);          
            } 
            if($SECONDARY_BARCODE!=NULL)  {
             echo self::getStorageLocationLoadDetails($RACK_MASTER_ID,$STORAGE_LOCATION_ID);


            }
    }
    public function getScannedValueDetails(Request $request)
    {
       $BARCODE=  $request['scanValue'] ;
       echo "<script>$('#traceValue').val('');
        $('#traceValue').focus();</script>";
        if (strlen($BARCODE) == 14 and strpos($BARCODE," ")=='')
        {
           echo  self::partNumberTracing($BARCODE);

        }else
        {
            echo "BARCODE VALUE: ".$BARCODE;
            $CHECK=barcodePrimary_model::where('VALUE','=',$BARCODE)
            ->whereNull('CANCEL')
            ->count();
            if($CHECK > 0)
            {
                echo self::tracePrimaryLabel($BARCODE);
                // PRIMARY BOX
               
            }
            else 
            {
                  //SECONDARY BOX
                $CHECK=barcodeSecondary_model::where('VALUE','=',$BARCODE)
                ->whereNull('CANCEL')->count();
                if($CHECK > 0)
                {
                    echo self::traceSecondaryLabel($BARCODE);

                        }

            }
        }
       

    }
    public function traceSecondaryLabel($BARCODE)
    {
        
        echo "<br>This is Barcode Value of SECONDARY BOX<br>";
        $SECONDARY=barcodeSecondary_model::where('VALUE','=',$BARCODE)
        ->whereNull('CANCEL')->first();
        $CUSTOMER_PART_NO=$SECONDARY->CUSTOMER_PART_NUMBER;

        $PRODUCT=   productsModel::where('Customer_part_no','=',$CUSTOMER_PART_NO) ->first();

        echo "<table id='".$BARCODE."'  class='table table-bordered table-striped table-colored-header table-responsive table-striped table-hover'>
        <tbody><tr><td>  </td></tr><tr></td><table border='1'  width='90%'><thead><tr><th colspan='6'>PART PRODUCTION DETAILS</th></tr></thead><tbody><tr>
        <th>SCANNED BARCODE  </th> <td> </td>
        <th>Part Name </th> <td>".$PRODUCT->product_name."</td>
        <th>IPR REF no.</th> <td>".$PRODUCT->ipr_Ref_no."</td> </tr><tr>

        <th>Customer Part No </th> <td>".$PRODUCT->Customer_part_no."</td>
        <th>Customer Name</th> <td>".$PRODUCT->Customer_name."</td> 
        <th>Manufacturer</th> <td>IP RINGS</td> </tr><tr>
        ";
        $WORK_ORDER_ID=$SECONDARY->WORK_ORDER_ID;
        $User=UsersModel::where('id','=',$SECONDARY->EMP)->value('name');

        echo "<tr>
        <th>SECONDARY BOX SLNO</th><td>".$SECONDARY->id."</td>
        <th>SECONDARY PACKED BY </th><td>".$User."</td>
        <th>SECONDARY PACKED TIME</th><td>".$SECONDARY->DATE."</td>
        </tr>";

        $SECONDARY_BARCODE=$SECONDARY=$SECONDARY->id;
       
        
            echo "--><a target='_blank' href='" . url('secondaryLablePrint') . "?data=" . $SECONDARY . "'><button class='master-box-button'><hr>
            SECONDARY ".$SECONDARY."</button></a>";
           
             
             $BINSTOCK=BinStockModel::where('SECONDARY_ID','=',$SECONDARY)->first();
             $INVOICE_ID=$BINSTOCK->INVOICE_ID;
             $RACK_MASTER_ID=$BINSTOCK->RACK_MASTER_ID;
             $STORAGE_LOCATION_ID=$BINSTOCK->STORAGE_LOCATION_ID;

           


              
             
            if($WORK_ORDER_ID>0){
             echo self::getWorkOrderLoadDetails($WORK_ORDER_ID); 

            }
            if($INVOICE_ID!=NULL and $INVOICE_ID!='' and $INVOICE_ID!=0)
            {          
             echo self::getInvoiceLoadDetails($INVOICE_ID,$PRODUCT->Customer_part_no);          
            } 
            if($SECONDARY_BARCODE!=NULL)  {
             echo self::getStorageLocationLoadDetails($RACK_MASTER_ID,$STORAGE_LOCATION_ID);


            }

    }
    public function getWorkOrderLoadDetails($WORK_ORDER_ID)
    {
        $WORK_ORDER=work_order_model::where('id','=',$WORK_ORDER_ID)->first();

        echo " <tr>
        <th>WORK ORDER NO</th><td><button class='btn-primary'>".$WORK_ORDER->order."</button></td>
        <th>POSTING DATE</th><td>".date('d-m-Y',strtotime($WORK_ORDER->posting_date))."</td>
        <th>YIELD QTY</th><td>".$WORK_ORDER->yield_qty."</td>
        </tr>
        <tr>
        <th>Primary Box Packing Factor</th><td>".$WORK_ORDER->PACKING_FACTOR."</td>
        <th>Count of Primary Box for Master BOX</th><td>".$WORK_ORDER->MASTER_PACKING_FACTOR."</td>
        <th>SCANNED QTY</th><td>".$WORK_ORDER->SCANNED_QTY."</td>
        </tr>";


    }

    public function getInvoiceLoadDetails($INVOICE_ID,$CUSTOMER_PART_NO)
    {
         $INVOICE=InvoiceModel::where('id','=',$INVOICE_ID)->first();
       echo " <tr>
       <th>BILLING DOC. NO</th><td>
       <a id='invoiceLinkAcnchor' style=' text-decoration: none;
            display: inline-block;color: black;' href='" . url('printInvoiceDetails') 
            . "?INVOICE_ID=" . $INVOICE_ID . "&PART_NUM=".$CUSTOMER_PART_NO."' target='_blank' >
            <button class='btn-primary'>".$INVOICE->BILLING_DOCUMENT."</button></a></td>
       <th>BILL DATE</th><td>".date('d-m-Y',strtotime($INVOICE->BILLING_DATE))."</td>
       <th>SALE ORDER</th><td>".$INVOICE->SALE_ORDER."</td>
       </tr>
       <tr>
       <th>CUSTOMER PO. NO</th><td>".$INVOICE->CUSTOMER_PO_No."</td>
       <th>CUSTOMER PO. DATE</th><td>".date('d-m-Y',strtotime($INVOICE->CUSTOMER_PO_Date))."</td>
       <th>BILLED QTY</th><td>".$INVOICE->BILLED_QTY."</td>
       </tr>
       ";
        

    }
    public function getStorageLocationLoadDetails($RACK_MASTER_ID,$STORAGE_LOCATION_ID)
    {
        $STORAGE=StorageLocation_model::where('id','=',$STORAGE_LOCATION_ID)->first();
        $RACK=RackMaster_model::where('id','=',$RACK_MASTER_ID)->first();
        echo "<tr>
        <th>BIN DETAILS</th><td>".$RACK->bin_name." >> ".$RACK->bin_no." </td>       
        <th>RACK ID</th><td>".$RACK->rack_id."</td>
        <th>LOCATION</th><td> ".$STORAGE->location_code."</td>
        
        </tr>";
    }
   


    public function updateScannedCode(Request $request)
    {
        $invalid_flag = 0;
        $check_flag = 0;
        $unapprovedPrimary = 0;
        $PRIMARY_flag = 0;
        $SECONDARY_flag = 0;
        $invalid = 0;
        $VISION_PERCENT=$request['VISION_PERCENT'];

        $alert = '';
        echo "<script>$('#barcodeScanIn').val('');
        $('#visionPercent').val('');        
        $('#barcodeScanIn').focus();</script>";

        // PRIMARY LABLE YET TO APPROVE
        $ID = barcodePrimary_model::select('id')
            ->whereNull('APPROVED')
            ->where('WORK_ORDER_ID', '=', $request['WORK_ORDER_ID'])->first();
        $PRIMARY_ID = $ID['id'];
        if ($PRIMARY_ID > 0) {
            $PRIMARY_flag = 1;
			
        }

        //SECONDARY LABEL YET TO APPROVE
        $ID = barcodeSecondary_model::select('id')
            ->whereNull('APPROVED')
            ->where('WORK_ORDER_ID', '=', $request['WORK_ORDER_ID'])->first();
        $SECONDARY_ID = $ID['id'];
        if ($SECONDARY_ID > 0) {
            $SECONDARY_flag = 1;
        }

        if ($PRIMARY_flag == 1 or $SECONDARY_flag == 1 or $request['barCodeValue'] == 'check') {

        } else {
            $ScanString = substr($request['barCodeValue'], 1, 4);
            $partNumString = substr($request['CUSTOMER_PART_NO'], -4);
            $YearString = substr($request['barCodeValue'], 5, 2);
            $dayString = substr($request['barCodeValue'], 7, 3);

            $ScanString_i = substr($request['barCodeValue'], 0, 1);
            if ($ScanString_i != 'i' and $ScanString_i != 'I') {
                // NOT A ip rings product
                $alert = 'Its not a IP Ring Product ..?? ';
            }
            if (strlen($request['barCodeValue']) != 14) {
                $alert = $alert . " <br> Barcode Value not in 14 DIGITS.. ";
            }
            if ($partNumString != $ScanString) {
                $alert = $alert . " <br>WRONG PART .. Part Number 4 Digits not matching in Barcode.. ";

            }
            if ($YearString > date('y')) {
                $alert = $alert . " <br>WRONG BARCODE .. Production Year cannot be .. " . $YearString;
            } else
            if ($YearString < date('y')) {
                if ($YearString % 4 == 0) {$dayLimtit = 366;} else { $dayLimtit = 365;}
                if ($dayString > $dayLimtit) {
                    $alert = $alert . " <br>WRONG BARCODE .. Production DATE cannot be .. " . $dayString;
                }
            } else {
                $dayLimtit = (strtotime(date('Y-m-d')) - strtotime(date('Y-01-01'))) / (24 * 60 * 60);
                $dayLimtit++;
                if ($dayString > $dayLimtit) {
                    $alert = $alert . " <br>WRONG BARCODE .. Production DATE cannot
                 be .. " . $dayString . " , is greater than today";
                }

            }
            if ($partNumString != $ScanString) {
                $alert = $alert . " <br>WRONG BARCODE .. Wrong Part Number scanned  ";
            }

        }

        if ($request['barCodeValue'] == 'check') {
            $check_flag = 1;
			
        }elseif($PRIMARY_flag == 1 or $SECONDARY_flag == 1)
		{
			
		}		elseif ((strlen($request['barCodeValue']) != 14 or $partNumString != $ScanString or $alert != '')) {
            $invalid_flag = 1;
            echo "<font color='red'>" . $alert . '</font>';
            echo "<script>$('#barcodeScanIn').val('');invalidScan();</script>";

            exit();

        }

        if ($PRIMARY_ID > 0) {
			
            $PRIMARY = barcodePrimary_model::where('id', '=', $PRIMARY_ID)->first();
            $CUSTOMER_NAME = $PRIMARY['CUSTOMER_NAME'];
            $CUSTOMER_PART_NUMBER = $PRIMARY['CUSTOMER_PART_NUMBER'];
            $IPR_REF = $PRIMARY['IPR_REF'];
            $WEIGHT = $PRIMARY['WEIGHT'];
            $EMP = $PRIMARY['EMP'];
            $DATE = $PRIMARY['DATE'];
            $SLNO = $PRIMARY_ID;
            $QTY = $PRIMARY['QTY'];
            echo " BARCODE:".$scanShouldBe = "$CUSTOMER_PART_NUMBER $IPR_REF $WEIGHT $QTY$DATE $SLNO $EMP";
			
			

        }
        if ($SECONDARY_ID > 0) {
            $SECONDARY = barcodeSecondary_model::where('id', '=', $SECONDARY_ID)->first();
            $CUSTOMER_NAME = $SECONDARY['CUSTOMER_NAME'];
            $CUSTOMER_PART_NUMBER = $SECONDARY['CUSTOMER_PART_NUMBER'];
            $IPR_REF = $SECONDARY['IPR_REF'];
            $WEIGHT = $SECONDARY['WEIGHT'];
            $EMP = $SECONDARY['EMP'];
            $DATE = $SECONDARY['DATE'];
            $SLNO = $SECONDARY_ID;
            $QTY = $SECONDARY['QTY'];
            $RACK_MASTER_ID = $SECONDARY['RACK_MASTER_ID'];
            if ($RACK_MASTER_ID == null or $RACK_MASTER_ID == '' or $RACK_MASTER_ID == 0) {
                $LOCATIONS = StorageLocation_model::where('active', '=', 1)->get();
                $RACKS = RackMaster_model::where('active', '=', 1)->get();

                $DATA = compact('SECONDARY', 'LOCATIONS', 'RACKS');
                echo "<br><div id='SecondaryBinUpdateDiv'>";
                echo view('store/update_secondary_location')->with($DATA);
                echo "</div>";
            }
            echo " BARCODE:". $scanShouldBe = "$CUSTOMER_PART_NUMBER $IPR_REF $WEIGHT $QTY$DATE $SLNO $EMP";

        }

        $update_flag = 1;
		

        if ($check_flag == 0) {
            if ($PRIMARY_ID > 0 or $SECONDARY_ID > 0) {
                if ($request['barCodeValue'] != $scanShouldBe) {
                    $update_flag = 0;
                    echo "<br><font color='red' size='+2'>Cannot Update this barcode..
                     <br>Scan the Box QRCODE created just now.. to continue</font><br>";
                    echo "<script>$('#barcodeScanIn').val('');invalidScan();</script>";
					

                } else {
                    $update_flag = 0;
                    if ($PRIMARY_ID > 0) {
                        barcodePrimary_model::where('id', '=', $PRIMARY_ID)
                            ->update(['VALUE' => $scanShouldBe]);

                        barcodePrimary_model::where('id', '=', $PRIMARY_ID)->update(['APPROVED' => '1']);
                        products_scannedModel::where('WORK_ORDER_ID', '=', $request['WORK_ORDER_ID'])
                            ->where('PRIMARY_BARCODE', '=', $PRIMARY_ID)
                            ->update(['PRIMARY_BARCODE_APPROVED' => '1']);

                    } else
                    if ($SECONDARY_ID > 0) {
                        barcodeSecondary_model::where('id', '=', $SECONDARY_ID)->update(['VALUE' => $request['barCodeValue']]);
                        barcodeSecondary_model::where('id', '=', $SECONDARY_ID)->update(['APPROVED' => '1']);

                    }

                    echo "<br><font color='blue' size='+2'> Box QRCODE Scanned and completed...
                     <br>Now you can scan Product barcode</font><br>";

                }
            }

            if ($update_flag == 1 and $PRIMARY_ID == 0 and $SECONDARY_ID == 0) {
                $ScanDATA_model = ScanDATA_model::find('1');
                $ScanDATA_model->scan_value = $request['barCodeValue'];
                $ScanDATA_model->save();

                $CHECK = products_scannedModel::where('PRODUCT_BARCODE', '=', $request['barCodeValue'])
                    ->whereNull('CANCEL')
                    ->count();
                if ($CHECK > 0) {
                    ///////////////////////////
                    $CHECK = products_scannedModel::where('PRODUCT_BARCODE', '=', $request['barCodeValue'])
                    ->whereNull('CANCEL')->first();
                    echo "<font color='red' size='+1'><br>DUPLICATE FOUND IN:";
                   
                    echo "<table><tr><td>WORK ORDER ID</td><td> ".$CHECK->WORK_ORDER_ID;
                    $WORK_ORDER=work_order_model::where('id','=',$CHECK->WORK_ORDER_ID)
                    ->value('order');
                    echo "</td></tr><tr><td>WORK ORDER NO </td><td>".$WORK_ORDER;
                    echo "</td></tr><tr><td>PRIMARY BOXNO </td><td>".$CHECK->PRIMARY_BARCODE;
                    echo "</td></tr><tr><td>SECONDARY BOXNO </td><td>".$CHECK->SECONDARY_BARCODE;

                    echo "</td></tr></table></font>";



                    /////////////////////////
                    $INSERT = new DuplicateScanModel;
                    $INSERT->barcode_type='PART';
                    $INSERT->barcode_value=$request['barCodeValue'];
                    
                    $INSERT->work_order_id= $request['WORK_ORDER_ID'];
                    $INSERT->emp=Session::get('createdby_id');
                    $INSERT->created_at=date('Y-m-d H:i:s');
                    $INSERT->save();

                    echo "<script>$('#barcodeScanIn').val('');invalidScan();</script>";
                    echo "<br><font color='orange'>Duplicate Attempt blocked, ..This barcode was scanned Already..</font>";
                } else {
                    $INSERT = new products_scannedModel;
                    $INSERT->PRODUCT_BARCODE = $request['barCodeValue'];
                    $INSERT->CUSTOMER_PART_NO = $request['CUSTOMER_PART_NO'];
                    $INSERT->WORK_ORDER_ID = $request['WORK_ORDER_ID'];
                    $INSERT->VISION_PERCENT = $request['VISION_PERCENT'];
                    $INSERT->save();

                }

            }
            echo "Last Scan :<input readonly value='" . $request['barCodeValue'] . "' style='font-size:60px;font-weight: bold;' >
            on " . date('d-m-Y H:i:s');

        }

        $PACKING_FACTOR = $request['PACKING_FACTOR'];
        $BILLED_QTY = $request['YIELD_QTY'];


        /// primary lable generation check
        $unLableCount = products_scannedModel::where('WORK_ORDER_ID', '=', $request['WORK_ORDER_ID'])
            ->whereNull('PRIMARY_BARCODE')->whereNull('CANCEL')->count();

        $LabledCountUnApproved = products_scannedModel::where('WORK_ORDER_ID', '=', $request['WORK_ORDER_ID'])
            ->whereNull('PRIMARY_BARCODE_APPROVED')->whereNull('CANCEL')->count();

        if ($unLableCount == $PACKING_FACTOR || $LabledCountUnApproved == $PACKING_FACTOR) {

            $ID = barcodePrimary_model::select('id')
                ->where('WORK_ORDER_ID', '=', $request['WORK_ORDER_ID'])
                ->where('CUSTOMER_PART_NUMBER', '=', $request['CUSTOMER_PART_NO'])
                ->where('IPR_REF', '=', $request['IPR_REF'])
                ->whereNull('APPROVED')->first();

            $PRIMARY_ID = $ID['id'];

            if ($PRIMARY_ID > 0) {
                // Primary label generated and not approved condition

                $PRIMARY = barcodePrimary_model::where('id', '=', $PRIMARY_ID)->first();
                $CUSTOMER_NAME = $PRIMARY['CUSTOMER_NAME'];
                $CUSTOMER_PART_NUMBER = $PRIMARY['CUSTOMER_PART_NUMBER'];
                $IPR_REF = $PRIMARY['IPR_REF'];
                $WEIGHT = $PRIMARY['WEIGHT'];
                $EMP = $PRIMARY['EMP'];
                $DATE = $PRIMARY['DATE'];
                $SLNO = $PRIMARY_ID;
                $QTY = $PRIMARY['QTY'];

                $data = [

                    'CUSTOMER_NAME' => $CUSTOMER_NAME,
                    'CUSTOMER_PART_NUMBER' => $CUSTOMER_PART_NUMBER,
                    'IPR_REF' => $IPR_REF,
                    'WEIGHT' => $WEIGHT,
                    'EMP' => $EMP,
                    'DATE' => $DATE,
                    'QTY' => $QTY,
                    'PRIMARY_ID' => $PRIMARY_ID,
                    'SLNO' => $SLNO,

                ];

            } else {
                // Primary label need to be generated
                //CHECK CANCELLED SLNOS TO USE
                $SLNO = 0;
                $CANCELED = barcodePrimary_model::where('WORK_ORDER_ID', '=', $request['WORK_ORDER_ID'])
                    ->where('CUSTOMER_PART_NUMBER', '=', $request['CUSTOMER_PART_NO'])
                    ->whereNotNull('CANCEL')
                    ->orderBy('SL_NO', 'DESC')->get();
                foreach ($CANCELED as $canceled) {
                    // echo "<br>". $canceled['SL_NO'];
                    $UsedBack = barcodePrimary_model::where('WORK_ORDER_ID', '=', $request['WORK_ORDER_ID'])
                        ->where('CUSTOMER_PART_NUMBER', '=', $request['CUSTOMER_PART_NO'])
                        ->whereNull('CANCEL')->where('APPROVED', '=', 1)
                        ->where('SL_NO', '=', $canceled['SL_NO'])->count();
                    if ($UsedBack == 0) {

                        $SLNO = $canceled['SL_NO'];

                    }
                }
                if ($SLNO == 0) {
                    // if cancelled SL no not available
                    $SLNO = barcodePrimary_model::where('WORK_ORDER_ID', '=', $request['WORK_ORDER_ID'])
                        ->where('CUSTOMER_PART_NUMBER', '=', $request['CUSTOMER_PART_NO'])
                        ->where('IPR_REF', '=', $request['IPR_REF'])
                        ->where('APPROVED', '=', 1)->count();
                    $SLNO++;

                }

                $WEIGHT = productsModel::where('Customer_part_no', '=', $request['CUSTOMER_PART_NO'])
                    ->where('Customer_name', '=', $request['CUSTOMER_NAME'])->value('Min_Weight');
                $WEIGHT = round($WEIGHT, 6);
				if($WEIGHT==0){$WEIGHT=0;}
                $PRIMARY = new barcodePrimary_model;
                $PRIMARY->WORK_ORDER_ID = $request['WORK_ORDER_ID'];
                $PRIMARY->CUSTOMER_NAME = $request['CUSTOMER_NAME'];
                $PRIMARY->CUSTOMER_PART_NUMBER = $request['CUSTOMER_PART_NO'];
                $PRIMARY->IPR_REF = $request['IPR_REF'];
                $PRIMARY->SL_NO = '';//$SLNO
                // Weight to be et from Weighing scale output
                $PRIMARY->WEIGHT = $WEIGHT;
                $PRIMARY->EMP = Session::get('createdby_id');
                $PRIMARY->DATE = date('d-m-Y H:i:s');
                $PRIMARY->QTY = $request['PACKING_FACTOR'];
                $PRIMARY->save();
                $PRIMARY_ID = $PRIMARY->id;

                $unLabledRecords = products_scannedModel::where('WORK_ORDER_ID', '=', $request['WORK_ORDER_ID'])
                    ->whereNull('PRIMARY_BARCODE')->update(['PRIMARY_BARCODE' => $PRIMARY_ID]);

                $data = [
                    'WORK_ORDER_ID' => $request['WORK_ORDER_ID'],
                    'CUSTOMER_NAME' => $request['CUSTOMER_NAME'],
                    'CUSTOMER_PART_NUMBER' => $request['CUSTOMER_PART_NO'],
                    'IPR_REF' => $request['IPR_REF'],
                    'WEIGHT' => $WEIGHT,
                    'EMP' => Session::get('createdby_id'),
                    'DATE' => date('d-m-Y H:i:s'),
                    'QTY' => $request['PACKING_FACTOR'],
                    'PRIMARY_ID' => $PRIMARY_ID,
                    'SLNO' => $PRIMARY_ID,

                ];

            }

            echo "<br><br><font color='blue'>Click  and Print this <font size='+3'>PRIMARY </font> Lable,<br>
            Stick it in The Box Packed, <br>
Scan the same label QRCode to confirm and continue </font><br>";
            $URL_LINK = url('primaryLablePrint') . "?data=" . $PRIMARY_ID;
            echo "<a id='primaryLableAnchorId' style=' text-decoration: none;
            display: inline-block;color: black;' href='" . url('primaryLablePrint') . "?data=" . $PRIMARY_ID . "' target='_blank' >";
            echo view('barcode/primary')->with($data);
            echo "</a>
            <script>PrintAndClose('". $URL_LINK."')</script>";
           

        }
        echo "<br><br>";

        if($request['MASTER_PACKING_FACTOR']==0 OR $request['MASTER_PACKING_FACTOR']=='' 
         OR $request['MASTER_PACKING_FACTOR']==NULL)
         {

         } else
         {
            echo self::secondary($request['WORK_ORDER_ID']);

         }
        
        
        

         echo self::scannedProductsInWorkOrder($request);
        echo self::checkSaleOrderItemComplete($request['WORK_ORDER_ID'], $request['CUSTOMER_PART_NO']);
        echo "<script>$('#barcodeScanIn').focus();</script>";

    }
    public function scannedProductsInWorkOrder($request)
    {
         $PACKING_FACTOR = $request['PACKING_FACTOR'];
         $BILLED_QTY = $request['YIELD_QTY'];

            $countUnboxed = products_scannedModel::
            where('WORK_ORDER_ID', '=', $request['WORK_ORDER_ID'])
            ->whereNull('CANCEL')
            ->whereNull('PRIMARY_BARCODE')
            ->where('CUSTOMER_PART_NO', '=', $request['CUSTOMER_PART_NO'])
            ->count();
           $countPrimary = barcodePrimary_model::
            where('WORK_ORDER_ID', '=', $request['WORK_ORDER_ID'])
            ->where('CUSTOMER_PART_NUMBER', '=', $request['CUSTOMER_PART_NO'])
            ->whereNull('SECONDARY')
            ->whereNull('CANCEL')->sum('QTY');
               $countSecondary =barcodeSecondary_model::
            where('WORK_ORDER_ID', '=', $request['WORK_ORDER_ID'])
            ->whereNull('CANCEL')->sum('QTY');

            $count= $countUnboxed+ $countPrimary+$countSecondary;
           $BALANCE_QTY= $BILLED_QTY - $count;
        $INVOICE = work_order_model::find($request['WORK_ORDER_ID']);
        $INVOICE->SCANNED_QTY = $count;
        $INVOICE->BALANCE_QTY = $BALANCE_QTY;
        $INVOICE->save();
        echo "<script>
        $('#ScannedCount').val('" . $count . "');
        $('#yetToScanCount').val('" . ($BILLED_QTY - $count) . "');
        </script>";

        if(($BILLED_QTY - $count)<=0)

        {
            echo "<font color='green' size='+2'>This part Number Packing Completed for this order..</font>";
          //  echo "<script> $('#barcodeScanIn').prop('disabled',true);</script>";

        }

        ///////////////////////////////////////////////
        ////////////////show records of scanned products
        $unLabledRecords = products_scannedModel::select('PRODUCT_BARCODE')
            ->where('WORK_ORDER_ID', '=', $request['WORK_ORDER_ID'])
            ->whereNull('PRIMARY_BARCODE')
            ->whereNull('CANCEL')->count();
        if ($unLabledRecords > 0) {

            $count = 0;
            echo "<table class='table-stripped table-responsive table-hover' style='border: 1px;'><thead><tr>
            <th colspan=5>SCANNED and WAITING FOR PACKING </th></tr></thead><tbody><tr>";
            $unLabledRecords = products_scannedModel::where('WORK_ORDER_ID', '=', $request['WORK_ORDER_ID'])
                ->whereNull('PRIMARY_BARCODE')->whereNull('CANCEL')->get();
            foreach ($unLabledRecords as $LIST) {
                $count++;
                if ($count % 5 == 1) {echo "</tr><tr><td>" . $LIST['PRODUCT_BARCODE'] . " (".$LIST->VISION_PERCENT."%)</td>";}
                 else {echo "<td>" . $LIST['PRODUCT_BARCODE'] . " (".$LIST->VISION_PERCENT."%)</td>";}

            }
            echo "</tr></tbody></table>";

        }
        ///// Primary Completed

        $labelledRecords = barcodePrimary_model::
            where('WORK_ORDER_ID', '=', $request['WORK_ORDER_ID'])
            ->where('CUSTOMER_PART_NUMBER', '=', $request['CUSTOMER_PART_NO'])
            ->whereNull('CANCEL')->whereNotNull('APPROVED')->count();

        if ($labelledRecords > 0) {

            $count = 0;
            echo "<table class='table table-stripped table-responsive table-hover' style='border: 1px;'><thead><tr>
            <th colspan=5> PRIMARY PACKED BOXES</th></tr></thead><tbody><tr>";
            $labelledRecords = barcodePrimary_model::
                where('WORK_ORDER_ID', '=', $request['WORK_ORDER_ID'])
                ->where('CUSTOMER_PART_NUMBER', '=', $request['CUSTOMER_PART_NO'])
                ->whereNotNull('APPROVED')->whereNull('SECONDARY')
                ->whereNull('CANCEL')->get();
            foreach ($labelledRecords as $LIST) {
                $count++;
                if ($count % 5 == 1) {
                    echo " </tr><tr><td>
                    <table class='boxedTable' id='primaryListTable" . $LIST['id'] . "'><tr><td>
                    <button class='box-button'><hr>PRIMARY";
                    ?><button onclick="myDivToggle('barcodeDiv<?php echo $LIST['id']; ?>');">
                    <?php echo $LIST['id'] . "</button>
                                     </button>
                    </td></tr><tr><td><div id='barcodeDiv" . $LIST['id'] . "' style='display:none;'>";
                    $BARCODES = products_scannedModel::where('WORK_ORDER_ID', '=', $request['WORK_ORDER_ID'])
                        ->where('CUSTOMER_PART_NO', '=', $request['CUSTOMER_PART_NO'])
                        ->whereNull('CANCEL')
                        ->where('PRIMARY_BARCODE', '=', $LIST['id'])->get();
                    //Print again
                    echo "<a   href='" . url('primaryLablePrint') . "?data=" . $LIST['id'] . "' target='_blank' >
                    <button style='width:100%' class='btn btn-primary'>PRINT THIS LABEL</button></a><br>";
                    echo "<button  style='width:100%'  data-toggle='modal' data-target='#myModal'  class='btn btn-danger'
                     onclick='cancellPacked(" . $request['WORK_ORDER_ID'] . "," . $request['CUSTOMER_PART_NO'] . "," . $LIST['id'] . "," . $LIST['id'] . ");'>
                    CANCEL THIS PACKING</button>";

                    foreach ($BARCODES as $barcode) {
                        echo "<font size='-3'><br>" . $barcode['PRODUCT_BARCODE'] . "</font>";
                    }

                    echo "</div></td></tr></table></td> ";

                } else {
                    echo " <td>
                    <table class='boxedTable'><tr><td>
                    <button class='box-button'><hr>PRIMARY";
                    ?><button onclick="myDivToggle('barcodeDiv<?php echo $LIST['id']; ?>')">
                    <?php echo $LIST['id'] . "</button>
                                     </button>
                    </td></tr><tr><td><div id='barcodeDiv" . $LIST['id'] . "' style='display:none;'>";
                    $BARCODES = products_scannedModel::where('WORK_ORDER_ID', '=', $request['WORK_ORDER_ID'])
                        ->where('CUSTOMER_PART_NO', '=', $request['CUSTOMER_PART_NO'])
                        ->whereNull('CANCEL')
                        ->where('PRIMARY_BARCODE', '=', $LIST['id'])->get();
                    //Print again
                    echo "<a  href='" . url('primaryLablePrint') . "?data=" . $LIST['id'] . "' target='_blank' >
                    <button class='btn btn-primary'  style='width:100%' >PRINT THIS LABEL</button></a><br>";
                    echo "<button  style='width:100%'  data-toggle='modal' data-target='#myModal'  class='btn btn-danger'
                     onclick='cancellPacked(" . $request['WORK_ORDER_ID'] . "," . $request['CUSTOMER_PART_NO'] . "," . $LIST['id'] . "," . $LIST['id'] . ");'>
                    CANCEL THIS PACKING</button>";
                    foreach ($BARCODES as $barcode) {
                        echo "<font size='-3'><br>" . $barcode['PRODUCT_BARCODE'] . "</font>";
                    }

                    echo "</div></td></tr></table></td> ";
                }

            }
            echo "</tr></tbody></table>";

        }
        ////// Primary Completed Ends here

        //////SEcondary Completed starts here
        $labelledRecords = barcodeSecondary_model::
            where('WORK_ORDER_ID', '=', $request['WORK_ORDER_ID'])
            ->whereNull('CANCEL')->whereNotNull('APPROVED')->count();

        if ($labelledRecords > 0) {

            $count = 0;
            echo "<table class='table table-stripped table-responsive table-hover' style='border: 1px;'><thead><tr>
         <th colspan=5> SECONDARY PACKED BOXES</th></tr></thead><tbody><tr>";
            $labelledRecords = barcodeSecondary_model::
                where('WORK_ORDER_ID', '=', $request['WORK_ORDER_ID'])
                ->whereNotNull('APPROVED')
                ->whereNull('CANCEL')->get();
            foreach ($labelledRecords as $LIST) {
                $count++;
                if ($count % 5 == 1) {
                    echo " </tr><tr><td>
                 <table class='boxedTable' id='secondaryListTable" . $LIST['id'] . "'><tr><td>
                 <button class='master-box-button'><hr>SECONDARY";
                    ?><button onclick="myDivToggle('barcodeDiv<?php echo $LIST['id']; ?>');">
                 <?php echo $LIST['id'] . "</button>
                                  </button>
                 </td></tr><tr><td>";
                    echo "<div id='barcodeDiv" . $LIST['id'] . "' style='display:none;'>";
                    $BOXES = barcodePrimary_model::where('WORK_ORDER_ID', '=', $request['WORK_ORDER_ID'])
                        ->whereNull('CANCEL')
                        ->where('SECONDARY', '=', $LIST['id'])->get();
                    //Print again
                    echo "<a    class='printPage'  style='width:50%;' href='" . url('secondaryLablePrint') . "?data=" . $LIST['id'] . "' target='_blank' >
                 <button class='btn btn-primary'>PRINT THIS LABEL</button></a><br>";
                    echo "<button  data-toggle='modal'  style='width:50%;' data-target='#myModal'  class='btn btn-danger' >
                 CANCEL THIS PACKING</button>";

                    foreach ($BOXES as $BOX) {
                        echo "<br><BUTTON class='btn ' style='background-color:#deb76a; width:50%;'>PRIMARY " . $BOX['id'] . "</button>";
                    }

                    echo "</div> ";
                    echo "</td></tr></table></td> ";

                } else {
                    echo " <td>
                 <table class='boxedTable' id='secondaryListTable" . $LIST['id'] . "'><tr><td>
                 <button class='master-box-button'><hr>SECONDARY";
                    ?><button onclick="myDivToggle('barcodeDiv<?php echo $LIST['id']; ?>');">
                 <?php echo $LIST['id'] . "</button>
                                  </button>
                 </td></tr><tr><td>";
                    echo "<div id='barcodeDiv" . $LIST['id'] . "' style='display:none;'>";
                    $BOXES = barcodePrimary_model::where('WORK_ORDER_ID', '=', $request['WORK_ORDER_ID'])
                        ->whereNull('CANCEL')
                        ->where('SECONDARY', '=', $LIST['id'])->get();
                    //Print again
                    echo "<a    class='printPage'  style='width:50%;' href='" . url('secondaryLablePrint') . "?data=" . $LIST['id'] . "' target='_blank' >
                 <button class='btn btn-primary'>PRINT THIS LABEL</button></a><br>";
                    echo "<button  data-toggle='modal'  style='width:50%;' data-target='#myModal'  class='btn btn-danger'>
                 CANCEL THIS PACKING</button>";

                    foreach ($BOXES as $BOX) {
                        echo "<br><BUTTON class='btn ' style='background-color:#deb76a; width:50%;'>PRIMARY " . $BOX['id'] . "</button>";
                    }

                    echo "</div> ";
                    echo "</td></tr></table></td> ";
                }

            }
            echo "</tr></tbody></table>";

        }
        echo "<script>$('#barcodeScanIn').focus();</script>";
        //////Secondary completed Ends Here
    }
    public function openUpdateHeatCode(Request $request)
    {
        $DATA = [
            'WORK_ORDER_ID' => $request['WORK_ORDER_ID'],
        ];

        return view('/workOrders/openUpdateHeatCode')->with($DATA);

    }
    public function updateHeatCode(Request $request)
    {
        $UPDATE = work_order_model::find($request['WORK_ORDER_ID']);
        $UPDATE->HEAT_CODE = $request['HEAT_CODE'];
        $UPDATE->save();
        echo "<script> $('#myModal').modal('hide');
        prepareWorkOrder('" . $request['WORK_ORDER_ID'] . "');</script>";
        echo "<script>$('#barcodeScanIn').focus();</script>";
    }
    public function cancellPackedConfirm(Request $request)
    {
        $data = [

            'CUSTOMER_PART_NO' => $request['CUSTOMER_PART_NO'],
            'WORK_ORDER_ID' => $request['WORK_ORDER_ID'],
            'id' => $request['id'],
            'PRIMARY_BARCODE' => $request['PRIMARY_BARCODE'],

        ];

        return view('/workOrders/packingCancell')->with($data);
    }
    public function delete_Package(Request $request)
    {
        $WORK_ORDER_ID = $request['WORK_ORDER_ID'];
        $CUSTOMER_PART_NO = $request['CUSTOMER_PART_NO'];
        $SL_NO = $request['SL_NO'];
        $PRIMARY_BARCODE = $request['PRIMARY_BARCODE'];

        $PRIMARY = barcodePrimary_model::where('id', '=', $PRIMARY_BARCODE)
            ->where('WORK_ORDER_ID', '=', $WORK_ORDER_ID)
            ->where('CUSTOMER_PART_NUMBER', '=', $CUSTOMER_PART_NO)->UPDATE(['CANCEL' => '1']);
        $SCANNED = products_scannedModel::where('PRIMARY_BARCODE', '=', $PRIMARY_BARCODE)
            ->where('WORK_ORDER_ID', '=', $WORK_ORDER_ID)
            ->where('CUSTOMER_PART_NO', '=', $CUSTOMER_PART_NO)
            ->UPDATE(['CANCEL' => '1']);
        echo "DONE SUCEESS";
        echo "<script> $('#myModal').modal('hide');updateScannedCode('check');</script>";

    }

    public function primaryLablePrint(Request $request)
    {
        $PRIMARY_ID = $request['data'];

        $PRIMARY = barcodePrimary_model::where('id', '=', $PRIMARY_ID)->first();
        $CUSTOMER_NAME = $PRIMARY['CUSTOMER_NAME'];
        $CUSTOMER_PART_NUMBER = $PRIMARY['CUSTOMER_PART_NUMBER'];
        $IPR_REF = $PRIMARY['IPR_REF'];
        $WEIGHT = $PRIMARY['WEIGHT'];
        $EMP = $PRIMARY['EMP'];
        $DATE = $PRIMARY['DATE'];
        //$SLNO = $PRIMARY['SL_NO'];
        $QTY = $PRIMARY['QTY'];
        $data = [

            'CUSTOMER_NAME' => $CUSTOMER_NAME,
            'CUSTOMER_PART_NUMBER' => $CUSTOMER_PART_NUMBER,
            'IPR_REF' => $IPR_REF,
            'WEIGHT' => $WEIGHT,
            'EMP' => $EMP,
            'DATE' => $DATE,
            'QTY' => $QTY,
            'PRIMARY_ID' => $PRIMARY_ID,
            'SLNO' => $PRIMARY_ID,

        ];

       // return view('/barcode/Primary_Barcode')->with($data); 
        $pdf = PDF::loadView('/barcode/Primary_Barcode', $data);
        //$pdf->set_paper('A4', 'portrait');

        $labelSize = array(0, 0, 288, 170);
        $pdf->set_paper($labelSize);
        return $pdf->stream();
        

    }
    public function checkSaleOrderItemComplete($WORK_ORDER_ID, $CUSTOMER_PART_NO)
    {

        $WORK_ORDER = work_order_model::where('id', '=', $WORK_ORDER_ID)
            ->where('CUSTOMER_PART_NO', '=', $CUSTOMER_PART_NO)
            ->first();

        if ($WORK_ORDER->SCANNED_QTY == $WORK_ORDER->yield_qty) { // SCAN Complete
            $scanYetToApprove = products_scannedModel::whereNull('PRIMARY_BARCODE_APPROVED')
                ->where('CUSTOMER_PART_NO', '=', $CUSTOMER_PART_NO)
                ->where('WORK_ORDER_ID', '=', $WORK_ORDER_ID)->count();

            if ($scanYetToApprove == 0) {

                $secondarToApprove = barcodeSecondary_model::
                    where('WORK_ORDER_ID', '=', $WORK_ORDER_ID)
                    ->whereNull('APPROVED')
                    ->count();
                if ($secondarToApprove == 0 or $secondarToApprove == '') {

                    echo "<font color='green' size='+2'>This part Number Packing Completed for this order..</font>";
            echo "<script> $('#barcodeScanIn').prop('disabled',true);</script>";

                }else{ echo "<script>$('#barcodeScanIn').focus();</script>";}

            }
            else{ echo "<script>$('#barcodeScanIn').focus();</script>";}

        }
        else{ echo "<script>$('#barcodeScanIn').focus();</script>";}

    }
    public function secondary($WORK_ORDER_ID)
    {
        $SECONDARY_DISPLAY = 0;
        $RACK_MASTER_Id=0;
        $INVOICE = work_order_model::where('id', '=', $WORK_ORDER_ID)->get();
        foreach ($INVOICE as $request) {
            $billedQty = $request['yield_qty'];
            $PACKING_FACTOR = $request['PACKING_FACTOR'];
            $MASTER_PACKING_FACTOR = $request['MASTER_PACKING_FACTOR'];

        }

        $ID = barcodeSecondary_model::select('id')
            ->where('WORK_ORDER_ID', '=', $WORK_ORDER_ID)
            ->whereNull('APPROVED')->first();

        $SECONDARY_ID = $ID['id'];

        if ($SECONDARY_ID > 0) {
            $SECONDARY_DISPLAY = 1;
            // Secondary label generated and not approved condition

            $SECONDARY = barcodeSecondary_model::where('id', '=', $SECONDARY_ID)->first();
            $CUSTOMER_NAME = $SECONDARY['CUSTOMER_NAME'];
            $CUSTOMER_PART_NUMBER = $SECONDARY['CUSTOMER_PART_NUMBER'];
            $IPR_REF = $SECONDARY['IPR_REF'];
            $WEIGHT = $SECONDARY['WEIGHT'];
            $EMP = $SECONDARY['EMP'];
            $DATE = $SECONDARY['DATE'];
            $SLNO =  $SECONDARY_ID; // $SECONDARY['SL_NO'];
            $QTY = $SECONDARY['QTY'];
            $RACK_MASTER_ID=$SECONDARY['RACK_MASTER_ID'];

            $data = [

                'CUSTOMER_NAME' => $CUSTOMER_NAME,
                'CUSTOMER_PART_NUMBER' => $CUSTOMER_PART_NUMBER,
                'IPR_REF' => $IPR_REF,
                'WEIGHT' => $WEIGHT,
                'EMP' => $EMP,
                'DATE' => $DATE,
                'QTY' => $QTY,
                'PRIMARY_ID' => $SECONDARY_ID,
                'SLNO' => $SECONDARY_ID,

            ];

        }

        $PRIMARY_COUNT = barcodePrimary_model::whereNull('CANCEL')
            ->where('WORK_ORDER_ID', '=', $WORK_ORDER_ID)
            ->where('APPROVED', '=', 1)
            ->whereNull('SECONDARY')->count();
        if ($PRIMARY_COUNT == $MASTER_PACKING_FACTOR) {
            $SECONDARY_DISPLAY = 1;

            // SECONDARY label need to be generated
            //CHECK CANCELLED SLNOS TO USE
            $SLNO = 0;
            $CANCELED = barcodeSecondary_model::where('WORK_ORDER_ID', '=', $WORK_ORDER_ID)
                ->whereNotNull('CANCEL')
                ->orderBy('id', 'DESC')->get();
            foreach ($CANCELED as $canceled) {
                // echo "<br>". $canceled['SL_NO'];
                $UsedBack = barcodeSecondary_model::where('WORK_ORDER_ID', '=', $WORK_ORDER_ID)
                    ->whereNull('CANCEL')->where('APPROVED', '=', 1)
                    ->where('SL_NO', '=', $canceled['SL_NO'])->count();
                if ($UsedBack == 0) {

                    $SLNO = $canceled['SL_NO'];

                }
            }
            if ($SLNO == 0) {
                // if cancelled SL no not available
                $SLNO = barcodeSecondary_model::where('WORK_ORDER_ID', '=', $WORK_ORDER_ID)
                    ->where('APPROVED', '=', 1)->count();
                $SLNO++;

            }
            $WEIGHT = '';
            /*
            $WEIGHT=productsModel::where('Customer_part_no','=',$request['CUSTOMER_PART_NUMBER'])
            ->where('Customer_name','=',$request['CUSTOMER_NAME'])->value('Min_Weight');

             */
            $request['MASTER_PACKING_FACTOR'];
            $request['PACKING_FACTOR'];
            $QTY = $request['MASTER_PACKING_FACTOR'] *  $request['PACKING_FACTOR'];
            $SECONDARY = new barcodeSecondary_model;
            $SECONDARY->WORK_ORDER_ID = $WORK_ORDER_ID;
            $SECONDARY->CUSTOMER_NAME = $request['CUSTOMER_NAME'];
            $SECONDARY->CUSTOMER_PART_NUMBER = $request['CUSTOMER_PART_NO'];
            $SECONDARY->IPR_REF = $request['IPR_REF'];
            $SECONDARY->SL_NO = ''; //$SLNO;
            // Weight to be et from Weighing scale output
            $SECONDARY->WEIGHT = $WEIGHT;
            $SECONDARY->EMP = Session::get('createdby_id');
            $SECONDARY->DATE = date('d-m-Y H:i:s');
            $SECONDARY->QTY = $QTY;
            $SECONDARY->save();
            $SECONDARY_ID = $SECONDARY->id;

            $unLabledRecords = products_scannedModel::where('WORK_ORDER_ID', '=', $WORK_ORDER_ID)
                ->whereNull('SECONDARY_BARCODE')
                ->whereNull('CANCEL')
                ->update(['SECONDARY_BARCODE' => $SECONDARY_ID]);
            $unMarkedPrimaryRecords = barcodePrimary_model::where('WORK_ORDER_ID', '=', $WORK_ORDER_ID)
                ->whereNull('SECONDARY')
                ->whereNull('CANCEL')
                ->update(['SECONDARY' => $SECONDARY_ID]);

            $data = [
                'WORK_ORDER_ID' => $request['WORK_ORDER_ID'],
                'CUSTOMER_NAME' => $request['CUSTOMER_NAME'],
                'CUSTOMER_PART_NUMBER' => $request['CUSTOMER_PART_NO'],
                'IPR_REF' => $request['IPR_REF'],
                'WEIGHT' => $WEIGHT,
                'EMP' => Session::get('createdby_id'),
                'DATE' => date('d-m-Y H:i:s'),
                'QTY' => $QTY,
                'SECONDARY_ID' => $SECONDARY_ID,
                'SLNO' => $SECONDARY_ID,

            ];
            echo "<script>updateScannedCode('check');</script>";

        }

        if ($SECONDARY_DISPLAY == 1 and ($RACK_MASTER_ID!=0 and $RACK_MASTER_ID!='' and $RACK_MASTER_ID!=NULL)) {

            echo "<font color='blue'>Click  and Print this <font size='+3'>SECONDARY </font>Lable,<br>
                        Stick it in The Box Packed, <br>
                    Scan the same label QRCode to confirm and continue </font><br>";
            $URL_LINK = url('secondaryLablePrint') . "?data=" . $SECONDARY_ID;
            echo "<a   class='printPage' style=' text-decoration: none;
            display: inline-block;color: black;' href='" . url('secondaryLablePrint') . "?data=" . $SECONDARY_ID . "' target='_blank' >";
            echo view('barcode/secondary')->with($data);
            echo "</a> <script>PrintAndClose('". $URL_LINK."')</script>";

        }else 
        {
            
            
        }

    }
    public function secondaryLablePrint(Request $request)
    {
        $SECONDARY_ID = $request['data'];

        $SECONDARY = barcodeSecondary_model::where('id', '=', $SECONDARY_ID)->first();
        $CUSTOMER_NAME = $SECONDARY['CUSTOMER_NAME'];
        $CUSTOMER_PART_NUMBER = $SECONDARY['CUSTOMER_PART_NUMBER'];
        $IPR_REF = $SECONDARY['IPR_REF'];
        $WEIGHT = $SECONDARY['WEIGHT'];
        $EMP = $SECONDARY['EMP'];
        $DATE = $SECONDARY['DATE'];
        $SLNO = $SECONDARY_ID;
        $QTY = $SECONDARY['QTY'];
        $RACK_MASTER_ID = $SECONDARY['RACK_MASTER_ID'];
        $RACKDETAILS = RackMaster_model::where('id', '=', $RACK_MASTER_ID)->first();
        $storage_location_id = $RACKDETAILS['storage_location'];
        $rack_id = $RACKDETAILS['rack_id'];
        $bin_no = $RACKDETAILS['bin_no'];
        $bin_name = $RACKDETAILS['bin_name'];
        $location_code = StorageLocation_model::where('id', '=', $storage_location_id)->value('location_code');
        $location_name = StorageLocation_model::where('id', '=', $storage_location_id)->value('location_name');
        $LOCATION =   $location_code . ' >> ' . $rack_id . " >> " . $bin_no . ' >> ' . $bin_name;
        $sequnce = barcodePrimary_model::select('id')->where('SECONDARY', '=', $SECONDARY_ID)->count();
        if($sequnce>0)
        {
            $sequnce = barcodePrimary_model::select('id')->where('SECONDARY', '=', $SECONDARY_ID)->get();
        
            $sequnce_SL = '';
            foreach ($sequnce as $seq) {
                $sequnce_SL = $sequnce_SL . $seq['id'] . ',';
            }
            $SEQUENCE = trim($sequnce_SL, ',');

        }else 
        {
            $SEQUENCE = 'NO DATA'; 
        }
       

        $data = [

            'CUSTOMER_NAME' => $CUSTOMER_NAME,
            'CUSTOMER_PART_NUMBER' => $CUSTOMER_PART_NUMBER,
            'IPR_REF' => $IPR_REF,
            'WEIGHT' => $WEIGHT,
            'EMP' => $EMP,
            'DATE' => $DATE,
            'QTY' => $QTY,
            'PRIMARY_ID' => $SECONDARY_ID,
            'SLNO' => $SLNO,
            'LOCATION' => $LOCATION,
            'SEQUENCE' => $SEQUENCE,

        ];

       
        $pdf = PDF::loadView('/barcode/Secondary_Barcode', $data);
        //$pdf->set_paper('A4', 'portrait');

        $labelSize = array(0, 0, 288, 180);
        $pdf->set_paper($labelSize);
       return $pdf->stream();
      

    }
     public function printMasterLabel(Request $request)
    {
        $INVOICE=MasterBarcode_model::where('INVOICE_ID','=',$request['INVOICE_ID'])->first();
        
        $CUSTOMER_NAME=$INVOICE->CUSTOMER_NAME;
        $IPR_REF=$INVOICE->IPR_REF;
        $CUSTOMER_PART_NUMBER=$INVOICE->CUSTOMER_PART_NUMBER;
        $QUANTITY=$INVOICE->QUANTITY;
        $SUPPLIER=$INVOICE->SUPPLIER;
        $VENDOR_BATCH=$INVOICE->id;
        $PART_DESCRIPTION=$INVOICE->PART_DESCRIPTION;
        $DELIVERY_NOTE=$INVOICE->DELIVERY_NOTE;
        $HEAT_LOT=$INVOICE->HEAT_LOT;
        $HEAT_CODE=$INVOICE->HEAT_CODE;
        $REV_LEVEL=$INVOICE->REV_LEVEL;
        $DATE_MFG=$INVOICE->DATE_MFG;
        $DATE_SHIPPED=$INVOICE->DATE_SHIPPED;
        $EMP=$INVOICE->EMP;
        $FROM_ADDRESS=$INVOICE->FROM_ADDRESS;
        $TO_ADDRESS=$INVOICE->TO_ADDRESS;
        

        $data = [

            'CUSTOMER_NAME' => $CUSTOMER_NAME,
            'IPR_REF'=>$IPR_REF,
            'CUSTOMER_PART_NUMBER' => $CUSTOMER_PART_NUMBER,
            'QUANTITY'=>$QUANTITY,
            'SUPPLIER'=>$SUPPLIER,
            'VENDOR_BATCH'=>$VENDOR_BATCH,
            'PART_DESCRIPTION'=>$PART_DESCRIPTION,
            'DELIVERY_NOTE'=>$DELIVERY_NOTE,
            'HEAT_LOT'=>$HEAT_LOT,
            'HEAT_CODE'=>$HEAT_CODE,
            'REV_LEVEL'=>$REV_LEVEL,
            'DATE_MFG'=>$DATE_MFG,
            'DATE_SHIPPED'=>$DATE_SHIPPED,
            'EMP'=>$EMP,
            'FROM_ADDRESS'=>$FROM_ADDRESS,
            'TO_ADDRESS'=>$TO_ADDRESS,           
 
        ];
         //return view('/barcode/master')->with($data);
        //exit();
          
        $pdf = PDF::loadView('/barcode/master', $data);
        //$pdf->set_paper('A4', 'portrait');

        $labelSize = array(0, 0, 432,288);
        $pdf->set_paper($labelSize);
        return $pdf->stream();


    }
    public function updateOldStocklLocked()
    {
        $oldStockDays=date('Y-m-d H:i:s',strtotime('-30 days'));
     $BIN_STOCK=BinStockModel::where('created_at','<=',$oldStockDays)
     ->where('QTY','>',0)
     ->where('ACTIVE','!=',0)
     ->whereNull('LOCKED')
     ->update(['LOCKED'=>'1']);
    }
       
}
