<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Models\UsersModel;
use Session;

class LoginController extends Controller
{
    //
    public function LoginAuthendicate(Request $request)
    {
       $request->validate([
        'email'=>'required|email',
        'password'=>'required'

       ]);
       /*
       $User= User::where('email','=',$request->email)->first();
       if($User){
        
        if(Hash::check($request->password,$User->password))
        {
            $request->session()->put('createdby_id',$User->id);
            $request->session()->put('createdby_email',$User->email);
            $request->session()->put('createdby_name',$User->id);
            return redirect('/admin');

        }else
        {
            return back()->with('error','Password not matching..');
        }
        
       }else
       {
        return back()->with('error','Unknown Email ID /Email ID not found..');
       }*/
       $credentials=$request->only('email','password');
       if(Auth::attempt($credentials))
       {
        $User= User::where('email','=',$request->email)->first();
            if($User->active==0)
            {
                return back()->with('FAIL', 'User is disabled.. Please contact WebAdmin')->withInput();

            }else
            {
                $request->session()->put('createdby_id',$User->id);
                $request->session()->put('createdby_email',$User->email);
                $request->session()->put('createdby_name',$User->name);
                $request->session()->put('user_type',$User->user_type);
                $request->session()->put('Employee_ID',$User->Employee_ID);
                return redirect('/admin');

            }
    
       
       }
       $User= User::where('email','=',$request->email)->first();
       if($User)
       {
        return back()->with('FAIL', 'Password is Wrong')->withInput();

       }else
       {
        return back()->with('FAIL', 'EMAIL ID  is Wrong')->withInput();
        ;
       }
       


    }
    public function changePasswordForm()
    {
        $LOGIN_ID=Session::get('createdby_id');
        $USER= User::where('id','=',$LOGIN_ID)->first();
        $USER=compact('USER');
        return view('/login/changePassword')->with($USER);
    }
    public function updateNewPassword(Request $request)
    {
       
        
         $CURRENT_PASSWORD=$request['CURRENT_PASSWORD'];
        // echo "<br>".Hash::make($CURRENT_PASSWORD);
         $CONFIRM_NEW_PASSWORD=$request['CONFIRM_NEW_PASSWORD'];
         $NEW_PASSWORD=$request['NEW_PASSWORD'];
        //Hash::make($request['password']);
         $LOGIN_ID=Session::get('createdby_id');
      
       $USER= User::select('password')-> where('id','=',$LOGIN_ID)
       ->first();
       if (Hash::check($CURRENT_PASSWORD, $USER->password))
       {
        $USER= User::find($LOGIN_ID);
        $USER->password=Hash::make($NEW_PASSWORD);
        $USER->last_password_on=date('Y-m-d H:i:s');
        $USER->save();
        echo "<font color='blue' size='+1'>PASSWORD Change sucessfull., You will be loged out , <br>Please login with new password..</font>";
        echo "<script>
       setTimeout(function(){
        $('#myModal').modal('hide');
        window.location.assign(url+'/logout');
        ;}, 3000);
       ";
       
       }else
       {
        echo  '<font color="red">Current Password is not matching. Please retype current password  </font>';
       }
            

    }
    
    public function logout(Request $request)
    {

        $request->Session()->flush();
        Auth::logout();
        return redirect('/');
        
    }
}
