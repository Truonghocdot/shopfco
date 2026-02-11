<header class="sticky top-0 z-50 shadow-md" style="background: linear-gradient(135deg, #C41E1E 0%, #D42020 50%, #E85D2A 100%);">
    <div class="container mx-auto px-4 py-3 flex items-center justify-between">
        <div class="flex items-center gap-8">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                <div class="bg-white/20 backdrop-blur-sm px-4 py-2 rounded-lg border border-white/30 group-hover:bg-white/30 transition-all">
                    <span class="font-black text-xl italic text-white tracking-wide">VanhFCO</span>
                </div>
                <span class="hidden md:block font-bold text-lg text-yellow-300">.COM</span>
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden lg:flex items-center gap-1">
                <a class="nav-link font-semibold flex items-center gap-2 text-white/90 hover:text-white hover:bg-white/15 transition-all px-4 py-2 rounded-lg" href="{{ route('home') }}">
                    <span class="material-icons text-base">home</span>
                    <span class="text-sm tracking-wide">TRANG CHỦ</span>
                </a>
                <a class="nav-link font-semibold flex items-center gap-2 text-white/90 hover:text-white hover:bg-white/15 transition-all px-4 py-2 rounded-lg" href="{{ route('products.index') }}">
                    <span class="material-icons text-base">shopping_bag</span>
                    <span class="text-sm tracking-wide">SẢN PHẨM</span>
                </a>
                <a class="nav-link font-semibold flex items-center gap-2 text-white/90 hover:text-white hover:bg-white/15 transition-all px-4 py-2 rounded-lg" href="{{ route('deposit') }}">
                    <span class="material-icons text-base">account_balance_wallet</span>
                    <span class="text-sm tracking-wide">NẠP TIỀN</span>
                </a>
                <a class="nav-link font-semibold flex items-center gap-2 text-white/90 hover:text-white hover:bg-white/15 transition-all px-4 py-2 rounded-lg" href="{{ route('lucky-wheel.index') }}">
                    <span class="material-icons text-base">casino</span>
                    <span class="text-sm tracking-wide">VÒNG QUAY</span>
                </a>
                <a class="nav-link font-semibold flex items-center gap-2 text-white/90 hover:text-white hover:bg-white/15 transition-all px-4 py-2 rounded-lg" href="{{ route('news.index') }}">
                    <span class="material-icons text-base">newspaper</span>
                    <span class="text-sm tracking-wide">TIN TỨC</span>
                </a>
                <a class="nav-link font-semibold flex items-center gap-2 text-white/90 hover:text-white hover:bg-white/15 transition-all px-4 py-2 rounded-lg" href="{{ route('policy') }}">
                    <span class="material-icons text-base">policy</span>
                    <span class="text-sm tracking-wide">CHÍNH SÁCH</span>
                </a>
            </nav>
        </div>

        <div class="flex items-center gap-3">
            @auth
            <!-- Balance Display -->
            <div class="hidden md:flex flex-col items-end px-4 py-2 rounded-lg bg-white/15 border border-white/20">
                <span class="text-[10px] text-white/70 uppercase tracking-widest font-bold">Số dư</span>
                <span class="text-yellow-300 font-black text-lg">
                    {{ number_format(auth()->user()->wallet()->value('balance'), 0, ',', '.') }} <span class="text-sm">đ</span>
                </span>
            </div>

            <!-- User Profile -->
            <a href="{{ route('user.profile') }}" class="hidden md:flex items-center gap-2 bg-white/15 hover:bg-white/25 px-4 py-2 rounded-lg border border-white/20 cursor-pointer transition-all">
                <span class="material-icons text-white text-2xl">account_circle</span>
                <div class="flex flex-col">
                    <span class="text-white text-[12px] font-medium">{{ auth()->user()->name }}</span>
                    <span class="text-[10px] text-white/70">ID: {{ auth()->user()->id }}</span>
                </div>
            </a>
            @else
            <!-- Login Button -->
            <a href="{{ route('login') }}" class="hidden md:flex items-center gap-2 bg-white text-primary hover:bg-yellow-50 px-5 py-2 rounded-lg font-bold transition-all shadow-sm">
                <span class="material-icons">login</span>
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
            <!-- Mobile Balance -->
            <div class="flex items-center justify-between p-4 mb-3 rounded-lg bg-white/10 border border-white/15">
                <div class="flex items-center gap-3">
                    <span class="material-icons text-white text-3xl">account_circle</span>
                    <div>
                        <div class="font-bold text-white">{{ auth()->user()->username }}</div>
                        <div class="text-xs text-white/70">ID: {{ auth()->user()->id }}</div>
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-[10px] text-white/70 uppercase">Số dư</div>
                    <div class="text-yellow-300 font-black text-lg">
                        {{ number_format(auth()->user()->wallet()->value('balance'), 0, ',', '.') }}đ
                    </div>
                </div>
            </div>
            @endauth

            <a class="flex items-center gap-3 text-white/90 hover:text-white hover:bg-white/10 font-semibold py-3 px-4 rounded-lg transition-all" href="{{ route('home') }}">
                <span class="material-icons text-xl">home</span>
                <span class="tracking-wide">Trang chủ</span>
                <span class="material-icons ml-auto text-white/40">chevron_right</span>
            </a>
            <a class="flex items-center gap-3 text-white/90 hover:text-white hover:bg-white/10 font-semibold py-3 px-4 rounded-lg transition-all" href="{{ route('products.index') }}">
                <span class="material-icons text-xl">shopping_bag</span>
                <span class="tracking-wide">Sản phẩm</span>
                <span class="material-icons ml-auto text-white/40">chevron_right</span>
            </a>
            <a class="flex items-center gap-3 text-white/90 hover:text-white hover:bg-white/10 font-semibold py-3 px-4 rounded-lg transition-all" href="{{ route('deposit') }}">
                <span class="material-icons text-xl">account_balance_wallet</span>
                <span class="tracking-wide">Nạp tiền</span>
                <span class="material-icons ml-auto text-white/40">chevron_right</span>
            </a>
            <a class="flex items-center gap-3 text-white/90 hover:text-white hover:bg-white/10 font-semibold py-3 px-4 rounded-lg transition-all" href="{{ route('lucky-wheel.index') }}">
                <span class="material-icons text-xl">casino</span>
                <span class="tracking-wide">Vòng quay</span>
                <span class="material-icons ml-auto text-white/40">chevron_right</span>
            </a>
            <a class="flex items-center gap-3 text-white/90 hover:text-white hover:bg-white/10 font-semibold py-3 px-4 rounded-lg transition-all" href="{{ route('news.index') }}">
                <span class="material-icons text-xl">newspaper</span>
                <span class="tracking-wide">Tin tức</span>
                <span class="material-icons ml-auto text-white/40">chevron_right</span>
            </a>
            <a class="flex items-center gap-3 text-white/90 hover:text-white hover:bg-white/10 font-semibold py-3 px-4 rounded-lg transition-all" href="{{ route('policy') }}">
                <span class="material-icons text-xl">policy</span>
                <span class="tracking-wide">Chính sách</span>
                <span class="material-icons ml-auto text-white/40">chevron_right</span>
            </a>
            <a class="flex items-center gap-3 text-white/90 hover:text-white hover:bg-white/10 font-semibold py-3 px-4 rounded-lg transition-all" href="{{ route('user.profile') }}">
                <span class="material-icons text-xl">account_circle</span>
                <span class="tracking-wide">Tài khoản</span>
                <span class="material-icons ml-auto text-white/40">chevron_right</span>
            </a>
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
        color: white;
    }
</style>