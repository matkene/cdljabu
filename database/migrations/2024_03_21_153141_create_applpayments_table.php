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
        Schema::create('applpayments', function (Blueprint $table) {
            $table->id();
            $table->string('formno');
            $table->string('sname');
            $table->string('fname');
            $table->string('oname');
            $table->string('mphone');
            $table->string('email');
            $table->integer('term_id');
            $table->integer('status');
            $table->string('paymentcode');
            $table->string('amount');
            $table->string('rrr');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applpayments');
    }
};
