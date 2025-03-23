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
            $table->uuid('id')->primary();
            $table->string('name');
            $table->text('images');
            $table->double('discount')->default(0);
            $table->double('price');
            $table->longText('description');
            $table->string('discount_type')->default('percentage');
            $table->text('ingredients')->nullable();
            $table->integer('shipping_cost');
            $table->longText('benefit')->nullable();
            $table->foreignUuid('seller_id')->constrained('users')->cascadeOnDelete();
            $table->unsignedInteger('likes')->default(0);
            $table->foreignUuid('brand_id')->constrained('brands')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
