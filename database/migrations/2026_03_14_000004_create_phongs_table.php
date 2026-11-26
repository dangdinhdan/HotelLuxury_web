<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('phongs', function (Blueprint $table) {
            $table->id();
            $table->string('so_phong')->unique();
            $table->foreignId('loai_phong_id')->constrained('loai_phongs')->cascadeOnDelete();
            $table->decimal('gia_moi_dem', 12, 2)->default(0);
            $table->integer('suc_chua_toi_da')->default(2);
            $table->decimal('dien_tich', 8, 2)->nullable();
            $table->integer('tang')->default(1);
            $table->text('mo_ta')->nullable();
            $table->string('trang_thai', 30)->default('trong'); // trong, dang_o, dang_don, bao_tri
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('phongs');
    }
};
