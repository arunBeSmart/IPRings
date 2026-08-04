
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content"  style="width:150%;">
      <div class="modal-header">

        <h4 class="modal-title" >Confirm Cancel Packed Box {{$SL_NO}}

          <button type="button" class="close" data-dismiss="modal" onclick="normalScreen();"><img width="20%" height="25%" src="{{url('resources\img\close.jpg')}}"></button></h4>
      </div>
  <div class="modal-body">
  <form method="post" action='{{url("deletePakage")}}'>
   @csrf
 <input type="hidden" name='WORK_ORDER_ID'   id ="WORK_ORDER_ID" value="{{$WORK_ORDER_ID}}">
 <input type="hidden" name='PRIMARY_BARCODE'   id ="PRIMARY_BARCODE" value="{{$PRIMARY_BARCODE}}">
 
 CUSTOMER PART NUMBER: <input readonly class='form-control' name='CUSTOMER_PART_NO'   id ="CUSTOMER_PART_NO" value="{{$CUSTOMER_PART_NO}}">
 <br>BOX TYPE: 
 <input readonly class='form-control'  value="SECONDARY"><BR>
 <br>BOX SL NO: 
 <input readonly class='form-control' name='SL_NO'   id ="SL_NO" value="{{$SL_NO}}"><BR>
 confirm Cancell this package 
              
        



              </div>
           
              <div class="modal-footer"> <div id="insertButtonDiv">
                    </div>

                <table  width="100%" ><tr><td align="left">
          <button type="submit" class="btn btn-danger" onclick="deletePackageSecondary();">CANCEL PACKAGE</button>

      </td><td align="right">
              <button type="button" class="btn btn-success" data-dismiss="modal"  onclick="normalScreen();">CLOSE</button>
      </td</tr></table>

            </div>
    </form>
  </div>
</div>
<script>
  dangerScreen();
  function deletePackageSecondary()
  {
    dangerScreen();
    WORK_ORDER_ID=$('#WORK_ORDER_ID').val();
    CUSTOMER_PART_NO=$('#CUSTOMER_PART_NO').val();
    SL_NO=$('#SL_NO').val();
    PRIMARY_BARCODE=$('#PRIMARY_BARCODE').val();
    
    data = 'WORK_ORDER_ID='+WORK_ORDER_ID + '&CUSTOMER_PART_NO='+CUSTOMER_PART_NO +
      '&SL_NO='+SL_NO+'&PRIMARY_BARCODE='+PRIMARY_BARCODE ;
       

       var completeurl = url +'/delete_Package_secondary' ;
       var type = "POST";
       var place = 'insertButtonDiv';
       ajaxload(type, completeurl, data, place);
       normalScreen();
  }
</script>
