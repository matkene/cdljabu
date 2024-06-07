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
        Schema::create('studentcourses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('programme_id');
            $table->foreignId('course_id');
            $table->foreignId('crsid');
            $table->string('matric');
            $table->string('term');
            $table->string('level');
            $table->string('semester');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studentcourses');
    }
};
