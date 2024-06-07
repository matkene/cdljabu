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
        Schema::create('transactcodes', function (Blueprint $table) {
            $table->id();
            $table->string('matric');
            $table->string('level');
            $table->foreignId('programme_id');
            $table->string('semester');
            $table->string('type');
            $table->foreignId('term_id');                    
            $table->string('pin');
            $table->string('rrr');           
            $table->string('amount');           
            $table->string('tistatus');
            $table->string('gescat');           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactcodes');
    }
};
