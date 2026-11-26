<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tai_khoans', function (Blueprint $table) {
            $table->id();
            $table->string('ma_tk')->unique()->nullable();
            $table->string('ho_ten');
            $table->string('email')->unique();
            $table->string('mat_khau');
            $table->string('so_dien_thoai', 20)->nullable();
            $table->string('dia_chi')->nullable();
            $table->string('avatar')->nullable();
            $table->foreignId('vai_tro_id')->constrained('vai_tros')->cascadeOnDelete();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('trang_thai', 30)->default('hoat_dong');
            $table->timestamp('last_login_at')->nullable();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('tai_khoans');
    }
};
