<br><br>
<table class='table'>
@foreach($DETAILS as $details)

   <tr>
      <td>({{$details->location_name}})</td>
      <td>{{$details->location_code}}</td>
      <td>{{$details->rack_id}}</td>
      <td>{{$details->bin_no}}</td>
      <td>{{$details->bin_name}}</td>
      <td><button class='btn btn-primary' onclick='viewBinStock({{$details->id}});'>
      <font size='+1'>VIEW STOCK</font></button></td>
   </tr>
   <tr><td colspan=6><div id="StockDiv{{$details->id}}"></div></td></tr>

@endforeach
</table>
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
function viewBinStock(RACK_MASTER_ID)
{
 
    
    data = 'RACK_MASTER_ID='+RACK_MASTER_ID ;
       var completeurl = url +'/viewBinStock' ;
       var type = "POST";
       var place = 'StockDiv'+RACK_MASTER_ID;
       ajaxload(type, completeurl, data, place);
}
</script>