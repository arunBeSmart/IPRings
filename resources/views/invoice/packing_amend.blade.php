
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
 <input type="hidden" name='invoice_id'   id ="invoice_id" value="{{$DATA->INVOICE_ID}}">
     <table CLASS='table table-responsive table-stripped'>
     <tr>
        <td>CUSTOMER NAME</td>
        <td><input class="form-control" READONLY name='CUSTOMER_NAME'  id ="CUSTOMER_NAME" 
                 value="{{$DATA->CUSTOMER_NAME}}" required></td>
      </tr>
      <tr>
        <td>SALE ORDER</td>
        <td><input class="form-control" READONLY name='SALE_ORDER'  id ="SALE_ORDER" 
                 value="{{$DATA->SALE_ORDER}}" required></td>
      </tr>
      <tr>
        <td>SALE ORDER ITEM</td>
        <td><input class="form-control" READONLY name='SALE_ORDER_ITEM'  id ="SALE_ORDER_ITEM" 
                 value="{{$DATA->SALE_ORDER_ITEM}}" required></td>
      </tr>
      <tr>
        <td>CUSTOMER PART NUMBER</td>
        <td><input class="form-control" READONLY name='CUSTOMER_PART_NUMBER'  id ="CUSTOMER_PART_NUMBER" 
                 value="{{$DATA->CUSTOMER_PART_NUMBER}}" required></td>
      </tr>
      <tr>
        <td>BILLED QTY</td>
        <td><input class="form-control" READONLY name='BILLED_QTY'  id ="BILLED_QTY" 
                 value="{{$DATA->BILLED_QTY}}" required>          
        </td>
      </tr>
      
     
      

     </table>           
              
                PACKING FACTOR
<TABLE CLASS='table table-responsive table-stripped'>
  <tr><th>DETAILS</th><th>OLD VALUE</th><th>AMENDED VALUE</th></tr>
  <tr>
    <td>PACKING FACTOR</td>
    <td><input class="form-control" READONLY name='OLD_PACKING_FACTOR' placeholder="Enter PACKING_FACTOR"  id ="OLD_PACKING_FACTOR" 
                 value="{{$DATA->PACKING_FACTOR}}" required></td>
    <td><input TYPE='NUMBER' class="form-control" name='AMENDED_PACKING_FACTOR' placeholder="Enter PACKING_FACTOR"  id ="AMENDED_PACKING_FACTOR" 
                 value="{{$DATA->PACKING_FACTOR}}" required></td>
  </tr>
  <tr>
    <td>MASTER BOX PACKING FACTOR</td>
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

                <table  width="100%" ><tr><td align="left">
          <button type="submit" class="btn btn-danger" onclick="update_amended();">SAVE</button>

      </td><td align="right">
              <button type="button" class="btn btn-success" data-dismiss="modal" >CLOSE</button>
      </td</tr></table>

            </div>
    </form>
  </div>
</div>
<script>
  function update_amended()
  {
    SALE_ORDER=$('#SALE_ORDER').val();
    SALE_ORDER_ITEM=$('#SALE_ORDER_ITEM').val();
    INVOICE_ID=$('#invoice_id').val();
    CUSTOMER_PART_NUMBER=$('#CUSTOMER_PART_NUMBER').val();
    CUSTOMER_NAME=$('#CUSTOMER_NAME').val();
    BILLED_QTY=$('#BILLED_QTY').val();
    OLD_PACKING_FACTOR=$('#OLD_PACKING_FACTOR').val();
    AMENDED_PACKING_FACTOR=$('#AMENDED_PACKING_FACTOR').val();
    OLD_MASTER_PACKING_FACTOR=$('#OLD_MASTER_PACKING_FACTOR').val();
    AMENDED_MASTER_PACKING_FACTOR=$('#AMENDED_MASTER_PACKING_FACTOR').val();
    
    data = 'SALE_ORDER='+SALE_ORDER + '&SALE_ORDER_ITEM='+SALE_ORDER_ITEM +
      '&INVOICE_ID='+INVOICE_ID + '&CUSTOMER_PART_NUMBER='+CUSTOMER_PART_NUMBER +
      '&CUSTOMER_NAME='+CUSTOMER_NAME + '&BILLED_QTY='+BILLED_QTY +
      '&OLD_PACKING_FACTOR='+OLD_PACKING_FACTOR +'&AMENDED_PACKING_FACTOR='+AMENDED_PACKING_FACTOR 
      + '&OLD_MASTER_PACKING_FACTOR='+OLD_MASTER_PACKING_FACTOR+'&AMENDED_MASTER_PACKING_FACTOR='+AMENDED_MASTER_PACKING_FACTOR ;
       

       var completeurl = url +'/update_amended' ;
       var type = "POST";
       var place = 'insertButtonDiv';
       ajaxload(type, completeurl, data, place);
  }
</script>
