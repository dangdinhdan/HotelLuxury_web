<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class GiaoDich extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'giao_dichs';

    protected $fillable = [
        'ma_giao_dich',
        'dat_phong_id',
        'tai_khoan_id',
        'so_tien',
        'loai_giao_dich',
        'trang_thai',
        'phuong_thuc',
        'ngay_giao_dich',
        'noi_dung',
        'cong_thanh_toan',
        'ma_giao_dich_cong_thanh_toan',
        'ma_tham_chieu_ngan_hang',
        'ma_thanh_toan',
        'ngan_hang',
        'tai_khoan_nhan',
    ];

    protected function casts(): array
    {
        return [
            'ngay_giao_dich' => 'datetime',
        ];
    }

    public function datPhong(): BelongsTo
    {
        return $this->belongsTo(DatPhong::class, 'dat_phong_id');
    }

    public function taiKhoan(): BelongsTo
    {
        return $this->belongsTo(TaiKhoan::class, 'tai_khoan_id');
    }

    public function sePayWebhooks(): HasMany
    {
        return $this->hasMany(SePayWebhook::class, 'giao_dich_id');
    }
}
