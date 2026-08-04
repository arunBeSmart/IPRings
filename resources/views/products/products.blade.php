
<div class="card card-primary">
								<div class="card-header">
									<h3 class="card-title">PRODUCTS Data</h3>
								</div>
								<div class="card-body">
									
@if(Session::get('user_type')=='admin')
<p align='right'><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" onclick="addProduct();">
+ ADD PRODUCTS</button></p>
@endif
<table id="products_table"   class="table table-bordered table-striped table-colored-header table-responsive table-hover"  >
    <thead><tr><th>ID</th>
    <th>Customer name</th>				

    <th>Customer part no</th>
    <th>Material code</th>
    <th>ipr Ref no	</th>
    <th>Packing Factor</th>
    <th>Min Weight</th>
    <th>Max Weight</th>
    <th>Secondary Packing Factor</th><th>REV. LEVEL</th>
    <th>Scan Type</th>
    <th>Options</th>
    </tr></thead>
    <tbody>
        @foreach($DATA as $products)
        @if($products->ACTIVE==0)    
      <tr style="background-color:gray;" > 
      @else
      <tr>
      @endif 
        <td>{{$products->id}}</td>
        <td>{{$products->Customer_name}}</td>
        <td>{{$products->Customer_part_no}}</td>
        <td>{{$products->material_code}}</td>
        <td>{{$products->ipr_Ref_no}}</td>
        <td>{{round($products->packing_factor)}}</td>
        <td>{{round($products->Min_Weight,3)}}</td>
        <td>{{round($products->Max_Weight,3)}}</td>
        <td>{{round($products->master_packing_factor)}}</td>
        <td>{{$products->REV_LEVEL}}</td>
        <td>
        <?php if($products->SCAN_TYPE=='DIRECT')
        { echo " DIRECT to Invoice ";} else 
        { echo $products->SCAN_TYPE; } ?> 
       </td>

        <td>
         @if(Session::get('user_type')=='admin')
           <TABLE><TR><TD> <button class="btn btn-success" data-toggle="modal" data-target="#myModal" onclick="editProduct('{{$products->id}}');"  >Edit</button>
</TD> <td> @if($products->ACTIVE==1)           
            <button class='btn btn-danger' data-toggle="modal" data-target="#myModal" onclick="disableProduct('{{$products->id}}');"  >Disable</button>
           @endif
           @if($products->ACTIVE==0)      
           <button class='btn btn-danger' data-toggle="modal" data-target="#myModal" onclick="enableProduct('{{$products->id}}');"  >Enable</button>
           @endif </TD></TR></TABLE>
         @endif
      </td>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
								</div>
								<!-- /.card-body -->
							</div>


<script>

$(document).ready(function() {
        document.title = 'IP RINGS - Products';
    });
  $(document).ready(function(){
  var empDataTable = $('#products_table').DataTable({
     dom: 'Blfrtip',
     buttons: [
       {  
          extend: 'copy'
       },
       {
          extend: 'pdf',
          exportOptions: {
            columns: [0,1,2,3,4,5,6,7,8] // Column index which needs to export
          }
       },
       {
          extend: 'csv',
       },
       {
          extend: 'excel',
       } 
       ,
       {
          extend: 'print',
       } 
       ,
       {
          extend: 'colvis',
       } 
     ] 

  });

});

