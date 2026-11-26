<?php

namespace App\Services;

use App\Models\Phong;
use App\Models\HinhAnhPhong;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PhongService
{
    /**
     * Lấy danh sách buồng phòng theo bộ lọc (tầng, trạng thái, loại phòng, tìm kiếm số phòng).
     */
    public function getAll(array $filters = []): Collection
    {
        $query = Phong::with(['loaiPhong', 'hinhAnhs']);

        if (!empty($filters['search'])) {
            $search = trim($filters['search']);
            $query->where('so_phong', 'like', "%{$search}%");
        }

        if (!empty($filters['tang']) && $filters['tang'] !== 'all') {
            $query->where('tang', (int)$filters['tang']);
        }

        if (!empty($filters['loai_phong_id']) && $filters['loai_phong_id'] !== 'all') {
            $query->where('loai_phong_id', (int)$filters['loai_phong_id']);
        }

        if (!empty($filters['trang_thai']) && $filters['trang_thai'] !== 'all') {
            // Hỗ trợ map trạng thái từ UI pill: ready -> trong, occupied -> dang_o, cleaning -> dang_don, maintenance -> bao_tri
            $statusMap = [
                'ready' => 'trong',
                'occupied' => 'dang_o',
                'cleaning' => 'dang_don',
                'maintenance' => 'bao_tri',
            ];
            $status = $statusMap[$filters['trang_thai']] ?? $filters['trang_thai'];
            $query->where('trang_thai', $status);
        }

        return $query->orderBy('tang', 'asc')->orderBy('so_phong', 'asc')->get();
    }

    /**
     * Thống kê buồng phòng theo trạng thái.
     */
    public function getMetrics(): array
    {
        $total = Phong::count();
        $trong = Phong::where('trang_thai', 'trong')->count();
        $dangO = Phong::where('trang_thai', 'dang_o')->count();
        $dangDon = Phong::where('trang_thai', 'dang_don')->count();
        $baoTri = Phong::where('trang_thai', 'bao_tri')->count();

        return [
            'total' => $total,
            'trong' => $trong,
            'dang_o' => $dangO,
            'dang_don' => $dangDon,
            'bao_tri' => $baoTri,
            'ty_le_lap_day' => $total > 0 ? round(($dangO / $total) * 100, 1) : 0,
        ];
    }

    /**
     * Tìm buồng phòng theo ID.
     */
    public function findById(int $id): ?Phong
    {
        return Phong::with(['loaiPhong', 'hinhAnhs'])->find($id);
    }

    /**
     * Tạo mới buồng phòng.
     */
    public function create(array $data, array $imageFiles = [], ?string $onlineUrl = null): Phong
    {
        $phong = Phong::create($data);

        $hasPrimary = false;

        // Lưu ảnh upload
        foreach ($imageFiles as $file) {
            if ($file instanceof UploadedFile) {
                $path = $file->store('rooms', 'public');
                $url = Storage::url($path);
                HinhAnhPhong::create([
                    'phong_id' => $phong->id,
                    'url' => $url,
                    'is_primary' => !$hasPrimary,
                ]);
                $hasPrimary = true;
            }
        }

        // Lưu ảnh URL online nếu có
        if (!empty($onlineUrl)) {
            HinhAnhPhong::create([
                'phong_id' => $phong->id,
                'url' => $onlineUrl,
                'is_primary' => !$hasPrimary,
            ]);
            $hasPrimary = true;
        }

        return $phong;
    }

    /**
     * Cập nhật thông tin buồng phòng.
     */
    public function update(int $id, array $data, array $imageFiles = [], ?string $onlineUrl = null): bool
    {
        $phong = Phong::findOrFail($id);
        $updated = $phong->update($data);

        // Upload thêm ảnh nếu có
        foreach ($imageFiles as $file) {
            if ($file instanceof UploadedFile) {
                $path = $file->store('rooms', 'public');
                $url = Storage::url($path);
                HinhAnhPhong::create([
                    'phong_id' => $phong->id,
                    'url' => $url,
                    'is_primary' => false,
                ]);
            }
        }

        if (!empty($onlineUrl)) {
            HinhAnhPhong::create([
                'phong_id' => $phong->id,
                'url' => $onlineUrl,
                'is_primary' => false,
            ]);
        }

        return $updated;
    }

    /**
     * Cập nhật nhanh trạng thái buồng phòng.
     */
    public function updateStatus(int $id, string $status): bool
    {
        $phong = Phong::findOrFail($id);
        $phong->trang_thai = $status;
        return $phong->save();
    }

    /**
     * Xóa mềm phòng.
     */
    public function delete(int $id): bool
    {
        $phong = Phong::findOrFail($id);
        return $phong->delete();
    }

    /**
     * Tra cứu danh sách phòng trống cho khách hàng (Client Portal).
     */
    public function findAvailableRooms(?string $checkIn = null, ?string $checkOut = null, array $filters = []): Collection
    {
        $query = Phong::with(['loaiPhong', 'hinhAnhs'])
            ->where('trang_thai', 'trong');

        if (!empty($filters['loai_phong_id']) && $filters['loai_phong_id'] !== 'all') {
            $query->where('loai_phong_id', (int)$filters['loai_phong_id']);
        }

        if (!empty($filters['max_price'])) {
            $query->where('gia_moi_dem', '<=', (float)$filters['max_price']);
        }

        if (!empty($filters['suc_chua'])) {
            $query->where('suc_chua_toi_da', '>=', (int)$filters['suc_chua']);
        }

        // Loại trừ phòng đã có người đặt trong khoảng ngày check-in / check-out nếu truyền vào
        if ($checkIn && $checkOut) {
            $query->whereDoesntHave('datPhongs', function ($q) use ($checkIn, $checkOut) {
                $q->whereIn('trang_thai', ['cho_xac_nhan', 'da_xac_nhan', 'dang_o'])
                  ->where(function ($sub) use ($checkIn, $checkOut) {
                      $sub->whereBetween('ngay_nhan_phong', [$checkIn, $checkOut])
                          ->orWhereBetween('ngay_tra_phong', [$checkIn, $checkOut])
                          ->orWhere(function ($overlap) use ($checkIn, $checkOut) {
                              $overlap->where('ngay_nhan_phong', '<=', $checkIn)
                                      ->where('ngay_tra_phong', '>=', $checkOut);
                          });
                  });
            });
        }

        return $query->get();
    }
}
