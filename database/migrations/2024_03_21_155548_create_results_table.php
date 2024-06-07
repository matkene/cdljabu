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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->string('matric');
            $table->string('crsid');
            $table->string('level');
            $table->string('semester');
            $table->string('others');
            $table->foreignId('term_id');
            $table->foreignId('programme_id');
            $table->foreignId('course_id');
            $table->string('grade_ids');
            $table->string('mark_total');
            $table->string('mark_score');           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
