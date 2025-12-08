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
            $table->foreign('province_id')
                ->references('id')
                ->on('indonesia_provinces')
                ->nullOnDelete();

            $table->foreign('city_id')
                ->references('id')
                ->on('indonesia_cities')
                ->nullOnDelete();

            $table->foreign('district_id')
                ->references('id')
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
            //
            $table->dropForeign(['province_id']);
            $table->dropForeign(['city_id']);
            $table->dropForeign(['district_id']);
        });
    }
};
