<div class="modal-dialog">

      <!-- Modal content-->
    <div class="modal-content"  style="width:150%;">
            <div class="modal-header">

              <h4 class="modal-title" >NEW RACK ADD FORM
                <button type="button" class="close" data-dismiss="modal"><img width="20%" height="25%" src="{{url('resources\img\close.jpg')}}"></button></h4>
            </div>
        <div class="modal-body">
                           
                                
								
								@csrf
									<div class="card-body row">
										
										<div class="form-group col-md-4">
											<label for="location_name">Location Name</label>
											<select class='form-control'  name="location_id" class="form-control" id="location_id" >
										@foreach ($DATA as $data)
										<option value='{{$data->id}}'> ( {{$data->location_code}} ) {{$data->location_name }}</option>
										@endforeach	
										</select>
										</div>
										
									</div>
									<div class="form-group col-md-4">
											<label for="rack_id">Storage Rack</label>
											<input type="text" name="rack_id"  required class="form-control" id="rack_id" placeholder="Storage Rack Here...">
										</div>
										<div class="form-group col-md-4">
											<label for="bin_no">Storage Bin name</label>
											<input type="text" name="bin_no" required class="form-control" id="bin_no" placeholder="Storage Bin name Here...">
										</div>
										<div class="form-group col-md-4">
											<label for="bin_name">Storage Bin no.</label>
											<input type="text" name="bin_name" required  class="form-control" id="bin_name" placeholder="Storage Bin no. Here...">
										</div>
										<div class="form-group col-md-4">
											<label for="status">Status</label>
											<select class="form-control select2" name="status" id="status" style="width: 100%;">
												<option value="1" selected="selected">Active</option>
												<option value="0">In-Active</option>
											</select>
										</div>
									<!-- /.card-body -->
									<div class="card-footer" id="insertButtonDiv"></div>
                                    <table class='table' width='100%'>
                                        <tr>
                                            <td align='center'><button   class="btn btn-primary" data-dismiss="modal" >CLOSE</button></td>
                                            <td align='center'><button  onclick="insertRack();" class="btn btn-success">SAVE</button></td>
                                        </tr>
                                    </table>
										
							
								<!-- /.card-body -->

			</div>
		</div>
	</div>