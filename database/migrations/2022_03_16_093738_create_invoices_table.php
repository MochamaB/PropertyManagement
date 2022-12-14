<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoiceno');
            $table->unsignedBigInteger('lease_id');
            $table->string('utilitycategory_id');
            $table->string('parent_utility',600)->nullable();
            $table->string('invoicetype');
            $table->string('amountdue');
            $table->string('expensetype');
            $table->timestamp("duedate");
            $table->timestamp("invoicedate"); 
            $table->string('raised_by');
            $table->string('reviewed_by')->nullable();
            $table->timestamps();
            $table->foreign('lease_id')
                  ->references('lease_id')->on('lease')->onDelete('cascade');
            $table->foreign('utilitycategory_id')
                    ->references('utilitycategory_id')->on('utilitycategory')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
