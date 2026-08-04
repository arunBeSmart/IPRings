
<?php  $BARCODE="$CUSTOMER_PART_NUMBER$SEPARATOR$IPR_REF$SEPARATOR$WEIGHT$SEPARATOR$QTY$SEPARATOR$DATE$SEPARATOR$SLNO$SEPARATOR$EMP"?>
  <button>
  <table border='1'>
        <tr>
            <td colspan='3'>CUSTOMER NAME :  {{$CUSTOMER_NAME}} </td>
        </tr>
        <TR><td>IPR REF: {{$IPR_REF}}</td><td>S.NO.: {{$SLNO}}</td>
        <td rowspan='2'><div >{!! DNS2D::getBarcodeHTML("$BARCODE", 'QRCODE',3,3) !!}</div></td></TR>
        <tr><td colspan='2'>CUST PART NO: {{$CUSTOMER_PART_NUMBER}}</td></tr>
        <TR><td>QTY : {{$QTY}} NOS</td><td colspan='2'> WEIGHT : {{$WEIGHT}}Kg</td></TR>
        <TR><td>EMP : {{$EMP}}</td><td colspan='2'> DATE :{{$DATE}}</td></TR>
    </table></button>
   