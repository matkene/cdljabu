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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('term_id');
            $table->string('applno');
            $table->string('matric');
            $table->string('sname');
            $table->string('fname');
            $table->string('oname');            
            $table->foreignId('title_id');
            $table->foreignId('mode_id');
            $table->foreignId('gender_id');
            $table->string('dob');
            $table->foreignId('lga_id');
            $table->foreignId('state_id');
            $table->foreignId('country_id');            
            $table->string('address');
            $table->string('mphone');
            $table->string('mstatus');
            $table->string('spname');
            $table->string('nee');
            $table->string('dateofmarriage');
            $table->string('email');
            $table->foreignId('programme_id');
            $table->string('level');
            $table->string('passport');
            $table->foreignId('bloodgroup_id');
            $table->foreignId('religion_id');
            $table->foreignId('marital_id');
            $table->foreignId('relationship_id');
            $table->string('religion');
            $table->string('name_nok');
            $table->string('rel_nok');
            $table->string('address_nok');
            $table->string('mphone_nok');
            $table->string('email_nok');
            $table->string('course_duration');
            $table->string('year_ofentry');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
