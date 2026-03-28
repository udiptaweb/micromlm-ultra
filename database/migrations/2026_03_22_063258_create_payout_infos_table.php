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
        Schema::create('payout_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Which method this record covers
            $table->enum('method', ['bank', 'upi', 'crypto']);

            // Common
            $table->string('label')->nullable();        // e.g. "My SBI Account", "Personal UPI"
            $table->boolean('is_default')->default(false);

            // ── Bank Transfer ──────────────────────────────────────
            $table->string('bank_name')->nullable();
            $table->string('account_holder')->nullable();
            $table->string('account_number')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('branch')->nullable();

            // ── UPI ────────────────────────────────────────────────
            $table->string('upi_id')->nullable();       // e.g. priya@paytm

            // ── Crypto ────────────────────────────────────────────
            $table->string('crypto_network')->nullable(); // BTC, ETH, TRX, BNB …
            $table->string('wallet_address')->nullable();

            $table->timestamps();

            // One default per method per user
            $table->index(['user_id', 'method']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payout_infos');
    }
};
