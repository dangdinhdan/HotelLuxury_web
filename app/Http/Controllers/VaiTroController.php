<?php

namespace App\Http\Controllers;

use App\Http\Requests\VaiTro\StoreVaiTroRequest;
use App\Http\Requests\VaiTro\UpdateVaiTroRequest;
use App\Services\VaiTroService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class VaiTroController extends Controller
{
    public function __construct(
        protected VaiTroService $vaiTroService
    ) {}

    public function index(): View
    {
        $vaiTros = $this->vaiTroService->getAll();
        return view('admin.vai-tros.index', compact('vaiTros'));
    }

    public function store(StoreVaiTroRequest $request): RedirectResponse
    {
        $this->vaiTroService->create($request->validated());

        return redirect()->route('admin.vai-tros.index')
            ->with('success', 'Thêm vai trò mới thành công!');
    }

    public function update(UpdateVaiTroRequest $request, int $id): RedirectResponse
    {
        $this->vaiTroService->update($id, $request->validated());

        return redirect()->route('admin.vai-tros.index')
            ->with('success', 'Cập nhật vai trò thành công!');
    }

    public function destroy(int $id): RedirectResponse
    {
        if ($id <= 3) {
            return redirect()->route('admin.vai-tros.index')
                ->withErrors(['error' => 'Không thể xóa các vai trò cốt lõi của hệ thống!']);
        }

        $this->vaiTroService->delete($id);

        return redirect()->route('admin.vai-tros.index')
            ->with('success', 'Đã xóa vai trò thành công!');
    }
}
