<div class="modal-dialog">

      <!-- Modal content-->
    <div class="modal-content"  style="width:150%;">
            <div class="modal-header">

              <h4 class="modal-title" >ADD PRODUCT FORM

                <button type="button" class="close" data-dismiss="modal"><img width="20%" height="25%" src="{{url('resources\img\close.jpg')}}"></button></h4>
            </div>
        <div class="modal-body">
            <form method="post" action='{{url("insert_product")}}'>
@csrf
            <div class="form-group" >
                    CUSTOMER NAME *
                    <input class="form-control" name='CUSTOMER_NAME' placeholder="Enter Customer Name"  id ="CUSTOMER_NAME" value="{{old('CUSTOMER_NAME')}}" required>
                    <span class='text-danger'>@error('CUSTOMER_NAME'){{$message}} @enderror</span>
                </div>
                <div class="form-group" >
                    CUSTOMER PART NUMBER *
                    <input class="form-control" name='CUSTOMER_PART_NUMBER' placeholder="Enter CUSTOMER PART NUMBER"  id ="CUSTOMER_PART_NUMBER" value="{{old('CUSTOMER_PART_NUMBER')}}" required>
                    <span class='text-danger'>@error('CUSTOMER_PART_NUMBER'){{$message}} @enderror</span>
                </div>
                <div class="form-group" >
                    MATERIAL CODE *
                    <input class="form-control" name='MATERIAL_CODE' placeholder="Enter material code"  id ="MATERIAL_CODE" value="{{old('MATERIAL_CODE')}}" required>
                    <span class='text-danger'>@error('MATERIAL_CODE'){{$message}} @enderror</span>
                </div>
                <div class="form-group" >
                    PRODUCT NAME
                    <input class="form-control" name='PRODUCT_NAME' placeholder="Enter Product Name"  id ="PRODUCT_NAME" value="{{old('PRODUCT_NAME')}}" >
                    <span class='text-danger'>@error('PRODUCT_NAME'){{$message}} @enderror</span>
                </div>
                <div class="form-group" >
                    IPR REF NUMBER *
                    <input class="form-control" name='IPR_REF_NO' placeholder="Enter IPR REF NUMBER"  id ="IPR_REF_NO" value="{{old('IPR_REF_NO')}}" required>
                    <span class='text-danger'>@error('IPR_REF_NO'){{$message}} @enderror</span>
                </div>
                
                <div class="form-group" >
                    MINIMUM WEIGHT *
                    <input class="form-control" name='MIN_WEIGHT' placeholder="Enter MINIMUM WEIGTH"  id ="MIN_WEIGHT" value="{{old('MIN_WEIGHT')}}" required>
                    <span class='text-danger'>@error('MIN_WEIGHT'){{$message}} @enderror</span>
                </div>
                <div class="form-group" >
                    MAXIMUM WEIGHT *
                    <input class="form-control" name='MAX_WEIGHT' placeholder="Enter  MAXIMUM WEIGHT"  id ="MAX_WEIGHT" value="{{old('MAX_WEIGHT')}}" required>
                    <span class='text-danger'>@error('MAX_WEIGHT'){{$message}} @enderror</span>
                </div>
                <div class="form-group" >
                     PRIMARY BOX PACKING FACTOR QTY *
                    <input TYPE='NUMBER' class="form-control" name='QTY' placeholder="Enter PRIMARY BOX PACKING FACTOR QTY"  id ="QTY" value="{{old('QTY')}}" required>
                    <span class='text-danger'>@error('QTY'){{$message}} @enderror</span>
                </div>
                <div class="form-group" >
                SECONDARY  BOX PACKING FACTOR QTY *
                    <input class="form-control" name='MASTER_PACKING_FACTOR' placeholder="Enter  SECONDARY  BOX PACKING FACTOR QTY "  id ="MASTER_PACKING_FACTOR" value="{{old('MASTER_PACKING_FACTOR')}}" required>
                    <span class='text-danger'>@error('MASTER_PACKING_FACTOR'){{$message}} @enderror</span>
                </div>
                <div class="form-group" >
                REMARKS
                    <input class="form-control" name='REMARKS' placeholder="Enter  Remarks"  id ="REMARKS" value="{{old('REMARKS')}}" >
                    <span class='text-danger'>@error('REMARKS'){{$message}} @enderror</span>
                </div>
                <div class="form-group" >
                REV.LEVEL
                    <input class="form-control" name='REV_LEVEL' placeholder="Enter  REV.LEVEL"  id ="REV_LEVEL" value="{{old('REV_LEVEL')}}" >
                    <span class='text-danger'>@error('REV_LEVEL'){{$message}} @enderror</span>
                </div>
                <div class="form-group" >
                SCAN TYPE
                    <SELECT class="form-control" name='SCAN_TYPE'   id ="SCAN_TYPE" >
                        <OPTION VALUE='PART'> PART SCAN</OPTION>
                        <OPTION VALUE='PRIMARY'>PRIMARY  SCAN</OPTION>
                        <OPTION VALUE='SECONDARY'>SECONDARY  SCAN</OPTION>
                        <OPTION VALUE='DIRECT'>SCAN DIRECT TO  INVOICE</OPTION>
                </SELECT>
                </div>
           




        </div>
        <div class="modal-footer"> <div id="insertButtonDiv">       </div>

          <table  width="100%" ><tr><td align="left">
            <button type="submit" class="btn btn-success" onclick="insert_product();">SAVE</button>

            </td><td align="right">
            <button type="button" class="btn btn-danger" data-dismiss="modal"                                               
                            onclick="$('#myModal').modal('hide');" >CLOSE</button>
            </td</tr></table>

        </div>
        </form>
    </div>
</div>