<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hoa_dons', function (Blueprint $table) {
            $table->id();
            $table->string('ma_hoa_don', 50)->unique();
            $table->foreignId('dat_phong_id')->constrained('dat_phongs')->cascadeOnDelete();
            $table->decimal('tong_tien', 12, 2)->default(0);
            $table->dateTime('ngay_xuat');
            $table->string('trang_thai', 30)->default('da_thanh_toan'); // da_thanh_toan, cho_thanh_toan, da_huy
            $table->text('ghi_chu')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hoa_dons');
    }
};
