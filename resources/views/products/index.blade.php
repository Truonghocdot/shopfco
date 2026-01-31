@extends('layouts.app')

@section('title', 'Danh sách sản phẩm - VanhFCO')
@section('description', 'Tìm kiếm và mua tài khoản FC Online uy tín với giá tốt nhất.')

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
    <h1 class="text-3xl font-black text-white uppercase mb-8">Tất cả sản phẩm</h1>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Filter Sidebar -->
        <aside class="lg:col-span-1">
            <div class="glass-morphism rounded-xl p-6 sticky top-24">
                <h2 class="text-xl font-bold mb-6 flex items-center gap-2">
                    <span class="material-icons text-primary">filter_list</span>
                    Bộ lọc
                </h2>

                <form method="GET" action="{{ route('products.index') }}">
                    <!-- Category Filter -->
                    <div class="mb-6">
                        <label class="block text-sm font-bold mb-3">Danh mục</label>
                        <select name="category" class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-white">
                            <option value="">Tất cả danh mục</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->title }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Price Range -->
                    <div class="mb-6">
                        <label class="block text-sm font-bold mb-3">Khoảng giá</label>
                        <div class="flex gap-2">
                            <input type="number" name="min_price" placeholder="Từ" value="{{ request('min_price') }}" class="w-1/2 bg-slate-800 border border-slate-700 rounded-lg px-3 py-2 text-white">
                            <input type="number" name="max_price" placeholder="Đến" value="{{ request('max_price') }}" class="w-1/2 bg-slate-800 border border-slate-700 rounded-lg px-3 py-2 text-white">
                        </div>
                    </div>

                    <!-- Sort -->
                    <div class="mb-6">
                        <label class="block text-sm font-bold mb-3">Sắp xếp</label>
                        <select name="sort" class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-white">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Mới nhất</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Giá thấp đến cao</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Giá cao đến thấp</option>
                            <option value="discount" {{ request('sort') == 'discount' ? 'selected' : '' }}>Giảm giá nhiều</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full bg-primary hover:bg-primary/80 text-black font-bold py-3 rounded-lg transition">
                        Áp dụng
                    </button>
                    <a href="{{ route('products.index') }}" class="block w-full text-center bg-slate-700 hover:bg-slate-600 text-white font-bold py-3 rounded-lg mt-2 transition">
                        Xóa bộ lọc
                    </a>
                </form>
            </div>
        </aside>

        <!-- Products Grid -->
        <div class="lg:col-span-3">
            @if($products->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">
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
                <span class="material-icons text-6xl text-slate-600 mb-4">search_off</span>
                <p class="text-xl font-bold mb-2">Không tìm thấy sản phẩm</p>
                <p class="text-slate-400">Vui lòng thử lại với bộ lọc khác</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection