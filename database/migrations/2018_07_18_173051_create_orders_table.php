<?php

use Illuminate\Support\Facades\Schema;
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
            $table->integer('checkout_id')->length(10)->unsigned();
            $table->integer('product_id')->length(10)->unsigned();
            $table->integer('qty')->length(10)->unsigned();
            $table->string('weight',100);
            $table->double('price', 8, 2);
            $table->double('discount', 8, 2)->default(0)->nullable();
            $table->timestamps();

            $table->foreign('checkout_id')->references('id')->on('checkouts')->onDelete('cascade');  
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
