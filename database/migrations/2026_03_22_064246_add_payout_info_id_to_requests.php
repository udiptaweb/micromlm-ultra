<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payout_requests', function (Blueprint $table) {
            // Links back to which saved payout account was used
            // Nullable so existing requests without an account still work
            $table->foreignId('payout_info_id')
                ->nullable()
                ->after('method')
                ->constrained('payout_infos')
                ->nullOnDelete(); // if account is deleted, keep the request
        });
    }
 
    public function down(): void
    {
        Schema::table('payout_requests', function (Blueprint $table) {
            $table->dropForeignIdFor(\App\Models\PayoutInfo::class, 'payout_info_id');
            $table->dropColumn('payout_info_id');
        });
    }
};
