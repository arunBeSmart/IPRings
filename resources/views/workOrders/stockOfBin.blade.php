<div class="card card-primary">
								<div class="card-header">
									<h3 class="card-title">STOCK</h3>
								</div>
								<div class="card-body">
									
                     
<table id="users_table" width="90%" class="table table-bordered table-striped dataTable table-colored-header table-responsive table-striped table-hover"  >
    <thead><tr>
    <th>ID</th>
       
    <th>MATERIAL CODE </th>
    <th>MATERIAL DESCRIPTION </th>    
    <th>CUSTOMER PART NUMBER </th>    <th>IPR</th>
    <th>BOX TYPE</th>
    <th> QTY & STATUS</th>
  
    </tr></thead>
    
    <tbody>
      <?PHP $TOTAL=0; $LOCKED_FLAG=0;?>
@foreach($STOCK as $stock)
<tr>
<td>{{$stock->id}}  </td>
    <td>{{$stock->MATRIAL_CODE}}  </td>
    <td>{{$stock->MATERIAL_DESCRIPTION}}  </td>
    
    <td>{{$stock->CUSTOMER_PART_NO}}  </td><td>{{$stock->IPR_REF}}  </td>
    @if($stock->PRIMARY_ID>0)
   
        <td>PRIMARY BOX[{{$stock->PRIMARY_ID}}]</td>

   
    @elseif($stock->SECONDARY_ID>0)
   
        <td>SECONDARY BOX[{{$stock->SECONDARY_ID}}]</td>

    @elseif($stock->MASTER_ID>0)
    
        <td>MASTER BOX[{{$stock->MASTER_ID}}]</td>

    @endif
    <td>
      <div id='DivId{{$stock->id}}'>
    <table class='table'><tr><td>
    {{$stock->QTY}} 
    <?php $TOTAL=$TOTAL+$stock->QTY; ?>
    </td>
    @if($stock->LOCKED==1)
    <?php $LOCKED_FLAG++;?>
      <td><img src="{{url('/resources/img/locked.jpg')}}" width='40px' height='40px'></td>
      @endif
      @if($stock->LOCKED==1 and Session::get('user_type')=='admin')
     <td> <button onclick='releaseLockBinStock({{$stock->id}});' class='btn btn-primary'>UNCLOCK</button></td>
      @endif
   </tr></table>
   </div>  
    

     
     
      
    </td>
    
</tr>
@endforeach
</tbody>
<tfoot>
   <tr>
      <th></th>
      <th></th>
      <th>TOTAL</th>
      <th></th>
      <th></th>
      <th></th>
      <th>{{$TOTAL}}</th>
   </tr>
</tfoot>
</table>
								</div>
								<!-- /.card-body -->
							</div>

@if($LOCKED_FLAG>0)
<font color='red' size='+1'>*To release any locked stock, Please contact admin*</font>
@endif
<input type="hidden" id='TITLE' name="TITLE" value='{{$LOCATIONS->location_code}} ({{$LOCATIONS->location_name}})  
 {{$RACKS->rack_id}} >> {{$RACKS->bin_no}} >> {{$RACKS->bin_name}}'>
<script>
   
$(document).ready(function() {
   myTitle=$('#TITLE').val();
        document.title = 'IP RINGS -  BIN STOCK '+myTitle;
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
            columns: [0,1,2,3,4,5,6] // Column index which needs to export
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

function releaseLockBinStock(BINSTOCK_ID)
{
   data = 'BINSTOCK_ID='+BINSTOCK_ID ;
       var completeurl = url +'/releaseLockBinStock' ;
       var type = "POST";
       var place = 'DivId'+BINSTOCK_ID;
       
       ajaxload(type, completeurl, data, place);  
}
</script>
