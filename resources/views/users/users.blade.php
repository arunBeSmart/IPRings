<div class="card card-primary">
								<div class="card-header">
									<h3 class="card-title">USERS Data</h3>
								</div>
								<div class="card-body">

               <p align='right'>
                  <!-- The Modal -->
@if(Session::get('user_type')=='admin')
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" onclick="addUser();">
+ ADD USER</button>
@endif
               </p>         

                        <table id="users_table" width="80%"  class="table table-bordered table-striped table-colored-header table-responsive table-striped table-hover"  >
    <thead><tr><th>SLNO</th><th>EMPLOYEE ID</th>
    <th>NAME</th>
    <th>EMAIL</th>
    <th>USER TYPE</th>
    <th>OPTIONS</th>
    </tr></thead>
    <tbody>
        @foreach($DATA as $user)
      
      @if($user->active==0)    
      <tr style="background-color:gray;" > 
      @else
      <tr>
      @endif
      
        <td>{{$user->id}}</td><td>{{$user->Employee_ID}}</td>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->user_type}}</td>
        <td>
         @if(Session::get('user_type')=='admin')
          <table><tr><td>  <button class="btn btn-success" data-toggle="modal" data-target="#myModal" onclick="editUser('{{$user->id}}');"  >Edit</button>
</td><td> @if($user->active==1)           
            <button class='btn btn-danger' data-toggle="modal" data-target="#myModal" onclick="disableUser('{{$user->id}}');"  >Disable</button>
           @endif
           @if($user->active==0)      
           <button class='btn btn-danger' data-toggle="modal" data-target="#myModal" onclick="enableUser('{{$user->id}}');"  >Enable</button>
           @endif </td></tr></table>
           @endif
         </td>
    </tr>
    @endforeach
    </tbody>
</table>


								</div>
								<!-- /.card-body -->
							</div>




<script>
function  editUser(user_id)
    {
    
      data = 'user_id='+user_id;
       

       var completeurl = url +'/editUser' ;
       var type = "POST";
       var place = 'myModal';
       
       ajaxload(type, completeurl, data, place);
      

    }
    function  addUser()
    {
    
      data = '';      

       var completeurl = url +'/addUser' ;
       var type = "POST";
       var place = 'myModal';
      
       ajaxload(type, completeurl, data, place);
      

    }
    function  disableUser(user_id)
    {
      data = 'user_id='+user_id;
       

       var completeurl = url +'/disableUser' ;
       var type = "POST";
       var place = 'myModal';
       ajaxload(type, completeurl, data, place);
      

    }
    function  enableUser(user_id)
    {
      data = 'user_id='+user_id;
       

       var completeurl = url +'/enableUser' ;
       var type = "POST";
       var place = 'myModal';
       ajaxload(type, completeurl, data, place);
      

    }

$(document).ready(function() {
        document.title = 'IP RINGS - Users';
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
            columns: [0,1,2,3] // Column index which needs to export
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
</script>
