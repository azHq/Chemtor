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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('profile_image')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->unique();
            $table->string('parents_name')->nullable();
            $table->string('parents_number')->nullable();
            $table->unsignedBigInteger('institute_id');
            $table->foreign('institute_id')
                ->references('id')
                ->on('institutes')
                ->onDelete('cascade');
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')
                ->references('id')
                ->on('courses')
                ->onDelete('cascade');
            $table->unsignedBigInteger('batch_id')->nullable();
            $table->foreign('batch_id')
                ->references('id')
                ->on('batches')
                ->onDelete('cascade');
            $table->string('gender');
            $table->string('version');
            $table->string('blood_group')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('students');
    }
};
