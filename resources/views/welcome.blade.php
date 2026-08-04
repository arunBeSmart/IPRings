<!doctype html>
<html lang="en">
  <head><meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IP Rings - Dashboard</title>
    <link rel="icon" href="{{url('resources/img/favicon.ico')}}" type="image/ico">
    <!-- Required meta tags -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{url('resources/css/css001.css')}}" >
    <link rel="stylesheet" href="{{url('resources/css/css002.css')}}" >
    <link rel="stylesheet" href="{{url('resources/css/css003.css')}}" >
    <link rel="stylesheet" href="{{url('resources/css/css004.css')}}" >
    <link rel="stylesheet" href="{{url('resources/css/css005.css')}}" >
    <link rel="stylesheet" href="{{url('resources/css/css006.css')}}" >
    <link rel="stylesheet" href="{{url('resources/css/css007.css')}}" >
    <link rel="stylesheet" href="{{url('resources/css/css008.css')}}" >
    <link rel="stylesheet" href="{{url('resources/css/css009.css')}}" >
    <link rel="stylesheet" href="{{url('resources/css/css010.css')}}" >
    <link rel="stylesheet" href="{{url('resources/css/css011.css')}}" >
    <link rel="stylesheet" href="{{url('resources/css/css012.css')}}" >
    <link rel="stylesheet" href="{{url('resources/css/css013.css')}}" >
    <link rel="stylesheet" href="{{url('resources/css/FA.css')}}" >
    <link rel="stylesheet" href="{{url('/resources/css/barcode_maxcdn_bootstrap.css')}}">
    <link rel="stylesheet" href="{{url('/resources/css/cdnjs.cloudflare.com_ajax_libs_font-awesome_4.7.0_css_font-awesome.min.css')}}">
<style>.main {
  margin-left: 10px; /* Same as the width of the sidenav */
  font-size: 16px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
a{
  font-size: 18px;
}

.topnav {

  background-color: #0095d9;
}

.navbar {

  background-color: #0095d9;

}
.main-sidebar
{

  background-color: #0095d9;

}
.anchorBG
{

  background-color: #0095d9;
}
body {
  font-family: "Lato", Times new Roman;
}

.sidenav {
  height: 100%;
  width: 160px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #0095d9;
  overflow-x: hidden;
  padding-top: 20px;
}

.sidenav a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-family:Times new roman;
  font-size: 15px;
  color: black;
  display: block;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.main {
  margin-left: 5px; /* Same as the width of the sidenav */
  font-size: 16px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}



/* selected link */
.sidenav a:active {
  color: blue;
}
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #0095d9;
}
.box-button
{
  background-color: #deb76a;
  width:150px;
  height:75px;
}
.master-box-button
{
  background-color: #deb888;
  width:250px;
  height:125px;
}
.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: white;
}

.topnav a.active {
  background-color: #04AA6D;
  color: red;
}

.dropbtn {
  background-color: #3498DB;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropbtn:hover, .dropbtn:focus {
  background-color: #2980B9;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  overflow: auto;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown a:hover {background-color: #ddd;}

.show {display: block;}
.btn-primary {
    color: #fff;
    background-color: #0095d9;
    border-color: #007bff;
    box-shadow: none;
}
.sidebar a{

color:white;
}
a{
  color:white;
}
.sidebar a {
    font-color: white;
}
a#dashboard.nav-link{
  color:white;
}
a.d-block
{
  color:white;
}
.nav-treeview
{color:white;}
p{color:white;}
i{color:white;
font-size:16px;}
.main-header.text-sm .nav-link>.fa, .main-header.text-sm .nav-link>.fab, .main-header.text-sm .nav-link>.fad, .main-header.text-sm .nav-link>.fal, .main-header.text-sm .nav-link>.far, .main-header.text-sm .nav-link>.fas, .main-header.text-sm .nav-link>.ion, .main-header.text-sm .nav-link>.svg-inline--fa, .text-sm .main-header .nav-link>.fa, .text-sm .main-header .nav-link>.fab, .text-sm .main-header .nav-link>.fad, .text-sm .main-header .nav-link>.fal, .text-sm .main-header .nav-link>.far, .text-sm .main-header .nav-link>.fas, .text-sm .main-header .nav-link>.ion, .text-sm .main-header .nav-link>.svg-inline--fa {
    font-size: 1.875rem;
}
.boxedTable:hover

  {
    background: #f07a62;
}
.loadingDiv
{
  background-color: white;
  width:150px;
  height:100px;
}

