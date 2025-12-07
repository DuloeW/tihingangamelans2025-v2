<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('dokumen_bisnis', function (Blueprint $table) {
        $table->string('path')->after('nama_dokumen');
    });
}

public function down(): void
{
    Schema::table('dokumen_bisnis', function (Blueprint $table) {
        $table->dropColumn('path');
    });
}
};
