<br><br>

<table id="users_table" width="90%" class="table table-bordered table-striped dataTable table-colored-header table-responsive table-striped table-hover"  >
    <thead><tr>
        <th>WORK ORDER NO.</th>
    <th>WORK ORDER Date</th>
    <th>ITEM CODE </th>
    <th>RECEIVED QTY</th    >
    <th>OPTIONS</th>
    </tr></thead>
    
    <tbody>
        @foreach($invoices as $record)
    <tr>
        <td >{{$record->SALES_ORDER}}</td>
        <td>{{date('d-m-Y',strtotime($record->BILLING_DATE))}}</td>
        <td>{{$record->ITEM_CODE}}</td>
        <td>{{$record->BILLED_QTY}}

        <div id="itemsDiv{{$record->SALES_ORDER}}" >
                     </div>
                     <script>getInvoiceItems({{$record->SALES_ORDER}});</script>
        </td>
       
        <td>
          <table><tr><td>  <button class='btn btn-danger' onclick="viewInvoice('{{$record->CUSTOMER_NAME}}','{{$record->SALES_ORDER}}','{{$record->CUSTOMER_PO_Date}}','{{$record->CUSTOMER_PO_No}}');">View</button>
               </td><td><div id='loadingCheckDiv{{$record->SALES_ORDER}}'></div></td></tr></table> </td>
  
    @endforeach
    </tbody>
</table>
**PF  = Primary Box Packing Factor Qty<br>
**MPF = Master Box Packing Factor Qty
<script>

   function viewInvoice(customerName,SaleOrder,PODate,PONo)
   {
      var x='itemsDiv'+SaleOrder;
      $("#"+x).toggle();
   }

$(document).ready(function() {
        document.title = 'IP RINGS - Invoices';
    });

  $(document).ready(function(){
  var empDataTable = $('#users_table').DataTable({
     dom: 'Blfrtip',
     buttons: [
       {  
          extend: 'copy'
       },
       {
          extend: 'pdf',
          exportOptions: {
            columns: [0,1,2,3] // Column index which needs to export
          }
       },
       {
          extend: 'csv',
       },
       {
          extend: 'excel',
       } 
       ,
       {
          extend: 'print',
       } 
       ,
       {
          extend: 'colvis',
       } 
     ] 

  });

});
</script>