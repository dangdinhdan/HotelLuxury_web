<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HinhAnhPhong extends Model
{
    use HasFactory;

    protected $table = 'hinh_anh_phongs';

    protected $fillable = [
        'phong_id',
        'url',
        'is_primary',
    ];

    protected function casts(): array
    {
        return [
            'is_primary' => 'boolean',
        ];
    }

    public function phong(): BelongsTo
    {
        return $this->belongsTo(Phong::class, 'phong_id');
    }
}
