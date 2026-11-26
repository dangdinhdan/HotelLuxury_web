<!DOCTYPE html>
<html class="h-full" lang="vi">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Đăng Nhập &amp; Đăng Ký - Aura Hotel &amp; Suites</title>
    <!-- Google Fonts: Space Grotesk & Inter -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;family=Space+Grotesk:wght@400;500;600;700&amp;family=Playfair+Display:ital,wght@0,600;1,400&amp;display=swap" rel="stylesheet">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script data-purpose="tailwind-config">
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        aura: {
                            navy: '#121a2f',
                            dark: '#0c1220',
                            gold: '#d4af37',
                            goldLight: '#f3e3ab',
                            goldDark: '#b28e28',
                            surface: '#f8f9ff',
                            slate: '#8b9bb4',
                            charcoal: '#1e283d',
                            border: 'rgba(212, 175, 55, 0.25)',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Space Grotesk', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                    }
                }
            }
        };
    </script>
    <style data-purpose="luxury-effects">
        .gold-gradient-text {
            background: linear-gradient(135deg, #f6e27a 0%, #d4af37 55%, #aa771c 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .gold-button {
            background: linear-gradient(135deg, #d4af37 0%, #c49b29 50%, #ad851f 100%);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .gold-button:hover {
            background: linear-gradient(135deg, #dfbc4a 0%, #d4af37 50%, #bd952a 100%);
            box-shadow: 0 10px 25px -5px rgba(212, 175, 55, 0.4);
            transform: translateY(-1px);
        }
        .gold-glow {
            box-shadow: 0 0 25px -3px rgba(212, 175, 55, 0.25);
        }
        .glass-dark {
            background: rgba(18, 26, 47, 0.78);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
        }
    </style>
</head>
<body class="h-full bg-aura-surface font-sans text-aura-dark antialiased flex flex-col justify-between selection:bg-aura-gold selection:text-white">

<!-- BEGIN: TopHeader -->
<header class="w-full bg-aura-navy/95 backdrop-blur border-b border-aura-gold/20 text-white z-40 px-4 sm:px-8 py-3.5">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
        <div class="flex items-center space-x-6">
            <a class="inline-flex items-center text-xs tracking-wider uppercase font-medium text-aura-slate hover:text-aura-gold transition-colors duration-200" href="{{ url('/') }}">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M10 19l-7-7m0 0l7-7m-7 7h18" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                </svg>
                Quay lại Trang Chủ &amp; Đặt Phòng
            </a>
            <span class="hidden sm:inline-block h-4 w-px bg-aura-gold/30"></span>
            <span class="hidden md:inline-block text-xs uppercase tracking-widest text-aura-gold font-display font-light">
                Aura Hotel &amp; Suites • Haute Hospitality
            </span>
        </div>
        <div class="flex items-center space-x-5 text-xs tracking-wider">
            <a class="hidden sm:flex items-center text-white/90 hover:text-aura-gold transition-colors font-medium" href="tel:19000899">
                <svg class="w-3.5 h-3.5 text-aura-gold mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                </svg>
                <span>Hotline VIP: <span class="font-bold text-aura-gold">1900 0899</span></span>
            </a>
            <div class="flex items-center border border-aura-gold/30 rounded-full px-2.5 py-1 space-x-2 bg-aura-dark/40">
                <button class="text-aura-gold font-semibold text-[11px]" type="button">VN</button>
                <span class="text-white/30 text-[10px]">|</span>
                <button class="text-aura-slate hover:text-white transition-colors text-[11px]" type="button">EN</button>
            </div>
        </div>
    </div>
</header>
<!-- END: TopHeader -->

<!-- BEGIN: MainContent -->
<main class="flex-grow flex items-center justify-center py-6 sm:py-10 px-4 sm:px-6">
    <div class="w-full max-w-6xl bg-white rounded-2xl shadow-2xl overflow-hidden border border-aura-gold/20 flex flex-col lg:flex-row min-h-[640px]">
        
        <!-- Left Hero Panel -->
        <section class="lg:w-1/2 relative bg-aura-navy min-h-[460px] lg:min-h-full flex flex-col justify-between p-8 sm:p-12 overflow-hidden">
            <img alt="Hotel Lobby" class="absolute inset-0 w-full h-full object-cover object-center transform scale-105 duration-1000 transition-transform hover:scale-100" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBLHawYkIWIOug0aTtnzkljOdcwKRpYdJJ6p53AbDA7XJ3kHmAzHLg-t1IvXkGTlOxr99imybxDBgogO9pH314xAJVxb4MG7WnHu2fCzEP9p0w4JSTHcNqQ3hGPWlz-Y8CgS3E5at-drM6jxUJtDgkKIk-Xg6P310x94OEcZiHVG8mgGZ7oUhJRNsSQbhzGw-0AXrEXieO-YTDKPv72lSpiItZTgKO80_kk-H1mHQ">
            <div class="absolute inset-0 bg-gradient-to-t from-aura-dark via-aura-navy/85 to-aura-navy/55 mix-blend-multiply pointer-events-none"></div>
            <div class="absolute inset-0 bg-aura-navy/35 pointer-events-none"></div>

            <div class="relative z-10">
                <div class="flex items-center space-x-3">
                    <div class="w-11 h-11 rounded-full border border-aura-gold/50 flex items-center justify-center bg-aura-navy/80 text-aura-gold">
                        <span class="font-serif font-bold text-xl tracking-tight">A</span>
                    </div>
                    <div>
                        <h1 class="font-display font-semibold tracking-widest text-lg text-white uppercase">AURA HOTEL &amp; SUITES</h1>
                        <p class="text-[10px] uppercase tracking-widest text-aura-gold font-medium">Grand Atelier Hospitality Collection</p>
                    </div>
                </div>
            </div>

            <div class="relative z-10 my-auto py-8">
                <div class="inline-flex items-center space-x-2 bg-aura-gold/15 backdrop-blur border border-aura-gold/40 px-3.5 py-1.5 rounded-full mb-6">
                    <span class="flex h-2 w-2 rounded-full bg-aura-gold animate-pulse"></span>
                    <span class="text-xs uppercase tracking-widest font-semibold text-aura-goldLight">Aura Privilege Club 2026</span>
                </div>
                <h2 class="font-serif text-3xl sm:text-4xl text-white font-normal leading-tight mb-4">
                    Đẳng cấp thượng lưu <br><span class="italic gold-gradient-text font-medium">trong từng khoảnh khắc nghỉ dưỡng.</span>
                </h2>
                <p class="text-sm text-gray-200/90 max-w-md font-light leading-relaxed">
                    "Trải nghiệm đặc quyền thượng lưu cùng hàng triệu dặm thưởng tích lũy tại hơn 50 chi nhánh toàn cầu thuộc hệ sinh thái Grand Atelier."
                </p>
            </div>

            <div class="relative z-10 pt-4 border-t border-aura-gold/25 flex items-center justify-between text-xs text-aura-slate">
                <div class="flex items-center space-x-2">
                    <span class="text-aura-gold">★ ★ ★ ★ ★</span>
                    <span class="text-white/80 font-medium">World Luxury Hotel Awards</span>
                </div>
                <div class="text-[11px] uppercase tracking-wider text-aura-goldLight">Member Exclusive</div>
            </div>
        </section>

        <!-- Right Auth Panel -->
        <section class="lg:w-1/2 bg-white flex flex-col justify-between p-8 sm:p-12 relative">
            
            <!-- Alert Messages -->
            @if(session('success'))
                <div class="mb-4 p-3 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-lg text-xs flex items-center">
                    <svg class="w-4 h-4 mr-2 text-emerald-600 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 p-3 bg-rose-50 border border-rose-200 text-rose-800 rounded-lg text-xs">
                    <div class="font-semibold mb-1 flex items-center">
                        <svg class="w-4 h-4 mr-1 text-rose-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                        Đã có lỗi xảy ra:
                    </div>
                    <ul class="list-disc list-inside space-y-0.5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div>
                <!-- Top Tab Bar -->
                <div class="flex items-center justify-between border-b border-gray-100 pb-4 mb-6">
                    <div class="flex space-x-6 text-sm">
                        <button class="pb-3 border-b-2 font-display uppercase tracking-wider text-xs font-bold transition-all text-aura-navy border-aura-gold" id="tabLoginBtn" type="button">
                            Đăng Nhập
                        </button>
                        <button class="pb-3 border-b-2 font-display uppercase tracking-wider text-xs font-semibold transition-all text-gray-400 border-transparent hover:text-aura-navy" id="tabRegisterBtn" type="button">
                            Đăng Ký Hội Viên
                        </button>
                    </div>

                    <!-- Role Portal Badge -->
                    <div class="flex items-center space-x-2">
                        <div class="bg-amber-50 text-amber-800 border border-aura-gold/30 px-2.5 py-0.5 rounded text-[11px] font-semibold flex items-center gap-1" id="roleBadge">
                            <span class="text-aura-gold">✦</span>
                            Khách Hàng &amp; Quản Trị
                        </div>
                    </div>
                </div>

                <!-- LOGIN FORM VIEW -->
                <div id="loginFormContainer">
                    <div class="mb-6">
                        <h3 class="font-display font-semibold text-2xl text-aura-navy">Chào mừng trở lại</h3>
                        <p class="text-xs text-aura-slate mt-1">Truy cập để quản lý đơn phòng, đặc quyền phòng VIP hoặc điều hành hệ thống.</p>
                    </div>

                    <form action="{{ route('login') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs uppercase tracking-wider font-semibold text-aura-navy mb-1.5" for="login-email">
                                Email Tài Khoản
                            </label>
                            <input class="block w-full px-3.5 py-2.5 bg-aura-surface border border-gray-200 rounded-lg text-sm text-aura-navy placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-aura-gold/40 focus:border-aura-gold transition-colors" id="login-email" name="email" value="{{ old('email') }}" placeholder="admin@hotelluxury.vn hoặc email của bạn" required type="email">
                        </div>

                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <label class="block text-xs uppercase tracking-wider font-semibold text-aura-navy" for="login-password">
                                    Mật Khẩu
                                </label>
                                <button class="text-[11px] text-aura-goldDark hover:text-aura-gold transition-colors font-medium" id="forgotPasswordLink" type="button">
                                    Quên mật khẩu?
                                </button>
                            </div>
                            <div class="relative">
                                <input class="block w-full px-3.5 py-2.5 bg-aura-surface border border-gray-200 rounded-lg text-sm text-aura-navy placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-aura-gold/40 focus:border-aura-gold transition-colors" id="login-password" name="mat_khau" placeholder="••••••••" required type="password">
                                <button class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-aura-gold" id="togglePasswordVisibilityBtn" type="button">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
                                </button>
                            </div>
                        </div>

                        <div class="flex items-center justify-between text-xs pt-1">
                            <label class="flex items-center text-aura-slate select-none cursor-pointer">
                                <input class="rounded border-gray-300 text-aura-gold focus:ring-aura-gold mr-2 h-4 w-4" name="remember" type="checkbox">
                                <span>Ghi nhớ phiên đăng nhập</span>
                            </label>
                        </div>

                        <div class="pt-2">
                            <button class="w-full gold-button text-aura-dark font-display font-semibold text-sm uppercase tracking-wider py-3.5 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-aura-gold transition-all duration-200" type="submit">
                                Đăng Nhập Hệ Thống
                            </button>
                        </div>
                    </form>

                    <!-- Demo Accounts Quick Fill (Helpful for development) -->
                    <div class="mt-4 p-3 bg-gray-50 rounded-lg border border-gray-200 text-xs">
                        <span class="font-bold text-gray-700 block mb-1">Tài khoản mẫu thử nghiệm:</span>
                        <div class="flex flex-wrap gap-2">
                            <button type="button" onclick="fillAccount('admin@hotelluxury.vn', 'admin123')" class="px-2 py-1 bg-white border border-gray-300 rounded text-[11px] hover:border-aura-gold">Admin (admin@hotelluxury.vn)</button>
                            <button type="button" onclick="fillAccount('letan@hotelluxury.vn', 'letan123')" class="px-2 py-1 bg-white border border-gray-300 rounded text-[11px] hover:border-aura-gold">Lễ tân (letan@hotelluxury.vn)</button>
                            <button type="button" onclick="fillAccount('khachhang@gmail.com', 'khach123')" class="px-2 py-1 bg-white border border-gray-300 rounded text-[11px] hover:border-aura-gold">Khách (khachhang@gmail.com)</button>
                        </div>
                    </div>
                </div>

                <!-- REGISTER FORM VIEW -->
                <div class="hidden" id="registerFormContainer">
                    <div class="mb-5">
                        <h3 class="font-display font-semibold text-2xl text-aura-navy">Gia nhập Aura Privilege Club</h3>
                        <p class="text-xs text-aura-slate mt-1">Đăng ký thành viên để nhận ưu đãi 15% đặt phòng và dịch vụ phòng VIP.</p>
                    </div>

                    <form action="{{ route('register') }}" method="POST" class="space-y-3.5">
                        @csrf
                        <div>
                            <label class="block text-xs uppercase tracking-wider font-semibold text-aura-navy mb-1" for="reg-fullname">
                                Họ và Tên Khách Hàng <span class="text-red-500">*</span>
                            </label>
                            <input class="block w-full px-3.5 py-2 bg-aura-surface border border-gray-200 rounded-lg text-sm text-aura-navy focus:outline-none focus:ring-2 focus:ring-aura-gold/40 focus:border-aura-gold" id="reg-fullname" name="ho_ten" value="{{ old('ho_ten') }}" placeholder="VD: Nguyễn Văn Anh" required type="text">
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs uppercase tracking-wider font-semibold text-aura-navy mb-1" for="reg-email">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input class="block w-full px-3.5 py-2 bg-aura-surface border border-gray-200 rounded-lg text-sm text-aura-navy focus:outline-none focus:ring-2 focus:ring-aura-gold/40 focus:border-aura-gold" id="reg-email" name="email" value="{{ old('email') }}" placeholder="name@domain.com" required type="email">
                            </div>
                            <div>
                                <label class="block text-xs uppercase tracking-wider font-semibold text-aura-navy mb-1" for="reg-phone">
                                    Số Điện Thoại
                                </label>
                                <input class="block w-full px-3.5 py-2 bg-aura-surface border border-gray-200 rounded-lg text-sm text-aura-navy focus:outline-none focus:ring-2 focus:ring-aura-gold/40 focus:border-aura-gold" id="reg-phone" name="so_dien_thoai" value="{{ old('so_dien_thoai') }}" placeholder="0912 345 678" type="tel">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs uppercase tracking-wider font-semibold text-aura-navy mb-1" for="reg-password">
                                    Mật Khẩu <span class="text-red-500">*</span>
                                </label>
                                <input class="block w-full px-3.5 py-2 bg-aura-surface border border-gray-200 rounded-lg text-sm text-aura-navy focus:outline-none focus:ring-2 focus:ring-aura-gold/40 focus:border-aura-gold" id="reg-password" name="mat_khau" placeholder="Tối thiểu 6 ký tự" required type="password">
                            </div>
                            <div>
                                <label class="block text-xs uppercase tracking-wider font-semibold text-aura-navy mb-1" for="reg-password-confirm">
                                    Xác Nhận Mật Khẩu <span class="text-red-500">*</span>
                                </label>
                                <input class="block w-full px-3.5 py-2 bg-aura-surface border border-gray-200 rounded-lg text-sm text-aura-navy focus:outline-none focus:ring-2 focus:ring-aura-gold/40 focus:border-aura-gold" id="reg-password-confirm" name="mat_khau_confirmation" placeholder="Nhập lại mật khẩu" required type="password">
                            </div>
                        </div>

                        <div class="pt-1">
                            <label class="flex items-start text-[11px] text-aura-slate cursor-pointer">
                                <input class="rounded border-gray-300 text-aura-gold focus:ring-aura-gold mr-2 mt-0.5 h-3.5 w-3.5" name="agree_terms" required type="checkbox">
                                <span>Tôi đồng ý với các <a href="#" class="text-aura-goldDark underline">Điều khoản dịch vụ</a> và <a href="#" class="text-aura-goldDark underline">Chính sách bảo mật</a> của Aura Hotel.</span>
                            </label>
                        </div>

                        <div class="pt-2">
                            <button class="w-full gold-button text-aura-dark font-display font-semibold text-sm uppercase tracking-wider py-3.5 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-aura-gold transition-all duration-200" type="submit">
                                Tạo Tài Khoản Hội Viên
                            </button>
                        </div>
                    </form>
                </div>

                <!-- FORGOT PASSWORD DRAWER -->
                <div class="hidden absolute inset-0 bg-white p-8 sm:p-12 z-20 flex flex-col justify-between" id="forgotPasswordContainer">
                    <div>
                        <button class="inline-flex items-center text-xs font-semibold text-aura-navy hover:text-aura-gold uppercase tracking-wider mb-6" id="closeForgotBtn" type="button">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
                            Quay lại đăng nhập
                        </button>
                        <h3 class="font-display font-semibold text-2xl text-aura-navy">Khôi phục quyền truy cập</h3>
                        <p class="text-xs text-aura-slate mt-2 leading-relaxed">
                            Nhập email đã đăng ký tài khoản. Hệ thống sẽ hỗ trợ bạn cấp lại mật khẩu.
                        </p>

                        <form action="{{ route('forgot-password') }}" method="POST" class="mt-6 space-y-4">
                            @csrf
                            <div>
                                <label class="block text-xs uppercase tracking-wider font-semibold text-aura-navy mb-1.5" for="reset-target">
                                    Email Đăng Ký
                                </label>
                                <input class="block w-full px-3.5 py-2.5 bg-aura-surface border border-gray-200 rounded-lg text-sm text-aura-navy focus:outline-none focus:ring-2 focus:ring-aura-gold/40 focus:border-aura-gold" id="reset-target" name="email" placeholder="name@domain.com" required type="email">
                            </div>
                            <button class="w-full gold-button text-aura-dark font-display font-semibold text-sm uppercase tracking-wider py-3 rounded-lg shadow-md" type="submit">
                                Gửi Yêu Cầu Đặt Lại Mật Khẩu
                            </button>
                        </form>
                    </div>
                    <div class="text-center text-xs text-gray-500 pt-6 border-t border-gray-100">
                        Cần hỗ trợ trực tiếp từ Quản Gia VIP? <br>
                        <a class="text-aura-gold font-medium" href="tel:19000899">Gọi Concierge Desk 24/7 (1900 0899)</a>
                    </div>
                </div>

            </div>

            <div class="mt-6 pt-4 border-t border-gray-100 flex items-center justify-between text-[11px] text-gray-400">
                <span>© 2026 Aura Hotel &amp; Residences.</span>
                <span>Bảo mật chuẩn mã hóa SSL 256-bit</span>
            </div>
        </section>

    </div>
</main>
<!-- END: MainContent -->

<script>
    const tabLoginBtn = document.getElementById('tabLoginBtn');
    const tabRegisterBtn = document.getElementById('tabRegisterBtn');
    const loginFormContainer = document.getElementById('loginFormContainer');
    const registerFormContainer = document.getElementById('registerFormContainer');

    tabLoginBtn.addEventListener('click', () => {
        tabLoginBtn.classList.add('text-aura-navy', 'border-aura-gold');
        tabLoginBtn.classList.remove('text-gray-400', 'border-transparent');
        tabRegisterBtn.classList.add('text-gray-400', 'border-transparent');
        tabRegisterBtn.classList.remove('text-aura-navy', 'border-aura-gold');
        loginFormContainer.classList.remove('hidden');
        registerFormContainer.classList.add('hidden');
    });

    tabRegisterBtn.addEventListener('click', () => {
        tabRegisterBtn.classList.add('text-aura-navy', 'border-aura-gold');
        tabRegisterBtn.classList.remove('text-gray-400', 'border-transparent');
        tabLoginBtn.classList.add('text-gray-400', 'border-transparent');
        tabLoginBtn.classList.remove('text-aura-navy', 'border-aura-gold');
        registerFormContainer.classList.remove('hidden');
        loginFormContainer.classList.add('hidden');
    });

    const forgotPasswordLink = document.getElementById('forgotPasswordLink');
    const closeForgotBtn = document.getElementById('closeForgotBtn');
    const forgotPasswordContainer = document.getElementById('forgotPasswordContainer');

    forgotPasswordLink.addEventListener('click', () => {
        forgotPasswordContainer.classList.remove('hidden');
    });

    closeForgotBtn.addEventListener('click', () => {
        forgotPasswordContainer.classList.add('hidden');
    });

    const togglePasswordVisibilityBtn = document.getElementById('togglePasswordVisibilityBtn');
    const passwordInput = document.getElementById('login-password');
    let isPasswordShown = false;

    togglePasswordVisibilityBtn.addEventListener('click', () => {
        isPasswordShown = !isPasswordShown;
        passwordInput.type = isPasswordShown ? 'text' : 'password';
        togglePasswordVisibilityBtn.classList.toggle('text-aura-gold', isPasswordShown);
    });

    function fillAccount(email, pass) {
        document.getElementById('login-email').value = email;
        document.getElementById('login-password').value = pass;
    }
</script>
</body>
</html>
