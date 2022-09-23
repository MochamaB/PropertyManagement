<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lease', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('apartment_id');
            $table->unsignedBigInteger('house_id');
            $table->unsignedBigInteger('tenant_id');
            $table->string('leaseno');
            $table->decimal('deposit');
            $table->decimal('rent');
            $table->decimal('discount')->nullable();
            $table->timestamp("startdate")->nullable();
            $table->timestamp("enddate")->nullable();
            $table->string('status');
            $table->text('terms')->nullable();
            $table->timestamps();
            $table->foreign('apartment_id')
            ->references('apartment_id')->on('apartment')->onDelete('cascade');
             $table->foreign('house_id')
                  ->references('house_id')->on('houses')->onDelete('cascade');
             $table->foreign('tenant_id')
                  ->references('tenant_id')->on('tenants')->onDelete('cascade');
                 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lease');
    }
}
