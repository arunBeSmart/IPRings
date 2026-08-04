<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RackMaster_model;
use App\Models\InvoiceModel;
use App\Models\StorageLocation_model;
use Session;

class StoreController extends Controller
{
    //
    public function locationsList()
    {
        $DATA=StorageLocation_model::get();
        $DATA=compact('DATA');
        //print_r($DATA);

        return view('store/locations')->with($DATA);
    }
    public function addRacksForm()
    {
        $DATA=StorageLocation_model::get();
        $DATA=compact('DATA');
        
        return view('store/racks_add')->with($DATA);
    }
    public function racksList()
    {
        $DATA=RackMaster_model::select(
           'storage_location.location_code',
           'storage_location.location_name',
            'rack_master.storage_location',
            'rack_master.rack_id',
            'rack_master.bin_no',
            'rack_master.bin_name',
            'rack_master.active',
            'rack_master.id',
            )
        ->join('storage_location','storage_location.id','=','rack_master.storage_location')
        ->get();
        $DATA=compact('DATA');
         return view('store/racks')->with($DATA);
    }
    public function editLocation(Request $request)
    {
        $DATA=StorageLocation_model::where('id','=',$request['location_id'])->get();
        $DATA=compact('DATA');
       
        return view('store/locations_edit')->with($DATA);
    }
    public function editRack(Request $request)
    {
        $RACKS=RackMaster_model::where('id','=',$request['rack_id'])->get();
        $LOCATIONS=StorageLocation_model::get();
        $DATA=compact('RACKS','LOCATIONS');
       
        return view('store/racks_edit')->with($DATA);
    }
    public function enableLocation(Request $request)
    {
        $data=StorageLocation_model::where('id','=',$request['location_id'])->update(['active'=>1]);
       
        echo "<script>
        $('#myModal').modal('hide');
        pageLoad('locations');</script>";
    }
    public function enableRack(Request $request)
    {
        $data=RackMaster_model::where('id','=',$request['rack_id'])->update(['active'=>1]);
       
        echo "<script>
        $('#myModal').modal('hide');
        pageLoad('racks');</script>";
    }
    public function disableLocation(Request $request)
    {
        $data=StorageLocation_model::where('id','=',$request['location_id'])->update(['active'=>0]);
       
        echo "<script>
        $('#myModal').modal('hide');
        pageLoad('locations');</script>";
    }
    public function disableRack(Request $request)
    {
        $data=RackMaster_model::where('id','=',$request['rack_id'])->update(['active'=>0]);
       
        echo "<script>
        $('#myModal').modal('hide');
        pageLoad('racks');</script>";
    }
    
    public function addLocationsForm()
    {
        
        return view('store/locations_add');
    }
    public function insertLocation(Request $request)
    {
        $count=StorageLocation_model::where('location_code','=',$request['location_code'])
        ->orWhere('location_name','=',$request['location_name'])->count();
        if( $count==0)
        {
            $INSERT=new StorageLocation_model;
            $INSERT->location_code=$request['location_code'];
            $INSERT->location_name=$request['location_name'];
            $INSERT->createdby=Session::get('createdby_id');     
            $INSERT->active=1;
            $INSERT->save();
            echo "New Location Added";
            echo "<script>
            $('#myModal').modal('hide');
            pageLoad('locations');</script>";

        }
        else 
        {
            echo "<br><font color='red'>This Storage Location already in DATABASE..
             <br>Duplicate Attempt Prevented</font>";
        }

    }
    public function insertRack(Request $request)
    {
        $count=RackMaster_model::where('storage_location','=',$request['location_id'])
        ->Where('rack_id','=',$request['rack_id'])
        ->Where('bin_no','=',$request['bin_no'])
        ->Where('bin_name','=',$request['bin_name'])
        ->count();
        if( $count==0)
        {
            $INSERT=new RackMaster_model;
            $INSERT->storage_location=$request['location_id'];
            $INSERT->rack_id=$request['rack_id'];
            $INSERT->bin_no=$request['bin_no'];
            $INSERT->bin_name=$request['bin_name'];
            $INSERT->createdby=Session::get('createdby_id');     
            $INSERT->active=1;
            $INSERT->save();
            echo "New Rack Added";
            echo "<script>
            $('#myModal').modal('hide');
            pageLoad('racks');</script>";

        }
        else 
        {
            echo "<br><font color='red'>This Storage Location already in DATABASE..
             <br>Duplicate Attempt Prevented</font>";
        }

    }
    public function updateRack(Request $request)
    {
        
            $INSERT=RackMaster_model::find($request['table_id']);
            $INSERT->storage_location=$request['location_id'];
            $INSERT->rack_id=$request['rack_id'];
            $INSERT->bin_no=$request['bin_no'];
            $INSERT->bin_name=$request['bin_name'];
            $INSERT->createdby=Session::get('createdby_id');     
            $INSERT->active=1;
            $INSERT->save();
            echo " Racks Updated";
            echo "<script>
            $('#myModal').modal('hide');
            pageLoad('racks');</script>";

       

    }
    public function updateLocation(Request $request)
    {
        
            $INSERT=StorageLocation_model::find($request['location_id']);
            $INSERT->location_code=$request['location_code'];
            $INSERT->location_name=$request['location_name'];
            $INSERT->createdby=Session::get('createdby_id');     
            $INSERT->active=$request['active'];
            $INSERT->save();
            echo "New Location Added";
            echo "<script>
            $('#myModal').modal('hide');
            pageLoad('locations');</script>";

      

    }
    public function getBinsByLocation(Request  $request)
    {
        
        $DATA=RackMaster_model::where('storage_location','=',$request['storage_location_id'])
        ->get();
        echo '<select  id="rack_master_id" name="rack_master_id" class="select2" style="width:90%;">';
        foreach($DATA as $racks)
        {
            echo "<option value='".$racks['id']."'>
            ".$racks['rack_id']." - 
            ".$racks['bin_no']." -
            ".$racks['bin_name']." - </option> ";
        }
        echo ' </select>';
        echo "<script>$('#rack_master_id').select2();</script>";


    }
   
   
}
