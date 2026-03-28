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
        Schema::create('e_pins', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // The actual PIN (e.g., ABC-123-XYZ)
            $table->decimal('amount', 15, 2);
            $table->foreignId('created_by')->constrained('users'); // Admin who generated it
            $table->foreignId('used_by')->nullable()->constrained('users'); // Member who used it
            $table->foreignId('assigned_to')->nullable()->constrained('users'); // Member who used it
            $table->timestamp('used_at')->nullable();
            $table->enum('status', ['active', 'used', 'expired'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('e_pins');
    }
};
