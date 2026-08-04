<?php

namespace App\Http\Controllers;
use App\Models\UsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;

class UsersController extends Controller
{
    //
    public function list()
    {
        $DATA=UsersModel::All();
        $data=compact('DATA');
        return view('/users/users')->with($data);
    }
    public function edit(Request $request)
    {
        $user_id=$request['user_id'];
        $DATA=UsersModel::select('id','name','email','password','user_type','Employee_ID')-> where('id','=',$user_id)->get();
        $DATA=compact('DATA');
        
        return view('/users/edit')->with($DATA);
    }
    public function delete(Request $request)
    {
        $user_id=$request['user_id'];
        $DATA=UsersModel::where('id','=',$user_id);
        $data=compact('DATA');
        return view('/users/edit')->with($data);
    }
    public function insert_user(Request $request)
    {
         $rowCount=UsersModel::where('email','=',$request['email'])->count();
         $rowCount1=UsersModel::where('Employee_ID','=',$request['Employee_ID'])->count();
         
         if($rowCount>0)
         {
            echo "<font color='red'>email Already Taken</font>";
         }else
         if($rowCount1>0)
         {
            echo "<font color='red'>Employee ID  Already Taken</font>";
         }
         else if($rowCount==0 and $request['email']!='')
         {

            $USER=new UsersModel;
            $USER->name=$request['name'];
            $USER->email=$request['email'];
            $USER->Employee_ID=$request['Employee_ID'];
            $USER->password=Hash::make($request['password']);
            $USER->user_type=$request['user_type'];
            $USER->active=1;
            $USER->save();
            ECHO "USER SAVED.. "; 
           
            echo "<script>
            $('#myModal').modal('hide');
            pageLoad('users');</script>";
 
         
         }else
         {
            echo "<font color='red'>Please Check Input..</font>";
         }
    }
    public function update_user(Request $request)
    {
            $USER= UsersModel::find($request['id']);
            $USER->name=$request['name'];
            $USER->email=$request['email'];
            $USER->Employee_ID=$request['Employee_ID'];
            $USER->password=Hash::make($request['password']);
            $USER->user_type=$request['user_type'];
            $USER->updated_by=Session::get('createdby_id');
            $USER->last_password_on=date('Y-m-d H:i:s');
            $USER->save();
            ECHO "USER SAVED.. "; 
           
            echo "<script>
            $('#myModal').modal('hide');
            pageLoad('users');</script>";
 
         
    }
    public function disable(Request $request)
    {
            $USER= UsersModel::find($request['user_id']);
            $USER->active=0;
            $USER->updated_by=Session::get('createdby_id');
            $USER->last_password_on=date('Y-m-d H:i:s');
            $USER->save();
            ECHO "USER SAVED.. "; 
           
            echo "<script>
            $('#myModal').modal('hide');
            pageLoad('users');</script>";
 
         
    }
    public function enable(Request $request)
    {
            $USER= UsersModel::find($request['user_id']);
            $USER->active=1;
            $USER->save();
            ECHO "USER SAVED.. "; 
           
            echo "<script>
            $('#myModal').modal('hide');
            pageLoad('users');</script>";
 
         
    }
}

