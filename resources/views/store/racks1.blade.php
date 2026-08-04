
		
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0">Storage Area Master</h1>
						</div><!-- /.col -->
						
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<div class="content">
				<div class="container-fluid">
					<!-- Small boxes (Stat box) -->
					<div class="row">
						<div class="col-md-12" id="form">
							<input type="button" id="back_to_list" class="btn btn-md btn-success mb-4" value="Back to List">
							<div class="card card-primary">
								<div class="card-header">
									<h3 class="card-title">Master Form</h3>
								</div>
								<form id="quickForm">
									<div class="card-body row">
										<div class="form-group col-md-4">
											<label for="storage_loc">Storage Location</label>
											<select class="form-control select2" name="storage_loc" id="storage_loc" style="width: 100%;">
												<option value="">Select Storage Location</option>
												<?php
													$fetch1 = "select * from storage_location where status = '1'";
													$result1 = $conn->query($fetch1);
													while($fd1 = $result1->fetch_assoc()){
												?>
													<option value="<?=$fd1['id']?>"><?=$fd1['location_code']?> - <?=$fd1['location_name']?></option>
												<?php
													}
												?>
											</select>
										</div>
										<div class="form-group col-md-4">
											<label for="rack_id">Storage Area</label>
											<input type="text" name="rack_id" class="form-control" id="rack_id" placeholder="Storage Area Here...">
										</div>
										<div class="form-group col-md-4">
											<label for="bin_no">Storage Lot</label>
											<input type="text" name="bin_no" class="form-control" id="bin_no" placeholder="Storage Lot Here...">
										</div>
										<div class="form-group col-md-4">
											<label for="bin_name">Storage Division</label>
											<input type="text" name="bin_name" class="form-control" id="bin_name" placeholder="Storage Division Here...">
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
									<div class="card-footer">
										<button type="submit" id="submit" class="btn btn-primary">Submit</button>
									</div>
								</form>
								<!-- /.card-body -->
							</div>
							<!-- /.card -->
						</div>
						<div class="col-md-12" id="table">
							<?php
								if($_SESSION['sa_create'] == '1'){
							?>
							<input type="button" id="add_master" class="btn btn-md btn-success mb-4" value="Add Rack Master">
							<?php
								}
							?>
							<div class="card card-primary">
								<div class="card-header">
									<h3 class="card-title">Table Data</h3>
								</div>
								<div class="card-body">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>S No</th>
												<th>Storage Location</th>
												<th>Storage Area</th>
												<th>Storage Lot</th>
												<th>Storage Division</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$fetch = "select a.*,b.location_code,b.location_name from rack_master a, storage_location b where a.storage_location = b.id order by a.status desc";
												$result = $conn->query($fetch);
												$i = 1;
												while($fd = $result->fetch_assoc()){
													if($fd['status'] == 1){
														$status = 'Active';
													} else{
														$status = 'In-Active';
													}
											?>
											<tr>
												<td><?=$i++?></td>
												<td><?=$fd['location_code']?> - <?=$fd['location_name']?></td>
												<td><?=$fd['rack_id']?></td>
												<td><?=$fd['bin_no']?></td>
												<td><?=$fd['bin_name']?></td>
												<td><?=$status?></td>
												
												<td>
													<?php
														if($_SESSION['sa_edit'] == '1'){
													?>
													<a href="rack_master_edit.php?id=<?=$fd['id']?>" data-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a> &nbsp;
													<?php
														}
													?>
													<a onclick="print_preview(<?=$fd['id']?>)" class="btn btn-sm btn-primary">Preview</a>
													<!--<a href="item_category_edit.php?id=<?=$fd['id']?>"  data-toggle="tooltip" title="Delete"><i class="fas fa-trash"></i></a>-->
												</td>
											</tr>
											<?php
												}
											?>
										</tbody>
										<tfoot>
											<tr>
												<th>S No</th>
												<th>Storage Location</th>
												<th>Storage Area</th>
												<th>Storage Lot</th>
												<th>Storage Division</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</tfoot>
									</table>
								</div>
								<!-- /.card-body -->
							</div>
							<!-- /.card -->
						</div>
					</div>
			
<script>
	$("#vendor_li").removeAttr("class","nav-item");
	$("#vendor_li").attr("class","nav-item menu-open");
	$("#vendor_li_a").removeAttr("class","nav-link");
	$("#vendor_li_a").attr("class","nav-link active");
	$("#rack_master").removeAttr("class","nav-link");
	$("#rack_master").attr("class","nav-link active");
	function showpanel() {     
		window.location.replace("rack_master.php");
	}

	function print_preview(id) { 
		var url = "rack_preview.php?id=" + id;
		var newWin = window.open('','Print-Window');

		newWin.document.open();
		
		newWin.document.write('<body onload="window.focus;window.print()"><iframe style="position:absolute; top:0px; bottom:0px; right:0px; width:100%; height:100%; border:none;transform: scale(1); margin-left:100%; padding-top:0px; z-index:99999;" src="'+url+'"></body>');
		newWin.document.close();
		newWin.onafterprint = (event) => {
			window.location.replace("rack_master.php");
		};
	}

$(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      //alert( "Form successful submitted!" );
	  $("#submit").hide();
	  var storage_location = $("#storage_loc").val();
	  var rack_id = $("#rack_id").val();
	  var bin_no = $("#bin_no").val();
	  var bin_name = $("#bin_name").val();
	  var status = $("#status").val();
	  var edit_id = 'None';
	  
	  $.ajax({
		type: "POST",
		url: "add_rack_master.php",
		data: "&storage_location=" + storage_location + "&rack_id=" + rack_id  + "&bin_name=" + bin_name  + "&bin_no=" + bin_no + "&status=" + status + "&edit_id=" + edit_id,
		success: function (data) {
			if(data == 'Success'){
				toastr.success('Rack Master Added Succesfully');
				setTimeout(showpanel, 3000);
			} else if(data == 'Error'){
				toastr.error('An Error Occured - Contact IT Support');
				setTimeout(showpanel, 3000);
			} else if(data == 'Duplicate'){
				toastr.error('Duplicate Entry in Rack Master');
				setTimeout(showpanel, 3000);
			} else{
				toastr.error('An Error Occured - Contact IT Support');
				setTimeout(showpanel, 3000);
			}
		}
	  });
	  
    }
  });
  $('#quickForm').validate({
    rules: {
      rack_id: {
        required: true,
        maxlength: 10
      },
      bin_name: {
        required: true,
        maxlength: 50
      },
      bin_no: {
        required: true,
        maxlength: 50
      },
      storage_location: {
        required: true
      },
      status: {
        required: true
      },
    },
    messages: {
      rack_id: {
        required: "Please provide Rack ID",
        maxlength: "Your Rack ID must be within 10 characters long"
      },
      bin_no: {
        required: "Please provide Bin No",
        maxlength: "Your Bin No must be within 50 characters long"
      },
      bin_name: {
        required: "Please provide Bin Name",
        maxlength: "Your Bin Name must be within 50 characters long"
      },
      storage_location: {
		required:  "Please Select Storage Location",
	  },
      status: {
		required:  "Please Select Status",
	  }
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  
	
  
  });
});

</script>
