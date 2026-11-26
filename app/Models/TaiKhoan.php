<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class TaiKhoan extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'tai_khoans';

    protected $fillable = [
        'ma_tk',
        'ho_ten',
        'email',
        'mat_khau',
        'so_dien_thoai',
        'dia_chi',
        'avatar',
        'vai_tro_id',
        'email_verified_at',
        'trang_thai',
        'last_login_at',
    ];

    protected $hidden = [
        'mat_khau',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_at' => 'datetime',
            'mat_khau' => 'hashed',
        ];
    }

    public function getAuthPassword(): string
    {
        return $this->mat_khau;
    }

    public function vaiTro(): BelongsTo
    {
        return $this->belongsTo(VaiTro::class, 'vai_tro_id');
    }

    public function datPhongs(): HasMany
    {
        return $this->hasMany(DatPhong::class, 'tai_khoan_id');
    }

    public function datPhongsDaHuy(): HasMany
    {
        return $this->hasMany(DatPhong::class, 'nguoi_huy_id');
    }

    public function giaoDichs(): HasMany
    {
        return $this->hasMany(GiaoDich::class, 'tai_khoan_id');
    }
}
