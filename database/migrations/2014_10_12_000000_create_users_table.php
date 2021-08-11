<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email', 200)->unique();
            $table->string('matric_number', 200)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('avatar')->nullable();
            $table->string('mobile')->nullable();
            $table->integer('level_id')->nullable();
            $table->integer('course_id')->nullable();
            $table->integer('semester_id')->nullable();
            $table->integer('faculty_id')->nullable();
            $table->integer('dept_id')->nullable();
            $table->enum('role', ['Admin', 'Lecturer', 'Student'])->default('Student');
            $table->enum('status', ['Active', 'Blocked'])->default('Active');
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