function  editProduct(product_id)
    {
    
      data = 'product_id='+product_id;
       

       var completeurl = url +'/editProduct' ;
       var type = "POST";
       var place = 'myModal';
       
       ajaxload(type, completeurl, data, place);
      

    }
    function  addProduct()
    {
    
      data = '';      

       var completeurl = url +'/addProduct' ;
       var type = "POST";
       var place = 'myModal';
      
       ajaxload(type, completeurl, data, place);
      

    }
    function  disableProduct(product_id)
    {
      data = 'product_id='+product_id;
       

       var completeurl = url +'/disableProduct' ;
       var type = "POST";
       var place = 'myModal';
       
       ajaxload(type, completeurl, data, place);
      

    }
    function  enableProduct(product_id)
    {
      data = 'product_id='+product_id;
       

       var completeurl = url +'/enableProduct' ;
       var type = "POST";
       var place = 'myModal';
              ajaxload(type, completeurl, data, place);
      

    }

    function insert_product()
        {
         CUSTOMER_NAME=$('#CUSTOMER_NAME').val();
         CUSTOMER_PART_NUMBER=$('#CUSTOMER_PART_NUMBER').val();
         QTY=$('#QTY').val();
         MATERIAL_CODE=$('#MATERIAL_CODE').val();
         MIN_WEIGHT=$('#MIN_WEIGHT').val();
         MAX_WEIGHT=$('#MAX_WEIGHT').val();
         REMARKS=$('#REMARKS').val();
         PRODUCT_NAME=$('#PRODUCT_NAME').val();
         IPR_REF_NO=$('#IPR_REF_NO').val();
         MASTER_PACKING_FACTOR=$('#MASTER_PACKING_FACTOR').val();
         REV_LEVEL=$('#REV_LEVEL').val();
         SCAN_TYPE=$('#SCAN_TYPE').val();
          
            data = 'CUSTOMER_NAME='+CUSTOMER_NAME+'&CUSTOMER_PART_NUMBER='+CUSTOMER_PART_NUMBER+'&QTY='+QTY
          +'&MIN_WEIGHT='+MIN_WEIGHT+'&MAX_WEIGHT='+MAX_WEIGHT+'&REMARKS='+REMARKS+'&PRODUCT_NAME='
          +PRODUCT_NAME+'&IPR_REF_NO='+IPR_REF_NO+'&MASTER_PACKING_FACTOR='+MASTER_PACKING_FACTOR
          +'&MATERIAL_CODE='+MATERIAL_CODE+'&REV_LEVEL='+REV_LEVEL+'&SCAN_TYPE='+SCAN_TYPE;
        // alert(data);
          var completeurl = url +'/insert_product';
              var type = "POST";
              var place = 'insertButtonDiv';
              
              ajaxload(type, completeurl, data, place);
          
        
        }
        function update_product()
        {
         CUSTOMER_NAME=$('#CUSTOMER_NAME').val();
         CUSTOMER_PART_NUMBER=$('#CUSTOMER_PART_NUMBER').val();
         QTY=$('#QTY').val();
         MATERIAL_CODE=$('#MATERIAL_CODE').val();
         MIN_WEIGHT=$('#MIN_WEIGHT').val();
         MAX_WEIGHT=$('#MAX_WEIGHT').val();
         REMARKS=$('#REMARKS').val();
         PRODUCT_NAME=$('#PRODUCT_NAME').val();
         IPR_REF_NO=$('#IPR_REF_NO').val();
         MASTER_PACKING_FACTOR=$('#MASTER_PACKING_FACTOR').val();
         REV_LEVEL=$('#REV_LEVEL').val();SCAN_TYPE=$('#SCAN_TYPE').val();
         id=$('#id').val();
          
            data = 'CUSTOMER_NAME='+CUSTOMER_NAME+'&id='+id+'&CUSTOMER_PART_NUMBER='+CUSTOMER_PART_NUMBER+'&QTY='+QTY
          +'&MIN_WEIGHT='+MIN_WEIGHT+'&MAX_WEIGHT='+MAX_WEIGHT+'&REMARKS='+REMARKS+'&PRODUCT_NAME='+PRODUCT_NAME+
          '&IPR_REF_NO='+IPR_REF_NO+'&MASTER_PACKING_FACTOR='+MASTER_PACKING_FACTOR+'&MATERIAL_CODE='+MATERIAL_CODE+
          '&REV_LEVEL='+REV_LEVEL+'&SCAN_TYPE='+SCAN_TYPE;

          var completeurl = url +'/update_product';
              var type = "POST";
              var place = 'insertButtonDiv';
              ajaxload(type, completeurl, data, place);
          
        }
</script>