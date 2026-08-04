
		
		
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0">Material Issue</h1>
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
						
						<div class="col-md-12" id="table">
							<input type="button" id="add_master" class="btn btn-md btn-success mb-4" value="Material Issue">
							<div class="card card-primary">
								<div class="card-header">
									<h3 class="card-title">Table Data</h3>
								</div>
								<div class="card-body">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>S No</th>
												<th>Material Code</th>
												<th>Product Name</th>
												<th>From Storage</th>
												<th>Issued Quantity</th>
												<th>Issue Type</th>
												<th>Department</th>
												<th>DC Number</th>
												<th>DC Date</th>
												<th>Detailed Description</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
											
										</tbody>
										<tfoot>
											<tr>
												<th>S No</th>
												<th>Material Code</th>
												<th>Product Name</th>
												<th>From Storage</th>
												<th>Issued Quantity</th>
												<th>Issue Type</th>
												<th>Department</th>
												<th>DC Number</th>
												<th>DC Date</th>
												<th>Detailed Description</th>
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
	$("#material_issue").removeAttr("class","nav-link");
	$("#material_issue").attr("class","nav-link active");
	function showpanel() {     
		window.location.replace("material_issue.php");
	}
$(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      //alert( "Form successful submitted!" );
	  $("#submit").hide();
	  var product_name = $("#product_name").val();
	  var from_storage_loc = $("#from_storage_loc").val();
	  var from_quantity = $("#from_quantity").val();
	  var issue_type = $("#issue_type").val();
	  var department = $("#department").val();
	  var desc = $("#desc").val();
	  var dc_number = $("#dc_number").val();
	  var dc_date = $("#dc_date").val();
	  var e_desc = $("#e_desc").val();
	  var quantity = $("#quantity").val();
	  var status = $("#status").val();
	  var edit_id = 'None';
	  
	  $.ajax({
		type: "POST",
		url: "add_material_issue.php",
		data: "&product_name=" + product_name + "&from_storage_loc=" + from_storage_loc + "&from_quantity=" + from_quantity + "&issue_type=" + issue_type + "&department=" + department + "&desc=" + desc + "&dc_number=" + dc_number + "&dc_date=" + dc_date + "&e_desc=" + e_desc + "&quantity=" + quantity  + "&status=" + status + "&edit_id=" + edit_id,
		success: function (data) {
			if(data == 'Success'){
				toastr.success('Material Issued Succesfully');
				setTimeout(showpanel, 3000);
			} else if(data == 'Error'){
				toastr.error('An Error Occured - Contact IT Support');
				setTimeout(showpanel, 3000);
			} else if(data == 'Duplicate'){
				toastr.error('Duplicate Entry in Material Issued');
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
      issue_type: {
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
      issue_type: {
		required:  "Please Select Issue Type",
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

$("#internal").hide();
$("#external").hide();

$("#issue_type").on("change",function(){
	var issue_type = $("#issue_type").val();
	
	if(issue_type == 1){
		$("#internal").show();
		$("#external").hide();
	}else if(issue_type == 2){
		$("#internal").hide();
		$("#external").show();
	} else{
		$("#internal").hide();
		$("#external").hide();
	}
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
