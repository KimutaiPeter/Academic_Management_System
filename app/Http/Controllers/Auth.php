<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;

class Controls extends Controller
{
    //
    function index_page(){
        return view('home_page');
    }

    function login_process(Request $request){
        $rentry=user::where('name',$request->name)->first();


        if(is_null($rentry)){
            return "<center><h1  style='margin-top:200px;'>Error, Try again</h1></center>";
        }
        else{
            if($request->password == $rentry->password){
                return "<center><h1  style='margin-top:200px;'>Success</h1></center>";
            }
            else{
                return "<center><h1  style='margin-top:200px;'>Error, Try again</h1></center>";
            }
            
        }

        return json_encode($request->all());
    }

    function regestration_page(){
        return view('register');
    }

    function regestration_process(Request $request){
        //return json_encode($request->all());
        $new_entry= new User;
        $new_entry->name=$request->name;
        $new_entry->password=$request->password;
        $new_entry->save();

        return redirect('/');
    }
}
