<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\productsModel;
use Session;

class ProductsController extends Controller
{
    //
    public function list()
    {
        $DATA=productsModel::All();
        $data=compact('DATA');
        return view('/products/products')->with($data);
    }
    public function reports()
    {
        $DATA=productsModel::orderBy('ipr_Ref_no')->get();
        $data=compact('DATA');
        return view('/reports/reports')->with($data);
    }
    public function insert_product(Request $request)
    {
         $rowCount=productsModel::where('Customer_name','=',$request['CUSTOMER_NAME'])
         ->where('Customer_part_no','=',$request['CUSTOMER_PART_NUMBER'])
         ->count();
         
         if($rowCount>0)
         {
            echo "<FONT color='red'>Cannot save this product.. This Product is already in database.. Please check</font>";
         }
         else
         {
        

            $PRODUCT=new productsModel;
            $PRODUCT->product_name=$request['PRODUCT_NAME'];
          
           $PRODUCT->Customer_name=$request['CUSTOMER_NAME'];
            $PRODUCT->Customer_part_no=$request['CUSTOMER_PART_NUMBER'];
            $PRODUCT->ipr_Ref_no=$request['IPR_REF_NO'];
            $PRODUCT->Qty=$request['QTY'];
            $PRODUCT->MATERIAL_CODE=$request['MATERIAL_CODE'];
            $PRODUCT->packing_factor=$request['QTY'];
            $PRODUCT->Min_Weight=$request['MIN_WEIGHT'];
            $PRODUCT->Max_Weight=$request['MAX_WEIGHT'];
            $PRODUCT->updated_by=Session::get('createdby_id');
            $PRODUCT->REMARKS=$request['REMARKS'];
            $PRODUCT->REV_LEVEL=$request['REV_LEVEL'];
            $PRODUCT->SCAN_TYPE=$request['SCAN_TYPE'];
            $PRODUCT->master_packing_factor=$request['MASTER_PACKING_FACTOR'];
            $PRODUCT->active=1;
            $PRODUCT->save();
            
            ECHO "PRODUCT SAVED.. "; 
            
           
            echo "<script>$('#myModal').modal('hide');
            pageLoad('product');</script>";
 
         
         }
    }
    public function update_product(Request $request)
    {
            $PRODUCT= productsModel::find($request['id']);
            $PRODUCT->product_name=$request['PRODUCT_NAME'];
            $PRODUCT->Customer_name=$request['CUSTOMER_NAME'];
            $PRODUCT->Customer_part_no=$request['CUSTOMER_PART_NUMBER'];
            $PRODUCT->ipr_Ref_no=$request['IPR_REF_NO'];
            $PRODUCT->Qty=$request['QTY'];
            $PRODUCT->MATERIAL_CODE=$request['MATERIAL_CODE'];
            $PRODUCT->packing_factor=$request['QTY'];
            $PRODUCT->Min_Weight=$request['MIN_WEIGHT'];
            $PRODUCT->Max_Weight=$request['MAX_WEIGHT'];
            $PRODUCT->updated_by=Session::get('createdby_id');
            $PRODUCT->REMARKS=$request['REMARKS'];
            $PRODUCT->REV_LEVEL=$request['REV_LEVEL'];
            $PRODUCT->SCAN_TYPE=$request['SCAN_TYPE'];
            $PRODUCT->master_packing_factor=$request['MASTER_PACKING_FACTOR'];
            $PRODUCT->active=1;
            $PRODUCT->save();
            ECHO "PRODUCT SAVED.. "; 
           
            echo "<script>
            $('#myModal').modal('hide');
            pageLoad('product');</script>";
 
         
    }
    public function disable(Request $request)
    {
         $id=$request['product_id'];
        
            $PRODUCT= productsModel::find($id);
            $PRODUCT->ACTIVE=0;
            $PRODUCT->updated_by=Session::get('createdby_id');
            $PRODUCT->save();
            ECHO "PRODUCT SAVED.. "; 
           
            echo "<script>
            $('#myModal').modal('hide');
            pageLoad('product');</script>";
 
         
    }
    public function enable(Request $request)
    {
         $id=$request['product_id'];
            $PRODUCT= productsModel::find($id);
            $PRODUCT->updated_by=Session::get('createdby_id');
            $PRODUCT->ACTIVE=1;
            $PRODUCT->save();
            ECHO "PRODUCT SAVED.. "; 
           
            echo "<script>
            $('#myModal').modal('hide');
            pageLoad('product');</script>";
 
         
    }
    public function edit(Request $request)
    {
       // echo "U r in products Controller";
        $product_id=$request['product_id'];
        $DATA=productsModel::where('id','=',$product_id)->get();
         $DATA=compact('DATA');
        
        return view('/products/edit')->with($DATA);
    }
}
