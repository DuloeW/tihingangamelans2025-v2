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
        Schema::table('bisnis', function (Blueprint $table) {
            if (!Schema::hasColumn('bisnis', 'owner_id')) {
                $table->uuid('owner_id')->nullable()->after('admin_id');

                $table->foreign('owner_id')
                ->references('owner_id')
                ->on('owner')
                ->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bisnis', function (Blueprint $table) {
            $table->dropForeign(['owner_id']);
            $table->dropColumn('owner_id');
        });
    }
};
