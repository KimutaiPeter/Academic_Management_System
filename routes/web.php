<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controls;
use App\Http\Controllers\controls2;
use App\Http\Controllers\controls3;
use App\Http\Controllers\controls4;
use App\Http\Controllers\controls5;
use App\Http\Controllers\play;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//To be deleted before posting
//Used to test the and the javascript fetch calls
Route::get('/play',[play::class,'sand_box']);

Route::get('/',[Controls::class,'index_page']);

Route::get('/sign_up',[Controls::class,'signup_page']);
Route::get('/sign_in',[Controls::class,'signin_page']);
Route::get('/login_page',[Controls::class,'signin_page']);
Route::get('/logout',[Controls::class,'logout']);

Route::get('/enrollment_page',[Controls::class,'enrollment_page']);

Route::post('/regestration_process',[Controls::class,'regestration_process']);

Route::post('/login_process',[Controls::class,'login_process'])-> name('login_process');

Route::post('/staff_login_process',[Controls::class,'staff_login_process']);


//Get all staff homepage (Departments)
Route::get('/staff_department_page',[Controls::class,'staff_department_page']);

Route::post('/upload_student_document',[Controls::class,'receive_student_document']);

Route::get('/open_file',[Controls::class,'open_file']);

//The hr homepage
Route::get('/hr_home_page',[controls2::class,'hr_home_page']);

//Check the users data if available, returns the staff's id of the user to maniputlate the data
Route::post('/check_staff_user',[controls2::class,'check_staff_user']);

//REmove a staff user
Route::post('/remove_staff_user',[controls2::class,'remove_staff_user']);

//Adding a new staff user
Route::post('/add_new_staff_user',[controls2::class,'add_new_staff_user']);



//Admin
//The Admins homepage
Route::get('/admin_home_page',[controls3::class,'admin_home_page']);

//The admission function page
Route::get('/admition_function_page',[controls3::class,'admition_function_page']);

//Get the data to view all the student's data
Route::post('/fetch_student_data',[controls3::class,'fetch_student_data']);


//Student approval data
Route::post('/admition_approval_form',[controls3::class,'admition_approval_form']);


//The assigining function page
Route::get('/assigning_function_page',[controls3::class,'assigning_function_page']);
//Handling data linking lecturer to a unit to teach
Route::post('/assigning_function_data',[controls3::class,'assigning_function_data']);

//Admin timetable management function
Route::get('/admin_timetable_management_function_page',[controls3::class,'admin_timetable_management_function_page']);

//get_semester_table_data
Route::post('/get_semester_table_data',[controls3::class,'get_semester_table_data']);

//Add add_new_timetable_data
Route::post('/add_new_timetable_data',[controls3::class,'add_new_timetable_data']);

//posting anouncement admin_post_anouncement
Route::post('/admin_post_anouncement',[controls3::class,'admin_post_anouncement']);



//Admitted students
//Elearning page
Route::get('/student_elearning_page',[controls4::class,'student_elearning_page']);


//The elearning profile page
Route::get('/student_elearning_profile_page',[controls4::class,'student_elearning_profile_page']);

//Register a student for a unit
Route::post('/register_student_unit',[controls4::class,'register_student_unit']);




//Lec functionalities
//Lecturers home page
Route::get('/lec_home_page',[controls5::class,'lec_home_page']);


//This is where a lecturer can edit the makrs of students in bulk
Route::get('/lec_manage_marks_function',[controls5::class,'lec_manage_marks_function_page']);


//Lecturer managing elearning content
Route::get('/lec_manage_marks_function',[controls5::class,'lec_manage_marks_function_page']);

//Lecturer managing elearning content
Route::get('/lec_elearning_content_management_page',[controls5::class,'lec_elearning_content_management_page']);

//Lecturer uploading new documnents to the database
Route::post('/upload_new_elearning_content',[controls5::class,'upload_new_elearning_content']);

//Lecturers can get their units data via this ;parameters are the unit code
Route::post('/lec_get_unit_content',[controls5::class,'lec_get_unit_content']);



//Students can view their course content ;parameters are the unit code
Route::get('/student_unit_content_page',[controls4::class,'student_unit_content_page']);

