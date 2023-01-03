<?php

namespace App\Http\Controllers;
use App\Models\student_docs_table;
use App\Models\student_table;
use App\Models\unit_table;
use App\Models\registered_unit_table;
use App\Models\time_table;
use Illuminate\Http\Request;
use Exception;
session_start();


class controls4 extends Controller
{
    //The elearning index page
    function student_elearning_page(Request $request){
        if($request->session()->has('status')){
            if(session()->get('status')=='admited'){
                $unit_codes=registered_unit_table::select('unit_code')->where('student_id',session()->get('id'))->get();
                $registered_units_time_table_count=time_table::whereIn('unit_code',$unit_codes)->count();
                $registered_units_time_table=time_table::whereIn('unit_code',$unit_codes)->get();
                return view('student_elearning_page',['my_time_table'=>$registered_units_time_table,'count'=>$registered_units_time_table_count]);
            }else{
                return redirect('sign_in');
            }
        }
    }


    //Elearning profile page
    function student_elearning_profile_page(Request $request){
        if($request->session()->has('status')){
            if(session()->get('status')=='admited'){
                $rentry=student_table::where('id',session()->get('student_id'))->first();
                $docs=student_docs_table::where('student_id',session()->get('id'))->get();
                $units=unit_table::get();
                $marks=registered_unit_table::where('student_id',session()->get('id'))->get();
                return view('student_elearning_profile_page',['rentry'=>$rentry,'docs'=>$docs,'units'=>$units,'marks'=>$marks]);
            }else{
                return view('login');
            }
        }
    }


    //Register a student for a perticular unit as described
    function register_student_unit(Request $request){
        $unit_data=$request->all();
        if($unit_data!=null){
            //Check if the student is already registered for the unit
            $count=registered_unit_table::where([['student_id',"=",$unit_data['student_id']],['unit_code',"=",$unit_data['unit_code']]])->count();
            if($count==0){

                //Make a new record and save to the database
                
                $new_entry= new registered_unit_table;
                $new_entry->student_id=$unit_data['student_id'];
                $new_entry->unit_code=$unit_data['unit_code'];
                $new_entry->unit_name=$unit_data['unit_name'];
                $new_entry->status="registered";
                try{
                    $new_entry->save();
                }catch(Exception $e){
                    $error=$e->getMessage();
                    //dd($e->getMessage());
                }

                return response()->json(['message'=>'registered','data'=>$unit_data]);
            }else{
                return response()->json(['message'=>'error','error'=>'You are already registered for the unit']);
            }
            
        }else{
            return response()->json(['message'=>'error','error'=>'No data']);
        }
    }





    function student_unit_content_page(Request $request){
        if($request->session()->has('type')){
            if(session()->get('status')=='admited'){
                if($request->unit_code!=null){
                    //Return the page with the unit code, the rest will be handled using javascript
                    $unit_code=$request->unit_code;
                    return view('student_elearning_content',['unit_code'=>$unit_code]);
                }else{
                    return 'Please select a group';
                }
            }else{
                return view('login');
            }
        }else{
            return view('login');
        }
    }


    
}
