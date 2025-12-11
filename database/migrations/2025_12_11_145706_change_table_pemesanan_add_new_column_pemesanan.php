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
            $table->string('nama_grup')->nullable()->after('jadwal_id');
            $table->string('jumlah')->nullable()->after('nama_grup')
                ->comment('Untuk Katalog jenis Workshop dan Kelas, isinya jumlah peserta. Untuk Gamelan, isinya jumlah unit gamelan yang dipesan.');
            $table->string('penerima')->nullable()->after('jumlah');
            $table->char('province_code', 2)->nullable()->after('penerima');
            $table->char('city_code', 4)->nullable()->after('province_code');
            $table->char('district_code', 7)->nullable()->after('city_code');
            $table->text('alamat_lengkap')->nullable()->after('district_code');

            $table->foreign('province_code')
                    ->references('code')
                    ->on('indonesia_provinces')
                    ->onDelete('cascade');
            $table->foreign('city_code')
                    ->references('code')
                    ->on('indonesia_cities')
                    ->onDelete('cascade');
            $table->foreign('district_code')
                    ->references('code')
                    ->on('indonesia_districts')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('pemesanan', function (Blueprint $table) {
            $table->dropForeign(['province_code']);
            $table->dropForeign(['city_code']);
            $table->dropForeign(['district_code']);

            $table->dropColumn('nama_grup');
            $table->dropColumn('jumlah');
            $table->dropColumn('penerima');
            $table->dropColumn('province_code');
            $table->dropColumn('city_code');
            $table->dropColumn('district_code');
            $table->dropColumn('alamat_lengkap');
        });
    }
};
