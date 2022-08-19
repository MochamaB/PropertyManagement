<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepairworkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repairwork', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('maintenance_id');
            $table->string('Workid');
            $table->timestamp('dateofrepair')->nullable();
            $table->string('suppliesused')->nullable();
            $table->string('descworkdone')->nullable();
            $table->string('recommendations')->nullable();
            $table->text('amountspent')->nullable();
            $table->text('amountpaid')->nullable();
            $table->string('status');
            $table->string('assignedto')->nullable();
            $table->text('assignedby')->nullable();
            $table->timestamps();
             $table->foreign('maintenance_id')
                  ->references('maintenance_id')->on('maintenance')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repairwork');
    }
}
