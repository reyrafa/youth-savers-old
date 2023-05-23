<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guardians', function (Blueprint $table) {
            $table->id();
            $table->integer('depositor_id'); 
           // $table->integer('user_id')->unsigned();   
            $table->string('guardian_firstname')->nullable();
            $table->string('guardian_lastname')->nullable();
            $table->string('guardian_middlename')->nullable();
            $table->string('guardian_suffix')->nullable();
            $table->date('guardian_date_of_birth')->nullable();
            $table->string('guardian_gender')->nullable();
            $table->string('guardian_relationship_to_depositor')->nullable();
            $table->string('guardian_civil_status')->nullable();
            $table->string('guardian_oic_member')->nullable();
            $table->string('guardian_home_address')->nullable();
            $table->string('guardian_present_address')->nullable();
            $table->string('guardian_contact_no')->nullable();
            $table->string('guardian_email_add')->nullable();
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guardians');
    }
};
