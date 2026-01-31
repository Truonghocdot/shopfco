@extends('layouts.app')

@section('title', 'Thanh toán - ' . $product->title)

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Xác nhận thanh toán</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Left Column: Product Info -->
            <div class="md:col-span-2 space-y-6">
                <!-- Product Details -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-bold mb-4 flex items-center gap-2">
                        <span class="material-icons text-primary text-xl">shopping_bag</span>
                        Thông tin sản phẩm
                    </h2>

                    <div class="flex gap-4">
                        <div class="w-24 h-24 flex-shrink-0 bg-gray-100 rounded-lg overflow-hidden">
                            @if($product->image)
                            <img src="{{ $product->image }}" alt="{{ $product->title }}" class="w-full h-full object-cover">
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
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-bold mb-4 flex items-center gap-2">
                        <span class="material-icons text-primary text-xl">account_balance_wallet</span>
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
                            <a href="{{ route('deposit') }}" class="px-4 py-2 bg-primary hover:bg-primary-dark text-white rounded-lg font-medium text-sm transition">
                                Nạp thêm tiền
                            </a>
                            @endif
                    </div>
                </div>
            </div>

            <!-- Right Column: Order Summary -->
            <div class="md:col-span-1">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 sticky top-24">
                    <h2 class="text-lg font-bold mb-4">Tổng đơn hàng</h2>

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
                            class="w-full py-3 rounded-lg font-bold text-white shadow-lg transition transform active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed
                            {{ $wallet->balance < $product->getFinalPrice() ? 'bg-gray-400 cursor-not-allowed' : 'bg-red-500 hover:bg-red-600' }}"
                            {{ $wallet->balance < $product->getFinalPrice() ? 'disabled' : '' }}>
                            {{ $wallet->balance < $product->getFinalPrice() ? 'Số dư không đủ' : 'Xác nhận thanh toán' }}
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

@push('scripts')
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
@endpush
@endsection