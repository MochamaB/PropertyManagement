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
            $table->string('paymentname');
            $table->string('accountnumber');
            $table->string('accountname');
            $table->string('bank');
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
        Schema::dropIfExists('paymenttypes');
    }
}
