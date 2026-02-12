@section('title', 'Xác nhận thanh toán - ' . $product->title)

@section('content')
<div class="container mx-auto px-4 py-8 relative overflow-hidden">
    <!-- Floating decorations -->
    <img src="{{ asset('images/hoa1.webp') }}" class="absolute top-20 -left-10 w-44 opacity-20 -rotate-45 pointer-events-none animate-shake">
    <img src="{{ asset('images/hoa3.webp') }}" class="absolute bottom-20 -right-10 w-44 opacity-20 rotate-45 pointer-events-none animate-shake">

    <div class="max-w-4xl mx-auto relative z-10">
        <div class="mb-10 text-center">
            <h1 class="text-3xl md:text-5xl font-black uppercase tracking-tight text-primary mb-3 flex justify-center items-center gap-3">
                <span class="material-icons text-4xl md:text-5xl">payments</span>
                XÁC NHẬN THANH TOÁN
            </h1>
            <div class="h-1.5 w-32 bg-linear-to-r from-transparent via-primary to-transparent mx-auto rounded-full mt-4"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Left Column: Product Info -->
            <div class="md:col-span-2 space-y-6">
                <!-- Product Details -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-8 relative overflow-hidden group">
                    <img src="{{ asset('images/hoa1.webp') }}" class="absolute -top-6 -right-6 w-32 opacity-10 rotate-12 pointer-events-none group-hover:opacity-20 transition-opacity">
                    <h2 class="text-xl font-black mb-6 flex items-center gap-2 text-primary uppercase tracking-wide">
                        <span class="material-icons">shopping_bag</span>
                        Thông tin sản phẩm
                    </h2>

                    <div class="flex gap-4">
                        <div class="w-24 h-24 flex-shrink-0 bg-gray-100 rounded-lg overflow-hidden">
                            @if($product->images[0])
                            <img src="{{ url('storage/'.$product->images[0]) }}" alt="{{ $product->title }}" class="w-full h-full object-cover">
                            @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <span class="material-icons">image</span>
                            </div>
                            @endif
                        </div>
                        <div>
                            <h3 class="font-bold text-lg mb-1">{{ $product->title }}</h3>
                            <p class="text-sm text-gray-500 mb-2">Danh mục: {{ $product->category->title ?? 'N/A' }}</p>
                            <div class="flex items-center gap-2">
                                <span class="text-xl font-bold text-red-500">{{ number_format($product->getFinalPrice()) }}đ</span>
                                @if($product->sale_price && $product->sale_price < $product->sell_price)
                                    <span class="text-sm text-gray-400 line-through">{{ number_format($product->sell_price) }}đ</span>
                                    @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Wallet Info -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-8 relative overflow-hidden group">
                    <img src="{{ asset('images/lixi1.png') }}" class="absolute -bottom-4 -left-4 w-24 opacity-10 -rotate-12 pointer-events-none group-hover:opacity-20 transition-opacity">
                    <h2 class="text-xl font-black mb-6 flex items-center gap-2 text-primary uppercase tracking-wide">
                        <span class="material-icons">account_balance_wallet</span>
                        Thông tin ví
                    </h2>

                    <div class="flex items-center justify-between bg-gray-50 p-4 rounded-lg border border-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                <span class="material-icons">wallet</span>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Số dư hiện tại</p>
                                <p class="font-bold text-lg {{ $wallet->balance < $product->getFinalPrice() ? 'text-red-500' : 'text-green-600' }}">
                                    {{ number_format($wallet->balance) }}đ
                                </p>
                            </div>
                        </div>

                        @if($wallet->balance < $product->getFinalPrice())
                            <a href="{{ route('deposit') }}" class="px-6 py-3 btn-tet rounded-xl font-black text-sm uppercase tracking-widest hover-glow-gold">
                                Nạp thêm tiền
                            </a>
                            @endif
                    </div>
                </div>
            </div>

            <!-- Right Column: Order Summary -->
            <div class="md:col-span-1">
                <div class="bg-white rounded-3xl shadow-2xl border border-gray-200 p-8 sticky top-24 relative overflow-hidden">
                    <img src="{{ asset('images/phao2.webp') }}" class="absolute -top-4 -right-4 w-20 opacity-20 animate-swing pointer-events-none">
                    <h2 class="text-xl font-black mb-6 text-primary uppercase tracking-wide">Tổng đơn hàng</h2>

                    <!-- Coupon Input -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Mã giảm giá</label>
                        <div class="flex gap-2">
                            <input type="text" id="coupon_code" class="flex-1 rounded-lg border-gray-300 focus:border-primary focus:ring-primary text-sm" placeholder="Nhập mã">
                            <button type="button" id="apply_coupon" class="px-3 py-2 bg-gray-800 text-white rounded-lg text-sm font-medium hover:bg-gray-700 transition">
                                Áp dụng
                            </button>
                        </div>
                        <p id="coupon_message" class="text-xs mt-1 hidden"></p>
                    </div>

                    <div class="space-y-3 pt-4 border-t border-gray-100">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Tạm tính</span>
                            <span class="font-medium">{{ number_format($product->getFinalPrice()) }}đ</span>
                        </div>
                        <div class="flex justify-between text-sm text-green-600" id="discount_row" style="display: none;">
                            <span>Giảm giá</span>
                            <span>-<span id="discount_amount">0</span>đ</span>
                        </div>
                        <div class="flex justify-between text-base font-bold pt-3 border-t border-gray-100">
                            <span>Tổng thanh toán</span>
                            <span class="text-red-500" id="final_total">{{ number_format($product->getFinalPrice()) }}đ</span>
                        </div>
                    </div>

                    <form action="{{ route('purchase.process') }}" method="POST" class="mt-6">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="coupon_code" id="form_coupon_code">

                        <button type="submit"
                            class="w-full py-4 rounded-xl font-black text-white shadow-xl transition transform active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed uppercase tracking-widest text-base
                            {{ $wallet->balance < $product->getFinalPrice() ? 'bg-gray-400 cursor-not-allowed' : 'btn-tet hover-glow-gold' }}"
                            {{ $wallet->balance < $product->getFinalPrice() ? 'disabled' : '' }}>
                            {{ $wallet->balance < $product->getFinalPrice() ? 'Số dư không đủ' : 'XÁC NHẬN THANH TOÁN' }}
                        </button>
                    </form>

                    <p class="text-xs text-gray-400 text-center mt-4">
                        Bằng việc xác nhận thanh toán, bạn đồng ý với điều khoản dịch vụ của chúng tôi.
                    </p>
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