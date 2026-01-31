<header class="sticky top-0 z-50 bg-primary-dark shadow-medium" style="background-color: #00a152;">
    <div class="container mx-auto px-4 py-3 flex items-center justify-between">
        <div class="flex items-center gap-8">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <div class="bg-primary text-black px-3 py-1 font-black text-xl italic rounded transform -skew-x-12">VanhFCO</div>
                <span class="hidden md:block font-bold text-lg text-white">.COM</span>
            </a>

            <!-- Navigation -->
            <nav class="hidden lg:flex items-center gap-6">
                <a class="nav-link font-medium flex items-center gap-1 text-white hover:text-primary transition-colors" href="{{ route('home') }}">
                    <span class="material-icons text-sm">home</span> TRANG CHỦ
                </a>
                <a class="nav-link font-medium flex items-center gap-1 text-white hover:text-primary transition-colors" href="{{ route('products.index') }}">
                    <span class="material-icons text-sm">shopping_bag</span> SẢN PHẨM
                </a>
                <a class="nav-link font-medium flex items-center gap-1 text-white hover:text-primary transition-colors" href="{{ route('deposit') }}">
                    <span class="material-icons text-sm">account_balance_wallet</span> NẠP TIỀN
                </a>
                <a class="nav-link font-medium flex items-center gap-1 text-white hover:text-primary transition-colors" href="{{ route('news.index') }}">
                    <span class="material-icons text-sm">newspaper</span> TIN TỨC
                </a>
            </nav>
        </div>

        <div class="flex items-center gap-4">

            @auth
            <div class="hidden sm:flex flex-col items-end">
                <span class="text-xs text-white/70 uppercase">Số dư</span>
                <span class="text-primary font-bold">{{ number_format(auth()->user()->wallet()->value('balance'), 0, ',', '.') }} <span class="underline">đ</span></span>
            </div>
            <a href="{{ route('user.profile') }}" class="flex items-center gap-2 bg-white/10 hover:bg-white/20 px-3 py-2 rounded-lg cursor-pointer transition">
                <span class="material-icons text-primary">account_circle</span>
                <span class="font-medium text-white">{{ auth()->user()->username }} id: {{ auth()->user()->id }}</span>
            </a>
            @else
            <a href="{{ route('login') }}" class="flex items-center gap-2 bg-white/10 hover:bg-white/20 px-3 py-2 rounded-lg cursor-pointer transition">
                <span class="material-icons text-primary">login</span>
                <span class="font-medium text-white">Đăng nhập</span>
            </a>
            @endauth

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn" class="lg:hidden text-white">
                <span class="material-icons">menu</span>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden lg:hidden bg-white border-t border-gray-200">
        <nav class="container mx-auto px-4 py-4 flex flex-col gap-3">
            <a class="flex items-center gap-2 text-gray-700 hover:text-primary font-medium py-2 border-b border-gray-100" href="{{ route('home') }}">
                <span class="material-icons text-sm">home</span> Trang chủ
            </a>
            <a class="flex items-center gap-2 text-gray-700 hover:text-primary font-medium py-2 border-b border-gray-100" href="{{ route('products.index') }}">
                <span class="material-icons text-sm">shopping_bag</span> Sản phẩm
            </a>
            <a class="flex items-center gap-2 text-gray-700 hover:text-primary font-medium py-2 border-b border-gray-100" href="{{ route('deposit') }}">
                <span class="material-icons text-sm">account_balance_wallet</span> Nạp tiền
            </a>
            <a class="flex items-center gap-2 text-gray-700 hover:text-primary font-medium py-2 border-b border-gray-100" href="{{ route('news.index') }}">
                <span class="material-icons text-sm">newspaper</span> Tin tức
            </a>
            <a class="flex items-center gap-2 text-gray-700 hover:text-primary font-medium py-2" href="{{ route('user.profile') }}">
                <span class="material-icons text-sm">account_circle</span> Tài khoản
            </a>
        </nav>
    </div>
</header>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        }
    });
</script>
@endpush