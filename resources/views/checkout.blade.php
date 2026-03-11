@section('title', 'Xác nhận thanh toán - ' . $product->title)

@section('content')
<div class="max-w-4xl mx-auto relative z-10">
    <div class="mb-12 text-center relative">
        <!-- Decorative background glow -->
        <div class="absolute -top-20 -left-20 w-64 h-64 bg-primary/10 blur-[100px] rounded-full pointer-events-none"></div>
        <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-indigo-500/10 blur-[100px] rounded-full pointer-events-none"></div>

        <h1 class="text-3xl md:text-5xl font-black uppercase tracking-tight text-white mb-3 flex justify-center items-center gap-4 relative z-10">
            <span class="material-icons text-4xl md:text-5xl text-primary drop-shadow-[0_0_10px_rgba(56,189,248,0.5)]">payments</span>
            XÁC NHẬN THANH TOÁN
        </h1>
        <div class="h-1 w-32 bg-linear-to-r from-transparent via-primary to-transparent mx-auto rounded-full mt-8"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Left Column: Product Info -->
        <div class="md:col-span-2 space-y-6">
            <!-- Product Details -->
            <div class="glass rounded-2xl border border-white/10 p-8 relative overflow-hidden group shadow-2xl">
                <h2 class="text-xl font-black mb-8 flex items-center gap-3 text-white uppercase tracking-tighter">
                    <span class="material-icons text-primary">shopping_bag</span>
                    THÔNG TIN SẢN PHẨM
                </h2>

                <div class="flex gap-6">
                    <div class="w-28 h-28 shrink-0 bg-slate-900/50 rounded-xl overflow-hidden border border-white/5">
                        @if($product->images[0])
                        <img src="{{ url('storage/'.$product->images[0]) }}" alt="{{ $product->title }}" class="w-full h-full object-cover">
                        @else
                        <div class="w-full h-full flex items-center justify-center text-slate-700">
                            <span class="material-icons text-4xl">image</span>
                        </div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <h3 class="font-black text-lg mb-2 text-white leading-tight">{{ $product->title }}</h3>
                        <p class="text-[10px] text-slate-500 mb-4 font-black uppercase tracking-widest flex items-center gap-2">
                            <span class="w-1 h-3 bg-primary rounded-full"></span>
                            DANH MỤC: {{ $product->category->title ?? 'N/A' }}
                        </p>
                        <div class="flex items-center gap-3">
                            <span class="text-2xl font-black text-primary drop-shadow-[0_0_8px_rgba(56,189,248,0.4)]">{{ number_format($product->getFinalPrice()) }}đ</span>
                            @if($product->sale_price && $product->sale_price < $product->sell_price)
                                <span class="text-xs text-slate-500 line-through font-bold">{{ number_format($product->sell_price) }}đ</span>
                                @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Wallet Info -->
            <div class="glass rounded-2xl border border-white/10 p-8 relative overflow-hidden group shadow-2xl">
                <h2 class="text-xl font-black mb-8 flex items-center gap-3 text-white uppercase tracking-tighter">
                    <span class="material-icons text-primary">account_balance_wallet</span>
                    THÔNG TIN VÍ
                </h2>

                <div class="flex items-center justify-between bg-white/5 backdrop-blur-md p-6 rounded-2xl border border-white/5">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary border border-primary/20">
                            <span class="material-icons">wallet</span>
                        </div>
                        <div>
                            <p class="text-[10px] text-slate-500 font-black uppercase tracking-widest mb-1">Số dư hiện tại</p>
                            <p class="font-black text-2xl {{ $wallet->balance < $product->getFinalPrice() ? 'text-pink-500 shadow-pink-500/10' : 'text-emerald-400 drop-shadow-[0_0_8px_rgba(52,211,153,0.3)]' }}">
                                {{ number_format($wallet->balance) }}đ
                            </p>
                        </div>
                    </div>

                    @if($wallet->balance < $product->getFinalPrice())
                        <a href="{{ route('deposit') }}" class="px-8 py-3.5 btn-esport rounded-xl font-black text-xs uppercase tracking-widest shadow-lg shadow-primary/20 border-none transition-all active:scale-95">
                            NẠP THÊM TIỀN
                        </a>
                        @endif
                </div>
            </div>
        </div>

        <!-- Right Column: Order Summary -->
        <div class="md:col-span-1">
            <div class="glass rounded-3xl border border-white/10 p-8 sticky top-24 shadow-3xl overflow-hidden">
                <h2 class="text-xl font-black mb-8 text-white uppercase tracking-tighter">TỔNG ĐƠN HÀNG</h2>

                <!-- Coupon Input -->
                <div class="mb-8">
                    <label class="block text-[10px] font-black text-slate-500 mb-3 uppercase tracking-widest">MÃ GIẢM GIÁ</label>
                    <div class="flex gap-2">
                        <input type="text" id="coupon_code" class="flex-1 bg-slate-900/50 border border-white/10 focus:border-primary focus:ring-primary/20 rounded-xl px-4 py-3 text-slate-200 text-sm outline-hidden placeholder-slate-600 transition-all font-bold" placeholder="NHẬP MÃ...">
                        <button type="button" id="apply_coupon" class="px-4 py-3 bg-white/10 hover:bg-white/20 text-white rounded-xl text-xs font-black transition-all uppercase tracking-widest">
                            ÁP DỤNG
                        </button>
                    </div>
                    <p id="coupon_message" class="text-[10px] font-black mt-2 hidden uppercase tracking-widest"></p>
                </div>

                <div class="space-y-4 pt-6 border-t border-white/5">
                    <div class="flex justify-between text-xs font-bold">
                        <span class="text-slate-500">TẠM TÍNH</span>
                        <span class="text-slate-200">{{ number_format($product->getFinalPrice()) }}đ</span>
                    </div>
                    <div class="flex justify-between text-xs font-bold text-emerald-400" id="discount_row" style="display: none;">
                        <span>GIẢM GIÁ</span>
                        <span>-<span id="discount_amount">0</span>đ</span>
                    </div>
                    <div class="flex justify-between items-center text-sm font-black pt-5 border-t border-white/5">
                        <span class="text-slate-400">TỔNG THANH TOÁN</span>
                        <span class="text-primary text-2xl drop-shadow-[0_0_10px_rgba(56,189,248,0.4)]" id="final_total">{{ number_format($product->getFinalPrice()) }}đ</span>
                    </div>
                </div>

                <form action="{{ route('purchase.process') }}" method="POST" class="mt-8">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="coupon_code" id="form_coupon_code">

                    <button type="submit"
                        class="w-full py-5 rounded-2xl font-black text-white shadow-2xl transition-all transform active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed uppercase tracking-widest text-sm border-none
                            {{ $wallet->balance < $product->getFinalPrice() ? 'bg-slate-700 text-slate-500 cursor-not-allowed' : 'btn-esport shadow-primary/20' }}"
                        {{ $wallet->balance < $product->getFinalPrice() ? 'disabled' : '' }}>
                        {{ $wallet->balance < $product->getFinalPrice() ? 'SỐ DƯ KHÔNG ĐỦ' : 'XÁC NHẬN THANH TOÁN' }}
                    </button>
                </form>

                <p class="text-[10px] text-slate-500 font-bold text-center mt-6 leading-relaxed uppercase tracking-widest">
                    Bằng việc xác nhận thanh toán, bạn đồng ý với <a href="{{ route('policy') }}" class="text-primary hover:underline">điều khoản dịch vụ</a> của chúng tôi.
                </p>
            </div>
        </div>
    </div>
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

        const originalPrice = {
            {
                $product - > getFinalPrice()
            }
        };

        applyBtn.addEventListener('click', function() {
            const code = couponInput.value.trim();
            if (!code) return;

            applyBtn.disabled = true;
            applyBtn.innerHTML = '<span class="material-icons animate-spin text-sm">refresh</span>';

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
                    applyBtn.textContent = 'Áp dụng';

                    couponMessage.textContent = data.message;
                    couponMessage.classList.remove('hidden', 'text-green-500', 'text-red-500');

                    if (data.valid) {
                        couponMessage.classList.add('text-green-500');

                        // Update UI
                        discountRow.style.display = 'flex';
                        discountAmountSpan.textContent = new Intl.NumberFormat('vi-VN').format(data.discount);
                        finalTotalSpan.textContent = new Intl.NumberFormat('vi-VN').format(data.final_amount) + 'đ';

                        // Update form input
                        formCouponCode.value = code;

                        // Disable input to prevent changes (optional UX choice)
                        // couponInput.disabled = true;
                        // applyBtn.textContent = 'Đã áp dụng';
                    } else {
                        couponMessage.classList.add('text-red-500');

                        // Reset UI
                        discountRow.style.display = 'none';
                        finalTotalSpan.textContent = new Intl.NumberFormat('vi-VN').format(originalPrice) + 'đ';
                        formCouponCode.value = '';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    applyBtn.disabled = false;
                    applyBtn.textContent = 'Áp dụng';
                    couponMessage.textContent = 'Có lỗi xảy ra, vui lòng thử lại';
                    couponMessage.classList.remove('hidden');
                    couponMessage.classList.add('text-red-500');
                });
        });
    });
</script>
@endsection