@extends('layouts.app')

@section('title', 'Xác nhận thanh toán - ' . $product->title)

@section('content')
<div class="max-w-4xl mx-auto relative z-10 px-4 py-8">
    <div class="mb-12 text-center relative">
        <!-- Decorative background glow - Darker for better contrast -->
        <div class="absolute -top-20 -left-20 w-64 h-64 bg-primary/5 blur-[100px] rounded-full pointer-events-none"></div>
        <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-indigo-500/5 blur-[100px] rounded-full pointer-events-none"></div>

        <h1 class="text-3xl md:text-5xl font-black uppercase tracking-tight text-white mb-3 flex justify-center items-center gap-4 relative z-10 drop-shadow-[0_2px_10px_rgba(0,0,0,0.5)]">
            <span class="material-icons text-4xl md:text-5xl text-primary drop-shadow-[0_0_15px_rgba(56,189,248,0.6)]">payments</span>
            XÁC NHẬN THANH TOÁN
        </h1>
        <div class="h-1 w-32 bg-linear-to-r from-transparent via-primary to-transparent mx-auto rounded-full mt-6 opacity-50"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Left Column: Product Info -->
        <div class="md:col-span-2 space-y-8">
            <!-- Product Details -->
            <div class="glass rounded-3xl border border-white/10 p-8 relative overflow-hidden group shadow-2xl">
                <div class="absolute top-0 right-0 p-4 opacity-10 pointer-events-none">
                    <span class="material-icons text-8xl text-white">shopping_bag</span>
                </div>

                <h2 class="text-lg font-black mb-8 flex items-center gap-3 text-white uppercase tracking-widest border-l-4 border-primary pl-4">
                    THÔNG TIN SẢN PHẨM
                </h2>

                <div class="flex flex-col sm:flex-row gap-8 relative z-10">
                    <div class="w-full sm:w-32 h-32 shrink-0 bg-slate-900/80 rounded-2xl overflow-hidden border border-white/10 shadow-inner">
                        @if($product->images[0])
                        <img src="{{ url('storage/'.$product->images[0]) }}" alt="{{ $product->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                        <div class="w-full h-full flex items-center justify-center text-slate-700 bg-slate-800">
                            <span class="material-icons text-4xl">image</span>
                        </div>
                        @endif
                    </div>
                    <div class="flex-1 flex flex-col justify-center">
                        <h3 class="font-black text-xl mb-3 text-white leading-tight tracking-tight group-hover:text-primary transition-colors">{{ $product->title }}</h3>
                        <div class="flex flex-wrap items-center gap-4">
                            <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest flex items-center gap-2 bg-white/5 px-3 py-1.5 rounded-full border border-white/5">
                                <span class="w-1.5 h-1.5 bg-primary rounded-full animate-pulse"></span>
                                {{ $product->category->title ?? 'N/A' }}
                            </p>
                            <span class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">Mã: #{{ $product->id }}</span>
                        </div>
                        <div class="mt-6 flex items-baseline gap-3">
                            <span class="text-3xl font-black text-primary drop-shadow-[0_0_12px_rgba(56,189,248,0.4)] tracking-tighter">{{ number_format($product->getFinalPrice()) }}đ</span>
                            @if($product->sale_price && $product->sale_price < $product->sell_price)
                                <span class="text-sm text-slate-500 line-through font-bold opacity-50">{{ number_format($product->sell_price) }}đ</span>
                                @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Wallet Info -->
            <div class="glass rounded-3xl border border-white/10 p-8 relative overflow-hidden group shadow-2xl">
                <div class="absolute top-0 right-0 p-4 opacity-10 pointer-events-none">
                    <span class="material-icons text-8xl text-white">wallet</span>
                </div>

                <h2 class="text-lg font-black mb-8 flex items-center gap-3 text-white uppercase tracking-widest border-l-4 border-indigo-500 pl-4">
                    THÔNG TIN VÍ
                </h2>

                <div class="flex flex-col sm:flex-row items-center justify-between bg-white/5 backdrop-blur-xl p-8 rounded-2xl border border-white/10 group-hover:border-primary/30 transition-all duration-500">
                    <div class="flex items-center gap-5 mb-6 sm:mb-0">
                        <div class="w-16 h-16 rounded-2xl bg-indigo-500/10 flex items-center justify-center text-indigo-400 border border-indigo-500/20 shadow-lg">
                            <span class="material-icons text-3xl">account_balance_wallet</span>
                        </div>
                        <div>
                            <p class="text-[10px] text-slate-500 font-black uppercase tracking-widest mb-1.5">Số dư hiện tại</p>
                            <p class="font-black text-3xl tracking-tight {{ $wallet->balance < $product->getFinalPrice() ? 'text-pink-500 drop-shadow-[0_0_10px_rgba(236,72,153,0.4)]' : 'text-emerald-400 drop-shadow-[0_0_10px_rgba(52,211,153,0.4)]' }}">
                                {{ number_format($wallet->balance) }}đ
                            </p>
                        </div>
                    </div>

                    @if($wallet->balance < $product->getFinalPrice())
                        <a href="{{ route('deposit') }}" class="w-full sm:w-auto px-10 py-4 btn-esport rounded-2xl font-black text-xs uppercase tracking-[0.2em] shadow-2xl active:scale-95 transition-all text-center">
                            NẠP THÊM TIỀN
                        </a>
                        @else
                        <div class="hidden sm:flex items-center gap-2 text-emerald-400/50 text-[10px] font-black uppercase tracking-widest">
                            <span class="material-icons text-sm">check_circle</span>
                            Đủ số dư thanh toán
                        </div>
                        @endif
                </div>
            </div>
        </div>

        <!-- Right Column: Order Summary -->
        <div class="md:col-span-1">
            <div class="glass rounded-[2rem] border border-white/10 p-8 sticky top-24 shadow-3xl overflow-hidden group">
                <!-- Inner glow -->
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-primary/5 blur-3xl rounded-full group-hover:bg-primary/10 transition-colors"></div>

                <h2 class="text-xl font-black mb-10 text-white uppercase tracking-tighter flex items-center gap-2">
                    <span class="w-2 h-2 bg-primary rounded-full animate-ping"></span>
                    TỔNG ĐƠN HÀNG
                </h2>

                <!-- Coupon Input -->
                <div class="mb-10">
                    <label class="block text-[10px] font-black text-slate-500 mb-4 uppercase tracking-[0.2em]">MÃ GIẢM GIÁ</label>
                    <div class="flex gap-2">
                        <input type="text" id="coupon_code" class="flex-1 bg-slate-900/80 border border-white/10 focus:border-primary focus:ring-4 focus:ring-primary/10 rounded-2xl px-5 py-4 text-slate-100 text-sm outline-hidden placeholder-slate-700 transition-all font-bold tracking-tight shadow-inner" placeholder="PST-888...">
                        <button type="button" id="apply_coupon" class="px-5 py-4 bg-white/5 hover:bg-white/10 text-white border border-white/10 rounded-2xl text-[10px] font-black transition-all uppercase tracking-widest active:scale-95">
                            DÙNG
                        </button>
                    </div>
                    <p id="coupon_message" class="text-[10px] font-black mt-3 hidden uppercase tracking-widest"></p>
                </div>

                <div class="space-y-4 pt-8 border-t border-white/5">
                    <div class="flex justify-between text-xs font-bold tracking-tight">
                        <span class="text-slate-500 uppercase">TẠM TÍNH</span>
                        <span class="text-slate-300">{{ number_format($product->getFinalPrice()) }}đ</span>
                    </div>
                    <div class="flex justify-between items-center text-[10px] font-black text-emerald-400 bg-emerald-500/5 px-3 py-2 rounded-lg border border-emerald-500/10" id="discount_row" style="display: none;">
                        <span class="uppercase tracking-widest">GIẢM GIÁ</span>
                        <span class="text-sm">-<span id="discount_amount">0</span>đ</span>
                    </div>
                    <div class="flex flex-col gap-1 text-sm font-black pt-8 mt-4 border-t border-white/5">
                        <span class="text-[10px] text-slate-500 uppercase tracking-[0.3em] text-center mb-1">TỔNG THANH TOÁN</span>
                        <span class="text-primary text-4xl text-center drop-shadow-[0_0_15px_rgba(56,189,248,0.5)] tracking-tighter italic" id="final_total">{{ number_format($product->getFinalPrice()) }}đ</span>
                    </div>
                </div>

                <form action="{{ route('purchase.process') }}" method="POST" class="mt-10">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="coupon_code" id="form_coupon_code">

                    <button type="submit"
                        class="w-full py-6 rounded-2xl font-black text-white shadow-2xl transition-all transform active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed uppercase tracking-[0.2em] text-sm border-none shadow-primary/20
                            {{ $wallet->balance < $product->getFinalPrice() ? 'bg-slate-800 text-slate-600 grayscale cursor-not-allowed' : 'btn-esport' }}"
                        {{ $wallet->balance < $product->getFinalPrice() ? 'disabled' : '' }}>
                        {{ $wallet->balance < $product->getFinalPrice() ? 'SỐ DƯ KHÔNG ĐỦ' : 'THANH TOÁN NGAY' }}
                    </button>
                </form>

                <p class="text-[9px] text-slate-600 font-bold text-center mt-8 leading-loose uppercase tracking-[0.1em] max-w-[200px] mx-auto">
                    Xác nhận đồng ý với <a href="{{ route('policy') }}" class="text-primary hover:text-white transition-colors underline underline-offset-4">điều khoản dịch vụ</a>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const applyBtn = document.getElementById('apply_coupon');
        const couponInput = document.getElementById('coupon_code');
        const couponMessage = document.getElementById('coupon_message');
        const discountRow = document.getElementById('discount_row');
        const discountAmountSpan = document.getElementById('discount_amount');
        const finalTotalSpan = document.getElementById('final_total');
        const formCouponCode = document.getElementById('form_coupon_code');

        // Fix syntax: Blade expressions should be wrapped in strings for JS compatibility
        const originalPrice = parseInt("{{ $product->getFinalPrice() }}");

        applyBtn.addEventListener('click', function() {
            const code = couponInput.value.trim();
            if (!code) return;

            applyBtn.disabled = true;
            applyBtn.innerHTML = '<span class="material-icons animate-spin text-[14px]">refresh</span>';

            fetch('{{ route("purchase.validate-coupon") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        code: code,
                        amount: originalPrice
                    })
                })
                .then(response => response.json())
                .then(data => {
                    applyBtn.disabled = false;
                    applyBtn.textContent = 'DÙNG';

                    couponMessage.textContent = data.message;
                    couponMessage.classList.remove('hidden', 'text-green-500', 'text-pink-500');

                    if (data.valid) {
                        couponMessage.classList.add('text-green-500');
                        discountRow.style.display = 'flex';
                        discountAmountSpan.textContent = new Intl.NumberFormat('vi-VN').format(data.discount);
                        finalTotalSpan.textContent = new Intl.NumberFormat('vi-VN').format(data.final_amount) + 'đ';
                        formCouponCode.value = code;
                    } else {
                        couponMessage.classList.add('text-pink-500');
                        discountRow.style.display = 'none';
                        finalTotalSpan.textContent = new Intl.NumberFormat('vi-VN').format(originalPrice) + 'đ';
                        formCouponCode.value = '';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    applyBtn.disabled = false;
                    applyBtn.textContent = 'DÙNG';
                    couponMessage.textContent = 'CÓ LỖI XẢY RA';
                    couponMessage.classList.remove('hidden');
                    couponMessage.classList.add('text-pink-500');
                });
        });
    });
</script>
@endsection