@extends('layouts.app')

@section('title', 'Mua Acc FC Online - AccFCO | VanhFCO - Acc chứa FC, Acc Mở thẻ')
@section('description', 'Mua Acc chứa FC, Acc Mở thẻ, Acc đội hình, Acc chứa BP trắng tại VanhFCO. Giá rẻ, uy tín, giao dịch tự động 24/7.')

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
    <!-- Breadcrumb -->
    <x-breadcrumb :items="[
        ['name' => 'Trang chủ', 'url' => route('home')],
        ['name' => 'Sản phẩm', 'url' => route('products.index')]
    ]" />

    <h1 class="text-4xl font-black text-primary uppercase mb-8 drop-shadow-[0_0_20px_rgba(0,255,0,0.8)] tracking-wider">
        Mua Acc FC Online - AccFCO
    </h1>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Filter Sidebar - Techno Style -->
        <aside class="lg:col-span-1">
            <div class="relative bg-gradient-to-br from-black via-[#001a0f] to-black border-2 border-primary/30 rounded-xl shadow-[0_0_30px_rgba(0,255,0,0.2)] p-6 sticky top-24 overflow-hidden">
                <!-- Grid Pattern -->
                <div class="absolute inset-0 opacity-10 pointer-events-none">
                    <div class="absolute inset-0" style="background-image: repeating-linear-gradient(90deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px), repeating-linear-gradient(0deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px);"></div>
                </div>

                <h2 class="text-xl font-black mb-6 flex items-center gap-2 text-primary drop-shadow-[0_0_10px_rgba(0,255,0,0.8)] relative z-10 uppercase tracking-wide">
                    <span class="material-icons">filter_list</span>
                    Bộ lọc
                </h2>

                <form method="GET" action="{{ route('products.index') }}" class="relative z-10">
                    <!-- Category Filter with Hierarchy -->
                    <div class="mb-6">
                        <label class="block text-sm font-bold mb-3 text-slate-400 uppercase tracking-wide">Danh mục</label>
                        <select name="category" class="w-full bg-black/40 border-2 border-slate-700 focus:border-primary rounded-lg px-4 py-2 text-white">
                            <option value="">Tất cả danh mục</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->title }}
                            </option>
                            @if($cat->children->count() > 0)
                            @foreach($cat->children as $child)
                            <option value="{{ $child->id }}" {{ request('category') == $child->id ? 'selected' : '' }}>
                                &nbsp;&nbsp;&nbsp;↳ {{ $child->title }}
                            </option>
                            @endforeach
                            @endif
                            @endforeach
                        </select>
                    </div>

                    <!-- Price Range -->
                    <div class="mb-6">
                        <label class="block text-sm font-bold mb-3 text-slate-400 uppercase tracking-wide">Khoảng giá</label>
                        <div class="flex gap-2">
                            <input type="number" name="min_price" placeholder="Từ" value="{{ request('min_price') }}" class="w-1/2 bg-black/40 border-2 border-slate-700 focus:border-primary rounded-lg px-3 py-2 text-white placeholder-slate-600">
                            <input type="number" name="max_price" placeholder="Đến" value="{{ request('max_price') }}" class="w-1/2 bg-black/40 border-2 border-slate-700 focus:border-primary rounded-lg px-3 py-2 text-white placeholder-slate-600">
                        </div>
                    </div>

                    <!-- Sort -->
                    <div class="mb-6">
                        <label class="block text-sm font-bold mb-3 text-slate-400 uppercase tracking-wide">Sắp xếp</label>
                        <select name="sort" class="w-full bg-black/40 border-2 border-slate-700 focus:border-primary rounded-lg px-4 py-2 text-white">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Mới nhất</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Giá thấp đến cao</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Giá cao đến thấp</option>
                            <option value="discount" {{ request('sort') == 'discount' ? 'selected' : '' }}>Giảm giá nhiều</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-primary to-green-400 hover:from-green-400 hover:to-primary text-black font-black py-3 rounded-lg transition-all shadow-[0_0_20px_rgba(0,255,0,0.4)] hover:shadow-[0_0_30px_rgba(0,255,0,0.6)] border-2 border-primary/50 uppercase tracking-wide">
                        Áp dụng
                    </button>
                    <a href="{{ route('products.index') }}" class="block w-full text-center bg-black/60 border-2 border-slate-700 hover:border-red-500 text-white font-bold py-3 rounded-lg mt-2 transition-all hover:shadow-[0_0_20px_rgba(239,68,68,0.3)] uppercase tracking-wide">
                        Xóa bộ lọc
                    </a>
                </form>
            </div>
        </aside>

        <!-- Products Grid - Techno Style -->
        <div class="lg:col-span-3">
            @if($products->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-8">
                @foreach($products as $product)
                <div class="relative bg-gradient-to-br from-black via-[#001a0f] to-black border-2 border-slate-700 hover:border-primary rounded-xl overflow-hidden group transition-all hover:shadow-[0_0_30px_rgba(0,255,0,0.3)] hover:scale-[1.02]">
                    <!-- Grid Pattern -->
                    <div class="absolute inset-0 opacity-0 group-hover:opacity-10 pointer-events-none transition-opacity">
                        <div class="absolute inset-0" style="background-image: repeating-linear-gradient(90deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px), repeating-linear-gradient(0deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px);"></div>
                    </div>

                    <div class="relative overflow-hidden aspect-video">
                        <img alt="{{ $product->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" src="{{ url('storage/'.$product->images[0]) ?? 'https://via.placeholder.com/400x225' }}" loading="lazy">
                        @if($product->getDiscountPercent())
                        <div class="absolute top-2 right-2 bg-gradient-to-r from-red-600 to-red-500 text-white text-2xl font-black px-3 py-1 rounded-full shadow-[0_0_15px_rgba(239,68,68,0.6)] border border-red-400">
                            -{{ number_format($product->getDiscountPercent()) }}%
                        </div>
                        @endif
                        <div class="absolute bottom-2 left-2 bg-black/70 backdrop-blur-sm border border-primary/30 px-2 py-0.5 rounded text-[10px] text-primary font-bold shadow-[0_0_10px_rgba(0,255,0,0.3)]">
                            ID: {{ $product->id }}
                        </div>
                    </div>
                    <div class="p-4 relative z-10">
                        <h4 class="font-bold text-sm mb-3 line-clamp-2 h-10 text-white group-hover:text-primary transition-colors">{{ $product->title }}</h4>
                        <div class="flex flex-col mb-4">
                            @if($product->sale_price && $product->sell_price)
                            <span class="text-xs text-slate-600 line-through">{{ number_format($product->sell_price) }} đ</span>
                            @endif
                            <span class="text-xl font-black text-primary drop-shadow-[0_0_10px_rgba(0,255,0,0.8)]">{{ number_format($product->getFinalPrice()) }} <span class="text-sm">đ</span></span>
                        </div>
                        <a href="{{ route('products.show', $product->slug) }}" class="block w-full bg-gradient-to-r from-red-600 to-red-500 hover:from-red-500 hover:to-red-600 text-white font-black py-2 rounded-lg text-center transition-all transform active:scale-95 shadow-[0_0_15px_rgba(239,68,68,0.4)] hover:shadow-[0_0_25px_rgba(239,68,68,0.6)] border-2 border-red-400 uppercase tracking-wide">
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
            <div class="relative bg-gradient-to-br from-black via-[#001a0f] to-black border-2 border-primary/30 rounded-xl shadow-[0_0_30px_rgba(0,255,0,0.2)] p-12 text-center overflow-hidden">
                <!-- Grid Pattern -->
                <div class="absolute inset-0 opacity-10 pointer-events-none">
                    <div class="absolute inset-0" style="background-image: repeating-linear-gradient(90deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px), repeating-linear-gradient(0deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px);"></div>
                </div>

                <span class="material-icons text-6xl text-slate-700 mb-4 drop-shadow-[0_0_10px_rgba(0,255,0,0.3)] relative z-10">search_off</span>
                <p class="text-xl font-black mb-2 text-primary drop-shadow-[0_0_10px_rgba(0,255,0,0.8)] relative z-10">Không tìm thấy sản phẩm</p>
                <p class="text-slate-500 relative z-10">Vui lòng thử lại với bộ lọc khác</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection