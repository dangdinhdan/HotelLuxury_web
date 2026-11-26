<?php

namespace Database\Seeders;

use App\Models\VaiTro;
use Illuminate\Database\Seeder;

class VaiTroSeeder extends Seeder
{
    public function run(): void
    {
        $vaiTros = [
            ['id' => 1, 'ten_vai_tro' => 'Quản trị viên (Admin)'],
            ['id' => 2, 'ten_vai_tro' => 'Nhân viên lễ tân'],
            ['id' => 3, 'ten_vai_tro' => 'Khách hàng'],
        ];

        foreach ($vaiTros as $item) {
            VaiTro::updateOrCreate(['id' => $item['id']], $item);
        }
    }
}
