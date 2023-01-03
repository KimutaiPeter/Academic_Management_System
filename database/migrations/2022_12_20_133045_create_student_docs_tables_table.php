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
        Schema::create('student_docs_tables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id');
            $table->string('type');
            $table->string('file_name');
            $table->string('normal_file_name');
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
        Schema::dropIfExists('student_docs_tables');
    }
};
