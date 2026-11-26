<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Hồ Sơ Cá Nhân - Aura Hotel &amp; Suites</title>
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans min-h-screen flex flex-col justify-between">
    <!-- Navbar -->
    <header class="bg-[#121a2f] text-white py-4 px-6 border-b border-[#d4af37]/30">
        <div class="max-w-5xl mx-auto flex items-center justify-between">
            <a href="{{ url('/') }}" class="font-serif font-bold tracking-wider text-lg text-white">
                AURA HOTEL &amp; SUITES
            </a>
            <div class="flex items-center gap-4 text-xs">
                @if(Auth::user()->vai_tro_id <= 2)
                    <a href="{{ route('admin.dashboard') }}" class="px-3 py-1.5 rounded-lg bg-[#d4af37] text-[#121a2f] font-bold">Vào Trang Quản Trị</a>
                @endif
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-3 py-1.5 rounded-lg bg-white/10 hover:bg-white/20 text-white font-medium">Đăng Xuất</button>
                </form>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto w-full p-6 flex-grow">
        @if(session('success'))
            <div class="mb-5 p-3.5 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-xs font-medium">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <div class="flex items-center gap-4 pb-6 border-b border-gray-100">
                <div class="w-16 h-16 rounded-full bg-[#121a2f] text-[#d4af37] text-2xl font-serif font-bold flex items-center justify-center">
                    {{ strtoupper(substr(Auth::user()->ho_ten, 0, 1)) }}
                </div>
                <div>
                    <h1 class="text-xl font-bold text-gray-900">{{ Auth::user()->ho_ten }}</h1>
                    <p class="text-xs text-gray-500 mt-0.5">Hội viên Aura Privilege Club • {{ Auth::user()->email }}</p>
                </div>
            </div>

            <!-- Profile Info Form -->
            <form action="{{ route('profile.update') }}" method="POST" class="mt-6 space-y-4">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Họ và Tên</label>
                        <input type="text" name="ho_ten" value="{{ old('ho_ten', Auth::user()->ho_ten) }}" required class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-xs">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Email</label>
                        <input type="email" value="{{ Auth::user()->email }}" disabled class="w-full px-3.5 py-2.5 bg-gray-100 border border-gray-200 rounded-lg text-xs text-gray-500 cursor-not-allowed">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Số Điện Thoại</label>
                        <input type="text" name="so_dien_thoai" value="{{ old('so_dien_thoai', Auth::user()->so_dien_thoai) }}" class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-xs">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Địa Chỉ</label>
                        <input type="text" name="dia_chi" value="{{ old('dia_chi', Auth::user()->dia_chi) }}" class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-xs">
                    </div>
                </div>
                <div class="flex justify-end pt-2">
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-[#121a2f] text-white text-xs font-bold hover:bg-black">
                        Lưu Thông Tin
                    </button>
                </div>
            </form>

            <!-- Change Password Form -->
            <div class="mt-8 pt-6 border-t border-gray-100">
                <h3 class="text-sm font-bold text-gray-900 mb-3">Đổi Mật Khẩu</h3>
                <form action="{{ route('change-password') }}" method="POST" class="space-y-3">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <div>
                            <label class="block text-xs text-gray-600 mb-1">Mật khẩu hiện tại</label>
                            <input type="password" name="old_password" required class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-xs">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-600 mb-1">Mật khẩu mới</label>
                            <input type="password" name="new_password" required class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-xs">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-600 mb-1">Xác nhận mật khẩu mới</label>
                            <input type="password" name="new_password_confirmation" required class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-xs">
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 rounded-lg bg-gray-800 text-white text-xs font-semibold hover:bg-black">
                            Cập Nhật Mật Khẩu
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <footer class="bg-[#121a2f] text-gray-400 py-4 text-center text-xs border-t border-[#d4af37]/20">
        © 2026 Aura Hotel &amp; Suites. All Rights Reserved.
    </footer>
</body>
</html>
