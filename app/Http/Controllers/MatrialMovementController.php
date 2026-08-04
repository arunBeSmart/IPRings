<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MatrialMovementController extends Controller
{
    public function materialReceive()
    {
        return view ('/movement/materialReceive') ;
    }
    public function internalTransfer()
    {
        return view ('/movement/internalTransfer') ;
    }
    public function materiaIssue()
    {
        return view ('/movement/materiaIssue') ;
    }
}
