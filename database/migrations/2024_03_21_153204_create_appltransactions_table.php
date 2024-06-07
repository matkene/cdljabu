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
        Schema::create('appltransactions', function (Blueprint $table) {
            $table->id();
            $table->string('formno');
            $table->string('sname');
            $table->string('fname');
            $table->string('oname');
            $table->string('paymentcode');
            $table->string('rrr');
            $table->string('transac_response');            
            $table->string('transac_date');
            $table->string('transac_info'); 
            $table->string('amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appltransactions');
    }
};
