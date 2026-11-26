<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phòng {{ $phong->so_phong }} - {{ $phong->loaiPhong?->ten_loai_phong }} | Aura Hotel</title>
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
                        "surface": "#f8f9ff",
                        "surface-container": "#e5eeff",
                        "surface-container-low": "#eff4ff",
                        "surface-container-lowest": "#ffffff",
                        "on-surface": "#0b1c30",
                        "on-surface-variant": "#45464d",
                        "outline": "#76777d",
                        "tertiary-fixed": "#d2e4ff",
                        "on-tertiary-fixed": "#001c37",
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
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <img alt="Aura Hotel Logo" class="h-9 w-auto object-contain" src="https://lh3.googleusercontent.com/aida/ALJJyrCJWgf0QXh4MUgrOjwNny1AlbKakFYDlEl5KaqL4645hanVFjSjqcOcLHP7rEWvYggok5xCGnZfO4d3YFnJBXJYoO99AYOqxxSEormw8tEz77zO6qL-GUjGD3qZDIfkw5abrfJh_A-EcFVgtnXieBiD5Q7qb9rlgewX7oU86GvU0otVgCb6URPwewKFRU-1LaB-0b9mA2PmtVS1X8vI_IxC42SK6ehp5rLz-SudV-Y">
                <span class="font-headline text-xl uppercase tracking-wider text-on-surface font-bold">AURA HOTEL</span>
            </a>

            <nav class="hidden lg:flex items-center gap-6">
                <a href="{{ route('phongs.index') }}" class="font-semibold text-secondary transition-colors">← Trở Về Danh Sách Buồng Phòng</a>
                <a href="{{ route('home') }}" class="text-on-surface-variant hover:text-on-surface transition-colors">Trang Chủ</a>
            </nav>

            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ route('client.profile') }}" class="flex items-center gap-2">
                        <div class="w-9 h-9 rounded-full bg-primary-container text-white flex items-center justify-center font-bold text-sm">
                            {{ strtoupper(substr(auth()->user()->ho_ten, 0, 1)) }}
                        </div>
                        <span class="hidden sm:inline font-semibold text-sm">{{ auth()->user()->ho_ten }}</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-5 py-2.5 rounded-xl bg-primary-container text-white font-semibold text-sm">
                        Đăng Nhập
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <main class="w-full pt-28 pb-16 max-w-[1440px] mx-auto px-6 lg:px-12 flex-grow">
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-xs uppercase tracking-wider text-outline mb-6">
            <a href="{{ route('home') }}" class="hover:text-on-surface">Trang Chủ</a>
            <span>/</span>
            <a href="{{ route('phongs.index') }}" class="hover:text-on-surface">Danh Mục Phòng</a>
            <span>/</span>
            <span class="text-secondary font-bold">Buồng Phòng {{ $phong->so_phong }}</span>
        </div>

        @php
            $mainImg = $phong->hinhAnhs->where('is_primary', true)->first()?->url 
                     ?? $phong->hinhAnhs->first()?->url 
                     ?? 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=1200';
        @endphp

        <!-- Image Gallery Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 mb-10">
            <div class="lg:col-span-8 rounded-2xl overflow-hidden h-[380px] sm:h-[480px] shadow-sm">
                <img id="main-gallery-img" src="{{ $mainImg }}" alt="Phòng {{ $phong->so_phong }}" class="w-full h-full object-cover transition-all duration-300">
            </div>
            <div class="lg:col-span-4 flex flex-row lg:flex-col gap-4 overflow-x-auto lg:overflow-y-auto max-h-[480px]">
                <div onclick="document.getElementById('main-gallery-img').src='{{ $mainImg }}'" class="rounded-xl overflow-hidden h-28 lg:h-36 w-40 lg:w-full shrink-0 cursor-pointer ring-2 ring-secondary">
                    <img src="{{ $mainImg }}" class="w-full h-full object-cover">
                </div>
                @foreach($phong->hinhAnhs->where('url', '!=', $mainImg) as $img)
                <div onclick="document.getElementById('main-gallery-img').src='{{ $img->url }}'" class="rounded-xl overflow-hidden h-28 lg:h-36 w-40 lg:w-full shrink-0 cursor-pointer hover:opacity-80 transition-opacity">
                    <img src="{{ $img->url }}" class="w-full h-full object-cover">
                </div>
                @endforeach
            </div>
        </div>

        <!-- Room Detail & Booking Bar Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
            <!-- Left Info Content -->
            <div class="lg:col-span-8 flex flex-col gap-8">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <span class="px-3 py-1 rounded-full bg-secondary-container text-on-secondary-container text-xs font-bold uppercase tracking-wider">
                            {{ $phong->loaiPhong?->ten_loai_phong ?? 'Hạng Thượng Lưu' }}
                        </span>
                        <span class="px-3 py-1 rounded-full bg-tertiary-fixed text-on-tertiary-fixed text-xs font-bold uppercase tracking-wider">
                            Tầng {{ $phong->tang }}
                        </span>
                    </div>
                    <h1 class="font-headline text-3xl sm:text-4xl font-bold text-on-surface">
                        Phòng Nghỉ Hoàng Gia {{ $phong->so_phong }}
                    </h1>
                    <p class="text-sm text-outline mt-1">Định danh buồng phòng tiêu chuẩn: AURA-P{{ $phong->so_phong }}</p>
                </div>

                <!-- Specs Chips -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 p-5 rounded-2xl bg-surface-container-lowest shadow-sm">
                    <div class="flex flex-col">
                        <span class="text-xs text-outline font-semibold uppercase">Diện tích</span>
                        <span class="font-headline text-lg font-bold text-on-surface flex items-center gap-1 mt-1">
                            <span class="material-symbols-outlined text-[18px] text-secondary">square_foot</span>
                            {{ $phong->dien_tich ?? 45 }} m²
                        </span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xs text-outline font-semibold uppercase">Sức chứa tối đa</span>
                        <span class="font-headline text-lg font-bold text-on-surface flex items-center gap-1 mt-1">
                            <span class="material-symbols-outlined text-[18px] text-secondary">group</span>
                            {{ $phong->suc_chua_toi_da }} khách
                        </span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xs text-outline font-semibold uppercase">Vị trí buồng</span>
                        <span class="font-headline text-lg font-bold text-on-surface flex items-center gap-1 mt-1">
                            <span class="material-symbols-outlined text-[18px] text-secondary">layers</span>
                            Tầng {{ $phong->tang }}
                        </span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xs text-outline font-semibold uppercase">Trạng thái</span>
                        <span class="font-headline text-base font-bold text-on-tertiary-fixed flex items-center gap-1 mt-1">
                            <span class="w-2 h-2 rounded-full bg-green-500"></span>
                            Sẵn sàng đón
                        </span>
                    </div>
                </div>

                <!-- Description -->
                <div class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm flex flex-col gap-4">
                    <h3 class="font-headline text-xl font-bold text-on-surface flex items-center gap-2">
                        <span class="material-symbols-outlined text-secondary text-[22px]">auto_awesome</span>
                        Mô Tả & Trải Nghiệm Không Gian
                    </h3>
                    <p class="text-on-surface-variant leading-relaxed">
                        {{ $phong->mo_ta ?: ($phong->loaiPhong?->mo_ta ?: 'Buồng phòng được bài trí theo phong cách kiến trúc Art Deco đương đại, kết hợp hài hòa giữa chất liệu gỗ tự nhiên và đá cẩm thạch sang trọng. Tầm nhìn thoáng đãng đón trọn sinh khí và cảnh quan tươi đẹp.') }}
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-3 border-t border-surface-container-low text-sm text-on-surface">
                        <div class="flex items-center gap-2"><span class="material-symbols-outlined text-[18px] text-secondary">wifi</span> Wi-Fi tốc độ cao độc lập</div>
                        <div class="flex items-center gap-2"><span class="material-symbols-outlined text-[18px] text-secondary">ac_unit</span> Điều hòa không khí trung tâm thông minh</div>
                        <div class="flex items-center gap-2"><span class="material-symbols-outlined text-[18px] text-secondary">tv</span> Smart TV màn hình phẳng siêu nét</div>
                        <div class="flex items-center gap-2"><span class="material-symbols-outlined text-[18px] text-secondary">room_service</span> Dịch vụ phục vụ tận phòng 24/7</div>
                    </div>
                </div>

                <!-- Policies -->
                <div class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm flex flex-col gap-3">
                    <h3 class="font-headline text-xl font-bold text-on-surface flex items-center gap-2">
                        <span class="material-symbols-outlined text-secondary text-[22px]">policy</span>
                        Quy Định Lưu Trú & Nhận Phòng
                    </h3>
                    <ul class="text-sm text-on-surface-variant flex flex-col gap-2 list-disc list-inside">
                        <li><strong>Giờ nhận phòng (Check-in):</strong> từ 14:00 chiều.</li>
                        <li><strong>Giờ trả phòng (Check-out):</strong> trước 12:00 trưa hôm sau.</li>
                        <li><strong>Chính sách hủy:</strong> Miễn phí hủy đặt phòng trước 48 giờ so với giờ nhận phòng tiêu chuẩn.</li>
                    </ul>
                </div>
            </div>

            <!-- Right Sticky Booking Card -->
            <div class="lg:col-span-4 sticky top-28">
                <div class="bg-surface-container-lowest p-6 rounded-2xl shadow-xl border border-secondary/20 flex flex-col gap-5">
                    <div>
                        <span class="text-xs text-outline uppercase font-semibold">Đơn giá niêm yết</span>
                        <div class="flex items-baseline gap-1 mt-1">
                            <span class="font-headline text-3xl font-bold text-secondary">{{ number_format($phong->gia_moi_dem, 0, ',', '.') }}đ</span>
                            <span class="text-sm text-outline">/ đêm</span>
                        </div>
                    </div>

                    <div class="flex flex-col gap-3 p-4 rounded-xl bg-surface-container-low">
                        <div class="flex items-center justify-between text-xs text-on-surface-variant">
                            <span>Mã số phòng:</span>
                            <strong class="text-on-surface font-headline">{{ $phong->so_phong }}</strong>
                        </div>
                        <div class="flex items-center justify-between text-xs text-on-surface-variant">
                            <span>Hạng lưu trú:</span>
                            <strong class="text-on-surface">{{ $phong->loaiPhong?->ten_loai_phong }}</strong>
                        </div>
                        <div class="flex items-center justify-between text-xs text-on-surface-variant">
                            <span>Sức chứa:</span>
                            <strong class="text-on-surface">{{ $phong->suc_chua_toi_da }} khách</strong>
                        </div>
                    </div>

                    <a href="{{ route('login') }}" class="w-full py-3.5 rounded-xl bg-secondary hover:bg-on-secondary-container text-white font-bold text-sm uppercase tracking-wider flex items-center justify-center gap-2 transition-all shadow-md active:scale-95 text-center">
                        <span class="material-symbols-outlined text-[20px]">calendar_add_on</span>
                        <span>Tiến Hành Đặt Phòng</span>
                    </a>

                    <div class="flex items-center justify-center gap-2 text-xs text-outline">
                        <span class="material-symbols-outlined text-[16px] text-green-600">verified_user</span>
                        <span>Đảm bảo mức giá tốt nhất trực tiếp từ khách sạn</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Rooms -->
        @if($relatedPhongs->isNotEmpty())
        <div class="mt-16 pt-12 border-t border-surface-container">
            <h2 class="font-headline text-2xl font-bold text-on-surface mb-6">Các Phòng Khác Cùng Hạng</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedPhongs as $rel)
                <div class="bg-surface-container-lowest p-4 rounded-xl shadow-sm flex items-center justify-between">
                    <div>
                        <span class="font-headline font-bold text-lg text-on-surface">Phòng {{ $rel->so_phong }}</span>
                        <span class="block text-xs text-outline">Tầng {{ $rel->tang }} • {{ number_format($rel->gia_moi_dem, 0, ',', '.') }}đ/đêm</span>
                    </div>
                    <a href="{{ route('phongs.show', $rel->id) }}" class="px-3 py-1.5 rounded-lg bg-surface-container text-on-surface font-semibold text-xs hover:bg-secondary hover:text-white transition-all">
                        Xem phòng
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </main>

    <!-- Footer -->
    <footer class="bg-primary-container text-white py-8 border-t border-white/10 text-center text-xs text-white/60">
        © {{ date('Y') }} Aura Luxury Hotel Group. Bản quyền thuộc về hệ thống quản lý khách sạn cao cấp.
    </footer>
</body>
</html>
