<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartment', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('apartmentno')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('postalcode')->nullable();
            $table->string('tel')->nullable();
            $table->string('logo')->nullable();
            $table->string('location')->nullable();
            $table->string('authorized_person')->nullable();
            $table->string('signature_photo')->nullable();
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
        Schema::dropIfExists('apartment');
    }
}
