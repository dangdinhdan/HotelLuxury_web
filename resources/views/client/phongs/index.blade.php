<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aura Hotel & Suites - Khám Phá & Đặt Phòng Thượng Lưu</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary-container": "#131b30",
                        "secondary": "#7a580f",
                        "secondary-container": "#ffd07e",
                        "on-secondary-container": "#79570e",
                        "secondary-fixed": "#ffdea8",
                        "surface": "#f8f9ff",
                        "surface-container": "#e5eeff",
                        "surface-container-low": "#eff4ff",
                        "surface-container-lowest": "#ffffff",
                        "on-surface": "#0b1c30",
                        "on-surface-variant": "#45464d",
                        "outline": "#76777d",
                        "outline-variant": "#c6c6cd",
                        "tertiary-fixed": "#d2e4ff",
                        "on-tertiary-fixed": "#001c37",
                        "error-container": "#ffdad6",
                        "on-error-container": "#93000a"
                    },
                    fontFamily: {
                        headline: ["Space Grotesk", "sans-serif"],
                        body: ["Plus Jakarta Sans", "sans-serif"]
                    }
                }
            }
        };
    </script>
</head>
<body class="bg-surface font-body text-on-surface antialiased min-h-screen flex flex-col justify-between">
    <!-- Navbar Header -->
    <header class="fixed top-0 left-0 w-full z-50 bg-surface/90 backdrop-blur-xl shadow-sm">
        <div class="h-20 max-w-[1440px] mx-auto px-6 lg:px-12 flex items-center justify-between">
            <div class="flex items-center gap-8">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <img alt="Aura Hotel Logo" class="h-9 w-auto object-contain" src="https://lh3.googleusercontent.com/aida/ALJJyrCJWgf0QXh4MUgrOjwNny1AlbKakFYDlEl5KaqL4645hanVFjSjqcOcLHP7rEWvYggok5xCGnZfO4d3YFnJBXJYoO99AYOqxxSEormw8tEz77zO6qL-GUjGD3qZDIfkw5abrfJh_A-EcFVgtnXieBiD5Q7qb9rlgewX7oU86GvU0otVgCb6URPwewKFRU-1LaB-0b9mA2PmtVS1X8vI_IxC42SK6ehp5rLz-SudV-Y">
                    <span class="font-headline text-xl uppercase tracking-wider text-on-surface font-bold">AURA HOTEL</span>
                </a>
            </div>

            <nav class="hidden lg:flex items-center gap-6">
                <a href="{{ route('phongs.index') }}" class="font-semibold text-secondary transition-colors">Khám Phá & Đặt Phòng</a>
                <a href="{{ route('home') }}" class="text-on-surface-variant hover:text-on-surface transition-colors">Trang Chủ</a>
                @auth
                    @if(auth()->user()->vai_tro_id == 1 || auth()->user()->vai_tro_id == 2)
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-secondary-fixed text-on-secondary-container hover:bg-secondary hover:text-white transition-all text-xs font-bold uppercase tracking-wider">
                            <span class="material-symbols-outlined text-[16px]">shield_person</span>
                            <span>Bảng Quản Trị</span>
                        </a>
                    @endif
                @endauth
            </nav>

            <div class="flex items-center gap-4">
                @auth
                    <div class="flex items-center gap-3">
                        <a href="{{ route('client.profile') }}" class="flex items-center gap-2 hover:opacity-80 transition-opacity">
                            <div class="w-9 h-9 rounded-full bg-primary-container text-white flex items-center justify-center font-bold text-sm">
                                {{ strtoupper(substr(auth()->user()->ho_ten, 0, 1)) }}
                            </div>
                            <span class="hidden sm:inline font-semibold text-sm">{{ auth()->user()->ho_ten }}</span>
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="p-2 rounded-xl text-outline hover:text-error hover:bg-error-container/20 transition-all" title="Đăng xuất">
                                <span class="material-symbols-outlined text-[20px]">logout</span>
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="px-5 py-2.5 rounded-xl bg-primary-container text-white font-semibold text-sm hover:bg-surface-tint transition-all shadow-sm">
                        Đăng Nhập / Đăng Ký
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="w-full pt-20 flex-grow">
        <!-- Hero Search Section -->
        <section class="relative w-full overflow-hidden bg-primary-container text-white">
            <div class="absolute inset-0 z-0">
                <div class="w-full h-full bg-cover bg-center opacity-30" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBpqN5lFnf6jhJzXtzQVHoz6EhwwKYmdolI8Io3qlRnq1E6zJDztriDdko1TzvKZqAkD2bnfaxu50XJ0fa_JtC_FZf3vXRWkBKBPOggHO9tnQBkjeDNbsoFujdoFd4eWA8t57OhWDs-gLgXvyl964Z8ZxY-IY4DK-rcfH0nL9RO8u1o0KByeyr2h23Ypb2MHriiFWryrwLtJQTaPE9vmSUdzH0yYvKxaEXG9sKsHA')"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-primary-container via-primary-container/80 to-transparent"></div>
            </div>

            <div class="relative z-10 max-w-[1440px] mx-auto px-6 lg:px-12 pt-16 pb-24">
                <div class="max-w-3xl flex flex-col gap-3 mb-12">
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md text-secondary-container text-xs font-bold uppercase tracking-widest self-start">
                        <span class="material-symbols-outlined text-[14px]">stars</span>
                        <span>Khách Sạn 5 Sao Haute Hospitality</span>
                    </div>
                    <h1 class="font-headline text-3xl sm:text-5xl text-white tracking-tight font-bold">
                        Trải Nghiệm Nghỉ Dưỡng Thượng Lưu Tại <span class="text-secondary-container">Aura Hotel</span>
                    </h1>
                    <p class="text-white/80 text-base sm:text-lg">
                        Không gian sống độc bản, ban công ngắm nhìn đại dương vô tận cùng dịch vụ quản gia đặc quyền chuẩn quốc tế.
                    </p>
                </div>

                <!-- Search Cockpit Bar -->
                <div class="w-full bg-surface-container-lowest/95 backdrop-blur-xl p-4 sm:p-6 rounded-2xl shadow-2xl text-on-surface">
                    <form action="{{ route('phongs.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-3 items-center">
                        <div class="md:col-span-4 flex flex-col p-3 rounded-xl bg-surface-container-low">
                            <span class="text-xs font-bold uppercase text-outline flex items-center gap-1">
                                <span class="material-symbols-outlined text-[16px] text-secondary">hotel</span> Điểm Đến
                            </span>
                            <div class="mt-1">
                                <span class="font-headline font-semibold text-on-surface">Aura Central Grand Resort & Suites</span>
                                <span class="block text-xs text-outline">01 Đại Lộ Hoàng Gia, Bến Nghé, TP.HCM</span>
                            </div>
                        </div>

                        <div class="md:col-span-3 grid grid-cols-2 gap-2 p-3 rounded-xl bg-surface-container-low">
                            <div class="flex flex-col">
                                <span class="text-xs font-bold uppercase text-outline flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px] text-secondary">calendar_today</span> Check-in
                                </span>
                                <input name="check_in" value="{{ $checkIn ?? date('Y-m-d') }}" type="date" class="mt-1 bg-transparent font-semibold text-sm text-on-surface focus:outline-none cursor-pointer">
                            </div>
                            <div class="flex flex-col border-l border-outline-variant/30 pl-2">
                                <span class="text-xs font-bold uppercase text-outline flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px] text-secondary">event_repeat</span> Check-out
                                </span>
                                <input name="check_out" value="{{ $checkOut ?? date('Y-m-d', strtotime('+2 days')) }}" type="date" class="mt-1 bg-transparent font-semibold text-sm text-on-surface focus:outline-none cursor-pointer">
                            </div>
                        </div>

                        <div class="md:col-span-3 flex flex-col p-3 rounded-xl bg-surface-container-low">
                            <span class="text-xs font-bold uppercase text-outline flex items-center gap-1">
                                <span class="material-symbols-outlined text-[16px] text-secondary">group</span> Số Khách Lưu Trú
                            </span>
                            <select name="suc_chua" class="mt-1 bg-transparent font-semibold text-sm text-on-surface focus:outline-none cursor-pointer">
                                <option value="">Tất cả sức chứa</option>
                                <option value="2" {{ request('suc_chua') == '2' ? 'selected' : '' }}>2 Khách (Cặp đôi / Bạn bè)</option>
                                <option value="4" {{ request('suc_chua') == '4' ? 'selected' : '' }}>4 Khách (Gia đình / Nhóm)</option>
                                <option value="6" {{ request('suc_chua') == '6' ? 'selected' : '' }}>6+ Khách (Suite / Penthouse)</option>
                            </select>
                        </div>

                        <div class="md:col-span-2 h-full flex">
                            <button type="submit" class="w-full h-full min-h-[52px] rounded-xl bg-secondary hover:bg-on-secondary-container text-white font-bold text-sm uppercase tracking-wider flex items-center justify-center gap-2 transition-all shadow-md active:scale-95 cursor-pointer">
                                <span class="material-symbols-outlined text-[20px]">search</span>
                                <span>Tìm Phòng</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- Room Results Workspace -->
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12 py-12">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
                <div>
                    <span class="text-xs uppercase tracking-wider text-secondary font-bold">Danh Mục Nghỉ Dưỡng</span>
                    <h2 class="font-headline text-2xl sm:text-3xl font-bold text-on-surface">Danh Sách Buồng Phòng Sẵn Sàng</h2>
                    <p class="text-sm text-on-surface-variant">
                        Đang hiển thị <span class="font-bold text-on-surface">{{ $phongs->count() }} phòng trống</span> đáp ứng tiêu chuẩn thượng lưu
                    </p>
                </div>

                <!-- Filter indicator -->
                <div class="flex items-center gap-2">
                    <span class="text-sm text-on-surface-variant">Hạng phòng:</span>
                    <form method="GET" action="{{ route('phongs.index') }}" class="inline">
                        <select name="loai_phong_id" onchange="this.form.submit()" class="px-3 py-1.5 rounded-xl bg-surface-container font-semibold text-sm text-on-surface focus:outline-none cursor-pointer">
                            <option value="all">Tất cả hạng phòng ({{ $loaiPhongs->count() }})</option>
                            @foreach($loaiPhongs as $lp)
                            <option value="{{ $lp->id }}" {{ request('loai_phong_id') == $lp->id ? 'selected' : '' }}>{{ $lp->ten_loai_phong }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>

            <!-- Room Grid Matrix -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($phongs as $p)
                @php
                    $primaryImg = $p->hinhAnhs->where('is_primary', true)->first()?->url 
                                ?? $p->hinhAnhs->first()?->url 
                                ?? 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=600';
                @endphp
                <article class="flex flex-col bg-surface-container-lowest rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group border border-surface-container-low hover:border-secondary/40">
                    <div class="relative w-full h-60 overflow-hidden">
                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" 
                             src="{{ $primaryImg }}" 
                             alt="{{ $p->so_phong }}">
                        
                        <!-- Badges -->
                        <div class="absolute top-3 left-3 flex flex-col gap-1 items-start">
                            <span class="px-3 py-1 rounded-full bg-secondary-container text-on-secondary-container text-xs font-bold uppercase tracking-wider shadow-sm">
                                Phòng {{ $p->so_phong }} • Tầng {{ $p->tang }}
                            </span>
                            <span class="px-2.5 py-0.5 rounded-full bg-tertiary-fixed text-on-tertiary-fixed text-[11px] font-bold uppercase shadow-sm">
                                Sẵn sàng đón
                            </span>
                        </div>

                        <div class="absolute bottom-3 right-3 px-3 py-1 rounded-full bg-primary-container/80 backdrop-blur-sm text-white text-xs font-semibold flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px] text-secondary-container">star</span> 5.0 Chuẩn Luxury
                        </div>
                    </div>

                    <div class="p-5 flex flex-col flex-grow justify-between gap-4">
                        <div class="flex flex-col gap-1.5">
                            <div class="text-xs uppercase tracking-wider text-outline font-semibold">
                                {{ $p->loaiPhong ? $p->loaiPhong->ten_loai_phong : 'Hạng phòng Aura' }}
                            </div>
                            <h3 class="font-headline text-xl font-bold text-on-surface group-hover:text-secondary transition-colors">
                                Buồng Phòng {{ $p->so_phong }} - Tầng {{ $p->tang }}
                            </h3>
                            <p class="text-sm text-on-surface-variant line-clamp-2">
                                {{ $p->mo_ta ?: ($p->loaiPhong ? $p->loaiPhong->mo_ta : 'Trải nghiệm không gian nghỉ ngơi tráng lệ với đầy đủ tiện ích hoàng gia.') }}
                            </p>

                            <!-- Specs -->
                            <div class="grid grid-cols-2 gap-2 pt-2 text-xs text-on-surface-variant font-medium">
                                <div class="flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-[16px] text-outline">square_foot</span>
                                    <span>Diện tích: {{ $p->dien_tich ?? 45 }}m²</span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-[16px] text-outline">group</span>
                                    <span>Sức chứa: {{ $p->suc_chua_toi_da }} khách</span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-[16px] text-outline">layers</span>
                                    <span>Vị trí: Tầng {{ $p->tang }}</span>
                                </div>
                                <div class="flex items-center gap-1.5 text-secondary font-semibold">
                                    <span class="material-symbols-outlined text-[16px]">verified</span>
                                    <span>Dịch vụ quản gia</span>
                                </div>
                            </div>
                        </div>

                        <!-- Price & CTA -->
                        <div class="pt-3 border-t border-surface-container-low flex items-baseline justify-between">
                            <div class="flex flex-col">
                                <span class="text-xs text-outline uppercase font-semibold">Giá niêm yết</span>
                                <div class="flex items-baseline gap-1">
                                    <span class="font-headline text-2xl font-bold text-on-surface">{{ number_format($p->gia_moi_dem, 0, ',', '.') }}đ</span>
                                    <span class="text-xs text-outline">/đêm</span>
                                </div>
                            </div>
                            <a href="{{ route('phongs.show', $p->id) }}" class="px-4 py-2.5 rounded-xl bg-primary-container text-white font-semibold text-xs uppercase tracking-wider hover:bg-surface-tint transition-all shadow-sm">
                                Chi Tiết & Đặt
                            </a>
                        </div>
                    </div>
                </article>
                @empty
                <div class="col-span-full py-16 text-center flex flex-col items-center justify-center bg-surface-container-lowest rounded-2xl p-8 border border-dashed border-outline-variant">
                    <span class="material-symbols-outlined text-5xl text-outline mb-2">hotel_class</span>
                    <h3 class="font-headline text-xl font-bold text-on-surface">Hiện chưa có phòng phù hợp</h3>
                    <p class="text-sm text-on-surface-variant mt-1">Vui lòng chọn khoảng thời gian khác hoặc đặt lại bộ lọc.</p>
                    <a href="{{ route('phongs.index') }}" class="mt-4 px-5 py-2 rounded-xl bg-secondary text-white font-semibold text-sm">
                        Xem Tất Cả Phòng
                    </a>
                </div>
                @endforelse
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-primary-container text-white py-12 border-t border-white/10">
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-3">
                <img alt="Aura Logo" class="h-8 w-auto brightness-200" src="https://lh3.googleusercontent.com/aida/ALJJyrCJWgf0QXh4MUgrOjwNny1AlbKakFYDlEl5KaqL4645hanVFjSjqcOcLHP7rEWvYggok5xCGnZfO4d3YFnJBXJYoO99AYOqxxSEormw8tEz77zO6qL-GUjGD3qZDIfkw5abrfJh_A-EcFVgtnXieBiD5Q7qb9rlgewX7oU86GvU0otVgCb6URPwewKFRU-1LaB-0b9mA2PmtVS1X8vI_IxC42SK6ehp5rLz-SudV-Y">
                <span class="font-headline font-bold uppercase tracking-wider text-sm">Aura Hotel & Suites Vietnam</span>
            </div>
            <p class="text-xs text-white/60">
                © {{ date('Y') }} Aura Luxury Hotel Group. Bản quyền thuộc về hệ thống quản lý khách sạn cao cấp.
            </p>
        </div>
    </footer>
</body>
</html>
