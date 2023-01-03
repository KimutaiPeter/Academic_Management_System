<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\unit_table;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_tables', function (Blueprint $table) {
            $table->increments('id');
            $table->string('year');
            $table->string('semester');
            $table->string('course');
            $table->string('unit_code');
            $table->string('name');
            $table->string('lecturer_id')->nullable();
            $table->string('lecturer')->nullable();
            $table->timestamps();
        });


        $this->post_insert();
    }




    public function post_insert(){
        $units=array(
            1=>array(1=>array('Discrete Mathematics','Calculus I'),2=>array('Chemistry','Introduction to Computer Systems')),
            2=>array(1=>array('Computer Organisation','Introduction to Computer Programming'),2=>array('Communication Skills','Calculus II')),
            3=>array(1=>array('Probability and Statistics I','Physics'),2=>array('Introduction to Systems Programming','Object Oriented Programming I')),
            4=>array(1=>array('Data Structures and Algorithms','Discrete Structures I'),2=>array('Artificial Intelligence','Commercial Programming')),
        );
        


        foreach ($units as $year=>$year_units){
            foreach($year_units as $semester => $semester_units){
                foreach($semester_units as $unit){
                    $new_entry= new unit_table;
                    $new_entry->year=strval($year);
                    $new_entry->semester=strval($semester);
                    $new_entry->course='ICS';
                    $new_entry->unit_code=strval($year).strval($semester).strval(array_search($unit,$semester_units))."ICS";
                    $new_entry->name=$unit;
                    $new_entry->save();
                }
            }
        }
    }







    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unit_tables');
    }
};
