<?php

namespace App\Http\Controllers;
use App\Models\staff_table;
use Illuminate\Http\Request;



session_start();
class controls2 extends Controller
{
    //

    function hr_home_page(Request $request){
        if($request->session()->has('type')){
            if(session()->get('type')=='staff'){
                return view('hr_homepage',['fname'=>session()->get('fname')]);
            }else{
                return view('login');
            }
        }else{
            return view('login');
        }
    }

    function check_staff_user(Request $request){
        //Get the data as an indexed array
        $data=$request->all();

        //Check if the data contains something
        if ($data!=null){
            $rentry=staff_table::where('id',$data['staff_id'])->first();
            return response()->json(['message'=>'found','data'=>$rentry]);
        }else{
            return response()->json(['message'=>'not_found']);
        }
        
    }


    function remove_staff_user(Request $request){
        //Get the data as an indexed array
        $data=$request->all();

        //Check if the data contains something
        if ($data!=null){
            //$rentry=staff_table::where('id',session()->get('id'))->first();
            //Type a command that removes the user 
            return response()->json(['message'=>'found']);
        }else{
            return response()->json(['message'=>'not_found']);
        }
        
    }


    function add_new_staff_user(Request $request){
        //Create a new staff in the table

        $data=$request->all();
        if($data!=null){
            $new_entry= new staff_table;
            $new_entry->fname=$data['fname'];
            $new_entry->lname=$data['lname'];
            $new_entry->religion=$data['religion'];
            $new_entry->nationality=$data['nationality'];
            $new_entry->email=$data['email'];
            $new_entry->phone=$data['phone'];
            $new_entry->status="active";
            $new_entry->password="123";
            $new_entry->department=$data['department'];
            $new_entry->save();

            return response()->json(['message'=>'added']);
        }else{
            return response()->json(['message'=>'not_added']);
        }

    }


}
