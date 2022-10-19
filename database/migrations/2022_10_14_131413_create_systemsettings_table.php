<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemsettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('systemsettings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('systemname')->nullable();
            $table->string('companyname')->nullable();
            $table->string('phonenumber')->nullable();
            $table->string('email')->nullable();
            $table->string('logo')->nullable();
            $table->string('flavicon')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('location')->nullable();
            $table->string('terms_and_conditions')->nullable();
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
        Schema::dropIfExists('systemsettings');
    }
}
