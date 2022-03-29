<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_entries', function (Blueprint $table) {
            $table->id();
            $table->string('user_id',16);
            $table->string('recruitment_id',13);
            $table->string('comment');
            $table->integer('status')->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('recruitment_id')->references('id')->on('recruitments')->onDelete('cascade')->onUpdate('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   
        Schema::dropForeign('user_id');
        Schema::dropForeign('recruitment_id');
        Schema::dropIfExists('user_entries');
    }
}
