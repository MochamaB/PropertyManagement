<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSentemailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sentemails', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('lease_id');
            $table->string('item_id');
            $table->string('itemno');
            $table->string('mailto');
            $table->string('mailfrom');
            $table->string('recepientname');
            $table->timestamps();
             $table->foreign('lease_id')
                  ->references('lease_id')->on('lease')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sentemails');
    }
}
