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
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->after('email');
            $table->string('referral_code')->unique()->after('username');
            $table->foreignId('sponsor_id')->nullable()->after('referral_code')->constrained('users')->nullOnDelete();
            $table->foreignId('rank_id')->nullable()->after('sponsor_id')->constrained('ranks')->nullOnDelete();
            $table->enum('position', ['left', 'right'])->nullable()->after('rank_id');
            $table->string('phone')->nullable()->after('position');
            $table->date('date_of_birth')->nullable()->after('phone');
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active')->after('date_of_birth');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['sponsor_id']);
            $table->dropForeign(['rank_id']);
            $table->dropColumn([
                'username',
                'referral_code',
                'sponsor_id',
                'rank_id',
                'position',
                'phone',
                'date_of_birth',
                'status',
            ]);
        });
    }
};
