<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoaiPhong extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'loai_phongs';

    protected $fillable = [
        'ten_loai_phong',
        'mo_ta',
        'gia_mac_dinh',
        'so_nguoi_toi_da',
    ];

    public function phongs(): HasMany
    {
        return $this->hasMany(Phong::class, 'loai_phong_id');
    }
}
