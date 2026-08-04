					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0">Storage Location</h1>
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
									<h3 class="card-title">Storage Location DATA</h3>
								</div>
								<div class="card-body">
<p align='right'>
@if(Session::get('user_type')=='admin')	
						<button class="btn btn-primary "  data-toggle="modal" data-target="#myModal" onclick="addLocationsForm();" >
							+ Add Storage Location</button>
							@endif
</p>


									<table id="locationTable"  class="table table-bordered table-striped table-colored-header table-responsive table-hover" >
										<thead>
											<tr>
												<th>S No</th>
												<th>Location Short Code</th>
												<th>Location Name</th>
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
												<td>{{$data->location_code}}</td>
												<td>{{$data->location_name}}</td>
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

														<td><button class="btn btn-primary"  data-toggle="modal" data-target="#myModal"  onclick="editLocation('{{$data->id}}')" >Edit</button></td>
														@if($data->active==1)
														<td><button class='btn btn-danger'  data-toggle="modal" data-target="#myModal"  onclick="disableLocation('{{$data->id}}')">Disable</button></td>
														@else
														<td><button class='btn btn-primary'  data-toggle="modal" data-target="#myModal"  onclick="enableLocation('{{$data->id}}')">Enable</button></td>
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
        document.title = 'IP RINGS - Store Location Master';
    });
  $(document).ready(function(){
  var empDataTable = $('#locationTable').DataTable({
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
