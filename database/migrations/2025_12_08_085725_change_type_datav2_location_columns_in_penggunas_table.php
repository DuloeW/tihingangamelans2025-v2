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
            $table->unsignedBigInteger('province_id')->nullable()->after('password')->change();
            $table->unsignedBigInteger('city_id')->nullable()->after('province_id')->change();
            $table->unsignedBigInteger('district_id')->nullable()->after('city_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengguna', function (Blueprint $table) {
            $table->unsignedBigInteger('province_id')->after('password')->change();
            $table->unsignedBigInteger('city_id')->after('province_id')->change();
            $table->unsignedBigInteger('district_id')->after('city_id')->change();
        });
    }
};
