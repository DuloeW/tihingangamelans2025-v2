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
        Schema::table('pemesanan', function (Blueprint $table) {
            $table->dateTime('tgl_mulai_booking')->nullable()->change();
            $table->dateTime('tgl_selesai_booking')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pemesanan', function (Blueprint $table) {
            $table->date('tgl_mulai_booking')->change();
            $table->date('tgl_selesai_booking')->change();
        });
    }
};