#barcodeScanIn:focus, textarea:focus {
  box-shadow: 0 0 5px rgba(81, 203, 238, 1);
  padding: 3px 0px 3px 3px;
  margin: 5px 1px 3px 0px;
  border: 5px solid blue;
}
.card-primary:not(.card-outline)>.card-header {
    background-color: #0095d9;
}
.select2
{
  
    display: block;
    width: 100%;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    -webkit-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;

}
</style>
  </head>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="{{url('resources/js/tableColumnSearch/jquery-3.7.0.js')}}"></script>
    <script src="{{url('resources/js/tableColumnSearch/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('resources/js/tableColumnSearch/dataTables.fixedColumns.min.js')}}"></script>

  <script src="{{url('resources/js/js01.js')}}"></script>
    <script src="{{url('resources/js/js02.js')}}"></script>
    <script src="{{url('resources/js/js03.js')}}"></script>
    <script src="{{url('resources/js/js04.js')}}"></script>
    <script src="{{url('resources/js/js05.js')}}"></script>
    <script src="{{url('resources/js/js06.js')}}"></script>
    <script src="{{url('resources/js/js07.js')}}"></script>
    <script src="{{url('resources/js/js08.js')}}"></script>
    <script src="{{url('resources/js/js09.js')}}"></script>
    <script src="{{url('resources/js/js10.js')}}"></script>
    <script src="{{url('resources/js/js11.js')}}"></script>
    <script src="{{url('resources/js/js12.js')}}"></script>
    <script src="{{url('resources/js/js13.js')}}"></script>
    <script src="{{url('resources/js/js14.js')}}"></script>
    <script src="{{url('resources/js/js15.js')}}"></script>
    <script src="{{url('resources/js/js16.js')}}"></script>
    <script src="{{url('resources/js/js17.js')}}"></script>
    <script src="{{url('resources/js/js18.js')}}"></script>
    <script src="{{url('resources/js/js19.js')}}"></script>
    <script src="{{url('resources/js/js20.js')}}"></script>
    <script src="{{url('resources/js/js21.js')}}"></script>
    <script src="{{url('resources/js/js22.js')}}"></script>
    <script src="{{url('resources/js/js23.js')}}"></script>
    <script src="{{url('resources/js/js24.js')}}"></script>
    <script src="{{url('resources/js/js25.js')}}"></script>
    <script src="{{url('resources/js/js26.js')}}"></script>

<!-- header --->

<body class="layout-navbar-fixed sidebar-mini layout-fixed layout-footer-fixed text-sm">
	<div class="wrapper">

		<!-- Preloader -->
		<div class="preloader flex-column justify-content-center align-items-center">
			<img class="animation__shake" src="dist/img/store_log.png" alt="Store Logo" height="150" width="150">
		</div>



		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-white navbar-light">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				</li>
				<!--<li class="nav-item d-none d-sm-inline-block">
					<a href="index3.html" class="nav-link">Home</a>
				</li>
				<li class="nav-item d-none d-sm-inline-block">
					<a href="#" class="nav-link">Contact</a>
				</li>-->
			</ul>

			<!-- Right navbar links -->
			<ul class="navbar-nav ml-auto">
				<!-- Navbar Search -->


				<!-- Messages Dropdown Menu -->

				<!-- Notifications Dropdown Menu -->
				<li class="nav-item dropdown">
					<a class="nav-link" data-toggle="dropdown" href="#">
						<i class="far fa-bell"></i>
						<span class="badge badge-warning navbar-badge">15</span>
					</a>
					<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
						<span class="dropdown-item dropdown-header">15 Notifications</span>
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item">
							<i class="fas fa-cart-plus mr-2"></i> 4 Purchase Orders
							<span class="float-right text-muted text-sm">3 mins</span>
						</a>
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item">
							<i class="fas fa-scroll mr-2"></i> 8 Dispatch Schedule
							<span class="float-right text-muted text-sm">12 hours</span>
						</a>
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item">
							<i class="fas fa-undo-alt mr-2"></i> 3 Order Return
							<span class="float-right text-muted text-sm">2 days</span>
						</a>
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-widget="fullscreen" href="#" role="button">
						<i class="fas fa-expand-arrows-alt"></i>
					</a>
				</li>
				<!-- Notifications Dropdown Menu -->
				<li class="nav-item dropdown">
					<a class="nav-link" data-toggle="dropdown" href="#">
						<i class="far fa-user"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
						<span class="dropdown-item dropdown-header">{{Str::upper(Session::get('createdby_name'))}}</span>
					
          <!--  <div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item">
							<i class="fas fa-users mr-2"></i> View Profile
						</a> -->
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item" data-toggle="modal" data-target="#myModal" onclick='changePasswordForm();'>
						<i class="fas fa-unlock-alt mr-2"></i> Change Password</button>
						</a>
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item">
							<i class="fas fa-calendar-day mr-2"></i> <?php echo date("d-m-Y") ?>
						</a>
						<div class="dropdown-divider"></div>
						<a href="{{url('logout')}}" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Log Out</a>
					</div>
				</li>
			</ul>
		</nav>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4" >
			<!-- Brand Logo --><br>
			<a href="#"  class="nav-link" onclick="location.reload();"  ><p>
     <center> <img src='{{url("resources\img\ipRings_logo.png")}}' width="180px" height='120px'></center>
