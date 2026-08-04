<div class="modal-dialog">

      <!-- Modal content-->
    <div class="modal-content"  style="width:150%;">
            <div class="modal-header">

              <h4 class="modal-title" >CHANGE PASSWORD FORM

                <button type="button" class="close" data-dismiss="modal"><img width="20%" height="25%" src="{{url('resources\img\close.jpg')}}"></button></h4>
            </div>
        <div class="modal-body">
            <form method="post" action='{{url("insert_product")}}'>
@csrf
            <div class="form-group" >
                    CURRENT PASSWORD 
                    <input type='password' class="form-control" name='CURRENT_PASSWORD' placeholder="Enter CURRENT_PASSWORD"  id ="CURRENT_PASSWORD" value="{{old('CURRENT_PASSWORD')}}" required>
                    <span class='text-danger'>@error('CURRENT_PASSWORD'){{$message}} @enderror</span>
                </div>
                <div class="form-group" >
                    NEW PASSWORD *
                    <input  type='password' class="form-control" name='NEW_PASSWORD' placeholder="Enter NEW_PASSWORD"  id ="NEW_PASSWORD" value="{{old('NEW_PASSWORD')}}" required>
                    <span class='text-danger'>@error('NEW_PASSWORD'){{$message}} @enderror</span>
                </div>
                <div class="form-group" >
                   CONFIRM NEW PASSWORD *
                    <input  type='password' class="form-control" name='CONFIRM_NEW_PASSWORD' placeholder="Enter CONFIRM_NEW_PASSWORD"  id ="CONFIRM_NEW_PASSWORD" value="{{old('CONFIRM_NEW_PASSWORD')}}" required>
                    <span class='text-danger'>@error('CONFIRM_NEW_PASSWORD'){{$message}} @enderror</span>
                </div>
               




        </div>
        <div class="modal-footer"> <div id="insertButtonDiv">       </div>

          <table  width="100%" ><tr><td align="left">
          <button type="button" class="btn btn-danger" data-dismiss="modal"                                               
                            onclick="$('#myModal').modal('hide');" >CLOSE</button>

            </td><td align="right">
            <button type="submit" class="btn btn-success" onclick="updateNewPassword();">SAVE</button>
            </td</tr></table>

        </div>
        </form>
    </div>
</div>
<script>function updateNewPassword()
{
    CURRENT_PASSWORD=$('#CURRENT_PASSWORD').val();
    NEW_PASSWORD=$('#NEW_PASSWORD').val();
    CONFIRM_NEW_PASSWORD=$('#CONFIRM_NEW_PASSWORD').val();
    if(NEW_PASSWORD!=CONFIRM_NEW_PASSWORD){
        $('#insertButtonDiv').html('<font color="red">New Password and Confirm Password not matching.'+
        ' Please retype password  </font>');
    }
    else
    {
    
        if(NEW_PASSWORD.length<6)
        {
            $('#insertButtonDiv').html('<font color="red">New Password must be atleast 6 characters length </font>');

        }else
        {
            data = 'CURRENT_PASSWORD='+CURRENT_PASSWORD+'&NEW_PASSWORD='+NEW_PASSWORD+'&CONFIRM_NEW_PASSWORD='+CONFIRM_NEW_PASSWORD ;
       var completeurl = url +'/updateNewPassword' ;
       var type = "POST";
       var place = 'insertButtonDiv';
       ajaxload(type, completeurl, data, place);

        }
        


    }
  
}</script>