<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScanDATA_model;
class ScanDataController extends Controller
{
    //
    public function update(Request $request)
    {
       
      echo $request['thisDATA'];
        $ScanDATA=ScanDATA_model::first();
        $ScanDATA->SCAN_VALUE=$request['thisDATA'];
        $ScanDATA->save();
    
     


    }
}
