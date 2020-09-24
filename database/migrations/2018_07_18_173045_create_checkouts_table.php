<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkouts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shipping_id')->length(10)->unsigned();
            $table->integer('customer_id')->length(10)->unsigned()->nullable(); //1 means not registerd
            $table->string('status')->default('pending'); //pending, shipping, ordered, delivered            
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('shipping_id')->references('id')->on('shippings')->onDelete('cascade');  
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checkouts');
    }
}
