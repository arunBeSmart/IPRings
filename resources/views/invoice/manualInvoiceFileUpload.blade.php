<div class="modal-dialog">

      <!-- Modal content-->
    <div class="modal-content"  style="width:150%;">
            <div class="modal-header">

              <h4 class="modal-title" >ADD MANUAL INVOICE FILE

                <button type="button" class="close" data-dismiss="modal"><img width="20%" height="25%" src="{{url('resources\img\close.jpg')}}"></button></h4>
            </div>
        <div class="modal-body">
            <form method="post" action='{{url("upload_invoice_file_manual")}}' enctype="multipart/form-data">
@csrf
            <div class="form-group" >
                  PLEASE SELECT FILE
                    <input class="form-control" type='file' name='uploaded_file'  id ="uploaded_file"  required>
                    
                </div>
                
           




        </div>
        <div class="modal-footer"> <div id="insertButtonDiv">       </div>

          <table  width="100%" ><tr><td align="left">
            <button type="submit" class="btn btn-success" onclick='uploadedManualInvoice();'>UPLOAD</button>

            </td><td align="right">
            <button type="button" class="btn btn-danger" data-dismiss="modal"                                               
                            onclick="$('#myModal').modal('hide');" >CLOSE</button>
            </td</tr></table>

        </div>
        </form>
    </div>
</div>
<script>
    function uploadedManualInvoice()
{
   data = '';
       var completeurl = url +'/upload_invoice_file_manual' ;
       var type = "POST";
       var place = 'insertButtonDiv';
       var formData = new FormData(this);
       ajaxload(type, completeurl, formData, place);

}

</script>