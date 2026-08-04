
<div class="card card-primary">
								<div class="card-header">
									<h3 class="card-title">INVOICES</h3>
								</div>
								<div class="card-body">
                        <p align='right'><button class='btn btn-primary' onclick='autoAddInvoiceTriggered();' data-toggle="modal" data-target="#myModal" >+AUTO ADD Invoices from XLSX</button>
</p>
                        <table class='table'>
   <tr>
      <td>From </td>
      <td><input class='form-control' type="date" name="fromDate" id="fromDate" max="{{date('Y-m-d')}}" value="{{date('Y-m-d',strtotime('-10 days'))}}">
   </td>
<td>To </td>
<td><input  class='form-control' type="date" name="toDate" id="toDate" value="{{date('Y-m-d')}}" max="{{date('Y-m-d')}}"></td>
<td><button class="btn btn-primary" onclick="getPeriodInvoiceList();">APPLY FILTER</button></td>

  


</tr></table>
<hr>
      
<div id='invoiceListTable'>
<table id="users_table"  class="table table-bordered table-striped dataTable table-colored-header table-responsive table-striped table-hover"  >
    <thead>   <tr>
            <td colspan=5></td><th><input type="text"  placeholder="IPR SEARCH" data-index="5"> </th>
             <th colspan=4> </th> 
                
      </tr>
      <tr>
    <th>ID</th>
        <th>INVOICE <br>NO.</th>
    <th>DATE</th>
    <th>CUSTOMER <br>PART NO </th>
    <th>ITEM<br> CODE </th>
    <th>IPR_REF </th>
    <th>CUSTOMER<br>NAME </th>
    
    <th>BILLED <br> QTY</th    >
    <th>MAPPED <br> QTY</th >
    
    <th>OPTIONS</th>
    </tr></thead>

    <tbody>
        @foreach($invoices as $record)
    
    @if($record->STATUS=='COMPLETED')    
      <tr style="background-color:#74f781;" > 
      @else
      <tr>
      @endif   
    <td >{{$record->id}}</td>
        <td >{{$record->BILLING_DOCUMENT}}</td>
        <td>{{date('d-m-Y',strtotime($record->BILLING_DATE))}}</td>
        <td>{{$record->CUSTOMER_PART_NUMBER}}</td>
        <td>{{$record->MATERIAL_NAME}}</td>
        <td>{{$record->IPR_REF}}
         <br>{{$record->SCAN_TYPE}}
        </td>
        <td>{{$record->CUSTOMER_NAME}}</td>
        
        <td>{{$record->BILLED_QTY}}        </td>
        <td>{{$record->SCANNED_QTY}}</TD>
        
        <td>
          <table><tr><td>
          @if($record->STATUS!='COMPLETED' && $record->SCAN_TYPE!='DIRECT')
          <button style="background-color:orange;" class='btn '  data-toggle="modal" data-target="#myModal"  onclick="mapStockToInvoice('{{$record->id}}');"><font size='+1'>Stock</font></button>
          @elseif($record->STATUS!='COMPLETED' && $record->SCAN_TYPE=='DIRECT')
          <button style="background-color:blue;" class='btn '  data-toggle="modal" data-target="#myModal"  onclick="mapStockToInvoiceDirect('{{$record->id}}');"><font size='+1'>Allocate Stock</font></button>
            @else
           <table><tr><td>
           <a href='/IPRings/printMasterLabel?INVOICE_ID={{$record->id}}' target='_blank' >
            <img src="{{url('resources/img/qrcodeNew.png')}}" width='40px' height='40px' >
           </a>
            </td><td><a href='/IPRings/printInvoiceDetails?INVOICE_ID={{$record->id}}&PART_NUM={{$record->CUSTOMER_PART_NUMBER}}' target='_blank' >
            <img src="{{url('resources/img/report.png')}}" width='40px' height='40px' >
           </a>
        </td></tr></table>
           @endif
              </td><td></td></tr></table> </td>

    @endforeach
    </tbody>
</table>

</div>
								</div>
								<!-- /.card-body -->
							</div>
                     
    
<script>

/*
   function viewInvoice(customerName,SaleOrder,PODate,PONo)
   {
      var x='itemsDiv'+SaleOrder;
      $("#"+x).toggle();
   }
*/
$(document).ready(function() {
        document.title = 'IP RINGS - Invoices';
    });

/*  $(document).ready(function(){
  var empDataTable = $('#users_table').DataTable({
     dom: 'Blfrtip',
     buttons: [
       {
          extend: 'copy'
       },
       {
          extend: 'pdf',
          exportOptions: {
            columns: [0,1,2,3,4,5,6,7] // Column index which needs to export
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

}); */

$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#users_table thead th').each( function (i) {
        var title = $('#work_order_table thead td').eq( $(this).index() ).text();
      //  $(this).html( '<input type="text" class="form-control" placeholder="'+title+'" data-index="'+i+'" />' );// placeholder="'+title+'" 
    } );
  
    // DataTable
    var table = $('#users_table').DataTable( {
        scrollY:        "300px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        fixedColumns:   true,
        dom: 'Blfrtip',
     buttons: [
       {  
          extend: 'copy'
       },
       {
          extend: 'pdf',
          exportOptions: {
            columns: [0,1,2,3,4,5,6,7] // Column index which needs to export
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
    } );
 
    // Filter event handler
    $( table.table().container() ).on( 'keyup', 'thead input', function () {
        table
            .column( $(this).data('index') )
            .search( this.value )
            .draw();
    } );
} );

 </script>
