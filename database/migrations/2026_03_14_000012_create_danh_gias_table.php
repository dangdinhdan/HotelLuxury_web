<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('danh_gias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dat_phong_id')->constrained('dat_phongs')->cascadeOnDelete();
            $table->unsignedTinyInteger('so_sao')->default(5); // 1 - 5 sao
            $table->text('noi_dung')->nullable();
            $table->string('trang_thai', 30)->default('cho_duyet'); // cho_duyet, da_duyet, da_an
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('danh_gias');
    }
};
