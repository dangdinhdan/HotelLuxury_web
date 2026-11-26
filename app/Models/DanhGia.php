<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class DanhGia extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'danh_gias';

    protected $fillable = [
        'dat_phong_id',
        'so_sao',
        'noi_dung',
        'trang_thai',
    ];

    public function datPhong(): BelongsTo
    {
        return $this->belongsTo(DatPhong::class, 'dat_phong_id');
    }
}
