<?php

namespace App\Services;

use App\Models\TaiKhoan;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TaiKhoanService
{
    public function register(array $data): TaiKhoan
    {
        return TaiKhoan::create([
            'ma_tk' => 'TK_' . strtoupper(Str::random(6)),
            'ho_ten' => $data['ho_ten'],
            'email' => $data['email'],
            'mat_khau' => Hash::make($data['mat_khau']),
            'so_dien_thoai' => $data['so_dien_thoai'] ?? null,
            'dia_chi' => $data['dia_chi'] ?? null,
            'vai_tro_id' => $data['vai_tro_id'] ?? 3, // Mặc định khách hàng
            'trang_thai' => 'hoat_dong',
            'email_verified_at' => now(),
        ]);
    }

    public function attemptLogin(string $email, string $matKhau): ?TaiKhoan
    {
        $user = TaiKhoan::where('email', $email)->first();

        if ($user && Hash::check($matKhau, $user->mat_khau)) {
            if ($user->trang_thai !== 'hoat_dong') {
                return null;
            }

            $user->update(['last_login_at' => now()]);
            return $user;
        }

        return null;
    }

    public function search(string $keyword): Collection
    {
        return TaiKhoan::with('vaiTro')
            ->where(function ($query) use ($keyword) {
                $query->where('ho_ten', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%")
                    ->orWhere('so_dien_thoai', 'like', "%{$keyword}%")
                    ->orWhere('ma_tk', 'like', "%{$keyword}%");
            })
            ->latest()
            ->get();
    }

    public function getAll(): Collection
    {
        return TaiKhoan::with('vaiTro')->latest()->get();
    }

    public function findById(int $id): ?TaiKhoan
    {
        return TaiKhoan::with('vaiTro')->find($id);
    }

    public function update(int $id, array $data): bool
    {
        $user = TaiKhoan::findOrFail($id);

        $updateData = [
            'ho_ten' => $data['ho_ten'] ?? $user->ho_ten,
            'email' => $data['email'] ?? $user->email,
            'so_dien_thoai' => $data['so_dien_thoai'] ?? $user->so_dien_thoai,
            'dia_chi' => $data['dia_chi'] ?? $user->dia_chi,
        ];

        if (!empty($data['vai_tro_id'])) {
            $updateData['vai_tro_id'] = $data['vai_tro_id'];
        }

        if (!empty($data['trang_thai'])) {
            $updateData['trang_thai'] = $data['trang_thai'];
        }

        return $user->update($updateData);
    }

    public function changePassword(int $id, string $oldPass, string $newPass): bool
    {
        $user = TaiKhoan::findOrFail($id);

        if (!Hash::check($oldPass, $user->mat_khau)) {
            return false;
        }

        return $user->update([
            'mat_khau' => Hash::make($newPass),
        ]);
    }

    public function softDelete(int $id): bool
    {
        $user = TaiKhoan::findOrFail($id);
        return (bool) $user->delete();
    }

    public function createResetToken(string $email): string
    {
        $token = Str::random(60);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            [
                'token' => Hash::make($token),
                'created_at' => now(),
            ]
        );

        return $token;
    }

    public function resetPassword(string $email, string $token, string $newPass): bool
    {
        $record = DB::table('password_reset_tokens')->where('email', $email)->first();

        if (!$record || !Hash::check($token, $record->token)) {
            return false;
        }

        $user = TaiKhoan::where('email', $email)->first();
        if (!$user) {
            return false;
        }

        $user->update([
            'mat_khau' => Hash::make($newPass),
        ]);

        DB::table('password_reset_tokens')->where('email', $email)->delete();

        return true;
    }
}
