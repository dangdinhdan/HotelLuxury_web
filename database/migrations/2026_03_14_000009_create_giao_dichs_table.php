<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('giao_dichs', function (Blueprint $table) {
            $table->id();
            $table->string('ma_giao_dich', 50)->unique();
            $table->foreignId('dat_phong_id')->constrained('dat_phongs')->cascadeOnDelete();
            $table->foreignId('tai_khoan_id')->nullable()->constrained('tai_khoans')->nullOnDelete();
            $table->decimal('so_tien', 12, 2)->default(0);
            $table->string('loai_giao_dich', 30)->default('thanh_toan'); // thanh_toan, hoan_tien, dat_coc
            $table->string('trang_thai', 30)->default('cho_thanh_toan'); // cho_thanh_toan, thanh_cong, that_bai, da_huy
            $table->string('phuong_thuc', 30)->default('chuyen_khoan'); // chuyen_khoan, tien_mat
            $table->dateTime('ngay_giao_dich')->nullable();
            $table->string('noi_dung')->nullable();
            $table->string('cong_thanh_toan', 30)->default('sepay'); // sepay, truc_tiep
            $table->string('ma_giao_dich_cong_thanh_toan')->nullable();
            $table->string('ma_tham_chieu_ngan_hang')->nullable();
            $table->string('ma_thanh_toan')->nullable();
            $table->string('ngan_hang')->nullable();
            $table->string('tai_khoan_nhan')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('giao_dichs');
    }
};
