<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string[]  ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Chặn tài khoản bị khóa
        if ($user->trang_thai !== 'hoat_dong') {
            Auth::logout();
            return redirect()->route('login')
                ->withErrors(['email' => 'Tài khoản của bạn đã bị khóa hoặc tạm ngưng hoạt động.']);
        }

        // Nếu không yêu cầu vai trò cụ thể
        if (empty($roles)) {
            return $next($request);
        }

        // Kiểm tra vai trò theo ID hoặc Tên
        $roleId = (string) $user->vai_tro_id;
        $roleName = strtolower($user->vaiTro->ten_vai_tro ?? '');

        foreach ($roles as $role) {
            if ($roleId === (string) $role) {
                return $next($request);
            }
            if (str_contains($roleName, strtolower($role))) {
                return $next($request);
            }
        }

        // Không có quyền
        abort(403, 'Bạn không có quyền truy cập vào khu vực này.');
    }
}
