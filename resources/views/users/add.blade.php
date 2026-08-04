<div class="modal-dialog">

      <!-- Modal content-->
    <div class="modal-content"  style="width:150%;">
            <div class="modal-header">

              <h4 class="modal-title" >ADD USER FORM

                <button type="button" class="close" data-dismiss="modal"><img width="20%" height="25%" src="{{url('resources\img\close.jpg')}}"></button></h4>
            </div>
        <div class="modal-body">
            <form method="post" action='{{url("insert_user")}}'>

            <div class="form-group" >
                    NAME <font color='red'>*</font>
                    <input class="form-control" name='name' placeholder="Enter Name"  id ="name" value="{{old('email')}}" required>
                    <span class='text-danger'>@error('name'){{$message}} @enderror</span>
                </div>
                <div class="form-group" >
                    EMPLOYEE ID <font color='red'>*</font>
                    <input class="form-control" name='Employee_ID' placeholder="Enter EMPLOYEE ID"  id ="Employee_ID" value="{{old('Employee_ID')}}" required>
                    <span class='text-danger'>@error('Employee_ID'){{$message}} @enderror</span>
                </div>
            <div class="form-group" >
                EMAIL ID <font color='red'>*</font>
                <input type="email" name="email" id="email" placeholder="Enter Email Id" value="{{old('email')}}" class="form-control" />
                <span class='text-danger'>@error('email'){{$message}} @enderror</span>
                </div>
            <div class="form-group">
               NEW PASSWORD <font color='red'>*</font>
                <input type="password" name="password" id='password' placeholder="Enter Password" value="{{old('password')}}" class="form-control" />
                <span class='text-danger'>@error('password'){{$message}} @enderror</span>
                </div>
            <div class="form-group">
                CONFIRM PASSWORD <font color='red'>*</font>
                <input type="password" name="confirm_password" id='confirm_password' placeholder="Enter confirm_password" value="{{old('password')}}" class="form-control" />
                <span class='text-danger'>@error('confirm_password'){{$message}} @enderror</span>
                </div>
            <div class="form-group">
                USER TYPE
                <select class=" form-control" name='user_type' id ="user_type">
                        <option value='user'>User</option>
                        <option value='admin'>Admin </option>
                        <option value='security'>security </option>
                </select>
                <span class='text-danger'>@error('confirm_password'){{$message}} @enderror</span>
            </div>




        </div>
        <div id="insertButtonDiv">       </div>
        <div class="modal-footer">

          <table  width="100%" ><tr><td align="left">
            <button type="submit" class="btn btn-success" onclick="insert_user();">SAVE</button>

            </td><td align="right">
            <button type="button" class="btn btn-danger" data-dismiss="modal"                                               
                            onclick="$('#myModal').modal('hide');" >CLOSE</button>
            </td</tr></table>

        </div>
        </form>
    </div>
</div>