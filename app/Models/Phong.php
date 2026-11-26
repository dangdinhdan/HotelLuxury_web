<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phong extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'phongs';

    protected $fillable = [
        'so_phong',
        'loai_phong_id',
        'gia_moi_dem',
        'suc_chua_toi_da',
        'dien_tich',
        'tang',
        'mo_ta',
        'trang_thai',
    ];

    public function loaiPhong(): BelongsTo
    {
        return $this->belongsTo(LoaiPhong::class, 'loai_phong_id');
    }

    public function hinhAnhs(): HasMany
    {
        return $this->hasMany(HinhAnhPhong::class, 'phong_id');
    }

    public function datPhongs(): HasMany
    {
        return $this->hasMany(DatPhong::class, 'phong_id');
    }
}
