<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoaiPhong\StoreLoaiPhongRequest;
use App\Http\Requests\LoaiPhong\UpdateLoaiPhongRequest;
use App\Services\LoaiPhongService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoaiPhongController extends Controller
{
    public function __construct(
        protected LoaiPhongService $loaiPhongService
    ) {}

    /**
     * Danh sách loại phòng trong Admin.
     */
    public function index(Request $request): View
    {
        $filters = [
            'search' => $request->input('search'),
            'price_range' => $request->input('price_range', 'all'),
        ];

        $loaiPhongs = $this->loaiPhongService->getAll($filters);

        return view('admin.loai-phongs.index', compact('loaiPhongs', 'filters'));
    }

    /**
     * Thêm mới loại phòng.
     */
    public function store(StoreLoaiPhongRequest $request): RedirectResponse
    {
        $this->loaiPhongService->create($request->validated());

        return redirect()->route('admin.loai-phongs.index')->with('success', 'Đã thêm hạng phòng mới thành công!');
    }

    /**
     * Cập nhật thông tin loại phòng.
     */
    public function update(UpdateLoaiPhongRequest $request, int $id): RedirectResponse
    {
        $this->loaiPhongService->update($id, $request->validated());

        return redirect()->route('admin.loai-phongs.index')->with('success', 'Đã cập nhật hạng phòng thành công!');
    }

    /**
     * Xóa loại phòng.
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->loaiPhongService->delete($id);
        return redirect()->route('admin.loai-phongs.index')->with('success', 'Đã xóa loại phòng vào thùng rác!');
    }
}
