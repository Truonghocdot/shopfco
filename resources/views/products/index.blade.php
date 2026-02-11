@extends('layouts.app')

@section('title', 'Mua Acc FC Online - AccFCO | VanhFCO - Acc chứa FC, Acc Mở thẻ')
@section('description', 'Mua Acc chứa FC, Acc Mở thẻ, Acc đội hình, Acc chứa BP trắng tại VanhFCO. Giá rẻ, uy tín, giao dịch tự động 24/7.')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Breadcrumb -->
    <x-breadcrumb :items="[
        ['name' => 'Trang chủ', 'url' => route('home')],
        ['name' => 'Sản phẩm', 'url' => route('products.index')]
    ]" />

    <h1 class="text-3xl font-black text-primary uppercase mb-8 tracking-wider">
        Mua Acc FC Online - AccFCO
    </h1>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Filter Sidebar -->
        <aside class="lg:col-span-1">
            <div class="bg-white rounded-xl border border-gray-200 shadow-md p-6 sticky top-24">
                <h2 class="text-xl font-black mb-6 flex items-center gap-2 text-primary uppercase tracking-wide">
                    <span class="material-icons">filter_list</span>
                    Bộ lọc
                </h2>

                <form method="GET" action="{{ route('products.index') }}">
                    <!-- Category Filter -->
                    <div class="mb-6">
                        <label class="block text-sm font-bold mb-3 text-gray-500 uppercase tracking-wide">Danh mục</label>
                        <select name="category" class="w-full bg-gray-50 border border-gray-200 focus:border-primary focus:ring-primary/20 rounded-lg px-4 py-2 text-gray-800">
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
                        <label class="block text-sm font-bold mb-3 text-gray-500 uppercase tracking-wide">Khoảng giá</label>
                        <div class="flex gap-2">
                            <input type="number" name="min_price" placeholder="Từ" value="{{ request('min_price') }}" class="w-1/2 bg-gray-50 border border-gray-200 focus:border-primary rounded-lg px-3 py-2 text-gray-800 placeholder-gray-400">
                            <input type="number" name="max_price" placeholder="Đến" value="{{ request('max_price') }}" class="w-1/2 bg-gray-50 border border-gray-200 focus:border-primary rounded-lg px-3 py-2 text-gray-800 placeholder-gray-400">
                        </div>
                    </div>

                    <!-- Sort -->
                    <div class="mb-6">
                        <label class="block text-sm font-bold mb-3 text-gray-500 uppercase tracking-wide">Sắp xếp</label>
                        <select name="sort" class="w-full bg-gray-50 border border-gray-200 focus:border-primary rounded-lg px-4 py-2 text-gray-800">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Mới nhất</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Giá thấp đến cao</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Giá cao đến thấp</option>
                            <option value="discount" {{ request('sort') == 'discount' ? 'selected' : '' }}>Giảm giá nhiều</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full btn-tet py-3 rounded-lg uppercase tracking-wide text-center">
                        Áp dụng
                    </button>
                    <a href="{{ route('products.index') }}" class="block w-full text-center bg-gray-100 hover:bg-gray-200 border border-gray-200 text-gray-700 font-bold py-3 rounded-lg mt-2 transition-all uppercase tracking-wide">
                        Xóa bộ lọc
                    </a>
                </form>
            </div>
        </aside>

        <!-- Products Grid -->
        <div class="lg:col-span-3">
            @if($products->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-8">
                @foreach($products as $product)
                <div class="bg-white rounded-xl overflow-hidden border border-gray-200 shadow-sm hover:shadow-lg group transition-all hover:scale-[1.02] relative">
                    <!-- Flower decorations -->
                    <img src="{{ asset('images/hoa3.webp') }}" alt="" class="absolute -top-6 -left-6 w-40 md:w-48 opacity-90 -rotate-12 pointer-events-none z-10">
                    <img src="{{ asset('images/hoa5.png') }}" alt="" class="absolute -bottom-6 -right-6 w-36 md:w-44 opacity-90 rotate-12 pointer-events-none z-10">
                    <div class="relative overflow-hidden aspect-video">
                        <img alt="{{ $product->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" src="{{ url('storage/'.$product->images[0]) ?? 'https://via.placeholder.com/400x225' }}" loading="lazy">
                        @if($product->getDiscountPercent())
                        <div class="absolute top-2 right-2 bg-red-500 text-white text-xs md:text-sm font-black px-2 py-1 rounded-full">
                            -{{ number_format($product->getDiscountPercent()) }}%
                        </div>
                        @endif
                        <div class="absolute bottom-2 left-2 bg-white/90 px-2 py-0.5 rounded text-[10px] text-gray-600 font-bold">
                            ID: {{ $product->id }}
                        </div>
                    </div>
                    <div class="p-4">
                        <h4 class="font-bold text-sm mb-3 line-clamp-2 h-10 text-gray-800 group-hover:text-primary transition-colors">{{ $product->title }}</h4>
                        <div class="flex flex-col mb-4">
                            @if($product->sale_price && $product->sell_price)
                            <span class="text-xs text-gray-400 line-through">{{ number_format($product->sell_price) }} đ</span>
                            @endif
                            <span class="text-xl font-black text-primary">{{ number_format($product->getFinalPrice()) }} <span class="text-sm">đ</span></span>
                        </div>
                        <a href="{{ route('products.show', $product->slug) }}" class="block w-full btn-tet py-2 rounded-lg text-center text-sm uppercase tracking-wide">
                            <span class="material-icons text-sm align-middle mr-1">shopping_cart</span> XEM CHI TIẾT
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
            <div class="bg-white rounded-xl border border-gray-200 shadow-md p-12 text-center">
                <span class="material-icons text-6xl text-gray-300 mb-4">search_off</span>
                <p class="text-xl font-black mb-2 text-primary">Không tìm thấy sản phẩm</p>
                <p class="text-gray-400">Vui lòng thử lại với bộ lọc khác</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection