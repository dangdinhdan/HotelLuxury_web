<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaiKhoan\ChangePasswordRequest;
use App\Http\Requests\TaiKhoan\ForgotPasswordRequest;
use App\Http\Requests\TaiKhoan\LoginRequest;
use App\Http\Requests\TaiKhoan\RegisterRequest;
use App\Http\Requests\TaiKhoan\ResetPasswordRequest;
use App\Http\Requests\TaiKhoan\UpdateTaiKhoanRequest;
use App\Services\TaiKhoanService;
use App\Services\VaiTroService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TaiKhoanController extends Controller
{
    public function __construct(
        protected TaiKhoanService $taiKhoanService,
        protected VaiTroService $vaiTroService
    ) {}

    /**
     * Hiển thị Form Đăng nhập (GET) hoặc xử lý Đăng nhập (POST)
     */
    public function login(Request $request)
    {
        if ($request->isMethod('get')) {
            if (Auth::check()) {
                return Auth::user()->vai_tro_id <= 2
                    ? redirect()->route('admin.dashboard')
                    : redirect()->route('profile');
            }
            return view('auth.login');
        }

        // Validate qua Form Request
        $loginRequest = app(LoginRequest::class);
        $credentials = $loginRequest->validated();

        $user = $this->taiKhoanService->attemptLogin($credentials['email'], $credentials['mat_khau']);

        if (!$user) {
            return back()->withInput()->withErrors([
                'email' => 'Thông tin đăng nhập không chính xác hoặc tài khoản đã bị khóa.',
            ]);
        }

        Auth::login($user, $loginRequest->boolean('remember'));
        $request->session()->regenerate();

        if ($user->vai_tro_id <= 2) {
            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Đăng nhập trang quản trị thành công!');
        }

        return redirect()->intended(route('profile'))
            ->with('success', 'Chào mừng bạn trở lại với Aura Hotel!');
    }

    /**
     * Xử lý Đăng ký tài khoản hội viên
     */
    public function register(RegisterRequest $request): RedirectResponse
    {
        $user = $this->taiKhoanService->register($request->validated());

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('profile')
            ->with('success', 'Chúc mừng bạn đã gia nhập Aura Privilege Club thành công!');
    }

    /**
     * Xử lý Đăng xuất
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Bạn đã đăng xuất an toàn.');
    }

    /**
     * Danh sách tài khoản trong trang Quản trị
     */
    public function index(Request $request): View
    {
        $keyword = $request->input('keyword');
        $vaiTroId = $request->input('vai_tro_id');

        if (!empty($keyword)) {
            $taiKhoans = $this->taiKhoanService->search($keyword);
        } else {
            $taiKhoans = $this->taiKhoanService->getAll();
        }

        if (!empty($vaiTroId)) {
            $taiKhoans = $taiKhoans->where('vai_tro_id', $vaiTroId);
        }

        $vaiTros = $this->vaiTroService->getAll();

        return view('admin.tai-khoans.index', compact('taiKhoans', 'vaiTros'));
    }

    /**
     * Xem chi tiết tài khoản
     */
    public function show(int $id): View
    {
        $taiKhoan = $this->taiKhoanService->findById($id);

        if (!$taiKhoan) {
            abort(404, 'Tài khoản không tồn tại.');
        }

        $vaiTros = $this->vaiTroService->getAll();

        return view('admin.tai-khoans.show', compact('taiKhoan', 'vaiTros'));
    }

    /**
     * Cập nhật thông tin tài khoản (Admin hoặc Khách hàng tự đổi thông tin)
     */
    public function update(UpdateTaiKhoanRequest $request, ?int $id = null): RedirectResponse
    {
        $targetId = $id ?? Auth::id();
        $data = $request->validated();

        // Khách hàng thông thường không được tự phân quyền hoặc đổi trạng thái
        if (Auth::user()->vai_tro_id > 2) {
            unset($data['vai_tro_id'], $data['trang_thai']);
        }

        $this->taiKhoanService->update($targetId, $data);

        return back()->with('success', 'Cập nhật thông tin tài khoản thành công!');
    }

    /**
     * Đổi mật khẩu
     */
    public function changePassword(ChangePasswordRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $userId = Auth::id();
        $result = $this->taiKhoanService->changePassword($userId, $validated['old_password'], $validated['new_password']);

        if (!$result) {
            return back()->withErrors(['old_password' => 'Mật khẩu hiện tại không chính xác.']);
        }

        return back()->with('success', 'Đổi mật khẩu thành công!');
    }

    /**
     * Xóa mềm tài khoản
     */
    public function destroy(int $id): RedirectResponse
    {
        if (Auth::id() === $id || $id === 1) {
            return back()->withErrors(['error' => 'Không thể xóa tài khoản quản trị tối cao hoặc chính bạn!']);
        }

        $this->taiKhoanService->softDelete($id);

        return redirect()->route('admin.tai-khoans.index')
            ->with('success', 'Tài khoản đã được chuyển vào danh sách lưu trữ (Xóa mềm)!');
    }

    /**
     * Quên mật khẩu
     */
    public function forgotPassword(ForgotPasswordRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $token = $this->taiKhoanService->createResetToken($validated['email']);

        return back()->with('success', 'Yêu cầu khôi phục mật khẩu đã được tiếp nhận. Token xác thực: ' . substr($token, 0, 8) . '...');
    }

    /**
     * Đặt lại mật khẩu
     */
    public function resetPassword(ResetPasswordRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $success = $this->taiKhoanService->resetPassword($validated['email'], $validated['token'], $validated['new_password']);

        if (!$success) {
            return back()->withErrors(['token' => 'Mã token không hợp lệ hoặc đã hết hạn.']);
        }

        return redirect()->route('login')->with('success', 'Đặt lại mật khẩu thành công! Vui lòng đăng nhập.');
    }
}
