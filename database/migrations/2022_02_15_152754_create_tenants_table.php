<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id')->nullable();
            $table->string('idnumber',100); 
            $table->string('firstname',100);
            $table->string('lastname',100);
            $table->string('email',100)->unique();
            $table->string('phonenumber',100);
            $table->string('occupation',100)->nullable();
            $table->string('company',100)->nullable();
            $table->string('emergencyname',100)->nullable();
            $table->string('emergencynumber',100)->nullable();
            $table->string('status',100);
            $table->string('apartment_id',100);
            $table->timestamps();
             $table->foreign('user_id')
                  ->references('user_id')->on('users')->onDelete('cascade');
                  }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenants');
    }
}
