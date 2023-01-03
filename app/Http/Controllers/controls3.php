<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\student_table;
use App\Models\student_docs_table;
use App\Models\unit_table;
use App\Models\staff_table;
use App\Models\time_table;

session_start();
class controls3 extends Controller
{
    //
    function admin_home_page(Request $request){
        if($request->session()->has('type')){
            if(session()->get('type')=='staff'){
                $applied_students_number=student_table::where('status','restricted')-> count();
                return view('admin_homepage',['fname'=>session()->get('fname'),'applied_students_number'=>$applied_students_number]);
            }else{
                return view('login');
            }
        }else{
            return view('login');
        }
    }


    function admition_function_page(Request $request){
        if($request->session()->has('type')){
            if(session()->get('type')=='staff'){

                $details=student_table::where('status','restricted')->get();
                return view('admition_function',['fname'=>session()->get('fname'), 'details'=>$details]);
            }else{
                return view('login');
            }
        }else{
            return view('login');
        }
    }


    function fetch_student_data(Request $request){
        //Get the data as an indexed array
        $data=$request->all();

        //Check if the data contains something
        if ($data!=null){
            $rentry=student_table::where('id',$data['student_id'])->first();
            $docs=student_docs_table::where('student_id',$data['student_id'])->get();
            return response()->json(['message'=>'found','data'=>$rentry,'docs'=>$docs]);
        }else{
            return response()->json(['message'=>'not_found']);
        }
    }


    function admition_approval_form(Request $request){
        if($request->hasFile('file')){
            $original_file_name=$request->file('file')->getClientOriginalName();
            $request->file('file')->storeAs("student_documents",strval($request->student_id)."-".$original_file_name);

            
            $new_entry= new student_docs_table;
            $new_entry->student_id=$request->student_id;
            $new_entry->type='admission_letter';
            $new_entry->file_name=strval($request->student_id)."-".$original_file_name;
            $new_entry->normal_file_name=$original_file_name;
            $new_entry->save();
            

            student_table::where('id',$request->student_id)->update(['status'=>'admited']);

            return response()->json(['message'=>'success','student_id'=>$request->student_id]);
        }else{
            return response()->json(['message'=>'error','cause'=>'no file uploaded']);
        }
    }


    function assigning_function_page(Request $request){
        if($request->session()->has('type')){
            if(session()->get('type')=='staff'){

                $details=unit_table::get();
                $lecturers=staff_table::where('department','lecturer')->get();
                return view('admin_assigning_function',['details'=>$details,'lecturers'=>$lecturers]);
            }else{
                return view('login');
            }
        }else{
            return view('login');
        }
    }


    function assigning_function_data(Request $request){
        $lecturer=staff_table::where('id',$request->lecturer_id)->first();
        if($lecturer!=null){
            unit_table::where('id',$request->unit_id)->update(['lecturer_id'=>$lecturer->id]);
            unit_table::where('id',$request->unit_id)->update(['lecturer'=>$lecturer->fname]);
            $details=unit_table::get();
            $lecturers=staff_table::where('department','lecturer')->get();
            return view('admin_assigning_function',['details'=>$details,'lecturers'=>$lecturers]);

        }else{
            $details=unit_table::get();
            $lecturers=staff_table::where('department','lecturer')->get();
            return view('admin_assigning_function',['details'=>$details,'lecturers'=>$lecturers]);
        }
        
    }


    function admin_timetable_management_function_page(Request $request){
        if($request->session()->has('type')){
            if(session()->get('type')=='staff'){
                return view('admin_timetable_management_function');
            }else{
                return view('login');
            }
        }else{
            return view('login');
        }
    }


    function get_semester_table_data(Request $request){
        $year=$request->year;
        $semester=$request->semester;

        $count_data=time_table::where([['year','=',$year],['semester','=',$semester]])->count();
        $unit_data=unit_table::select('unit_code','name','lecturer_id','lecturer')->where([['year','=',$year],['semester','=',$semester]])->get();

        if($count_data==0){
            return Response()->json(['message'=>'new_entry','unit_data'=>$unit_data,'count'=>$count_data]);
        }else{
            $timetable_data=time_table::where([['year','=',$year],['semester','=',$semester]])->get();
            return Response()->json(['message'=>'data_entry','unit_data'=>$unit_data,'timetable_data'=>$timetable_data,'count'=>$count_data]);
        }
        
    }



    function add_new_timetable_data(Request $request){

        $unit_data=unit_table::select('lecturer_id','lecturer')->where([['unit_code','=',$request->unit_code]])->first();
        
        $new_entry= new time_table;
        $new_entry->year=$request->year;
        $new_entry->semester=$request->semester;
        $new_entry->day=$request->day;
        $new_entry->start_time=$request->start_time;
        $new_entry->end_time=$request->end_time;
        $new_entry->lecturer_id=$unit_data->lecturer_id;
        $new_entry->lecturer=$unit_data->lecturer;
        $new_entry->unit_code=$request->unit_code;
        $new_entry->save();
        
        return Response()->json(['message'=>'added','received data'=>$request->all()]);
    }

}
