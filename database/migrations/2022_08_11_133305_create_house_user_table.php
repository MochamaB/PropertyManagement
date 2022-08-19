<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHouseUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_user', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('house_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();
            $table->foreign('house_id')
            ->references('house_id')->on('houses')->onDelete('cascade');
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
        Schema::dropIfExists('house_user');
    }
}
