<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('variants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->string('title');
            $table->string('option1')->nullable();
            $table->string('option2')->nullable();
            $table->double('price');
            $table->integer('stock');
            $table->boolean('is_in_stock')->default(true);
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

        // After creating the variants table, update the products table to add the foreign key
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('default_variant_id')->references('id')->on('variants')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['default_variant_id']);
        });
        
        Schema::dropIfExists('variants');
    }
};