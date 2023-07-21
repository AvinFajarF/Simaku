<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('teacher_journals', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("date");
            $table->string("class");
            $table->string("at_hour");
            $table->string("subject");
            $table->string("description");
            $table->string("student_note");
            $table->string("student_attend")->nullable();
            $table->string("student_not_attend")->nullable();


            $table->unsignedBigInteger('teacher_id');
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete("CASCADE");

            $table->unsignedBigInteger('subject_id');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete("CASCADE");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_journals');
    }
};
