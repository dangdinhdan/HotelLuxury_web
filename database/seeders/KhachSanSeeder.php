<?php

namespace Database\Seeders;

use App\Models\LoaiPhong;
use App\Models\Phong;
use App\Models\HinhAnhPhong;
use Illuminate\Database\Seeder;

class KhachSanSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Tạo các Hạng phòng chuẩn theo sơ đồ thiết kế Diagram (chỉ gồm: ten_loai_phong, mo_ta, gia_mac_dinh, so_nguoi_toi_da)
        $loaiPhongs = [
            [
                'ten_loai_phong' => 'Deluxe King Garden',
                'mo_ta' => 'Không gian mở thanh bình nhìn ra khu vườn nhiệt đới, trang bị giường King cỡ lớn, sàn gỗ sồi ấm cúng cùng ánh sáng nghệ thuật dịu êm.',
                'gia_mac_dinh' => 1850000,
                'so_nguoi_toi_da' => 2,
            ],
            [
                'ten_loai_phong' => 'Grand Ocean Suite',
                'mo_ta' => 'Tầm nhìn trực diện biển Đông trọn vẹn, không gian thanh lịch kết hợp đá cẩm thạch, bồn tắm đá tự nhiên và nội thất gỗ óc chó nguyên khối.',
                'gia_mac_dinh' => 3450000,
                'so_nguoi_toi_da' => 3,
            ],
            [
                'ten_loai_phong' => 'Family Executive Suite',
                'mo_ta' => '2 phòng ngủ liên thông với phòng khách riêng biệt và bếp nhỏ, ban công lớn ngắm toàn cảnh, cực kỳ hoàn hảo cho kỳ nghỉ của gia đình.',
                'gia_mac_dinh' => 4100000,
                'so_nguoi_toi_da' => 4,
            ],
            [
                'ten_loai_phong' => 'Premier Luxury Suite',
                'mo_ta' => 'Hạng suite cao cấp kèm đặc quyền Executive Lounge, bồn tắm sục Jacuzzi đôi, hệ thống âm thanh vòm và dịch vụ đưa đón sân bay hạng sang.',
                'gia_mac_dinh' => 5200000,
                'so_nguoi_toi_da' => 4,
            ],
            [
                'ten_loai_phong' => 'Signature Corner Penthouse',
                'mo_ta' => 'Căn Penthouse độc bản góc 2 mặt tiền kính panorama, bể bơi vô cực riêng trên sân thượng, quầy bar cá nhân và quản gia phục vụ 24/7.',
                'gia_mac_dinh' => 11800000,
                'so_nguoi_toi_da' => 4,
            ],
        ];

        $lpModels = [];
        foreach ($loaiPhongs as $lp) {
            $lpModels[$lp['ten_loai_phong']] = LoaiPhong::updateOrCreate(
                ['ten_loai_phong' => $lp['ten_loai_phong']],
                $lp
            );
        }

        // 2. Tạo buồng phòng theo từng tầng (Tầng 1 -> Tầng 4) chuẩn schema Diagram (so_phong, loai_phong_id, gia_moi_dem, suc_chua_toi_da, dien_tich, tang, mo_ta, trang_thai)
        $phongsData = [
            // TẦNG 1: Sinh Thái
            ['so_phong' => '101', 'loai_phong_id' => $lpModels['Deluxe King Garden']->id, 'gia_moi_dem' => 1850000, 'suc_chua_toi_da' => 2, 'dien_tich' => 42, 'tang' => 1, 'mo_ta' => 'View hoa viên trung tâm thoáng đãng', 'trang_thai' => 'trong'],
            ['so_phong' => '102', 'loai_phong_id' => $lpModels['Deluxe King Garden']->id, 'gia_moi_dem' => 1850000, 'suc_chua_toi_da' => 2, 'dien_tich' => 42, 'tang' => 1, 'mo_ta' => 'Gần lối dạo bộ sinh thái', 'trang_thai' => 'dang_o'],
            ['so_phong' => '103', 'loai_phong_id' => $lpModels['Deluxe King Garden']->id, 'gia_moi_dem' => 1850000, 'suc_chua_toi_da' => 2, 'dien_tich' => 42, 'tang' => 1, 'mo_ta' => 'Không gian tĩnh lặng góc vườn', 'trang_thai' => 'dang_don'],
            ['so_phong' => '104', 'loai_phong_id' => $lpModels['Deluxe King Garden']->id, 'gia_moi_dem' => 1850000, 'suc_chua_toi_da' => 2, 'dien_tich' => 42, 'tang' => 1, 'mo_ta' => 'Bảo trì bảo dưỡng điều hòa', 'trang_thai' => 'bao_tri'],
            ['so_phong' => '105', 'loai_phong_id' => $lpModels['Deluxe King Garden']->id, 'gia_moi_dem' => 1850000, 'suc_chua_toi_da' => 2, 'dien_tich' => 42, 'tang' => 1, 'mo_ta' => 'Ban công hướng vườn hoa hồng', 'trang_thai' => 'trong'],
            ['so_phong' => '106', 'loai_phong_id' => $lpModels['Deluxe King Garden']->id, 'gia_moi_dem' => 1850000, 'suc_chua_toi_da' => 2, 'dien_tich' => 42, 'tang' => 1, 'mo_ta' => 'Phòng kế bên sảnh phụ', 'trang_thai' => 'trong'],

            // TẦNG 2: Ocean Front
            ['so_phong' => '201', 'loai_phong_id' => $lpModels['Grand Ocean Suite']->id, 'gia_moi_dem' => 3450000, 'suc_chua_toi_da' => 3, 'dien_tich' => 55, 'tang' => 2, 'mo_ta' => 'View biển đón bình minh trực diện', 'trang_thai' => 'dang_o'],
            ['so_phong' => '202', 'loai_phong_id' => $lpModels['Grand Ocean Suite']->id, 'gia_moi_dem' => 3450000, 'suc_chua_toi_da' => 3, 'dien_tich' => 55, 'tang' => 2, 'mo_ta' => 'Cửa kính kịch trần ngắm hoàng hôn', 'trang_thai' => 'trong'],
            ['so_phong' => '203', 'loai_phong_id' => $lpModels['Grand Ocean Suite']->id, 'gia_moi_dem' => 3450000, 'suc_chua_toi_da' => 3, 'dien_tich' => 55, 'tang' => 2, 'mo_ta' => 'Suite ban công đôi hướng vịnh', 'trang_thai' => 'trong'],
            ['so_phong' => '204', 'loai_phong_id' => $lpModels['Grand Ocean Suite']->id, 'gia_moi_dem' => 3450000, 'suc_chua_toi_da' => 3, 'dien_tich' => 55, 'tang' => 2, 'mo_ta' => 'Đang dọn phòng theo lịch', 'trang_thai' => 'dang_don'],

            // TẦNG 3: Gia Đình & Executive
            ['so_phong' => '301', 'loai_phong_id' => $lpModels['Family Executive Suite']->id, 'gia_moi_dem' => 4100000, 'suc_chua_toi_da' => 4, 'dien_tich' => 92, 'tang' => 3, 'mo_ta' => 'Căn hộ gia đình 2 phòng ngủ rộng rãi', 'trang_thai' => 'trong'],
            ['so_phong' => '302', 'loai_phong_id' => $lpModels['Family Executive Suite']->id, 'gia_moi_dem' => 4100000, 'suc_chua_toi_da' => 4, 'dien_tich' => 92, 'tang' => 3, 'mo_ta' => 'Gia đình lưu trú dài ngày', 'trang_thai' => 'dang_o'],
            ['so_phong' => '303', 'loai_phong_id' => $lpModels['Premier Luxury Suite']->id, 'gia_moi_dem' => 5200000, 'suc_chua_toi_da' => 4, 'dien_tich' => 78, 'tang' => 3, 'mo_ta' => 'Premier Suite VIP Jacuzzi', 'trang_thai' => 'trong'],
            ['so_phong' => '304', 'loai_phong_id' => $lpModels['Premier Luxury Suite']->id, 'gia_moi_dem' => 5200000, 'suc_chua_toi_da' => 4, 'dien_tich' => 78, 'tang' => 3, 'mo_ta' => 'Đang có khách VIP lưu trú', 'trang_thai' => 'dang_o'],

            // TẦNG 4: Signature Penthouse VIP
            ['so_phong' => '401', 'loai_phong_id' => $lpModels['Signature Corner Penthouse']->id, 'gia_moi_dem' => 11800000, 'suc_chua_toi_da' => 4, 'dien_tich' => 145, 'tang' => 4, 'mo_ta' => 'Penthouse góc Đông Nam kèm hồ bơi chân mây', 'trang_thai' => 'trong'],
            ['so_phong' => '402', 'loai_phong_id' => $lpModels['Signature Corner Penthouse']->id, 'gia_moi_dem' => 11800000, 'suc_chua_toi_da' => 4, 'dien_tich' => 145, 'tang' => 4, 'mo_ta' => 'Penthouse góc Tây Nam đón hoàng hôn tuyệt mỹ', 'trang_thai' => 'trong'],
        ];

        $sampleImages = [
            '101' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800',
            '102' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800',
            '103' => 'https://images.unsplash.com/photo-1591088398332-8a7791972843?w=800',
            '104' => 'https://images.unsplash.com/photo-1566665797739-1674de7a421a?w=800',
            '105' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800',
            '106' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800',
            '201' => 'https://images.unsplash.com/photo-1578683010236-d716f9a3f461?w=800',
            '202' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800',
            '203' => 'https://images.unsplash.com/photo-1540518614846-7ede433c4550?w=800',
            '204' => 'https://images.unsplash.com/photo-1578683010236-d716f9a3f461?w=800',
            '301' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800',
            '302' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800',
            '303' => 'https://images.unsplash.com/photo-1613490493576-7fde63acd811?w=800',
            '304' => 'https://images.unsplash.com/photo-1613490493576-7fde63acd811?w=800',
            '401' => 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=800',
            '402' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800',
        ];

        foreach ($phongsData as $pData) {
            $phong = Phong::updateOrCreate(['so_phong' => $pData['so_phong']], $pData);

            $imgUrl = $sampleImages[$phong->so_phong] ?? 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800';
            HinhAnhPhong::updateOrCreate(
                ['phong_id' => $phong->id, 'url' => $imgUrl],
                ['is_primary' => true]
            );
        }
    }
}
