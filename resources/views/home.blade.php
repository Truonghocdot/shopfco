@extends('layouts.app')

@section('title', 'Trang chủ - VanhFCO.com - mua bán tài khoản FCO4 - Uy tín chất lượng')
@section('description', 'Mua bán tài khoản FC Online uy tín, giá rẻ, giao dịch tự động 24/7.')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<style>
    .categories-swiper {
        padding: 20px 0 !important;
    }
    .categories-swiper .swiper-button-next,
    .categories-swiper .swiper-button-prev {
        width: 40px !important;
        height: 40px !important;
        background: rgba(255, 255, 255, 0.1) !important;
        backdrop-filter: blur(8px) !important;
        border: 1px border border-white/10 !important;
        border-radius: 50% !important;
        color: #fff !important;
        transition: all 0.3s ease !important;
        top: 50% !important;
        transform: translateY(-50%) !important;
    }
    .categories-swiper .swiper-button-next:after,
    .categories-swiper .swiper-button-prev:after {
        font-size: 18px !important;
        font-weight: 900 !important;
    }
    .categories-swiper .swiper-button-next:hover,
    .categories-swiper .swiper-button-prev:hover {
        background: var(--color-primary) !important;
        border-color: var(--color-primary) !important;
        box-shadow: 0 0 20px rgba(34, 197, 94, 0.4) !important;
        color: #000 !important;
    }
    .categories-swiper .swiper-button-prev { left: -20px !important; }
    .categories-swiper .swiper-button-next { right: -20px !important; }
