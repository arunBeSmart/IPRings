
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content"  style="width:150%;">
      <div class="modal-header">

        <h4 class="modal-title" >AMEND PACKING DETAILS

          <button type="button" class="close" data-dismiss="modal"><img width="20%" height="25%" src="{{url('resources\img\close.jpg')}}"></button></h4>
      </div>
  <div class="modal-body">
  <form method="post" action='{{url("update_amended")}}'>
   @csrf
 
 <input type="hidden" name='work_order_id'   id ="work_order_id" value="{{$DATA->id}}">
     <table CLASS='table table-responsive table-stripped'>
     <tr>
        <td>CUSTOMER NAME</td>
        <td><input class="form-control" READONLY name='CUSTOMER_NAME'  id ="CUSTOMER_NAME" 
                 value="{{$DATA->CUSTOMER_NAME}}" required></td>
      </tr>
      <tr>
        <td>CUSTOMER PART NUMBER</td>
        <td><input class="form-control" READONLY name='CUSTOMER_PART_NUMBER'  id ="CUSTOMER_PART_NUMBER" 
                 value="{{$DATA->CUSTOMER_PART_NO}}" required></td>
      </tr>
      <tr>
        <td>MATERIAL CODE</td>
        <td><input class="form-control" READONLY name='material_code'  id ="material_code" 
                 value="{{$DATA->material_code}}" required></td>
      </tr>
      <tr>
        <td>MATERIAL DESCRIPTION</td>
        <td><input class="form-control" READONLY name='material_description'  id ="material_description" 
                 value="{{$DATA->material_description}}" required></td>
      </tr>
      <tr>
        <td>HEAT CODE</td>
        <td><input class="form-control"  name='HEAT_CODE'  id ="HEAT_CODE" 
                 value="{{$DATA->HEAT_CODE}}" required></td>
      </tr>
      
      
      <tr>
        <td>YIELD QTY</td>
        <td><input class="form-control" READONLY name='yield_qty'  id ="yield_qty" 
                 value="{{$DATA->yield_qty}}" required>          
        </td>
      </tr>
      
     </table>           
              
                PACKING FACTOR
<TABLE CLASS='table table-responsive table-stripped'>
  <tr><th>DETAILS</th><th>OLD VALUE</th><th>AMENDED VALUE</th></tr>
  <tr>
    <td>PRIMARY BOX PACKING FACTOR</td>
    <td><input class="form-control" READONLY name='OLD_PACKING_FACTOR' placeholder="Enter PACKING_FACTOR"  id ="OLD_PACKING_FACTOR" 
                 value="{{$DATA->PACKING_FACTOR}}" required></td>
    <td><input TYPE='NUMBER' class="form-control" name='AMENDED_PACKING_FACTOR' placeholder="Enter PACKING_FACTOR"  id ="AMENDED_PACKING_FACTOR" 
                 value="{{$DATA->PACKING_FACTOR}}" required></td>
  </tr>
  <tr>
    <td>SECONDARY BOX PACKING FACTOR</td>
    <td><input class="form-control" READONLY name='OLD_MASTER_PACKING_FACTOR' placeholder="Enter MASTER PACKING_FACTOR"  id ="OLD_MASTER_PACKING_FACTOR" 
                 value="{{$DATA->MASTER_PACKING_FACTOR}}" required></td>
    <td><input TYPE='NUMBER' class="form-control" name='AMENDED_MASTER_PACKING_FACTOR' placeholder="Enter MASTER PACKING_FACTOR"  id ="AMENDED_MASTER_PACKING_FACTOR" 
                 value="{{$DATA->MASTER_PACKING_FACTOR}}" required></td>
  </tr>
  
</table>
                
                <span class='text-danger'>@error('name'){{$message}} @enderror</span>
            
             




              </div>
           
              <div class="modal-footer"> <div id="insertButtonDiv">
                    </div>

                <table  width="100%" ><tr><td align="center">
                <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>

      </td><td align="center">
      <button type="submit" class="btn btn-primary" onclick="update_amended();">Update</button>
      </td</tr></table>

            </div>
    </form>
  </div>
</div>
<script>
  function update_amended()
  {
    work_order_id=$('#work_order_id').val();
    HEAT_CODE=$('#HEAT_CODE').val();
    OLD_PACKING_FACTOR=$('#OLD_PACKING_FACTOR').val();
    AMENDED_PACKING_FACTOR=$('#AMENDED_PACKING_FACTOR').val();
    OLD_MASTER_PACKING_FACTOR=$('#OLD_MASTER_PACKING_FACTOR').val();
    AMENDED_MASTER_PACKING_FACTOR=$('#AMENDED_MASTER_PACKING_FACTOR').val();
    fromDate=$('fromDate').val();
    toDate=$('toDate').val();

     if( AMENDED_PACKING_FACTOR==''     || AMENDED_PACKING_FACTOR==0   )
    {
      $('#insertButtonDiv').html('<font color="red">Please Check Primary Packing Factor.</font>' );

    }else if( AMENDED_MASTER_PACKING_FACTOR=='' ||AMENDED_MASTER_PACKING_FACTOR==0)
    {
      $('#insertButtonDiv').html('<font color="red">Please Check Master Packing Factor..</font>' );

    }else
    {
      data = 'work_order_id='+work_order_id +'&OLD_PACKING_FACTOR='+OLD_PACKING_FACTOR 
     +'&AMENDED_PACKING_FACTOR='+AMENDED_PACKING_FACTOR 
      + '&OLD_MASTER_PACKING_FACTOR='+OLD_MASTER_PACKING_FACTOR
      +'&AMENDED_MASTER_PACKING_FACTOR='+AMENDED_MASTER_PACKING_FACTOR 
      +'&HEAT_CODE='+HEAT_CODE+'&fromDate='+fromDate+'&toDate='+toDate;
       var completeurl = url +'/update_amended' ;
       var type = "POST";
       var place = 'insertButtonDiv';
       ajaxload(type, completeurl, data, place);

    }
    
  }
</script>
