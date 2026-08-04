<table id="work_order_table"  class="table table-bordered table-striped dataTable table-colored-header table-responsive table-striped table-hover stripe row-border order-column"  >
<thead>
            <tr>
            <td colspan=5></td><th><input type="text"  placeholder="IPR SEARCH" data-index="5"> </th> <th colspan=8> </th> 
                
                
            </tr>
<tr>
     <td>ID</td> 
        <td> DATE</td>
    <td>WORK ORDER </td>
    <td>MATERIAL CODE </td>
    <td>CUSTOMER PART NO </td>
    <td>IPR_REF </td>
    <td>PPF </td>
    <td>MPF </td>    
    <td>YIELD<br>QTY</td>
    <td>SCAN<br> QTY</td>
    <td>CFF<br> QTY</td>
    <td>CFT<br> QTY</td>
    <td>BALANCE<br> QTY</td><td>OPTIONS</td>
   
    </tr></thead>
    
    <tbody>
      @foreach($WORKORDERS  as  $data)
      <tr>
      <td>{{$data->id}}</td>
      <td>{{date('d-m-Y',strtotime($data->posting_date))}}</td>
        <td>{{$data->order}}</td>       
        <td>{{$data->material_code}}</td>
        <td>{{$data->CUSTOMER_PART_NO}}</td>
        <td>{{$data->IPR_REF}}<br>
         {{$data->SCAN_TYPE}}
        </td>
        <td>{{$data->PACKING_FACTOR}}</td>
        <td>{{$data->MASTER_PACKING_FACTOR}}</td>
        <td align='right'>{{$data->yield_qty}}</td>
        <td align='right'>{{$data->SCANNED_QTY}}</td>
        <td align='right'>{{$data->CFFWO_QTY}}</td>
        <td align='right'>-{{$data->CFTWO_QTY}}</td>
        <td align='right'>{{$data->BALANCE_QTY}}</td>
        <td>
        @if($data->LOCKED==1)
         <img src="{{url('/resources/img/locked.jpg')}}" width='40px' height='40px'>Follow F.I.F.O., do complete previous work orders to unlock this..
      @else
      <table class='table'><tr>

      @if($data->BALANCE_QTY=='0' && $data->SCAN_TYPE!='DIRECT')  
      <td><button class='btn btn-success' onclick='prepareWorkOrderType({{$data->id}});' >
            <font size='+1'>Completed</font></button>
            </td>
      @elseif($data->SCAN_TYPE!='DIRECT')
      <td><button  class='btn btn-danger' onclick='editWorkOrder({{$data->id}});'  data-toggle="modal" data-target="#myModal">
            <font size='+1'>Amend</font></button></td>
            <td><button class='btn btn-primary' onclick='prepareWorkOrderType({{$data->id}});' >
            <font size='+1'>Prepare</font></button>
            </td>
      @else
      <td><button class='btn btn-primary' onclick='pageLoad("invoice");' >
            <font size='+1'>Invoice Page</font></button></td>
      @endif 
     </tr></table>
   
      @endif
   
           
      </td>
    
      </tr>
        @endforeach
    </tbody>
   
</table>

<script>
  
$(document).ready(function() {
        document.title = 'IP RINGS -  Work Orders';
    });

  /*$(document).ready(function(){
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

}); */
$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#work_order_table thead th').each( function (i) {
        var title = $('#work_order_table thead td').eq( $(this).index() ).text();
      //  $(this).html( '<input type="text" class="form-control" placeholder="'+title+'" data-index="'+i+'" />' );// placeholder="'+title+'" 
    } );
  
    // DataTable
    var table = $('#work_order_table').DataTable( {
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