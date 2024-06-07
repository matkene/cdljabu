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
        Schema::create('admissions', function (Blueprint $table) {
            $table->id();
            $table->string('formno');
            $table->string('name');
            $table->string('mphone');
            $table->string('state');
            $table->string('lga');
            $table->string('refno');
            $table->string('programme');            
            $table->foreignId('programme_id');
            //$table->foreign('programme_id')->references('id')->on('programmes');
            $table->string('level');
            $table->string('year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admissions');
    }
};
