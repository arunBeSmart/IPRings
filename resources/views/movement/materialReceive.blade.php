<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0">Material Inward</h1>
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
									<h3 class="card-title">Inward Form</h3>
								</div>
								<form id="quickForm">
									<div class="card-body row">
										<div class="form-group col-md-4">
											<label for="product_name">Product Name</label>
											<select class="form-control select2" name="product_name" id="product_name" style="width: 100%;">
												<option value="">Select Product</option>
												
											</select>
										</div>
										<div class="form-group col-md-4">
											<label for="uom1">UOM</label>
											<select class="form-control select2" name="uom1" id="uom1" style="width: 100%;">
												<option value="">Select UOM</option>
											</select>
										</div>
										<div class="form-group col-md-4">
											<label for="quantity">Quantity</label>
											<input type="text" name="quantity" class="form-control" id="quantity" placeholder="Quantity Here...">
										</div>
										<div class="form-group col-md-4">
											<label for="net_weight">Net Weight</label>
											<input type="text" name="net_weight" class="form-control" id="net_weight" placeholder="Net Weight Here...">
										</div>
										<div class="form-group col-md-4">
											<label for="gross_weight">Gross Weight</label>
											<input type="text" name="gross_weight" class="form-control" id="gross_weight" placeholder="Gross Weight Here...">
										</div>
										<div class="form-group col-md-4">
											<label for="po_number">PO Number</label>
											<input type="text" name="po_number" class="form-control" id="po_number" placeholder="PO Number Here...">
										</div>
										<div class="form-group col-md-4">
											<label for="po_date">PO Date</label>
											<input type="date" name="po_date" class="form-control" id="po_date" placeholder="">
										</div>
										<div class="col-md-12">
											<h6><strong>Store Movement</strong></h6>
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
							<input type="button" id="add_master" class="btn btn-md btn-success mb-4" value="Add Material Inward">
							<a href="scan_material_inward.php" class="btn btn-md btn-primary mb-4">Scan Material Inward</a>
							<div class="card card-primary">
								<div class="card-header">
									<h3 class="card-title">Table Data</h3>
								</div>
								<div class="card-body">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>Action</th>
												<th>Inward Code</th>
												<th>Product Name</th>
												<th>UOM</th>
												<th>Quantity</th>
												<th>PO Number</th>
												<th>PO Date</th>
												<th>Store Data</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
											
										</tbody>
										<tfoot>
											<tr>
												<th>S No</th>
												<th>Inward Code</th>
												<th>Product Name</th>
												<th>UOM</th>
												<th>Quantity</th>
												<th>PO Number</th>
												<th>PO Date</th>
												<th>Store Data</th>
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
				
		<div id="divPaySlip" style="display:none;">
			<button type="button" id="testbtn">Print</button>
			<iframe id="ifrPaySlip"  name="ifrPaySlip" scrolling="yes" style="display:none"></iframe>
		</div>  

<script>
	$("#sales_li").removeAttr("class","nav-item");
	$("#sales_li").attr("class","nav-item menu-open");
	$("#sales_li_a").removeAttr("class","nav-link");
	$("#sales_li_a").attr("class","nav-link active");
	$("#material_inward").removeAttr("class","nav-link");
	$("#material_inward").attr("class","nav-link active");
	function showpanel() {     
		window.location.replace("material_inward.php");
	}
	
	function print_preview(id) { 
		var url = "inward_preview.php?id=" + id;
		var newWin = window.frames[0];
		newWin.document.write('<body onload="window.focus;window.print()"><iframe style="position:absolute; top:0px; bottom:0px; right:0px; width:100%; height:100%; border:none;transform: scale(1); margin-left:100%; padding-top:0px; z-index:99999;" src="'+url+'"></body>');
		newWin.document.close();
		newWin.onafterprint = (event) => {
			window.location.replace("material_inward.php");
		};
	}	

$(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      //alert( "Form successful submitted!" );
	  $("#submit").hide();
	  var product_name = $("#product_name").val();
	  var uom = $("#uom1").val();
	  var quantity = $("#quantity").val();
	  var net_weight = $("#net_weight").val();
	  var gross_weight = $("#gross_weight").val();
	  var po_number = $("#po_number").val();
	  var po_date = $("#po_date").val();
	  var storage_location = $("#storage_loc").val();
	  var rack_id = $("#rack_id").val();
	  var bin_data = $("#bin_data").val();
	  var status = $("#status").val();
	  var edit_id = 'None';
	  
	  $.ajax({
		type: "POST",
		url: "add_material_inward.php",
		data: "&product_name=" + product_name + "&uom=" + uom + "&quantity=" + quantity + "&net_weight=" + net_weight + "&gross_weight=" + gross_weight + "&po_number=" + po_number + "&po_date=" + po_date + "&storage_location=" + storage_location + "&rack_id=" + rack_id  + "&bin_data=" + bin_data  + "&status=" + status + "&edit_id=" + edit_id,
		success: function (data) {
			if(data == 'Success'){
				toastr.success('Material Inward Added Succesfully');
				setTimeout(showpanel, 3000);
			} else if(data == 'Error'){
				toastr.error('An Error Occured - Contact IT Support');
				setTimeout(showpanel, 3000);
			} else if(data == 'Duplicate'){
				toastr.error('Duplicate Entry in Material Inward');
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
      uom1: {
        required: true
      },
      quantity: {
        required: true,
        maxlength: 10
      },
      net_weight: {
        required: true,
        maxlength: 10
      },
      gross_weight: {
        required: true,
        maxlength: 10
      },
      po_number: {
        required: true,
        maxlength: 15
      },
      po_date: {
        required: true,
        maxlength: 15
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
      uom1: {
		required:  "Please Select UOM",
	  },
      quantity: {
        required: "Please provide Quantity",
        maxlength: "Your Quantity must be within 10 characters long"
      },
      net_weight: {
        required: "Please provide Net Weight",
        maxlength: "Your Net Weight must be within 10 characters long"
      },
      gross_weight: {
        required: "Please provide Gross Weight",
        maxlength: "Your Gross Weight must be within 10 characters long"
      },
      po_number: {
        required: "Please provide PO Number",
        maxlength: "Your PO Number must be within 15 characters long"
      },
      po_date: {
        required: "Please provide PO Date",
        maxlength: "Your PO Date must be within 15 characters long"
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
		url: "get_uom.php",
		data: "&product_name=" + product_name,
		success: function (data) {
			$("#uom1").html(data);
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

</script>
