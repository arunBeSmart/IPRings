<!DOCTYPE html>
<html>

<head>
    <title>Barcode Generator Laravel 8 Tutorial</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h3>Barcode Generator Laravel 8 Tutorial</h3>
        <hr/>
        <div class="row">
            <div class="col-md-8">
                <label>C39</label>
                <div>{!! DNS1D::getBarcodeHTML('4445645656', 'C39') !!}</div><br />
                <label>POSTNET</label>
                <div>{!! DNS1D::getBarcodeHTML('4445645656', 'POSTNET') !!}</div><br />
                <label>PHARMA</label>
                <div>{!! DNS1D::getBarcodeHTML('4445645656', 'PHARMA') !!}</div><br />
                <label>QRCODE</label>
                <div>{!! DNS2D::getBarcodeHTML('4445645656', 'QRCODE') !!}</div><br />
            </div>
        </div>
    </div>
</body>

</html>