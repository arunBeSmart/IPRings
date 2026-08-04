<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InvoiceModel;
use App\Models\work_order_model;
use App\Models\FileCopyModel;
use Excel; 
use App\Imports\InvoiceImport;
use App\Imports\ImportWorkOrder;
class ImportExcelController extends Controller
{
    //
    public function importInvoice(Request $request)
    {
        $DETAILS=FileCopyModel::all();
        foreach ($DETAILS as $FILES)
        {
            $files=scandir($FILES['source']);
            echo "<pre>";
            print_r($files);
            $source=$files[2];
            $destination=$FILES['destination'];
            $output=array();
          echo "<br>".  $SOURCE=$FILES['source'].$source;
            exec('copy "'.$SOURCE.'"   "'.$destination.'"  /Y ', $output, $result);
            echo '<br>copy "'.$SOURCE.'"   "'.$destination.'"  /Y ';
       
        }
       
       
        $DETAILS=FileCopyModel::where('id','=',1)->get();

        foreach ($DETAILS as $FILES)
        {
            echo  "<br>".    $FILES['destination'];
           Excel::import(new InvoiceImport, ($FILES['destination']));

        }

        $DETAILS=FileCopyModel::where('id','=',2)->get();

        foreach ($DETAILS as $FILES)
        {
           echo  "<br>". $FILES['destination'];
           Excel::import(new ImportWorkOrder, ($FILES['destination']));

        }


    }
    public function autoAddInvoiceTriggered()
    {
        $DETAILS=FileCopyModel::where('id','=',1)->get();
        foreach ($DETAILS as $FILES)
        {
            $files=scandir($FILES['source']);
           // echo "<pre>";
          //  print_r($files);
            $source=$files[2];
            $destination=$FILES['destination'];
            $output=array();
            $SOURCE=$FILES['source'].$source;
            exec('copy "'.$SOURCE.'"   "'.$destination.'"  /Y ', $output, $result);
          //  echo '<br>copy "'.$SOURCE.'"   "'.$destination.'"  /Y ';
       
        }      
       
        $DETAILS=FileCopyModel::where('id','=',1)->get();
        foreach ($DETAILS as $FILES)
        {
            echo  "<br>".    $FILES['destination'];
           Excel::import(new InvoiceImport, ($FILES['destination']));

        }

    }
    public function autoAddWorkOrderTriggered()
    {
        $DETAILS=FileCopyModel::where('id','=',2)->get();
        foreach ($DETAILS as $FILES)
        {
            $files=scandir($FILES['source']);
           // echo "<pre>";
          //  print_r($files);
            $source=$files[2];
            $destination=$FILES['destination'];
            $output=array();
            $SOURCE=$FILES['source'].$source;
            exec('copy "'.$SOURCE.'"   "'.$destination.'"  /Y ', $output, $result);
          //  echo '<br>copy "'.$SOURCE.'"   "'.$destination.'"  /Y ';
       
        }      
       
        $DETAILS=FileCopyModel::where('id','=',2)->get();
        foreach ($DETAILS as $FILES)
        {
            echo  "<br>".    $FILES['destination'];
           Excel::import(new ImportWorkOrder, ($FILES['destination']));

        }

    }

   
              
}
