@extends('layouts.app')

@section('title', $category->meta_title ?? $category->title . ' - VanhFCO')
@section('description', $category->meta_description ?? $category->description)

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Category Header -->
    <div class="mb-12 text-center relative">
        <!-- Decorative background glow -->
        <div class="absolute -top-20 -left-20 w-64 h-64 bg-primary/10 blur-[100px] rounded-full pointer-events-none"></div>
        <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-indigo-500/10 blur-[100px] rounded-full pointer-events-none"></div>

        <h1 class="text-3xl font-black uppercase tracking-tight text-white mb-3 flex justify-center items-center gap-4 relative z-10">
            <img src="{{ asset('images/summer/saobien3.png') }}" alt="Starfish" class="w-10 h-10 md:w-14 md:h-14 animate-float">
            {{ $category->title }}
            <img src="{{ asset('images/summer/saobien4.png') }}" alt="Starfish" class="w-10 h-10 md:w-14 md:h-14 animate-float" style="animation-delay: 1s;">
        </h1>

        <!-- Flying birds decorative image -->
        <img src="{{ asset('images/summer/chim.png') }}" alt="Birds" class="absolute -top-10 right-0 w-24 md:w-48 opacity-60 pointer-events-none drop-shadow-lg animate-float hidden md:block">
        @if($category->description)
        <p class="text-neutral-400 max-w-2xl mx-auto font-bold">{{ $category->description }}</p>
        @endif
        <div class="h-1 w-32 bg-linear-to-r from-transparent via-primary to-transparent mx-auto rounded-full mt-6"></div>
    </div>

    @if($products->count() > 0)
    <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8">
        @foreach($products as $product)
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
        @endforeach
    </div>

    <div class="mt-8">
        {{ $products->links('vendor.pagination.tailwind') }}
    </div>
    @else
    <div class="glass rounded-2xl border border-white/10 p-12 text-center">
        <span class="material-icons text-6xl text-neutral-800 mb-6 drop-shadow-[0_0_15px_rgba(255,255,255,0.05)]">inventory_2</span>
        <p class="text-2xl font-black mb-3 text-white uppercase tracking-tighter">Chưa có sản phẩm</p>
        <p class="text-neutral-600 font-bold">Danh mục này hiện chưa có sản phẩm nào</p>
    </div>
    @endif
</div>

@endsection