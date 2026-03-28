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
            $table->integer('binary_parent_id')->nullable()->after('rank_id');
            $table->renameColumn('position', 'binary_position');
            $table->integer('matrix_parent_id')->nullable()->after('binary_position');
            $table->integer('matrix_level')->nullable()->after('matrix_parent_id');
            $table->integer('matrix_position')->nullable()->after('matrix_level');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['binary_parent_id', 'matrix_parent_id', 'matrix_level', 'matrix_position']);
            $table->renameColumn('binary_position', 'position');
        });
    }
};
