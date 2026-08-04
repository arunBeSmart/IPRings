<!DOCTYPE html>
<html>

<head>
    <title>Master Barcode </title>
    <link rel="stylesheet" href="{{url('/resources/css/barcode_maxcdn_bootstrap.css')}}">
</head>

<body>
    <div class="container">
        <h3>Barcode Generator Laravel 8 Tutorial</h3>
        <hr/>
        <table class='table'>
            <tr>
                <td colspan='2'>PART NUMBER<br>(P)
                <div>{!! DNS1D::getBarcodeHTML('PART NUMBER', 'C39') !!}</div>
                </td>
                <td>
                    DANA QUICK RECEIVE SCAN
                    <div>{!! DNS2D::getBarcodeHTML('PPARTNUM|1TLVENDOR BATCH|QQUANTITY|ZAHEATLOT|ZBHEATCODE|2PRV', 'QRCODE') !!}</div>

                </td>
            </tr>
            <tr>
                <td rowspan='2'>QUANTITY
                    <BR>(Q)<div>{!! DNS1D::getBarcodeHTML('QUANTITY', 'C39') !!}</div>
                </td>
                <td colspan='2'>DESC. PART DESCRIPTION</td>
            </tr>
            <TR>
                 <td colspan='2'>DESC. DELIVERY NOTE<BR>(16K)
                 <div>{!! DNS1D::getBarcodeHTML('DELIVERY NOTE', 'C39') !!}</div>
                 </td></TR>
            <tr>
                <td>SUPPLIER<BR>(S)<div>{!! DNS1D::getBarcodeHTML('SUPPLIER', 'C39') !!}</div></td>
                <td colspan='2'>
                    <table><tr><td>
                HEAT LOT<BR>(ZA)<div>{!! DNS1D::getBarcodeHTML('HEAT LOT', 'C39') !!}</div>
                    </td><td>{{date('d M Y')}}<br>Date MFG</td></tr></table></td>
            </tr>
            <tr>
                <td>VENDOR BATCH<BR>(1T)<div>{!! DNS1D::getBarcodeHTML('VENDOR BATCH', 'C39') !!}</div></td>
                <td colspan='2'>
                    <table>

                    <tr><td>
                    <div>{!! DNS1D::getBarcodeHTML('HEAT CODE', 'C39') !!}</div>HEAT CODE<BR>(ZB)
                </td><td>REV.LEVEL<br>(2P)
             <div>{!! DNS1D::getBarcodeHTML('A2', 'C39') !!}</div></td></tr>
                    </table>
                
                </td>
            </tr>
            <tr><td>From Address</td><td>To Address</td></tr>
            <tr><td></td><td>{{date('d M Y')}}</td></tr>
        </table>
       
    </div>
</body>

</html>
<SCRIPT>window.print();</SCRIPT>