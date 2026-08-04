<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\work_order_model;

use App\Http\Controllers\ImportExcelController;

use App\Imports\InvoiceImport;
use App\Imports\ImportWorkOrder;
use Session;

class WorkOrderController extends Controller
{
    //
    public function autoAddWorkOrderTriggered()
    {
        
        echo ImportExcelController::autoAddWorkOrderTriggered();
        echo   "<script>$('#myModal').modal('hide');
        getPeriodWorkOrderList();</script>";


    }
}
