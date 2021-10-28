<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        // コメント機能用データベース
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->integer('recruitment_id');
            $table->string('user_id');
            $table->string('comments',255);
            $table->integer('delete_flag')->default(0);
            $table->timestamps();

            $table->foreign('recruitment_id')->references('id')->on('recruitments')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
        Schema::dropIfExists('user_entry');
        Schema::dropIfExists('recruitments');
    }
}
