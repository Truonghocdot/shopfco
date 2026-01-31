@extends('layouts.app')

@section('title', $category->meta_title ?? $category->title . ' - VanhFCO')
@section('description', $category->meta_description ?? $category->description)

@push('styles')
<style>
    body {
        background-image: linear-gradient(rgba(15, 23, 42, 0.9), rgba(15, 23, 42, 0.9)), url(https://lh3.googleusercontent.com/aida-public/AB6AXuBsKRObr_MVqVSUYzPo-guc9soauRLmFJkvOfA5NJc8IWI0XazSVu7WJsY8o8kfBvO5heKgomdMEML4GoG44D4PjL-ZHyhOcCC499d22XF4In7K5cptXa6JgtEe2sF_Q9_IucnRuEOZATiTFkdsM7_fLgxidde6clT9GB8G3q164eje8YDNZNa6CVTpwYVG2uvcb4rNP0h3rY-tQ61PZKriHLKVUhBGF7bFLp_d4vyjJqGJQRo8LjH47LlBS1Ug2U3dD5ogNnWufQ90);
        background-attachment: fixed;
        background-size: cover;
    }
</style>
@endpush

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Category Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-black uppercase mb-2">{{ $category->title }}</h1>
        @if($category->description)
        <p class="text-slate-400">{{ $category->description }}</p>
        @endif
    </div>

    <!-- Products Grid -->
    @if($products->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        @foreach($products as $product)
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
                    @if($product->sale_price && $product->sell_price)
                    <span class="text-xs text-slate-500 line-through">{{ number_format($product->sell_price) }} đ</span>
                    @endif
                    <span class="text-xl font-black text-accent-red">{{ number_format($product->getFinalPrice()) }} <span class="text-sm">đ</span></span>
                </div>
                <a href="{{ route('products.show', $product->slug) }}" class="block w-full bg-accent-red hover:bg-red-600 text-white font-bold py-2 rounded-lg text-center transition transform active:scale-95">
                    <span class="material-icons text-sm align-middle">shopping_cart</span> XEM CHI TIẾT
                </a>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $products->links() }}
    </div>
    @else
    <div class="glass-morphism rounded-xl p-12 text-center">
        <span class="material-icons text-6xl text-slate-600 mb-4">inventory_2</span>
        <p class="text-xl font-bold mb-2">Chưa có sản phẩm</p>
        <p class="text-slate-400">Danh mục này hiện chưa có sản phẩm nào</p>
    </div>
    @endif
</div>
@endsection