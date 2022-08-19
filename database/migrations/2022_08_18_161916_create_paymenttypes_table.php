<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymenttypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paymenttypes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('paymentname');
            $table->unsignedBigInteger('accountnumber');
            $table->string('accountname');
            $table->string('bank');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paymenttypes');
    }
}
