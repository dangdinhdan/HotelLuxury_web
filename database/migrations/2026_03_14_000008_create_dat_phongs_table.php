<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dat_phongs', function (Blueprint $table) {
            $table->id();
            $table->string('ma_dat_phong', 50)->unique();
            $table->foreignId('tai_khoan_id')->constrained('tai_khoans')->cascadeOnDelete();
            $table->foreignId('phong_id')->constrained('phongs')->cascadeOnDelete();
            $table->timestamp('ngay_dat')->useCurrent();
            $table->dateTime('ngay_nhan_phong');
            $table->dateTime('ngay_tra_phong');
            $table->dateTime('ngay_checkin_thuc_te')->nullable();
            $table->dateTime('ngay_checkout_thuc_te')->nullable();
            $table->integer('so_luong_nguoi')->default(1);
            $table->decimal('gia_moi_dem', 12, 2)->default(0);
            $table->decimal('tong_tien', 12, 2)->default(0);
            $table->string('trang_thai', 30)->default('cho_xac_nhan'); // cho_xac_nhan, da_xac_nhan, da_checkin, da_checkout, da_huy
            $table->text('ghi_chu')->nullable();
            $table->text('ghi_chu_huy')->nullable();
            $table->foreignId('nguoi_huy_id')->nullable()->constrained('tai_khoans')->nullOnDelete();
            $table->timestamp('cancelled_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dat_phongs');
    }
};
