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
        Schema::create('transactionlogs', function (Blueprint $table) {
            $table->id();
            $table->string('matric');
            $table->string('name');
            $table->integer('transactionid');
            $table->string('remita_reference');
            $table->string('transac_response');
            $table->integer('response_description');                    
            $table->string('transac_date');  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactionlogs');
    }
};
