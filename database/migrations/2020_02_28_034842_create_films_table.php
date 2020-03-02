<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('other_name')->nullable();
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->string('background')->nullable();
            $table->text('description')->nullable();
            $table->integer('all_episode')->nullable();
            $table->integer('year_release')->nullable();
            $table->bigInteger('view')->default(0);
            $table->date('uptop')->nullable();

            $table->unsignedBigInteger('type_id')->nullable();
            $table->foreign('type_id')->references('id')->on('types');
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
        Schema::dropIfExists('films');
    }
}