</p>
			</a>

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar user panel (optional) -->
				<div class="user-panel mt-3 pb-3 mb-3 d-flex">
					<div class="image">

					</div>
					<div class="info">
						<a href="#" class="nav-link" >Hi {{Str::upper(Session::get('createdby_name'))}}</a>
					</div>
				</div>



				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
						<!-- Add icons to the links using the .nav-icon class
						with font-awesome or any other icon font library -->
						<li class="nav-item">
							<a href='#' onclick="location.reload();" class="nav-link" id="dashboard">
								<i class="fas fa-bezier-curve"></i>
								<p>
									&nbsp; Dashboard
								</p>
							</a>
						</li>

            <li class="nav-item">
							<a href='#' onclick="pageLoad('workOrder');" class="nav-link" id="dashboard">
              <i class="fas fa-file-signature"></i>
								<p>
									&nbsp; Work Order
								</p>
							</a>
						</li>
            <li class="nav-item">
							<a href='#' onclick="pageLoad('binStock');" class="nav-link" id="dashboard">
              <i class="fab fa-buffer"></i>
								<p>
									&nbsp; Bin Stk
								</p>
							</a>
						</li>
            <li class="nav-item">
							<a href='#' onclick="pageLoad('invoice');" class="nav-link" id="dashboard">
              <i class="fas fa-file-signature"></i>
								<p>
									&nbsp; Invoice
								</p>
							</a>
						</li>
            <li class="nav-item">
							<a href='#' onclick="pageLoad('deliveryOut');" class="nav-link" id="dashboard">
              <i class="fas fa-file-signature"></i>
								<p>
									&nbsp; Delivery out
								</p>
							</a>
						</li>
            <li class="nav-item">
							<a href='#' onclick="pageLoad('scan');" class="nav-link" id="dashboard">
              <i class="fas fa-file-signature"></i>
								<p>
									&nbsp; Trace
								</p>
							</a>
						</li>
            <li class="nav-item">
							<a href='#' onclick="pageLoad('reports');" class="nav-link" id="dashboard">
              <i class="fas fa-file-signature"></i>
								<p>
									&nbsp; Reports
								</p>
							</a>
						</li>
          
						<li class="nav-item" id="item_li">
							<a href="#" class="nav-link" id="item_li_a">
								<i class="fas fa-box-open"></i>
								<p>
									&nbsp; MASTERS
									<i class="right fas fa-angle-left"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="#" onclick="pageLoad('product');" class="nav-link" >
										<i class="fab fa-buffer"></i>
										<p>&nbsp; Products </p>
									</a>
								</li>
								<li class="nav-item">
									<a href="#"  onclick="pageLoad('users');" class="nav-link">
										<i class="fas fa-briefcase"></i>
										<p>&nbsp; Users</p>
									</a>
								</li>
							
								<li class="nav-item">
									<a href="#" onclick="pageLoad('locations');" class="nav-link">
										<i class="fab fa-keycdn"></i>
										<p>&nbsp; Storage Locations</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="#" onclick="pageLoad('racks');" class="nav-link" >
										<i class="fab fa-leanpub"></i>
										<p>&nbsp; Racks</p>
									</a>
								</li>
							</ul>
						</li>

<!--

						<li class="nav-item" >
							<a href="#" class="nav-link" id="sales_li_a">
								<i class="fas fa-funnel-dollar"></i>
								<p>
									&nbsp; Material Movement
									<i class="right fas fa-angle-left"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								
								<li class="nav-item">
									<a href="#" onclick="pageLoad('internalTransfer');" class="nav-link" >
                  <i class="fas fa-trailer"></i>
										<p>Internal Transfer</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="#" onclick="pageLoad('materiaIssue');" class="nav-link" >
                  <i class="fas fa-trailer"></i>
										<p>Material Issue</p>
									</a>
								</li>
                <li class="nav-item">
									<a href="#" onclick="pageLoad('materialReceive');" class="nav-link" >
                  <i class="fas fa-trailer"></i>	
										<p>Material Receive</p>
									</a>
								</li>
							</ul>
						</li>-->

					</ul>
				</nav>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>








    <div class="main"  >
    <div class="modal " id="myModal" role="dialog"></div>
          <!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
        <!-- Content Header (Page header) --><br><br>
            <div class="content-header">
                    <div id='bodyDiv'>
                    {{  view('dashboard/dashboard_filter'); }}

                    </div>
              </div>
          </div>
  </div>





    <footer class="main-footer">
    <strong>Copyright &copy; 2023  IP Rings .</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">

    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->













