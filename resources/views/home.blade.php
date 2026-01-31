@extends('layouts.app')

@section('title', 'Trang chủ - VanhFCO.com - mua bán tài khoản FCO4 - Uy tín chất lượng')
@section('description', 'Mua bán tài khoản FC Online uy tín, giá rẻ, giao dịch tự động 24/7.')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Hero Banner -->
    <section class="mb-12 relative overflow-hidden rounded-2xl group">
        <div class="aspect-[21/9] w-full bg-primary flex flex-col items-center justify-center p-8 text-slate-900 overflow-hidden relative">
            <div class="absolute inset-0 opacity-10 pointer-events-none">
                <svg height="100%" width="100%" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern height="40" id="grid" patternUnits="userSpaceOnUse" width="40">
                            <path d="M 40 0 L 0 0 0 40" fill="none" stroke="black" stroke-width="1"></path>
                        </pattern>
                    </defs>
                    <rect fill="url(#grid)" height="100%" width="100%"></rect>
                </svg>
            </div>
            <h1 class="text-4xl md:text-7xl font-black italic tracking-tighter mb-2 z-10 text-center text-slate-900">VANHFCO.COM</h1>
            <p class="text-lg md:text-2xl font-bold uppercase tracking-widest mb-6 z-10 text-center text-slate-900">CUNG CẤP ACC FC ONLINE HÀNG ĐẦU VIỆT NAM</p>
            <div class="flex flex-wrap justify-center gap-4 md:gap-8 z-10">
                <div class="flex items-center gap-2 font-bold text-slate-900"><span class="material-icons">call</span> 0342995001</div>
                <a href="https://www.facebook.com/le.vietanh.939173" target="_blank" class="flex items-center gap-2 font-bold text-slate-900"><span class="material-icons">facebook</span> LE VIET ANH</a>
            </div>
        </div>
    </section>

    <!-- Categories -->
    <section class="mb-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($categories as $category)
            <a href="{{ route('categories.show', $category->slug) }}" class="glass-morphism rounded-xl p-6 flex flex-col items-center text-center hover:border-primary transition group cursor-pointer">
                <div class="w-24 h-24 mb-4 relative">
                    <img alt="{{ $category->title }}" class="rounded-lg object-cover w-full h-full border-2 border-slate-600 group-hover:border-primary" src="{{ $category->image ?? 'https://via.placeholder.com/96' }}">
                </div>
                <h3 class="font-bold text-lg mb-2">{{ $category->title }}</h3>
                <p class="text-slate-400 text-sm">{{ $category->description }}</p>
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
                <img alt="{{ $product->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" src="{{ $product->images[0] ?? 'https://via.placeholder.com/400x225' }}">
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
                    <img src="{{ $news->thumbnail ?? 'https://via.placeholder.com/400x225' }}" alt="{{ $news->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black/80 to-transparent p-4 pt-12">
                        <span class="text-xs font-bold text-slate-300 flex items-center gap-1">
                            <span class="material-icons text-xs">calendar_today</span>
                            {{ $news->created_at->format('d/m/Y') }}
                        </span>
                    </div>
                </div>
                <div class="p-4 flex-1 flex flex-col">
                    <h3 class="font-bold text-lg mb-2 line-clamp-2 group-hover:text-primary transition">{{ $news->title }}</h3>
                    <p class="text-slate-400 text-sm line-clamp-3 mb-4 flex-1">{{ $news->description }}</p>
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