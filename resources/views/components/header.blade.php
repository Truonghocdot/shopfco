<!-- Top Info Bar -->
<div class="bg-black py-1 overflow-hidden whitespace-nowrap border-b border-white/5 relative z-60">
    <div class="animate-marquee flex items-center gap-8">
        <span class="text-primary font-black text-[10px] uppercase tracking-[0.2em] flex items-center gap-2">
            ⚡ HỆ THỐNG MUA BÁN ACC FC ONLINE UY TÍN ⚡ GIAO DỊCH TỰ ĐỘNG 24/7 ⚡ HỖ TRỢ NHIỆT TÌNH ⚡ BẢO MẬT TUYỆT ĐỐI ⚡
        </span>
    </div>
</div>

<header class="sticky top-0 z-50 glass border-b border-white/5 shadow-2xl overflow-visible">
    <!-- Removed Tet decorative branches and firecrackers -->

    <div class="container mx-auto px-2 md:px-4 py-3 flex items-center justify-between relative z-40">
        <div class="flex items-center gap-8">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2 group relative">
                <span class="text-3xl md:text-4xl font-black italic tracking-tighter text-white group-hover:text-primary transition-all duration-500 relative z-10 drop-shadow-[0_0_10px_rgba(74,222,128,0.5)]">
                    VANH<span class="text-primary group-hover:text-white transition-colors">FCO</span>
                </span>
                <div class="absolute -inset-2 bg-primary/20 blur-xl rounded-full scale-0 group-hover:scale-110 transition-transform duration-700 opacity-0 group-hover:opacity-100"></div>
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden lg:flex items-center gap-1">
                @php
                $navItems = [
                ['route' => 'home', 'icon' => 'home', 'label' => 'TRANG CHỦ'],
                ['route' => 'products.index', 'icon' => 'shopping_bag', 'label' => 'SẢN PHẨM'],
                ['route' => 'deposit', 'icon' => 'account_balance_wallet', 'label' => 'NẠP TIỀN'],
                ['route' => 'lucky-wheel.index', 'icon' => 'surfing', 'label' => 'LƯỚT SÓNG ĐÓN QUÀ'],
                ['route' => 'news.index', 'icon' => 'newspaper', 'label' => 'TIN TỨC'],
                ['route' => 'policy', 'icon' => 'policy', 'label' => 'CHÍNH SÁCH'],
                ];
                @endphp

                @foreach($navItems as $item)
                <a class="nav-link font-bold flex items-center gap-2 text-neutral-300 hover:text-white px-4 py-2 rounded-lg transition-all {{ request()->routeIs($item['route']) ? 'active text-primary' : '' }}" href="{{ route($item['route']) }}">
                    <span class="material-icons text-base">{{ $item['icon'] }}</span>
                    <span class="text-xs tracking-widest">{{ $item['label'] }}</span>
                </a>
                @endforeach
            </nav>
        </div>

        <div class="flex items-center gap-3">
            @auth
            <!-- Balance Display -->
            <div class="flex flex-col items-end px-3 md:px-4 py-1 md:py-2 rounded-lg bg-white/5 border border-white/10 hover:border-primary/50 transition-all group cursor-pointer relative overflow-hidden">
                <span class="hidden md:block text-[9px] text-neutral-600 uppercase tracking-widest font-black">Số dư</span>
                <span class="text-primary font-black text-sm md:text-lg drop-shadow-[0_0_8px_rgba(74,222,128,0.4)]">
                    {{ number_format(auth()->user()->wallet()->value('balance'), 0, ',', '.') }} <span class="text-[10px] md:text-sm">đ</span>
                </span>
            </div>

            <!-- User Profile -->
            <a href="{{ route('user.profile') }}" class="flex items-center gap-2 bg-white/5 hover:bg-white/10 px-3 md:px-4 py-1 md:py-2 rounded-lg border border-white/10 cursor-pointer transition-all hover:border-primary/50">
                <span class="material-icons text-primary text-xl md:text-2xl">account_circle</span>
                <div class="flex flex-col">
                    <span class="text-white text-[10px] md:text-[12px] font-bold max-w-[50px] md:max-w-none truncate">{{ auth()->user()->name }}</span>
                    <span class="text-[8px] md:text-[10px] text-neutral-600 font-black tracking-tighter">ID: {{ auth()->user()->id }}</span>
                </div>
            </a>

            <!-- Logout Button (Desktop) -->
            <form action="{{ route('logout') }}" method="POST" class="hidden md:block">
                @csrf
                <button type="submit" class="p-2 rounded-lg bg-white/10 hover:bg-white/20 text-white transition-all border border-white/10 hover:border-white/30" title="Đăng xuất">
                    <span class="material-icons text-xl">logout</span>
                </button>
            </form>
            @else
            <!-- Login Button -->
            <a href="{{ route('login') }}" class="hidden md:flex items-center gap-2 btn-esport px-5 py-2 rounded-lg font-black transition-all shadow-lg group">
                <span class="material-icons group-hover:rotate-12 transition-transform">login</span>
                <span class="text-xs tracking-widest">ĐĂNG NHẬP</span>
            </a>
            @endauth

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn" class="lg:hidden text-white p-2 rounded-lg bg-white/15 hover:bg-white/25 transition-all border border-white/20">
                <span class="material-icons text-2xl">menu</span>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden lg:hidden border-t border-white/5 bg-neutral-950/95 backdrop-blur-xl">
        <nav class="container mx-auto px-4 py-4 flex flex-col gap-1">
            @auth
            <!-- Mobile User Info -->
            <div class="p-4 mb-3 rounded-2xl bg-white/5 border border-white/10 shadow-2xl relative overflow-hidden group">
                <div class="absolute -top-10 -right-10 w-24 h-24 bg-primary/10 rounded-full blur-2xl"></div>
                <div class="flex items-center justify-between relative z-10">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-neutral-900 flex items-center justify-center border border-white/10 shadow-inner">
                            <span class="material-icons text-primary text-3xl">account_circle</span>
                        </div>
                        <div>
                            <div class="font-black text-white text-lg tracking-tight">{{ auth()->user()->name }}</div>
                            <div class="text-[10px] text-neutral-600 font-bold uppercase tracking-wider">ID: {{ auth()->user()->id }}</div>
                        </div>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-white/5 flex items-center justify-between relative z-10">
                    <div>
                        <div class="text-[9px] text-neutral-600 uppercase font-black tracking-[0.2em]">Ví tài khoản</div>
                        <div class="text-primary font-black text-2xl tracking-tighter drop-shadow-[0_0_8px_rgba(74,222,128,0.4)]">
                            {{ number_format(auth()->user()->wallet()->value('balance'), 0, ',', '.') }}<span class="text-sm ml-1">đ</span>
                        </div>
                    </div>
                    <a href="{{ route('deposit') }}" class="btn-esport px-4 py-2 rounded-xl text-xs uppercase tracking-widest shadow-lg active:scale-95">
                        Nạp ngay
                    </a>
                </div>
            </div>
            @endauth

            @foreach($navItems as $item)
            <a class="flex items-center gap-3 text-white/90 hover:text-white hover:bg-white/10 font-semibold py-3 px-4 rounded-lg transition-all" href="{{ route($item['route']) }}">
                <span class="material-icons text-xl">{{ $item['icon'] }}</span>
                <span class="tracking-wide">{{ str_replace('TRANG CHỦ', 'Trang chủ', str_replace('SẢN PHẨM', 'Sản phẩm', str_replace('NẠP TIỀN', 'Nạp tiền', str_replace('LƯỚT SÓNG', 'Lướt sóng', str_replace('TIN TỨC', 'Tin tức', str_replace('CHÍNH SÁCH', 'Chính sách', $item['label'])))))) }}</span>
                <span class="material-icons ml-auto text-white/40">chevron_right</span>
            </a>
            @endforeach

            @auth
            <a class="flex items-center gap-3 text-white/90 hover:text-white hover:bg-white/10 font-semibold py-3 px-4 rounded-lg transition-all" href="{{ route('user.profile') }}">
                <span class="material-icons text-xl">account_circle</span>
                <span class="tracking-wide">Tài khoản</span>
                <span class="material-icons ml-auto text-white/40">chevron_right</span>
            </a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 text-red-200 hover:text-red-100 hover:bg-white/10 font-semibold py-3 px-4 rounded-lg transition-all">
                    <span class="material-icons text-xl">logout</span>
                    <span class="tracking-wide">Đăng xuất</span>
                    <span class="material-icons ml-auto text-white/40">chevron_right</span>
                </button>
            </form>
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