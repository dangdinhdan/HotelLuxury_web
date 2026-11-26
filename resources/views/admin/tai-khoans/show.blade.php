@extends('layouts.admin')

@section('title', 'Hồ Sơ Tài Khoản - ' . $taiKhoan->ho_ten)
@section('page_title', 'Hồ Sơ Tài Khoản')

@section('content')
<div class="flex flex-col gap-space-lg max-w-4xl">
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.tai-khoans.index') }}" class="inline-flex items-center gap-1 text-xs text-gray-500 hover:text-gray-900 font-semibold">
            <span class="material-symbols-outlined text-[16px]">arrow_back</span>
            <span>Quay lại danh sách</span>
        </a>
    </div>

    <!-- Profile Details Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-space-lg border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-full bg-primary-container text-white text-2xl font-bold flex items-center justify-center">
                    {{ strtoupper(substr($taiKhoan->ho_ten, 0, 1)) }}
                </div>
                <div>
                    <h2 class="font-headline-sm text-xl font-bold text-gray-900">{{ $taiKhoan->ho_ten }}</h2>
                    <p class="text-xs text-gray-500 flex items-center gap-2 mt-0.5">
                        <span class="font-mono font-bold">{{ $taiKhoan->ma_tk ?? 'TK' . $taiKhoan->id }}</span>
                        <span>&bull;</span>
                        <span>{{ $taiKhoan->email }}</span>
                    </p>
                </div>
            </div>

            <!-- Delete Form (Only if not current user and not super admin) -->
            @if(Auth::id() !== $taiKhoan->id && $taiKhoan->id > 1)
            <form action="{{ route('admin.tai-khoans.destroy', $taiKhoan->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa tài khoản này?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-3.5 py-2 rounded-xl bg-red-50 text-red-600 hover:bg-red-100 text-xs font-bold transition-colors">
                    Khóa / Xóa Tài Khoản
                </button>
            </form>
            @endif
        </div>

        <form action="{{ route('admin.tai-khoans.update', $taiKhoan->id) }}" method="POST" class="p-space-lg space-y-4">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Họ và Tên</label>
                    <input type="text" name="ho_ten" value="{{ old('ho_ten', $taiKhoan->ho_ten) }}" required class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-xs focus:ring-2 focus:ring-primary-container focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $taiKhoan->email) }}" required class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-xs focus:ring-2 focus:ring-primary-container focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Số Điện Thoại</label>
                    <input type="text" name="so_dien_thoai" value="{{ old('so_dien_thoai', $taiKhoan->so_dien_thoai) }}" class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-xs focus:ring-2 focus:ring-primary-container focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Địa Chỉ</label>
                    <input type="text" name="dia_chi" value="{{ old('dia_chi', $taiKhoan->dia_chi) }}" class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-xs focus:ring-2 focus:ring-primary-container focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Vai Trò</label>
                    <select name="vai_tro_id" class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-xs focus:ring-2 focus:ring-primary-container focus:outline-none">
                        @foreach($vaiTros as $vt)
                            <option value="{{ $vt->id }}" {{ $taiKhoan->vai_tro_id == $vt->id ? 'selected' : '' }}>{{ $vt->ten_vai_tro }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Trạng Thái</label>
                    <select name="trang_thai" class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-xs focus:ring-2 focus:ring-primary-container focus:outline-none">
                        <option value="hoat_dong" {{ $taiKhoan->trang_thai === 'hoat_dong' ? 'selected' : '' }}>Hoạt động</option>
                        <option value="khoa" {{ $taiKhoan->trang_thai === 'khoa' ? 'selected' : '' }}>Tạm khóa</option>
                    </select>
                </div>
            </div>

            <div class="pt-3 border-t border-gray-100 flex justify-end">
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-primary-container text-white text-xs font-bold hover:bg-black shadow-md transition-all">
                    Cập Nhật Thông Tin
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
