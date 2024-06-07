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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('formno');
            $table->integer('title_id');
            $table->string('sname');
            $table->string('fname');
            $table->string('oname');
            $table->string('maiden');
            $table->string('dob');
            $table->foreignId('mode_id');            
            $table->foreignId('gender_id');  
            $table->foreignId('lga_id'); 
            $table->foreignId('state_id');           
            $table->foreignId('country_id');
            $table->string('address');
            $table->string('states');
            $table->string('city');
            $table->string('mphone');            
            $table->foreignId('marital_id');        
            $table->foreignId('bloodgroup_id');            
            $table->foreignId('religion_id');            
            $table->string('email');
            $table->string('place_ofbirth');            
            $table->foreignId('programme_id');                     
            $table->string('passport');
            $table->string('year_ofentry');           
            $table->string('sname_nok');
            $table->string('fname_nok');
            $table->string('oname_nok');
            $table->string('rel_nok');
            $table->string('address_nok');
            $table->string('mphone_nok');
            $table->string('email_nok');
            $table->string('submitted');
            $table->string('accepted');
            $table->string('admletter');
            $table->string('printslip');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
