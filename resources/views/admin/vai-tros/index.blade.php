@extends('layouts.admin')

@section('title', 'Phân Quyền Vai Trò')
@section('page_title', 'Phân Quyền Vai Trò')

@section('content')
<div class="flex flex-col gap-space-lg">
    <!-- Action Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-white p-space-lg rounded-xl shadow-sm border border-gray-100">
        <div>
            <h1 class="font-headline-md text-xl font-bold text-on-surface">Danh Mục Vai Trò Hệ Thống</h1>
            <p class="text-xs text-on-surface-variant">Quy định quyền truy cập các tính năng quản lý khách sạn và hội viên</p>
        </div>

        <button type="button" onclick="document.getElementById('modal-create-vaitro').classList.remove('hidden')" class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl bg-primary-container text-white text-xs font-bold shadow-md hover:bg-black transition-all">
            <span class="material-symbols-outlined text-[18px]">add</span>
            <span>Thêm Vai Trò Mới</span>
        </button>
    </div>

    <!-- Table of Roles -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left text-xs">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100 text-gray-500 font-bold uppercase text-[10px]">
                    <th class="py-3 px-4">ID</th>
                    <th class="py-3 px-4">Tên Vai Trò</th>
                    <th class="py-3 px-4">Số Lượng Tài Khoản</th>
                    <th class="py-3 px-4">Ngày Tạo</th>
                    <th class="py-3 px-4 text-right">Thao Tác</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach($vaiTros as $vt)
                <tr class="hover:bg-gray-50/70 transition-colors">
                    <td class="py-3 px-4 font-bold text-gray-500">#{{ $vt->id }}</td>
                    <td class="py-3 px-4 font-bold text-gray-900">{{ $vt->ten_vai_tro }}</td>
                    <td class="py-3 px-4">
                        <span class="px-2.5 py-0.5 rounded-full bg-blue-50 text-blue-700 font-bold text-[11px]">
                            {{ $vt->tai_khoans_count ?? $vt->taiKhoans->count() }} thành viên
                        </span>
                    </td>
                    <td class="py-3 px-4 text-gray-500">{{ $vt->created_at->format('d/m/Y H:i') }}</td>
                    <td class="py-3 px-4 text-right">
                        <div class="flex items-center justify-end gap-1">
                            <button type="button" onclick="editRole({{ $vt->id }}, '{{ addslashes($vt->ten_vai_tro) }}')" class="p-1.5 rounded-lg text-gray-500 hover:text-blue-600 hover:bg-blue-50" title="Chỉnh sửa">
                                <span class="material-symbols-outlined text-[18px]">edit</span>
                            </button>
                            @if($vt->id > 3)
                            <form action="{{ route('admin.vai-tros.destroy', $vt->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa vai trò này?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 rounded-lg text-gray-500 hover:text-red-600 hover:bg-red-50" title="Xóa">
                                    <span class="material-symbols-outlined text-[18px]">delete</span>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Create Role -->
<div id="modal-create-vaitro" class="hidden fixed inset-0 z-50 bg-black/50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl">
        <h3 class="font-headline-sm text-lg font-bold text-gray-900 mb-1">Tạo Vai Trò Mới</h3>
        <p class="text-xs text-gray-500 mb-4">Nhập tên vai trò chức vụ trong hệ thống</p>
        <form action="{{ route('admin.vai-tros.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Tên Vai Trò</label>
                <input type="text" name="ten_vai_tro" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-xs focus:ring-2 focus:ring-primary-container focus:outline-none" placeholder="VD: Kế toán, Bảo vệ...">
            </div>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="document.getElementById('modal-create-vaitro').classList.add('hidden')" class="px-4 py-2 rounded-lg bg-gray-100 text-gray-700 text-xs font-semibold hover:bg-gray-200">Hủy</button>
                <button type="submit" class="px-4 py-2 rounded-lg bg-primary-container text-white text-xs font-bold hover:bg-black">Lưu Lại</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Role -->
<div id="modal-edit-vaitro" class="hidden fixed inset-0 z-50 bg-black/50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl">
        <h3 class="font-headline-sm text-lg font-bold text-gray-900 mb-1">Chỉnh Sửa Vai Trò</h3>
        <form id="form-edit-vaitro" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Tên Vai Trò</label>
                <input type="text" id="edit-ten-vai-tro" name="ten_vai_tro" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-xs focus:ring-2 focus:ring-primary-container focus:outline-none">
            </div>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="document.getElementById('modal-edit-vaitro').classList.add('hidden')" class="px-4 py-2 rounded-lg bg-gray-100 text-gray-700 text-xs font-semibold hover:bg-gray-200">Hủy</button>
                <button type="submit" class="px-4 py-2 rounded-lg bg-primary-container text-white text-xs font-bold hover:bg-black">Cập Nhật</button>
            </div>
        </form>
    </div>
</div>

<script>
    function editRole(id, name) {
        document.getElementById('form-edit-vaitro').action = '{{ url("admin/vai-tros") }}/' + id;
        document.getElementById('edit-ten-vai-tro').value = name;
        document.getElementById('modal-edit-vaitro').classList.remove('hidden');
    }
</script>
@endsection
