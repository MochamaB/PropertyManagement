<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHousecategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('housecategories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('apartment_id');
            $table->string('type',100);
            $table->decimal('price')->nullable();
            $table->decimal('rent');
            $table->decimal('setdeposit');
            $table->string('description',100)->nullable();
            $table->timestamps();
            $table->foreign('apartment_id')
            ->references('apartment_id')->on('apartments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('housecategories');
    }
}
