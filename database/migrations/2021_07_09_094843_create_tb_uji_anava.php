<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbUjiAnava extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_uji_anava', function (Blueprint $table) {
            $table->id();
            $table->integer('x1');
            $table->integer('x2');
            $table->integer('x3');
            $table->integer('x4');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_uji_anava');
    }
}