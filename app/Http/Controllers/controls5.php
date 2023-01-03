<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\time_table;
use App\Models\unit_table;
use App\Models\registered_unit_table;
use App\Models\unit_content_table;
use Session;
use File;
use Response;

session_start();

class controls5 extends Controller
{
    //
    function lec_home_page(Request $request){
        if($request->session()->has('type')){
            if(session()->get('type')=='staff'){
                $lec_time_table_count=time_table::where('lecturer_id',session()->get('id'))->count();
                $lec_time_table=time_table::where('lecturer_id',session()->get('id'))->get();
                $unit_count=unit_table::select('unit_code','name')->where('lecturer_id',session()->get('id'))->count();
                $units=unit_table::select('unit_code','name')->where('lecturer_id',session()->get('id'))->get();
                return view('lec_homepage',['time_table'=>$lec_time_table,'count'=>$lec_time_table_count,'unit_count'=>$unit_count,'units'=>$units]);
            }else{
                return view('login');
            }
        }else{
            return view('login');
        }
    }


    //lecturers student management page
    function lec_manage_marks_function_page(Request $request){
        if($request->session()->has('type')){
            if(session()->get('type')=='staff'){
                if($request->unit_code!=null){
                    //Get the students who are registered for the unit
                    $count=registered_unit_table::select('student_id','status','course_work','exam_mark')->where('unit_code',$request->unit_code)->count();
                    $students=registered_unit_table::select('student_id','status','course_work','exam_mark')->where('unit_code',$request->unit_code)->get();
                    return view('lec_students_marks_management',['students'=>$students,'count'=>$count]);
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




    //lecturers elearning management page
    //lecturers elearning content management page
    function lec_elearning_content_management_page(Request $request){
        if($request->session()->has('type')){
            if(session()->get('type')=='staff'){
                if($request->unit_code!=null){
                    //Return the page with the unit code, the rest will be handled using javascript
                    $unit_code=$request->unit_code;
                    return view('lec_content_management_function',['unit_code'=>$unit_code]);
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


    //lec uploading a document or uploading some type of content
    function upload_new_elearning_content(Request $request){
        if($request->hasFile('file')){
            $original_file_name=$request->file('file')->getClientOriginalName();
            $request->file('file')->storeAs("elearning_content",strval($request->student_id)."-".$original_file_name);

            
            $new_entry= new unit_content_table;
            $new_entry->unit_code=$request->unit_code;
            $new_entry->type=$request->type;
            $new_entry->file_name=strval($request->unit_code)."-".$original_file_name;
            $new_entry->normal_file_name=$original_file_name;
            if($request->comment!=null){
                $new_entry->comment=$request->comment;
            }
            $new_entry->save();
        
            return response()->json(['message'=>'success']);
        }else{
            return response()->json(['message'=>'error','cause'=>'no file uploaded']);
        }
    }



    //The lec uploading content to the page may be need to know thats its uploaded
    //Also it displays the content on the unit section
    function lec_get_unit_content(Request $request){
        $data=$request->all();
        $unit_content=unit_content_table::where('unit_code',$data['unit_code'])->get();
        $unit_content_count=unit_content_table::where('unit_code',$data['unit_code'])->count();
        return response()->json(['message'=>'success','data'=>$unit_content,'count'=>$unit_content_count]);
    }



    
}
