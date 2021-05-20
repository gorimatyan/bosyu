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
        Schema::create('recruitments', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('user_id',12);
            $table->string('user_name',12);
            $table->string('title',100);
            $table->integer('people');
            $table->integer('people_option');
            $table->date('deadline');
            $table->string('image')->nullable();
            $table->string('description',1000);
            $table->integer('delete_flag');
            $table->timestamps();

            
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
