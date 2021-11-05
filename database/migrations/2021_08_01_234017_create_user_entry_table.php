<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserEntryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // ユーザーが参加している募集
        Schema::create('user_entry', function (Blueprint $table) {
            $table->id();
            $table->integer('recruitment_id');
            $table->string('user_id');
            $table->integer('status')->default(0);
            $table->timestamps();

            // $table->foreign('recruitment_id')->references('id')->on('recruitments')->onDelete('cascade');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   
        Schema::dropIfExists('user_entry');
        Schema::dropIfExists('recruitments');
        Schema::dropIfExists('users');
    }
}
