<!-- Top Marquee Bar -->
<div class="bg-yellow-400 py-1 overflow-hidden whitespace-nowrap border-b border-yellow-500 relative z-[60]">
    <div class="animate-marquee flex items-center gap-8">
        <span class="text-primary font-black text-xs uppercase tracking-widest flex items-center gap-2">
            🧧 CHÚC MỪNG NĂM MỚI 🧧 GIẢM GIÁ SỐC TẤT CẢ CÁC TÀI KHOẢN 🧧 HÁI LỘC ĐẦU XUÂN - NHẬN QUÀ CỰC KHỦNG 🧧 UY TÍN - CHẤT LƯỢNG - GIÁ RẺ 🧧
        </span>

    </div>
    <div class="animate-marquee flex items-center gap-8">
        <span class="text-primary font-black text-xs uppercase tracking-widest flex items-center gap-2">
            🧧 CHÚC MỪNG NĂM MỚI 🧧 GIẢM GIÁ SỐC TẤT CẢ CÁC TÀI KHOẢN 🧧 HÁI LỘC ĐẦU XUÂN - NHẬN QUÀ CỰC KHỦNG 🧧 UY TÍN - CHẤT LƯỢNG - GIÁ RẺ 🧧
        </span>

    </div>
</div>

<header class="sticky top-0 z-50 shadow-md relative overflow-visible" style="background: linear-gradient(135deg, #C41E1E 0%, #D42020 50%, #E85D2A 100%);">
    <!-- Decorative branches -->
    <img src="{{ asset('images/hoa1.webp') }}" class="absolute -top-4 -left-8 w-48 opacity-90 -rotate-12 pointer-events-none hidden lg:block z-20">
    <img src="{{ asset('images/hoa2.webp') }}" class="absolute -top-4 -right-12 w-48 opacity-90 rotate-12 pointer-events-none hidden lg:block z-20 transform -scale-x-100">

    <!-- Hanging decorations -->
    <div class="absolute left-4 top-full -mt-2 animate-swing hidden xl:block z-30 pointer-events-none">
        <img src="{{ asset('images/phao1.webp') }}" class="w-16 drop-shadow-lg">
    </div>
    <div class="absolute right-4 top-full -mt-2 animate-swing hidden xl:block z-30 pointer-events-none">
        <img src="{{ asset('images/phao1.webp') }}" class="w-16 drop-shadow-lg transform -scale-x-100">
    </div>

    <div class="container mx-auto px-4 py-3 flex items-center justify-between relative z-40">
        <div class="flex items-center gap-8">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2 group relative">
                <img src="{{ asset('logo.webp') }}" alt="Logo" class="h-16 relative z-10 transition-transform group-hover:scale-110" width="128" height="128" />
                <div class="absolute inset-0 bg-yellow-400/20 blur-xl rounded-full scale-0 group-hover:scale-150 transition-transform duration-500"></div>
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden lg:flex items-center gap-1">
                @php
                $navItems = [
                ['route' => 'home', 'icon' => 'home', 'label' => 'TRANG CHỦ'],
                ['route' => 'products.index', 'icon' => 'shopping_bag', 'label' => 'SẢN PHẨM'],
                ['route' => 'deposit', 'icon' => 'account_balance_wallet', 'label' => 'NẠP TIỀN'],
                ['route' => 'lucky-wheel.index', 'icon' => 'park', 'label' => 'CÂY HÁI LỘC'],
                ['route' => 'news.index', 'icon' => 'newspaper', 'label' => 'TIN TỨC'],
                ['route' => 'policy', 'icon' => 'policy', 'label' => 'CHÍNH SÁCH'],
                ];
                @endphp

                @foreach($navItems as $item)
                <a class="nav-link font-semibold flex items-center gap-2 text-white/90 hover:text-white hover:bg-white/15 transition-all px-4 py-2 rounded-lg hover-glow-gold {{ request()->routeIs($item['route']) ? 'active bg-white/20' : '' }}" href="{{ route($item['route']) }}">
                    <span class="material-icons text-base">{{ $item['icon'] }}</span>
                    <span class="text-sm tracking-wide">{{ $item['label'] }}</span>
                </a>
                @endforeach
            </nav>
        </div>

        <div class="flex items-center gap-3">
            @auth
            <!-- Balance Display -->
            <div class="flex flex-col items-end px-3 md:px-4 py-1 md:py-2 rounded-lg bg-white/15 border border-white/20 hover:bg-white/25 transition-all group cursor-pointer relative overflow-hidden">
                <div class="absolute inset-0 bg-yellow-400 translate-y-full group-hover:translate-y-0 transition-transform duration-300 opacity-10"></div>
                <span class="hidden md:block text-[10px] text-white/70 uppercase tracking-widest font-bold">Số dư</span>
                <span class="text-yellow-300 font-black text-sm md:text-lg group-hover:text-white transition-colors">
                    {{ number_format(auth()->user()->wallet()->value('balance'), 0, ',', '.') }} <span class="text-[10px] md:text-sm">đ</span>
                </span>
            </div>

            <!-- User Profile -->
            <a href="{{ route('user.profile') }}" class="flex items-center gap-2 bg-white/15 hover:bg-white/25 px-3 md:px-4 py-1 md:py-2 rounded-lg border border-white/20 cursor-pointer transition-all hover-glow-gold">
                <span class="material-icons text-white text-xl md:text-2xl">account_circle</span>
                <div class="flex flex-col">
                    <span class="text-white text-[10px] md:text-[12px] font-medium max-w-[50px] md:max-w-none truncate">{{ auth()->user()->name }}</span>
                    <span class="text-[8px] md:text-[10px] text-white/70">ID: {{ auth()->user()->id }}</span>
                </div>
            </a>
            @else
            <!-- Login Button -->
            <a href="{{ route('login') }}" class="hidden md:flex items-center gap-2 bg-white text-primary hover:bg-yellow-400 hover:text-white px-5 py-2 rounded-lg font-bold transition-all shadow-sm group">
                <span class="material-icons group-hover:scale-110 transition-transform">login</span>
                <span class="text-sm">ĐĂNG NHẬP</span>
            </a>
            @endauth

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn" class="lg:hidden text-white p-2 rounded-lg bg-white/15 hover:bg-white/25 transition-all border border-white/20">
                <span class="material-icons text-2xl">menu</span>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden lg:hidden border-t border-white/20" style="background: linear-gradient(180deg, #B01818 0%, #C41E1E 100%);">
        <nav class="container mx-auto px-4 py-4 flex flex-col gap-1">
            @auth
            <!-- Mobile User Info -->
            <div class="p-4 mb-3 rounded-2xl bg-linear-to-br from-white/20 to-white/5 border border-white/20 shadow-xl relative overflow-hidden group">
                <div class="absolute -top-10 -right-10 w-24 h-24 bg-yellow-400/10 rounded-full blur-2xl"></div>
                <div class="flex items-center justify-between relative z-10">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center border border-white/30 shadow-inner">
                            <span class="material-icons text-white text-3xl">account_circle</span>
                        </div>
                        <div>
                            <div class="font-black text-white text-lg tracking-wide">{{ auth()->user()->name }}</div>
                            <div class="text-xs text-white/70 font-bold">ID: {{ auth()->user()->id }}</div>
                        </div>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-white/10 flex items-center justify-between relative z-10">
                    <div>
                        <div class="text-[10px] text-white/60 uppercase font-black tracking-widest">Ví tài khoản</div>
                        <div class="text-yellow-400 font-black text-2xl tracking-tighter">
                            {{ number_format(auth()->user()->wallet()->value('balance'), 0, ',', '.') }}<span class="text-sm ml-1">đ</span>
                        </div>
                    </div>
                    <a href="{{ route('deposit') }}" class="bg-yellow-400 text-primary font-black px-4 py-2 rounded-xl text-xs uppercase tracking-widest shadow-lg active:scale-95 transition-transform">
                        Nạp ngay
                    </a>
                </div>
            </div>
            @endauth

            @foreach($navItems as $item)
            <a class="flex items-center gap-3 text-white/90 hover:text-white hover:bg-white/10 font-semibold py-3 px-4 rounded-lg transition-all" href="{{ route($item['route']) }}">
                <span class="material-icons text-xl">{{ $item['icon'] }}</span>
                <span class="tracking-wide">{{ str_replace('TRANG CHỦ', 'Trang chủ', str_replace('SẢN PHẨM', 'Sản phẩm', str_replace('NẠP TIỀN', 'Nạp tiền', str_replace('CÂY HÁI LỘC', 'Cây Hái Lộc', str_replace('TIN TỨC', 'Tin tức', str_replace('CHÍNH SÁCH', 'Chính sách', $item['label'])))))) }}</span>
                <span class="material-icons ml-auto text-white/40">chevron_right</span>
            </a>
            @endforeach

            @auth
            <a class="flex items-center gap-3 text-white/90 hover:text-white hover:bg-white/10 font-semibold py-3 px-4 rounded-lg transition-all" href="{{ route('user.profile') }}">
                <span class="material-icons text-xl">account_circle</span>
                <span class="tracking-wide">Tài khoản</span>
                <span class="material-icons ml-auto text-white/40">chevron_right</span>
            </a>
            @endauth
        </nav>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');

                if (!mobileMenu.classList.contains('hidden')) {
                    const menuItems = mobileMenu.querySelectorAll('a');
                    menuItems.forEach((item, index) => {
                        item.style.opacity = '0';
                        item.style.transform = 'translateX(-20px)';
                        setTimeout(() => {
                            item.style.transition = 'all 0.3s ease-out';
                            item.style.opacity = '1';
                            item.style.transform = 'translateX(0)';
                        }, index * 50);
                    });
                }
            });

            document.addEventListener('click', function(event) {
                if (!mobileMenuBtn.contains(event.target) && !mobileMenu.contains(event.target)) {
                    mobileMenu.classList.add('hidden');
                }
            });
        }
    });
</script>

<style>
    body {
        overflow-x: hidden;
    }

    .nav-link.active {
        background: rgba(255, 255, 255, 0.2);
        color: #ffd700 !important;
    }
</style>