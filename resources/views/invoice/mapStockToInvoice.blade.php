<div class="modal-dialog">

      <!-- Modal content-->
    <div class="modal-content"  style="width:150%;">
                    <div class="modal-header">
   <table class='table' ><tr><td> <h4 class="modal-title" > STOCK TO INVOICE  MAPPING</h4></td>
   <td align='right'>

         <a href='#' class="close" data-dismiss="modal">
            <img width="20%" height="25%" src="{{url('resources\img\close.jpg')}}">
</a> 

   </td></tr></table>

                    </div>
        <div class="modal-body">
           
<table class='table '><tr><th>BILLED QTY</th><td><button>{{$INVOICE->BILLED_QTY}}</button></td>
<th>ASSIGNED QTY</th><td><input class='form-control' readonly id='ASSIGNED_QTY' value=0></td>
<th>YET TO ASSIGN QTY</th><td><input class='form-control'  readonly id='YET_TO_ASSIGN_QTY' value=0></td></tr></table>

<table class='table'>
    <tr><td>Scan Secondary Box QRCODE : </td>
    <td width='60%'><input type="text" id='barcodeScanIn' class='form-control' autofocus onchange='getBinStockToInvoice( "{{$INVOICE->CUSTOMER_PART_NUMBER}}",this.value);'>
    </td></tr></table>

<input type="hidden" name="INVOICE_ID" id="INVOICE_ID" value="{{$INVOICE->id}}">
<input type="hidden" name="BILLED_QTY" id="BILLED_QTY" value="{{$INVOICE->BILLED_QTY}}">
            <table id="MappStkInvoiceTable" width="90%" class="table table-bordered table-striped table-responsive table-striped table-hover"  >
    <thead><tr>
    <th>ID</th>
        <th>LOCATION</th>
        <th>RACK</th>
		<th>BIN NAME</th>
		<th>BIN NO</th>
        <th>WORK <BR>ORDER</th>
		<th>AVL STK</th>
        <th>ASSIGN STK</th>

    </tr></thead>
<?php $BILLED_QTY = $INVOICE->BILLED_QTY;
$ASSIGNED_QTY = 0;
$LOCKED_FLAG=0;
?>

  <tbody>
        @foreach($STOCK as $record)
    <tr id="rowId{{$record->id}}">
        <td >{{$record->id}}</td>
        <td>{{$record->location_code}}</td>
        <td>{{$record->rack_id}}</td>

        <td>{{$record->bin_name}}</td>
        <td>{{$record->bin_no}}</td>
        <td>{{$record->order}}</td>
        <td>{{$record->QTY}}</td><td>
        <?php
$STOCK = $record->QTY;
echo "<input type='hidden' name='BINSTOCK_ID[]' id='BINSTOCK_ID" . $record->id . "' value='" . $record->id . "'>";
echo "<input type='hidden' name='QTY[]'  id='QTY" . $record->id . "' value='" . $record->QTY . "'>";

if ($record->LOCKED!=1) {
    echo "<input name='assigned[]' id='assigned" . $record->id . "' onchange='getTotal(" . $record->id . ");' class='form-control assigned' readonly value='0' >";

} else
{
    echo "<input type='hidden' name='assigned[]' id='assigned" . $record->id . "'  readonly disabled  >";

    $LOCKED_FLAG++;
    ?> <img src="{{url('/resources/img/locked.jpg')}}" width='40px' height='40px'><?php
}
?>


        </td>

