					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0">Storage Rack</h1>
						</div><!-- /.col -->
						
					</div><!-- /.row -->
				

			<!-- Main content -->
			<div class="content">
				<div class="container-fluid">
					<!-- Small boxes (Stat box) -->
					<div class="row">
						
						<div class="col-md-12" id="table">
							
							<div class="card card-primary">
								<div class="card-header">
									<h3 class="card-title">RACKS Data</h3>
								</div>
								<div class="card-body">
									<p align='right'>
									@if(Session::get('user_type')=='admin')
							<button class="btn btn-primary "  data-toggle="modal" data-target="#myModal" onclick="addRacksForm();" >
							+ Add Storage Racks</button>
							@endif
									</p>
									<table id="racksTable"  class="table table-bordered table-striped table-colored-header table-responsive table-hover" >
										<thead>
											<tr>
											<th>S No</th>
												<th>Storage Location</th>
												<th>Storage Rack</th>
												<th>Storage Bin Name</th>
												<th>Storage Bin no.</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										@foreach($DATA as $data)
										@if($data->active==0)    
										<tr style="background-color:gray;" > 
										@else
										<tr>
										@endif
										<td>{{$data->id}}</td>
												<td>({{$data->location_code}}) {{$data->location_name}}</td>
												<td>{{$data->rack_id}}</td>
												<td>{{$data->bin_no}}</td>
												<td>{{$data->bin_name}}</td>
												<td>
													@if($data->active==1)
													ACTIVE
													@else
													DISABLED
													@endif
												</td>
												<td>
													@if(Session::get('user_type')=='admin')
													<table><tr>

														<td><button class="btn btn-primary"  data-toggle="modal" data-target="#myModal"  onclick="editRack('{{$data->id}}')" >Edit</button></td>
														@if($data->active==1)
														<td><button class='btn btn-danger'  data-toggle="modal" data-target="#myModal"  onclick="disableRack('{{$data->id}}')">Disable</button></td>
														@else
														<td><button class='btn btn-primary'  data-toggle="modal" data-target="#myModal"  onclick="enableRack('{{$data->id}}')">Enable</button></td>
														@endif

													</tr></table>

													@endif

												</td></tr>

										@endforeach
										</tbody>
										
									</table>
								</div>
								<!-- /.card-body -->
							</div>
							<!-- /.card -->
						</div>
					</div>
			

				</div>
			</div>
<script>

$(document).ready(function() {
        document.title = 'IP RINGS - Store Racks Master';
    });
  $(document).ready(function(){
  var empDataTable = $('#racksTable').DataTable({
     dom: 'Blfrtip',
     buttons: [
       {  
          extend: 'copy'
       },
       {
          extend: 'pdf',
          exportOptions: {
            columns: [0,1,2,3,4,5] // Column index which needs to export
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

function insertRack()
{
		location_id=$('#location_id').val();
		rack_id=$('#rack_id').val();
		bin_no=$('#bin_no').val();
		bin_name=$('#bin_name').val();
    	status=$('#status').val();
		
         
          if(bin_no!='' && bin_name!='' &&  rack_id!='' )
          {
            data = 'location_id='+location_id+'&rack_id='+rack_id+'&active='+status+
			'&bin_no='+bin_no+'&bin_name='+bin_name         ;
		 
          var completeurl = url +'/insertRack';
              var type = "POST";
              var place = 'insertButtonDiv';
			  
              ajaxload(type, completeurl, data, place);
          }else 
          {
            alert('Please Check Input ');
          }
}
function updateRack()
{
		location_id=$('#location_id').val();
		rack_id=$('#rack_id').val();
		bin_no=$('#bin_no').val();
		bin_name=$('#bin_name').val();
    	status=$('#status').val();
		table_id=$('#table_id').val();
         
          if(bin_no!='' && bin_name!='' &&  rack_id!='' )
          {
            data = 'location_id='+location_id+'&rack_id='+rack_id+'&active='+status+
			'&bin_no='+bin_no+'&bin_name='+bin_name  +'&table_id='+table_id         ;
		 
          var completeurl = url +'/updateRack';
              var type = "POST";
              var place = 'insertButtonDiv';
			  
              ajaxload(type, completeurl, data, place);
          }else 
          {
            alert('Please Check Input ');
          }
}
function editRack(rack_id)
{
  
         
            data = 'rack_id='+rack_id          ;
		 
          var completeurl = url +'/editRack';
              var type = "POST";
              var place = 'myModal';
			  
              ajaxload(type, completeurl, data, place);
         
}
function enableRack(rack_id)
{
  
         
            data = 'rack_id='+rack_id          ;
		 
          var completeurl = url +'/enableRack';
              var type = "POST";
              var place = 'myModal';
			  
              ajaxload(type, completeurl, data, place);
         
}
function disableRack(rack_id)
{
  
         
            data = 'rack_id='+rack_id          ;
		 
          var completeurl = url +'/disableRack';
              var type = "POST";
              var place = 'myModal';
			  
              ajaxload(type, completeurl, data, place);
         
}

function addRacksForm()
{
	data = '';      

var completeurl = url +'/addRacksForm' ;
var type = "POST";
var place = 'myModal';

ajaxload(type, completeurl, data, place);
}


</script>
