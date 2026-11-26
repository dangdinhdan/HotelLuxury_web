@extends('layouts.admin')

@section('title', 'Quản Lý Tài Khoản')
@section('page_title', 'Danh Sách Tài Khoản')

@section('content')
<div class="flex flex-col gap-space-lg">
    <!-- Header with Search and Filter -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-space-lg rounded-xl shadow-sm border border-gray-100">
        <div>
            <h1 class="font-headline-md text-xl font-bold text-on-surface">Danh Sách Người Dùng &amp; Hội Viên</h1>
            <p class="text-xs text-on-surface-variant">Quản lý tài khoản khách hàng, nhân viên và phân quyền truy cập</p>
        </div>

        <form action="{{ route('admin.tai-khoans.index') }}" method="GET" class="flex flex-wrap items-center gap-2">
            <div class="flex items-center bg-gray-100 px-3 py-2 rounded-xl text-xs w-64">
                <span class="material-symbols-outlined text-[18px] text-gray-400 mr-1.5">search</span>
                <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Tìm theo tên, email, SĐT..." class="bg-transparent text-gray-800 placeholder-gray-400 focus:outline-none w-full">
            </div>
            <select name="vai_tro_id" class="bg-gray-100 px-3 py-2 rounded-xl text-xs text-gray-700 border-none focus:ring-0">
                <option value="">Tất cả vai trò</option>
                @foreach($vaiTros as $vt)
                    <option value="{{ $vt->id }}" {{ request('vai_tro_id') == $vt->id ? 'selected' : '' }}>{{ $vt->ten_vai_tro }}</option>
                @endforeach
            </select>
            <button type="submit" class="px-4 py-2 rounded-xl bg-primary-container text-white text-xs font-bold hover:bg-black transition-all">Lọc</button>
        </form>
    </div>

    <!-- Table of Users -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left text-xs">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100 text-gray-500 font-bold uppercase text-[10px]">
                    <th class="py-3.5 px-4">Mã TK</th>
                    <th class="py-3.5 px-4">Họ và Tên</th>
                    <th class="py-3.5 px-4">Email</th>
                    <th class="py-3.5 px-4">Số Điện Thoại</th>
                    <th class="py-3.5 px-4">Vai Trò</th>
                    <th class="py-3.5 px-4">Trạng Thái</th>
                    <th class="py-3.5 px-4">Ngày Đăng Ký</th>
                    <th class="py-3.5 px-4 text-right">Chi Tiết</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($taiKhoans as $tk)
                <tr class="hover:bg-gray-50/70 transition-colors">
                    <td class="py-3 px-4 font-mono font-bold text-primary-container">{{ $tk->ma_tk ?? 'TK' . str_pad($tk->id, 4, '0', STR_PAD_LEFT) }}</td>
                    <td class="py-3 px-4 font-semibold text-gray-900">{{ $tk->ho_ten }}</td>
                    <td class="py-3 px-4 text-gray-600">{{ $tk->email }}</td>
                    <td class="py-3 px-4 text-gray-600">{{ $tk->so_dien_thoai ?? '—' }}</td>
                    <td class="py-3 px-4">
                        @if($tk->vai_tro_id == 1)
                            <span class="px-2 py-0.5 rounded-full bg-red-50 text-red-700 font-bold text-[10px]">Quản trị viên</span>
                        @elseif($tk->vai_tro_id == 2)
                            <span class="px-2 py-0.5 rounded-full bg-blue-50 text-blue-700 font-bold text-[10px]">Lễ tân</span>
                        @else
                            <span class="px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 font-bold text-[10px]">Khách hàng</span>
                        @endif
                    </td>
                    <td class="py-3 px-4">
                        @if($tk->trang_thai === 'hoat_dong')
                            <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-emerald-700">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Hoạt động
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-red-700">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Đã khóa
                            </span>
                        @endif
                    </td>
                    <td class="py-3 px-4 text-gray-500">{{ $tk->created_at->format('d/m/Y') }}</td>
                    <td class="py-3 px-4 text-right">
                        <a href="{{ route('admin.tai-khoans.show', $tk->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-xs font-semibold transition-colors">
                            <span class="material-symbols-outlined text-[16px]">visibility</span>
                            <span>Xem</span>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="py-8 text-center text-gray-500">Không tìm thấy tài khoản nào khớp yêu cầu.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        @if(method_exists($taiKhoans, 'links'))
        <div class="p-4 border-t border-gray-100">
            {{ $taiKhoans->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
