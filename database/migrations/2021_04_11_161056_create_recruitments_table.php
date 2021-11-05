<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecruitmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //　投稿（募集）のテーブル
        Schema::create('recruitments', function (Blueprint $table) {
            $table->string('id',13)->primary();
            $table->string('user_id',16);
            $table->string('title',100);
            $table->string('body',1000);
            $table->integer('status')->default(0);
            $table->integer('number_of_people');
            $table->date('deadline');
            $table->integer('delete_flag')->default(0);
            $table->timestamps();


            $table->foreign('user_id',16)->references('id')->on('users')->onDelete('cascade');
            
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   
        Schema::dropIfExists('recruitments');

    }
}
