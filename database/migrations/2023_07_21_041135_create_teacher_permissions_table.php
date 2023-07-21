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
        Schema::create('teacher_permissions', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("date");
            $table->string('class');
            $table->string("at_hour");
            $table->enum("type", ["dinas", "non-dinas"]);
            $table->string("room");
            $table->string("task_instruction");
            $table->string("task_file");

            $table->unsignedBigInteger('teacher_id');
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete("CASCADE");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_permissions');
    }
};
