<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SePayWebhook extends Model
{
    use HasFactory;

    protected $table = 'sepay_webhooks';

    protected $fillable = [
        'sepay_transaction_id',
        'gateway',
        'transaction_date',
        'account_number',
        'sub_account',
        'code',
        'content',
        'transfer_type',
        'transfer_amount',
        'accumulated',
        'reference_code',
        'giao_dich_id',
        'trang_thai_xu_ly',
        'du_lieu_webhook',
        'loi_xu_ly',
        'processed_at',
    ];

    protected function casts(): array
    {
        return [
            'transaction_date' => 'datetime',
            'processed_at' => 'datetime',
            'du_lieu_webhook' => 'array',
        ];
    }

    public function giaoDich(): BelongsTo
    {
        return $this->belongsTo(GiaoDich::class, 'giao_dich_id');
    }
}
