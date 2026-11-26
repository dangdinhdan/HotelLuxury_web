<?php

namespace Database\Seeders;

use App\Models\TaiKhoan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TaiKhoanSeeder extends Seeder
{
    public function run(): void
    {
        $accounts = [
            [
                'ma_tk' => 'TK_ADMIN',
                'ho_ten' => 'Administrator',
                'email' => 'admin@hotelluxury.vn',
                'mat_khau' => Hash::make('admin123'),
                'so_dien_thoai' => '0901234567',
                'dia_chi' => 'Hà Nội, Việt Nam',
                'vai_tro_id' => 1, // Admin
                'trang_thai' => 'hoat_dong',
                'email_verified_at' => now(),
            ],
            [
                'ma_tk' => 'TK_LETAN',
                'ho_ten' => 'Lễ Tân Khách Sạn',
                'email' => 'letan@hotelluxury.vn',
                'mat_khau' => Hash::make('letan123'),
                'so_dien_thoai' => '0912345678',
                'dia_chi' => 'Hà Nội, Việt Nam',
                'vai_tro_id' => 2, // Lễ tân
                'trang_thai' => 'hoat_dong',
                'email_verified_at' => now(),
            ],
            [
                'ma_tk' => 'TK_KHACH01',
                'ho_ten' => 'Nguyễn Văn Khách',
                'email' => 'khachhang@gmail.com',
                'mat_khau' => Hash::make('khach123'),
                'so_dien_thoai' => '0987654321',
                'dia_chi' => 'TP. Hồ Chí Minh',
                'vai_tro_id' => 3, // Khách hàng
                'trang_thai' => 'hoat_dong',
                'email_verified_at' => now(),
            ],
        ];

        foreach ($accounts as $acc) {
            TaiKhoan::updateOrCreate(['email' => $acc['email']], $acc);
        }
    }
}
