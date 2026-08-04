<style>
#traceValue:focus, textarea:focus {
  box-shadow: 0 0 5px rgba(81, 203, 238, 1);
  padding: 3px 0px 3px 3px;
  margin: 5px 1px 3px 0px;
  border: 5px solid blue;
}</style>
<div class="card card-primary">
								<div class="card-header">
									<h3 class="card-title">TRACEABILITY</h3>
								</div>
								<div class="card-body">
                                <label>  Scan BarCode / Enter </label>
<input type="text" class='form-control' id='traceValue' name='traceValue' autofocus  onchange="getScannedValueDetails(this.value);">

<div id='informScanDiv'></div>
								</div>
								<!-- /.card-body -->
							</div>


<script>
    $('#traceValue').focus();
    function getScannedValueDetails(thisDATA)
    {
        data = 'scanValue='+thisDATA;
       

       var completeurl = url +'/getScannedValueDetails';
       var type = "get";
       var place = 'informScanDiv';
       ajaxload(type, completeurl, data, place);
    }
</script>