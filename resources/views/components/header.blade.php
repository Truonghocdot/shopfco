<header class="sticky top-0 z-50 bg-black shadow-2xl border-b-2 border-primary overflow-hidden" style="background: linear-gradient(180deg, #001a0f 0%, #000000 100%);">
    <div class="container mx-auto px-4 py-3 flex items-center justify-between relative">
        <!-- Animated background effects - FIXED -->
        <div class="absolute inset-0 opacity-20 pointer-events-none overflow-hidden">
            <div class="absolute top-0 left-0 w-[200%] h-full bg-gradient-to-r from-transparent via-primary/10 to-transparent animate-shimmer"></div>
        </div>

        <div class="flex items-center gap-8 relative z-10">
            <!-- Logo with futuristic frame -->
            <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                <div class="relative">
                    <!-- Glow effect -->
                    <div class="absolute inset-0 bg-primary blur-md opacity-50 group-hover:opacity-75 transition-opacity"></div>
                    <!-- Logo box -->
                    <div class="relative bg-gradient-to-br from-primary to-green-400 text-black px-4 py-2 font-black text-xl italic rounded transform -skew-x-12 border-2 border-primary shadow-[0_0_15px_rgba(0,255,0,0.5)] group-hover:shadow-[0_0_25px_rgba(0,255,0,0.8)] transition-all">
                        VanhFCO
                    </div>
                </div>
                <span class="hidden md:block font-bold text-lg text-primary drop-shadow-[0_0_10px_rgba(0,255,0,0.8)]">.COM</span>
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden lg:flex items-center gap-4">
                <a class="nav-link group relative font-semibold flex items-center gap-2 text-white hover:text-primary transition-all px-3 py-2" href="{{ route('home') }}">
                    <div class="absolute inset-0 bg-primary/10 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity border border-primary/30"></div>
                    <span class="material-icons text-base relative z-10 drop-shadow-[0_0_5px_rgba(0,255,0,0.5)]">home</span>
                    <span class="relative z-10 text-sm tracking-wider">TRANG CHỦ</span>
                </a>
                <a class="nav-link group relative font-semibold flex items-center gap-2 text-white hover:text-primary transition-all px-3 py-2" href="{{ route('products.index') }}">
                    <div class="absolute inset-0 bg-primary/10 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity border border-primary/30"></div>
                    <span class="material-icons text-base relative z-10 drop-shadow-[0_0_5px_rgba(0,255,0,0.5)]">shopping_bag</span>
                    <span class="relative z-10 text-sm tracking-wider">SẢN PHẨM</span>
                </a>
                <a class="nav-link group relative font-semibold flex items-center gap-2 text-white hover:text-primary transition-all px-3 py-2" href="{{ route('deposit') }}">
                    <div class="absolute inset-0 bg-primary/10 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity border border-primary/30"></div>
                    <span class="material-icons text-base relative z-10 drop-shadow-[0_0_5px_rgba(0,255,0,0.5)]">account_balance_wallet</span>
                    <span class="relative z-10 text-sm tracking-wider">NẠP TIỀN</span>
                </a>
                <a class="nav-link group relative font-semibold flex items-center gap-2 text-white hover:text-primary transition-all px-3 py-2" href="{{ route('lucky-wheel.index') }}">
                    <div class="absolute inset-0 bg-primary/10 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity border border-primary/30"></div>
                    <span class="material-icons text-base relative z-10 drop-shadow-[0_0_5px_rgba(0,255,0,0.5)]">casino</span>
                    <span class="relative z-10 text-sm tracking-wider">VÒNG QUAY</span>
                </a>
                <a class="nav-link group relative font-semibold flex items-center gap-2 text-white hover:text-primary transition-all px-3 py-2" href="{{ route('news.index') }}">
                    <div class="absolute inset-0 bg-primary/10 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity border border-primary/30"></div>
                    <span class="material-icons text-base relative z-10 drop-shadow-[0_0_5px_rgba(0,255,0,0.5)]">newspaper</span>
                    <span class="relative z-10 text-sm tracking-wider">TIN TỨC</span>
                </a>
                <a class="nav-link group relative font-semibold flex items-center gap-2 text-white hover:text-primary transition-all px-3 py-2" href="{{ route('policy') }}">
                    <div class="absolute inset-0 bg-primary/10 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity border border-primary/30"></div>
                    <span class="material-icons text-base relative z-10 drop-shadow-[0_0_5px_rgba(0,255,0,0.5)]">policy</span>
                    <span class="relative z-10 text-sm tracking-wider">CHÍNH SÁCH</span>
                </a>
            </nav>
        </div>

        <div class="flex items-center gap-3 relative z-10">
            @auth
            <!-- Balance Display -->
            <div class="hidden md:flex flex-col items-end px-4 py-2 rounded-lg border border-primary/40 bg-black/60 backdrop-blur-sm shadow-[0_0_15px_rgba(0,255,0,0.2)]">
                <span class="text-[10px] text-primary/70 uppercase tracking-widest font-bold">Số dư</span>
                <span class="text-primary font-black text-lg drop-shadow-[0_0_8px_rgba(0,255,0,0.8)]">
                    {{ number_format(auth()->user()->wallet()->value('balance'), 0, ',', '.') }} <span class="text-sm">đ</span>
                </span>
            </div>

            <!-- User Profile -->
            <a href="{{ route('user.profile') }}" class="hidden md:flex items-center gap-2 bg-gradient-to-r from-primary/20 to-primary/10 hover:from-primary/30 hover:to-primary/20 px-4 py-2 rounded-lg border border-primary/50 cursor-pointer transition-all shadow-[0_0_10px_rgba(0,255,0,0.3)] hover:shadow-[0_0_20px_rgba(0,255,0,0.5)]">
                <span class="material-icons text-primary text-2xl drop-shadow-[0_0_8px_rgba(0,255,0,0.8)]">account_circle</span>
                <div class="flex flex-col">
                    <span class="text-primary text-[12px]">{{ auth()->user()->name }}</span>
                    <span class="text-[10px] text-primary/70">ID: {{ auth()->user()->id }}</span>
                </div>
            </a>
            @else
            <!-- Login Button -->
            <a href="{{ route('login') }}" class="hidden md:flex items-center gap-2 bg-gradient-to-r from-primary/20 to-primary/10 hover:from-primary/30 hover:to-primary/20 px-4 py-2 rounded-lg border border-primary/50 cursor-pointer transition-all shadow-[0_0_10px_rgba(0,255,0,0.3)] hover:shadow-[0_0_20px_rgba(0,255,0,0.5)]">
                <span class="material-icons text-primary drop-shadow-[0_0_8px_rgba(0,255,0,0.8)]">login</span>
                <span class="font-bold text-white text-sm">Đăng nhập</span>
            </a>
            @endauth

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn" class="lg:hidden text-primary p-2 rounded-lg border border-primary/50 bg-black/60 hover:bg-primary/20 transition-all shadow-[0_0_10px_rgba(0,255,0,0.3)]">
                <span class="material-icons text-2xl drop-shadow-[0_0_8px_rgba(0,255,0,0.8)]">menu</span>
            </button>
        </div>
    </div>

    <!-- Mobile Menu with Futuristic Design -->
    <div id="mobile-menu" class="hidden lg:hidden bg-black/95 backdrop-blur-lg border-t-2 border-primary/50 shadow-[0_5px_20px_rgba(0,255,0,0.3)] relative">
        <!-- Animated scan line effect - FIXED -->
        <div class="absolute inset-0 opacity-10 pointer-events-none overflow-hidden">
            <div class="h-px w-full bg-gradient-to-r from-transparent via-primary to-transparent animate-scan"></div>
        </div>

        <nav class="container mx-auto px-4 py-6 flex flex-col gap-2 relative overflow-hidden">
            @auth
            <!-- Mobile Balance -->
            <div class="flex items-center justify-between p-4 mb-3 rounded-lg bg-gradient-to-r from-primary/10 to-transparent border-l-4 border-primary shadow-[0_0_15px_rgba(0,255,0,0.2)]">
                <div class="flex items-center gap-3">
                    <span class="material-icons text-primary text-3xl drop-shadow-[0_0_8px_rgba(0,255,0,0.8)]">account_circle</span>
                    <div>
                        <div class="font-bold text-white">{{ auth()->user()->username }}</div>
                        <div class="text-xs text-primary/70">ID: {{ auth()->user()->id }}</div>
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-[10px] text-primary/70 uppercase">Số dư</div>
                    <div class="text-primary font-black text-lg drop-shadow-[0_0_8px_rgba(0,255,0,0.8)]">
                        {{ number_format(auth()->user()->wallet()->value('balance'), 0, ',', '.') }}đ
                    </div>
                </div>
            </div>
            @endauth

            <!-- Mobile Nav Links -->
            <a class="group flex items-center gap-3 text-white hover:text-primary font-semibold py-3 px-4 rounded-lg border-l-4 border-transparent hover:border-primary hover:bg-primary/10 transition-all relative overflow-hidden" href="{{ route('home') }}">
                <div class="absolute inset-0 bg-gradient-to-r from-primary/0 via-primary/5 to-primary/0 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <span class="material-icons text-xl drop-shadow-[0_0_5px_rgba(0,255,0,0.5)] relative z-10">home</span>
                <span class="relative z-10 tracking-wide">Trang chủ</span>
                <span class="material-icons ml-auto text-primary/50 group-hover:text-primary relative z-10">chevron_right</span>
            </a>

            <a class="group flex items-center gap-3 text-white hover:text-primary font-semibold py-3 px-4 rounded-lg border-l-4 border-transparent hover:border-primary hover:bg-primary/10 transition-all relative overflow-hidden" href="{{ route('products.index') }}">
                <div class="absolute inset-0 bg-gradient-to-r from-primary/0 via-primary/5 to-primary/0 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <span class="material-icons text-xl drop-shadow-[0_0_5px_rgba(0,255,0,0.5)] relative z-10">shopping_bag</span>
                <span class="relative z-10 tracking-wide">Sản phẩm</span>
                <span class="material-icons ml-auto text-primary/50 group-hover:text-primary relative z-10">chevron_right</span>
            </a>

            <a class="group flex items-center gap-3 text-white hover:text-primary font-semibold py-3 px-4 rounded-lg border-l-4 border-transparent hover:border-primary hover:bg-primary/10 transition-all relative overflow-hidden" href="{{ route('deposit') }}">
                <div class="absolute inset-0 bg-gradient-to-r from-primary/0 via-primary/5 to-primary/0 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <span class="material-icons text-xl drop-shadow-[0_0_5px_rgba(0,255,0,0.5)] relative z-10">account_balance_wallet</span>
                <span class="relative z-10 tracking-wide">Nạp tiền</span>
                <span class="material-icons ml-auto text-primary/50 group-hover:text-primary relative z-10">chevron_right</span>
            </a>

            <a class="group flex items-center gap-3 text-white hover:text-primary font-semibold py-3 px-4 rounded-lg border-l-4 border-transparent hover:border-primary hover:bg-primary/10 transition-all relative overflow-hidden" href="{{ route('lucky-wheel.index') }}">
                <div class="absolute inset-0 bg-gradient-to-r from-primary/0 via-primary/5 to-primary/0 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <span class="material-icons text-xl drop-shadow-[0_0_5px_rgba(0,255,0,0.5)] relative z-10">casino</span>
                <span class="relative z-10 tracking-wide">Vòng quay</span>
                <span class="material-icons ml-auto text-primary/50 group-hover:text-primary relative z-10">chevron_right</span>
            </a>

            <a class="group flex items-center gap-3 text-white hover:text-primary font-semibold py-3 px-4 rounded-lg border-l-4 border-transparent hover:border-primary hover:bg-primary/10 transition-all relative overflow-hidden" href="{{ route('news.index') }}">
                <div class="absolute inset-0 bg-gradient-to-r from-primary/0 via-primary/5 to-primary/0 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <span class="material-icons text-xl drop-shadow-[0_0_5px_rgba(0,255,0,0.5)] relative z-10">newspaper</span>
                <span class="relative z-10 tracking-wide">Tin tức</span>
                <span class="material-icons ml-auto text-primary/50 group-hover:text-primary relative z-10">chevron_right</span>
            </a>

            <a class="group flex items-center gap-3 text-white hover:text-primary font-semibold py-3 px-4 rounded-lg border-l-4 border-transparent hover:border-primary hover:bg-primary/10 transition-all relative overflow-hidden" href="{{ route('policy') }}">
                <div class="absolute inset-0 bg-gradient-to-r from-primary/0 via-primary/5 to-primary/0 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <span class="material-icons text-xl drop-shadow-[0_0_5px_rgba(0,255,0,0.5)] relative z-10">policy</span>
                <span class="relative z-10 tracking-wide">Chính sách</span>
                <span class="material-icons ml-auto text-primary/50 group-hover:text-primary relative z-10">chevron_right</span>
            </a>

            <a class="group flex items-center gap-3 text-white hover:text-primary font-semibold py-3 px-4 rounded-lg border-l-4 border-transparent hover:border-primary hover:bg-primary/10 transition-all relative overflow-hidden" href="{{ route('user.profile') }}">
                <div class="absolute inset-0 bg-gradient-to-r from-primary/0 via-primary/5 to-primary/0 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <span class="material-icons text-xl drop-shadow-[0_0_5px_rgba(0,255,0,0.5)] relative z-10">account_circle</span>
                <span class="relative z-10 tracking-wide">Tài khoản</span>
                <span class="material-icons ml-auto text-primary/50 group-hover:text-primary relative z-10">chevron_right</span>
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

                // Animate menu items when opening
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

            // Close menu when clicking outside
            document.addEventListener('click', function(event) {
                if (!mobileMenuBtn.contains(event.target) && !mobileMenu.contains(event.target)) {
                    mobileMenu.classList.add('hidden');
                }
            });
        }
    });
