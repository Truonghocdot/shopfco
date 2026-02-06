@extends('layouts.app')

@section('title', $category->meta_title ?? $category->title . ' - VanhFCO')
@section('description', $category->meta_description ?? $category->description)

@push('styles')
<style>
    body {
        background: linear-gradient(135deg, #000000 0%, #001a0f 50%, #000000 100%);
        background-attachment: fixed;
    }
</style>
@endpush

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Category Header -->
    <div class="mb-10 text-center relative">
        <div class="absolute inset-0 opacity-10 pointer-events-none">
            <div class="absolute inset-0" style="background-image: repeating-linear-gradient(90deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px), repeating-linear-gradient(0deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px);"></div>
        </div>

        <h1 class="text-4xl font-black uppercase tracking-tight text-primary mb-3 flex justify-center items-center gap-3 drop-shadow-[0_0_20px_rgba(0,255,0,0.8)] relative z-10">
            <span class="material-icons text-4xl">category</span>
            {{ $category->title }}
        </h1>
        @if($category->description)
        <p class="text-slate-400 max-w-2xl mx-auto relative z-10">{{ $category->description }}</p>
        @endif
        <div class="h-1 w-32 bg-gradient-to-r from-transparent via-primary to-transparent mx-auto rounded-full shadow-[0_0_10px_rgba(0,255,0,0.8)] mt-4"></div>
    </div>

    <!-- Products Grid -->
    @if($products->count() > 0)
    <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8">
        @foreach($products as $product)
        <div class="relative bg-gradient-to-br from-black via-[#001a0f] to-black rounded-xl overflow-hidden group border-2 border-slate-700 hover:border-primary transition-all hover:shadow-[0_0_30px_rgba(0,255,0,0.3)] hover:scale-[1.02]">
            <!-- Grid Pattern -->
            <div class="absolute inset-0 opacity-0 group-hover:opacity-10 pointer-events-none transition-opacity">
                <div class="absolute inset-0" style="background-image: repeating-linear-gradient(90deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px), repeating-linear-gradient(0deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px);"></div>
            </div>

            <!-- Product Image -->
            <div class="relative overflow-hidden aspect-video">
                <img alt="{{ $product->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" src="{{ url('storage/'.$product->images[0]) ?? 'https://via.placeholder.com/400x225' }}" loading="lazy">

                <!-- Discount Badge -->
                @if($product->getDiscountPercent())
                <div class="absolute top-2 right-2 bg-gradient-to-r from-red-500 to-pink-500 text-white text-xs font-black px-3 py-1 rounded-lg shadow-[0_0_15px_rgba(239,68,68,0.5)]">
                    -{{ number_format($product->getDiscountPercent()) }}%
                </div>
                @endif

                <!-- Product ID Badge -->
                <div class="absolute bottom-2 left-2 bg-black/70 backdrop-blur-sm border border-primary/30 px-2 py-1 rounded text-[10px] text-primary font-bold shadow-[0_0_10px_rgba(0,255,0,0.3)]">
                    ID: {{ $product->id }}
                </div>
            </div>

            <!-- Product Info -->
            <div class="p-4 relative z-10">
                <h4 class="font-bold text-sm mb-3 line-clamp-2 h-10 text-white group-hover:text-primary transition">{{ $product->title }}</h4>

                <!-- Price -->
                <div class="flex flex-col mb-4">
                    @if($product->sale_price && $product->sell_price)
                    <span class="text-xs text-slate-500 line-through">{{ number_format($product->sell_price) }} đ</span>
                    @endif
                    <span class="text-xl font-black text-primary drop-shadow-[0_0_8px_rgba(0,255,0,0.8)]">
                        {{ number_format($product->getFinalPrice()) }} <span class="text-sm">đ</span>
                    </span>
                </div>

                <!-- View Details Button -->
                <a href="{{ route('products.show', $product->slug) }}" class="block w-full bg-gradient-to-r from-primary/20 to-primary/10 hover:from-primary hover:to-green-400 border-2 border-primary/50 text-primary hover:text-black font-black py-2 rounded-lg text-center transition-all shadow-[0_0_10px_rgba(0,255,0,0.3)] hover:shadow-[0_0_20px_rgba(0,255,0,0.8)] active:scale-95">
                    <span class="material-icons text-sm align-middle">shopping_cart</span> XEM CHI TIẾT
                </a>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination with Techno Style -->
    <div class="mt-8">
        {{ $products->links('vendor.pagination.tailwind') }}
    </div>
    @else
    <!-- Empty State -->
    <div class="relative bg-gradient-to-br from-black via-[#001a0f] to-black border-2 border-primary/30 rounded-xl shadow-[0_0_30px_rgba(0,255,0,0.2)] p-12 text-center overflow-hidden">
        <!-- Grid Pattern -->
        <div class="absolute inset-0 opacity-10 pointer-events-none">
            <div class="absolute inset-0" style="background-image: repeating-linear-gradient(90deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px), repeating-linear-gradient(0deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px);"></div>
        </div>

        <span class="material-icons text-6xl text-slate-700 mb-4 drop-shadow-[0_0_10px_rgba(0,255,0,0.3)] relative z-10">inventory_2</span>
        <p class="text-xl font-black mb-2 text-primary drop-shadow-[0_0_10px_rgba(0,255,0,0.8)] relative z-10">Chưa có sản phẩm</p>
        <p class="text-slate-500 relative z-10">Danh mục này hiện chưa có sản phẩm nào</p>
    </div>
    @endif
</div>

@endsection