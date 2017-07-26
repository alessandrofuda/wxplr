<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('user_address_id')->unsigned();
            $table->integer('item_id')->unsigned();
            $table->string('item_name');
            $table->string('item_type',100)->comment = "service, video etc.";
            $table->decimal('item_amount', 5, 2);
            $table->longText('comment')->nullable();
            $table->enum('approved', [0, 1])->comment = "admin approval for order-0/1";
            $table->softDeletes();
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
        Schema::drop('orders');
    }
}