</script>

<style>
    /* FIXED: Shimmer animation now stays within bounds */
    @keyframes shimmer {
        0% {
            transform: translateX(-100%);
        }

        100% {
            transform: translateX(0%);
        }
    }

    /* FIXED: Scan animation contained within menu height */
    @keyframes scan {
        0% {
            transform: translateY(-100%);
            opacity: 0;
        }

        50% {
            opacity: 1;
        }

        100% {
            transform: translateY(100vh);
            opacity: 0;
        }
    }

    .animate-shimmer {
        animation: shimmer 4s ease-in-out infinite;
    }

    .animate-scan {
        animation: scan 4s linear infinite;
    }

    /* Prevent horizontal overflow on body */
    body {
        overflow-x: hidden;
    }

    /* Glow pulse effect for logo */
    @keyframes glow-pulse {

        0%,
        100% {
            box-shadow: 0 0 15px rgba(0, 255, 0, 0.5);
        }

        50% {
            box-shadow: 0 0 25px rgba(0, 255, 0, 0.8);
        }
    }

    /* Hexagon pattern background (optional) */
    header::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image:
            repeating-linear-gradient(90deg, rgba(0, 255, 0, 0.03) 0px, transparent 1px, transparent 40px),
            repeating-linear-gradient(0deg, rgba(0, 255, 0, 0.03) 0px, transparent 1px, transparent 40px);
        pointer-events: none;
        z-index: 1;
    }

    /* Custom scrollbar for mobile menu */
    #mobile-menu nav::-webkit-scrollbar {
        width: 4px;
    }

    #mobile-menu nav::-webkit-scrollbar-track {
        background: rgba(0, 0, 0, 0.5);
    }

    #mobile-menu nav::-webkit-scrollbar-thumb {
        background: linear-gradient(to bottom, #00ff00, #00aa00);
        border-radius: 2px;
    }

    /* Active link indicator */
    .nav-link.active {
        color: #00ff00;
    }

    .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 50%;
        transform: translateX(-50%);
        width: 30px;
        height: 2px;
        background: linear-gradient(to right, transparent, #00ff00, transparent);
        box-shadow: 0 0 10px rgba(0, 255, 0, 0.8);
    }
</style>