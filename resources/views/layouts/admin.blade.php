<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title', 'Quản Trị Hệ Thống') - Aura Hotel &amp; Suites</title>
    <!-- Google Fonts & Material Symbols -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&amp;family=Space+Grotesk:wght@600&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "surface-tint": "#565e76",
                        "primary-container": "#131b30",
                        "on-primary": "#ffffff",
                        "on-background": "#0b1c30",
                        "secondary-container": "#ffd07e",
                        "on-surface": "#0b1c30",
                        "surface-container": "#e5eeff",
                        "surface-dim": "#cbdbf5",
                        "outline": "#76777d",
                        "surface": "#f8f9ff",
                        "surface-container-low": "#eff4ff",
                        "on-surface-variant": "#45464d",
                        "surface-container-highest": "#d3e4fe",
                        "primary-fixed": "#dae2ff",
                        "error": "#ba1a1a",
                        "secondary": "#7a580f",
                        "secondary-fixed": "#ffdea8",
                        "surface-container-lowest": "#ffffff",
                        "background": "#f8f9ff"
                    },
                    borderRadius: {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    spacing: {
                        "space-xs": "0.25rem",
                        "space-sm": "0.5rem",
                        "space-md": "1rem",
                        "space-lg": "1.5rem",
                        "space-xl": "2.5rem",
                        "gutter": "1.5rem",
                        "gutter-lg": "2rem"
                    },
                    fontFamily: {
                        "body-md": ["Plus Jakarta Sans"],
                        "headline-sm": ["Space Grotesk"],
                        "headline-md": ["Space Grotesk"],
                        "headline-lg": ["Space Grotesk"]
                    }
                }
            }
        };
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="bg-surface font-body-md text-on-surface antialiased min-h-screen">

<!-- ASIDE SIDEBAR -->
<aside class="fixed left-0 top-0 h-full w-72 bg-primary-container text-on-primary z-50 flex flex-col justify-between shadow-xl">
    <div class="flex flex-col">
        <!-- Logo -->
        <div class="h-20 px-space-lg flex items-center justify-between border-b border-white/10">
            <a class="flex items-center gap-space-sm" href="{{ route('admin.dashboard') }}">
                <div class="w-9 h-9 rounded-full bg-secondary flex items-center justify-center text-white font-bold font-serif text-lg">A</div>
                <span class="font-headline-sm uppercase tracking-wider text-on-primary font-bold text-lg">AURA ADMIN</span>
            </a>
        </div>

        <div class="px-space-lg py-3">
            <span class="text-[11px] uppercase tracking-wider text-primary-fixed/60 font-bold">Quản Trị Vận Hành</span>
        </div>

        <!-- Navigation Menu -->
        <nav class="px-space-md flex flex-col gap-1">
            <a class="flex items-center gap-space-sm px-space-md py-2.5 rounded-xl transition-all text-xs font-semibold {{ request()->routeIs('admin.dashboard') ? 'bg-white text-on-surface font-bold shadow-sm' : 'text-primary-fixed hover:bg-white/10 hover:text-white' }}" href="{{ route('admin.dashboard') }}">
                <span class="material-symbols-outlined text-[20px]">grid_view</span>
                <span>Bảng Tổng Quan</span>
            </a>

            <a class="flex items-center gap-space-sm px-space-md py-2.5 rounded-xl transition-all text-xs font-semibold {{ request()->routeIs('admin.tai-khoans.*') ? 'bg-white text-on-surface font-bold shadow-sm' : 'text-primary-fixed hover:bg-white/10 hover:text-white' }}" href="{{ route('admin.tai-khoans.index') }}">
                <span class="material-symbols-outlined text-[20px]">manage_accounts</span>
                <span>Quản Lý Tài Khoản</span>
            </a>

            @if(Auth::user()->vai_tro_id == 1)
            <a class="flex items-center gap-space-sm px-space-md py-2.5 rounded-xl transition-all text-xs font-semibold {{ request()->routeIs('admin.vai-tros.*') ? 'bg-white text-on-surface font-bold shadow-sm' : 'text-primary-fixed hover:bg-white/10 hover:text-white' }}" href="{{ route('admin.vai-tros.index') }}">
                <span class="material-symbols-outlined text-[20px]">verified_user</span>
                <span>Phân Quyền Vai Trò</span>
            </a>
            @endif

            <div class="my-2 border-t border-white/10"></div>
            <div class="px-space-md py-1">
                <span class="text-[10px] uppercase tracking-wider text-primary-fixed/50 font-bold">Nghiệp Vụ Khách Sạn</span>
            </div>

            <a class="flex items-center gap-space-sm px-space-md py-2.5 rounded-xl transition-all text-xs font-semibold {{ request()->routeIs('admin.phongs.*') ? 'bg-white text-on-surface font-bold shadow-sm' : 'text-primary-fixed hover:bg-white/10 hover:text-white' }}" href="{{ route('admin.phongs.index') }}">
                <span class="material-symbols-outlined text-[20px]">bed</span>
                <span>Quản Lý Phòng</span>
            </a>

            <a class="flex items-center gap-space-sm px-space-md py-2.5 rounded-xl transition-all text-xs font-semibold {{ request()->routeIs('admin.loai-phongs.*') ? 'bg-white text-on-surface font-bold shadow-sm' : 'text-primary-fixed hover:bg-white/10 hover:text-white' }}" href="{{ route('admin.loai-phongs.index') }}">
                <span class="material-symbols-outlined text-[20px]">category</span>
                <span>Quản Lý Loại Phòng</span>
            </a>

            <a class="flex items-center gap-space-sm px-space-md py-2.5 rounded-xl transition-all text-xs font-semibold text-primary-fixed/60 hover:bg-white/10 hover:text-white" href="#" title="Sẽ hoàn thiện ở Giai đoạn 4">
                <span class="material-symbols-outlined text-[20px]">event_available</span>
                <span>Quản Lý Đặt Phòng</span>
            </a>

            <a class="flex items-center gap-space-sm px-space-md py-2.5 rounded-xl transition-all text-xs font-semibold text-primary-fixed/60 hover:bg-white/10 hover:text-white" href="#" title="Sẽ hoàn thiện ở Giai đoạn 5">
                <span class="material-symbols-outlined text-[20px]">payments</span>
                <span>Giao Dịch &amp; SePay</span>
            </a>

            <a class="flex items-center gap-space-sm px-space-md py-2.5 rounded-xl transition-all text-xs font-semibold text-primary-fixed/60 hover:bg-white/10 hover:text-white" href="#" title="Sẽ hoàn thiện ở Giai đoạn 6">
                <span class="material-symbols-outlined text-[20px]">monitoring</span>
                <span>Báo Cáo Thống Kê</span>
            </a>
        </nav>
    </div>

    <!-- Client Link & Logout -->
    <div class="p-space-md bg-black/20 flex flex-col gap-2">
        <a class="flex items-center justify-between p-2.5 rounded-xl bg-white/10 text-white hover:bg-white/20 transition-all text-xs" href="{{ url('/') }}" target="_blank">
            <div class="flex items-center gap-space-sm">
                <span class="material-symbols-outlined text-[18px] text-secondary-fixed">open_in_new</span>
                <span>Xem Cổng Khách Hàng</span>
            </div>
        </a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center gap-2 p-2 rounded-xl bg-red-600/80 hover:bg-red-600 text-white transition-all text-xs font-semibold">
                <span class="material-symbols-outlined text-[18px]">logout</span>
                <span>Đăng Xuất</span>
            </button>
        </form>
    </div>
