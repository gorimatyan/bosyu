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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('recruitment_id',13);
            $table->unsignedBigInteger('user_id');
            $table->string('comment',255);
            $table->integer('delete_flag')->default(0);
            $table->timestamps();

           $table->foreign('recruitment_id')->references('id')->on('recruitments')->onDelete('cascade')->onUpdate('cascade');
           $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign('user_id');
            $table->dropForeign('recruitment_id');
            $table->dropIfExists('comments');
        });
        // Schema::dropForeign('user_id');
        // Schema::dropForeign('recruitment_id');
        // Schema::dropIfExists('comments');
    }
}
