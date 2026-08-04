<?php

namespace App\Imports;

use App\Models\work_order_model;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportWorkOrder implements ToModel,WithHeadingRow
{ 
    //
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

     //////
      /**
             * Transform a date value into a Carbon object.
             *
             * @return \Carbon\Carbon|null
             */
            public function transformDate($value, $format = 'Y-m-d')
            {
                try {
                    return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
                } catch (\ErrorException $e) {
                    return \Carbon\Carbon::createFromFormat($format, $value);
                }
            }
    //////////////////////

    public function model(array $row)
    {
        
   
         $selectQ=work_order_model::where('order','=',$row['order'])
        ->where('material_code','=',$row['material'])
        ->where('yield_qty','=',$row['confirmed_yield_gmein'])
        ->count();
   
        if(($selectQ==0 or $selectQ=='' ) and ($row['order']!='' and $row['material']!='') )
        {
 
 echo "<br>".$InvoiceModel=  new work_order_model([
                         
                     "order" 	 =>$row['order'], 
                     "posting_date" 	    =>$this->transformDate($row['posting_date']), 
                     "material_code" 	    =>$row['material'], 
                     "material_description" 	    =>$row['material_description'], 
                     "yield_qty" 	    =>$row['confirmed_yield_gmein'],    
                                  ]);
         
                          $InvoiceModel->save();
 
 
        }
    }
}
