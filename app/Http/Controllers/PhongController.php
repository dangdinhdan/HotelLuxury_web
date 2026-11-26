<?php

namespace App\Http\Controllers;

use App\Http\Requests\Phong\StorePhongRequest;
use App\Http\Requests\Phong\UpdatePhongRequest;
use App\Http\Requests\Phong\UpdateStatusPhongRequest;
use App\Services\LoaiPhongService;
use App\Services\PhongService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PhongController extends Controller
{
    public function __construct(
        protected PhongService $phongService,
        protected LoaiPhongService $loaiPhongService
    ) {}

    /**
     * Danh sách buồng phòng trong Admin.
     */
    public function index(Request $request): View
    {
        $filters = [
            'search' => $request->input('search'),
            'tang' => $request->input('tang', 'all'),
            'loai_phong_id' => $request->input('loai_phong_id', 'all'),
            'trang_thai' => $request->input('trang_thai', 'all'),
        ];

        $phongs = $this->phongService->getAll($filters);
        $metrics = $this->phongService->getMetrics();
        $loaiPhongs = $this->loaiPhongService->getAll();

        // Nhóm theo tầng để hiển thị sơ đồ buồng phòng
        $phongsByFloor = $phongs->groupBy('tang')->sortKeys();

        return view('admin.phongs.index', compact('phongs', 'phongsByFloor', 'metrics', 'loaiPhongs', 'filters'));
    }

    /**
     * Thêm phòng mới.
     */
    public function store(StorePhongRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $imageFiles = $request->file('hinh_anh_files') ?? [];
        $onlineUrl = $validated['hinh_anh_url'] ?? null;

        $this->phongService->create($validated, $imageFiles, $onlineUrl);

        return redirect()->route('admin.phongs.index')->with('success', 'Đã thêm buồng phòng ' . $validated['so_phong'] . ' thành công!');
    }

    /**
     * Cập nhật thông tin phòng.
     */
    public function update(UpdatePhongRequest $request, int $id): RedirectResponse
    {
        $validated = $request->validated();
        $imageFiles = $request->file('hinh_anh_files') ?? [];
        $onlineUrl = $validated['hinh_anh_url'] ?? null;

        $this->phongService->update($id, $validated, $imageFiles, $onlineUrl);

        return redirect()->route('admin.phongs.index')->with('success', 'Đã cập nhật phòng ' . $validated['so_phong'] . ' thành công!');
    }

    /**
     * Cập nhật nhanh trạng thái buồng phòng.
     */
    public function updateStatus(UpdateStatusPhongRequest $request, int $id): JsonResponse|RedirectResponse
    {
        $this->phongService->updateStatus($id, $request->validated()['trang_thai']);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Cập nhật trạng thái buồng phòng thành công!']);
        }

        return redirect()->back()->with('success', 'Cập nhật trạng thái phòng thành công!');
    }

    /**
     * Xóa phòng.
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->phongService->delete($id);
        return redirect()->route('admin.phongs.index')->with('success', 'Đã chuyển phòng vào thùng rác!');
    }

    /**
     * Cổng khách hàng: Khám phá danh sách phòng nghỉ.
     */
    public function clientIndex(Request $request): View
    {
        $filters = [
            'loai_phong_id' => $request->input('loai_phong_id', 'all'),
            'max_price' => $request->input('max_price'),
            'suc_chua' => $request->input('suc_chua'),
        ];

        $checkIn = $request->input('check_in');
        $checkOut = $request->input('check_out');

        $phongs = $this->phongService->findAvailableRooms($checkIn, $checkOut, $filters);
        $loaiPhongs = $this->loaiPhongService->getAll();

        return view('client.phongs.index', compact('phongs', 'loaiPhongs', 'filters', 'checkIn', 'checkOut'));
    }

    /**
     * Cổng khách hàng: Xem chi tiết phòng nghỉ.
     */
    public function clientShow(int $id): View
    {
        $phong = $this->phongService->findById($id);

        if (!$phong) {
            abort(404, 'Không tìm thấy phòng nghỉ yêu cầu.');
        }

        // Lấy các phòng liên quan cùng hạng
        $relatedPhongs = $this->phongService->getAll([
            'loai_phong_id' => $phong->loai_phong_id,
            'trang_thai' => 'trong',
        ])->where('id', '!=', $phong->id)->take(3);

        return view('client.phongs.show', compact('phong', 'relatedPhongs'));
    }
}
