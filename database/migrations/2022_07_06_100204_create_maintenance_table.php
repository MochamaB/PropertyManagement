<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintenanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenance', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('lease_id');
            $table->unsignedBigInteger('userrequest_id')->nullable();
            $table->string('maintenanceno');
            $table->string('priority');
            $table->string('billtype');
            $table->string('title');
            $table->string('description');
            $table->text('raisedby')->nullable();
            $table->timestamps();
            $table->foreign('lease_id')
                  ->references('lease_id')->on('lease')->onDelete('cascade');
            $table->foreign('userrequest_id')
                  ->references('userrequest_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maintenance');
    }
}
