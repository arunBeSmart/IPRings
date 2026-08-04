
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content"  style="width:150%;">
      <div class="modal-header">

        <h4 class="modal-title" >HEAT CODE UPDATE

          <button type="button" class="close" data-dismiss="modal" onclick="normalScreen();"><img width="20%" height="25%" src="{{url('resources\img\close.jpg')}}"></button></h4>
      </div>
  <div class="modal-body">
  <form method="post" >
   @csrf
 <input type="hidden" name='WORK_ORDER_ID'   id ="WORK_ORDER_ID" value="{{$WORK_ORDER_ID}}">
 ENTER HEAT CODE
 <input class='form-control' name='HEAT_CODE' required  id ="HEAT_CODE" value="" >




              </div>

              <div class="modal-footer"> <div id="insertButtonDiv">
                    </div>

                <table  width="100%" ><tr><td align="left">
          <button type="submit" class="btn btn-danger" onclick="updateHeatCode();">Update HeatCode</button>

      </td><td align="right">
              <button type="button" class="btn btn-success" data-dismiss="modal"  onclick="normalScreen();">CLOSE</button>
      </td</tr></table>

            </div>
    </form>
  </div>
<script>
 
  function updateHeatCode()
  {
    
    WORK_ORDER_ID=$('#WORK_ORDER_ID').val();
    HEAT_CODE=$('#HEAT_CODE').val();
    if(HEAT_CODE=='' ||HEAT_CODE==0)
    {
     alert('Please enter Heat Code');
    }
    else{
      data = 'WORK_ORDER_ID='+WORK_ORDER_ID + '&HEAT_CODE='+HEAT_CODE;


       var completeurl = url +'/updateHeatCode' ;
       var type = "POST";
       var place = 'insertButtonDiv';
       ajaxload(type, completeurl, data, place);

    }
   
    
       
  }
</script>
