<!DOCTYPE html>
<html>

<head>
    <title>Master Barcode </title>
    <link rel="stylesheet" href="{{url('/resources/css/barcode_maxcdn_bootstrap.css')}}">
    <style>
        @page { margin:2px; }
body { margin:2px; }

.pad {
     padding-top:  0px;
    padding-bottom: 0px;
    padding-left:3px;
    padding-right: 0px;
    border: 0px solid black;
    

}
.hiddenTable
{
    padding-left:3px; padding-top:  0px;
    padding-right: 0px; padding-bottom:0px;
}
body {
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
      line-height: 0.9;
    color: #333;
    background-color: #fff;
}
    </style>
</head>

<body>
   
        
        <?php  
        //PPARTNUM|1TLVENDOR BATCH|QQUANTITY|ZAHEATLOT|ZBHEATCODE|2PRV
        $QUICK_RECEIVE='P'.$CUSTOMER_PART_NUMBER.'|1T'.$VENDOR_BATCH
        .'|Q'.$QUANTITY.'|ZA'.$HEAT_LOT.'|ZB'.$HEAT_CODE.'|2P'.$REV_LEVEL;
        ?>
        <table class='pad' border=1>
            <tr>
                <td colspan='4' >
                <table  border='0'  class='hiddenTable' ><tr><td><font size='-3'> PART NUMBER (P)</font>
            </td><td style="font-size: 45px;">
                     {{$CUSTOMER_PART_NUMBER}}</td></tr>
                <tr><td colspan=2>
                <div class='font-size:50pt;'>{!! DNS1D::getBarcodeHTML("$CUSTOMER_PART_NUMBER", 'C39',1.2,47) !!}</div>
                </td></table>
               
                </td>
               
                <td colspan='2' align='center' >
                 <font size='-3'> DANA QUICK RECEIVE SCAN</font>
                  <table  border=0 width='100%' align='center'   class='hiddenTable' ><tr><td><div>{!! DNS2D::getBarcodeHTML("$QUICK_RECEIVE", 'QRCODE',2.5,2.5) !!}</div></td></tr></table>

                </td>
            </tr>
            <tr style="line-height:10px;">
                <td  colspan='2' style='width:450px; line-height:10px;' rowspan=2 >
                    <table border=0  class='hiddenTable'  ><tr><td><font size='-3'>QUANTITY (Q)</font></td><td>
                    <font size='45px'> {{$QUANTITY}}</font>
                    </td></tr>
                <tr><td colspan=2><div>{!! DNS1D::getBarcodeHTML("$QUANTITY", 'C39',1.2,47) !!}</div></td></tr></table>
               
                 
                </td>

                <td colspan='4' style=' line-height:10px; font-size: 16px;' >
                <font size='-3'>DESC.</font> {{$PART_DESCRIPTION}}
               </td></tr><tr><td colspan='4' >
              <table   class='hiddenTable'    border='0'  >
                    <tr><td><font size='-3'>DELIVERY NOTE (16K)</font></td>
                    <td    style="font-size: 24px;"> {{$DELIVERY_NOTE}}</td></tr>
                <tr><td colspan=2><div>{!! DNS1D::getBarcodeHTML("$DELIVERY_NOTE", 'C39',1.2,47) !!}</div></td></tr></table> 

                </td>
            </tr>
            
            <tr>
                <td colspan='2'>
             
                <table border='0'  class='hiddenTable' ><tr><td>
                <font size='-3'>SUPPLIER (S)</font>
                </td><td  style="font-size: 24px;">{{$SUPPLIER}}</td></tr>
                <tr><td colspan=2><div>{!! DNS1D::getBarcodeHTML("$SUPPLIER", 'C39',1.2,47) !!}</div></td>
                </tr></table>    
               </td>
                <td colspan=4>
                <table   border='0' style=" " width='100%' class='hiddenTable' ><tr><td>
                <font size='-3'>HEAT LOT (ZA)</font>
                </td><td   style="font-size: 24px;">{{$HEAT_LOT}}</td><td rowspan=2 align='right' style="font-size: 24px;">{{$DATE_MFG}}<br><font size='-3'>DATE MFG</font></td></tr>
                <tr><td colspan=2 align='right' ><div align='center'> {!! DNS1D::getBarcodeHTML("$HEAT_LOT", 'C39',1.2,47) !!}</div></td>
                </tr></table>    

                </td>
            </tr>
            <tr>
                <td colspan='2'>
                <table  border='0' class='hiddenTable'  ><tr><td>
                <font size='-3'>VENDOR BATCH (1T)</font>
                </td><td   style="font-size: 24px;">{{$VENDOR_BATCH}}</td></tr>
                <tr><td colspan=2><div>{!! DNS1D::getBarcodeHTML("$VENDOR_BATCH", 'C39',1.2,47) !!}</div></td>
                </tr></table>   

                </td>
                <td colspan='3' style='width:440px;'>
                    
                <table  border='0' class='hiddenTable'   ><tr>
                <tr><td colspan=2><div>{!! DNS1D::getBarcodeHTML("$HEAT_CODE", 'C39',1.2,47) !!}</div></td>
                </tr><tr><td>
                <font size='-3'>HEATCODE (ZB)</font>
                </td><td   style="font-size: 24px;">{{$HEAT_CODE}}</td>
                </tr></table>
        </td><td>
        <table   border='0' class='hiddenTable'  >
               <tr><td style='padding-left:25px;'>
                <font size='-3'>REV. LEVEL (2P)</font>
                </td><td   style="font-size: 24px;">{{$REV_LEVEL}}</td></tr>
                <tr><td colspan=2 style='padding-left:25px;'><div>{!! DNS1D::getBarcodeHTML("$REV_LEVEL", 'C39',1.2,47) !!}</div></td>
                </tr>
                </table>
            
            </td>
            </tr>
            <tr><td colspan=3 colspan=3 style="font-size: 10px;  padding-left:15px;
    padding-right: 15px;">
              From Address : {{$FROM_ADDRESS}} </td><td colspan=3 style=" padding-left:15px;
    padding-right: 15px;font-size: 16px;">To Address : {{$TO_ADDRESS}}</td> 


            </tr>
         <!--   <tr><td></td><td>{{$DATE_SHIPPED}}  </td><td></td></tr> -->
            
        </table>
</body>


</html>