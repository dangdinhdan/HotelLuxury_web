<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Aura Hotel &amp; Suites - Grand Atelier Hospitality</title>
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,600;1,400&family=Space+Grotesk:wght@600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .gold-button {
            background: linear-gradient(135deg, #d4af37 0%, #c49b29 50%, #ad851f 100%);
            transition: all 0.3s ease;
        }
        .gold-button:hover {
            background: linear-gradient(135deg, #dfbc4a 0%, #d4af37 50%, #bd952a 100%);
            box-shadow: 0 10px 25px -5px rgba(212, 175, 55, 0.4);
            transform: translateY(-1px);
        }
        .gold-gradient-text {
            background: linear-gradient(135deg, #f6e27a 0%, #d4af37 55%, #aa771c 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body class="bg-[#0c1220] text-white font-sans antialiased min-h-screen flex flex-col justify-between">
    <!-- Header -->
    <header class="w-full bg-[#121a2f]/95 backdrop-blur border-b border-[#d4af37]/20 px-6 py-4 fixed top-0 z-50">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-full border border-[#d4af37]/50 flex items-center justify-center bg-[#121a2f] text-[#d4af37] font-serif font-bold text-xl">
                    A
                </div>
                <div>
                    <span class="font-bold tracking-widest text-sm text-white uppercase block">AURA HOTEL &amp; SUITES</span>
                    <span class="text-[10px] uppercase tracking-widest text-[#d4af37]">Haute Hospitality Collection</span>
                </div>
            </div>

            <div class="flex items-center space-x-4 text-xs">
                @auth
                    @if(Auth::user()->vai_tro_id <= 2)
                        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded-lg bg-[#d4af37] text-[#121a2f] font-bold shadow hover:bg-yellow-400 transition-all">
                            Vào Trang Quản Trị
                        </a>
                    @else
                        <a href="{{ route('profile') }}" class="px-4 py-2 rounded-lg bg-white/10 text-white font-medium hover:bg-white/20 transition-all">
                            Hồ Sơ: {{ Auth::user()->ho_ten }}
                        </a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-3 py-2 text-gray-400 hover:text-white transition-colors">Đăng xuất</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="gold-button px-5 py-2.5 rounded-lg text-[#121a2f] font-bold uppercase tracking-wider text-xs">
                        Đăng Nhập / Đăng Ký
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <main class="flex-grow pt-28 pb-16 flex items-center justify-center relative overflow-hidden px-6">
        <div class="absolute inset-0 bg-cover bg-center opacity-25 scale-105" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBLHawYkIWIOug0aTtnzkljOdcwKRpYdJJ6p53AbDA7XJ3kHmAzHLg-t1IvXkGTlOxr99imybxDBgogO9pH314xAJVxb4MG7WnHu2fCzEP9p0w4JSTHcNqQ3hGPWlz-Y8CgS3E5at-drM6jxUJtDgkKIk-Xg6P310x94OEcZiHVG8mgGZ7oUhJRNsSQbhzGw-0AXrEXieO-YTDKPv72lSpiItZTgKO80_kk-H1mHQ');"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-[#0c1220] via-transparent to-[#0c1220]/80"></div>

        <div class="relative z-10 max-w-4xl text-center flex flex-col items-center">
            <div class="inline-flex items-center space-x-2 bg-[#d4af37]/15 border border-[#d4af37]/40 px-4 py-1.5 rounded-full mb-6 text-xs text-[#f3e3ab] font-semibold tracking-widest uppercase">
                <span>★ ★ ★ ★ ★ 5-Star Luxury Resort &amp; Hotel</span>
            </div>

            <h1 class="font-serif text-4xl sm:text-6xl font-normal leading-tight mb-6">
                Tuyệt tác nghỉ dưỡng <br>
                <span class="gold-gradient-text italic font-medium">giữa lòng di sản thượng lưu</span>
            </h1>

            <p class="text-sm sm:text-base text-gray-300 max-w-2xl font-light leading-relaxed mb-8">
                Khám phá dịch vụ quản gia cao cấp, phòng nghỉ hoàng gia view toàn cảnh thành phố cùng tiện nghi ẩm thực đạt sao Michelin đẳng cấp quốc tế.
            </p>

            <div class="flex flex-wrap items-center justify-center gap-4">
                @auth
                    @if(Auth::user()->vai_tro_id <= 2)
                        <a href="{{ route('admin.dashboard') }}" class="gold-button px-7 py-3.5 rounded-xl text-[#121a2f] font-bold uppercase tracking-wider text-xs shadow-xl">
                            Truy Cập Trang Quản Trị Hệ Thống &rarr;
                        </a>
                    @else
                        <a href="{{ route('profile') }}" class="gold-button px-7 py-3.5 rounded-xl text-[#121a2f] font-bold uppercase tracking-wider text-xs shadow-xl">
                            Hồ Sơ Hội Viên VIP
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="gold-button px-7 py-3.5 rounded-xl text-[#121a2f] font-bold uppercase tracking-wider text-xs shadow-xl">
                        Trải Nghiệm Đăng Nhập &amp; Đăng Ký
                    </a>
                @endauth
            </div>

            <!-- Quick Demo Accounts Badge -->
            <div class="mt-12 p-4 bg-white/5 border border-white/10 rounded-2xl max-w-lg w-full text-left backdrop-blur-sm">
                <span class="text-xs text-[#d4af37] font-bold uppercase tracking-wider block mb-2">Tài khoản kiểm thử đã nạp sẵn:</span>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 text-[11px] text-gray-300">
                    <div class="bg-black/30 p-2 rounded border border-white/5">
                        <strong class="text-red-400 block">Admin:</strong>
                        <span>admin@hotelluxury.vn</span><br>
                        <span class="text-gray-400">Pass: admin123</span>
                    </div>
                    <div class="bg-black/30 p-2 rounded border border-white/5">
                        <strong class="text-blue-400 block">Lễ tân:</strong>
                        <span>letan@hotelluxury.vn</span><br>
                        <span class="text-gray-400">Pass: letan123</span>
                    </div>
                    <div class="bg-black/30 p-2 rounded border border-white/5">
                        <strong class="text-emerald-400 block">Khách hàng:</strong>
                        <span>khachhang@gmail.com</span><br>
                        <span class="text-gray-400">Pass: khach123</span>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="w-full bg-[#121a2f] border-t border-[#d4af37]/20 py-4 px-6 text-center text-xs text-gray-400">
        © 2026 Aura Hotel &amp; Suites. All Rights Reserved. Grand Atelier Hospitality Collection.
    </footer>
</body>
</html>