</aside>

<!-- MAIN CONTENT WRAPPER -->
<div class="pl-72">
    <!-- TOP HEADER -->
    <header class="fixed top-0 left-72 right-0 h-20 bg-surface/90 backdrop-blur-xl shadow-sm z-40 flex items-center justify-between px-gutter-lg border-b border-gray-200">
        <div class="flex items-center gap-space-md">
            <span class="material-symbols-outlined text-outline">meeting_room</span>
            <div class="flex items-center gap-space-xs text-xs text-on-surface-variant font-medium">
                <span>Aura Central Hub</span>
                <span class="text-outline">/</span>
                <span class="text-on-surface font-bold">@yield('page_title', 'Hệ Thống Quản Trị')</span>
            </div>
        </div>

        <div class="flex items-center gap-space-lg">
            <!-- User Info Dropdown -->
            <div class="flex items-center gap-space-sm">
                <div class="w-9 h-9 rounded-full bg-primary-container text-white flex items-center justify-center font-bold text-sm">
                    {{ strtoupper(substr(Auth::user()->ho_ten ?? 'A', 0, 1)) }}
                </div>
                <div class="flex flex-col text-left">
                    <span class="text-xs text-on-surface font-bold">{{ Auth::user()->ho_ten ?? 'User' }}</span>
                    <span class="text-[10px] text-secondary font-bold uppercase">{{ Auth::user()->vaiTro->ten_vai_tro ?? 'Thành viên' }}</span>
                </div>
            </div>
        </div>
    </header>

    <!-- PAGE CONTENT -->
    <main class="relative pt-20 bg-surface w-full px-gutter-lg py-gutter min-h-screen">
        
        <!-- Flash notifications -->
        @if(session('success'))
            <div class="mb-5 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-xs flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-emerald-600">check_circle</span>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-900">&times;</button>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-5 p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-xl text-xs shadow-sm">
                <div class="flex items-center gap-1.5 font-bold mb-1">
                    <span class="material-symbols-outlined text-rose-600">error</span>
                    <span>Vui lòng kiểm tra các thông tin sau:</span>
                </div>
                <ul class="list-disc list-inside ml-4 space-y-0.5">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
</div>

@stack('scripts')
</body>
</html>
