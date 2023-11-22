<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('adresses', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('user');
            $table->string('street');
            $table->integer('number');
            $table->string('city');
            $table->string('neighborhood');
            $table->string('state');
            $table->timestamps();

            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */

    public function down(): void
    {   
        Schema::table('adresses', function(Blueprint $table){

            $table->dropForeign(['user']);

        });

        Schema::dropIfExists('adresses');
    }
};
