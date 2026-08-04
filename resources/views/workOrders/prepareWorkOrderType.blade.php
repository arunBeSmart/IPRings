<table class='table'><tr><td >SCAN TYPE  </td>
<td>
{{$SCAN_TYPE}}
  <input type="hidden" name="work_order_id" id='work_order_id' value="{{$work_order_id}}">
  <input type="hidden" name="fromDate" id='fromDate' value="{{$fromDate}}">
  <input type="hidden" name="toDate" id='toDate' value="{{$toDate}}">
 </td><td><button class='btn btn-primary' onclick="myWorkOrderListPage();">Go Back</button></td>
</tr>
<tr><td colspan=2>
<div id='workOrderTypeLoadDiv'>

</div>
</td></tr></table>


<script>

changeTypeOrderMap('{{$SCAN_TYPE}}');
function myWorkOrderListPage()
{
  
   pageLoad('workOrder');     
   getPeriodWorkOrderList();
}
</script>