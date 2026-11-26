@extends('layouts.admin')

@section('title', 'Quản Lý Loại Phòng')
@section('page_title', 'Quản Lý Loại Phòng')

@section('content')
<div class="flex flex-col w-full gap-space-lg">
    <!-- Header & Primary Action (UC6) -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-space-md bg-surface-container-lowest p-space-lg rounded-xl shadow-sm border border-gray-100">
        <div class="flex flex-col gap-space-xs">
            <div class="flex items-center gap-space-sm">
                <span class="font-label-sm text-label-sm uppercase tracking-wider text-secondary font-bold">Danh Mục Lưu Trú</span>
                <span class="text-outline">•</span>
                <span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">UC6 Catalog</span>
            </div>
            <h1 class="font-headline-lg text-2xl text-on-surface font-bold tracking-tight">Quản Lý Loại Phòng</h1>
            <p class="font-body-md text-xs text-on-surface-variant">Thiết lập danh mục hạng phòng, đơn giá niêm yết, sức chứa tối đa và mô tả tiêu chuẩn</p>
        </div>
        <button id="btn-add-room-type" class="inline-flex items-center justify-center gap-space-sm px-4 py-2.5 rounded-xl bg-primary-container text-white hover:bg-black transition-all shadow-md font-label-lg text-xs font-bold cursor-pointer shrink-0" type="button">
            <span class="material-symbols-outlined text-[18px]">add</span>
            <span>Thêm Loại Phòng Mới</span>
        </button>
    </div>

   

    <!-- Search & Filter Bar -->
    <div class="bg-surface-container-lowest rounded-xl p-space-md shadow-sm border border-gray-100 flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-space-md">
        <div class="relative flex-1 min-w-0">
            <span class="material-symbols-outlined text-[18px] text-outline absolute left-3 top-1/2 -translate-y-1/2">search</span>
            <input class="w-full h-10 pl-9 pr-4 rounded-xl bg-surface-container-low text-on-surface placeholder:text-outline text-xs focus:outline-none focus:bg-surface-container transition-colors" id="search-room-type" placeholder="Tìm kiếm theo tên loại phòng (VD: Deluxe, Suite, Penthouse)..." type="text">
        </div>
        <div class="flex items-center gap-space-sm">
            <div class="flex items-center gap-space-xs bg-surface-container-low rounded-xl px-space-sm h-10">
                <span class="material-symbols-outlined text-[16px] text-on-surface-variant">sell</span>
                <select class="bg-transparent text-on-surface text-xs font-semibold focus:outline-none pr-2 cursor-pointer" id="filter-price">
                    <option value="all">Tất cả mức giá</option>
                    <option value="under-3">Dưới 3.000.000đ</option>
                    <option value="3-6">3.000.000đ – 6.000.000đ</option>
                    <option value="over-6">Trên 6.000.000đ</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Room Types Data Table -->
    <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-surface-container-low text-on-surface-variant uppercase tracking-wider font-bold">
                        <th class="py-3 px-4">Tên Loại Phòng</th>
                        <th class="py-3 px-4">Đơn Giá Mặc Định / Đêm</th>
                        <th class="py-3 px-4">Sức Chứa Tối Đa</th>
                        <th class="py-3 px-4">Mô Tả Tiêu Chuẩn</th>
                        <th class="py-3 px-4 text-center">Số Lượng Buồng</th>
                        <th class="py-3 px-4 text-right">Thao Tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100" id="room-types-tbody">
                    @forelse($loaiPhongs as $lp)
                    <tr class="room-type-row hover:bg-surface-container-low/60 transition-colors" 
                        data-name="{{ strtolower($lp->ten_loai_phong) }}" 
                        data-price="{{ (int)$lp->gia_mac_dinh }}">
                        <td class="py-3.5 px-4 font-bold text-sm text-on-surface">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-secondary"></span>
                                <span>{{ $lp->ten_loai_phong }}</span>
                            </div>
                        </td>
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            <span class="font-headline font-bold text-sm text-secondary">{{ number_format($lp->gia_mac_dinh, 0, ',', '.') }}đ</span>
                            <span class="text-[11px] text-on-surface-variant">/ đêm</span>
                        </td>
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            <span class="inline-flex items-center gap-1 font-semibold text-on-surface">
                                <span class="material-symbols-outlined text-[16px] text-outline">group</span>
                                {{ $lp->so_nguoi_toi_da }} Người lớn
                            </span>
                        </td>
                        <td class="py-3.5 px-4">
                            <p class="text-on-surface-variant line-clamp-2 max-w-md text-[11px] leading-relaxed">
                                {{ $lp->mo_ta ?: 'Chưa có mô tả chi tiết cho loại phòng này.' }}
                            </p>
                        </td>
                        <td class="py-3.5 px-4 text-center whitespace-nowrap">
                            <span class="inline-flex items-center justify-center px-2.5 py-1 rounded-lg bg-surface-container font-bold text-[11px] text-on-surface">
                                {{ $lp->phongs_count }} phòng
                            </span>
                        </td>
                        <td class="py-3.5 px-4 text-right whitespace-nowrap">
                            <div class="inline-flex items-center gap-1">
                                <button class="btn-edit p-1.5 rounded-lg bg-surface-container-low text-on-surface hover:bg-surface-container transition-colors cursor-pointer" 
                                        title="Chỉnh sửa" 
                                        type="button"
                                        onclick='openEditModal(@json($lp))'>
                                    <span class="material-symbols-outlined text-[16px]">edit</span>
                                </button>
                                <form action="{{ route('admin.loai-phongs.destroy', $lp->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa loại phòng này?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="p-1.5 rounded-lg bg-error-container/60 text-on-error-container hover:bg-error-container transition-colors cursor-pointer" title="Xóa hạng phòng" type="submit">
                                        <span class="material-symbols-outlined text-[16px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-outline">Chưa có loại phòng nào trong hệ thống.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Empty State -->
        <div class="hidden py-8 px-4 text-center flex-col items-center gap-2" id="empty-state">
            <span class="material-symbols-outlined text-[32px] text-outline">search_off</span>
            <p class="font-bold text-sm text-on-surface">Không tìm thấy hạng phòng phù hợp</p>
            <p class="text-xs text-on-surface-variant">Vui lòng thử lại với từ khóa hoặc bộ lọc khác.</p>
        </div>
    </div>
