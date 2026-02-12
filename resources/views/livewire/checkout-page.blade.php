<div class="container mx-auto px-4 py-8 min-h-screen relative overflow-hidden">
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

        @if (session('error'))
        <div class="mb-6 border border-red-200 text-red-600 px-4 py-3 rounded-lg">
            {{ session('error') }}
        </div>
        @endif
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Left Column: Product Info -->
            <div class="md:col-span-2 space-y-6">
                <!-- Product Details -->
                <div class="bg-white rounded-2xl border border-gray-200 shadow-xl p-8 relative overflow-hidden group">
                    <img src="{{ asset('images/hoa1.webp') }}" class="absolute -top-6 -right-6 w-32 opacity-10 rotate-12 pointer-events-none group-hover:opacity-20 transition-opacity">
                    <h2 class="text-xl font-black mb-6 flex items-center gap-2 text-primary uppercase tracking-wide">
                        <span class="material-icons">shopping_bag</span>
                        Thông tin sản phẩm
                    </h2>

                    <div class="flex gap-4">
                        <div class="w-24 h-24 shrink-0 bg-gray-50 rounded-lg overflow-hidden border border-gray-200">
                            @if($product->images[0])
                            <img src="{{ url('storage/'.$product->images[0]) }}" alt="{{ $product->title }}" class="w-full h-full object-cover">
                            @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <span class="material-icons">image</span>
                            </div>
                            @endif
                        </div>
                        <div>
                            <h3 class="font-bold text-lg mb-1 text-gray-800">{{ $product->title }}</h3>
                            <p class="text-sm text-gray-500 mb-2">Danh mục: {{ $product->category->title ?? 'N/A' }}</p>
                            <div class="flex items-center gap-2">
                                <span class="text-xl font-black text-primary">{{ number_format($this->originalPrice) }}đ</span>
                                @if($product->sale_price && $product->sale_price < $product->sell_price)
                                    <span class="text-sm text-gray-400 line-through">{{ number_format($product->sell_price) }}đ</span>
                                    @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Wallet Info -->
                <div class="bg-white rounded-2xl border border-gray-200 shadow-xl p-8 relative overflow-hidden group">
                    <img src="{{ asset('images/lixi1.png') }}" class="absolute -bottom-4 -left-4 w-24 opacity-10 -rotate-12 pointer-events-none group-hover:opacity-20 transition-opacity">
                    <h2 class="text-xl font-black mb-6 flex items-center gap-2 text-primary uppercase tracking-wide">
                        <span class="material-icons text-xl">account_balance_wallet</span>
                        Thông tin ví
                    </h2>

                    <div class="flex items-center justify-between bg-gray-50 p-4 rounded-lg border border-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center text-primary">
                                <span class="material-icons">wallet</span>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Số dư hiện tại</p>
                                <p class="font-black text-lg {{ $this->wallet->balance < $this->finalAmount ? 'text-red-500' : 'text-green-600' }}">
                                    {{ number_format($this->wallet->balance) }}đ
                                </p>
                            </div>
                        </div>

                        @if($this->wallet->balance < $this->finalAmount)
                            <a href="{{ route('deposit') }}" class="px-6 py-3 btn-tet rounded-xl font-black text-sm uppercase tracking-widest hover-glow-gold">
                                Nạp thêm tiền
                            </a>
                            @endif
                    </div>
                </div>
            </div>

            <!-- Right Column: Order Summary -->
            <div class="md:col-span-1">
                <div class="bg-white rounded-3xl border border-gray-200 shadow-2xl p-8 sticky top-24 relative overflow-hidden">
                    <img src="{{ asset('images/phao2.webp') }}" class="absolute -top-4 -right-4 w-20 opacity-20 animate-swing pointer-events-none">
                    <h2 class="text-xl font-black mb-6 text-primary uppercase tracking-wide">Tổng đơn hàng</h2>

                    <!-- Coupon Input -->
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-600 mb-2 uppercase tracking-wide">Mã giảm giá</label>
                        <div class="flex gap-2">
                            <input
                                type="text"
                                wire:model.defer="couponCode"
                                class="flex-1 min-w-0 rounded-lg bg-white border border-gray-200 focus:border-primary focus:ring-primary text-sm text-gray-800 placeholder-gray-400 px-3 py-2"
                                placeholder="Nhập mã"
                                @if($couponValid)
                                disabled
                                @endif>
                            @if($couponValid)
                            <button
                                type="button"
                                wire:click="removeCoupon"
                                class="shrink-0 whitespace-nowrap px-3 py-2 bg-red-500 text-white rounded-lg text-sm font-bold hover:bg-red-600 transition-all">
                                Xóa
                            </button>
                            @else
                            <button
                                type="button"
                                wire:click="applyCoupon"
                                wire:loading.attr="disabled"
                                wire:target="applyCoupon"
                                class="shrink-0 whitespace-nowrap px-3 py-2 bg-gray-800 text-white rounded-lg text-sm font-bold hover:bg-gray-700 transition-all disabled:opacity-50">
                                <span wire:loading.remove wire:target="applyCoupon">Áp dụng</span>
                                <span wire:loading wire:target="applyCoupon" class="flex items-center gap-1">
                                    <span class="material-icons animate-spin text-sm">refresh</span>
                                </span>
                            </button>
                            @endif
                        </div>

                        @if($couponMessage)
                        <p class="text-xs mt-1 {{ $couponValid ? 'text-green-600' : 'text-red-500' }}">
                            {{ $couponMessage }}
                        </p>
                        @endif
                    </div>

                    <div class="space-y-3 pt-4 border-t border-gray-100">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Tạm tính</span>
                            <span class="font-bold text-gray-800">{{ number_format($this->originalPrice) }}đ</span>
                        </div>
                        @if($discount > 0)
                        <div class="flex justify-between text-sm text-green-600">
                            <span>Giảm giá</span>
                            <span>-{{ number_format($discount) }}đ</span>
                        </div>
                        @endif
                        <div class="flex justify-between text-base font-black pt-3 border-t border-gray-100">
                            <span class="text-gray-800">Tổng thanh toán</span>
                            <span class="text-primary text-xl">{{ number_format($this->finalAmount) }}đ</span>
                        </div>
                    </div>

                    <button
                        type="button"
                        wire:click="purchase"
                        wire:loading.attr="disabled"
                        wire:target="purchase"
                        {{ $this->wallet->balance < $this->finalAmount ? 'disabled' : '' }}
                        class="w-full py-3 rounded-lg font-black text-white shadow-lg transition-all transform active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed mt-6 uppercase tracking-wide {{ $this->wallet->balance < $this->finalAmount ? 'bg-gray-400 cursor-not-allowed' : 'bg-red-500 hover:bg-red-600' }}">
                        <span wire:loading.remove wire:target="purchase">
                            {{ $this->wallet->balance < $this->finalAmount ? 'Số dư không đủ' : 'XÁC NHẬN THANH TOÁN' }}
                        </span>
                        <span wire:loading wire:target="purchase" class="flex items-center justify-center gap-2">
                            <span class="material-icons animate-spin text-sm">refresh</span>
                            Đang xử lý...
                        </span>
                    </button>

                    <p class="text-xs text-gray-400 text-center mt-4">
                        Bằng việc xác nhận thanh toán, bạn đồng ý với điều khoản dịch vụ của chúng tôi.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>