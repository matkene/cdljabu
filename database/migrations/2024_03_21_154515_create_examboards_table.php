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
        Schema::create('examboards', function (Blueprint $table) {
            $table->id();
            $table->string('formno');
            $table->string('year');
            $table->string('examno');
            $table->string('center');
            $table->string('certificate');
            $table->foreignId('exam_id');
            $table->integer('no_ofsitting');           
            $table->foreignId('term_id');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examboards');
    }
};