</div>

<!-- Modal Thêm / Sửa Loại Phòng (Đúng giao diện theo c:\Users\Admin\Downloads\quanlyloaiphong\modal_them_sua_loaiphong) -->
<div id="room-type-modal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-primary-container/60 backdrop-blur-sm p-space-md overflow-y-auto" role="dialog" aria-modal="true">
    <div class="bg-surface-container-lowest rounded-xl shadow-[0_8px_24px_-4px_rgba(18,26,47,0.12)] w-full max-w-2xl overflow-hidden my-auto border border-outline-variant/30">
        <!-- Header -->
        <div class="px-space-lg py-space-md bg-surface-container-low/50 flex items-start justify-between gap-space-md border-b border-outline-variant/30">
            <div class="flex flex-col gap-space-xs">
                <h2 class="font-headline-md text-lg font-bold text-on-surface" id="modal-title">Thêm / Sửa Loại Phòng Mới</h2>
                <p class="font-body-sm text-xs text-on-surface-variant">Thiết lập thông tin hạng phòng, đơn giá niêm yết và số người tối đa</p>
            </div>
            <button class="p-space-xs rounded-lg text-on-surface-variant hover:bg-surface-container hover:text-on-surface transition-colors cursor-pointer" id="btn-close-modal" title="Đóng" type="button">
                <span class="material-symbols-outlined text-[20px]">close</span>
            </button>
        </div>

        <!-- Form Body -->
        <form id="modal-form" method="POST" action="{{ route('admin.loai-phongs.store') }}" class="p-space-lg flex flex-col gap-space-md max-h-[75vh] overflow-y-auto text-xs">
            @csrf
            <div id="method-container"></div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
                <div class="flex flex-col gap-space-xs">
                    <label class="font-bold text-gray-700">Tên loại phòng <span class="text-error">*</span></label>
                    <input id="input-ten-loai-phong" name="ten_loai_phong" required class="w-full h-11 px-space-md rounded-xl bg-surface-container-low text-on-surface placeholder:text-outline font-body-md text-xs focus:outline-none focus:bg-surface-container transition-colors" placeholder="VD: Deluxe King Garden" type="text">
                </div>
                <div class="flex flex-col gap-space-xs">
                    <label class="font-bold text-gray-700">Đơn giá mặc định / đêm (VNĐ) <span class="text-error">*</span></label>
                    <input id="input-gia-mac-dinh" name="gia_mac_dinh" required class="w-full h-11 px-space-md rounded-xl bg-surface-container-low text-on-surface placeholder:text-outline font-body-md text-xs font-semibold focus:outline-none focus:bg-surface-container transition-colors" placeholder="1850000" type="number" min="0" step="10000">
                </div>
            </div>

            <div class="flex flex-col gap-space-xs">
                <label class="font-bold text-gray-700">Sức chứa người lớn tối đa <span class="text-error">*</span></label>
                <select id="input-so-nguoi-toi-da" name="so_nguoi_toi_da" required class="w-full h-11 px-space-md rounded-xl bg-surface-container-low text-on-surface font-body-md text-xs focus:outline-none focus:bg-surface-container transition-colors cursor-pointer">
                    <option value="1">1 Người lớn</option>
                    <option value="2" selected>2 Người lớn</option>
                    <option value="3">3 Người lớn</option>
                    <option value="4">4 Người lớn</option>
                    <option value="5">5 Người lớn</option>
                    <option value="6">6 Người lớn</option>
                </select>
            </div>

            <div class="flex flex-col gap-space-xs">
                <label class="font-bold text-gray-700">Mô tả tiêu chuẩn</label>
                <textarea id="input-mo-ta" name="mo_ta" class="w-full p-space-md rounded-xl bg-surface-container-low text-on-surface placeholder:text-outline font-body-md text-xs focus:outline-none focus:bg-surface-container transition-colors resize-none leading-relaxed" placeholder="Nhập mô tả ngắn gọn về không gian, tầm nhìn và phong cách kiến trúc đặc trưng của hạng phòng..." rows="4"></textarea>
            </div>

            <!-- Footer Buttons -->
            <div class="px-space-lg py-space-md bg-surface-container-low/50 flex items-center justify-end gap-space-sm border-t border-outline-variant/30 -mx-space-lg -mb-space-lg mt-2">
                <button class="px-space-lg py-2.5 rounded-xl bg-surface-container-lowest border border-outline-variant text-on-surface hover:bg-surface-container transition-colors font-bold text-xs cursor-pointer whitespace-nowrap" id="btn-cancel-modal" type="button">
                    Hủy bỏ
                </button>
                <button class="px-space-lg py-2.5 rounded-xl bg-secondary text-on-secondary hover:bg-on-secondary-fixed-variant transition-all shadow-md font-bold text-xs cursor-pointer" id="btn-save-modal" type="submit">
                    Lưu Loại Phòng
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    (function () {
        const modal = document.getElementById('room-type-modal');
        const modalForm = document.getElementById('modal-form');
        const modalTitle = document.getElementById('modal-title');
        const methodContainer = document.getElementById('method-container');
        const btnAdd = document.getElementById('btn-add-room-type');
        const btnClose = document.getElementById('btn-close-modal');
        const btnCancel = document.getElementById('btn-cancel-modal');

        function showModal() {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function hideModal() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        window.openCreateModal = function () {
            modalTitle.textContent = 'Thêm Loại Phòng Mới';
            modalForm.action = "{{ route('admin.loai-phongs.store') }}";
            methodContainer.innerHTML = '';
            modalForm.reset();
            showModal();
        };

        window.openEditModal = function (lp) {
            modalTitle.textContent = 'Chỉnh Sửa Loại Phòng: ' + lp.ten_loai_phong;
            modalForm.action = "/admin/loai-phongs/" + lp.id;
            methodContainer.innerHTML = '@method("PUT")';

            document.getElementById('input-ten-loai-phong').value = lp.ten_loai_phong || '';
            document.getElementById('input-gia-mac-dinh').value = lp.gia_mac_dinh || 0;
            document.getElementById('input-so-nguoi-toi-da').value = lp.so_nguoi_toi_da || 2;
            document.getElementById('input-mo-ta').value = lp.mo_ta || '';

            showModal();
        };

        if (btnAdd) btnAdd.addEventListener('click', window.openCreateModal);
        if (btnClose) btnClose.addEventListener('click', hideModal);
        if (btnCancel) btnCancel.addEventListener('click', hideModal);

        // Filter search
        const searchInput = document.getElementById('search-room-type');
        const priceSelect = document.getElementById('filter-price');
        const rows = document.querySelectorAll('.room-type-row');
        const emptyState = document.getElementById('empty-state');

        function filterRows() {
            const query = (searchInput.value || '').toLowerCase().trim();
            const priceVal = priceSelect.value;
            let visibleCount = 0;

            rows.forEach(row => {
                const name = row.getAttribute('data-name') || '';
                const price = parseInt(row.getAttribute('data-price') || '0', 10);

                const matchesSearch = !query || name.includes(query);
                let matchesPrice = true;
                if (priceVal === 'under-3') matchesPrice = price < 3000000;
                else if (priceVal === '3-6') matchesPrice = price >= 3000000 && price <= 6000000;
                else if (priceVal === 'over-6') matchesPrice = price > 6000000;

                if (matchesSearch && matchesPrice) {
                    row.classList.remove('hidden');
                    visibleCount++;
                } else {
                    row.classList.add('hidden');
                }
            });

            if (visibleCount === 0) {
                emptyState.classList.remove('hidden');
                emptyState.classList.add('flex');
            } else {
                emptyState.classList.add('hidden');
                emptyState.classList.remove('flex');
            }
        }

        if (searchInput) searchInput.addEventListener('input', filterRows);
        if (priceSelect) priceSelect.addEventListener('change', filterRows);
    })();
</script>
@endpush
