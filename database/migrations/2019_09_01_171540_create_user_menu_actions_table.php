<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserMenuActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_menu_actions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parentmenuId')->length(11);
            $table->integer('menuType')->length(11);
            $table->string('actionName',100);
            $table->string('actionLink',100);
            $table->integer('orderBy')->length(11);
            $table->integer('actionStatus')->length(11);
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
        Schema::dropIfExists('user_menu_actions');
    }
}
