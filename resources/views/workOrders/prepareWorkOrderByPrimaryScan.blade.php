<table class='table table-bordered table-responsive table-stripped'>
    <tr><td>CUSTOMER NAME</td><td>{{$DATA->CUSTOMER_NAME}}</td>
    <td>PART NAME</td><td>{{$DATA->material_description}}</td>
        
    <td>ORDER QTY</td><td>{{$DATA->yield_qty}}</td>
        <td>SCANNED QTY</td><td><div id='scannedQtyDiv'><input readonly id='ScannedCount'></div></td>
        <td>IPR REF</td><td>{{$DATA->IPR_REF}} </td>
        <td>CFF QTY</td><td>{{$DATA->CFFWO_QTY}} </td>
    </tr>
    <tr>
        <td>Customer Part Number</td><td>{{$DATA->CUSTOMER_PART_NO}}</td>
        <td>WORK  Order NO</td><td>{{$DATA->order}}</td>
        
        <td>Packing Factor</td><td>{{$DATA->PACKING_FACTOR}}</td>
        <td>YET TO SCAN</td><td><div id='yetToScanDiv'><input readonly id='yetToScanCount'></div></td>
        <td>HEAT CODE</td><td>{{$DATA->HEAT_CODE}}
@if($DATA->HEAT_CODE=='')
<button class="btn btn-success" data-toggle="modal" data-target="#myModal" onclick='updateHeatCode({{$DATA->id}});'> Update</button>
@endif

        </td><td>CFT QTY</td><td>-{{$DATA->CFTWO_QTY}}</td>
    </tr>
</table>
<input type="hidden" id="WORK_ORDER_ID" name="WORK_ORDER_ID" value="{{$DATA->id}}">
<input type="hidden" id="ORDER" name="ORDER" value="{{$DATA->order}}">
<input type="hidden" id="CUSTOMER_PART_NO" name="CUSTOMER_PART_NO" value="{{$DATA->CUSTOMER_PART_NO}}">
<input type="hidden" id="CUSTOMER_NAME" name="CUSTOMER_NAME" value="{{$DATA->CUSTOMER_NAME}}">
<input type="hidden" id="YIELD_QTY" name="YIELD_QTY" value="{{$DATA->yield_qty}}">
<input type="hidden" id="PACKING_FACTOR" name="PACKING_FACTOR" value="{{$DATA->PACKING_FACTOR}}">
<input type="hidden" id="MASTER_PACKING_FACTOR" name="MASTER_PACKING_FACTOR" value="{{$DATA->MASTER_PACKING_FACTOR}}">
<input type="hidden" id="IPR_REF" name="IPR_REF" value="{{$DATA->IPR_REF}}">
<input type="hidden" id="MATERIAL_CODE" name="MATERIAL_CODE" value="{{$DATA->material_code}}">
<input type="hidden" id="HEAT_CODE" name="HEAT_CODE" value="{{$DATA->HEAT_CODE}}">
<input type="hidden" id="MATERIAL_DESCRIPTION" name="MATERIAL_DESCRIPTION" value="{{$DATA->material_description}}">


** Scan PACKED PRIMARY BOXes  -  those  which Parts does not have barcode to scan<br>
SCAN PRIMARY LABEL<input id='barcodeScanIn'  autofocus onchange="updateScannedPrimaryCode(this.value);";>

<div id='alertMessageDiv'></div><div id='barcodeInformDiv'></div>
<input><input><input><input>
<script>
 
  updateScannedCode('check');
</script>

