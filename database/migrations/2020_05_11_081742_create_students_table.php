<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('nis')->unique();
            $table->string('name');
            $table->string('address');
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('school_id');
            $table->char('gender',1)->comment('L : Laki-Laki','P : Perempuan');
            $table->string('school_years');
            $table->timestamps();
            $table->foreign('school_id')->references('id')->on('schools');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
