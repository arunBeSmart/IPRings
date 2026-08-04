
<html>

<head>  
    <link rel="stylesheet" href="{{url('/resources/css/barcode_maxcdn_bootstrap.css')}}">
    <style>
        @page { margin:5px; }
body { margin: 5px; }

table, td, th {  
  border: 1px solid black;
  text-align: left;
  font-size:16px
}

table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 3px;
}

    </style>
</head>
<body  >
  <?php $BARCODE="$CUSTOMER_PART_NUMBER$SEPARATOR$IPR_REF$SEPARATOR$WEIGHT$SEPARATOR$QTY$SEPARATOR$DATE$SEPARATOR$SLNO$SEPARATOR$EMP";  
 // $BARCODE='     2005111| 373|  18.910| 45|28-12-202314:54:55|    5|    400187';?>
 <b>
  <table >
        <tr>
            <td colspan='3'>CUSTOMER NAME : &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo  $CUSTOMER_NAME ?> </td>
        </tr>
        <TR><td>IPR REF: {{$IPR_REF}}</td><td>P.S.NO.:{{$SLNO}}</td>
        <td rowspan='2'  style='text-align: center;'><div >{!! DNS2D::getBarcodeHTML(
            "$BARCODE", 'QRCODE',3,3) !!}</div></td></TR>
        <tr><td colspan='2'>CUST PART NO:  {{$CUSTOMER_PART_NUMBER}}</td></tr>
        <TR><td>QTY : &nbsp; &nbsp;{{$QTY}} NOS</td><td colspan='2'> WEIGHT : &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        @if($WEIGHT>1)
        {{$WEIGHT}}Kg
        @endif
        </td></TR>
        <TR><td>EMP : &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$EMP}}</td><td colspan='2'> DATE :{{$DATE}}</td></TR>
    </table> 
        </b>
        </body>
       
</html> 
     