</tr>

    @endforeach
    <?php if ($BILLED_QTY == 0) {echo "<script>$('#YET_TO_ASSIGN_QTY').val(0);
        $('#ASSIGNED_QTY').val(" . $ASSIGNED_QTY . ");</script>";} else {
    echo "<script>$('#YET_TO_ASSIGN_QTY').val(" . $BILLED_QTY . ");
        $('#ASSIGNED_QTY').val(" . $ASSIGNED_QTY . ");</script>";
}?>

    </tbody>
    <tfoot>
      
        <tr><th colspan='3'>HEAT_LOT<font color='red'>*</font></th>
    <th  colspan='4'><input type="text" name="HEAT_LOT" id="HEAT_LOT" class='form-control'></th>
        </tr>
        <tr><th colspan='3'>HEAT CODE<font color='red'>*</font></th>
    <th  colspan='4'><input type="text" name="HEAT_CODE" id="HEAT_CODE" class='form-control'></th>
        </tr>
        <tr><th colspan='3'>SUPPLIER <font color='red'>*</font></th>
    <th  colspan='4'><input type="text" name="SUPPLIER" id="SUPPLIER" class='form-control' readonly value='IP Rings'></th>
        </tr>
        
        <tr><th colspan='3'>DELIVERY_NOTE<font color='red'>*</font></th>
    <th  colspan='4'><input type="text" value='{{$INVOICE->CUSTOMER_PO_No}}' name="DELIVERY_NOTE" id="DELIVERY_NOTE" readonly class='form-control'></th>
        </tr>      
        <tr><th colspan='3'>VENDOR BATCH<font color='red'>*</font></th>
    <th  colspan='4'><input type="text" value='{{$INVOICE->id}}' name="VENDOR_BATCH" id="VENDOR_BATCH" readonly class='form-control'></th>
        </tr>  
        <tr><th colspan='3'>REV_LEVEL<font color='red'>*</font></th>
    <th  colspan='4'><input value='{{$PRODUCT->REV_LEVEL}}' readonly type="text" name="REV_LEVEL" id="REV_LEVEL" class='form-control'></th>
        </tr>
        <tr><th colspan='3'>DATE_MFG<font color='red'>*</font></th>
    <th  colspan='4'><input type="text" readonly placeholder='DATE_MFG' name="DATE_MFG" id="DATE_MFG" class='form-control'></th>
        </tr>
        <tr><th colspan='3'>DATE_SHIPPED<font color='red'>*</font></th>
    <th  colspan='4'><input type="text" value='{{date("dMY")}}' readonly name="DATE_SHIPPED" id="DATE_SHIPPED" class='form-control'></th>
        </tr>
        <tr><th colspan='3'>FROM_ADDRESS<font color='red'>*</font></th>
    <th  colspan='4'>
        <textarea  name="FROM_ADDRESS" id="FROM_ADDRESS" class='form-control' rows="4" cols="50" readonly>
IP RINGS LIMITED,
D11/12, Industrial Estate
Maraimalai Nagar, Chengelpet District
Tamil Nadu-603 209, India</textarea></th>
        </tr>
        <tr><th colspan='3'>TO_ADDRESS<font color='red'>*</font></th>
    <th  colspan='4'><textarea readonly name="TO_ADDRESS" id="TO_ADDRESS" class='form-control' rows="4" cols="50">
{{$INVOICE->CUSTOMER_NAME}}
{{$INVOICE->REGION}}
{{$INVOICE->COUNTRY_NAME}}</textarea></th>
        </tr>
    
    </tfoot>
</table>
<br><div id='alertDiv'></div>
</div>
        <div class="modal-footer">

            <div id="insertButtonDiv">
                  </div>
                  @if($LOCKED_FLAG>0)
<font color='red' size='+1'>*To release any locked stock, Please contact admin*</font>
@endif
          <table  width="100%" ><tr><td align="left">
          <button type="button" class="btn btn-danger" data-dismiss="modal"
                            onclick="$('#myModal').modal('hide');" ><font size='+1'>CLOSE</font></button>


            </td><td align="right">
            <button type="submit" class="btn btn-success" onclick="confirmMappStkToInvoice();"><font size='+1'>SAVE</font></button>
            </td></tr></table>



        </div>

    </div>
