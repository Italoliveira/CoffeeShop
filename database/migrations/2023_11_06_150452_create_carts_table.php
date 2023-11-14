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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user')->nullable();
            $table->unsignedBigInteger('product');
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {   
         Schema::table('carts', function(Blueprint $table){

            $table->dropForeign(['user']);

        });

        Schema::table('carts', function(Blueprint $table){

            $table->dropForeign(['product']);

        });

        Schema::dropIfExists('carts');
    }
};
