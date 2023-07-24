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
        Schema::create('teacher_journal_selections', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->enum("status", ["izin","hadir", "bolos"]);


            $table->unsignedBigInteger('teacher_journal_id');
            $table->foreign('teacher_journal_id')->references('id')->on('teacher_journals')->onDelete("CASCADE");

            $table->unsignedBigInteger('student_active_id');
            $table->foreign('student_active_id')->references('id')->on('active_students')->onDelete("CASCADE");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_journal_selections');
    }
};