<audio src="{{url('resources\mp3\Invalid_scan_female.mp3')}}" id='invalid_audio_play' controls style="display:none;">
</body>
</html>

<script>
  var url='http://localhost/IPRings';

  $("#dashboard1").removeAttr("class","nav-link");
	$("#dashboard1").attr("class","nav-link active");
  function dangerAlert()
  {
    dangerScreen();
    setTimeout(function() { normalScreen();
      setTimeout(function() { dangerScreen();
        setTimeout(function() { normalScreen();
          setTimeout(function() { dangerScreen();
            setTimeout(function() { normalScreen();
              setTimeout(function() { dangerScreen();
                setTimeout(function() { normalScreen();}, 500);
              }, 1000);
            }, 500);
          }, 1000);
        }, 500);
      }, 1000);
    }, 500);
    $('#barcodeScanIn').focus();
  }
  function successAlert()
  {
    successScreen();
    setTimeout(function() { pinkScreen();
      setTimeout(function() { successScreen();
        setTimeout(function() { normalScreen();
          setTimeout(function() { successScreen();
            setTimeout(function() { pinkScreen();
              setTimeout(function() { successScreen();
                setTimeout(function() { normalScreen();}, 500);
              }, 1000);
            }, 500);
          }, 500);
        }, 1000);
      }, 500);
    }, 1000);
   
  }
  function invalidScan()
  {

    document.getElementById('invalid_audio_play').play();
    dangerScreen();
     setTimeout(function() { normalScreen();
      setTimeout(function() { dangerScreen();
        setTimeout(function() { normalScreen();
          setTimeout(function() { dangerScreen();
            setTimeout(function() { normalScreen();
              setTimeout(function() { dangerScreen();
                setTimeout(function() { normalScreen();
                  $('#alertMessageDiv').html('');}, 500);
              }, 1000);
            }, 500);
          }, 1000);
        }, 500);
      }, 1000);
    }, 500);
   
    $('#barcodeScanIn').focus();
    


  }
  function normalScreen()
  {
    $(".sidenav"). css("background-color","#0095d9");
    $(".topnav"). css("background-color","#0095d9");
    $(".btn-primary"). css("background-color","#0095d9");
    $("#bodyDiv"). css("background-color","white");
    $(".main-sidebar"). css("background-color","#0095d9");
    $(".main-header"). css("background-color","#0095d9");
    $('#barcodeScanIn').focus();

  }
  function dangerScreen()
  {
    $(".sidenav"). css("background-color","red");
    $(".topnav"). css("background-color","red");
    $(".btn-primary"). css("background-color","red");
    $("#bodyDiv"). css("background-color","red");
    $(".main-sidebar"). css("background-color","red");
    $(".main-header"). css("background-color","red");
    $('#barcodeScanIn').focus();
  }
  function successScreen()
  {
    $(".sidenav"). css("background-color","green");
    $(".topnav"). css("background-color","green");
    $(".btn-primary"). css("background-color","green");
    $("#bodyDiv"). css("background-color","green");
    $(".main-sidebar"). css("background-color","green");
    $(".main-header"). css("background-color","green");
    $('#barcodeScanIn').focus();
  }
  function pinkScreen()
  {
    $(".sidenav"). css("background-color","pink");
    $(".topnav"). css("background-color","pink");
    $(".btn-primary"). css("background-color","pink");
    $("#bodyDiv"). css("background-color","pink");
    $(".main-sidebar"). css("background-color","pink");
    $(".main-header"). css("background-color","pink");
    $('#barcodeScanIn').focus();
  }

          function getInvoiceItems(SaleOrder)
        {
          data = 'SALE_ORDER='+SaleOrder;


                var completeurl = url +'/invoiceItems';
                var type = "POST";
                var place = 'itemsDiv'+SaleOrder;
                ajaxload(type, completeurl, data, place);
                $("#itemsDiv"+SaleOrder).toggle();


        }

        function insert_user()
        {
          name=$('#name').val();
          email=$('#email').val();
          user_type=$('#user_type').val();
          Employee_ID=$('#Employee_ID').val();
          password=$('#password').val();
          confirm_password=$('#confirm_password').val();
          if(password=='')
          {
            $('#insertButtonDiv').html('<font color="red">Password cannot be empty ');
          }else
          if(password.length<6)
          {
            $('#insertButtonDiv').html('<font color="red">Password should be minimum 6 characters ');
          }else
          if(password==confirm_password)
          {
            data = 'name='+name+'&email='+email+'&user_type='+user_type
          +'&password='+password+'&confirm_password='+confirm_password+'&Employee_ID='+Employee_ID;

          var completeurl = url +'/insert_user';
              var type = "POST";
              var place = 'insertButtonDiv';
              ajaxload(type, completeurl, data, place);
          }else
          {
            $('#insertButtonDiv').html('<font color="red">Password and Confirm Password not matching ');
          }

        }
        function update_user()
        {
          id=$('#id').val();
          name=$('#name').val();
          email=$('#email').val();
          user_type=$('#user_type').val();
          Employee_ID=$('#Employee_ID').val();
          password=$('#password').val();
          confirm_password=$('#confirm_password').val();
          if(password=='')
          {
            $('#insertButtonDiv').html('<font color="red">Password cannot be empty ');
          }else
          if(password.length<6)
          {
            $('#insertButtonDiv').html('<font color="red">Password should be minimum 6 characters ');
          }else
          if(password==confirm_password)
          {
            data = 'name='+name+'&email='+email+'&user_type='+user_type
          +'&password='+password+'&confirm_password='+confirm_password+'&id='+id+'&Employee_ID='+Employee_ID;

          var completeurl = url +'/update_user';
              var type = "POST";
              var place = 'insertButtonDiv';
              ajaxload(type, completeurl, data, place);
          }else
          {
            $('#insertButtonDiv').html('<font color="red">Password and Confirm Password not matching ');
          }

        }

        function pageLoad(page)
            {


                data = '';


                var completeurl = url +'/'+ page;
                var type = "POST";
                var place = 'bodyDiv';
                ajaxload(type, completeurl, data, place);
            }
            function cancellPrimaryPacked(WORK_ORDER_ID,CUSTOMER_PART_NO,SL_NO,PRIMARY_BARCODE)
            {


                data = 'WORK_ORDER_ID='+WORK_ORDER_ID+'&CUSTOMER_PART_NO='+CUSTOMER_PART_NO+
                '&SL_NO='+SL_NO+'&PRIMARY_BARCODE='+PRIMARY_BARCODE;


                var completeurl = url +'/cancellPrimaryPacked';
                var type = "POST";
                var place = 'myModal';
                ajaxload(type, completeurl, data, place);
            }
            function cancellSecondaryPacked(WORK_ORDER_ID,CUSTOMER_PART_NO,SL_NO,PRIMARY_BARCODE)
            {


                data = 'WORK_ORDER_ID='+WORK_ORDER_ID+'&CUSTOMER_PART_NO='+CUSTOMER_PART_NO+
                '&SL_NO='+SL_NO+'&PRIMARY_BARCODE='+PRIMARY_BARCODE;


                var completeurl = url +'/cancellSecondaryPacked';
                var type = "POST";
                var place = 'myModal';
                ajaxload(type, completeurl, data, place);
            }
            function ajaxload(type, completeurl, data, place) {

//  var user = {{ Session::get('Employee_ID') }};
 
    $("#" + place).html('<br><br><center><div class="loadingDiv" ><img width="80px" height="80px" src="' + url + '/resources/img/loading.gif"/><br> Please Wait...</div></center>');
  $.ajax({
  type: type,
  url: completeurl,
  data: data,
  cache: false,
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },

  success: function(result) {

      $("#" + place).html(result);

  }
});
}


        
        function myFunction() {
          document.getElementById("myDropdown").classList.toggle("show");
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
          if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
              var openDropdown = dropdowns[i];
              if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
              }
            }
          }
        }

       function myDivToggle(myDiv) {
            var x = document.getElementById(myDiv);
            if (x.style.display === "none") {
              x.style.display = "block";
            } else {
              x.style.display = "none";
            }
          }
