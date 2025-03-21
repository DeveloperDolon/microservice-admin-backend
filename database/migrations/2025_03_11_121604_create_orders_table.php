<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('user_id');
            $table->enum('status', ['pending', 'processing', 'completed', 'cancelled'])->default('pending');
            $table->enum('payment_method', ['cash_on_delivery', 'credit_card', 'paypal', 'online_pay'])->default('cash_on_delivery');
            $table->double('total_price');
            $table->double('discount')->default(0);
            $table->double('shipping_cost');
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');
            $table->string('address_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
