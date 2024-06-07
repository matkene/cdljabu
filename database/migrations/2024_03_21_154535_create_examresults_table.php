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
        Schema::create('examresults', function (Blueprint $table) {
            $table->id();
            $table->string('formno');
            $table->string('examno');
            $table->integer('exam_id');           
            $table->foreignId('subject_id');            
            $table->foreignId('grader_id');            
            $table->string('status');
            $table->integer('no_ofsitting');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examresults');
    }
};