//$(function () {
    //Initialize Select2 Elements
    //$('.select2').select2();

    //Initialize Select2 Elements
   // $('.select2bs4').select2({      theme: 'bootstrap4'    });

  //Initialize Datatable


function insertLocation()
{
		location_name=$('#location_name').val();
		location_code=$('#location_code').val();
    	status=$('#status').val();

          if(location_name!='' && location_code!='' )
          {
            data = 'location_name='+location_name+'&location_code='+location_code+'&active='+status
          ;

          var completeurl = url +'/insertLocation';
              var type = "POST";
              var place = 'insertButtonDiv';

              ajaxload(type, completeurl, data, place);
          }else
          {
            alert('Please Check Input ');
          }
}
function editLocation(location_id)
{


            data = 'location_id='+location_id          ;

          var completeurl = url +'/editLocation';
              var type = "POST";
              var place = 'myModal';

              ajaxload(type, completeurl, data, place);

}
function enableLocation(location_id)
{


            data = 'location_id='+location_id          ;

          var completeurl = url +'/enableLocation';
              var type = "POST";
              var place = 'myModal';

              ajaxload(type, completeurl, data, place);

}
function disableLocation(location_id)
{


            data = 'location_id='+location_id          ;

          var completeurl = url +'/disableLocation';
              var type = "POST";
              var place = 'myModal';

              ajaxload(type, completeurl, data, place);

}
function updateLocation()
{
  location_id=$('#location_id').val();
  location_name=$('#location_name').val();
		location_code=$('#location_code').val();
    	status=$('#status').val();


          if(location_name!='' && location_code!='' )
          {
            data = 'location_id='+location_id +'&location_name='+location_name+'&location_code='+location_code+'&active='+status         ;

          var completeurl = url +'/updateLocation';
              var type = "POST";
              var place = 'insertButtonDiv';

              ajaxload(type, completeurl, data, place);
          }else
          {
            alert('Please Check Input ');
          }
}
function addLocationsForm()
{
	data = '';

var completeurl = url +'/addLocationsForm' ;
var type = "POST";
var place = 'myModal';

ajaxload(type, completeurl, data, place);
}
function changeTypeOrderMap(MappType)
{
  work_order_id=$('#work_order_id').val();
  data='work_order_id='+work_order_id+'&MappType='+MappType;
  if(MappType=='PART')
  {
    var completeurl = url +'/prepareWorkOrderByPartScan' ;

  }else if(MappType=='PRIMARY')
  {
    var completeurl = url +'/prepareWorkOrderByPrimaryScan' ;

  }else 
  {
    var completeurl = url +'/prepareWorkOrderBySecondaryScan' ;
  }

       var type = "POST";
       var place = 'workOrderTypeLoadDiv';

       ajaxload(type, completeurl, data, place);

}
function PrintAndClose(thisURL)
{
  var xxx = window.open(thisURL,'','width=300');
xxx.onload = function () {
     setTimeout(function(){xxx.print(
      {bUI: false,bSilent:true,bShrinkToFit: true}
     );}, 2500);
     xxx.onfocus = function () {
        xxx.close();
     }  
}

}
function updateHeatCode(WORK_ORDER_ID)
  {
    data = 'WORK_ORDER_ID='+WORK_ORDER_ID;
    var completeurl = url +'/openUpdateHeatCode' ;
       var type = "POST";
       var place = 'myModal';
       ajaxload(type, completeurl, data, place);
  }
  function updateScannedCode(barCodeValue)
  {
    if(barCodeValue=='ERROR' || barCodeValue=='error')
    {
      
      $('#barcodeScanIn').val('');
      $('#visionPercent').val('');
      $('#barcodeScanIn').focus();
      invalidScan();
      
	  $('#barcodeInformDiv').html('ERROR SCANNED');
    updateScannedCode('check');

    }else
    {
      WORK_ORDER_ID=$('#WORK_ORDER_ID').val();
    ORDER=$('#ORDER').val();
    CUSTOMER_NAME=$('#CUSTOMER_NAME').val();
    CUSTOMER_PART_NO=$('#CUSTOMER_PART_NO').val();
    YIELD_QTY=$('#YIELD_QTY').val();
    PACKING_FACTOR=$('#PACKING_FACTOR').val();
    MASTER_PACKING_FACTOR=$('#MASTER_PACKING_FACTOR').val();
    IPR_REF=$('#IPR_REF').val();
    MATERIAL_CODE=$('#MATERIAL_CODE').val();
    HEAT_CODE=$('#HEAT_CODE').val();
    VISION_PERCENT=$('#visionPercent').val();

    data = 'WORK_ORDER_ID='+WORK_ORDER_ID + '&ORDER='+ORDER +
      '&CUSTOMER_NAME='+CUSTOMER_NAME + '&CUSTOMER_PART_NO='+CUSTOMER_PART_NO +
      '&YIELD_QTY='+YIELD_QTY + '&PACKING_FACTOR='+PACKING_FACTOR +
      '&MASTER_PACKING_FACTOR='+MASTER_PACKING_FACTOR +'&IPR_REF='+IPR_REF+
      '&barCodeValue='+barCodeValue+'&MATERIAL_CODE='+MATERIAL_CODE+'&HEAT_CODE='+HEAT_CODE+
      '&VISION_PERCENT='+VISION_PERCENT;
       var completeurl = url +'/updateScannedCode' ;
       var type = "POST";
       var place = 'barcodeInformDiv';
       ajaxload(type, completeurl, data, place);
    }
    
  }
  function upadteStoreBin(barcode_secondary_id)
            {
                location_id=$('#location_id').val();
                rack_master_id=$('#rack_master_id').val();
                data = 'barcode_secondary_id='+barcode_secondary_id+'&rack_master_id='+rack_master_id
                +'&location_id='+location_id;


                var completeurl = url +'/updateSecondaryToBinstock';
                var type = "POST";
                var place = 'SecondaryBinUpdateDiv';
                ajaxload(type, completeurl, data, place);

                
            }
