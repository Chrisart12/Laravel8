<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_user', function (Blueprint $table) {
            // $table->id();
            $table->increments('id');
            $table->integer('pay_id')->unsigned();
            $table->foreign('pay_id')->references('id')
                                        ->on('pays')
                                        ->onDelete('restrict')
                                        ->onUpdate('restrict');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')
                                        ->on('users')
                                        ->onDelete('restrict')
                                        ->onUpdate('restrict');
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
        Schema::dropIfExists('pay_user');
    }
}
