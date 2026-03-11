@extends('layouts.app')

@section('title', $product->title . ' - VanhFCO')
@section('description', $product->description)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Breadcrumb -->
    <nav class="flex mb-8 text-[10px] font-black text-slate-500 overflow-x-auto whitespace-nowrap pb-2 uppercase tracking-[0.2em]">
        <a class="hover:text-primary flex items-center transition-colors" href="{{ route('home') }}">
            <span class="material-icons text-sm mr-2 text-primary">home</span> Trang chủ
        </a>
        <span class="mx-3 text-white/10">/</span>
        <a class="hover:text-primary transition-colors font-black text-slate-400" href="#">{{ $product->category->title }}</a>
        <span class="mx-3 text-white/10">/</span>
        <span class="text-primary font-black drop-shadow-[0_0_8px_rgba(56,189,248,0.3)]">ID #{{ $product->id }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Product Images -->
        <div class="lg:col-span-7 space-y-6">
            <div class="glass rounded-2xl overflow-hidden shadow-2xl border border-white/10 relative">
                <div class="relative group z-10" id="product-carousel">
                    <div id="carousel-slides" class="flex overflow-x-auto snap-x snap-mandatory scroll-smooth p-0 no-scrollbar" style="scrollbar-width: none; -ms-overflow-style: none;">
                        @if(!empty($product->images))
                        @foreach($product->images as $index => $image)
                        <div class="w-full shrink-0 snap-center relative aspect-video" id="slide-{{ $index }}">
                            <img src="{{ url('storage/'.$image) }}" alt="{{ $product->title }} - Image {{ $index + 1 }}" class="w-full h-full object-cover">
                        </div>
                        @endforeach
                        @else
                        <div class="w-full shrink-0 snap-center relative aspect-video">
                            <img src="https://via.placeholder.com/800x450?text=No+Image" alt="No Image" class="w-full h-full object-cover">
                        </div>
                        @endif
                    </div>

                    @if(!empty($product->images) && count($product->images) > 1)
                    <button onclick="moveSlide(-1)" class="absolute left-4 top-1/2 -translate-y-1/2 bg-slate-900/80 hover:bg-primary text-white p-3 rounded-full opacity-0 group-hover:opacity-100 transition-all shadow-lg z-20 backdrop-blur-md border border-white/10">
                        <span class="material-icons">chevron_left</span>
                    </button>
                    <button onclick="moveSlide(1)" class="absolute right-4 top-1/2 -translate-y-1/2 bg-slate-900/80 hover:bg-primary text-white p-3 rounded-full opacity-0 group-hover:opacity-100 transition-all shadow-lg z-20 backdrop-blur-md border border-white/10">
                        <span class="material-icons">chevron_right</span>
                    </button>
                    <div class="absolute bottom-4 right-4 bg-slate-900/80 backdrop-blur-md text-white text-[10px] font-black px-4 py-1.5 rounded-full z-20 border border-white/10 uppercase tracking-widest">
                        <span id="current-slide" class="text-primary">1</span> / {{ count($product->images) }}
                    </div>
                    @endif
                </div>

                @if(!empty($product->images) && count($product->images) > 1)
                <div class="px-4 pb-4 pt-3 bg-slate-900/40 backdrop-blur-md border-t border-white/5">
                    <div class="flex gap-3 overflow-x-auto pb-2 no-scrollbar scroll-smooth" id="carousel-thumbnails">
                        @foreach($product->images as $index => $image)
                        <button type="button" onclick="scrollToSlide({{ $index }})"
                            class="relative shrink-0 w-20 h-14 rounded-xl overflow-hidden border-2 transition-all thumbnail-btn {{ $index === 0 ? 'border-primary shadow-[0_0_15px_rgba(56,189,248,0.4)]' : 'border-white/5 opacity-40 hover:opacity-100 hover:border-white/20' }}"
                            data-index="{{ $index }}">
                            <img src="{{ url('storage/'.$image) }}" alt="Thumbnail {{ $index + 1 }}" class="w-full h-full object-cover">
                        </button>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Product Info Card -->
            <div class="glass rounded-2xl p-8 shadow-2xl border border-white/10 relative overflow-hidden">
                <h1 class="text-xl md:text-3xl font-black mb-6 text-white uppercase tracking-tight relative z-20 leading-tight">{{ $product->title }}</h1>
                <div class="flex flex-wrap items-center justify-between gap-8 py-8 border-y border-white/5 relative z-20">
                    <div class="space-y-2">
                        @if($product->sell_price && $product->sell_price > $product->getFinalPrice())
                        <span class="text-slate-500 line-through text-lg font-bold">{{ number_format($product->sell_price) }}đ</span>
                        @endif
                        <div class="flex items-baseline gap-3">
                            <span class="text-3xl md:text-5xl font-black text-primary drop-shadow-[0_0_15px_rgba(56,189,248,0.4)]">{{ number_format($product->getFinalPrice()) }} <span class="text-lg">đ</span></span>
                            @if($product->getDiscountPercent())
                            <span class="bg-pink-500 text-white text-[10px] md:text-xs font-black px-3 py-1 rounded-full shadow-[0_0_10px_rgba(244,114,182,0.4)] uppercase tracking-widest">SIÊU GIẢM GIÁ</span>
                            @endif
                        </div>
                    </div>
                    <div class="flex flex-col items-end w-full sm:w-auto">
                        @if($product->sell_price && $product->sell_price > $product->getFinalPrice())
                        <span class="text-xs text-indigo-400 font-black flex items-center gap-1 mb-4 uppercase tracking-widest">
                            <span class="material-icons text-sm">savings</span> TIẾT KIỆM {{ number_format($product->sell_price - $product->getFinalPrice()) }}đ
                        </span>
                        @endif
                        @auth
                        <a href="{{ route('checkout', $product->slug) }}" class="w-full sm:w-auto btn-esport py-5 px-12 rounded-2xl flex items-center justify-center gap-4 uppercase tracking-widest text-base font-black border-none shadow-2xl shadow-primary/30 active:scale-95 transition-all">
                            <span class="material-icons">shopping_cart</span> MUA NGAY
                        </a>
                        @else
                        <a href="{{ route('login') }}" class="w-full sm:w-auto btn-esport py-5 px-12 rounded-2xl flex items-center justify-center gap-4 uppercase tracking-widest text-base font-black border-none">
                            <span class="material-icons">login</span> ĐĂNG NHẬP ĐỂ MUA
                        </a>
                        @endauth
                    </div>
                </div>
                <div class="mt-8 flex flex-col md:flex-row items-center justify-between text-white text-[10px] font-black uppercase tracking-widest gap-4">
                    <div class="flex items-center gap-6">
                        <span class="flex items-center gap-2 transition-colors hover:text-primary"><span class="material-icons text-sm text-white">visibility</span> {{ rand(100, 5000) }} lượt xem</span>
                        <span class="flex items-center gap-2 transition-colors hover:text-primary"><span class="material-icons text-sm text-white">schedule</span> Đăng {{ $product->created_at->diffForHumans() }}</span>
                    </div>
                    <span class="text-primary bg-primary/10 px-4 py-1.5 rounded-full border border-primary/20">MÃ SẢN PHẨM: #{{ $product->id }}</span>
                </div>
            </div>
        </div>

        <!-- Product Details -->
        <div class="lg:col-span-5 space-y-6">
            <div class="glass rounded-2xl p-8 shadow-2xl border border-white/10 h-full relative overflow-hidden">
                <div class="flex items-center gap-3 mb-8">
                    <span class="material-icons text-primary drop-shadow-[0_0_8px_rgba(56,189,248,0.5)]">info</span>
                    <h2 class="text-xl font-black text-white uppercase tracking-tight">THÔNG TIN CHI TIẾT</h2>
                </div>
                <div class="prose prose-invert prose-primary max-w-none space-y-6">
                    <div class="bg-slate-900/50 backdrop-blur-md border border-white/5 p-6 rounded-2xl border-l-4 border-l-primary shadow-xl">
                        <div class="font-bold text-slate-300 leading-relaxed">
                            {!! $product->content !!}
                        </div>
                        <div class="mt-6 pt-4 border-t border-white/5">
                            <a href="https://zalo.me/g/wilgna867" class="text-primary font-black hover:text-white transition-colors text-xs flex items-center gap-2">
                                <span class="material-icons text-sm">group</span> THAM GIA GROUP ZALO NHẬN MÃ GIẢM GIÁ
                            </a>
                        </div>
                    </div>
                    <div class="space-y-6 pt-6">
                        <h3 class="text-lg font-black flex items-center gap-3 text-white uppercase tracking-tight">
                            <span class="material-icons text-primary">verified_user</span>
                            CAM KẾT & ĐIỀU KHOẢN
                        </h3>
                        <ol class="space-y-4 text-slate-400 text-sm font-bold">
                            <li class="flex gap-3 leading-relaxed">
                                <span class="text-primary font-black">01.</span> SĐT tới hạn đổi SĐT Quý khách vui lòng liên hệ shop để lấy code thay đổi SĐT.
                            </li>
                            <li class="flex gap-3 leading-relaxed">
                                <span class="text-primary font-black">02.</span> Tài khoản sạch, không tranh chấp, bảo hành trọn đời.
                            </li>
                            <li class="flex gap-3 leading-relaxed">
                                <span class="text-primary font-black">03.</span> Hỗ trợ giao dịch trung gian hoặc trực tiếp tại cửa hàng.
                            </li>
                            <li class="flex gap-3 leading-relaxed">
                                <span class="text-primary font-black">04.</span> Số CCCD, bảo hành trọn đời ACC.
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slider = document.getElementById('carousel-slides');
        const thumbnails = document.querySelectorAll('#carousel-thumbnails button');
        const currentSlideEl = document.getElementById('current-slide');

        if (!slider || !thumbnails.length) return;

        let isDragging = false;
        let startX, scrollLeft;

        slider.addEventListener('scroll', () => {
            const scrollPosition = slider.scrollLeft;
            const slideWidth = slider.offsetWidth;
            const index = Math.round(scrollPosition / slideWidth);
            updateActiveThumbnail(index);
            if (currentSlideEl) currentSlideEl.textContent = index + 1;
        });

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
            slider.scrollLeft = scrollLeft - (x - startX) * 2;
        });

        window.moveSlide = function(step) {
            slider.scrollBy({
                left: step * slider.offsetWidth,
                behavior: 'smooth'
            });
        }

        window.scrollToSlide = function(index) {
            const slide = document.getElementById('slide-' + index);
            if (slide) slide.scrollIntoView({
                behavior: 'smooth',
                block: 'nearest',
                inline: 'start'
            });
        }

        function updateActiveThumbnail(index) {
            thumbnails.forEach((thumb, i) => {
                if (i === index) {
                    thumb.classList.add('border-primary', 'ring-2', 'ring-primary/30');
                    thumb.classList.remove('border-gray-200', 'opacity-60');
                } else {
                    thumb.classList.remove('border-primary', 'ring-2', 'ring-primary/30');
                    thumb.classList.add('border-gray-200', 'opacity-60');
                }
            });
        }
    });
</script>