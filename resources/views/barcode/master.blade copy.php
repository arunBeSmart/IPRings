<!DOCTYPE html>
<html>

<head>
    <title>Master Barcode </title>
    <link rel="stylesheet" href="{{url('/resources/css/barcode_maxcdn_bootstrap.css')}}">
    <style>
        @page { margin:5px; }
body { margin: 5px; }

.pad {
     padding-top:  5px;
    padding-bottom: 5px;
    padding-left:15px;
    padding-right: 15px;
    border: 1px solid black;

}
.hiddenTable
{
    padding-left:15px;
    padding-right: 15px; padding-bottom: 2px;
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
                <table  border='0'  class='hiddenTable' ><tr><td><font size='-3'> PART NUMBER<br>(P)</font>
            </td><td style="font-size: 45px;">
                     {{$CUSTOMER_PART_NUMBER}}</td></tr>
                <tr><td colspan=2>
                <div class='font-size:50pt;'>{!! DNS1D::getBarcodeHTML("$CUSTOMER_PART_NUMBER", 'C39',1.5,47) !!}</div>
                </td></table>
               
                </td>
               
                <td colspan='2' align='center' >
                 <font size='-3'> DANA QUICK RECEIVE SCAN</font>
                  <table  border=0 width='100%' align='center'   class='hiddenTable' ><tr><td><div>{!! DNS2D::getBarcodeHTML("$QUICK_RECEIVE", 'QRCODE',3,3) !!}</div></td></tr></table>

                </td>
            </tr>
            <tr>
                <td  colspan='2' rowspan=2>
                    <table border=0  class='hiddenTable'  ><tr><td><font size='-3'>QUANTITY <br>(Q)</font></td><td>
                    <font size='45px'> {{$QUANTITY}}</font>
                    </td></tr>
                <tr><td colspan=2><div>{!! DNS1D::getBarcodeHTML("$QUANTITY", 'C39',1.5,47) !!}</div></td></tr></table>
               
                 
                </td>

                <td colspan='4' style='height: -10px;'>
              <font size='-3'>DESC.</font><font size='16px;'> {{$PART_DESCRIPTION}}</font>
               </td></tr><tr><td colspan='4' >
              <table   class='hiddenTable'    border='0'  >
                    <tr><td><font size='-3'>DELIVERY NOTE <br>(16K)</font></td>
                    <td    style="font-size: 24px;"> {{$DELIVERY_NOTE}}</td></tr>
                <tr><td colspan=2><div>{!! DNS1D::getBarcodeHTML("$DELIVERY_NOTE", 'C39',1.5,47) !!}</div></td></tr></table> 

                </td>
            </tr>
            
            <tr>
                <td colspan='2'>
             
                <table border='0'  class='hiddenTable' ><tr><td>
                <font size='-3'>SUPPLIER<br>(S)</font>
                </td><td  style="font-size: 24px;">{{$SUPPLIER}}</td></tr>
                <tr><td colspan=2><div>{!! DNS1D::getBarcodeHTML("$SUPPLIER", 'C39',1.5,47) !!}</div></td>
                </tr></table>    
               </td>
                <td colspan=4>
                <table   border='0' width='100%' class='hiddenTable' ><tr><td>
                <font size='-3'>HEATLOT <br>(ZA)</font>
                </td><td   style="font-size: 24px;">{{$HEAT_LOT}}</td><td rowspan=2 align='right' style="font-size: 24px;">{{$DATE_MFG}}<br><font size='-3'>DATE MFG</font></td></tr>
                <tr><td colspan=2><div>{!! DNS1D::getBarcodeHTML("$HEAT_LOT", 'C39',1.5,47) !!}</div></td>
                </tr></table>    

                </td>
            </tr>
            <tr>
                <td colspan='2'>
                <table  border='0' class='hiddenTable'  ><tr><td>
                <font size='-3'>VENDOR BATCH<br>(1T)</font>
                </td><td   style="font-size: 24px;">{{$VENDOR_BATCH}}</td></tr>
                <tr><td colspan=2><div>{!! DNS1D::getBarcodeHTML("$VENDOR_BATCH", 'C39',1.5,47) !!}</div></td>
                </tr></table>   

                </td>
                <td colspan='3'>
                    
                <table  border='0' class='hiddenTable' ><tr>
                <tr><td colspan=2><div>{!! DNS1D::getBarcodeHTML("$HEAT_CODE", 'C39',1.5,47) !!}</div></td>
                </tr><tr><td>
                <font size='-3'>HEATCODE<br>(ZB)</font>
                </td><td   style="font-size: 24px;">{{$HEAT_CODE}}</td>
                </tr></table>
        </td><td>
        <table   border='0' class='hiddenTable'  >
               <tr><td>
                <font size='-3'>REV. LEVEL<br>(2P)</font>
                </td><td   style="font-size: 24px;">{{$REV_LEVEL}}</td></tr>
                <tr><td colspan=2><div>{!! DNS1D::getBarcodeHTML("$REV_LEVEL", 'C39',1.5,47) !!}</div></td>
                </tr>
                </table>
            
            </td>
            </tr>
            <tr><td colspan=3 colspan=3 style="font-size: 10px;  padding-left:15px;
    padding-right: 15px;">
              From Address:<br>{{$FROM_ADDRESS}} </td><td colspan=3 style=" padding-left:15px;
    padding-right: 15px;font-size: 16px;">To Address:<br>{{$TO_ADDRESS}}</td> 


            </tr>
         <!--   <tr><td></td><td>{{$DATE_SHIPPED}}  </td><td></td></tr> -->
            
        </table>
</body>


</html>