<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class HoaDon extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'hoa_dons';

    protected $fillable = [
        'ma_hoa_don',
        'dat_phong_id',
        'tong_tien',
        'ngay_xuat',
        'trang_thai',
        'ghi_chu',
    ];

    protected function casts(): array
    {
        return [
            'ngay_xuat' => 'datetime',
        ];
    }

    public function datPhong(): BelongsTo
    {
        return $this->belongsTo(DatPhong::class, 'dat_phong_id');
    }
}
