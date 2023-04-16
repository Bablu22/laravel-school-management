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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->string('password');
            $table->string('address')->nullable();
            $table->string('gender')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('religion')->nullable();
            $table->string('id_no')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('code')->nullable();
            $table->string('roll')->nullable();
            $table->date('join_date')->nullable();
            $table->unsignedBigInteger('designation_id')->nullable();
            $table->double('salary')->nullable();
            $table->string('usertype')->nullable()->comment('Student,Employee,Admin');
            $table->string('role')->nullable()->comment('admin=head of the software, operator=computer operator, user=employee');
            $table->boolean('status')->default(1);
            $table->string('profile_photo_path', 2048)->nullable();
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

