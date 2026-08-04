<style>
#invoiceBarcode:focus, textarea:focus {
  box-shadow: 0 0 5px rgba(81, 203, 238, 1);
  padding: 3px 0px 3px 3px;
  margin: 5px 1px 3px 0px;
  border: 5px solid blue;
}</style>
<table width='100%' class='table table-bordered table-stripped table-responsive'>
    <tr>
        <td>Scan Invoice Barcode/QRCode</td>
    </tr>
    <tr>
        <td> <input id='invoiceBarcode' name='invoiceBarcode' class='form-control' type='text' focus placeholder="Scan the INVOICE barcode now.." onchange="deliveryOutInvoiceGot(this.value);"></td>
    </tr>
</table>
<script>
     $('#invoiceBarcode').focus();
    function deliveryOutInvoiceGot(invoiceBarcode)
    {
alert(invoiceBarcode);
    }
</script>