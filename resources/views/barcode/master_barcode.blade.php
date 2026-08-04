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
        $HEAT_LOT=strtoupper($HEAT_LOT);
        //PPARTNUM|1TLVENDOR BATCH|QQUANTITY|ZAHEATLOT|ZBHEATCODE|2PRV
         $QUICK_RECEIVE='P'.$CUSTOMER_PART_NUMBER.'|1T'.$VENDOR_BATCH
        .'|Q'.$QUANTITY.'|ZA'.$HEAT_LOT.'|ZB|2P'.$REV_LEVEL;
        if($PALLET_QTY>0) {$copyPrint=ceil($QUANTITY/$PALLET_QTY);} else {$copyPrint=1;}
        
       for($pageno=1;$pageno<=$copyPrint;$pageno++){ 
        if($PALLET_QTY>0){$QUANTITY=round($PALLET_QTY);}

        $QUICK_RECEIVE='P'.$CUSTOMER_PART_NUMBER.'|1T'.$VENDOR_BATCH
        .'|Q'.$QUANTITY.'|ZA'.$HEAT_LOT.'|ZB|2P'.$REV_LEVEL;

        ?>
        <table class='pad' border=1>
            <tr>
                <td colspan='4' >
                <table  border='0'  class='hiddenTable' ><tr><td><font size='-3'> PART <BR> NUMBER (P)</font>
            </td><td style="font-size: 45px;">
                     {{$CUSTOMER_PART_NUMBER}}</td></tr>
                <tr><td colspan=2 style=' padding-left: 5px;'>
               <?PHP $CUSTOMER_PART_NUMBER1='P'.$CUSTOMER_PART_NUMBER; ?>
               <div class='font-size:50pt;'>{!! DNS1D::getBarcodeHTML("$CUSTOMER_PART_NUMBER1", 'C39',1.2,42) !!}</div>
                
                </td></table>
               
                </td>
               
                <td colspan='2' align='center' >
                  <table  border=0 width='100%' align='center'   class='hiddenTable' ><tr>
                  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php /* INVOICE NO.<BR><?PHP  ECHO $BILLING_DOCUMENT  */?></td>
                  <td><font size='-3'> QUICK RECEIVE</font>
                  <div>{!! DNS2D::getBarcodeHTML("$QUICK_RECEIVE", 'QRCODE',2.5,2.5) !!}</div><br></td>
                  
                </tr></table>
                
                </td>
            </tr>
            <tr style="line-height:10px;">
                <td  colspan='2' style='width:385px; line-height:10px;' rowspan=2 >
               
                    <table border=0  class='hiddenTable'  ><tr><td><font size='-3'>QUANTITY (Q)</font></td><td>
                    <font size='45px'> {{$QUANTITY}}</font>
                    </td></tr><?PHP $QUANTITY1='Q'.$QUANTITY; ?>
                <tr><td colspan=2 style=' padding-left: 5px;'><div>{!! DNS1D::getBarcodeHTML("$QUANTITY1", 'C39',1.2,42) !!}</div></td></tr></table>
               
               
                </td>

                <td colspan='4' style=' line-height:10px; font-size: 16px;' >
                <font size='-3'>DESC.</font> {{$PART_DESCRIPTION}}
               </td></tr><tr><td colspan='4' >
              <table   class='hiddenTable'    border='0'  >
                    <tr><td><font size='-3'>PURCHASE ORDER (16K)</font></td> 
                    <td    style="font-size: 24px;"> {{$DELIVERY_NOTE}}</td></tr>
                    <?PHP $DELIVERY_NOTE1='16K'.$DELIVERY_NOTE; ?>
                <tr><td colspan=2 style=' padding-left: 5px;  padding-bottom: 5px;'><div>{!! DNS1D::getBarcodeHTML("$DELIVERY_NOTE1", 'C39',1.2,42) !!}</div></td></tr></table> 

                </td>
            </tr>
            
            <tr>      
                <td colspan='2'>
             
                <table border='0'  class='hiddenTable' ><tr><td>
                <font size='-3'>SUPPLIER (S)</font>
                </td><td  style="font-size: 24px;">{{$SUPPLIER}}</td></tr>
                <?PHP $SUPPLIER1='S'.$SUPPLIER; ?>
                <tr><td colspan=2 style=' padding-left: 2px; padding-bottom: 5px;'><div>{!! DNS1D::getBarcodeHTML("$SUPPLIER1", 'C39',1.2,42) !!}</div></td>
                </tr></table>    
               </td>
                <td colspan=4>
                <table   border='0' style=" " width='100%' class='hiddenTable' ><tr><td>
                <font size='-3'>HEAT LOT (ZA)</font>
                </td><td   style="font-size: 24px;">{{$HEAT_LOT}}</td>
                <?PHP $HEAT_LOT1='ZA'.$HEAT_LOT; ?>
                <td rowspan=2 align='right' style="font-size: 24px;">{{$DATE_MFG}}<br><font size='-3'>DATE MFG</font></td></tr>
                <tr><td colspan=2 align='right'  style=' padding-left: 5px;  padding-bottom: 5px;'><div align='center'> {!! DNS1D::getBarcodeHTML("$HEAT_LOT1", 'C39',1.2,42) !!}</div></td>
                </tr></table>    

                </td>
            </tr>
            <tr>
                <td colspan='2'>
                <table  border='0' class='hiddenTable'  ><tr><td>
                <font size='-3'>VENDOR BATCH (1T)</font>
                </td><td   style="font-size: 24px;">{{$VENDOR_BATCH}}</td></tr>
                <?PHP $VENDOR_BATCH1='1T'.$VENDOR_BATCH; ?>
                <tr><td colspan=2 style=' padding-left: 5px;  padding-bottom: 5px;'><div>{!! DNS1D::getBarcodeHTML("$VENDOR_BATCH1", 'C39',1.2,42) !!}</div></td>
                </tr></table>   

                </td>
                <td colspan='3' style='width:420px;'>
                    
                <table  border='0' class='hiddenTable'   ><tr>
                <?PHP $BILLING_DOCUMENT1=$BILLING_DOCUMENT; ?>
                <tr><td colspan=2 style=' padding-left: 0px;  padding-top: 2px;'><div>{!! DNS1D::getBarcodeHTML("$BILLING_DOCUMENT1", 'C39',1.2,42) !!}</div></td>
                </tr><tr><td>
                <font size='-3'>INVOICE NO.</font>
                </td><td   style="font-size: 24px;">{{$BILLING_DOCUMENT}}</td>
                </tr></table>
        </td><td style='width:100px;'>
        <table   border='0' class='hiddenTable'  >
               <tr><td style='padding-left:0px;'>
                <font size='-3'>REV. LEVEL (2P)</font>
                </td><td   style="font-size: 24px;">{{$REV_LEVEL}}</td></tr>
                <?PHP $REV_LEVEL1='2P'.$REV_LEVEL; ?>
                <tr><td colspan=2 style='padding-left:0px; padding-right:1px; padding-bottom: 2px;'><div>{!! DNS1D::getBarcodeHTML("$REV_LEVEL1", 'C39',1.2,42) !!}</div></td>
                </tr>
                </table>
            
            </td>
            </tr>
            <tr><td colspan=3 colspan=3 style="font-size: 10px;  padding-left:15px;
    padding-right: 15px;">
              From Address : {{$FROM_ADDRESS}} </td><td colspan=3 style=" padding-left:15px;
    padding-right: 15px;font-size: 10px;">To Address : {{$TO_ADDRESS}}</td> 


            </tr>
         <!--   <tr><td></td><td>{{$DATE_SHIPPED}}  </td><td></td></tr> -->
            
        </table>
        <?php } ?>
</body>


</html>