<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controls;
use App\Http\Controllers\controls2;


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

Route::get('/',[Controls::class,'index_page']);

Route::get('/sign_up',[Controls::class,'signup_page']);
Route::get('/sign_in',[Controls::class,'signin_page']);
Route::get('/login_page',[Controls::class,'signin_page']);
Route::get('/logout',[Controls::class,'logout']);

Route::get('/enrollment_page',[Controls::class,'enrollment_page']);

Route::post('/regestration_process',[Controls::class,'regestration_process']);

Route::post('/login_process',[Controls::class,'login_process'])-> name('login_process');

Route::post('/staff_login_process',[Controls::class,'staff_login_process']);

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




