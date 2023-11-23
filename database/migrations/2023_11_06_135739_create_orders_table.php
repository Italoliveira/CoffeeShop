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
        Schema::create('orders', function (Blueprint $table) {
            
            $table->id();
            $table->unsignedBigInteger('user');
            $table->decimal('total',8,2);
            $table->string('status');
            $table->string('payment');
            $table->unsignedBigInteger('adress');
            $table->timestamps();
            $table->foreign('adress')->references('id')->on('adresses')->onDelete('cascade');
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function(Blueprint $table){

            $table->dropForeign(['adress']);

        });

        Schema::table('orders', function(Blueprint $table){

            $table->dropForeign(['user']);

        });

        Schema::dropIfExists('orders');
    }
};
