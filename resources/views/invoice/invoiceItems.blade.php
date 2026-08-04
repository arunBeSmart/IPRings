<table id="users_table" width="90%" class="table table-bordered table-striped table-responsive table-striped table-hover"  >
    <thead><tr>
        <th>Customer Part no</th>
        <th>Quantity</th><th>Scanned</th><th>PF</th><th>MPF</th>
        <th>OPTIONS</th>
    </tr></thead>
    
    <tbody>
        @foreach($invoicesItems as $record)
    <tr>
        <td >{{$record->CUSTOMER_PART_NUMBER}}</td>
        <td>{{$record->BILLED_QTY}}</td>
        <td>{{$record->SCANNED_QTY}}</td>
        @if($record->SCANNED_QTY>0)
        <script>imgURL=url+'/resources/img/packing.gif';
        $('#loadingCheckDiv{{$record->SALES_ORDER}}').html("<img width='50px' height=50px' src='"+imgURL+"'>");</script>
        @endif
        <td>{{$record->PACKING_FACTOR}}</td>
        
        <td>{{$record->master_packing_factor}}</td>
        <td><table><tr><td>
        <button class='btn btn-danger' data-toggle="modal" data-target="#myModal" onclick="EditInvoiceItems(
            '{{$record->SALES_ORDER}}',
            '{{$record->SALES_ORDER_ITEM}}',
            '{{$record->id}}',
            '{{$record->CUSTOMER_PART_NUMBER}}',
            '{{$record->CUSTOMER_NAME}}',
            '{{$record->BILLED_QTY}}',
            '{{$record->PACKING_FACTOR}}',
            '{{$record->PACKING_BOX_COUNT}}',
            '{{$record->IPR_REF}}',
            '{{$record->BILLING_DOCUMENT}}',
            '{{$record->BILLING_DATE}}','{{$record->master_packing_factor}}');">Amend</button>
            </td><td>
           <button class='btn btn-success'  onclick="prepareInvoiceItems(
            '{{$record->SALES_ORDER}}',
            '{{$record->SALES_ORDER_ITEM}}',
            '{{$record->id}}',
            '{{$record->CUSTOMER_PART_NUMBER}}',
            '{{$record->CUSTOMER_NAME}}',
            '{{$record->BILLED_QTY}}',
            '{{$record->PACKING_FACTOR}}',
            '{{$record->PACKING_BOX_COUNT}}',
            '{{$record->IPR_REF}}',
            '{{$record->BILLING_DOCUMENT}}',
            '{{$record->BILLING_DATE}}','{{$record->master_packing_factor}}'
           );">Prepare</button></td></tr></table>
</td>
  
    @endforeach
    </tbody>
</table>
<script>
    function EditInvoiceItems(SALE_ORDER,SALE_ORDER_ITEM,INVOICE_ID,CUSTOMER_PART_NUMBER,
    CUSTOMER_NAME,BILLED_QTY,PACKING_FACTOR,PACKING_BOX_COUNT,IPR_REF,BILLING_DOCUMENT,
    BILLING_DATE,MASTER_PACKING_FACTOR)
    {
        
      data = 'SALE_ORDER='+SALE_ORDER + '&SALE_ORDER_ITEM='+SALE_ORDER_ITEM +
      '&INVOICE_ID='+INVOICE_ID + '&CUSTOMER_PART_NUMBER='+CUSTOMER_PART_NUMBER +
      '&CUSTOMER_NAME='+CUSTOMER_NAME + '&BILLED_QTY='+BILLED_QTY +
      '&PACKING_FACTOR='+PACKING_FACTOR + '&PACKING_BOX_COUNT='+PACKING_BOX_COUNT+'&IPR_REF='+ IPR_REF+
      '&BILLING_DOCUMENT='+BILLING_DOCUMENT+'&BILLING_DATE='+BILLING_DATE+'&MASTER_PACKING_FACTOR='+MASTER_PACKING_FACTOR;
       

       var completeurl = url +'/amend_packing' ;
       var type = "POST";
       var place = 'myModal';
       
       ajaxload(type, completeurl, data, place);
    }
    function prepareInvoiceItems(SALE_ORDER,SALE_ORDER_ITEM,INVOICE_ID,CUSTOMER_PART_NUMBER,CUSTOMER_NAME,
    BILLED_QTY,PACKING_FACTOR,PACKING_BOX_COUNT,IPR_REF,BILLING_DOCUMENT,BILLING_DATE,MASTER_PACKING_FACTOR)
    {
        
      data = 'SALE_ORDER='+SALE_ORDER + '&SALE_ORDER_ITEM='+SALE_ORDER_ITEM +
      '&INVOICE_ID='+INVOICE_ID + '&CUSTOMER_PART_NUMBER='+CUSTOMER_PART_NUMBER +
      '&CUSTOMER_NAME='+CUSTOMER_NAME + '&BILLED_QTY='+BILLED_QTY +
      '&PACKING_FACTOR='+PACKING_FACTOR + '&PACKING_BOX_COUNT='+PACKING_BOX_COUNT +'&IPR_REF='+IPR_REF+
      '&BILLING_DOCUMENT='+BILLING_DOCUMENT+'&BILLING_DATE='+BILLING_DATE+'&MASTER_PACKING_FACTOR='+MASTER_PACKING_FACTOR;
       

       var completeurl = url +'/prepareInvoiceItems' ;
       var type = "POST";
       var place = 'bodyDiv';
       
       ajaxload(type, completeurl, data, place);
    }
</script>