function getBinsByLocation(storage_location_id)
            {
                data = 'storage_location_id='+storage_location_id;


                var completeurl = url +'/getBinsByLocation';
                var type = "POST";
                var place = 'binSelectDiv';
                ajaxload(type, completeurl, data, place);



            }
function viewBinStock()
{
   RACK_MASTER_ID=$('#rack_master_id').val();
   STORAGE_LOCATION_ID=$('#location_id').val();
   data = 'RACK_MASTER_ID='+RACK_MASTER_ID+
   '&STORAGE_LOCATION_ID='+STORAGE_LOCATION_ID ;
       var completeurl = url +'/viewBinStock' ;
       var type = "POST";
       var place = 'StockDiv';
       ajaxload(type, completeurl, data, place);
}
function updateScannedPrimaryCode(barCodeValue)
  {
    WORK_ORDER_ID=$('#WORK_ORDER_ID').val();
    ORDER=$('#ORDER').val();
    CUSTOMER_NAME=$('#CUSTOMER_NAME').val();
    CUSTOMER_PART_NO=$('#CUSTOMER_PART_NO').val();
    YIELD_QTY=$('#YIELD_QTY').val();
    PACKING_FACTOR=$('#PACKING_FACTOR').val();
    MASTER_PACKING_FACTOR=$('#MASTER_PACKING_FACTOR').val();
    IPR_REF=$('#IPR_REF').val();
    MATERIAL_CODE=$('#MATERIAL_CODE').val();
    MATERIAL_DESCRIPTION=$('#MATERIAL_DESCRIPTION').val();
    if( barCodeValue=='' || barCodeValue==0)
    {
      $('#barcodeScanIn').val('');
      $('#barcodeScanIn').focus();
      $('#barcodeInformDiv').html('<font color="red">Error reading Value..<br>Please check Barcode</font>');
      
    }else
    {
      data = 'WORK_ORDER_ID='+WORK_ORDER_ID + '&ORDER='+ORDER +
      '&CUSTOMER_NAME='+CUSTOMER_NAME + '&CUSTOMER_PART_NO='+CUSTOMER_PART_NO +
      '&YIELD_QTY='+YIELD_QTY + '&PACKING_FACTOR='+PACKING_FACTOR +
      '&MASTER_PACKING_FACTOR='+MASTER_PACKING_FACTOR +'&IPR_REF='+IPR_REF+
      '&barCodeValue='+barCodeValue+'&MATERIAL_CODE='+MATERIAL_CODE+
      '&MATERIAL_DESCRIPTION='+MATERIAL_DESCRIPTION;
       var completeurl = url +'/updateScannedPrimaryCode' ;
       var type = "POST";
       var place = 'barcodeInformDiv';

       ajaxload(type, completeurl, data, place);

    }


  }
