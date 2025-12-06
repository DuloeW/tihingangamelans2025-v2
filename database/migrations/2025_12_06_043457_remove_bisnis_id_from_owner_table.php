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
        Schema::table('owner', function (Blueprint $table) {
            $table->dropForeign(['bisnis_id']);
            $table->dropColumn('bisnis_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('owner', function (Blueprint $table) {
            $table->char('bisnis_id', 36)->nullable(false);

            $table->foreign('bisnis_id')->references('bisnis_id')->on('bisnis');
        });
    }
};
