<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTodolistitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todolistitems', function (Blueprint $table) {
            $table->increments('id');
            $table->string('task', 250);
            $table->unsignedInteger('todolist_id');
            $table->foreign('todolist_id')->references('id')->on('todolists');
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
        Schema::dropIfExists('todolistitems');
    }
}