function updateScannedSecondaryCode(barCodeValue)
  {
    WORK_ORDER_ID=$('#WORK_ORDER_ID').val();
    ORDER=$('#ORDER').val();
    CUSTOMER_NAME=$('#CUSTOMER_NAME').val();
    CUSTOMER_PART_NO=$('#CUSTOMER_PART_NO').val();
    YIELD_QTY=$('#YIELD_QTY').val();
    PACKING_FACTOR=$('#PACKING_FACTOR').val();
    MASTER_PACKING_FACTOR=$('#MASTER_PACKING_FACTOR').val();
    IPR_REF=$('#IPR_REF').val();
    MATERIAL_CODE=$('#MATERIAL_CODE').val();
    HEAT_CODE=$('#HEAT_CODE').val();
    RACK_MASTER_ID=$('#rack_master_id').val();
    STORAGE_LOCATION_ID=$('#location_id').val();
    MATERIAL_DESCRIPTION=$('#MATERIAL_DESCRIPTION').val();



    if(RACK_MASTER_ID=='' || RACK_MASTER_ID==0)
    {
      alert('Please Select Location,  Bin Rack Details');
    }else if( barCodeValue=='' || barCodeValue==0)
    {
      $('#barcodeScanIn').val('');
      $('#barcodeScanIn').focus();
      $('#barcodeInformDiv').html('<font color="red">Error reading VAlue..<br>Please check Barcode</font>');
      
    }else
    {
      data = 'WORK_ORDER_ID='+WORK_ORDER_ID + '&ORDER='+ORDER +
      '&CUSTOMER_NAME='+CUSTOMER_NAME + '&CUSTOMER_PART_NO='+CUSTOMER_PART_NO +
      '&YIELD_QTY='+YIELD_QTY + '&PACKING_FACTOR='+PACKING_FACTOR +
      '&MASTER_PACKING_FACTOR='+MASTER_PACKING_FACTOR +'&IPR_REF='+IPR_REF+
      '&barCodeValue='+barCodeValue+'&MATERIAL_CODE='+MATERIAL_CODE+
      '&HEAT_CODE='+HEAT_CODE+'&RACK_MASTER_ID='+RACK_MASTER_ID+
    '&STORAGE_LOCATION_ID='+STORAGE_LOCATION_ID+'&MATERIAL_DESCRIPTION='+MATERIAL_DESCRIPTION;
       var completeurl = url +'/updateScannedSecondaryCode' ;
       var type = "POST";
       var place = 'barcodeInformDiv';

       ajaxload(type, completeurl, data, place);

    }


  }
  function editWorkOrder(work_order_id)
    {
        
      data = 'work_order_id='+work_order_id ;

       var completeurl = url +'/amend_packing' ;
       var type = "POST";
       var place = 'myModal';
       
       ajaxload(type, completeurl, data, place);
    }
    function prepareWorkOrderType(work_order_id)
    {
      fromDate=$('fromDate').val();
    toDate=$('toDate').val();

      data = 'work_order_id='+work_order_id+'&fromDate='+fromDate+'&toDate='+toDate ;
       var completeurl = url +'/prepareWorkOrderType' ;
       var type = "POST";
       var place = 'bodyDiv';
       
       ajaxload(type, completeurl, data, place);
    }
    function getPeriodWorkOrderList()
{
   fromDate=$('#fromDate').val();
   toDate=$('#toDate').val();
   data = 'fromDate='+fromDate+'&toDate='+toDate ;
       var completeurl = url +'/getPeriodWorkOrderList' ;
       var type = "POST";
       var place = 'workOrderListTable';
       ajaxload(type, completeurl, data, place);
}
function mapStockToInvoice(INVOICE_ID)
{
  // INVOICE_ID=$('#INVOICE_ID').val();
   data = 'INVOICE_ID='+INVOICE_ID ;
       var completeurl = url +'/mapStockToInvoice' ;
       var type = "POST";
       var place = 'myModal';
       ajaxload(type, completeurl, data, place);
}
function getPeriodInvoiceList()
{
   fromDate=$('#fromDate').val();
   toDate=$('#toDate').val();
   data = 'fromDate='+fromDate+'&toDate='+toDate ;
       var completeurl = url +'/getPeriodInvoiceList' ;
       var type = "POST";
       var place = 'invoiceListTable';
       ajaxload(type, completeurl, data, place);
}

