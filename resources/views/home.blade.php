@extends('layouts.app')

@section('title', 'Trang chủ - VanhFCO.com - mua bán tài khoản FCO4 - Uy tín chất lượng')
@section('description', 'Mua bán tài khoản FC Online uy tín, giá rẻ, giao dịch tự động 24/7.')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
@endpush

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Video Hero Section -->
    <section class="mb-8 md:mb-12">
        <div class="bg-white rounded-2xl overflow-hidden shadow-md border border-gray-200 p-2">
            <div class="aspect-video w-full rounded-xl overflow-hidden">
                <iframe
                    class="w-full h-full"
                    src="https://www.youtube.com/embed/J5vX4tceqCc?si=zqLarLOd25hZkMvS"
                    title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin"
                    allowfullscreen>
                </iframe>
            </div>

            <!-- Contact Info Badge -->
            <div class="flex flex-wrap justify-center items-center gap-4 md:gap-6 py-4 px-4">
                <div class="flex items-center gap-2 text-base md:text-lg font-bold text-gray-800">
                    <span class="material-icons text-primary text-2xl">call</span>
                    <span>0986526036</span>
                </div>
                <div class="w-px h-6 bg-gray-200 hidden sm:block"></div>
                <a href="https://www.facebook.com/le.vietanh.939173" target="_blank" class="flex items-center gap-2 text-base md:text-lg font-bold text-gray-800 hover:text-primary transition-colors">
                    <span class="material-icons text-blue-500 text-2xl">facebook</span>
                    <span>LE VIET ANH</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Lucky Wheel Section -->
    <section class="mb-8 md:mb-12">
        <a href="{{ route('lucky-wheel.index') }}" class="block">
            <div class="bg-gradient-to-r from-amber-50 to-orange-50 rounded-2xl p-4 md:p-10 flex flex-col md:flex-row items-center justify-between gap-4 md:gap-8 border border-orange-200 shadow-md hover:shadow-lg transition-all group/wheel">
                <div class="flex-1 text-center md:text-left">
                    <h2 class="text-xl md:text-4xl font-black mb-2 md:mb-4 flex items-center justify-center md:justify-start gap-2 md:gap-3 text-primary uppercase tracking-wider">
                        <span class="material-icons text-yellow-500 text-2xl md:text-5xl animate-pulse">casino</span>
                        VÒNG QUAY MAY MẮN
                    </h2>
                    <p class="text-gray-600 text-sm md:text-lg mb-4 md:mb-8 max-w-md mx-auto md:mx-0">
                        Cơ hội nhận ngay hàng trăm nghìn đồng vào tài khoản. Mọi đơn hàng từ <strong class="text-primary">300k</strong> đều được tặng lượt quay miễn phí!
                    </p>
                    <div class="inline-flex items-center gap-2 md:gap-3 btn-tet py-2 px-6 md:py-3 md:px-8 rounded-full group-hover/wheel:scale-105 transition-transform uppercase tracking-wide text-[10px] md:text-base">
                        THỬ VẬN MAY NGAY <span class="material-icons text-sm md:text-base">arrow_forward</span>
                    </div>
                </div>

                <div class="relative w-full max-w-[180px] md:max-w-[280px] aspect-square flex items-center justify-center">
                    <canvas id="homeWheelCanvas" width="300" height="300" class="w-full h-full"></canvas>
                    <!-- Static Pointer -->
                    <div class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-2 z-20">
                        <div style="width: 0; height: 0; border-left: 12px solid transparent; border-right: 12px solid transparent; border-bottom: 24px solid #ef4444; transform: rotate(180deg);"></div>
                    </div>
                </div>
            </div>
        </a>
    </section>

    <!-- Banner & Leaderboard Section -->
    <section class="grid grid-cols-1 lg:grid-cols-12 gap-4 md:gap-8 mb-8 md:mb-12">
        <div class="hidden lg:block lg:col-span-7">
            <!-- Banner Carousel -->
            <div class="relative overflow-hidden rounded-2xl shadow-md border border-gray-200">
                <div class="swiper-container home-banner-swiper h-[50vh] max-h-[400px]">
                    <div class="swiper-wrapper">
                        @forelse($banners as $banner)
                        <div class="swiper-slide">
                            <img src="{{ url('storage/' . $banner->image) }}" alt="Banner" class="w-full h-full object-cover">
                        </div>
                        @empty
                        <div class="swiper-slide">
                            <img src="{{ asset('banner.jpg') }}" alt="Banner" class="w-full h-full object-cover">
                        </div>
                        @endforelse
                    </div>
                    <div class="swiper-pagination !bottom-4"></div>
                    <div class="swiper-button-next !text-white !w-10 !h-10 after:!text-xl !bg-primary/80 !rounded-full !transition-all hover:!bg-primary"></div>
                    <div class="swiper-button-prev !text-white !w-10 !h-10 after:!text-xl !bg-primary/80 !rounded-full !transition-all hover:!bg-primary"></div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-5">
            <x-leaderboard :topSpenders="$topSpenders" />
        </div>
    </section>

    <!-- Categories -->
    <section class="mb-8 md:mb-12">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
            @forelse($categories as $category)
            <a href="{{ route('categories.show', $category->slug) }}" class="group bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-lg p-3 md:p-4 flex flex-col items-center text-center transition-all hover:scale-[1.03]">
                <div class="w-full h-32 md:h-48 mb-3 md:mb-4 overflow-hidden rounded-lg">
                    <img alt="{{ $category->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" src="{{ url('storage/'.$category->image) ?? 'https://via.placeholder.com/96' }}" loading="lazy">
                </div>
                <h3 class="font-black text-sm md:text-lg mb-1 text-gray-800 group-hover:text-primary transition-colors uppercase tracking-wide">{{ $category->title }}</h3>
                <p class="text-gray-400 text-[10px] md:text-sm line-clamp-1 md:line-clamp-none">{!! strip_tags($category->description) !!}</p>
            </a>
            @empty
            <div class="col-span-4 text-center text-gray-400 p-12 bg-white rounded-xl border border-gray-200">Chưa có danh mục nào</div>
            @endforelse
        </div>
    </section>

    <!-- Flash Sale Section -->
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-black text-white uppercase flex items-center gap-2">
            <span class="material-icons text-white">local_fire_department</span>
            FLASH SALE SIÊU HOT
        </h2>
        <a href="{{ route('products.index', ['sort' => 'discount']) }}" class="text-white hover:text-orange-500 font-bold text-sm flex items-center gap-1 transition-colors">
            Xem tất cả <span class="material-icons text-sm">arrow_forward</span>
        </a>
    </div>

    <!-- Product Grid -->
    <section class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-16">
        @forelse($flashSaleProducts as $product)
        <div class="bg-white rounded-xl overflow-hidden border border-gray-200 shadow-sm hover:shadow-lg group transition-all hover:scale-[1.02]">
            <div class="relative overflow-hidden aspect-video">
                <img alt="{{ $product->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" src="{{ url('storage/'.$product->images[0]) ?? 'https://via.placeholder.com/400x225' }}" loading="lazy">
                @if($product->getDiscountPercent())
                <div class="absolute top-2 right-2 bg-red-500 text-white text-xs md:text-sm font-black px-2 py-1 rounded-full">
                    -{{ number_format($product->getDiscountPercent()) }}%
                </div>
                @endif
                <div class="absolute bottom-2 left-2 bg-white/90 px-2 py-0.5 rounded text-[10px] text-gray-600 font-bold">
                    ID: {{ $product->id }}
                </div>
            </div>
            <div class="p-4">
                <h4 class="font-bold text-sm mb-3 line-clamp-2 h-10 text-gray-800 group-hover:text-primary transition-colors">{{ $product->title }}</h4>
                <div class="flex flex-col mb-4">
                    @if($product->sell_price)
                    <span class="text-xs text-gray-400 line-through">{{ number_format($product->sell_price) }} đ</span>
                    @endif
                    <span class="text-xl font-black text-primary">{{ number_format($product->getFinalPrice()) }} <span class="text-sm">đ</span></span>
                </div>
                <a href="{{ route('products.show', $product->slug) }}" class="block w-full btn-tet py-2 rounded-lg text-center text-sm uppercase tracking-wide">
                    <span class="material-icons text-sm align-middle mr-1">shopping_cart</span> MUA NGAY
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-4 bg-white rounded-xl p-12 text-center border border-gray-200">
            <p class="text-gray-400">Chưa có sản phẩm flash sale</p>
        </div>
        @endforelse
    </section>

    <!-- News Section -->
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl md:text-3xl font-black text-white uppercase flex items-center gap-3 tracking-wider">
            <span class="material-icons text-3xl md:text-4xl">article</span>
            TIN TỨC MỚI NHẤT
        </h2>
        <a href="{{ route('news.index') }}" class="text-white hover:text-orange-500 font-bold text-sm flex items-center gap-1 transition-colors">
            Xem tất cả <span class="material-icons text-sm">arrow_forward</span>
        </a>
    </div>

    <section class="grid grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
        @forelse($latestNews as $news)
        <a href="{{ route('news.show', $news->slug) }}" class="group bg-white rounded-xl overflow-hidden border border-gray-200 shadow-sm hover:shadow-lg transition-all hover:scale-[1.02]">
            <div class="relative overflow-hidden aspect-video">
                <img alt="{{ $news->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" src="{{ url('storage/'.$news->thumbnail) ?? 'https://via.placeholder.com/400x225' }}" loading="lazy">
            </div>
            <div class="p-4">
                <h4 class="font-bold text-sm mb-2 line-clamp-2 h-10 text-gray-800 group-hover:text-primary transition-colors">{{ $news->title }}</h4>
                <p class="text-gray-400 text-xs mb-4 line-clamp-2">{!! Str::limit(strip_tags($news->content), 100) !!}</p>
                <div class="flex items-center justify-between text-xs">
                    <span class="text-gray-400">{{ $news->created_at->format('d/m/Y') }}</span>
                    <span class="text-primary font-bold flex items-center gap-1 group-hover:gap-2 transition-all">
                        Đọc thêm <span class="material-icons text-sm">arrow_forward</span>
                    </span>
                </div>
            </div>
        </a>
        @empty
        <div class="col-span-3 bg-white rounded-xl border border-gray-200 p-12 text-center">
            <p class="text-gray-400">Chưa có tin tức nào</p>
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
                disableOnInteraction: false
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            },
        });

        // Lucky Wheel Home Preview
        (function() {
            const canvas = document.getElementById('homeWheelCanvas');
            if (!canvas) return;
            const ctx = canvas.getContext('2d');
            const size = 300,
                cx = size / 2,
                cy = size / 2,
                radius = 120;
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
                angle += 0.005;
                requestAnimationFrame(draw);
            }
            draw();
        })();
    });
</script>