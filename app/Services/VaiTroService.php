<?php

namespace App\Services;

use App\Models\VaiTro;
use Illuminate\Database\Eloquent\Collection;

class VaiTroService
{
    public function getAll(): Collection
    {
        return VaiTro::withCount('taiKhoans')->get();
    }

    public function create(array $data): VaiTro
    {
        return VaiTro::create([
            'ten_vai_tro' => $data['ten_vai_tro'],
        ]);
    }

    public function update(int $id, array $data): bool
    {
        $vaiTro = VaiTro::findOrFail($id);
        return $vaiTro->update([
            'ten_vai_tro' => $data['ten_vai_tro'],
        ]);
    }

    public function delete(int $id): bool
    {
        // Không xóa 3 vai trò mặc định: Admin (1), Lễ tân (2), Khách hàng (3)
        if ($id <= 3) {
            return false;
        }

        $vaiTro = VaiTro::findOrFail($id);
        return (bool) $vaiTro->delete();
    }
}
