@extends('layouts.admin')

@section('title', 'Bảng Điều Khiển Quản Trị')
@section('page_title', 'Bảng Điều Khiển')

@section('content')
<div class="flex flex-col w-full gap-space-lg">
    <!-- Welcome Header -->
    <section class="flex flex-col lg:flex-row lg:items-center justify-between gap-space-md bg-surface-container-lowest p-space-lg rounded-xl shadow-sm border border-gray-100">
        <div class="flex flex-col gap-space-xs">
            <div class="flex items-center gap-space-xs">
                <span class="inline-flex w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="text-[11px] uppercase tracking-wider text-secondary font-bold">Hệ Thống Trực Tuyến 24/7 • Sẵn Sàng Vận Hành</span>
            </div>
            <h1 class="font-headline-lg text-2xl text-on-surface font-bold tracking-tight">
                Xin chào, <span class="text-primary-container">{{ Auth::user()->ho_ten }}</span>
            </h1>
            <p class="text-xs text-on-surface-variant flex items-center gap-1.5">
                <span class="material-symbols-outlined text-[16px] text-outline">schedule</span>
                <span id="live-time-ticker">Đang cập nhật thời gian...</span>
                <span class="text-outline-variant">|</span>
                <span>Aura Hotel &amp; Suites Grand Luxury</span>
            </p>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('admin.tai-khoans.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl bg-primary-container text-white hover:bg-black transition-all text-xs font-bold shadow-md">
                <span class="material-symbols-outlined text-[18px]">person_add</span>
                <span>Quản Lý Tài Khoản</span>
            </a>
            @if(Auth::user()->vai_tro_id == 1)
            <a href="{{ route('admin.vai-tros.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl bg-surface-container hover:bg-surface-container-high text-on-surface text-xs font-bold transition-all shadow-sm">
                <span class="material-symbols-outlined text-[18px]">admin_panel_settings</span>
                <span>Phân Quyền</span>
            </a>
            @endif
        </div>
    </section>

    <!-- 4 KPI Metrics Bento Grid -->
    <section class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-space-md">
        <!-- Metric 1: Tài khoản người dùng -->
        <div class="bg-surface-container-lowest p-space-lg rounded-xl shadow-sm border border-gray-100 flex flex-col justify-between">
            <div class="flex items-start justify-between">
                <div>
                    <span class="text-[11px] uppercase tracking-wider text-on-surface-variant font-bold">Tổng tài khoản</span>
                    <div class="flex items-baseline gap-1 mt-1">
                        <span class="font-headline-lg text-3xl font-bold text-on-surface">{{ \App\Models\TaiKhoan::count() }}</span>
                        <span class="text-xs text-on-surface-variant">người dùng</span>
                    </div>
                </div>
                <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center">
                    <span class="material-symbols-outlined text-[22px]">group</span>
                </div>
            </div>
            <div class="mt-4 pt-2 border-t border-gray-50 flex items-center justify-between text-xs text-on-surface-variant">
                <span>Hội viên &amp; Nhân viên</span>
                <a href="{{ route('admin.tai-khoans.index') }}" class="text-blue-600 font-bold hover:underline">Chi tiết &rarr;</a>
            </div>
        </div>

        <!-- Metric 2: Tổng số phòng -->
        <div class="bg-surface-container-lowest p-space-lg rounded-xl shadow-sm border border-gray-100 flex flex-col justify-between">
            <div class="flex items-start justify-between">
                <div>
                    <span class="text-[11px] uppercase tracking-wider text-on-surface-variant font-bold">Quy mô phòng</span>
                    <div class="flex items-baseline gap-1 mt-1">
                        <span class="font-headline-lg text-3xl font-bold text-on-surface">{{ \App\Models\Phong::count() }}</span>
                        <span class="text-xs text-on-surface-variant">phòng</span>
                    </div>
                </div>
                <div class="w-10 h-10 rounded-full bg-amber-50 text-amber-600 flex items-center justify-center">
                    <span class="material-symbols-outlined text-[22px]">hotel</span>
                </div>
            </div>
            <div class="mt-4 pt-2 border-t border-gray-50 flex items-center justify-between text-xs text-on-surface-variant">
                <span>{{ \App\Models\LoaiPhong::count() }} hạng loại phòng</span>
                <span class="text-emerald-600 font-bold">100% Sẵn sàng</span>
            </div>
        </div>

        <!-- Metric 3: Loại phòng -->
        <div class="bg-surface-container-lowest p-space-lg rounded-xl shadow-sm border border-gray-100 flex flex-col justify-between">
            <div class="flex items-start justify-between">
                <div>
                    <span class="text-[11px] uppercase tracking-wider text-on-surface-variant font-bold">Hạng Loại Phòng</span>
                    <div class="flex items-baseline gap-1 mt-1">
                        <span class="font-headline-lg text-3xl font-bold text-on-surface">{{ \App\Models\LoaiPhong::count() }}</span>
                        <span class="text-xs text-on-surface-variant">hạng phòng</span>
                    </div>
                </div>
                <div class="w-10 h-10 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <span class="material-symbols-outlined text-[22px]">category</span>
                </div>
            </div>
            <div class="mt-4 pt-2 border-t border-gray-50 flex items-center justify-between text-xs text-on-surface-variant">
                <span>Standard, Deluxe, Suite, Family</span>
                <span class="text-emerald-600 font-semibold">Đa dạng</span>
            </div>
        </div>

        <!-- Metric 4: Trạng thái Cổng SePay -->
        <div class="bg-surface-container-lowest p-space-lg rounded-xl shadow-sm border border-gray-100 flex flex-col justify-between">
            <div class="flex items-start justify-between">
                <div>
                    <span class="text-[11px] uppercase tracking-wider text-on-surface-variant font-bold">Cổng SePay QR</span>
                    <div class="flex items-baseline gap-1 mt-1">
                        <span class="font-headline-lg text-2xl font-bold text-emerald-600">Sẵn sàng</span>
                    </div>
                </div>
                <div class="w-10 h-10 rounded-full bg-purple-50 text-purple-600 flex items-center justify-center">
                    <span class="material-symbols-outlined text-[22px]">qr_code_scanner</span>
                </div>
            </div>
            <div class="mt-4 pt-2 border-t border-gray-50 flex items-center justify-between text-xs text-on-surface-variant">
                <span>Chế độ đối soát</span>
                <span class="text-purple-600 font-bold">Tự động / Thủ công</span>
            </div>
        </div>
    </section>

    <!-- Recent Users Table -->
    <section class="bg-surface-container-lowest p-space-lg rounded-xl shadow-sm border border-gray-100 flex flex-col gap-space-md">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-gray-100 pb-3">
            <div>
                <h2 class="font-headline-md text-lg font-bold text-on-surface">Danh Sách Người Dùng Mới Nhất</h2>
                <p class="text-xs text-on-surface-variant">Quản lý tài khoản hội viên và nhân sự vận hành hệ thống</p>
            </div>
            <a href="{{ route('admin.tai-khoans.index') }}" class="text-xs text-blue-600 font-bold hover:underline flex items-center gap-1">
                <span>Xem tất cả tài khoản</span>
                <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="border-b border-gray-100 text-on-surface-variant font-bold uppercase text-[10px]">
                        <th class="py-3 px-3">Mã TK</th>
                        <th class="py-3 px-3">Họ Tên</th>
                        <th class="py-3 px-3">Email</th>
                        <th class="py-3 px-3">Số Điện Thoại</th>
                        <th class="py-3 px-3">Vai Trò</th>
                        <th class="py-3 px-3">Trạng Thái</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse(\App\Models\TaiKhoan::with('vaiTro')->latest()->take(5)->get() as $tk)
                        <tr class="hover:bg-gray-50/80 transition-colors">
                            <td class="py-3 px-3 font-mono font-bold text-primary-container">{{ $tk->ma_tk ?? 'TK' . str_pad($tk->id, 4, '0', STR_PAD_LEFT) }}</td>
                            <td class="py-3 px-3 font-semibold text-gray-900">{{ $tk->ho_ten }}</td>
                            <td class="py-3 px-3 text-gray-600">{{ $tk->email }}</td>
                            <td class="py-3 px-3 text-gray-600">{{ $tk->so_dien_thoai ?? 'Chưa cập nhật' }}</td>
                            <td class="py-3 px-3">
                                @if($tk->vai_tro_id == 1)
                                    <span class="px-2 py-0.5 rounded-full bg-red-50 text-red-700 font-bold text-[10px]">Quản trị viên</span>
                                @elseif($tk->vai_tro_id == 2)
                                    <span class="px-2 py-0.5 rounded-full bg-blue-50 text-blue-700 font-bold text-[10px]">Lễ tân</span>
                                @else
                                    <span class="px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 font-bold text-[10px]">Khách hàng</span>
                                @endif
                            </td>
                            <td class="py-3 px-3">
                                <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-emerald-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Hoạt động
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-4 text-center text-gray-500">Chưa có người dùng nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>

<script>
    function updateClock() {
        const el = document.getElementById('live-time-ticker');
        if (!el) return;
        const now = new Date();
        const days = ['Chủ Nhật', 'Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy'];
        const dayStr = days[now.getDay()];
        const dateStr = String(now.getDate()).padStart(2, '0') + '/' + String(now.getMonth() + 1).padStart(2, '0') + '/' + now.getFullYear();
        const timeStr = String(now.getHours()).padStart(2, '0') + ':' + String(now.getMinutes()).padStart(2, '0') + ':' + String(now.getSeconds()).padStart(2, '0');
        el.innerHTML = `${dayStr}, ${dateStr} &bull; ${timeStr} GMT+7`;
    }
    setInterval(updateClock, 1000);
    updateClock();
</script>
@endsection
