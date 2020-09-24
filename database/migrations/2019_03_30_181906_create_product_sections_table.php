<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_sections', function (Blueprint $table) {
              $table->increments('id');
              $table->integer('productId');
              $table->text('hotDiscount')->nullable();
              $table->text('hotDate')->nullable();
              $table->text('specialDiscount')->nullable();
              $table->text('specialDate')->nullable();
              $table->text('multiImage')->nullable();
              $table->text('related_product')->nullable();
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
        Schema::dropIfExists('product_sections');
    }
}
