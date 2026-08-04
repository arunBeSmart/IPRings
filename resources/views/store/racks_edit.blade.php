<div class="modal-dialog">

      <!-- Modal content-->
    <div class="modal-content"  style="width:150%;">
            <div class="modal-header">

              <h4 class="modal-title" >EDIT RACK DETAILS FORM
                <button type="button" class="close" data-dismiss="modal"><img width="20%" height="25%" src="{{url('resources\img\close.jpg')}}"></button></h4>
            </div>
        <div class="modal-body">
                           
                                
								
								@csrf
								@foreach ($RACKS as $data)
									<div class="card-body row">
									<input type='hidden' name='table_id' id='table_id' value='{{$data->id}}' >	
										<div class="form-group col-md-4">
											<label for="location_name">Location Name</label>
											<select class='form-control'  name="location_id" class="form-control" id="location_id" >
										@foreach($LOCATIONS as $location)
										@if($data->storage_location==$location->id)
										<option selected='1' value='{{$location->id}}'> ( {{$location->location_code}} ) {{$location->location_name }}</option>
										@else
										<option value='{{$location->id}}'> ( {{$location->location_code}} ) {{$location->location_name }}</option>
										@endif
										
										@endforeach
										</select>
										</div>
										
									</div>
									<div class="form-group col-md-4">
											<label for="rack_id">Storage Rack</label>
											<input type="text" value="{{$data->rack_id}}" name="rack_id"  required class="form-control" id="rack_id" placeholder="Storage Area Here...">
										</div>
										<div class="form-group col-md-4">
											<label for="bin_no">Storage Bin name</label>
											<input type="text"  value="{{$data->bin_no}}"  name="bin_no" required class="form-control" id="bin_no" placeholder="Storage Lot Here...">
										</div>
										<div class="form-group col-md-4">
											<label for="bin_name">Storage Bin no.</label>
											<input type="text"   value="{{$data->bin_name}}"  name="bin_name" required  class="form-control" id="bin_name" placeholder="Storage Division Here...">
										</div>
										<div class="form-group col-md-4">
											<label for="status">Status</label>
											<select class="form-control select2" name="status" id="status" style="width: 100%;">
											@if($data->active==1)	
											<option value="1" selected="selected">Active</option>
												<option value="0">In-Active</option>
												@else
												<option value="1" >Active</option>
												<option value="0" selected="1">In-Active</option>
												@endif
											</select>
										</div>
										@endforeach	
									<!-- /.card-body -->
									<div class="card-footer" id="insertButtonDiv"></div>
                                    <table class='table' width='100%'>
                                        <tr>
                                            <td align='center'><button   class="btn btn-primary" data-dismiss="modal" >CLOSE</button></td>
                                            <td align='center'><button  onclick="updateRack();" class="btn btn-success">UPDATE</button></td>
                                        </tr>
                                    </table>
										
							
								<!-- /.card-body -->

			</div>
		</div>
	</div>