</style>
@endpush

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Video Hero Section -->
    <section class="mb-8 md:mb-12 relative">
        <div class="glass rounded-2xl overflow-hidden shadow-2xl border border-white/10 p-2 relative z-10">
            <div class="aspect-video w-full rounded-xl overflow-hidden relative">
                <iframe
                    class="w-full h-full"
                    src="https://www.youtube.com/embed/gQkpw5JtnuQ?si=M54VBBoQfaZhYSf3"
                    title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin"
                    allowfullscreen>
                </iframe>
                <!-- Flying birds decorative image -->
                <img src="{{ asset('images/summer/chim.png') }}" alt="Birds" class="absolute top-4 right-4 w-16 md:w-32 opacity-80 pointer-events-none drop-shadow-lg animate-float" loading="lazy" decoding="async">
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
                    <h2 class="text-2xl md:text-4xl font-black mb-2 md:mb-4 flex items-center justify-center md:justify-start gap-2 md:gap-3 text-neon uppercase tracking-wider drop-shadow-lg">
                        <span class="material-icons text-3xl md:text-4xl text-white">surfing</span> HỨNG DỪA <span class="text-white italic">ĐÓN QUÀ</span>
                    </h2>
                    <p class="text-white/90 text-sm md:text-lg mb-4 md:mb-8 max-w-md mx-auto md:mx-0">
                        Trải nghiệm cảm giác rẽ sóng săn quà cực khủng! Nhận ngay Acc FCO siêu phẩm, BP trắng cực hời chỉ từ một lượt lướt!
                    </p>
                    <div class="inline-flex items-center gap-2 md:gap-3 btn-esport py-2 px-6 md:py-3 md:px-8 rounded-full group-hover/tree:scale-105 transition-transform">
                        <span class="material-icons text-sm md:text-base">surfing</span> HỨNG DỪA NGAY <span class="material-icons text-sm md:text-base">arrow_forward</span>
                    </div>
                </div>

                <div class="relative w-full max-w-[180px] md:max-w-[280px] flex items-center justify-center">
                    <img src="{{ asset('images/summer/coconut.png') }}" alt="Coconut" class="w-full group-hover/tree:scale-110 transition-transform duration-500 drop-shadow-lg" style="filter: drop-shadow(0 0 20px rgba(74,222,128,0.3));" loading="lazy" decoding="async">
                </div>
            </div>
        </a>
    </section>

    <!-- Top Spenders Section -->
    <section class="mb-8 md:mb-16">
        <div class="max-w-4xl mx-auto">
            @php
            $shopOwner = $topSpenders->firstWhere('id', 3);
            $filteredSpenders = $topSpenders->reject(fn($u) => $u->id == 3)->take(10)->values();
            @endphp

            @if($shopOwner)
            <!-- Shop Owner Section -->
            <div class="mb-8">
                <div class="flex items-center gap-2 mb-4">
                    <div class="h-px flex-1 bg-white/10"></div>
                    <span class="text-xs md:text-sm font-black text-primary uppercase tracking-[0.2em] bg-primary/10 px-4 py-1.5 rounded-full border border-primary/20 shadow-[0_0_15px_rgba(74,222,128,0.2)]">CHỦ SHOP UY TÍN</span>
                    <div class="h-px flex-1 bg-white/10"></div>
                </div>
                <div class="card-esport p-5 md:p-6 flex items-center gap-4 md:gap-6 relative overflow-hidden group border-primary/30">
                    <div class="shrink-0 w-14 md:w-16 h-14 md:h-16 rounded-full bg-linear-to-br from-primary to-emerald-600 flex items-center 
                    justify-center shadow-[0_0_20px_rgba(74,222,128,0.5)] transform transition-transform group-hover:scale-110 group-hover:rotate-12">
                        <span class="text-3xl md:text-4xl drop-shadow-lg">👑</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-black text-lg md:text-2xl text-text-primary truncate uppercase tracking-tight group-hover:text-primary transition-colors">{{ $shopOwner->name }}</p>
                        <p class="text-xs md:text-sm text-text-muted font-bold flex items-center gap-1">
                            <span class="material-icons text-xs text-primary">verified</span>
                            {{ $shopOwner->total_orders }} đơn hàng thành công
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="text-[10px] md:text-xs text-text-muted font-black uppercase tracking-widest mb-1">Tổng giao dịch</p>
                        <p class="font-black text-2xl md:text-4xl text-primary drop-shadow-[0_0_12px_rgba(74,222,128,0.4)]">
                            {{ number_format($shopOwner->total_spent) }}<span class="text-sm md:text-lg">đ</span>
                        </p>
                    </div>
                    <!-- Decorative element -->
                    <div class="absolute -top-4 -right-4 opacity-10 text-primary transform rotate-12">
                        <span class="material-icons text-8xl">verified_user</span>
                    </div>
                </div>
            </div>
            @endif

            <div class="relative">
                <div class="absolute -inset-4 bg-primary/5 blur-3xl rounded-full pointer-events-none"></div>
                <x-leaderboard :topSpenders="$filteredSpenders" />
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="mb-12 md:mb-16">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-xl md:text-3xl font-black text-white uppercase flex items-center gap-3">
                <span class="w-2 h-8 bg-primary rounded-full"></span>
                DANH MỤC TRÒ CHƠI
            </h2>
        </div>

        <!-- Desktop Swiper Carousel -->
        <div class="hidden lg:block relative">
            <div class="swiper-container categories-swiper overflow-hidden">
                <div class="swiper-wrapper">
                    @forelse($categories as $category)
                    <div class="swiper-slide h-auto">
                        <a href="{{ route('categories.show', $category->slug) }}" class="group card-esport p-4 flex flex-col items-center text-center transition-all hover:scale-[1.05] hover:border-primary/50 h-full">
                            <div class="w-full h-48 mb-4 overflow-hidden rounded-xl relative">
                                <img alt="{{ $category->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" src="{{ url('storage/'.$category->image) ?? 'https://via.placeholder.com/400x300' }}" loading="lazy" decoding="async">
                                <div class="absolute inset-0 bg-linear-to-t from-sky-900/60 to-transparent"></div>
                                @php 
                                    $starfish = ['saobien1.png', 'saobien2.png', 'saobien3.png', 'saobien4.png'];
                                    $randomStar = $starfish[$loop->index % 4];
                                @endphp
                                <img src="{{ asset('images/summer/' . $randomStar) }}" alt="Starfish" class="absolute -bottom-2 -left-2 w-12 transform -rotate-12 group-hover:scale-125 transition-transform duration-500" loading="lazy" decoding="async">
                            </div>
                            <h3 class="font-black text-lg mb-2 text-white group-hover:text-primary transition-colors uppercase tracking-widest flex items-center justify-center gap-2">
                                <img src="{{ asset('images/summer/saobien'.(($loop->index % 4) + 1).'.png') }}" alt="Icon" class="w-5 h-5">
                                {{ $category->title }}
                            </h3>
                            <p class="text-white/70 text-sm line-clamp-2">{!! strip_tags($category->description) !!}</p>
                        </a>
                    </div>
                    @empty
                    @endforelse
                </div>
            </div>
            <!-- Navigation Buttons -->
            <div class="swiper-button-next categories-next"></div>
            <div class="swiper-button-prev categories-prev"></div>
        </div>

        <!-- Mobile Grid View -->
        <div class="lg:hidden grid grid-cols-2 gap-4">
            @forelse($categories as $category)
            <a href="{{ route('categories.show', $category->slug) }}" class="group card-esport p-3 flex flex-col items-center text-center transition-all active:scale-[0.98]">
                <div class="w-full h-36 mb-3 overflow-hidden rounded-lg relative">
                    <img alt="{{ $category->title }}" class="w-full h-full object-cover" src="{{ url('storage/'.$category->image) ?? 'https://via.placeholder.com/96' }}" loading="lazy" decoding="async">
                    <div class="absolute inset-0 bg-linear-to-t from-sky-900/40 to-transparent"></div>
                    @php 
                        $starfish = ['saobien1.png', 'saobien2.png', 'saobien3.png', 'saobien4.png'];
                        $randomStar = $starfish[$loop->index % 4];
                    @endphp
                    <img src="{{ asset('images/summer/' . $randomStar) }}" alt="Starfish" class="absolute -bottom-1 -left-1 w-10 transform -rotate-12" loading="lazy" decoding="async">
                </div>
                <h3 class="font-black text-[13px] mb-1 text-white group-hover:text-primary transition-colors uppercase tracking-wide flex items-center justify-center gap-1.5 line-clamp-1 px-1">
                    <img src="{{ asset('images/summer/saobien'.(($loop->index % 4) + 1).'.png') }}" alt="Icon" class="w-4 h-4">
                    {{ $category->title }}
                </h3>
                <p class="text-white/60 text-[10px] line-clamp-1">{!! strip_tags($category->description) !!}</p>
            </a>
            @empty
            <div class="col-span-2 text-center text-neutral-600 p-8 glass rounded-xl border border-white/5 text-sm">Chưa có danh mục nào</div>
            @endforelse
        </div>
    </section>

    <!-- Flash Sale Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-6 relative">
        <h2 class="text-xl md:text-2xl font-black text-white uppercase flex items-center gap-2">
            <img src="{{ asset('images/summer/saobien1.png') }}" alt="Starfish" class="w-10 h-10 md:w-8 md:h-8 animate-pulse" loading="lazy" decoding="async">
            FLASH SALE SIÊU HOT
            <img src="{{ asset('images/summer/saobien2.png') }}" alt="Starfish" class="w-10 h-10 md:w-8 md:h-8 animate-pulse" loading="lazy" decoding="async">
        </h2>
        <a href="{{ route('products.index', ['sort' => 'discount']) }}" class="text-white hover:text-primary font-bold text-sm flex items-center gap-1 transition-colors">
            Xem tất cả <span class="material-icons text-sm">arrow_forward</span>
        </a>
    </div>

    <!-- Product Grid -->
    <section class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-16 relative">
        @forelse($flashSaleProducts as $product)
        <div class="card-esport group transition-all relative">
            <div class="card-sticker">
                <img src="{{ asset('images/summer/saobien'.(($loop->index % 4) + 1).'.png') }}" alt="Starfish" class="w-12 h-12 md:w-10 md:h-10" loading="lazy" decoding="async">
            </div>
            <div class="relative overflow-hidden aspect-video">
                <img alt="{{ $product->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" src="{{ url('storage/'.$product->images[0]) ?? 'https://via.placeholder.com/400x225' }}" loading="lazy" decoding="async">
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
                <a href="{{ route('products.show', $product->slug) }}" class="block w-full btn-esport justify-center items-center py-2.5 rounded-lg text-center text-[10px] md:text-sm transition-all group-hover:gap-3 relative overflow-hidden">
                    <img src="{{ asset('images/summer/saobien'.(($loop->index % 4) + 1).'.png') }}" alt="Icon" class="w-10 h-10 md:w-7 md:h-7 mr-1 animate-float" loading="lazy" decoding="async">
                    MUA NGAY
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
            <img src="{{ asset('images/summer/saobien3.png') }}" alt="Starfish" class="w-12 h-12 md:w-10 md:h-10 animate-float" loading="lazy" decoding="async">
            TIN TỨC MỚI NHẤT
            <img src="{{ asset('images/summer/saobien4.png') }}" alt="Starfish" class="w-12 h-12 md:w-10 md:h-10 animate-float" style="animation-delay: 1s;" loading="lazy" decoding="async">
        </h2>
        <a href="{{ route('news.index') }}" class="text-white hover:text-primary font-bold text-sm flex items-center gap-1 transition-colors">
            Xem tất cả <span class="material-icons text-sm">arrow_forward</span>
        </a>
    </div>

    <section class="grid grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 relative">
        <div class="absolute -top-10 -right-10 text-6xl opacity-20 pointer-events-none animate-float">🏖️</div>
        @forelse($latestNews as $news)
        <a href="{{ route('news.show', $news->slug) }}" class="group card-esport overflow-hidden transition-all relative">
            <div class="card-sticker">
                <img src="{{ asset('images/summer/saobien'.((($loop->index + 2) % 4) + 1).'.png') }}" alt="Starfish" class="w-12 h-12 md:w-10 md:h-10" loading="lazy" decoding="async">
            </div>
            <div class="relative overflow-hidden aspect-video md:aspect-video min-h-[140px] md:min-h-0">
                <img alt="{{ $news->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" src="{{ url('storage/'.$news->thumbnail) ?? 'https://via.placeholder.com/400x225' }}" loading="lazy" decoding="async">
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

@push('scripts')
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var categoriesSwiper = new Swiper('.categories-swiper', {
            slidesPerView: 2,
            spaceBetween: 16,
            loop: false,
            navigation: {
                nextEl: '.categories-next',
                prevEl: '.categories-prev',
            },
            breakpoints: {
                768: {
                    slidesPerView: 3,
                    spaceBetween: 20
                },
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 24
                }
            }
        });
    });
</script>
@endpush