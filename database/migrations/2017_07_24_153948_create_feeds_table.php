<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feeds', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('event_id')->unsigned()->nullable();
            $table->integer('feedable_id');
            $table->string('feedable_type');
            $table->integer('user_id');
            $table->timestamps();
        });

        Schema::table('feeds', function($table) {
           $table->foreign('event_id')->references('id')->on('events');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feeds');
    }
}
