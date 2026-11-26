@extends('layouts.admin')

@section('title', 'Quản Lý Buồng Phòng')
@section('page_title', 'Quản Lý Sơ Đồ Buồng Phòng')

@section('content')
<div class="flex flex-col w-full gap-space-lg">
    <!-- Header & Action Bar -->
    <section class="flex flex-col lg:flex-row lg:items-center justify-between gap-space-md bg-surface-container-lowest p-space-lg rounded-xl shadow-sm border border-gray-100">
        <div class="flex flex-col gap-space-xs">
            <div class="flex items-center gap-space-xs">
                <span class="inline-flex w-2.5 h-2.5 rounded-full bg-secondary animate-pulse"></span>
                <span class="text-[11px] uppercase tracking-wider text-secondary font-bold">Hạ Tầng Lưu Trú • UC5 Sơ Đồ Buồng Phòng</span>
            </div>
            <h1 class="font-headline text-2xl text-on-surface font-bold tracking-tight">
                Quản Lý Sơ Đồ Buồng Phòng
            </h1>
            <p class="text-xs text-on-surface-variant flex items-center gap-1.5">
                <span>Theo dõi trực quan buồng phòng theo phân tầng tòa nhà, cập nhật trạng thái dọn dẹp và giá niêm yết</span>
            </p>
        </div>

        <div class="flex items-center gap-2">
            <button id="btn-add-room" type="button" class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl bg-primary-container text-white hover:bg-black transition-all text-xs font-bold shadow-md cursor-pointer">
                <span class="material-symbols-outlined text-[18px]">add</span>
                <span>Thêm Phòng Mới</span>
            </button>
        </div>
    </section>

    

    <!-- Status Filter Pills & Search Cockpit -->
    <div class="bg-surface-container-lowest p-space-md rounded-xl shadow-sm border border-gray-100 flex flex-col lg:flex-row lg:items-center justify-between gap-3">
        <div class="flex flex-wrap items-center gap-1.5" id="status-filter-pills">
            <button class="filter-pill active px-3.5 py-1.5 rounded-full bg-primary-container text-white text-xs font-bold transition-all flex items-center gap-1.5 cursor-pointer shadow-sm" data-status="all" type="button">
                <span>Tất cả ({{ $metrics['total'] }})</span>
            </button>
            <button class="filter-pill px-3.5 py-1.5 rounded-full bg-gray-100 text-gray-600 hover:bg-gray-200 text-xs font-bold transition-all flex items-center gap-1.5 cursor-pointer" data-status="trong" type="button">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span>Sẵn sàng ({{ $metrics['trong'] }})</span>
            </button>
            <button class="filter-pill px-3.5 py-1.5 rounded-full bg-gray-100 text-gray-600 hover:bg-gray-200 text-xs font-bold transition-all flex items-center gap-1.5 cursor-pointer" data-status="dang_o" type="button">
                <span class="w-2 h-2 rounded-full bg-primary-container"></span>
                <span>Đang có khách ({{ $metrics['dang_o'] }})</span>
            </button>
            <button class="filter-pill px-3.5 py-1.5 rounded-full bg-gray-100 text-gray-600 hover:bg-gray-200 text-xs font-bold transition-all flex items-center gap-1.5 cursor-pointer" data-status="dang_don" type="button">
                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                <span>Đang dọn ({{ $metrics['dang_don'] }})</span>
            </button>
            <button class="filter-pill px-3.5 py-1.5 rounded-full bg-gray-100 text-gray-600 hover:bg-gray-200 text-xs font-bold transition-all flex items-center gap-1.5 cursor-pointer" data-status="bao_tri" type="button">
                <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                <span>Bảo trì ({{ $metrics['bao_tri'] }})</span>
            </button>
        </div>

        <div class="flex flex-wrap sm:flex-nowrap items-center gap-2">
            <div class="relative flex-1 sm:w-56">
                <span class="material-symbols-outlined text-[18px] text-outline absolute left-3 top-1/2 -translate-y-1/2">search</span>
                <input class="w-full h-10 pl-9 pr-3 rounded-xl bg-surface-container-low text-xs text-on-surface placeholder:text-outline focus:outline-none focus:bg-surface-container transition-colors" id="room-search-input" placeholder="Tìm số phòng (VD: 101)..." type="text"/>
            </div>
            <select class="h-10 px-3 rounded-xl bg-surface-container-low text-xs font-semibold text-on-surface focus:outline-none cursor-pointer" id="floor-filter">
                <option value="all">Tất cả các tầng</option>
                @foreach($phongsByFloor->keys() as $floor)
                <option value="{{ $floor }}">Tầng {{ str_pad($floor, 2, '0', STR_PAD_LEFT) }}</option>
                @endforeach
            </select>
            <select class="h-10 px-3 rounded-xl bg-surface-container-low text-xs font-semibold text-on-surface focus:outline-none cursor-pointer" id="type-filter">
                <option value="all">Tất cả loại phòng</option>
                @foreach($loaiPhongs as $lp)
                <option value="{{ $lp->id }}">{{ $lp->ten_loai_phong }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Floors & Rooms Container -->
    <div class="flex flex-col gap-6" id="floors-container">
        @forelse($phongsByFloor as $tang => $floorRooms)
        <section class="floor-section flex flex-col gap-3" data-floor="{{ $tang }}">
            <div class="flex items-center justify-between border-b border-gray-100 pb-2">
                <div class="flex items-center gap-2">
                    <span class="px-2.5 py-1 rounded-lg bg-primary-container text-white text-xs font-bold">TẦNG {{ str_pad($tang, 2, '0', STR_PAD_LEFT) }}</span>
                    <h2 class="font-headline font-bold text-base text-on-surface">
                        @if($tang == 1) Khu Vườn Sinh Thái (Garden Suites)
                        @elseif($tang == 2) Hạng Sang Ocean Front (Ocean Suites)
                        @elseif($tang == 3) Khu Vực Gia Đình & Executive
                        @elseif($tang == 4) Signature Penthouse VIP
                        @else Tầng Lưu Trú {{ $tang }}
                        @endif
                    </h2>
                </div>
                <span class="text-xs text-on-surface-variant font-medium">
                    {{ $floorRooms->count() }} Buồng • <span class="text-emerald-600 font-bold">{{ $floorRooms->where('trang_thai', 'trong')->count() }} Sẵn sàng</span>
                </span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                @foreach($floorRooms as $p)
                <div class="room-card bg-surface-container-lowest rounded-xl p-4 shadow-sm border border-gray-100 hover:border-secondary/40 transition-all flex flex-col justify-between gap-3" 
                     data-room="{{ $p->so_phong }}" 
                     data-status="{{ $p->trang_thai }}" 
                     data-type="{{ $p->loai_phong_id }}"
                     data-floor="{{ $tang }}">
                    
                    <div class="flex items-start justify-between">
                        <div class="flex flex-col">
                            <span class="font-headline text-2xl font-bold text-on-surface tracking-tight">{{ $p->so_phong }}</span>
                            <span class="text-xs text-on-surface-variant font-semibold truncate">{{ $p->loaiPhong ? $p->loaiPhong->ten_loai_phong : 'Chưa phân loại' }}</span>
                        </div>
                        
                        <!-- Status Badge -->
                        @if($p->trang_thai === 'trong')
                            <span class="px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 text-[10px] uppercase font-bold">Sẵn sàng</span>
                        @elseif($p->trang_thai === 'dang_o')
                            <span class="px-2.5 py-1 rounded-full bg-blue-50 text-blue-700 text-[10px] uppercase font-bold">Đang ở</span>
                        @elseif($p->trang_thai === 'dang_don')
                            <span class="px-2.5 py-1 rounded-full bg-amber-50 text-amber-700 text-[10px] uppercase font-bold">Đang dọn</span>
                        @else
                            <span class="px-2.5 py-1 rounded-full bg-rose-50 text-rose-700 text-[10px] uppercase font-bold">Bảo trì</span>
                        @endif
                    </div>

                    <div class="flex items-center gap-2 text-on-surface-variant text-[11px] font-medium">
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">square_foot</span> {{ $p->dien_tich ?? 40 }}m²</span>
                        <span>•</span>
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">group</span> {{ $p->suc_chua_toi_da }} khách</span>
                    </div>

                    <div class="flex items-center justify-between pt-2 border-t border-gray-50">
                        <div class="flex flex-col">
                            <span class="text-[10px] text-outline font-semibold">Giá niêm yết</span>
                            <span class="font-headline font-bold text-sm text-on-surface">{{ number_format($p->gia_moi_dem, 0, ',', '.') }}đ <span class="text-[10px] text-outline font-normal">/đêm</span></span>
                        </div>
                        <div class="flex items-center gap-1">
                            <!-- Đổi nhanh trạng thái -->
                            <form action="{{ route('admin.phongs.update-status', $p->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <select name="trang_thai" onchange="this.form.submit()" class="text-[10px] h-7 px-1 rounded-lg bg-gray-50 border border-gray-200 text-gray-700 font-semibold focus:outline-none cursor-pointer">
                                    <option value="trong" {{ $p->trang_thai === 'trong' ? 'selected' : '' }}>Sẵn sàng</option>
                                    <option value="dang_o" {{ $p->trang_thai === 'dang_o' ? 'selected' : '' }}>Có khách</option>
                                    <option value="dang_don" {{ $p->trang_thai === 'dang_don' ? 'selected' : '' }}>Đang dọn</option>
                                    <option value="bao_tri" {{ $p->trang_thai === 'bao_tri' ? 'selected' : '' }}>Bảo trì</option>
                                </select>
                            </form>

                            <button onclick='openEditModal(@json($p))' class="p-1.5 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface transition-colors cursor-pointer" title="Xem / Sửa" type="button">
                                <span class="material-symbols-outlined text-[16px]">edit</span>
                            </button>
                            
                            <form action="{{ route('admin.phongs.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Chuyển buồng phòng {{ $p->so_phong }} vào thùng rác?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="p-1.5 rounded-lg bg-rose-50 text-rose-700 hover:bg-rose-100 transition-colors cursor-pointer" title="Xóa" type="submit">
                                    <span class="material-symbols-outlined text-[16px]">delete</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @empty
        <div class="py-8 text-center text-outline bg-surface-container-lowest rounded-xl border border-gray-100">
            Chưa có buồng phòng nào được tạo trong hệ thống.
        </div>
        @endforelse
    </div>
</div>

<!-- Modal Thêm / Sửa Buồng Phòng (Đúng giao diện theo c:\Users\Admin\Downloads\quanlyphong\modal_them_sua_phong) -->
<div id="room-modal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-primary-container/70 backdrop-blur-md p-space-md overflow-y-auto" role="dialog" aria-modal="true">
    <div class="relative w-full max-w-4xl bg-surface-container-lowest rounded-xl shadow-[0_24px_50px_-12px_rgba(11,28,48,0.25)] flex flex-col overflow-hidden my-auto max-h-[92vh]">
        <!-- Top Decorative Accent Bar -->
        <div class="h-1.5 w-full bg-gradient-to-r from-secondary-container via-secondary to-primary-container"></div>
        
        <!-- 1. Modal Header -->
        <div class="px-gutter-lg pt-space-lg pb-space-md flex items-start justify-between bg-surface-container-lowest relative border-b border-gray-100">
            <div class="flex items-start gap-space-md">
                <div class="w-12 h-12 rounded-xl bg-secondary/10 flex items-center justify-center text-secondary shrink-0 mt-0.5">
                    <span class="material-symbols-outlined text-[26px]">meeting_room</span>
                </div>
                <div class="flex flex-col gap-0.5">
                    <h2 class="font-headline-md text-lg font-bold text-on-surface" id="room-modal-title">Thiết Lập Thông Tin Phòng Mới</h2>
                    <p class="font-body-sm text-xs text-on-surface-variant">Khai báo số phòng, vị trí tầng, hạng phòng liên kết và biểu giá theo đêm</p>
                </div>
            </div>
            <button id="btn-close-room-modal" aria-label="Đóng cửa sổ" class="w-9 h-9 rounded-xl flex items-center justify-center text-outline hover:bg-surface-container hover:text-on-surface transition-colors cursor-pointer" type="button">
                <span class="material-symbols-outlined text-[20px]">close</span>
            </button>
        </div>

        <!-- Scrollable Form Body -->
        <form id="room-form" method="POST" enctype="multipart/form-data" action="{{ route('admin.phongs.store') }}" class="px-gutter-lg py-space-md flex flex-col gap-space-lg overflow-y-auto max-h-[calc(90vh-190px)] text-xs">
            @csrf
            <div id="room-method-container"></div>

            <!-- Section 1: Thông tin định danh buồng phòng -->
            <div class="bg-surface-container-low p-space-lg rounded-xl flex flex-col gap-space-md">
                <div class="flex items-center justify-between pb-space-xs">
                    <div class="flex items-center gap-space-xs">
                        <span class="w-1.5 h-3.5 rounded-full bg-secondary"></span>
                        <span class="font-label-lg text-xs uppercase tracking-wider text-on-surface font-bold">1. Định Danh &amp; Vị Trí Tòa Nhà</span>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-12 gap-space-md">
                    <!-- Mã phòng -->
                    <div class="md:col-span-3 flex flex-col gap-1.5">
                        <label class="font-label-md text-on-surface flex items-center gap-1 font-semibold">
                            <span>Số Phòng / Mã Phòng</span>
                            <span class="text-error font-bold">*</span>
                        </label>
                        <div class="relative flex items-center">
                            <span class="material-symbols-outlined absolute left-space-sm text-outline text-[18px]">pin</span>
                            <input id="input-so-phong" name="so_phong" class="w-full h-11 pl-9 pr-space-md rounded-lg bg-surface-container-lowest text-on-surface font-headline-sm text-base font-bold tracking-wider focus:outline-none focus:ring-2 focus:ring-secondary/40 shadow-sm" placeholder="VD: 105, 305" required="" type="text">
                        </div>
                        <span class="font-label-sm text-[10px] text-outline">Định danh buồng phòng duy nhất</span>
                    </div>
                    <!-- Tầng lầu -->
                    <div class="md:col-span-4 flex flex-col gap-1.5">
                        <label class="font-label-md text-on-surface flex items-center gap-1 font-semibold">
                            <span>Tầng Lầu • Khu Vực</span>
                            <span class="text-error font-bold">*</span>
                        </label>
                        <div class="relative flex items-center">
                            <span class="material-symbols-outlined absolute left-space-sm text-outline text-[18px]">layers</span>
                            <select id="input-tang" name="tang" class="w-full h-11 pl-9 pr-space-md rounded-lg bg-surface-container-lowest text-on-surface font-body-md text-xs focus:outline-none focus:ring-2 focus:ring-secondary/40 shadow-sm cursor-pointer">
                                <option value="1">Tầng 01 • Khu Vườn Sinh Thái</option>
                                <option value="2">Tầng 02 • Hạng Sang Ocean Front</option>
                                <option value="3" selected="">Tầng 03 • Gia Đình &amp; Executive Suite</option>
                                <option value="4">Tầng 04 • Signature Penthouse VIP</option>
                                <option value="5">Tầng 05 • Sky Lounge</option>
                            </select>
                        </div>
                        <span class="font-label-sm text-[10px] text-outline">Khu vực phân tầng buồng phòng</span>
                    </div>
                    <!-- Loại phòng liên kết (UC6 Catalog) -->
                    <div class="md:col-span-5 flex flex-col gap-1.5">
                        <label class="font-label-md text-on-surface flex items-center gap-1 font-semibold">
                            <span>Hạng Phòng Liên Kết (UC6 Catalog)</span>
                            <span class="text-error font-bold">*</span>
                        </label>
                        <div class="relative flex items-center">
                            <span class="material-symbols-outlined absolute left-space-sm text-outline text-[18px]">category</span>
                            <select id="input-loai-phong-id" name="loai_phong_id" class="w-full h-11 pl-9 pr-space-md rounded-lg bg-surface-container-lowest text-on-surface font-body-md text-xs focus:outline-none focus:ring-2 focus:ring-secondary/40 shadow-sm cursor-pointer" onchange="onLoaiPhongChange(this)">
                                @foreach($loaiPhongs as $lp)
                                <option value="{{ $lp->id }}" data-price="{{ $lp->gia_mac_dinh }}" data-capacity="{{ $lp->so_nguoi_toi_da }}">
                                    {{ $lp->ten_loai_phong }} ({{ number_format($lp->gia_mac_dinh, 0, ',', '.') }}đ)
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <span class="font-label-sm text-[10px] text-outline">Đồng bộ chính sách &amp; tiện ích theo hạng</span>
                    </div>
                </div>
            </div>

            <!-- Section 2: Mức giá áp dụng & Tùy chọn cấu hình -->
            <div class="bg-surface-container-low p-space-lg rounded-xl flex flex-col gap-space-md">
                <div class="flex items-center justify-between pb-space-xs">
                    <div class="flex items-center gap-space-xs">
                        <span class="w-1.5 h-3.5 rounded-full bg-secondary"></span>
                        <span class="font-label-lg text-xs uppercase tracking-wider text-on-surface font-bold">2. Biểu Giá &amp; Đặc Tính Buồng</span>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-12 gap-space-md">
                    <!-- Giá niêm yết theo đêm -->
                    <div class="md:col-span-5 flex flex-col gap-1.5">
                        <label class="font-label-md text-on-surface flex items-center justify-between font-semibold">
                            <span>Giá Niêm Yết Theo Đêm</span>
                            <span class="font-label-sm text-[10px] text-outline">VND / Đêm</span>
                        </label>
                        <div class="relative flex items-center">
                            <span class="material-symbols-outlined absolute left-space-sm text-secondary text-[18px]">payments</span>
                            <input id="input-gia-moi-dem" name="gia_moi_dem" required class="w-full h-11 pl-9 pr-space-md rounded-lg bg-surface-container-lowest text-on-surface font-headline font-bold text-sm tracking-tight focus:outline-none focus:ring-2 focus:ring-secondary/40 shadow-sm" type="number" min="0" step="10000" placeholder="1850000">
                            <span class="absolute right-space-sm text-outline font-label-sm text-[10px] font-bold">VNĐ</span>
                        </div>
                        <span class="font-label-sm text-[10px] text-on-surface-variant">Đơn giá chuẩn theo đêm lưu trú</span>
                    </div>
                    <!-- Diện tích -->
                    <div class="md:col-span-3 flex flex-col gap-1.5">
                        <label class="font-label-md text-on-surface font-semibold">
                            <span>Diện Tích (m²)</span>
                        </label>
                        <div class="relative flex items-center">
                            <span class="material-symbols-outlined absolute left-space-sm text-outline text-[18px]">square_foot</span>
                            <input id="input-dien-tich-phong" name="dien_tich" class="w-full h-11 pl-9 pr-space-md rounded-lg bg-surface-container-lowest text-on-surface font-body-md text-xs focus:outline-none focus:ring-2 focus:ring-secondary/40 shadow-sm" type="number" step="0.1" placeholder="VD: 45">
                        </div>
                        <span class="font-label-sm text-[10px] text-outline">Diện tích sàn thực tế</span>
                    </div>
                    <!-- Sức chứa tiêu chuẩn -->
                    <div class="md:col-span-4 flex flex-col gap-1.5">
                        <label class="font-label-md text-on-surface font-semibold flex items-center justify-between">
                            <span>Sức Chứa Tiêu Chuẩn</span>
                            <span class="font-label-sm text-[10px] text-outline">Số người ở</span>
                        </label>
                        <div class="relative flex items-center">
                            <span class="material-symbols-outlined absolute left-space-sm text-outline text-[18px]">person</span>
                            <select id="input-suc-chua" name="suc_chua_toi_da" class="w-full h-11 pl-9 pr-space-md rounded-lg bg-surface-container-lowest text-on-surface font-body-md text-xs focus:outline-none focus:ring-2 focus:ring-secondary/40 shadow-sm cursor-pointer">
                                <option value="1">1 Người lớn</option>
                                <option value="2" selected="">2 Người lớn</option>
                                <option value="3">3 Người lớn</option>
                                <option value="4">4 Người lớn</option>
                                <option value="6">6 Người lớn</option>
                            </select>
                        </div>
                        <span class="font-label-sm text-[10px] text-outline">Quy định số khách tối đa</span>
                    </div>
                    <!-- Mô tả chi tiết buồng phòng -->
                    <div class="md:col-span-12 flex flex-col gap-1.5">
                        <label class="font-label-md text-on-surface font-semibold flex items-center justify-between">
                            <span>Mô Tả Chi Tiết Về Buồng Phòng</span>
                            <span class="font-label-sm text-[10px] text-outline">Hiển thị khách đặt</span>
                        </label>
                        <textarea id="input-mo-ta-phong" name="mo_ta" class="w-full p-space-sm rounded-lg bg-surface-container-lowest text-on-surface font-body-md text-xs focus:outline-none focus:ring-2 focus:ring-secondary/40 shadow-sm resize-none" placeholder="Nhập mô tả cụ thể về diện tích, tầm nhìn, phong cách bày trí hoặc đặc điểm riêng của buồng phòng này..." rows="3"></textarea>
                    </div>
                </div>
            </div>

            <!-- Section 3: Ảnh thực tế buồng phòng -->
            <div class="bg-surface-container-low p-space-lg rounded-xl flex flex-col gap-space-md">
                <div class="flex items-center justify-between pb-space-xs">
                    <div class="flex items-center gap-space-xs">
                        <span class="w-1.5 h-3.5 rounded-full bg-secondary"></span>
                        <span class="font-label-lg text-xs uppercase tracking-wider text-on-surface font-bold">3. Ảnh Thực Tế Buồng Phòng</span>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
                    <div class="flex flex-col gap-1.5">
                        <label class="font-semibold text-gray-700">Tải tệp ảnh chụp thực tế (Hỗ trợ nhiều ảnh)</label>
                        <input name="hinh_anh_files[]" type="file" multiple accept="image/*" class="w-full p-2 rounded-lg bg-surface-container-lowest text-xs text-gray-600 border border-dashed border-gray-300">
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <label class="font-semibold text-gray-700">Hoặc liên kết hình ảnh trực tuyến (URL)</label>
                        <input id="input-online-url" name="hinh_anh_url" type="url" placeholder="https://..." class="w-full h-11 px-space-md rounded-lg bg-surface-container-lowest text-on-surface font-body-md text-xs focus:outline-none focus:ring-2 focus:ring-secondary/40 shadow-sm">
                    </div>
                </div>
            </div>

            <!-- Section 4: Trạng thái buồng phòng & Phụ trách -->
            <div class="bg-surface-container-low p-space-lg rounded-xl flex flex-col gap-space-md">
                <div class="flex items-center justify-between pb-space-xs">
                    <div class="flex items-center gap-space-xs">
                        <span class="w-1.5 h-3.5 rounded-full bg-secondary"></span>
                        <span class="font-label-lg text-xs uppercase tracking-wider text-on-surface font-bold">4. Trạng Thái Vận Hành Khởi Tạo</span>
                    </div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-space-sm">
                    <!-- Pill 1: Sẵn sàng -->
                    <label class="cursor-pointer">
                        <input class="peer sr-only status-radio" name="trang_thai" type="radio" value="trong" checked="">
                        <div class="p-space-sm rounded-xl bg-surface-container-lowest peer-checked:bg-emerald-50 peer-checked:text-emerald-800 peer-checked:ring-2 peer-checked:ring-emerald-500 flex items-center gap-space-sm transition-all shadow-sm">
                            <span class="material-symbols-outlined text-[20px] text-emerald-600">check_circle</span>
                            <div class="flex flex-col text-left">
                                <span class="font-label-md text-xs font-bold">SẴN SÀNG</span>
                                <span class="font-label-sm text-outline text-[10px]">Đón khách ngay</span>
                            </div>
                        </div>
                    </label>
                    <!-- Pill 2: Đang dọn dẹp -->
                    <label class="cursor-pointer">
                        <input class="peer sr-only status-radio" name="trang_thai" type="radio" value="dang_don">
                        <div class="p-space-sm rounded-xl bg-surface-container-lowest peer-checked:bg-amber-50 peer-checked:text-amber-800 peer-checked:ring-2 peer-checked:ring-amber-500 flex items-center gap-space-sm transition-all shadow-sm">
                            <span class="material-symbols-outlined text-[20px] text-amber-600">cleaning_services</span>
                            <div class="flex flex-col text-left">
                                <span class="font-label-md text-xs font-bold">ĐANG DỌN DẸP</span>
                                <span class="font-label-sm text-outline text-[10px]">Buồng đang xử lý</span>
                            </div>
                        </div>
                    </label>
                    <!-- Pill 3: Đang bảo trì -->
                    <label class="cursor-pointer">
                        <input class="peer sr-only status-radio" name="trang_thai" type="radio" value="bao_tri">
                        <div class="p-space-sm rounded-xl bg-surface-container-lowest peer-checked:bg-rose-50 peer-checked:text-rose-800 peer-checked:ring-2 peer-checked:ring-rose-500 flex items-center gap-space-sm transition-all shadow-sm">
                            <span class="material-symbols-outlined text-[20px] text-rose-600">construction</span>
                            <div class="flex flex-col text-left">
                                <span class="font-label-md text-xs font-bold">ĐANG BẢO TRÌ</span>
                                <span class="font-label-sm text-outline text-[10px]">Tạm khóa bán</span>
                            </div>
                        </div>
                    </label>
                    <!-- Pill 4: Đang có khách -->
                    <label class="cursor-pointer">
                        <input class="peer sr-only status-radio" name="trang_thai" type="radio" value="dang_o">
                        <div class="p-space-sm rounded-xl bg-surface-container-lowest peer-checked:bg-blue-50 peer-checked:text-blue-800 peer-checked:ring-2 peer-checked:ring-blue-500 flex items-center gap-space-sm transition-all shadow-sm">
                            <span class="material-symbols-outlined text-[20px] text-blue-600">person</span>
                            <div class="flex flex-col text-left">
                                <span class="font-label-md text-xs font-bold">ĐANG CÓ KHÁCH</span>
                                <span class="font-label-sm text-outline text-[10px]">Đã lưu trú</span>
                            </div>
                        </div>
                    </label>
                </div>
            </div>

            <!-- 3. Modal Footer -->
            <div class="px-gutter-lg py-space-md bg-surface-container flex items-center justify-between -mx-gutter-lg -mb-space-md mt-2">
                <div class="flex items-center gap-space-xs text-outline font-label-sm text-[11px]">
                    <span class="material-symbols-outlined text-[16px] text-secondary">verified_user</span>
                    <span>Dữ liệu buồng phòng sẽ được mã hóa và đồng bộ tức thì trên Aura Core PMS</span>
                </div>
                <div class="flex items-center gap-space-sm">
                    <button class="px-space-lg py-space-sm rounded-xl font-label-md text-xs font-semibold text-on-surface hover:bg-surface-container-high transition-colors cursor-pointer" id="btn-cancel-room" type="button">
                        Hủy Bỏ
                    </button>
                    <button class="px-space-xl py-space-sm rounded-xl font-label-md text-xs font-bold text-on-secondary bg-secondary hover:bg-secondary/90 shadow-md flex items-center gap-space-xs transition-transform active:scale-95 cursor-pointer" id="btn-save-room" type="submit">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        <span>Lưu Thông Tin Phòng</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    (function () {
        const roomModal = document.getElementById('room-modal');
        const roomForm = document.getElementById('room-form');
        const roomModalTitle = document.getElementById('room-modal-title');
        const roomMethodContainer = document.getElementById('room-method-container');
        const btnAddRoom = document.getElementById('btn-add-room');
        const btnCloseRoom = document.getElementById('btn-close-room-modal');
        const btnCancelRoom = document.getElementById('btn-cancel-room');

        function showRoomModal() {
            roomModal.classList.remove('hidden');
            roomModal.classList.add('flex');
        }

        function hideRoomModal() {
            roomModal.classList.add('hidden');
            roomModal.classList.remove('flex');
        }

        window.onLoaiPhongChange = function (select) {
            const opt = select.options[select.selectedIndex];
            if (opt) {
                const price = opt.getAttribute('data-price');
                const cap = opt.getAttribute('data-capacity');
                if (price) document.getElementById('input-gia-moi-dem').value = price;
                if (cap) document.getElementById('input-suc-chua').value = cap;
            }
        };

        window.openCreateModal = function () {
            roomModalTitle.textContent = 'Thiết Lập Thông Tin Phòng Mới';
            roomForm.action = "{{ route('admin.phongs.store') }}";
            roomMethodContainer.innerHTML = '';
            roomForm.reset();

            const lpSelect = document.getElementById('input-loai-phong-id');
            if (lpSelect) window.onLoaiPhongChange(lpSelect);

            showRoomModal();
        };

        window.openEditModal = function (phong) {
            roomModalTitle.textContent = 'Chỉnh Sửa Thông Tin Buồng Phòng ' + phong.so_phong;
            roomForm.action = "/admin/phongs/" + phong.id;
            roomMethodContainer.innerHTML = '@method("PUT")';

            document.getElementById('input-so-phong').value = phong.so_phong || '';
            document.getElementById('input-tang').value = phong.tang || 1;
            document.getElementById('input-loai-phong-id').value = phong.loai_phong_id || '';
            document.getElementById('input-gia-moi-dem').value = phong.gia_moi_dem || 0;
            document.getElementById('input-dien-tich-phong').value = phong.dien_tich || '';
            document.getElementById('input-suc-chua').value = phong.suc_chua_toi_da || 2;
            document.getElementById('input-mo-ta-phong').value = phong.mo_ta || '';

            // Set radio button status
            const radios = document.querySelectorAll('.status-radio');
            radios.forEach(r => {
                r.checked = (r.value === phong.trang_thai);
            });

            showRoomModal();
        };

        if (btnAddRoom) btnAddRoom.addEventListener('click', window.openCreateModal);
        if (btnCloseRoom) btnCloseRoom.addEventListener('click', hideRoomModal);
        if (btnCancelRoom) btnCancelRoom.addEventListener('click', hideRoomModal);

        // Filter pills & search
        const pills = document.querySelectorAll('.filter-pill');
        const searchInput = document.getElementById('room-search-input');
        const floorFilter = document.getElementById('floor-filter');
        const typeFilter = document.getElementById('type-filter');
        const roomCards = document.querySelectorAll('.room-card');
        const floorSections = document.querySelectorAll('.floor-section');

        let currentStatus = 'all';

        pills.forEach(pill => {
            pill.addEventListener('click', function () {
                pills.forEach(p => {
                    p.classList.remove('active', 'bg-primary-container', 'text-white', 'shadow-sm');
                    p.classList.add('bg-gray-100', 'text-gray-600');
                });
                this.classList.add('active', 'bg-primary-container', 'text-white', 'shadow-sm');
                this.classList.remove('bg-gray-100', 'text-gray-600');
                currentStatus = this.getAttribute('data-status');
                applyFilters();
            });
        });

        function applyFilters() {
            const query = (searchInput.value || '').toLowerCase().trim();
            const floorVal = floorFilter.value;
            const typeVal = typeFilter.value;

            roomCards.forEach(card => {
                const roomNo = (card.getAttribute('data-room') || '').toLowerCase();
                const status = card.getAttribute('data-status') || '';
                const type = card.getAttribute('data-type') || '';
                const floor = card.getAttribute('data-floor') || '';

                const matchesSearch = !query || roomNo.includes(query);
                const matchesStatus = currentStatus === 'all' || status === currentStatus;
                const matchesFloor = floorVal === 'all' || floor === floorVal;
                const matchesType = typeVal === 'all' || type === typeVal;

                if (matchesSearch && matchesStatus && matchesFloor && matchesType) {
                    card.classList.remove('hidden');
                } else {
                    card.classList.add('hidden');
                }
            });

            floorSections.forEach(sec => {
                const visible = sec.querySelectorAll('.room-card:not(.hidden)').length;
                if (visible === 0) {
                    sec.classList.add('hidden');
                } else {
                    sec.classList.remove('hidden');
                }
            });
        }

        if (searchInput) searchInput.addEventListener('input', applyFilters);
        if (floorFilter) floorFilter.addEventListener('change', applyFilters);
        if (typeFilter) typeFilter.addEventListener('change', applyFilters);
    })();
</script>
@endpush