</div>
<script>
    function getTotal(BINSTOCK_ID)
    {
        

       checkTally(BINSTOCK_ID);
        var sum = 0;
    $('.assigned').each(function() {
        sum += Number($(this).val());
    });

    $('#ASSIGNED_QTY').val(sum);
    BILLED_QTY= $('#BILLED_QTY').val();
    YET_TO_ASSIGN_QTY=BILLED_QTY-sum;
    $('#YET_TO_ASSIGN_QTY').val(YET_TO_ASSIGN_QTY);
    if(YET_TO_ASSIGN_QTY<0)
    {
        $('#alertDiv').html('<font color="red">Cannot assign greater than billed QTY, Please review assigned Stock</font> ');
    } 

    }
    function checkTally(BINSTOCK_ID)
    {
        assigned=$('#assigned'+BINSTOCK_ID).val();
        stock=$('#STOCK'+BINSTOCK_ID).val();
        if(parseInt(assigned) > parseInt(stock))
        {
           $('#alertDiv').html('<font color="red">Cannot assign greater than available Stock, So assigning the available stock</font> ');
           $('#assigned'+BINSTOCK_ID).val(0);
        } else
        if(parseInt(assigned)<0)
        {
            $('#alertDiv').html('<font color="red">How can you assign negative Stocks </font> ');
           $('#assigned'+BINSTOCK_ID).val(0);
        }else
        {
            $('#alertDiv').html('');
        }
      

    }
    function confirmMappStkToInvoice()
    {
        BILLED_QTY=$('#BILLED_QTY').val();
        YET_TO_ASSIGN_QTY=$('#YET_TO_ASSIGN_QTY').val();
        ASSIGNED_QTY=$('#ASSIGNED_QTY').val();
        HEAT_CODE=$('#HEAT_CODE').val();

        if(parseInt(YET_TO_ASSIGN_QTY)!= 0 || parseInt(BILLED_QTY)!= parseInt(ASSIGNED_QTY)  )
        {
            $('#alertDiv').html('<font color="red">STOCK NOT TALLIED .. Please Tally Billed QTY</font>');
        }
        else{
            if(HEAT_CODE!=0 && HEAT_CODE!='')
                        {
                            $('#alertDiv').html('<font color="green">READY TO GO </font>');
                            
                           
                            INVOICE_ID=$('#INVOICE_ID').val();
                            SUPPLIER=$('#SUPPLIER').val();
                            DELIVERY_NOTE=$('#DELIVERY_NOTE').val();
                            HEAT_LOT=$('#HEAT_LOT').val();
                            REV_LEVEL=$('#REV_LEVEL').val();
                            DATE_MFG=$('#DATE_MFG').val();
                            DATE_SHIPPED=$('#DATE_SHIPPED').val();
                            FROM_ADDRESS=$('#FROM_ADDRESS').val();
                            TO_ADDRESS=$('#TO_ADDRESS').val();
                            VENDOR_BATCH=$('#VENDOR_BATCH').val();
                          
                            var BINSTOCK_ID = [];
                            var QTY=[];
                            var ASSIGNED=[];

                            BINSTOCK_ID = $('input[name="BINSTOCK_ID[]"]').map(function () {
                                return $(this).val();
                            }).get();
                          
                            QTY = $('input[name="QTY[]"]').map(function () {
                                return $(this).val();
                            }).get();
                           
                            ASSIGNED = $('input[name="assigned[]"]').map(function () {
                                return $(this).val();
                            }).get();
                           
                            var completeurl = url +'/confirmMappStkToInvoice';
                            var BINSTOCK = JSON.stringify(BINSTOCK_ID);
                            var ASSIGNED = JSON.stringify(ASSIGNED);
                            var QTY = JSON.stringify(QTY);
                     
                    data = 'BINSTOCK='+BINSTOCK+'&ASSIGNED='+ASSIGNED+'&QTY='+QTY+
                    '&HEAT_CODE='+HEAT_CODE+'&INVOICE_ID='+INVOICE_ID+'&BILLED_QTY='+BILLED_QTY+
                    '&YET_TO_ASSIGN_QTY='+YET_TO_ASSIGN_QTY+'&ASSIGNED_QTY='+ASSIGNED_QTY+
                    '&SUPPLIER='+SUPPLIER+
                    '&DELIVERY_NOTE='+DELIVERY_NOTE+
                    '&HEAT_LOT='+HEAT_LOT+
                    '&REV_LEVEL='+REV_LEVEL+
                    '&DATE_MFG='+DATE_MFG+
                    '&DATE_SHIPPED='+DATE_SHIPPED+
                    '&FROM_ADDRESS='+FROM_ADDRESS+
                    '&VENDOR_BATCH='+VENDOR_BATCH+
                    '&TO_ADDRESS='+TO_ADDRESS;                 ;
                    var completeurl = url +'/confirmMappStkToInvoice';
                    var type = "POST";
                    var place = 'alertDiv';
                    ajaxload(type, completeurl, data, place);

            }else
            {
                $('#alertDiv').html('<font color="red">Please enter HEAT CODE</font>');

            }

        }

    }

function getBinStockToInvoice(CUSTOMER_PART_NO,barcodeScanIn)
{
    
    $('#barcodeScanIn').focus();
    $('#barcodeScanIn').val('');
    data = 'barcodeScanIn='+barcodeScanIn+'&CUSTOMER_PART_NO='+CUSTOMER_PART_NO ;


                var completeurl = url +'/getBinStockMappedToInvoice';
                var type = "POST";
                var place = 'alertDiv';
                ajaxload(type, completeurl, data, place);

}
$('#barcodeScanIn').focus();
</script>