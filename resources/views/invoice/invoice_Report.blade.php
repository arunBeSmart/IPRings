<?php 
use App\Models\products_scannedModel; 
use App\Models\productsModel; 
use App\Http\Controllers\InvoiceController;
use App\Models\InvoiceModel;
?>
<style>
     @page { margin:20px; }
body { margin: 20px; }

table, td, th {  
  border: 1px solid black;
  text-align: right;
  font-size:16px
}
@page { margin: 5px 5px 10px; }
#footer {
    position: fixed;
    left: 20px;
    bottom: 0;
    text-align: center;
    }
#footer .page:after {
    content: counter(page);
}

</style>
<?php 
$INVOICE=InvoiceModel::where('id','=',$INVOICE['INVOICE_ID'])->first();
       echo " <table width='100%' border='1' style='border-collapse:collapse;'><tr>
       <td>BILLING DOC. NO</td><th>".$INVOICE->BILLING_DOCUMENT."</td>
       <td>BILL DATE</td><th>".date('d-m-Y',strtotime($INVOICE->BILLING_DATE))."</td>
       <td>SALE ORDER</td><th>".$INVOICE->SALES_ORDER."</td>
       </tr>
       <tr>
       <td>CUSTOMER PO. NO</td><th>".$INVOICE->CUSTOMER_PO_No."</td>
       <td>CUSTOMER PO. DATE</td><th>".date('d-m-Y',strtotime($INVOICE->CUSTOMER_PO_Date))."</td>
       <td>BILLED QTY</td><th>".$INVOICE->BILLED_QTY."</td>
       </tr>
       ";

       $PART_NUM=$_REQUEST['PART_NUM'];
       $PRODUCT=   productsModel::where('Customer_part_no','=',$PART_NUM) ->first();
    
        echo "<tr>
        <td> MATERIAL CODE</td> <th>".$PRODUCT->material_code." </td>
        <td>PART NAME </td> <th>".$PRODUCT->product_name."</td>
        <td>IPR REF </td> <th>".$PRODUCT->ipr_Ref_no."</td> </tr><tr>

        <td>CUSTOMER PART NO</td> <th>".$PRODUCT->Customer_part_no."</td>
        <td>CUSTOMER NAME</td> <th>".$INVOICE->CUSTOMER_NAME."</td> 
        <td>MANUFACTURER</td> <th> IP RINGS</td> </tr>
</table><br>
        ";
       ?>
<table border=1 style='border-collapse:collapse;' class="table table-bordered table-striped table-colored-header table-responsive table-hover"  >
   
  @foreach($PRIMARY as $primary)
  
  <tr><td>Secondary 
  @if($primary->SECSLNO>0)
  {{$primary->SECSLNO}}
  @else
  {{$primary->SECONDARY}}
    @endif  
  </td><td>Primary {{$primary->id}} 
  <?php  $RECORDS_COUNT=products_scannedModel::where('PRIMARY_BARCODE','=',$primary->id)->count(); ?>
  @if($RECORDS_COUNT>0)
  ({{$RECORDS_COUNT}})
  @else
  ({{$primary->QTY}})
  @endif
  </td>
  <td>

@if($RECORDS_COUNT>0)

    <?php $SLNOS=products_scannedModel::where('PRIMARY_BARCODE','=',$primary->id)->get();
    $count=1;
    ?>
    <table border=1 style='border-collapse:collapse;'>
    @foreach($SLNOS as $VALUE)
    @if($count%5==1)
    <tr><td>
    @else
    <td>
    @endif
     {{$VALUE->PRODUCT_BARCODE}} ({{$VALUE->VISION_PERCENT}}%) 
    @if($count%5==0)
    </td></tr>
    @else
    </td>
    @endif

    <?php $count++; ?>
    @endforeach
    </table>
@else
<center>PARTS without BARCODES</center>
@endif


</td></tr>


  @endforeach
</table>


<div id="footer">
  <table  style='border:0;'><tr><td>Page </td><td><div class="page"></div></td></tr> </table>
</div>