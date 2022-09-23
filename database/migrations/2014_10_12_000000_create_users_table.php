<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phonenumber',100)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('profpic')->nullable();
            $table->string('apartment_id')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
