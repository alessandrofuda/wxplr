<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->string('transaction_id',100)->nullable();
            $table->decimal('amount', 5, 2);
            $table->string('transaction_type',100)->comment = "credit, debit, refund etc.";
            $table->integer('payment_gateway_id')->unsigned()->comment = "payment gateway- Paypal, braintree etc.";
            $table->integer('payment_method_id')->unsigned()->comment = "credit card, paypal, cash etc.";
            $table->tinyInteger('order_status')->comment = "unpaid-0, paid-1, inprocess-2";
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('transactions');
    }
}
