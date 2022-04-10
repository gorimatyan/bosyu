<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_notices', function (Blueprint $table) {
            $table->id();
            $table->string('from_user',16);
            $table->string('to_user',16);
            $table->string('recruitment_id')->nullable();
            $table->string('waiting_people_id')->nullable();
            $table->integer('status')->default(0);
            $table->integer('notice_type');
            $table->string('message')->nullable();
            $table->timestamps();

            $table->foreign('from_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('to_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // 外部キーを外す
        Schema::dropForeign('from_user');
        Schema::dropForeign('to_user');
        Schema::dropIfExists('new_notices');
    }
}
