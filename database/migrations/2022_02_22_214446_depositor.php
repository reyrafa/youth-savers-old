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
     
        Schema::create('depositors', function (Blueprint $table) {
            $table->id();
            $table->integer('depositor_id'); 
           // $table->integer('user_id')->unsigned();   
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('middlename')->nullable();
            $table->string('suffix')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('home_address')->nullable();
            $table->string('contact_no')->nullable();
            $table->integer('branch_id');
            $table->integer('branch_under_id');
            $table->integer('referral_id')->nullable();
            $table->timestamps();
            
        });
        // Schema::table('depositors', function(Blueprint $table){
        //    $table->foreign('branch_id')->references('branch_id')->on('branch');
        //});
      //  Schema::table('depositors', function(Blueprint $table){
      //      $table->foreign('depositor_id')->references('id')->on('users');
      //  });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('depositors');
       
    }
};
