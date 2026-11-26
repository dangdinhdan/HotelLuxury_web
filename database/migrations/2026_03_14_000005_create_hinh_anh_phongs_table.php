<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hinh_anh_phongs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('phong_id')->constrained('phongs')->cascadeOnDelete();
            $table->text('url');
            $table->boolean('is_primary')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hinh_anh_phongs');
    }
};
