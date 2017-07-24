<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('username');
            $table->string('email')->unique();
            $table->string('password');
            $table->Integer('role_id')->unsigned()->default(1);
            $table->rememberToken();
            $table->timestamp('last_login');
            $table->timestamps();
        });

        Schema::table('users', function($table) {
           $table->foreign('role_id')->references('id')->on('roles');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