function printMasterLabel(INVOICE_ID)
{
  // INVOICE_ID=$('#INVOICE_ID').val();
   data = 'INVOICE_ID='+INVOICE_ID ;
       var completeurl = url +'/printMasterLabel' ;
       var type = "POST";
       var place = 'myModal';
       ajaxload(type, completeurl, data, place);
}
function autoAddInvoiceTriggered()
{
   data = '' ;
       var completeurl = url +'/autoAddInvoiceTriggered' ;
       var type = "POST";
       var place = 'myModal';
       ajaxload(type, completeurl, data, place);

}
function autoAddWorkOrderTriggered()
{
   data = '' ;
       var completeurl = url +'/autoAddWorkOrderTriggered' ;
       var type = "POST";
       var place = 'myModal';
       ajaxload(type, completeurl, data, place);

}
function changePasswordForm()
{
  data = '' ;
       var completeurl = url +'/changePasswordForm' ;
       var type = "POST";
       var place = 'myModal';
       ajaxload(type, completeurl, data, place);

}
function mapStockToInvoiceDirect(INVOICE_ID)
{
  // INVOICE_ID=$('#INVOICE_ID').val();
   data = 'INVOICE_ID='+INVOICE_ID ;
       var completeurl = url +'/mapStockToInvoiceDirect' ;
       var type = "POST";
       var place = 'myModal';
       ajaxload(type, completeurl, data, place);
}
</script>