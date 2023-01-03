<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\staff_table;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_tables', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fname');
            $table->string('lname');
            $table->string('religion');
            $table->string('nationality');
            $table->string('email');
            $table->string('phone');
            $table->string('status');
            $table->string('password');
            $table->string('department');
            $table->timestamps();
        });


        $this->post_insert();
    }


    public function post_insert(){
        $new_entry= new staff_table;
        $new_entry->fname='boss';
        $new_entry->lname='jefe';
        $new_entry->religion='christian';
        $new_entry->nationality="kenyan";
        $new_entry->email='boss.jefe@gmail.com';
        $new_entry->phone='1234567890';
        $new_entry->status="active";
        $new_entry->password="123";
        $new_entry->department='HR';
        $new_entry->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff_tables');
    }
};
