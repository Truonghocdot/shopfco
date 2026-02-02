@extends('layouts.app')

@section('title', 'Trang chủ - VanhFCO.com - mua bán tài khoản FCO4 - Uy tín chất lượng')
@section('description', 'Mua bán tài khoản FC Online uy tín, giá rẻ, giao dịch tự động 24/7.')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
@endpush

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Hero Banner -->
    <section class="mb-12 relative overflow-hidden rounded-2xl group">
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
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>

            <!-- Add Navigation -->
            <div class="swiper-button-next text-white"></div>
            <div class="swiper-button-prev text-white"></div>
        </div>

        <div class="absolute inset-0 flex items-center justify-center bg-black/10 z-10 pointer-events-none">
            <div class="bg-white/90 backdrop-blur-md px-8 py-4 rounded-full shadow-2xl transform group-hover:scale-105 transition duration-300 pointer-events-auto">
                <div class="flex flex-wrap justify-center gap-6 z-10">
                    <div class="flex items-center gap-2 text-xl font-black text-gray-800 tracking-wide">
                        <span class="material-icons text-red-600 text-3xl">call</span>
                        0342995001
                    </div>
                    <div class="w-px h-8 bg-slate-300 hidden md:block"></div>
                    <a href="https://www.facebook.com/le.vietanh.939173" target="_blank" class="flex items-center gap-2 text-xl font-black text-gray-800 tracking-wide hover:text-primary transition">
                        <span class="material-icons text-blue-600 text-3xl">facebook</span>
                        LE VIET ANH
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-12">
        <div class="lg:col-span-7">
            <div class="    glass-morphism rounded-xl overflow-hidden p-2">
                <div class="aspect-video w-full rounded-lg overflow-hidden">
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
            </div>
        </div>

        <div class="lg:col-span-5">
            <x-leaderboard :topSpenders="$topSpenders" />
        </div>
    </section>
    <!-- Categories -->
    <section class="mb-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($categories as $category)
            <a href="{{ route('categories.show', $category->slug) }}" class="glass-morphism rounded-xl p-6 flex flex-col items-center text-center hover:border-primary transition group cursor-pointer">
                <div class="w-full h-48 mb-4 relative">
                    <img alt="{{ $category->title }}" class="rounded-lg object-cover w-full h-full border-2 border-slate-600 group-hover:border-primary" src="{{ url('storage/'.$category->image) ?? 'https://via.placeholder.com/96' }}" loading="lazy">
                </div>
                <h3 class="font-bold text-lg mb-2">{{ $category->title }}</h3>
                <p class="text-slate-400 text-sm">{!! $category->description !!}</p>
            </a>
            @empty
            <div class="col-span-4 text-center text-slate-400">Chưa có danh mục nào</div>
            @endforelse
        </div>
    </section>

    <!-- Flash Sale Section -->
    <div class="flex items-center justify-between mb-8">
        <h2 class="text-2xl font-black uppercase flex items-center gap-2">
            <span class="material-icons text-orange-500">local_fire_department</span>
            FLASH SALE SIÊU HOT
        </h2>
        <a href="{{ route('products.index', ['sort' => 'discount']) }}" class="text-primary hover:text-primary/80 font-bold text-sm flex items-center gap-1">
            Xem tất cả <span class="material-icons text-sm">arrow_forward</span>
        </a>
    </div>

    <!-- Product Grid -->
    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
        @forelse($flashSaleProducts as $product)
        <div class="glass-morphism rounded-xl overflow-hidden group border border-slate-700 hover:border-primary transition">
            <div class="relative overflow-hidden aspect-video">
                <img alt="{{ $product->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" src="{{ url('storage/'.$product->images[0]) ?? 'https://via.placeholder.com/400x225' }}" loading="lazy">
                @if($product->getDiscountPercent())
                <div class="absolute top-2 right-2 bg-accent-red text-white text-xs font-bold px-2 py-1 rounded">
                    -{{ number_format($product->getDiscountPercent()) }}%
                </div>
                @endif
                <div class="absolute bottom-2 left-2 bg-black/60 backdrop-blur px-2 py-0.5 rounded text-[10px] text-slate-300">
                    ID: {{ $product->id }}
                </div>
            </div>
            <div class="p-4">
                <h4 class="font-bold text-sm mb-3 line-clamp-2 h-10 group-hover:text-primary transition">{{ $product->title }}</h4>
                <div class="flex flex-col mb-4">
                    @if($product->sell_price)
                    <span class="text-xs text-slate-500 line-through">{{ number_format($product->sell_price) }} đ</span>
                    @endif
                    <span class="text-xl font-black text-accent-red">{{ number_format($product->getFinalPrice()) }} <span class="text-sm">đ</span></span>
                </div>
                <a href="{{ route('products.show', $product->slug) }}" class="block w-full bg-accent-red hover:bg-red-600 text-white font-bold py-2 rounded-lg flex items-center justify-center gap-2 transition transform active:scale-95">
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
    <!-- Latest News -->
    <div class="flex items-center justify-between mb-8">
        <h2 class="text-2xl font-black uppercase flex items-center gap-2">
            <span class="material-icons text-blue-500">article</span>
            TIN TỨC MỚI NHẤT
        </h2>
        <a href="{{ route('news.index') }}" class="text-primary hover:text-primary/80 font-bold text-sm flex items-center gap-1">
            Xem tất cả <span class="material-icons text-sm">arrow_forward</span>
        </a>
    </div>

    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
        @forelse($latestNews as $news)
        <a href="{{ route('news.show', $news->slug) }}" class="group block">
            <div class="glass-morphism rounded-xl overflow-hidden border border-slate-700 hover:border-primary transition h-full flex flex-col">
                <div class="aspect-video w-full overflow-hidden relative">
                    <img src="{{ url('storage/'.$news->thumbnail) ?? 'https://via.placeholder.com/400x225' }}" alt="{{ $news->title }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black/80 to-transparent p-4 pt-12">
                        <span class="text-xs font-bold text-slate-300 flex items-center gap-1">
                            <span class="material-icons text-xs">calendar_today</span>
                            {{ $news->created_at->format('d/m/Y') }}
                        </span>
                    </div>
                </div>
                <div class="p-4 flex-1 flex flex-col">
                    <h3 class="font-bold text-lg mb-2 line-clamp-2 group-hover:text-primary transition">{{ $news->title }}</h3>
                    <p class="text-slate-400 text-sm line-clamp-3 mb-4 flex-1">{!! $news->description !!}</p>
                    <span class="text-primary text-sm font-bold flex items-center gap-1 mt-auto">
                        Đọc thêm <span class="material-icons text-sm transition-transform group-hover:translate-x-1">arrow_forward</span>
                    </span>
                </div>
            </div>
        </a>
        @empty
        <div class="col-span-4 glass-morphism rounded-xl p-12 text-center">
            <p class="text-slate-400">Chưa có tin tức nào</p>
        </div>
        @endforelse
    </section>

</div>
@endsection

@push('schema')
@php
$websiteSchema = [
"@context" => "https://schema.org",
"@type" => "WebSite",
"name" => "Shop Acc FC Online - VanhFCO",
"url" => route('home'),
"potentialAction" => [
"@type" => "SearchAction",
"target" => route('home') . "?q={search_term_string}",
"query-input" => "required name=search_term_string"
]
];

$orgSchema = [
"@context" => "https://schema.org",
"@type" => "Organization",
"name" => "VanhFCO",
"url" => route('home'),
"logo" => asset('images/logo.png'),
"contactPoint" => [
"@type" => "ContactPoint",
"telephone" => "+84342995001",
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
    });
</script>
@endpush