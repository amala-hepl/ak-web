<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_gateway_settings', function (Blueprint $table) {
            $table->id();
            $table->string('gateway_name')->default('stripe');
            $table->string('stripe_key');
            $table->string('stripe_secret');
            $table->string('stripe_webhook_secret')->nullable();
            $table->enum('mode', ['sandbox', 'live'])->default('sandbox');
            $table->boolean('is_active')->default(true);
            $table->text('webhook_url')->nullable();
            $table->json('additional_settings')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_gateway_settings');
    }
};