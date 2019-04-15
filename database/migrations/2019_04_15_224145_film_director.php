<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FilmDirector extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films_directors',function(Blueprint $table) {
            $table->integer('film_id');
            $table->integer('director_id');
            //$table->foreign('film_id')->references('id')->on('films');
            //$table->foreign('director_id')->references('id')->on('directors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
