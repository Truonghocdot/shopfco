@extends('layouts.app')

@section('title', 'Trang chủ - VanhFCO.com - mua bán tài khoản FCO4 - Uy tín chất lượng')
@section('description', 'Mua bán tài khoản FC Online uy tín, giá rẻ, giao dịch tự động 24/7.')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
@endpush

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Video Hero Section -->
    <section class="mb-8 md:mb-12 relative">
        <div class="glass rounded-2xl overflow-hidden shadow-2xl border border-white/10 p-2 relative z-10">
            <div class="aspect-video w-full rounded-xl overflow-hidden">
                <iframe
                    class="w-full h-full"
                    src="https://www.youtube.com/embed/gQkpw5JtnuQ?si=M54VBBoQfaZhYSf3"
                    title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin"
                    allowfullscreen>
                </iframe>
            </div>

            <!-- Contact Info Badge -->
            <div class="flex flex-wrap justify-center items-center gap-4 md:gap-6 py-4 px-4 text-white/90">
                <div class="flex items-center gap-2 text-base md:text-lg font-bold">
                    <span class="material-icons text-primary text-2xl">call</span>
                    <span class="text-white">0986526036</span>
                </div>
                <div class="w-px h-6 bg-white/20 hidden sm:block"></div>
                <a href="https://www.facebook.com/le.vietanh.939173" target="_blank" class="flex items-center gap-2 text-base md:text-lg font-bold hover:text-white transition-all hover:scale-105">
                    <span class="material-icons text-white text-2xl">facebook</span>
                    <span class="text-white">LE VIET ANH</span>
                </a>
            </div>
        </div>

        <!-- Decorative background glow -->
        <div class="absolute -top-20 -left-20 w-64 h-64 bg-primary/10 blur-[100px] rounded-full pointer-events-none"></div>
        <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-indigo-500/10 blur-[100px] rounded-full pointer-events-none"></div>
    </section>

    <!-- Mystery Box Section -->
    <section class="mb-8 md:mb-12">
        <a href="{{ route('lucky-wheel.index') }}" class="block">
        <div class="card-esport p-3 md:p-10 flex flex-col md:flex-row items-center justify-between gap-4 md:gap-8 border border-white/30 shadow-2xl transition-all group/tree relative overflow-hidden">
                <div class="flex-1 text-center md:text-left relative z-10">
                    <h2 class="text-xl md:text-4xl font-black mb-2 md:mb-4 flex items-center justify-center md:justify-start gap-2 md:gap-3 text-neon uppercase tracking-wider drop-shadow-lg">
                        <span class="material-icons text-2xl md:text-4xl text-white">surfing</span> LƯỚT SÓNG <span class="text-white italic">ĐÓN QUÀ</span>
                    </h2>
                    <p class="text-white/90 text-sm md:text-lg mb-4 md:mb-8 max-w-md mx-auto md:mx-0">
                        Trải nghiệm cảm giác rẽ sóng săn quà cực khủng! Nhận ngay Acc FCO siêu phẩm, BP trắng cực hời chỉ từ một lượt lướt!
                    </p>
                    <div class="inline-flex items-center gap-2 md:gap-3 btn-esport py-2 px-6 md:py-3 md:px-8 rounded-full group-hover/tree:scale-105 transition-transform">
                        <span class="material-icons text-sm md:text-base">surfing</span> LƯỚT SÓNG NGAY <span class="material-icons text-sm md:text-base">arrow_forward</span>
                    </div>
                </div>

                <div class="relative w-full max-w-[140px] md:max-w-[280px] flex items-center justify-center">
                    <img src="{{ asset('images/coconut.png') }}" alt="Mystery Box" class="w-full group-hover/tree:scale-110 transition-transform duration-500 drop-shadow-lg" style="filter: drop-shadow(0 0 20px rgba(74,222,128,0.3));">
                </div>
            </div>
        </a>
    </section>

    <!-- Banner & Leaderboard Section -->
    <section class="grid grid-cols-1 lg:grid-cols-12 gap-4 md:gap-8 mb-8 md:mb-12">
        <div class="hidden lg:block lg:col-span-7">
            <!-- Banner Carousel -->
            <div class="relative overflow-hidden rounded-2xl shadow-2xl border border-white/10">
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
                    <div class="swiper-pagination bottom-4!"></div>
                    <div class="swiper-button-next text-white w-10 h-10 after:text-xl bg-white/20! hover:bg-white/40! rounded-full backdrop-blur-md! transition-all"></div>
                    <div class="swiper-button-prev text-white w-10 h-10 after:text-xl bg-white/20! hover:bg-white/40! rounded-full backdrop-blur-md! transition-all"></div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-5">
            @php
            $shopOwner = $topSpenders->firstWhere('id', 3);
            $filteredSpenders = $topSpenders->reject(fn($u) => $u->id == 3)->take(10)->values();
            @endphp

            @if($shopOwner)
            <!-- Shop Owner Section -->
            <div class="mb-6">
                <div class="flex items-center gap-2 mb-3">
                    <div class="h-px flex-1 bg-white/10"></div>
                    <span class="text-[10px] md:text-xs font-black text-primary uppercase tracking-widest bg-primary/10 px-3 py-1 rounded-full border border-primary/20">CHỦ SHOP</span>
                    <div class="h-px flex-1 bg-white/10"></div>
                </div>
                <div class="card-esport p-4 flex items-center gap-3 md:gap-4 relative overflow-hidden group">
                    <div class="shrink-0 w-10 md:w-12 h-10 md:h-12 rounded-full bg-primary flex items-center 
                    justify-center shadow-[0_0_15px_rgba(74,222,128,0.5)] transform transition-transform group-hover:rotate-12">
                        <span class="text-2xl md:text-3xl">👑</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-black text-sm md:text-lg text-text-primary truncate uppercase tracking-tight group-hover:text-primary transition-colors">{{ $shopOwner->name }}</p>
                        <p class="text-[10px] md:text-xs text-text-muted font-bold">{{ $shopOwner->total_orders }} đơn hàng thành công</p>
                    </div>
                    <div class="text-right">
                        <p class="font-black text-lg md:text-2xl text-primary drop-shadow-[0_0_8px_rgba(74,222,128,0.4)]">
                            {{ number_format($shopOwner->total_spent) }}<span class="text-sm">đ</span>
                        </p>
                    </div>
                    <!-- Decorative element -->
                    <div class="absolute -top-2 -right-2 opacity-5 text-primary">
                        <span class="material-icons text-6xl">verified_user</span>
                    </div>
                </div>
            </div>
            @endif

            <x-leaderboard :topSpenders="$filteredSpenders" />
        </div>
    </section>

    <!-- Categories -->
    <section class="mb-8 md:mb-12">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
            @forelse($categories as $category)
            <a href="{{ route('categories.show', $category->slug) }}" class="group card-esport p-3 md:p-4 flex flex-col items-center text-center transition-all hover:scale-[1.03] hover:border-primary/50">
                <div class="w-full h-32 md:h-48 mb-3 md:mb-4 overflow-hidden rounded-lg relative">
                    <img alt="{{ $category->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" src="{{ url('storage/'.$category->image) ?? 'https://via.placeholder.com/96' }}" loading="lazy">
                    <div class="absolute inset-0 bg-linear-to-t from-sky-900/40 to-transparent"></div>
                </div>
                <h3 class="font-black text-sm md:text-lg mb-1 text-white group-hover:text-primary transition-colors uppercase tracking-wide">{{ $category->title }}</h3>
                <p class="text-white/80 text-[10px] md:text-sm line-clamp-1 md:line-clamp-none">{!! strip_tags($category->description) !!}</p>
            </a>
            @empty
            <div class="col-span-4 text-center text-neutral-600 p-12 glass rounded-xl border border-white/5">Chưa có danh mục nào</div>
            @endforelse
        </div>
    </section>

    <!-- Flash Sale Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-6 relative">
        <h2 class="text-xl md:text-2xl font-black text-white uppercase flex items-center gap-2">
            <span class="material-icons text-primary/80">local_fire_department</span>
            FLASH SALE SIÊU HOT
        </h2>
        <a href="{{ route('products.index', ['sort' => 'discount']) }}" class="text-white hover:text-primary font-bold text-sm flex items-center gap-1 transition-colors">
            Xem tất cả <span class="material-icons text-sm">arrow_forward</span>
        </a>
    </div>

    <!-- Product Grid -->
    <section class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-16 relative">
        @forelse($flashSaleProducts as $product)
        <div class="card-esport group transition-all relative">
            <div class="card-sticker">🏷️</div>
            <div class="relative overflow-hidden aspect-video">
                <img alt="{{ $product->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" src="{{ url('storage/'.$product->images[0]) ?? 'https://via.placeholder.com/400x225' }}" loading="lazy">
                @if($product->getDiscountPercent())
                <div class="absolute top-2 right-2 bg-pink-500 text-white text-xs md:text-sm font-black px-2 py-1 rounded-full shadow-[0_0_10px_rgba(244,114,182,0.5)]">
                    -{{ number_format($product->getDiscountPercent()) }}%
                </div>
                @endif
                <div class="absolute bottom-2 left-2 bg-bg-dark/80 backdrop-blur-sm px-2 py-0.5 rounded text-[10px] text-text-muted font-bold border border-border">
                    ID: {{ $product->id }}
                </div>
            </div>
            <div class="p-4">
                <h4 class="font-bold text-sm mb-3 line-clamp-2 h-10 text-neutral-100 group-hover:text-primary transition-colors tracking-tight">{{ $product->title }}</h4>
                <div class="flex flex-col mb-4">
                    @if($product->sell_price)
                    <span class="text-xs text-text-muted line-through">{{ number_format($product->sell_price) }} đ</span>
                    @endif
                    <span class="text-xl font-black text-primary drop-shadow-[0_0_8px_rgba(34,197,94,0.3)]">{{ number_format($product->getFinalPrice()) }} <span class="text-sm">đ</span></span>
                </div>
                <a href="{{ route('products.show', $product->slug) }}" class="block w-full btn-esport justify-center py-2 rounded-lg text-center text-[10px] md:text-sm transition-all group-hover:gap-3">
                    <span class="material-icons text-sm">shopping_cart</span> MUA NGAY
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-4 glass rounded-xl p-12 text-center border border-white/5">
            <p class="text-neutral-600">Chưa có sản phẩm flash sale</p>
        </div>
        @endforelse
    </section>

    <!-- News Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-6">
        <h2 class="text-xl md:text-3xl font-black text-white uppercase flex items-center gap-3 tracking-wider">
            <span class="material-icons text-2xl md:text-4xl text-primary/80">article</span>
            TIN TỨC MỚI NHẤT
        </h2>
        <a href="{{ route('news.index') }}" class="text-white hover:text-primary font-bold text-sm flex items-center gap-1 transition-colors">
            Xem tất cả <span class="material-icons text-sm">arrow_forward</span>
        </a>
    </div>

    <section class="grid grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 relative">
        <div class="absolute -top-10 -right-10 text-6xl opacity-20 pointer-events-none animate-float">🏖️</div>
        @forelse($latestNews as $news)
        <a href="{{ route('news.show', $news->slug) }}" class="group card-esport overflow-hidden transition-all">
            <div class="card-sticker text-2xl">🔥</div>
            <div class="relative overflow-hidden aspect-video">
                <img alt="{{ $news->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" src="{{ url('storage/'.$news->thumbnail) ?? 'https://via.placeholder.com/400x225' }}" loading="lazy">
                <div class="absolute inset-0 bg-linear-to-t from-sky-950/40 to-transparent"></div>
            </div>
            <div class="p-4 relative z-20">
                <h4 class="font-bold text-sm mb-2 line-clamp-2 h-10 text-white group-hover:text-primary transition-colors tracking-tight">{{ $news->title }}</h4>
                <p class="text-white/80 text-xs mb-4 line-clamp-2">{!! Str::limit(strip_tags($news->content), 100) !!}</p>
                <div class="flex items-center justify-between text-xs">
                    <span class="text-white/60">{{ $news->created_at->format('d/m/Y') }}</span>
                    <span class="text-primary font-bold flex items-center gap-1 group-hover:gap-2 transition-all">
                        Đọc thêm <span class="material-icons text-sm">arrow_forward</span>
                    </span>
                </div>
            </div>
        </a>
        @empty
        <div class="col-span-3 glass rounded-xl border border-white/5 p-12 text-center">
            <p class="text-white">Chưa có tin tức nào</p>
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
    });
</script>