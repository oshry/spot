<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Requests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->increments('id', true);
            $table->integer('status_id')->unsigned();
            $table->integer('code');
            $table->integer('percent');
            $table->timestamps();
        });


//        Schema::table('requests', function($table) {
//            $table->foreign('status_id')->references('status')->on('status');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("requests");
    }
}
