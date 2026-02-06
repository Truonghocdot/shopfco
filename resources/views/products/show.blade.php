@extends('layouts.app')

@section('title', 'Chi tiết tài khoản - VanhFCO')
@section('description', 'Xem chi tiết tài khoản FC Online với đầy đủ thông tin và hình ảnh.')

@push('styles')
<style>
    body {
        background: linear-gradient(135deg, #000000 0%, #001a0f 50%, #000000 100%);
        background-attachment: fixed;
    }
</style>
@endpush

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Breadcrumb - Techno Style -->
    <nav class="flex mb-6 text-sm font-bold text-slate-500 overflow-x-auto whitespace-nowrap pb-2">
        <a class="hover:text-primary flex items-center transition-colors" href="{{ route('home') }}">
            <span class="material-icons text-sm mr-1">home</span> Trang chủ
        </a>
        <span class="mx-2 text-primary">/</span>
        <a class="hover:text-primary transition-colors" href="#">{{ $product->category->title }}</a>
        <span class="mx-2 text-primary">/</span>
        <span class="text-primary drop-shadow-[0_0_8px_rgba(0,255,0,0.8)] font-black">ID #{{ $product->id }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Product Images - Techno Style -->
        <div class="lg:col-span-7 space-y-6">
            <div class="relative bg-gradient-to-br from-black via-[#001a0f] to-black border-2 border-primary/30 rounded-2xl overflow-hidden shadow-[0_0_40px_rgba(0,255,0,0.3)]">
                <!-- Grid Pattern -->
                <div class="absolute inset-0 opacity-10 pointer-events-none z-[1]">
                    <div class="absolute inset-0" style="background-image: repeating-linear-gradient(90deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 30px), repeating-linear-gradient(0deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 30px);"></div>
                </div>

                <div class="relative group" id="product-carousel">
                    <!-- Main Slides -->
                    <div id="carousel-slides" class="flex overflow-x-auto snap-x snap-mandatory scroll-smooth p-0 no-scrollbar relative z-10" style="scrollbar-width: none; -ms-overflow-style: none;">
                        @if(!empty($product->images))
                        @foreach($product->images as $index => $image)
                        <div class="w-full shrink-0 snap-center relative aspect-video" id="slide-{{ $index }}">
                            <img src="{{ url('storage/'.$image) }}" alt="{{ $product->title }} - Image {{ $index + 1 }}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent transition-all pointer-events-none"></div>
                        </div>
                        @endforeach
                        @else
                        <div class="w-full shrink-0 snap-center relative aspect-video">
                            <img src="https://via.placeholder.com/800x450?text=No+Image" alt="No Image" class="w-full h-full object-cover">
                        </div>
                        @endif
                    </div>

                    <!-- Navigation Arrows - Techno Style -->
                    @if(!empty($product->images) && count($product->images) > 1)
                    <button onclick="moveSlide(-1)" class="absolute left-4 top-1/2 -translate-y-1/2 bg-black/70 hover:bg-primary/20 border-2 border-primary/50 hover:border-primary text-primary p-3 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 z-20 backdrop-blur-sm shadow-[0_0_20px_rgba(0,255,0,0.3)]">
                        <span class="material-icons">chevron_left</span>
                    </button>
                    <button onclick="moveSlide(1)" class="absolute right-4 top-1/2 -translate-y-1/2 bg-black/70 hover:bg-primary/20 border-2 border-primary/50 hover:border-primary text-primary p-3 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 z-20 backdrop-blur-sm shadow-[0_0_20px_rgba(0,255,0,0.3)]">
                        <span class="material-icons">chevron_right</span>
                    </button>

                    <!-- Image Counter - Techno Style -->
                    <div class="absolute bottom-4 right-4 bg-black/70 border border-primary/50 text-primary text-xs font-black px-3 py-1 rounded-full backdrop-blur-md z-20 shadow-[0_0_15px_rgba(0,255,0,0.4)]">
                        <span id="current-slide">1</span> / {{ count($product->images) }}
                    </div>
                    @endif
                </div>

                <!-- Thumbnails - Techno Style -->
                @if(!empty($product->images) && count($product->images) > 1)
                <div class="px-6 pb-6 pt-4 bg-black/40 border-t-2 border-primary/20">
                    <div class="flex gap-3 overflow-x-auto pb-2 no-scrollbar scroll-smooth" id="carousel-thumbnails">
                        @foreach($product->images as $index => $image)
                        <button onclick="scrollToSlide({{ $index }})"
                            class="relative shrink-0 w-24 h-16 rounded-lg overflow-hidden border-2 transition-all duration-300 thumbnail-btn {{ $index === 0 ? 'border-primary ring-2 ring-primary/50 shadow-[0_0_15px_rgba(0,255,0,0.5)]' : 'border-slate-700 opacity-60 hover:opacity-100 hover:border-primary/50' }}"
                            data-index="{{ $index }}">
                            <img src="{{ url('storage/'.$image) }}" alt="Thumbnail {{ $index + 1 }}" class="w-full h-full object-cover">
                        </button>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Product Info Card - Techno Style -->
            <div class="relative bg-gradient-to-br from-black via-[#001a0f] to-black border-2 border-primary/30 rounded-2xl p-6 shadow-[0_0_30px_rgba(0,255,0,0.2)] overflow-hidden">
                <!-- Grid Pattern -->
                <div class="absolute inset-0 opacity-10 pointer-events-none">
                    <div class="absolute inset-0" style="background-image: repeating-linear-gradient(90deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px), repeating-linear-gradient(0deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px);"></div>
                </div>

                <h1 class="text-xl md:text-2xl font-black mb-4 text-white relative z-10">{{ $product->title }}</h1>
                <div class="flex flex-wrap items-center justify-between gap-6 py-6 border-y-2 border-primary/20 relative z-10">
                    <div class="space-y-1">
                        @if($product->sell_price && $product->sell_price > $product->getFinalPrice())
                        <span class="text-slate-600 line-through text-lg">{{ number_format($product->sell_price) }}đ</span>
                        @endif
                        <div class="flex items-baseline gap-2">
                            <span class="text-3xl md:text-4xl font-black text-primary drop-shadow-[0_0_20px_rgba(0,255,0,1)]">{{ number_format($product->getFinalPrice()) }}đ</span>
                            @if($product->getDiscountPercent())
                            <span class="border border-red-500/50 text-red-600 text-2xl font-black px-2 py-1 rounded shadow-[0_0_10px_rgba(239,68,68,0.4)]">GIẢM {{ $product->getDiscountPercent() }}%</span>
                            @endif
                        </div>
                    </div>
                    <div class="flex flex-col items-end">
                        @if($product->sell_price && $product->sell_price > $product->getFinalPrice())
                        <span class="text-sm text-primary font-bold flex items-center gap-1 mb-2 drop-shadow-[0_0_8px_rgba(0,255,0,0.6)]">
                            <span class="material-icons text-sm">savings</span> Tiết kiệm {{ number_format($product->sell_price - $product->getFinalPrice()) }}đ
                        </span>
                        @endif
                        @auth
                        <a href="{{ route('checkout', $product->slug) }}" class="w-full sm:w-auto bg-gradient-to-r from-red-600 to-red-500 hover:from-red-500 hover:to-red-600 text-white font-black py-4 px-12 rounded-xl flex items-center justify-center gap-3 transition-all transform hover:scale-[1.02] shadow-[0_0_25px_rgba(239,68,68,0.5)] hover:shadow-[0_0_35px_rgba(239,68,68,0.7)] border-2 border-red-400 uppercase tracking-wide">
                            <span class="material-icons">shopping_cart</span>
                            MUA NGAY
                        </a>
                        @else
                        <a href="{{ route('login') }}" class="w-full sm:w-auto bg-gradient-to-r from-red-600 to-red-500 hover:from-red-500 hover:to-red-600 text-white font-black py-4 px-12 rounded-xl flex items-center justify-center gap-3 transition-all transform hover:scale-[1.02] shadow-[0_0_25px_rgba(239,68,68,0.5)] hover:shadow-[0_0_35px_rgba(239,68,68,0.7)] border-2 border-red-400 uppercase tracking-wide">
                            <span class="material-icons">login</span>
                            ĐĂNG NHẬP ĐỂ MUA
                        </a>
                        @endauth
                    </div>
                </div>
                <div class="mt-6 flex items-center justify-between text-slate-500 text-sm relative z-10">
                    <div class="flex items-center gap-4">
                        <span class="flex items-center gap-1 text-slate-400"><span class="material-icons text-sm text-primary">visibility</span> {{ rand(100, 5000) }} lượt xem</span>
                        <span class="flex items-center gap-1 text-slate-400"><span class="material-icons text-sm text-primary">schedule</span> Đăng {{ $product->created_at->diffForHumans() }}</span>
                    </div>
                    <span class="font-black text-primary drop-shadow-[0_0_10px_rgba(0,255,0,0.8)]">Mã ID: #{{ $product->id }}</span>
                </div>
            </div>
        </div>

        <!-- Product Details - Techno Style -->
        <div class="lg:col-span-5 space-y-6">
            <div class="relative bg-gradient-to-br from-black via-[#001a0f] to-black border-2 border-primary/30 rounded-2xl p-8 shadow-[0_0_30px_rgba(0,255,0,0.2)] h-full overflow-hidden">
                <!-- Grid Pattern -->
                <div class="absolute inset-0 opacity-10 pointer-events-none">
                    <div class="absolute inset-0" style="background-image: repeating-linear-gradient(90deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px), repeating-linear-gradient(0deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px);"></div>
                </div>

                <div class="flex items-center gap-2 mb-6 relative z-10">
                    <span class="material-icons text-primary">info</span>
                    <h2 class="text-xl font-black text-primary drop-shadow-[0_0_10px_rgba(0,255,0,0.8)] uppercase tracking-wide">Giới thiệu tài khoản</h2>
                </div>
                <div class="prose prose-slate max-w-none space-y-4 relative z-10">
                    <div class="bg-black/40 border-2 border-primary/20 p-4 rounded-xl border-l-4 border-l-primary shadow-[0_0_15px_rgba(0,255,0,0.2)]">
                        <div class="font-medium text-white">
                            {!! $product->content !!}
                        </div>
                        <div class="mt-4">
                            <a href="https://zalo.me/g/wilgna867" class="text-primary font-bold hover:underline">Ae tham gia group Zalo lúc nào cx có mã giảm giá cho ae: https://zalo.me/g/wilgna867</a>
                        </div>
                    </div>
                    <div class="space-y-4 pt-4">
                        <h3 class="text-lg font-black flex items-center gap-2 text-primary drop-shadow-[0_0_10px_rgba(0,255,0,0.8)] uppercase tracking-wide">
                            <span class="material-icons">verified_user</span>
                            Cam kết & Điều khoản
                        </h3>
                        <ol class="list-decimal list-inside space-y-3 text-slate-300">
                            <li class="leading-relaxed">SĐT tới hạn đổi SĐT Quý khách vui lòng liên hệ shop để lấy code thay đổi SĐT.</li>
                            <li class="leading-relaxed">Tài khoản sạch, không tranh chấp, bảo hành trọn đời.</li>
                            <li class="leading-relaxed">Hỗ trợ giao dịch trung gian hoặc trực tiếp tại cửa hàng.</li>
                            <li class="leading-relaxed">Số CCCD, bảo hành trọn đời ACC.</li>
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
            const walk = (x - startX) * 2;
            slider.scrollLeft = scrollLeft - walk;
        });

        window.moveSlide = function(step) {
            const slideWidth = slider.offsetWidth;
            slider.scrollBy({
                left: step * slideWidth,
                behavior: 'smooth'
            });
        }

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
                    thumb.classList.add('border-primary', 'ring-2', 'ring-primary/50', 'shadow-[0_0_15px_rgba(0,255,0,0.5)]');
                    thumb.classList.remove('border-slate-700', 'opacity-60', 'hover:opacity-100', 'hover:border-primary/50');

                    thumb.scrollIntoView({
                        behavior: 'smooth',
                        block: 'nearest',
                        inline: 'center'
                    });
                } else {
                    thumb.classList.remove('border-primary', 'ring-2', 'ring-primary/50', 'shadow-[0_0_15px_rgba(0,255,0,0.5)]');
                    thumb.classList.add('border-slate-700', 'opacity-60', 'hover:opacity-100', 'hover:border-primary/50');
                }
            });
        }
    });
</script>
@endpush