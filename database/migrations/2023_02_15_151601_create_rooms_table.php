<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('escape_id')->nullable(); 
            // $table->unsignedBigInteger('user_id');
            $table->integer('maxUsers');
            $table->time('init_time');
            $table->integer('points');
            $table->timestamps();
            
            $table->foreign('escape_id')
                    ->references('id')->on('escapes')
                    ->onDelete('cascade');
            // // $table->foreign('user_id')
            // ->references('id')->on('users')
            // ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
};
