<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class VaiTro extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'vai_tros';

    protected $fillable = [
        'ten_vai_tro',
    ];

    public function taiKhoans(): HasMany
    {
        return $this->hasMany(TaiKhoan::class, 'vai_tro_id');
    }
}
