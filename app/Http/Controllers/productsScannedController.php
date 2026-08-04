<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\products_scannedModel;


class productsScannedController extends Controller
{
    //
    public function listScannedSaleOrderItem(Request $request)
    {
        $DATA=products_scannedModel::where('SALE_ORDER_ITEM','=',$request['SALE_ORDER_ITEM'])
        ->where('SALE_ORDER','=',$request['SALE_ORDER'])->get();
        $data=compact('DATA');
        return view('/products/products_SCANNED')->with($data);
    }
    public function listScannedSaleOrderItemForPackingFactor(Request $request)
    {
        $DATA=products_scannedModel::where('SALE_ORDER_ITEM','=',$request['SALE_ORDER_ITEM'])
        ->where('SALE_ORDER','=',$request['SALE_ORDER'])
        ->where('PRIMARY_BARCODE','=','')->count();

        return $DATA;
    }
}
