<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class DatPhong extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'dat_phongs';

    protected $fillable = [
        'ma_dat_phong',
        'tai_khoan_id',
        'phong_id',
        'ngay_dat',
        'ngay_nhan_phong',
        'ngay_tra_phong',
        'ngay_checkin_thuc_te',
        'ngay_checkout_thuc_te',
        'so_luong_nguoi',
        'gia_moi_dem',
        'tong_tien',
        'trang_thai',
        'ghi_chu',
        'ghi_chu_huy',
        'nguoi_huy_id',
        'cancelled_at',
    ];

    protected function casts(): array
    {
        return [
            'ngay_dat' => 'datetime',
            'ngay_nhan_phong' => 'datetime',
            'ngay_tra_phong' => 'datetime',
            'ngay_checkin_thuc_te' => 'datetime',
            'ngay_checkout_thuc_te' => 'datetime',
            'cancelled_at' => 'datetime',
        ];
    }

    public function taiKhoan(): BelongsTo
    {
        return $this->belongsTo(TaiKhoan::class, 'tai_khoan_id');
    }

    public function nguoiHuy(): BelongsTo
    {
        return $this->belongsTo(TaiKhoan::class, 'nguoi_huy_id');
    }

    public function phong(): BelongsTo
    {
        return $this->belongsTo(Phong::class, 'phong_id');
    }

    public function giaoDichs(): HasMany
    {
        return $this->hasMany(GiaoDich::class, 'dat_phong_id');
    }

    public function hoaDon(): HasOne
    {
        return $this->hasOne(HoaDon::class, 'dat_phong_id');
    }

    public function danhGia(): HasOne
    {
        return $this->hasOne(DanhGia::class, 'dat_phong_id');
    }
}
