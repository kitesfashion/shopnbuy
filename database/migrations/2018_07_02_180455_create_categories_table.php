<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id',10);
            $table->string('categoryName',100);
            $table->text('categoryImage')->nullable();
            $table->boolean('categoryStatus')->default(1);
            $table->text('parent')->nullable();
            $table->text('metaTitle')->nullable();
            $table->text('metaKeyword')->nullable();
            $table->text('metaDescription')->nullable();
            $table->integer('orderBy')->nullable();
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
        Schema::dropIfExists('categories');
    }
}
