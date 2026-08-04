<!DOCTYPE html>
<html>

<head>
    <title>IP Rings Secondary label</title>
    
    <link rel="stylesheet" href="{{url('/resources/css/barcode_maxcdn_bootstrap.css')}}">
    <script src="{{url('resources/js/jQuery.print.min.js')}}"></script>
    
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
  padding: 5px;
}

    </style>
</head>
<body >
  <?php  $BARCODE="$CUSTOMER_PART_NUMBER$SEPARATOR$IPR_REF$SEPARATOR$WEIGHT$SEPARATOR$QTY$SEPARATOR$DATE$SEPARATOR$SLNO$SEPARATOR$EMP"?>
 <b>
  <table id="secondaryLableTable">
        <tr>
            <td colspan='3'>CUSTOMER NAME:   {{$CUSTOMER_NAME}} </td>
        </tr>
        <TR><td>IPR REF: {{$IPR_REF}}</td><td>S.S.NO.: {{$SLNO}}</td>
        <td rowspan='2'  style='text-align: center;'><div >{!! DNS2D::getBarcodeHTML(
            "$BARCODE", 'QRCODE',3,3) !!}</div></td></TR>
        <tr><td colspan='2'>CUST. PART NO:  {{$CUSTOMER_PART_NUMBER}}</td></tr>
        <TR><td>QTY :{{$QTY}} NOS</td><td colspan='2'> WEIGHT :&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       Kg
        </td></TR>
        <TR><td>EMP : {{$EMP}}</td><td colspan='2'> DATE :{{$DATE}}</td></TR>
    </table>
    <table>
      <tr><td>SEQUENCE NO.</td><td>LOCATIONS</td></tr>
      <tr><td style='text-align: center;'>
    <div >{!! DNS2D::getBarcodeHTML(
            "$SEQUENCE", 'QRCODE',3,3) !!}</div>
  </td>
    <td style='text-align: center;'>
    <div >{!! DNS2D::getBarcodeHTML(
            "$LOCATION", 'QRCODE',3,3) !!}</div>
  </td>
    </tr>
    <tr><td colspan=2>{{$LOCATION}}</td></tr>
  </table></b></body></html>