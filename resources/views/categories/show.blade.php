@extends('layouts.app')

@section('title', $category->meta_title ?? $category->title . ' - VanhFCO')
@section('description', $category->meta_description ?? $category->description)

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Category Header -->
    <div class="mb-10 text-center">
        <h1 class="text-3xl font-black uppercase tracking-tight text-primary mb-3 flex justify-center items-center gap-3">
            <span class="material-icons text-4xl">category</span>
            {{ $category->title }}
        </h1>
        @if($category->description)
        <p class="text-gray-500 max-w-2xl mx-auto">{{ $category->description }}</p>
        @endif
        <div class="h-1 w-32 bg-gradient-to-r from-transparent via-primary to-transparent mx-auto rounded-full mt-4"></div>
    </div>

    @if($products->count() > 0)
    <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8">
        @foreach($products as $product)
        <div class="bg-white rounded-xl overflow-hidden border border-gray-200 shadow-sm hover:shadow-lg group transition-all hover:scale-[1.02] relative">
            <!-- Flower decorations -->
            <img src="{{ asset('images/hoa1.webp') }}" alt="" class="absolute -top-6 -left-6 w-22 md:w-28 opacity-90 -rotate-12 pointer-events-none z-10 animate-shake">
            <img src="{{ asset('images/hoa3.webp') }}" alt="" class="absolute -bottom-6 -right-6 w-22 md:w-28 opacity-90 rotate-12 pointer-events-none z-10 animate-shake">
            <div class="relative overflow-hidden aspect-video">
                <img alt="{{ $product->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" src="{{ url('storage/'.$product->images[0]) ?? 'https://via.placeholder.com/400x225' }}" loading="lazy">
                @if($product->getDiscountPercent())
                <div class="absolute top-2 right-2 bg-red-500 text-white text-xs font-black px-2 py-1 rounded-full">
                    -{{ number_format($product->getDiscountPercent()) }}%
                </div>
                @endif
                <div class="absolute bottom-2 left-2 bg-white/90 px-2 py-0.5 rounded text-[10px] text-gray-600 font-bold">
                    ID: {{ $product->id }}
                </div>
            </div>
            <div class="p-4">
                <h4 class="font-bold text-sm mb-3 line-clamp-2 h-10 text-gray-800 group-hover:text-primary transition">{{ $product->title }}</h4>
                <div class="flex flex-col mb-4">
                    @if($product->sale_price && $product->sell_price)
                    <span class="text-xs text-gray-400 line-through">{{ number_format($product->sell_price) }} đ</span>
                    @endif
                    <span class="text-xl font-black text-primary">
                        {{ number_format($product->getFinalPrice()) }} <span class="text-sm">đ</span>
                    </span>
                </div>
                <a href="{{ route('products.show', $product->slug) }}" class="block w-full btn-tet py-2 rounded-lg text-center text-sm uppercase tracking-wide">
                    <span class="material-icons text-sm align-middle">shopping_cart</span> XEM CHI TIẾT
                </a>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $products->links('vendor.pagination.tailwind') }}
    </div>
    @else
    <div class="bg-white rounded-xl border border-gray-200 shadow-md p-12 text-center">
        <span class="material-icons text-6xl text-gray-300 mb-4">inventory_2</span>
        <p class="text-xl font-black mb-2 text-primary">Chưa có sản phẩm</p>
        <p class="text-gray-400">Danh mục này hiện chưa có sản phẩm nào</p>
    </div>
    @endif
</div>

@endsection