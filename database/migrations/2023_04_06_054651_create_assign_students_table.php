<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('assign_students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id')->comment('user_id=student_id');
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('year_id');
            $table->unsignedBigInteger('group_id')->nullable();
            $table->unsignedBigInteger('shift_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assign_students');
    }
};
