@extends('layouts.app')

@section('title', 'Trang chủ - VanhFCO.com - mua bán tài khoản FCO4 - Uy tín chất lượng')
@section('description', 'Mua bán tài khoản FC Online uy tín, giá rẻ, giao dịch tự động 24/7.')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
@endpush

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Video Hero Section - Techno Style (Moved to Top) -->
    <section class="mb-8 md:mb-12 relative overflow-hidden rounded-2xl border-2 border-primary/30 shadow-[0_0_30px_rgba(0,255,0,0.2)]">
        <div class="relative rounded-xl overflow-hidden p-2 bg-gradient-to-br from-black via-[#001a0f] to-black">
            <!-- Grid Pattern -->
            <div class="absolute inset-0 opacity-10 pointer-events-none z-[1]">
                <div class="absolute inset-0" style="background-image: repeating-linear-gradient(90deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px), repeating-linear-gradient(0deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px);"></div>
            </div>

            <div class="aspect-video w-full rounded-lg overflow-hidden relative z-10 border border-primary/20">
                <iframe
                    class="w-full h-full"
                    src="https://www.youtube.com/embed/4gdHSvzF4fk?si=qhn8JkqYEld25VsX"
                    title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin"
                    allowfullscreen>
                </iframe>
            </div>

            <!-- Contact Info Badge - Techno Style (Overlay on Video) -->
            <div class="absolute inset-0 flex items-center justify-center z-10 pointer-events-none">
                <div class="relative pointer-events-auto group/badge">
                    <!-- Glow effect -->
                    <div class="absolute inset-0 bg-primary/20 blur-xl opacity-50 group-hover/badge:opacity-75 transition-opacity rounded-full"></div>

                    <!-- Badge container -->
                    <div class="relative bg-black/80 backdrop-blur-md px-6 md:px-8 py-3 md:py-4 rounded-full border-2 border-primary/50 shadow-[0_0_20px_rgba(0,255,0,0.3)] transform group-hover/badge:scale-105 group-hover/badge:shadow-[0_0_30px_rgba(0,255,0,0.5)] transition-all duration-300">
                        <div class="flex flex-wrap justify-center items-center gap-4 md:gap-6">
                            <!-- Phone -->
                            <div class="flex items-center gap-2 text-base md:text-xl font-black text-white tracking-wide">
                                <span class="material-icons text-primary text-2xl md:text-3xl drop-shadow-[0_0_8px_rgba(0,255,0,0.8)]">call</span>
                                <span class="drop-shadow-[0_0_5px_rgba(255,255,255,0.5)]">0986526036</span>
                            </div>

                            <!-- Divider -->
                            <div class="w-px h-6 md:h-8 bg-primary/30 hidden sm:block"></div>

                            <!-- Facebook -->
                            <a href="https://www.facebook.com/le.vietanh.939173" target="_blank" class="flex items-center gap-2 text-base md:text-xl font-black text-white tracking-wide hover:text-primary transition-colors group/link">
                                <span class="material-icons text-blue-500 text-2xl md:text-3xl drop-shadow-[0_0_8px_rgba(59,130,246,0.8)] group-hover/link:drop-shadow-[0_0_12px_rgba(0,255,0,0.8)] transition-all">facebook</span>
                                <span class="drop-shadow-[0_0_5px_rgba(255,255,255,0.5)] group-hover/link:drop-shadow-[0_0_8px_rgba(0,255,0,0.8)] transition-all">LE VIET ANH</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Lucky Wheel Section - Techno Style -->
    <section class="mb-8 md:mb-12 relative overflow-hidden">
        <a href="{{ route('lucky-wheel.index') }}" class="block">
            <div class="relative rounded-2xl p-4 md:p-10 flex flex-col md:flex-row items-center justify-between gap-4 md:gap-8 transition overflow-hidden border-2 border-primary/40 bg-gradient-to-br from-black via-[#001a0f] to-black shadow-[0_0_40px_rgba(0,255,0,0.2)] hover:shadow-[0_0_60px_rgba(0,255,0,0.4)] hover:border-primary/60 group/wheel">

                <!-- Grid Pattern Background -->
                <div class="absolute inset-0 opacity-10 pointer-events-none">
                    <div class="absolute inset-0" style="background-image: repeating-linear-gradient(90deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 30px), repeating-linear-gradient(0deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 30px);"></div>
                </div>

                <!-- Animated Scan Lines -->
                <div class="absolute inset-0 opacity-20 pointer-events-none overflow-hidden">
                    <div class="h-px w-full bg-gradient-to-r from-transparent via-primary to-transparent animate-scan-vertical"></div>
                </div>

                <!-- Shimmer Effect -->
                <div class="absolute inset-0 opacity-10 pointer-events-none overflow-hidden">
                    <div class="absolute top-0 left-0 w-[200%] h-full bg-gradient-to-r from-transparent via-primary/20 to-transparent animate-shimmer"></div>
                </div>

                <div class="flex-1 text-center md:text-left relative z-10">
                    <h2 class="text-xl md:text-4xl font-black mb-2 md:mb-4 flex items-center justify-center md:justify-start gap-2 md:gap-3 text-primary drop-shadow-[0_0_15px_rgba(0,255,0,0.8)] uppercase tracking-wider">
                        <span class="material-icons text-yellow-400 text-2xl md:text-5xl drop-shadow-[0_0_15px_rgba(250,204,21,0.8)] animate-pulse">casino</span>
                        VÒNG QUAY MAY MẮN
                    </h2>
                    <p class="text-slate-300 text-sm md:text-lg mb-4 md:mb-8 max-w-md mx-auto md:mx-0 drop-shadow-[0_0_5px_rgba(255,255,255,0.3)]">
                        Cơ hội nhận ngay hàng trăm nghìn đồng vào tài khoản. Mọi đơn hàng từ <strong class="text-primary drop-shadow-[0_0_8px_rgba(0,255,0,0.8)]">300k</strong> đều được tặng lượt quay miễn phí!
                    </p>
                    <div class="inline-flex items-center gap-2 md:gap-3 bg-gradient-to-r from-primary to-green-400 hover:from-green-400 hover:to-primary text-black font-black py-2 px-6 md:py-3 md:px-8 rounded-full shadow-[0_0_20px_rgba(0,255,0,0.4)] hover:shadow-[0_0_30px_rgba(0,255,0,0.6)] transition-all transform group-hover/wheel:scale-105 uppercase tracking-wide text-[10px] md:text-base border-2 border-primary/50 animate-pulse-glow">
                        THỬ VẬN MAY NGAY <span class="material-icons text-sm md:text-base">arrow_forward</span>
                    </div>
                </div>

                <div class="relative w-full max-w-[180px] md:max-w-[280px] aspect-square flex items-center justify-center z-10">
                    <!-- Glow effect for wheel -->
                    <div class="absolute inset-0 bg-primary/20 blur-2xl opacity-50 group-hover/wheel:opacity-75 transition-opacity rounded-full"></div>

                    <canvas id="homeWheelCanvas" width="300" height="300" class="w-full h-full drop-shadow-[0_0_30px_rgba(0,255,0,0.5)] relative z-10"></canvas>

                    <!-- Static Pointer with glow -->
                    <div class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-2 z-20">
                        <div style="width: 0; height: 0; border-left: 12px solid transparent; border-right: 12px solid transparent; border-bottom: 24px solid #ef4444; filter: drop-shadow(0 0 8px rgba(239, 68, 68, 0.8)); transform: rotate(180deg);"></div>
                    </div>
                </div>
            </div>
        </a>
    </section>


    <!-- Banner & Leaderboard Section - Techno Style (Swapped Position) -->
    <section class="grid grid-cols-1 lg:grid-cols-12 gap-4 md:gap-8 mb-8 md:mb-12">
        <div class="hidden lg:block lg:col-span-7">
            <!-- Banner Carousel (Moved from Top) -->
            <div class="relative overflow-hidden rounded-2xl group border-2 border-primary/30 shadow-[0_0_30px_rgba(0,255,0,0.2)]">
                <!-- Grid Pattern Background -->
                <div class="absolute inset-0 opacity-20 pointer-events-none z-[1]">
                    <div class="absolute inset-0" style="background-image: repeating-linear-gradient(90deg, rgba(0, 255, 0, 0.05) 0px, transparent 1px, transparent 40px), repeating-linear-gradient(0deg, rgba(0, 255, 0, 0.05) 0px, transparent 1px, transparent 40px);"></div>
                </div>

                <!-- Scan Line Animation -->
                <div class="absolute inset-0 opacity-10 pointer-events-none z-[2] overflow-hidden">
                    <div class="h-px w-full bg-gradient-to-r from-transparent via-primary to-transparent animate-scan-vertical"></div>
                </div>

                <div class="swiper-container home-banner-swiper h-[50vh] max-h-[400px] relative">
                    <div class="swiper-wrapper">
                        @forelse($banners as $banner)
                        <div class="swiper-slide">
                            <img src="{{ url('storage/' . $banner->image) }}" alt="Banner" class="w-full h-full object-cover">
                            <!-- Dark overlay for better contrast -->
                            <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-transparent to-black/60"></div>
                        </div>
                        @empty
                        <div class="swiper-slide">
                            <img src="{{ asset('banner.jpg') }}" alt="Banner" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-transparent to-black/60"></div>
                        </div>
                        @endforelse
                    </div>

                    <!-- Techno Pagination -->
                    <div class="swiper-pagination !bottom-4"></div>

                    <!-- Techno Navigation Buttons -->
                    <div class="swiper-button-next !text-primary !w-12 !h-12 after:!text-2xl !bg-black/60 !backdrop-blur-sm !rounded-lg !border !border-primary/50 hover:!bg-primary/20 hover:!shadow-[0_0_20px_rgba(0,255,0,0.5)] !transition-all"></div>
                    <div class="swiper-button-prev !text-primary !w-12 !h-12 after:!text-2xl !bg-black/60 !backdrop-blur-sm !rounded-lg !border !border-primary/50 hover:!bg-primary/20 hover:!shadow-[0_0_20px_rgba(0,255,0,0.5)] !transition-all"></div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-5">
            <x-leaderboard :topSpenders="$topSpenders" />
        </div>
    </section>
    <!-- Categories - Techno Style -->
    <section class="mb-8 md:mb-12">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
            @forelse($categories as $category)
            <a href="{{ route('categories.show', $category->slug) }}" class="group relative rounded-xl p-3 md:p-6 flex flex-col items-center text-center transition cursor-pointer overflow-hidden bg-gradient-to-br from-black via-[#001a0f] to-black border-2 border-primary/30 hover:border-primary shadow-[0_0_20px_rgba(0,255,0,0.15)] hover:shadow-[0_0_40px_rgba(0,255,0,0.4)] transform hover:scale-105">

                <!-- Grid Pattern -->
                <div class="absolute inset-0 opacity-10 pointer-events-none">
                    <div class="absolute inset-0" style="background-image: repeating-linear-gradient(90deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px), repeating-linear-gradient(0deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px);"></div>
                </div>

                <div class="w-full h-32 md:h-48 mb-3 md:mb-4 relative overflow-hidden rounded-lg border-2 border-slate-700 group-hover:border-primary transition-colors">
                    <img alt="{{ $category->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" src="{{ url('storage/'.$category->image) ?? 'https://via.placeholder.com/96' }}" loading="lazy">

                    <!-- Image overlay with grid -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="absolute inset-0 opacity-0 group-hover:opacity-20 transition-opacity" style="background-image: repeating-linear-gradient(90deg, rgba(0, 255, 0, 0.3) 0px, transparent 1px, transparent 15px), repeating-linear-gradient(0deg, rgba(0, 255, 0, 0.3) 0px, transparent 1px, transparent 15px);"></div>
                </div>

                <h3 class="font-black text-sm md:text-lg mb-1 md:mb-2 text-primary drop-shadow-[0_0_10px_rgba(0,255,0,0.6)] uppercase tracking-wide relative z-10">{{ $category->title }}</h3>
                <p class="text-slate-400 text-[10px] md:text-sm relative z-10 line-clamp-1 md:line-clamp-none">{!! strip_tags($category->description) !!}</p>
            </a>
            @empty
            <div class="col-span-4 text-center text-slate-400 p-12 bg-black/50 rounded-xl border border-primary/20">Chưa có danh mục nào</div>
            @endforelse
        </div>
    </section>

    <!-- Flash Sale Section -->
    <div class="flex items-center justify-between mb-8">
        <h2 class="text-2xl font-black text-green-600 uppercase flex items-center gap-2">
            <span class="material-icons text-green-600">local_fire_department</span>
            FLASH SALE SIÊU HOT
        </h2>
        <a href="{{ route('products.index', ['sort' => 'discount']) }}" class="text-primary hover:text-primary/80 font-bold text-sm flex items-center gap-1">
            Xem tất cả <span class="material-icons text-sm">arrow_forward</span>
        </a>
    </div>

    <!-- Product Grid - Techno Style -->
    <section class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-16">
        @forelse($flashSaleProducts as $product)
        <div class="relative bg-gradient-to-br from-black via-[#001a0f] to-black border-2 border-slate-700 hover:border-primary rounded-xl overflow-hidden group transition-all hover:shadow-[0_0_30px_rgba(0,255,0,0.3)] hover:scale-[1.02]">
            <!-- Grid Pattern -->
            <div class="absolute inset-0 opacity-0 group-hover:opacity-10 pointer-events-none transition-opacity">
                <div class="absolute inset-0" style="background-image: repeating-linear-gradient(90deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px), repeating-linear-gradient(0deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px);"></div>
            </div>

            <div class="relative overflow-hidden aspect-video">
                <img alt="{{ $product->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" src="{{ url('storage/'.$product->images[0]) ?? 'https://via.placeholder.com/400x225' }}" loading="lazy">
                @if($product->getDiscountPercent())
                <div class="absolute top-2 right-2 bg-gradient-to-r from-red-600 to-red-500 text-white text-2xl font-black px-3 py-1 rounded-full shadow-[0_0_15px_rgba(239,68,68,0.6)] border border-red-400 animate-pulse-glow">
                    -{{ number_format($product->getDiscountPercent()) }}%
                </div>
                @endif
                <div class="absolute bottom-2 left-2 bg-black/70 backdrop-blur-sm border border-primary/30 px-2 py-0.5 rounded text-[10px] text-primary font-bold shadow-[0_0_10px_rgba(0,255,0,0.3)]">
                    ID: {{ $product->id }}
                </div>
            </div>
            <div class="p-4 relative z-10">
                <h4 class="font-bold text-sm mb-3 line-clamp-2 h-10 text-white group-hover:text-primary transition-colors">{{ $product->title }}</h4>
                <div class="flex flex-col mb-4">
                    @if($product->sell_price)
                    <span class="text-xs text-slate-600 line-through">{{ number_format($product->sell_price) }} đ</span>
                    @endif
                    <span class="text-xl font-black text-primary drop-shadow-[0_0_10px_rgba(0,255,0,0.8)]">{{ number_format($product->getFinalPrice()) }} <span class="text-sm">đ</span></span>
                </div>
                <a href="{{ route('products.show', $product->slug) }}" class="block w-full bg-gradient-to-r from-red-600 to-red-500 hover:from-red-500 hover:to-red-600 text-white font-black py-2 rounded-lg flex items-center justify-center gap-2 transition-all transform active:scale-95 shadow-[0_0_15px_rgba(239,68,68,0.4)] hover:shadow-[0_0_25px_rgba(239,68,68,0.6)] border-2 border-red-400 uppercase tracking-wide">
                    <span class="material-icons text-sm">shopping_cart</span> MUA NGAY
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-4 glass-morphism rounded-xl p-12 text-center">
            <p class="text-slate-400">Chưa có sản phẩm flash sale</p>
        </div>
        @endforelse
    </section>
    <!-- News Section - Techno Style -->
    <div class="flex items-center justify-between mb-8 relative">
        <!-- Glow background -->
        <div class="absolute inset-0 bg-gradient-to-r from-primary/10 via-transparent to-transparent blur-xl opacity-50"></div>

        <h2 class="text-2xl md:text-3xl font-black text-primary uppercase flex items-center gap-3 drop-shadow-[0_0_15px_rgba(0,255,0,0.8)] tracking-wider relative z-10">
            <span class="material-icons text-3xl md:text-4xl drop-shadow-[0_0_20px_rgba(0,255,0,1)]">article</span>
            TIN TỨC MỚI NHẤT
        </h2>
        <a href="{{ route('news.index') }}" class="text-primary hover:text-green-400 font-bold text-sm flex items-center gap-1 drop-shadow-[0_0_8px_rgba(0,255,0,0.6)] hover:drop-shadow-[0_0_12px_rgba(0,255,0,0.9)] transition-all relative z-10">
            Xem tất cả <span class="material-icons text-sm">arrow_forward</span>
        </a>
    </div>

    <section class="grid grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
        @forelse($latestNews as $news)
        <a href="{{ route('news.show', $news->slug) }}" class="group relative rounded-xl overflow-hidden border-2 border-primary/30 hover:border-primary bg-gradient-to-br from-black via-[#001a0f] to-black shadow-[0_0_20px_rgba(0,255,0,0.15)] hover:shadow-[0_0_40px_rgba(0,255,0,0.4)] transition-all transform hover:scale-105">
            <!-- Grid Pattern -->
            <div class="absolute inset-0 opacity-10 pointer-events-none z-[1]">
                <div class="absolute inset-0" style="background-image: repeating-linear-gradient(90deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px), repeating-linear-gradient(0deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px);"></div>
            </div>

            <div class="relative overflow-hidden aspect-video">
                <img alt="{{ $news->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" src="{{ url('storage/'.$news->thumbnail) ?? 'https://via.placeholder.com/400x225' }}" loading="lazy">

                <!-- Image overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-black/40"></div>

                <!-- Grid overlay on hover -->
                <div class="absolute inset-0 opacity-0 group-hover:opacity-20 transition-opacity" style="background-image: repeating-linear-gradient(90deg, rgba(0, 255, 0, 0.3) 0px, transparent 1px, transparent 15px), repeating-linear-gradient(0deg, rgba(0, 255, 0, 0.3) 0px, transparent 1px, transparent 15px);"></div>
            </div>

            <div class="p-4 relative z-10">
                <h4 class="font-bold text-sm mb-2 line-clamp-2 h-10 text-white group-hover:text-primary transition-colors drop-shadow-[0_0_5px_rgba(255,255,255,0.3)]">{{ $news->title }}</h4>
                <p class="text-slate-400 text-xs mb-4 line-clamp-2">{!! Str::limit(strip_tags($news->content), 100) !!}</p>
                <div class="flex items-center justify-between text-xs">
                    <span class="text-slate-500">{{ $news->created_at->format('d/m/Y') }}</span>
                    <span class="text-primary font-bold flex items-center gap-1 group-hover:gap-2 transition-all drop-shadow-[0_0_5px_rgba(0,255,0,0.6)]">
                        Đọc thêm <span class="material-icons text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </span>
                </div>
            </div>
        </a>
        @empty
        <div class="col-span-3 bg-gradient-to-br from-black via-[#001a0f] to-black border-2 border-primary/20 rounded-xl p-12 text-center">
            <p class="text-slate-400">Chưa có tin tức nào</p>
        </div>
        @endforelse
    </section>

