<div class="card card-primary">
								<div class="card-header">
									<h3 class="card-title">REPORTS Data</h3>
								</div>
								<div class="card-body">
									
<table class='table'><tr>
<td > PART NUMBER </td><td sytle='width:150px;'>
     <select name="product_id"  id="product_id" class='select2'  >
        <option value="0" >&darr; &darr; Below All customer part numbers &darr; &darr;</option>
        @foreach($DATA as $product)
        <option value="{{$product->id}}">{{$product->ipr_Ref_no}} 
            ( {{$product->Customer_part_no}}----{{$product->material_code}}----{{$product->product_name}} )</option>
        @endforeach
    </select> 
</td>
    <td >TYPE </td><td sytle='width:150px;'>
     <select name="report_type"  id="report_type" class='form-control' sytle='width:150px;' onchange="getInputFilters(this.value);">
       
        <option value="YEARLY">Yearly</option>
        <option value="MONTHLY">Monthy</option>
        <option value="FROM_TO" selected='1'>From To select</option>
    </select> 
</td>
<td><div id='reportInputTitleDiv'></div></td>
<td>
 <div id='reportInputDiv'>
    <table class='table'>
        <tr>
            <td>From </td><td ><input type='date' id='FROMDATE' name='FROMDATE' class='form-control' value='{{date("Y-m-d")}}'>
        </td><td>To </td><td><input type='date' id='TODATE' name='TODATE' class='form-control' value='{{date("Y-m-d")}}'> </td>
    </tr></table>

</div>
</td>
<td>
    <button id='reportsGoButton'  class='btn btn-primary' onclick="getReport();">GO</button>
</td></tr></table>
<div id="report_div"></div>
								</div>
								<!-- /.card-body -->
							</div>
                            



<script>
    $('#product_id').select2();
    function  getInputFilters(report_type)
    {

       if(report_type=='YEARLY')
       {
        var thisYear=new Date().getFullYear();
        inputFilters="<table class='table'><tr><td>year </td><td>"+
        "<input type='number' id='TRNYEAR' name='TRNYEAR' class='form-control' max='"+thisYear+"' value="+thisYear+"></td></tr></table>";
        $('#reportInputDiv').html(inputFilters);
        $('#reportInputTitleDiv').html(' ');

       }
       if(report_type=='MONTHLY')
       {
        var thisYear=new Date().getFullYear();
        inputFilters=" <table class='table'><tr><td>year </td><td ><input type='number'  max='"+thisYear+"'  id='TRNYEAR' name='TRNYEAR' class='form-control' value="+thisYear+">"+
        "</td><td>Month </td><td><select class='form-control' name='TRNMONTH' id='TRNMONTH'>"+
        "<OPTION value=1>JANUARY</OPTION>   <OPTION value=2>FEBRUARY</OPTION>    <OPTION value=3>MARCH</OPTION>"+
        "<OPTION value=4>APRIL</OPTION>    <OPTION value=5>MAY</OPTION>    <OPTION value=6>JUNE</OPTION>"+
    "<OPTION value=7>JULY</OPTION>    <OPTION value=8>AUGUST</OPTION>    <OPTION value=9>SEPTEMBER</OPTION>"+
    "<OPTION value=10>OCTOBER</OPTION><OPTION value=11>NOVEMBER</OPTION><OPTION value=12>DECEMBER</OPTION>"+
    "</select></td></tr></table>";
        $('#reportInputDiv').html(inputFilters);
        $('#reportInputTitleDiv').html('');
       }
       if(report_type=='FROM_TO')
       {
        var d = new Date();
        thisMonth=(d.getMonth()+1);
        if(thisMonth<10){thisMonth='0'+thisMonth;}
        thisDay=d.getDate();
        if(thisDay<10){thisDay='0'+thisDay;}
        var from=d.getFullYear()+'-'+thisMonth+'-'+thisDay;
        inputFilters=" <table class='table'><tr><td>From </td><td ><input type='date' id='FROMDATE' name='FROMDATE' class='form-control' value='"+from+"'>"+
        "</td><td>To </td><td><input type='date' id='TODATE' name='TODATE' class='form-control' value='"+from+"'> </td></tr></table>";
        $('#reportInputDiv').html(inputFilters);
        $('#reportInputTitleDiv').html('');
       }
       $('#reportsGoButton').prop('disabled',false);

    }
    function getReport()
    {
        var report_type=$('#report_type').val();
        var product_id=$('#product_id').val();
        data ='product_id='+product_id+'&report_type='+report_type;
        if(report_type=='FROM_TO')
        {
        var fromDate=$('#FROMDATE').val();
        var toDate=$('#TODATE').val();
        data =data+'&fromDate='+fromDate+'&toDate='+toDate;

        }
        if(report_type=='MONTHLY')
        {
        var trnYear=$('#TRNYEAR').val();
        var trnMonth=$('#TRNMONTH').val();
        data =data+'&trnYear='+trnYear+'&trnMonth='+trnMonth;

        
        }
        if(report_type=='YEARLY')
        {
            var trnYear=$('#TRNYEAR').val();
            data =data+'&trnYear='+trnYear;
        }
        var completeurl = url +'/getReport' ;
       var type = "POST";
       var place = 'report_div';
       ajaxload(type, completeurl, data, place);
    }
</script>