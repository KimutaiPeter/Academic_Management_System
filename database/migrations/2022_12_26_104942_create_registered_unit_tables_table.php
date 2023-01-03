<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registered_unit_tables', function (Blueprint $table) {
            $table->increments('id');
            $table->string('student_id');
            $table->string('unit_code');
            $table->string('unit_name');
            $table->string('status');
            $table->string('course_work')->nullable();
            $table->string('exam_mark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registered_unit_tables');
    }
};
