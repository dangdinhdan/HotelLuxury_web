<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loai_phongs', function (Blueprint $table) {
            $table->id();
            $table->string('ten_loai_phong');
            $table->text('mo_ta')->nullable();
            $table->decimal('gia_mac_dinh', 12, 2)->default(0);
            $table->integer('so_nguoi_toi_da')->default(2);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loai_phongs');
    }
};
