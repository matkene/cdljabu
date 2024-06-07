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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('programme_id'); //another way
            $table->foreignId('term_id');
            $table->string('crsid');
            $table->string('crsdesc');
            $table->string('unit');
            $table->string('level');
            $table->string('remark');
            $table->string('semester');
            $table->integer('status');
            $table->integer('user_id');
            //$table->foreign('programme_id')->references('id')->on('programmes');             
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
