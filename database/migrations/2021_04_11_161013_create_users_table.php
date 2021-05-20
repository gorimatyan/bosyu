<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->integer('number')->autoIncrement();
            $table->string('id',16);
            $table->string('password');
            $table->string('name',12);
            $table->string('email');
            $table->string('image')->nullable();
            $table->integer('gender')->nullable();
            $table->string('user_description',1000);
            $table->integer('bosyu')->nullable();
            $table->integer('entry')->nullable();
            $table->integer('favorite')->nullable();
            $table->integer('delete_flag')->default(1);
            $table->timestamps();
        });
    }

//     Schema::create('users', function (Blueprint $table) {
//         $table->integer('number')->autoIncrement();
//         $table->string('id',12);
//         $table->string('password',8,16);
//         $table->string('name',12);
//         $table->string('picture');
//         $table->integer('gender');
//         $table->string('user_description',1000);
//         $table->integer('bosyu')->autoIncrement();
//         $table->integer('entry')->autoIncrement();
//         $table->integer('favorite')->autoIncrement();
//         $table->integer('delete_flag');
//         $table->timestamps();
//     });
// }

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
