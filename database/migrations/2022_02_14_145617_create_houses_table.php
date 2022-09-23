<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('housecategoryid');
            $table->string('housenumber',100);
            $table->string('title')->nullable();
            $table->text('description',200)->nullable();
            $table->string('meternumber',100)->nullable();
            $table->string('status',100);
            $table->timestamps();
            $table->foreign('housecategoryid')
                  ->references('housecategoryid')->on('housecategories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('houses');
    }
}
