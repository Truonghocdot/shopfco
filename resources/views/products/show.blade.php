@extends('layouts.app')

@section('title', 'Chi tiết tài khoản - VanhFCO')
@section('description', 'Xem chi tiết tài khoản FC Online với đầy đủ thông tin và hình ảnh.')

@push('styles')
<style>
    body {
        background-image: linear-gradient(rgba(15, 23, 42, 0.9), rgba(15, 23, 42, 0.9)), url(https://lh3.googleusercontent.com/aida-public/AB6AXuDW1WcO7Y7wZWIBl4e-HaZLN46wpoguwJeKUoWVcs_tb-UETIX1KPQMvG_vDfLSy6mraVeWzxr4IopIWsiwa3cT1B44T-buDp09zVUL2F0oT53CnMz1rEMRNR0EDfMH2SuLvSRWcPPsYh12z0YpWXIqOnycyTAhshhwcMGwqz5ybu2xnZ_ACUImmr7pmEBin5pajCBp8HFJ0xXxWkp7L90Qvx9_wnNa70tUwFnVjZb8vlHRs33VBwhn9DiKCSFDTo2g9uEJwhCCEmZF);
        background-size: cover;
        background-attachment: fixed;
        background-position: center;
    }
</style>
@endpush

@push('schema')
<script type="application/ld+json">
{
    "@context": "https://schema.org/",
    "@type": "Product",
    "name": "{{ $product->title }}",
    "image": [
        @foreach($product->images as $image)
        "{{ url('storage/'.$image) }}"{{ !$loop->last ? ',' : '' }}
        @endforeach
    ],
    "description": "{{ strip_tags($product->content) ?? $product->title }}",
    "sku": "{{ $product->id }}",
    "brand": {
        "@type": "Brand",
        "name": "FC Online"
    },
    "offers": {
        "@type": "Offer",
        "url": "{{ route('products.show', $product->slug) }}",
        "priceCurrency": "VND",
        "price": "{{ $product->getFinalPrice() }}",
        "availability": "{{ $product->isUnsold() ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock' }}",
        "itemCondition": "https://schema.org/UsedCondition"
    }
}
</script>
@endpush

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Breadcrumb -->
    <nav class="flex mb-6 text-sm font-medium text-slate-500 dark:text-slate-400 overflow-x-auto whitespace-nowrap pb-2">
        <a class="hover:text-primary-red flex items-center" href="{{ route('home') }}">
            <span class="material-icons text-sm mr-1">home</span> Trang chủ
        </a>
        <span class="mx-2">/</span>
        <a class="hover:text-primary-red" href="#">ACC đội hình FC Online</a>
        <span class="mx-2">/</span>
        <span class="text-slate-900 dark:text-white font-semibold">ID #{{ $product->id }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Product Images -->
        <div class="lg:col-span-7 space-y-6">
            <div class="bg-white dark:bg-card-dark rounded-2xl overflow-hidden shadow-2xl border border-slate-200 dark:border-slate-800">
                <div class="relative aspect-video group">
                    <img alt="{{ $product->title }}" class="w-full h-full object-cover" src="{{ url('storage/'.$product->images[0] ?? '') }}" loading="lazy">
                    <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-all pointer-events-none"></div>
                </div>
            </div>

            <!-- Product Info -->
            <div class="bg-white dark:bg-card-dark rounded-2xl p-6 shadow-xl border border-slate-200 dark:border-slate-800">
                <h1 class="text-xl md:text-2xl font-bold mb-4">Liverpool 1.106.570b có Owen ITM+5, Isak 25TS, Wirtz 25TS...</h1>
                <div class="flex flex-wrap items-center justify-between gap-6 py-6 border-y border-slate-100 dark:border-slate-800">
                    <div class="space-y-1">
                        <span class="text-slate-500 line-through text-lg">4,230,000đ</span>
                        <div class="flex items-baseline gap-2">
                            <span class="text-3xl md:text-4xl font-extrabold text-primary-red">1,184,400đ</span>
                            <span class="bg-primary-red/10 text-primary-red text-xs font-bold px-2 py-1 rounded">GIẢM 72%</span>
                        </div>
                    </div>
                    <div class="flex flex-col items-end">
                        <span class="text-sm text-accent-success font-medium flex items-center gap-1 mb-2">
                            <span class="material-icons text-sm">savings</span> Tiết kiệm {{ number_format($product->sell_price - $product->getFinalPrice()) }}đ
                        </span>
                        @auth
                        <a href="{{ route('checkout', $product->slug) }}" class="w-full sm:w-auto bg-primary-red hover:bg-red-600 text-white font-bold py-4 px-12 rounded-xl flex items-center justify-center gap-3 transition-all transform hover:scale-[1.02] shadow-lg shadow-primary-red/20">
                            <span class="material-icons">shopping_cart</span>
                            MUA NGAY
                        </a>
                        @else
                        <a href="{{ route('login') }}" class="w-full sm:w-auto bg-primary-red hover:bg-red-600 text-white font-bold py-4 px-12 rounded-xl flex items-center justify-center gap-3 transition-all transform hover:scale-[1.02] shadow-lg shadow-primary-red/20">
                            <span class="material-icons">login</span>
                            ĐĂNG NHẬP ĐỂ MUA
                        </a>
                        @endauth
                    </div>
                </div>
                <div class="mt-6 flex items-center justify-between text-slate-500 dark:text-slate-400 text-sm">
                    <div class="flex items-center gap-4">
                        <span class="flex items-center gap-1"><span class="material-icons text-sm">visibility</span> 1,245 lượt xem</span>
                        <span class="flex items-center gap-1"><span class="material-icons text-sm">schedule</span> Đăng {{ $product->created_at->diffForHumans() }}</span>
                    </div>
                    <span class="font-bold text-slate-900 dark:text-white">Mã ID: #{{ $product->id }}</span>
                </div>
            </div>
        </div>

        <!-- Product Details -->
        <div class="lg:col-span-5 space-y-6">
            <div class="bg-white dark:bg-card-dark rounded-2xl p-8 shadow-xl border border-slate-200 dark:border-slate-800 h-full">
                <div class="flex items-center gap-2 mb-6">
                    <span class="material-icons text-primary-red">info</span>
                    <h2 class="text-xl font-bold">Giới thiệu tài khoản</h2>
                </div>
                <div class="prose prose-slate dark:prose-invert max-w-none space-y-4">
                    <div class="bg-slate-50 dark:bg-slate-900/40 p-4 rounded-xl border-l-4 border-primary-red">
                        <p class="font-medium text-slate-900 dark:text-white m-0">
                            ACC FC Online team Liverpool 1.106.570b có:
                        </p>
                        <p class="text-slate-600 dark:text-slate-300 m-0 mt-2">
                            Owen ITM+5, Isak 25TS, Wirtz 25TS, Gravenberch ITM+5, Szoboszlai 23HW, Endo 23HW+9, Arnold 23HW... HLV tạm
                        </p>
                    </div>
                    <div class="space-y-4 pt-4">
                        <h3 class="text-lg font-bold flex items-center gap-2">
                            <span class="material-icons text-accent-success">verified_user</span>
                            Cam kết & Điều khoản
                        </h3>
                        <ol class="list-decimal list-inside space-y-3 text-slate-600 dark:text-slate-300">
                            <li class="leading-relaxed">SĐT của shop sau 23/02 đổi được (tới hạn đổi SĐT Quý khách vui lòng liên hệ shop để lấy code thay đổi SĐT).</li>
                            <li class="leading-relaxed">Tài khoản sạch, không tranh chấp, bảo hành trọn đời.</li>
                            <li class="leading-relaxed">Hỗ trợ giao dịch trung gian hoặc trực tiếp tại cửa hàng.</li>
                            <li class="leading-relaxed">Số CCCD của shop, bảo hành trọn đời ACC.</li>
                        </ol>
                    </div>
                    <div class="mt-8 grid grid-cols-2 gap-4">
                        <div class="p-4 bg-slate-50 dark:bg-slate-900/40 rounded-xl text-center">
                            <p class="text-xs text-slate-500 uppercase font-bold mb-1">Giá trị đội hình</p>
                            <p class="text-lg font-bold text-primary-red">1.106 Tỷ</p>
                        </div>
                        <div class="p-4 bg-slate-50 dark:bg-slate-900/40 rounded-xl text-center">
                            <p class="text-xs text-slate-500 uppercase font-bold mb-1">Mức Rank</p>
                            <p class="text-lg font-bold text-accent-success">Thách Đấu</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script type="application/ld+json">
    {
        "@@context": "https://schema.org/",
        "@@type": "Product",
        "name": "{{ $product->title }}",
        "image": [
            "{{ url('storage/'.$product->images[0] ?? '') }}"
        ],
        "description": "{{ $product->description ?? $product->title }}",
        "sku": "{{ $product->id }}",
        "brand": {
            "@@type": "Brand",
            "name": "FC Online"
        },
        "offers": {
            "@@type": "Offer",
            "url": "{{ route('products.show', $product->slug) }}",
            "priceCurrency": "VND",
            "price": "{{ $product->getFinalPrice() }}",
            "availability": "{{ $product->isUnsold() ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock' }}",
            "itemCondition": "https://schema.org/UsedCondition"
        }
    }
</script>
@endsection