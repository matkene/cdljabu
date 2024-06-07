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
        Schema::create('feespayments', function (Blueprint $table) {
            $table->id();
            $table->string('pin');
            $table->string('applno');
            $table->string('matric');
            $table->foreignId('term_id');
            $table->foreignId('programme_id');
            $table->string('level');
            $table->string('type');
            $table->string('semester');            
            $table->string('amtpaid');
            $table->string('amtdue');
            $table->string('relvant');                                  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feespayments');
    }
};
