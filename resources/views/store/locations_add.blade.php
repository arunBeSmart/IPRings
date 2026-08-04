<div class="modal-dialog">

      <!-- Modal content-->
    <div class="modal-content"  style="width:150%;">
            <div class="modal-header">

              <h4 class="modal-title" >NEW LOCATION ADD FORM
                <button type="button" class="close" data-dismiss="modal"><img width="20%" height="25%" src="{{url('resources\img\close.jpg')}}"></button></h4>
            </div>
        <div class="modal-body">
                           
                                
								
								@csrf
									<div class="card-body row">
										<div class="form-group col-md-4">
											<label for="location_code">Location Short Code</label>
											<input type="text" name="location_code" class="form-control" id="location_code" placeholder="Location Short Code Here...">
										</div>
										<div class="form-group col-md-4">
											<label for="location_name">Location Name</label>
											<input type="text" name="location_name" class="form-control" id="location_name" placeholder="Location Name Here...">
										</div>
										<div class="form-group col-md-4">
											<label for="status">Status</label>
											<select class="form-control select2" name="status" id="status" style="width: 100%;">
												<option value="1" selected="selected">Active</option>
												<option value="0">In-Active</option>
											</select>
										</div>
									</div>
									<!-- /.card-body -->
									<div class="card-footer" id="insertButtonDiv"></div>
                                    <table class='table' width='100%'>
                                        <tr>
                                            <td align='center'><button   class="btn btn-primary" data-dismiss="modal" >CLOSE</button></td>
                                            <td align='center'><button  onclick="insertLocation();" class="btn btn-success">SAVE</button></td>
                                        </tr>
                                    </table>
										
							
								<!-- /.card-body -->

			</div>
		</div>
	</div>