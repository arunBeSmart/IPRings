
<div class="card card-primary">
								<div class="card-header">
									<h3 class="card-title">WORK ORDERS Data</h3>
								</div>
								<div class="card-body">
                           <p align='right'>
                          
   <button class='btn btn-primary' onclick='autoAddWorkOrderTriggered();' data-toggle="modal" data-target="#myModal" >+Auto Add WorkOrders from .XLSX</button>
  
                           </p>
                          
                        <table class='table'>
   <tr>
      <td>From </td>  
      <td><input class='form-control' type="date" name="fromDate" id="fromDate" max="{{date('Y-m-d')}}" value="{{$FILTERS['fromDate']}}">
   </td>
<td>To </td>
<td><input  class='form-control' type="date" name="toDate" id="toDate" value="{{date('Y-m-d')}}" max="{{$FILTERS['toDate']}}"></td>
<td><button class="btn btn-primary" onclick="getPeriodWorkOrderList();">Apply Filter</button></td>
<td>

</tr></table><br>
<div id='workOrderListTable'>
   
<table id="work_order_table"  class="table table-bordered table-striped dataTable table-colored-header table-responsive table-striped table-hover"  >
<thead>
            <tr>
            <th></th> <th></th> <th></th> <th></th> <th>  </th> <th></th> <th></th> <th></th> <th></th>
                <th></th>  <th></th>  <th></th>
                
            </tr>
</thead>    <thead><tr>
    <th>ID</th> 
        <th>DATE</th>
    <th>WORK ORDER </th>
    <th>MATERIAL CODE </th>
    <th>CUSTOMER PART NO </th>
    <th>IPR REF </th>
    <th>PPF </th>
    <th>SPF </th>    
    <th>YIELD<br>QTY</th>
    <th>SCAN<br> QTY</th>
    <th>BALANCE<br> QTY</th><th>OPTIONS</th>
   
    </tr></thead>
<?PHP /*    
    <tbody>
      @foreach($DATA  as  $data)
      <tr>
      <td>{{$data->id}}</td>
      <td>{{date('d-m-Y',strtotime($data->posting_date))}}</td>
        <td>{{$data->order}}</td>       
        <td>{{$data->material_code}}</td>
        <td>{{$data->CUSTOMER_PART_NO}}</td>
        <td>{{$data->IPR_REF}}</td>
        <td>{{$data->PACKING_FACTOR}}</td>
        <td>{{$data->MASTER_PACKING_FACTOR}}</td>
        <td align='right'>{{$data->yield_qty}}</td>
        <td align='right'>{{$data->SCANNED_QTY}}</td>
        <td align='right'>{{$data->yield_qty-$data->SCANNED_QTY}}</td>
        <td>
            <table class='table'><tr><td>
            @if(Session::get('user_type')=='admin')
               <button  class='btn btn-danger' onclick='editWorkOrder({{$data->id}});'  data-toggle="modal" data-target="#myModal">
            <font size='+1'>Amend</font></button>
            @endif
         </td>
            <td><button class='btn btn-primary' onclick='prepareWorkOrderType({{$data->id}});' >
            <font size='+1'>Prepare</font></button>
            </td></tr></table>
      </td>
    
      </tr>
        @endforeach
    </tbody> */ ?>
</table>
</div>

PPF :PRIMARY PACKING FACTOR QTY
<BR>SPF :SECONDARY PACKING FACTOR QTY
<BR>CFF QTY :CARRY FORWARD FROM other WorkOrders QTY
<BR>CFT QTY :CARRY FORWARD TO Other Workorders QTY
								</div>
								<!-- /.card-body -->
							</div>

<script>

    
      
getPeriodWorkOrderList();
$(document).ready(function() {
        document.title = 'IP RINGS -  Work Orders';
    });

  $(document).ready(function(){
  var empDataTable = $('#work_order_table').DataTable({
     dom: 'Blfrtip',
     buttons: [
       {  
          extend: 'copy'
       },
       {
          extend: 'pdf',
          exportOptions: {
            columns: [0,1,2,3,4,5,6,7,8,9] // Column index which needs to export
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
$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#work_order_table thead th').each( function (i) {
        var title = $('#work_order_table thead td').eq( $(this).index() ).text();
        $(this).html( '<input type="text" class="form-control" data-index="'+i+'" />' );// placeholder="'+title+'" 
    } );
  
    // DataTable
   
 
    // Filter event handler
    $( table.table().container() ).on( 'keyup', 'thead input', function () {
        table
            .column( $(this).data('index') )
            .search( this.value )
            .draw();
    } );
} );

</script>