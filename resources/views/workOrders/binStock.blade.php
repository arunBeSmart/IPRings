<div class="card card-primary">
								<div class="card-header">
									<h3 class="card-title">BIN STOCK Data</h3>
								</div>
								<div class="card-body">
                        <table style="width:75%"  class="table table-bordered table-striped table-colored-header table-responsive table-hover" >
    <tr>
        <td>Please select Location </td>
        <td> <select onchange="getBinsByLocation(this.value);" id="location_id" name="location_id" class="form-control">
            <option disabled selected=1 value="0">Please Select Location</option>   
        @foreach($DETAILS as $location)
        <option value="{{$location->id}}">{{$location->location_code}} ({{$location->location_name}})</option>   
        @endforeach
    </select></td>
            <td rowspan='2'></td>
       
            <td>Please select Bin no </td>
            <td><div id='binSelectDiv'><select  id="rack_master_id" name="rack_master_id" class="form-control">
                <option value="0">Please Select Bin Number first</option>
              
            </select></div>
            </td>
            <td><button class='btn btn-primary' onclick='viewBinStock();'>
      <font size='+1'>View Bin Stock</font></button></td>
        </tr></table><br><br>
        <div id="StockDiv"></div>
								</div>
								<!-- /.card-body -->
							</div>



<script>

$(document).ready(function() {
        document.title = 'IP RINGS -  Bin Stock';
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

</script>