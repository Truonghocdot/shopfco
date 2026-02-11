@extends('layouts.app')

@section('title', $product->title . ' - VanhFCO')
@section('description', $product->description)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Breadcrumb -->
    <nav class="flex mb-6 text-sm font-bold text-gray-400 overflow-x-auto whitespace-nowrap pb-2">
        <a class="hover:text-primary flex items-center transition-colors" href="{{ route('home') }}">
            <span class="material-icons text-sm mr-1">home</span> Trang chủ
        </a>
        <span class="mx-2 text-gray-300">/</span>
        <a class="hover:text-primary transition-colors" href="#">{{ $product->category->title }}</a>
        <span class="mx-2 text-gray-300">/</span>
        <span class="text-primary font-black">ID #{{ $product->id }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Product Images -->
        <div class="lg:col-span-7 space-y-6">
            <div class="bg-white rounded-2xl overflow-hidden shadow-md border border-gray-200">
                <div class="relative group" id="product-carousel">
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
                    <button onclick="moveSlide(-1)" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-primary p-2 rounded-full opacity-0 group-hover:opacity-100 transition-all shadow-md z-20">
                        <span class="material-icons">chevron_left</span>
                    </button>
                    <button onclick="moveSlide(1)" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-primary p-2 rounded-full opacity-0 group-hover:opacity-100 transition-all shadow-md z-20">
                        <span class="material-icons">chevron_right</span>
                    </button>
                    <div class="absolute bottom-4 right-4 bg-black/60 text-white text-xs font-bold px-3 py-1 rounded-full z-20">
                        <span id="current-slide">1</span> / {{ count($product->images) }}
                    </div>
                    @endif
                </div>

                @if(!empty($product->images) && count($product->images) > 1)
                <div class="px-4 pb-4 pt-3 bg-gray-50 border-t border-gray-100">
                    <div class="flex gap-3 overflow-x-auto pb-1 no-scrollbar scroll-smooth" id="carousel-thumbnails">
                        @foreach($product->images as $index => $image)
                        <button onclick="scrollToSlide({{ $index }})"
                            class="relative shrink-0 w-20 h-14 rounded-lg overflow-hidden border-2 transition-all thumbnail-btn {{ $index === 0 ? 'border-primary ring-2 ring-primary/30' : 'border-gray-200 opacity-60 hover:opacity-100 hover:border-primary/50' }}"
                            data-index="{{ $index }}">
                            <img src="{{ url('storage/'.$image) }}" alt="Thumbnail {{ $index + 1 }}" class="w-full h-full object-cover">
                        </button>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Product Info Card -->
            <div class="bg-white rounded-2xl p-6 shadow-md border border-gray-200">
                <h1 class="text-xl md:text-2xl font-black mb-4 text-gray-800">{{ $product->title }}</h1>
                <div class="flex flex-wrap items-center justify-between gap-6 py-6 border-y border-gray-100">
                    <div class="space-y-1">
                        @if($product->sell_price && $product->sell_price > $product->getFinalPrice())
                        <span class="text-gray-400 line-through text-lg">{{ number_format($product->sell_price) }}đ</span>
                        @endif
                        <div class="flex items-baseline gap-2">
                            <span class="text-3xl md:text-4xl font-black text-primary">{{ number_format($product->getFinalPrice()) }}đ</span>
                            @if($product->getDiscountPercent())
                            <span class="bg-red-600 text-white text-sm font-black px-2 py-1 rounded">GIẢM {{ $product->getDiscountPercent() }}%</span>
                            @endif
                        </div>
                    </div>
                    <div class="flex flex-col items-end">
                        @if($product->sell_price && $product->sell_price > $product->getFinalPrice())
                        <span class="text-sm text-orange-500 font-bold flex items-center gap-1 mb-2">
                            <span class="material-icons text-sm">savings</span> Tiết kiệm {{ number_format($product->sell_price - $product->getFinalPrice()) }}đ
                        </span>
                        @endif
                        @auth
                        <a href="{{ route('checkout', $product->slug) }}" class="w-full sm:w-auto btn-tet py-4 px-12 rounded-xl flex items-center justify-center gap-3 uppercase tracking-wide text-lg">
                            <span class="material-icons">shopping_cart</span> MUA NGAY
                        </a>
                        @else
                        <a href="{{ route('login') }}" class="w-full sm:w-auto btn-tet py-4 px-12 rounded-xl flex items-center justify-center gap-3 uppercase tracking-wide text-lg">
                            <span class="material-icons">login</span> ĐĂNG NHẬP ĐỂ MUA
                        </a>
                        @endauth
                    </div>
                </div>
                <div class="mt-6 flex items-center justify-between text-gray-400 text-sm">
                    <div class="flex items-center gap-4">
                        <span class="flex items-center gap-1"><span class="material-icons text-sm text-primary">visibility</span> {{ rand(100, 5000) }} lượt xem</span>
                        <span class="flex items-center gap-1"><span class="material-icons text-sm text-primary">schedule</span> Đăng {{ $product->created_at->diffForHumans() }}</span>
                    </div>
                    <span class="font-black text-primary">Mã ID: #{{ $product->id }}</span>
                </div>
            </div>
        </div>

        <!-- Product Details -->
        <div class="lg:col-span-5 space-y-6">
            <div class="bg-white rounded-2xl p-8 shadow-md border border-gray-200 h-full">
                <div class="flex items-center gap-2 mb-6">
                    <span class="material-icons text-primary">info</span>
                    <h2 class="text-xl font-black text-primary uppercase tracking-wide">Giới thiệu tài khoản</h2>
                </div>
                <div class="prose prose-slate max-w-none space-y-4">
                    <div class=" border border-gray-200 p-4 rounded-xl border-l-4 border-l-primary">
                        <div class="font-medium text-gray-700">
                            {!! $product->content !!}
                        </div>
                        <div class="mt-4">
                            <a href="https://zalo.me/g/wilgna867" class="text-primary font-bold hover:underline">Ae tham gia group Zalo lúc nào cx có mã giảm giá cho ae: https://zalo.me/g/wilgna867</a>
                        </div>
                    </div>
                    <div class="space-y-4 pt-4">
                        <h3 class="text-lg font-black flex items-center gap-2 text-primary uppercase tracking-wide">
                            <span class="material-icons">verified_user</span>
                            Cam kết & Điều khoản
                        </h3>
                        <ol class="list-decimal list-inside space-y-3 text-gray-600">
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