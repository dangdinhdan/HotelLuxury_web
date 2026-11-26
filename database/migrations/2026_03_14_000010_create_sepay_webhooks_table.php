<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sepay_webhooks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sepay_transaction_id')->nullable();
            $table->string('gateway', 50)->nullable();
            $table->dateTime('transaction_date')->nullable();
            $table->string('account_number', 50)->nullable();
            $table->string('sub_account', 50)->nullable();
            $table->string('code', 50)->nullable();
            $table->text('content')->nullable();
            $table->string('transfer_type', 20)->nullable();
            $table->decimal('transfer_amount', 12, 2)->nullable();
            $table->decimal('accumulated', 14, 2)->nullable();
            $table->string('reference_code', 100)->nullable();
            $table->foreignId('giao_dich_id')->nullable()->constrained('giao_dichs')->nullOnDelete();
            $table->string('trang_thai_xu_ly', 30)->default('chua_xu_ly'); // chua_xu_ly, da_xu_ly, that_bai, bo_qua
            $table->json('du_lieu_webhook')->nullable();
            $table->text('loi_xu_ly')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sepay_webhooks');
    }
};
