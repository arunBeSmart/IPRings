<table class='table table-bordered table-responsive table-stripped'>
    <tr><td>Customer Name</td><td>{{$DATA->CUSTOMER_NAME}}</td>
        <td>WORK  Order NO</td><td>{{$DATA->SALE_ORDER}}</td>
        <td>WORK Order Item</td><td>{{$DATA->SALE_ORDER_ITEM}}</td>
        <td>SCANNED QTY</td><td><div id='scannedQtyDiv'><input readonly id='ScannedCount'></div></td>
        <td>IPR REF</td><td>{{$DATA->IPR_REF}} </td>

    </tr>
    <tr>
        <td>Customer Part Number</td><td>{{$DATA->CUSTOMER_PART_NUMBER}}</td>
        <td>Billed Qty</td><td>{{$DATA->BILLED_QTY}}</td>
        <td>Packing Factor</td><td>{{$DATA->PACKING_FACTOR}}</td>
        <td>YET TO SCAN</td><td><div id='yetToScanDiv'><input readonly id='yetToScanCount'></div></td>
    </tr>
</table>
<input type="hidden" id="SALE_ORDER" name="SALE_ORDER" value="{{$DATA->SALE_ORDER}}">
<input type="hidden" id="SALE_ORDER_ITEM" name="SALE_ORDER_ITEM" value="{{$DATA->SALE_ORDER_ITEM}}">
<input type="hidden" id="INVOICE_ID" name="INVOICE_ID" value="{{$DATA->INVOICE_ID}}">
<input type="hidden" id="CUSTOMER_PART_NUMBER" name="CUSTOMER_PART_NUMBER" value="{{$DATA->CUSTOMER_PART_NUMBER}}">
<input type="hidden" id="CUSTOMER_NAME" name="CUSTOMER_NAME" value="{{$DATA->CUSTOMER_NAME}}">
<input type="hidden" id="BILLED_QTY" name="BILLED_QTY" value="{{$DATA->BILLED_QTY}}">
<input type="hidden" id="PACKING_FACTOR" name="PACKING_FACTOR" value="{{$DATA->PACKING_FACTOR}}">
<input type="hidden" id="PACKING_BOX_COUNT" name="PACKING_BOX_COUNT" value="{{$DATA->PACKING_BOX_COUNT}}">
<input type="hidden" id="IPR_REF" name="IPR_REF" value="{{$DATA->IPR_REF}}">
<input type="hidden" id="BILLING_DOCUMENT" name="BILLING_DOCUMENT" value="{{$DATA->BILLING_DOCUMENT}}">
<input type="hidden" id="BILLING_DATE" name="BILLING_DATE" value="{{$DATA->BILLING_DATE}}">

SCAN <input id='barcodeScanIn'  autofocus onchange="updateScannedCode(this.value);";>
<div id='barcodeInformDiv'></div>


<script>
  function updateScannedCode(barCodeValue)
  {
    SALE_ORDER=$('#SALE_ORDER').val();
    SALE_ORDER_ITEM=$('#SALE_ORDER_ITEM').val();
    INVOICE_ID=$('#INVOICE_ID').val();
    CUSTOMER_PART_NUMBER=$('#CUSTOMER_PART_NUMBER').val();
    CUSTOMER_NAME=$('#CUSTOMER_NAME').val();
    BILLED_QTY=$('#BILLED_QTY').val();
    PACKING_BOX_COUNT=$('#PACKING_BOX_COUNT').val();
    PACKING_FACTOR=$('#PACKING_FACTOR').val();
    IPR_REF=$('#IPR_REF').val();
    
    data = 'SALE_ORDER='+SALE_ORDER + '&SALE_ORDER_ITEM='+SALE_ORDER_ITEM +
      '&INVOICE_ID='+INVOICE_ID + '&CUSTOMER_PART_NUMBER='+CUSTOMER_PART_NUMBER +
      '&CUSTOMER_NAME='+CUSTOMER_NAME + '&BILLED_QTY='+BILLED_QTY +
      '&PACKING_BOX_COUNT='+PACKING_BOX_COUNT +'&PACKING_FACTOR='+PACKING_FACTOR+
      '&barCodeValue='+barCodeValue+'&IPR_REF='+IPR_REF;
       var completeurl = url +'/updateScannedCode' ;
       var type = "POST";
       var place = 'barcodeInformDiv';
       ajaxload(type, completeurl, data, place);
  }
  updateScannedCode('check');
</script>

