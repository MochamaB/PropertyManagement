<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
           $table->increments('id');
            $table->unsignedBigInteger('invoice_id');
            $table->unsignedBigInteger('lease_id');
            $table->string('invoiceno');
            $table->string('paymentitem');
            $table->string('receiptno');
            $table->string('paymenttype_id');
            $table->string('payment_code')->nullable();
            $table->decimal('amountpaid');
            $table->string('received_by');
            $table->string('reviewed_by')->nullable();
            $table->timestamp("invoicedate"); 
            $table->timestamps();
            $table->foreign('invoice_id')
                  ->references('invoice_id')->on('invoices')->onDelete('cascade');
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
        Schema::dropIfExists('payments');
    }
}
