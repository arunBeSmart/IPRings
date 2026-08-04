
		
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0">Internal Transfer</h1>
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
									<h3 class="card-title">Material Issue Form</h3>
								</div>
								<form id="quickForm">
									<div class="card-body row">
										<div class="form-group col-md-4">
											<label for="product_name">Product Name</label>
											<select class="form-control select2" name="product_name" id="product_name" style="width: 100%;">
												<option value="">Select Product</option>
											

											</select>
										</div>
										<div class="col-md-12">
											<h6><strong>From Storage Rack Data</strong></h6>
											<hr/>
										</div>
										<div class="form-group col-md-6">
											<label for="from_storage_loc">Select Storage Datas</label>
											<select class="form-control select2" name="from_storage_loc" id="from_storage_loc" style="width: 100%;">
												<option value="">Select</option>
											</select>
										</div>
										<div class="form-group col-md-4">
											<label for="from_quantity">From Quantity</label>		
											<input type="text" name="from_quantity" class="form-control" id="from_quantity" placeholder="Quantity Here..." readonly>
										</div>
										<div class="col-md-12">
											<h6><strong>To Storage Rack Data</strong></h6>
											<hr/>
										</div>
										<div class="form-group col-md-4">
											<label for="storage_loc">Storage Location</label>
											<select class="form-control select2" name="storage_loc" id="storage_loc" style="width: 100%;">
												<option value="">Select Storage Location</option>
												
											</select>
										</div>
										<div class="form-group col-md-4">
											<label for="rack_id">Storage Rack</label>										
											<select class="form-control select2" name="rack_id" id="rack_id" style="width: 100%;">
												<option value="">Select Storage Rack</option>
											</select>
										</div>
										<div class="form-group col-md-4">
											<label for="bin_data">Bin Data</label>		
											<select class="form-control select2" name="bin_data" id="bin_data" style="width: 100%;">
												<option value="">Select </option>
											</select>
										</div>	
										<div class="form-group col-md-4">
											<label for="quantity">Quantity</label>
											<input type="text" name="quantity" class="form-control" id="quantity" placeholder="Quantity Here..." onKeyup="check_qty(this, 0)">
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
							<input type="button" id="add_master" class="btn btn-md btn-success mb-4" value="Transfer Materials">
							<div class="card card-primary">
								<div class="card-header">
									<h3 class="card-title">Table Data</h3>
								</div>
								<div class="card-body">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>S No</th>
												<th>Internal Transfer Code</th>
												<th>Product Name</th>
												<th>From Storage</th>
												<th>To Storage</th>
												<th>Transferred Quantity</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
											
										<tfoot>
											<tr>
												<th>S No</th>
												<th>Internal Transfer Code</th>
												<th>Product Name</th>
												<th>From Storage</th>
												<th>To Storage</th>
												<th>Transfer Quantity</th>
												<th>Status</th>
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
	$("#sales_li").removeAttr("class","nav-item");
	$("#sales_li").attr("class","nav-item menu-open");
	$("#sales_li_a").removeAttr("class","nav-link");
	$("#sales_li_a").attr("class","nav-link active");
	$("#internal_transfer").removeAttr("class","nav-link");
	$("#internal_transfer").attr("class","nav-link active");
	function showpanel() {     
		window.location.replace("internal_transfer.php");
	}
$(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      //alert( "Form successful submitted!" );
	  $("#submit").hide();
	  var product_name = $("#product_name").val();
	  var from_storage_loc = $("#from_storage_loc").val();
	  var from_quantity = $("#from_quantity").val();
	  var storage_location = $("#storage_loc").val();
	  var rack_id = $("#rack_id").val();
	  var bin_data = $("#bin_data").val();
	  var quantity = $("#quantity").val();
	  var status = $("#status").val();
	  var edit_id = 'None';
	  
	  $.ajax({
		type: "POST",
		url: "add_internal_transfer.php",
		data: "&product_name=" + product_name + "&from_storage_loc=" + from_storage_loc + "&from_quantity=" + from_quantity + "&storage_location=" + storage_location + "&rack_id=" + rack_id + "&bin_data=" + bin_data + "&quantity=" + quantity  + "&status=" + status + "&edit_id=" + edit_id,
		success: function (data) {
			if(data == 'Success'){
				toastr.success('Material Transferred Succesfully');
				setTimeout(showpanel, 3000);
			} else if(data == 'Error'){
				toastr.error('An Error Occured - Contact IT Support');
				setTimeout(showpanel, 3000);
			} else if(data == 'Duplicate'){
				toastr.error('Duplicate Entry in Material Transfer');
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
      product_name: {
        required: true
      },
      quantity: {
        required: true,
        maxlength: 10
      },
      from_storage_loc: {
        required: true
      },
      storage_loc: {
        required: true
      },
      rack_id: {
        required: true
      },
      bin_data: {
        required: true
      },
      status: {
        required: true
      },
    },
    messages: {
      product_name: {
		required:  "Please Select Product Name",
	  },
      quantity: {
        required: "Please provide Quantity",
        maxlength: "Your Quantity must be within 10 characters long"
      },
      from_storage_loc: {
		required:  "Please Select Movement Storage Location",
	  },
      storage_loc: {
		required:  "Please Select Storage Location",
	  },
      rack_id: {
		required:  "Please Select Storage Rack",
	  },
      bin_data: {
		required:  "Please Select Bin Data",
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

$("#product_name").on("change",function(){
	var product_name = $("#product_name").val();
	
	$.ajax({
		type: "POST",
		url: "get_store_details.php",
		data: "&product_name=" + product_name,
		success: function (data) {
			$("#from_storage_loc").html(data);
			$("#from_quantity").val('');
		}
	});
});

$("#from_storage_loc").on("change",function(){
	var from_storage_loc = $("#from_storage_loc").val();
	
	$.ajax({
		type: "POST",
		url: "get_storerack_details.php",
		data: "&from_storage_loc=" + from_storage_loc,
		success: function (data) {
			$("#from_quantity").val(data);
		}
	});
});


$("#storage_loc").on("change",function(){
	var storage_loc = $("#storage_loc").val();
	
	$.ajax({
		type: "POST",
		url: "get_rack.php",
		data: "&storage_loc=" + storage_loc,
		success: function (data) {
			$("#rack_id").html(data);
		}
	});
});

$("#rack_id").on("change",function(){
	var storage_loc = $("#storage_loc").val();
	var rack_id = $("#rack_id").val();
	
	$.ajax({
		type: "POST",
		url: "get_bin.php",
		data: "&storage_loc=" + storage_loc + "&rack_id=" + rack_id,
		success: function (data) {
			$("#bin_data").html(data);
		}
	});
});

function check_qty(cq){
	var qty = $("#quantity").val();
	var from_quantity = $("#from_quantity").val();
	if(from_quantity != ''){
		if(parseFloat(qty) > parseFloat(from_quantity)){
			alert("Movement Quantity should not be greater than the Available Stock Quantity.");
			$("#quantity").val('');
		} 
	} else{
		alert("Select the Storage Area first.");
		$("#quantity").val('');
	}
}

</script>
