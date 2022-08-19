<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUtilitiesassignedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('utilitiesassigned', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('leaseid');
            $table->unsignedBigInteger('utilitycategoryid');
            $table->timestamps();
                $table->foreign('leaseid')
                  ->references('leaseid')->on('lease')->onDelete('cascade');
                  $table->foreign('utilitycategoryid')
                  ->references('utilitycategoryid')->on('utilitycategory')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('utilitiesassigned');
    }
}
