<?php

use App\Http\Controllers\TaiKhoanController;
use App\Http\Controllers\VaiTroController;
use App\Http\Controllers\LoaiPhongController;
use App\Http\Controllers\PhongController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Hệ thống Quản Trị Khách Sạn Aura Hotel & Suites
|--------------------------------------------------------------------------
*/

// Trang chủ & Cổng khách hàng công khai
Route::get('/', [PhongController::class, 'clientIndex'])->name('home');
Route::get('/phongs', [PhongController::class, 'clientIndex'])->name('phongs.index');
Route::get('/phongs/{id}', [PhongController::class, 'clientShow'])->name('phongs.show');

// Luồng Xác thực (Guest Only)
Route::middleware('guest')->group(function () {
    Route::match(['get', 'post'], '/login', [TaiKhoanController::class, 'login'])->name('login');
    Route::post('/register', [TaiKhoanController::class, 'register'])->name('register');
    Route::post('/forgot-password', [TaiKhoanController::class, 'forgotPassword'])->name('forgot-password');
    Route::post('/reset-password', [TaiKhoanController::class, 'resetPassword'])->name('reset-password');
});

// Luồng Người dùng đã đăng nhập (Authenticated)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [TaiKhoanController::class, 'logout'])->name('logout');

    // Trang cá nhân khách hàng / thành viên
    Route::get('/profile', function () {
        return view('client.profile');
    })->name('client.profile');
    Route::get('/my-profile', function () {
        return view('client.profile');
    })->name('profile');

    Route::post('/profile', [TaiKhoanController::class, 'update'])->name('client.profile.update');
    Route::post('/profile/update', [TaiKhoanController::class, 'update'])->name('profile.update');
    Route::post('/change-password', [TaiKhoanController::class, 'changePassword'])->name('change-password');
});

// Phân hệ Quản trị (Admin & Lễ Tân: vai_tro_id = 1 hoặc 2)
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:1,2'])->group(function () {
    // Bảng tổng quan Dashboard
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Giai đoạn 2: Quản lý Tài khoản (Admin & Lễ tân đều xem được danh sách, cập nhật)
    Route::get('/tai-khoans', [TaiKhoanController::class, 'index'])->name('tai-khoans.index');
    Route::get('/tai-khoans/{id}', [TaiKhoanController::class, 'show'])->name('tai-khoans.show');
    Route::put('/tai-khoans/{id}', [TaiKhoanController::class, 'update'])->name('tai-khoans.update');
    Route::delete('/tai-khoans/{id}', [TaiKhoanController::class, 'destroy'])->name('tai-khoans.destroy');

    // Giai đoạn 3: Quản lý Phòng & Loại phòng
    Route::resource('loai-phongs', LoaiPhongController::class)->except(['create', 'edit', 'show']);
    Route::resource('phongs', PhongController::class)->except(['create', 'edit', 'show']);
    Route::patch('/phongs/{id}/status', [PhongController::class, 'updateStatus'])->name('phongs.update-status');

    // Quản lý Phân quyền Vai trò (Chỉ Quản trị viên tối cao: vai_tro_id = 1)
    Route::middleware('role:1')->group(function () {
        Route::resource('vai-tros', VaiTroController::class)->except(['create', 'edit']);
    });
});

