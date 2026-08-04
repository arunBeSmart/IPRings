<!doctype html>
<html lang="en">
  <head>
    <title>IP Rings - Dashboard</title>
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

  </head>
  <style>
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
  margin-left: 160px; /* Same as the width of the sidenav */
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
</style>
  <body id="fullBodyId">
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
 
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

    
<div class="topnav">
          <div class="row">
                        <div class="col-sm-3">  
                        </div>
                        <div class="col-sm-3"><div> WELCOME {{Str::upper(Session::get('createdby_name'))}}</div>
                        </div>
                        <div class="col-sm-3">  
                        </div>
                      
            
          </div>
</div>


                  <div class="sidenav">
                                <div class="btn-group-vertical justified">
                                  <a  class="btn btn-primary" onclick="pageLoad('dashboard');" >
                                  <img src='{{url("resources\img\ipRings_logo.png")}}' width="100%"></a>
                                
                                  <button class="btn btn-primary"   onclick="pageLoad('invoice');"> INVOICE</button>
                                  <button  class="btn btn-primary"   onclick="pageLoad('scan');">SCAN</button>
                                @if(Session::get('createdby_name')=='admin')

                                  <button  class="btn btn-primary"   onclick="pageLoad('reports');">REPORTS</button>
                                  <button class="btn btn-primary"    onclick="pageLoad('product');">PRODUCTS</button>
                                  
                                    <button  class="btn btn-primary"    onclick="pageLoad('ProductBatches');">BATCH STK</button>
                                  <button  class="btn btn-primary"   onclick="pageLoad('users');">USERS</button>
                                  <button  class="btn btn-primary"   onclick="pageLoad('store');">STORE</button>
                                  @endif
                                <a href="{{url('logout')}}" class="btn btn-primary">LOGOUT</a>
                                
                                </div>
                  </div>

    <div class="main"  >
    <div class="modal " id="myModal" role="dialog"></div>

        <div id='bodyDiv'> 
        {{  view('dashboard'); }}
     
        </div>
    </div>  

<audio src="{{url('resources\mp3\Invalid_scan.mp3')}}" id='invalid_audio_play' controls style="display:none;">
</body>
</html>

<script>
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
                setTimeout(function() { normalScreen();}, 500);
              }, 1000);
            }, 500);            
          }, 1000);
        }, 500);
      }, 1000);
    }, 500);
    
    
  }
  function normalScreen()
  {
    $(".sidenav"). css("background-color","#0095d9"); 
    $(".topnav"). css("background-color","#0095d9"); 
    $(".btn-primary"). css("background-color","#0095d9");
    $("#bodyDiv"). css("background-color","white");

    
  }
  function dangerScreen()
  {
    $(".sidenav"). css("background-color","red"); 
    $(".topnav"). css("background-color","red");
    $(".btn-primary"). css("background-color","red");
    $("#bodyDiv"). css("background-color","red");
  }
          var url='http://localhost/IPRings';
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
          password=$('#password').val();
          confirm_password=$('#confirm_password').val();
          if(password==confirm_password)
          {
            data = 'name='+name+'&email='+email+'&user_type='+user_type
          +'&password='+password+'&confirm_password='+confirm_password;

          var completeurl = url +'/insert_user';
              var type = "POST";
              var place = 'insertButtonDiv';
              ajaxload(type, completeurl, data, place);
          }else 
          {
            alert('Password and Confirm Password not matching ');
          }
        
        }
        function update_user()
        {
          id=$('#id').val();
          name=$('#name').val();
          email=$('#email').val();
          user_type=$('#user_type').val();
          password=$('#password').val();
          confirm_password=$('#confirm_password').val();
          if(password==confirm_password)
          {
            data = 'name='+name+'&email='+email+'&user_type='+user_type
          +'&password='+password+'&confirm_password='+confirm_password+'&id='+id;

          var completeurl = url +'/update_user';
              var type = "POST";
              var place = 'insertButtonDiv';
              ajaxload(type, completeurl, data, place);
          }else 
          {
            alert('Password and Confirm Password not matching ');
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
            function cancellPacked(INVOICE_ID,CUSTOMER_PART_NO,SL_NO,PRIMARY_BARCODE)
            {
              

                data = 'INVOICE_ID='+INVOICE_ID+'&CUSTOMER_PART_NO='+CUSTOMER_PART_NO+'&SL_NO='+SL_NO+'&PRIMARY_BARCODE='+PRIMARY_BARCODE;
              

                var completeurl = url +'/cancellPacked';
                var type = "POST";
                var place = 'myModal';
                ajaxload(type, completeurl, data, place);
            }
            
            
        function ajaxload(type, completeurl, data, place) {
          
            $("#" + place).html('<center><img width="5%" height="5%" src="' + url + '/resources/img/loading.gif"/> Loading...');
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
</script>