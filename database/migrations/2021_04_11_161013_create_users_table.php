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
        //　ユーザーのテーブル
        Schema::create('users', function (Blueprint $table) {
            $table->id('id');
            $table->string('password',255);
            $table->string('user_name')->unique();
            $table->string('nickname',12)->nullable();
            $table->string('email')->unique();
            $table->integer('email_status')->value(0);
            $table->string('image');
            $table->integer('gender')->nullable();
            $table->integer('login_days')->default(0);
            $table->date('created_day')->default(now());
            $table->string('self_introduction',1000)->nullable();
            $table->integer('delete_flag')->default(0);
            $table->string('remember_token',100)->nullable();
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
        Schema::dropIfExists('comments');
        Schema::dropIfExists('recruitments');
        Schema::dropIfExists('users');
    }
}
