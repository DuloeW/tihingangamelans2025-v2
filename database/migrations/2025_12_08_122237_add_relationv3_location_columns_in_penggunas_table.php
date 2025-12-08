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
        Schema::table('pengguna', function (Blueprint $table) {
            $table->foreign('province_code')
                ->references('code')
                ->on('indonesia_provinces')
                ->nullOnDelete();

            $table->foreign('city_code')
                ->references('code')
                ->on('indonesia_cities')
                ->nullOnDelete();

            $table->foreign('district_code')
                ->references('code')
                ->on('indonesia_districts')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengguna', function (Blueprint $table) {
            $table->dropForeign(['province_code']);
            $table->dropForeign(['city_code']);
            $table->dropForeign(['district_code']);
        });
    }
};
