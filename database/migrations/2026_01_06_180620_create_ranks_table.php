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
        Schema::create('ranks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->integer('level')->default(0);
            $table->decimal('minimum_sales', 15, 2)->default(0);
            $table->decimal('minimum_team_sales', 15, 2)->default(0);
            $table->integer('minimum_directs')->default(0);
            $table->decimal('bonus_amount', 15, 2)->default(0);
            $table->text('description')->nullable();
            $table->string('badge_icon')->nullable();
            $table->string('badge_color')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ranks');
    }
};
