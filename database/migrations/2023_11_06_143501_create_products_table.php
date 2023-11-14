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
        Schema::create('products', function (Blueprint $table) {

            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price',8,2);
            $table->string('image')->nullable();
            $table->timestamps();
            $table->string('quantity_unit');
            $table->string('status');
            $table->unsignedBigInteger('category');

            $table->foreign('category')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function(Blueprint $table){

            $table->dropForeign(['category']);

        });

        Schema::dropIfExists('products');
    }
};
