@extends('layouts.app')

@section('title', 'Chi tiết tài khoản - VanhFCO')
@section('description', 'Xem chi tiết tài khoản FC Online với đầy đủ thông tin và hình ảnh.')

@push('styles')
<style>
    body {
        background-image: linear-gradient(rgba(15, 23, 42, 0.9), rgba(15, 23, 42, 0.9)), url(https://lh3.googleusercontent.com/aida-public/AB6AXuDW1WcO7Y7wZWIBl4e-HaZLN46wpoguwJeKUoWVcs_tb-UETIX1KPQMvG_vDfLSy6mraVeWzxr4IopIWsiwa3cT1B44T-buDp09zVUL2F0oT53CnMz1rEMRNR0EDfMH2SuLvSRWcPPsYh12z0YpWXIqOnycyTAhshhwcMGwqz5ybu2xnZ_ACUImmr7pmEBin5pajCBp8HFJ0xXxWkp7L90Qvx9_wnNa70tUwFnVjZb8vlHRs33VBwhn9DiKCSFDTo2g9uEJwhCCEmZF);
        background-size: cover;
        background-attachment: fixed;
        background-position: center;
    }
</style>
@endpush



@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Breadcrumb -->
    <nav class="flex mb-6 text-sm font-medium text-slate-500 dark:text-slate-400 overflow-x-auto whitespace-nowrap pb-2">
        <a class="hover:text-primary-red flex items-center" href="{{ route('home') }}">
            <span class="material-icons text-sm mr-1">home</span> Trang chủ
        </a>
        <span class="mx-2">/</span>
        <a class="hover:text-primary-red" href="#">{{ $product->category->title }}</a>
        <span class="mx-2">/</span>
        <span class="text-slate-900 dark:text-white font-semibold">ID #{{ $product->id }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Product Images -->
        <div class="lg:col-span-7 space-y-6">
            <div class="bg-white dark:bg-card-dark rounded-2xl overflow-hidden shadow-2xl border border-slate-200 dark:border-slate-800">
                <div class="relative group" id="product-carousel">
                    <!-- Main Slides -->
                    <div id="carousel-slides" class="flex overflow-x-auto snap-x snap-mandatory scroll-smooth p-0 no-scrollbar" style="scrollbar-width: none; -ms-overflow-style: none;">
                        @if(!empty($product->images))
                        @foreach($product->images as $index => $image)
                        <div class="w-full shrink-0 snap-center relative aspect-video" id="slide-{{ $index }}">
                            <img src="{{ url('storage/'.$image) }}" alt="{{ $product->title }} - Image {{ $index + 1 }}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black/10 transition-all pointer-events-none"></div>
                        </div>
                        @endforeach
                        @else
                        <div class="w-full shrink-0 snap-center relative aspect-video">
                            <img src="https://via.placeholder.com/800x450?text=No+Image" alt="No Image" class="w-full h-full object-cover">
                        </div>
                        @endif
                    </div>

                    <!-- Navigation Arrows -->
                    @if(!empty($product->images) && count($product->images) > 1)
                    <button onclick="moveSlide(-1)" class="absolute left-4 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/80 text-white p-3 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 z-10 backdrop-blur-sm">
                        <span class="material-icons">chevron_left</span>
                    </button>
                    <button onclick="moveSlide(1)" class="absolute right-4 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/80 text-white p-3 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 z-10 backdrop-blur-sm">
                        <span class="material-icons">chevron_right</span>
                    </button>

                    <!-- Image Counter -->
                    <div class="absolute bottom-4 right-4 bg-black/60 text-white text-xs px-3 py-1 rounded-full backdrop-blur-md z-10">
                        <span id="current-slide">1</span> / {{ count($product->images) }}
                    </div>
                    @endif
                </div>

                <!-- Thumbnails -->
                @if(!empty($product->images) && count($product->images) > 1)
                <div class="px-6 pb-6 pt-4 bg-slate-50 dark:bg-slate-900/50 border-t border-slate-200 dark:border-slate-800">
                    <div class="flex gap-3 overflow-x-auto pb-2 no-scrollbar scroll-smooth" id="carousel-thumbnails">
                        @foreach($product->images as $index => $image)
                        <button onclick="scrollToSlide({{ $index }})"
                            class="relative shrink-0 w-24 h-16 rounded-lg overflow-hidden border-2 transition-all duration-300 thumbnail-btn {{ $index === 0 ? 'border-primary-red ring-2 ring-primary-red/30' : 'border-slate-300 opacity-60 hover:opacity-100' }}"
                            data-index="{{ $index }}">
                            <img src="{{ url('storage/'.$image) }}" alt="Thumbnail {{ $index + 1 }}" class="w-full h-full object-cover">
                        </button>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Product Info -->
            <div class="bg-white dark:bg-card-dark rounded-2xl p-6 shadow-xl border border-slate-200 dark:border-slate-800">
                <h1 class="text-xl md:text-2xl font-bold mb-4">{{ $product->title }}</h1>
                <div class="flex flex-wrap items-center justify-between gap-6 py-6 border-y border-slate-100 dark:border-slate-800">
                    <div class="space-y-1">
                        @if($product->sell_price && $product->sell_price > $product->getFinalPrice())
                        <span class="text-slate-500 line-through text-lg">{{ number_format($product->sell_price) }}đ</span>
                        @endif
                        <div class="flex items-baseline gap-2">
                            <span class="text-3xl md:text-4xl font-extrabold text-primary-red">{{ number_format($product->getFinalPrice()) }}đ</span>
                            @if($product->getDiscountPercent())
                            <span class="bg-primary-red/10 text-primary-red text-xs font-bold px-2 py-1 rounded">GIẢM {{ $product->getDiscountPercent() }}%</span>
                            @endif
                        </div>
                    </div>
                    <div class="flex flex-col items-end">
                        @if($product->sell_price && $product->sell_price > $product->getFinalPrice())
                        <span class="text-sm text-accent-success font-medium flex items-center gap-1 mb-2">
                            <span class="material-icons text-sm">savings</span> Tiết kiệm {{ number_format($product->sell_price - $product->getFinalPrice()) }}đ
                        </span>
                        @endif
                        @auth
                        <a href="{{ route('checkout', $product->slug) }}" class="w-full sm:w-auto bg-primary-red hover:bg-red-600 text-white font-bold py-4 px-12 rounded-xl flex items-center justify-center gap-3 transition-all transform hover:scale-[1.02] shadow-lg shadow-primary-red/20">
                            <span class="material-icons">shopping_cart</span>
                            MUA NGAY
                        </a>
                        @else
                        <a href="{{ route('login') }}" class="w-full sm:w-auto bg-primary-red hover:bg-red-600 text-white font-bold py-4 px-12 rounded-xl flex items-center justify-center gap-3 transition-all transform hover:scale-[1.02] shadow-lg shadow-primary-red/20">
                            <span class="material-icons">login</span>
                            ĐĂNG NHẬP ĐỂ MUA
                        </a>
                        @endauth
                    </div>
                </div>
                <div class="mt-6 flex items-center justify-between text-slate-500 dark:text-slate-400 text-sm">
                    <div class="flex items-center gap-4">
                        <span class="flex items-center gap-1"><span class="material-icons text-sm">visibility</span> {{ rand(100, 5000) }} lượt xem</span>
                        <span class="flex items-center gap-1"><span class="material-icons text-sm">schedule</span> Đăng {{ $product->created_at->diffForHumans() }}</span>
                    </div>
                    <span class="font-bold text-slate-900 dark:text-white">Mã ID: #{{ $product->id }}</span>
                </div>
            </div>
        </div>

        <!-- Product Details -->
        <div class="lg:col-span-5 space-y-6">
            <div class="bg-white dark:bg-card-dark rounded-2xl p-8 shadow-xl border border-slate-200 dark:border-slate-800 h-full">
                <div class="flex items-center gap-2 mb-6">
                    <span class="material-icons text-primary-red">info</span>
                    <h2 class="text-xl font-bold">Giới thiệu tài khoản</h2>
                </div>
                <div class="prose prose-slate dark:prose-invert max-w-none space-y-4">
                    <div class="bg-slate-50 dark:bg-slate-900/40 p-4 rounded-xl border-l-4 border-primary-red">
                        <div class="font-medium text-slate-900 dark:text-white">
                            {!! $product->content !!}
                        </div>
                    </div>
                    <div class="space-y-4 pt-4">
                        <h3 class="text-lg font-bold flex items-center gap-2">
                            <span class="material-icons text-accent-success">verified_user</span>
                            Cam kết & Điều khoản
                        </h3>
                        <ol class="list-decimal list-inside space-y-3 text-slate-600 dark:text-slate-300">
                            <li class="leading-relaxed">SĐT của shop sau 23/02 đổi được (tới hạn đổi SĐT Quý khách vui lòng liên hệ shop để lấy code thay đổi SĐT).</li>
                            <li class="leading-relaxed">Tài khoản sạch, không tranh chấp, bảo hành trọn đời.</li>
                            <li class="leading-relaxed">Hỗ trợ giao dịch trung gian hoặc trực tiếp tại cửa hàng.</li>
                            <li class="leading-relaxed">Số CCCD của shop, bảo hành trọn đời ACC.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slider = document.getElementById('carousel-slides');
        const thumbnails = document.querySelectorAll('#carousel-thumbnails button');
        const currentSlideEl = document.getElementById('current-slide');

        if (!slider || !thumbnails.length) return;

        let isDragging = false;
        let startX, scrollLeft;

        // Sync thumbnails on scroll
        slider.addEventListener('scroll', () => {
            // Calculate current index based on scroll position
            const scrollPosition = slider.scrollLeft;
            const slideWidth = slider.offsetWidth;
            const index = Math.round(scrollPosition / slideWidth);

            updateActiveThumbnail(index);
            if (currentSlideEl) currentSlideEl.textContent = index + 1;
        });

        // Mouse Drag Scrolling
        slider.addEventListener('mousedown', (e) => {
            isDragging = true;
            slider.style.cursor = 'grabbing';
            startX = e.pageX - slider.offsetLeft;
            scrollLeft = slider.scrollLeft;
        });

        slider.addEventListener('mouseleave', () => {
            isDragging = false;
            slider.style.cursor = 'grab';
        });

        slider.addEventListener('mouseup', () => {
            isDragging = false;
            slider.style.cursor = 'grab';
        });

        slider.addEventListener('mousemove', (e) => {
            if (!isDragging) return;
            e.preventDefault();
            const x = e.pageX - slider.offsetLeft;
            const walk = (x - startX) * 2; // Scroll-fast
            slider.scrollLeft = scrollLeft - walk;
        });

        // Add moveSlide function to global scope for buttons
        window.moveSlide = function(step) {
            const slideWidth = slider.offsetWidth;
            slider.scrollBy({
                left: step * slideWidth,
                behavior: 'smooth'
            });
        }

        // Add scrollToSlide function to global scope which thumbnails use
        window.scrollToSlide = function(index) {
            const slide = document.getElementById('slide-' + index);
            if (slide) {
                slide.scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest',
                    inline: 'start'
                });
            }
        }

        function updateActiveThumbnail(index) {
            thumbnails.forEach((thumb, i) => {
                if (i === index) {
                    thumb.classList.add('border-primary-red', 'ring-2', 'ring-primary-red/30');
                    thumb.classList.remove('border-slate-300', 'opacity-60', 'hover:opacity-100');

                    // Scroll thumbnail into view
                    thumb.scrollIntoView({
                        behavior: 'smooth',
                        block: 'nearest',
                        inline: 'center'
                    });
                } else {
                    thumb.classList.remove('border-primary-red', 'ring-2', 'ring-primary-red/30');
                    thumb.classList.add('border-slate-300', 'opacity-60', 'hover:opacity-100');
                }
            });
        }
    });
</script>
@endpush