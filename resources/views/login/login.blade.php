
<!DOCTYPE html>
<html>
 <head>
  <title>IP RINGS - Dispatch system</title>
  <link rel="icon" href="{{url('resources/img/favicon.ico')}}" type="image/ico">
  <script src="{{url('resources/js/ajax.googleapis.com_ajax_libs_jquery_3.1.0_jquery.min.js')}}"></script>
  <link rel="stylesheet" href="{{url('resources/css/maxcdn.bootstrapcdn.com_bootstrap_3.3.6_css_bootstrap.min.css')}}" />
  <script src="{{url('resources/js/maxcdn.bootstrapcdn.com_bootstrap_3.3.7_js_bootstrap.min.js')}}"></script>
  <style type="text/css">
   .box{
    width:600px;
    margin:0 auto;
    border:1px solid #0e6fe6;
   }
  </style>
   <script src="{{url('resources/js/code.jquery.com_jquery-3.7.0.js')}}"></script>
 </head>
 <body style='background-color: #557cab;'>
  <br /> <br /> <br />
  <div class="container box " style="background-color:#03cffc;" >
   <center><br>
   <img src='{{url("resources\img\ipRings_logo.png")}}' class='img-responsive' height='20%' width="75%">
  </center>
   <h3 align="center"> Dispatch System</h3><br />

   <form method="post" action="{{route('LoginAuthendicate')}}" >
    @csrf
   

    <div class="form-group" >
     <label>EMAIL ID</label>
     <input type="email" name="email" id="email" placeholder="Enter Email Id" value="{{old('email')}}" class="form-control" />
     <span class='text-danger'>@error('email'){{$message}} @enderror</span>
    </div>
    <div class="form-group">
     <label>PASSWORD</label>
     <input type="password" name="password" id='password' placeholder="Enter Password" value="{{old('password')}}" class="form-control" />
     <span class='text-danger'>@error('password'){{$message}} @enderror</span>
    </div>
    <div class="form-group">
     <input type="submit" name="login"  class="btn btn-primary" value="Login" />
     <br><br>
    
    @if(Session::has('FAIL'))
    <div class="alert alert-danger" id='temp_div'>{{Session::get('FAIL') }}</div>
    <script>$(function() {
setTimeout(function() { $("#temp_div").fadeOut(2500); }, 3000)

})</script>
    @endif
    </div>
   </form>
  </div>
  
 </body>
</html>