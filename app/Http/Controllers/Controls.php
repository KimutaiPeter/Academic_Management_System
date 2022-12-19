<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use App\Models\students_table;
use App\Models\students_docs_table;
use App\Models\staff_table;
use Session;
use Response;

session_start();

class Controls extends Controller
{
    //
    function index_page(){
        return view('home_page');
    }

    function signup_page(){
        return view("students_registration");
    }

    function signin_page(Request $request){
        if($request->session()->has('email')){
            if($request->session()->get('type')=='student'){
                $rentry=students_table::where('email',session()->get('email'))->first();
                $docs=students_docs_table::where('student_id',session()->get('id'))->get();
                return view('student_landing_page',['rentry'=>$rentry,'docs'=>$docs]);
            }else{
                return redirect('/staff_department_page');
            }
        }else{
            return view("login");
        }
    }

    function enrollment_page(){
        return view("student_enrollment_form");
    }


    function login_process(Request $request){
        if($request->session()->has('email')){
            $rentry=students_table::where('email',session()->get('email'))->first();
            $docs=students_docs_table::where('student_id',session()->get('id'))->get();
            return view('student_landing_page',['rentry'=>$rentry,'docs'=>$docs]);
        }else{
            $rentry=students_table::where('email',$request->email)->first();
            if($rentry!=null){
                $email=$request->email;
                $user_password=$request->password;

                if($user_password===$rentry->password){
                    $request->session()->put('fname',$rentry->fname);
                    $request->session()->put('email',$rentry->email);
                    $request->session()->put('id',$rentry->id);
                    $request->session()->put('type','student');
                    $docs=students_docs_table::where('student_id',session()->get('id'));
                    return view('student_landing_page',['rentry'=>$rentry,'docs'=>$docs]);
                }else{
                    return redirect('/login_page');
                }
            }else{
                return view('login');
            }
        }
    }


    function logout(){
        Session::flush();
        return redirect("/");
    }


    function staff_login_process(Request $request){
        //Insert a HR user to add the rest of the users
        //INSERT INTO `staff_tables`(`fname`, `lname`, `religion`, `nationality`, `email`, `phone`, `status`, `password`, `department`, `created_at`, `updated_at`) VALUES ('Steve','Miler','Islamic','Tanzanian','steve.miller@gmail.com','0724292634','active','123','Human-Resources','2020-10-10 12:12:12','2020-10-10 12:12:12');
        if($request->session()->has('email')){
            $rentry=staff_table::where('email',session()->get('email'))->first();
            return view('staff_departments');
        }else{
            $rentry=staff_table::where('email',$request->email)->first();
            if($rentry!=null){
                $email=$request->email;
                $user_password=$request->password;

                if($user_password===$rentry->password){
                    $request->session()->put('fname',$rentry->fname);
                    $request->session()->put('email',$rentry->email);
                    $request->session()->put('id',$rentry->id);
                    $request->session()->put('type',"staff");
                    return redirect('staff_department_page');
                }else{
                    return view('login');
                }
            }else{
                return view('login');
            }
        }
    }


    function regestration_page(){
        return view('register');
    }

    function regestration_process(Request $request){
        //return json_encode($request->all());
        $new_entry= new students_table;
        $new_entry->fname=$request->fname;
        $new_entry->lname=$request->lname;
        $new_entry->religion=$request->religion;
        $new_entry->nationality=$request->nationality;
        $new_entry->email=$request->email;
        $new_entry->phone=$request->phone;
        $new_entry->courses=$request->courses;
        $new_entry->status="restricted";
        $new_entry->password=$request->password;
        $new_entry->save();



        //Login in the user
        $request->session()->put('fname',$request->fname);
        $request->session()->put('email',$request->email);
        $request->session()->put('type','student');
        $request->session()->put('status',"restricted");
        
        
        return view('student_landing_page');
    }



    function receive_student_document(Request $request){
        $file_path=null;
        if($request->hasFile('file')){
            $original_file_name=$request->file('file')->getClientOriginalName();
            $request->file('file')->storeAs("student_documents",session()->get('id').":".$original_file_name);

            $new_entry= new students_docs_table;
            $new_entry->student_id=$request->session()->get('id');
            $new_entry->type=$request->type;
            $new_entry->file_name=session()->get('id').":".$original_file_name;
            $new_entry->normal_file_name=$original_file_name;
            $new_entry->save();

            return redirect('/sign_in');
        }else{
            return 'no file fund';
        }
    }


    public function open_file(Request $request){

        //Check if the file name in request is okay
        $path = storage_path().'/'.'app'.'/student_documents/';
        $file_name=$request->file_name;
        $pathToFile = $path.$file_name;
        $file = File::get($pathToFile);
        $type = File::mimeType($pathToFile);
        $response = Response::make($file,200);
        $response->header("Content-Type",$type);
        return $response;
    }


    public function staff_department_page(Request $request){
        if($request->session()->has('type')){
            if(session()->get('type')=='staff'){
                return view('staff_departments');
            }else{
                return redirect('/sign_in');
            }
        }else{
            return redirect('/sign_in');
        }
    }

    
}