</div>
@endsection

@push('schema')
@php
$websiteSchema = [
"@@context" => "https://schema.org",
"@@type" => "WebSite",
"name" => "Shop Acc FC Online 24/7 - Giao dịch trung gian - VanhFCO",
"url" => route('home'),
"potentialAction" => [
"@@type" => "SearchAction",
"target" => route('home') . "?q={search_term_string}",
"query-input" => "required name=search_term_string"
]
];

$orgSchema = [
"@@context" => "https://schema.org",
"@@type" => "Organization",
"name" => "VanhFCO",
"url" => route('home'),
"logo" => asset('images/logo.png'),
"contactPoint" => [
"@@type" => "ContactPoint",
"telephone" => "0986526036",
"contactType" => "customer service"
],
"sameAs" => [
"https://www.facebook.com/le.vietanh.939173"
]
];
@endphp

<script type="application/ld+json">
    @json($websiteSchema)
</script>
<script type="application/ld+json">
    @json($orgSchema)
</script>
@endpush

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var swiper = new Swiper('.home-banner-swiper', {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });

        // Lucky Wheel Home Preview
        (function() {
            const canvas = document.getElementById('homeWheelCanvas');
            if (!canvas) return;
            const ctx = canvas.getContext('2d');
            const size = 300;
            const cx = size / 2;
            const cy = size / 2;
            const radius = 120;
            const segments = [{
                    label: '200k',
                    color: '#ef4444'
                },
                {
                    label: '10k',
                    color: '#22d3ee'
                },
                {
                    label: '20k',
                    color: '#10b981'
                },
                {
                    label: 'Lost',
                    color: '#fb7185'
                },
                {
                    label: '50k',
                    color: '#fbbf24'
                },
                {
                    label: '10k',
                    color: '#22d3ee'
                },
                {
                    label: '100k',
                    color: '#22d3ee'
                },
                {
                    label: 'Lost',
                    color: '#fb7185'
                }
            ];

            let angle = 0;

            function draw() {
                ctx.clearRect(0, 0, size, size);

                ctx.save();
                ctx.translate(cx, cy);
                ctx.rotate(angle);

                const segRad = (Math.PI * 2) / segments.length;
                const offset = -Math.PI / 2;

                segments.forEach((seg, i) => {
                    const a0 = offset + i * segRad;
                    const a1 = a0 + segRad;

                    ctx.beginPath();
                    ctx.moveTo(0, 0);
                    ctx.arc(0, 0, radius, a0, a1);
                    ctx.closePath();
                    ctx.fillStyle = seg.color;
                    ctx.fill();
                    ctx.strokeStyle = '#fff';
                    ctx.lineWidth = 2;
                    ctx.stroke();

                    ctx.save();
                    ctx.rotate(a0 + segRad / 2);
                    ctx.fillStyle = '#fff';
                    ctx.font = 'bold 12px Arial';
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';
                    ctx.fillText(seg.label, radius * 0.65, 0);
                    ctx.restore();
                });

                // Hub
                ctx.beginPath();
                ctx.arc(0, 0, 25, 0, Math.PI * 2);
                ctx.fillStyle = '#fff';
                ctx.fill();
                ctx.strokeStyle = '#e5e7eb';
                ctx.lineWidth = 2;
                ctx.stroke();

                ctx.beginPath();
                ctx.arc(0, 0, 15, 0, Math.PI * 2);
                ctx.fillStyle = '#f3f4f6';
                ctx.fill();

                ctx.restore();

                angle += 0.005; // Constant slow rotation
                requestAnimationFrame(draw);
            }
            draw();
        })();
    });
</script>