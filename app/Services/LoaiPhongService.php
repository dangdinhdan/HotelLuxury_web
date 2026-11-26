<?php

namespace App\Services;

use App\Models\LoaiPhong;
use Illuminate\Database\Eloquent\Collection;

class LoaiPhongService
{
    /**
     * Lấy danh sách tất cả loại phòng kèm số lượng buồng phòng liên kết.
     */
    public function getAll(array $filters = []): Collection
    {
        $query = LoaiPhong::withCount('phongs');

        if (!empty($filters['search'])) {
            $search = trim($filters['search']);
            $query->where('ten_loai_phong', 'like', "%{$search}%");
        }

        if (!empty($filters['price_range']) && $filters['price_range'] !== 'all') {
            if ($filters['price_range'] === 'under-3') {
                $query->where('gia_mac_dinh', '<', 3000000);
            } elseif ($filters['price_range'] === '3-6') {
                $query->whereBetween('gia_mac_dinh', [3000000, 6000000]);
            } elseif ($filters['price_range'] === 'over-6') {
                $query->where('gia_mac_dinh', '>', 6000000);
            }
        }

        return $query->orderBy('gia_mac_dinh', 'asc')->get();
    }

    /**
     * Tìm loại phòng theo ID.
     */
    public function findById(int $id): ?LoaiPhong
    {
        return LoaiPhong::with('phongs.hinhAnhs')->find($id);
    }

    /**
     * Thêm mới loại phòng (chuẩn Diagram: ten_loai_phong, mo_ta, gia_mac_dinh, so_nguoi_toi_da).
     */
    public function create(array $data): LoaiPhong
    {
        return LoaiPhong::create([
            'ten_loai_phong' => $data['ten_loai_phong'],
            'mo_ta' => $data['mo_ta'] ?? null,
            'gia_mac_dinh' => $data['gia_mac_dinh'] ?? 0,
            'so_nguoi_toi_da' => $data['so_nguoi_toi_da'] ?? 2,
        ]);
    }

    /**
     * Cập nhật thông tin loại phòng.
     */
    public function update(int $id, array $data): bool
    {
        $loaiPhong = LoaiPhong::findOrFail($id);

        return $loaiPhong->update([
            'ten_loai_phong' => $data['ten_loai_phong'],
            'mo_ta' => $data['mo_ta'] ?? null,
            'gia_mac_dinh' => $data['gia_mac_dinh'] ?? 0,
            'so_nguoi_toi_da' => $data['so_nguoi_toi_da'] ?? 2,
        ]);
    }

    /**
     * Xóa mềm loại phòng.
     */
    public function delete(int $id): bool
    {
        $loaiPhong = LoaiPhong::findOrFail($id);
        return $loaiPhong->delete();
    }
}
