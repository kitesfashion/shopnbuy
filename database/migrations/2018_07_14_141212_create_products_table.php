<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id',10);
            $table->integer('category_id')->length(10)->unsigned();
            $table->integer('root_category')->length(10)->unsigned();
            $table->string('name',100);
            $table->text('description1')->nullable();
            $table->text('description2')->nullable();
            $table->string('deal_code',100)->nullable();
            $table->string('phone_no',100)->nullable();
            $table->text('image')->nullable();
            $table->text('image2')->nullable();
            $table->integer('qty')->length(10)->unsigned()->nullable()->default(1);
            $table->string('weight',100)->nullable();
            $table->text('price');
            $table->double('discount', 8, 2)->default(0)->nullable();
            $table->boolean('status')->default(0);
            $table->text('productSection')->nullable();
            $table->text('tag')->nullable();
            $table->text('metaTitle')->nullable();
            $table->text('metaKeyword')->nullable();
            $table->text('metaDescription')->nullable();
            $table->integer('orderBy')->nullable();
            $table->timestamps();

           // $table->foreign('sub_category_id')->references('id')->on('sub_categories')->onDelete('cascade');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
