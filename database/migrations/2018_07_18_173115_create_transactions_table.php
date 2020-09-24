<?php

use Illuminate\Support\Facades\Schema;
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
            $table->integer('checkout_id')->length(10)->unsigned();
            $table->double('total', 8, 2);
            $table->string('method')->default('cod');
            $table->string('reference')->nullable();
            $table->double('payment', 8, 2);
            $table->string('status')->default('pending');
            $table->timestamps();

            $table->foreign('checkout_id')->references('id')->on('checkouts')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
