
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content"  style="width:150%;">
            <div class="modal-header">

              <h4 class="modal-title" >EDIT USER

                <button type="button" class="close" data-dismiss="modal">&times;</button></h4>
            </div>
        <div class="modal-body">
        <form method="post" action='{{url("update_user")}}'>
          @foreach ($DATA as $USER)

          <input type="hidden" name='id'   id ="id" value="{{$USER->id}}">
                      
                    <div class="form-group">
                      NAME <font color='red'>*</font>

                      <input class="form-control" name='name' placeholder="Enter Name"  id ="name" 
                       value="{{$USER->name}}" required>
                      <span class='text-danger'>@error('name'){{$message}} @enderror</span>
                    </div>
                    <div class="form-group" >
                    EMPLOYEE ID <font color='red'>*</font>
                    <input class="form-control" name='Employee_ID' placeholder="Enter EMPLOYEE ID"  id ="Employee_ID" value="{{$USER->Employee_ID}}" required>
                    <span class='text-danger'>@error('Employee_ID'){{$message}} @enderror</span>
                </div>
                    <div class="form-group" >
                        EMAIL ID <font color='red'>*</font>
                        <input type="email" name="email" id="email" placeholder="Enter Email Id" 
                        value="{{$USER->email}}" class="form-control" />
                        <span class='text-danger'>@error('email'){{$message}} @enderror</span>
                    </div>
                      <div class="form-group">
                      NEW PASSWORD <font color='red'>*</font>
                      <input type="password" name="password" id='password' placeholder="Enter new Password" value="" class="form-control" />
                      <span class='text-danger'>@error('password'){{$message}} @enderror</span>
                      </div>
                      <div class="form-group">
                      CONFIRM NEW PASSWORD <font color='red'>*</font>
                      <input type="password" name="confirm_password" id='confirm_password' placeholder="confirm new password" value="" class="form-control" />
                      <span class='text-danger'>@error('confirm_password'){{$message}} @enderror</span>
                      </div>
                      <div class="form-group">
                      USER TYPE <font color='red'>*</font>
                      <select class=" form-control" name='user_type' id ="user_type">
                              <option value='user'
                              @if($USER->user_type=='user'){{'selected="1" ' }} @endif >User</option>
                              <option value='admin' @if($USER->user_type=='admin'){{'selected="1"' }} @endif >Admin</option>
                              <option value='security' @if($USER->user_type=='security'){{'selected="1"' }} @endif >Security</option>
                      </select>
                      <span class='text-danger'>@error('confirm_password'){{$message}} @enderror</span>
                      </div>




                    </div>
                    @endforeach
                    <div id="insertButtonDiv">
                          </div>
                    <div class="modal-footer"> 

                      <table  width="100%" ><tr><td align="left">
                <button type="submit" class="btn btn-success" onclick="update_user();">SAVE</button>

            </td><td align="right">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" >CLOSE</button>
            </td</tr></table>

                  </div>
          </form>
        </div>
  </div>
