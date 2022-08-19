<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReadingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('readings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('utilitycategory_id');
            $table->unsignedBigInteger('lease_id');
            $table->string('meternumber')->nullable();
            $table->string('recordno');
            $table->decimal('initialreading');
            $table->decimal('lastreading');
            $table->decimal("currentreading");
            $table->timestamp("fromdate"); 
            $table->timestamp('todate');
            $table->string('recorded_by')->nullable();
            $table->timestamps();
            $table->foreign('utilitycategory_id')
                  ->references('utilitycategory_id')->on('utilitycategory')->onDelete('cascade');
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
        Schema::dropIfExists('readings');
    }
}
