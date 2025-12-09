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
        Schema::create('pengguna', function (Blueprint $table) {
            $table->uuid('pengguna_id')->primary();
            $table->string('nama');
            $table->string('user_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->char('province_code', 2)->nullable();
            $table->char('city_code', 4)->nullable();
            $table->char('district_code', 7)->nullable();

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


            $table->string('jenis_kelamin');
            $table->string('no_telephone');
            $table->string('gambar')->default('default.png');
            $table->rememberToken();
            $table->timestamps(false);
        });                     

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignUuid('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
