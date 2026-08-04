<center>

 <br>

<font color='red'>Please update Storage Location details to continue**</font>
    <table style="width:75%"  class="table table-bordered table-striped table-colored-header table-responsive table-hover" >
    <tr>
        <td>Please select Location </td>
        <td> <select onchange="getBinsByLocation(this.value);" id="location_id" name="location_id" class="form-control">
            <option disabled selected=1 value="0">Please Select Location</option>   
        @foreach($LOCATIONS as $location)
        <option value="{{$location->id}}">{{$location->location_code}} ({{$location->location_name}})</option>   
        @endforeach
    </select></td>
            <td rowspan='2'><button class='btn btn-primary' onclick='upadteStoreBin({{$SECONDARY ->id}} );'>UPDATE</button></td>
        </tr>
        <tr>
            <td>Please select Bin no </td>
            <td><div id='binSelectDiv'><select  id="rack_master_id" name="rack_master_id" class="form-control">
                <option value="0">Please Select Bin Number</option>
              
            </select></div>
            </td>
        </tr></table>
  
    </center>
        <script>
            $('#barcodeScanIn').prop('disabled',true);
            
        </script>