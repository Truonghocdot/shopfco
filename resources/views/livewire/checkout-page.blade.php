<div class="container mx-auto px-4 py-8 min-h-screen">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-black mb-6 text-primary drop-shadow-[0_0_15px_rgba(0,255,0,0.8)] uppercase tracking-wider">Xác nhận thanh toán</h1>

        @if (session('error'))
        <div class="mb-6 bg-red-900/30 border-2 border-red-500/50 text-red-300 px-4 py-3 rounded-lg backdrop-blur-sm shadow-[0_0_15px_rgba(239,68,68,0.3)]">
            {{ session('error') }}
        </div>
        @endif
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Left Column: Product Info -->
            <div class="md:col-span-2 space-y-6">
                <!-- Product Details - Techno Style -->
                <div class="relative bg-gradient-to-br from-black via-[#001a0f] to-black border-2 border-primary/30 rounded-xl shadow-[0_0_30px_rgba(0,255,0,0.2)] p-6 overflow-hidden">
                    <!-- Grid Pattern -->
                    <div class="absolute inset-0 opacity-10 pointer-events-none">
                        <div class="absolute inset-0" style="background-image: repeating-linear-gradient(90deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px), repeating-linear-gradient(0deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px);"></div>
                    </div>

                    <h2 class="text-lg font-black mb-4 flex items-center gap-2 text-primary drop-shadow-[0_0_10px_rgba(0,255,0,0.8)] relative z-10 uppercase tracking-wide">
                        <span class="material-icons text-xl">shopping_bag</span>
                        Thông tin sản phẩm
                    </h2>

                    <div class="flex gap-4 relative z-10">
                        <div class="w-24 h-24 shrink-0 bg-black/50 rounded-lg overflow-hidden border-2 border-slate-700">
                            @if($product->images[0])
                            <img src="{{ url('storage/'.$product->images[0]) }}" alt="{{ $product->title }}" class="w-full h-full object-cover">
                            @else
                            <div class="w-full h-full flex items-center justify-center text-slate-600">
                                <span class="material-icons">image</span>
                            </div>
                            @endif
                        </div>
                        <div>
                            <h3 class="font-bold text-lg mb-1 text-white">{{ $product->title }}</h3>
                            <p class="text-sm text-slate-500 mb-2">Danh mục: {{ $product->category->title ?? 'N/A' }}</p>
                            <div class="flex items-center gap-2">
                                <span class="text-xl font-black text-primary drop-shadow-[0_0_10px_rgba(0,255,0,0.8)]">{{ number_format($this->originalPrice) }}đ</span>
                                @if($product->sale_price && $product->sale_price < $product->sell_price)
                                    <span class="text-sm text-slate-600 line-through">{{ number_format($product->sell_price) }}đ</span>
                                    @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Wallet Info - Techno Style -->
                <div class="relative bg-gradient-to-br from-black via-[#001a0f] to-black border-2 border-primary/30 rounded-xl shadow-[0_0_30px_rgba(0,255,0,0.2)] p-6 overflow-hidden">
                    <!-- Grid Pattern -->
                    <div class="absolute inset-0 opacity-10 pointer-events-none">
                        <div class="absolute inset-0" style="background-image: repeating-linear-gradient(90deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px), repeating-linear-gradient(0deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px);"></div>
                    </div>

                    <h2 class="text-lg font-black mb-4 flex items-center gap-2 text-primary drop-shadow-[0_0_10px_rgba(0,255,0,0.8)] relative z-10 uppercase tracking-wide">
                        <span class="material-icons text-xl">account_balance_wallet</span>
                        Thông tin ví
                    </h2>

                    <div class="flex items-center justify-between bg-black/40 p-4 rounded-lg border border-primary/20 relative z-10">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-primary/20 flex items-center justify-center text-primary shadow-[0_0_15px_rgba(0,255,0,0.4)]">
                                <span class="material-icons">wallet</span>
                            </div>
                            <div>
                                <p class="text-sm text-slate-500">Số dư hiện tại</p>
                                <p class="font-black text-lg {{ $this->wallet->balance < $this->finalAmount ? 'text-red-500 drop-shadow-[0_0_10px_rgba(239,68,68,0.8)]' : 'text-primary drop-shadow-[0_0_10px_rgba(0,255,0,0.8)]' }}">
                                    {{ number_format($this->wallet->balance) }}đ
                                </p>
                            </div>
                        </div>

                        @if($this->wallet->balance < $this->finalAmount)
                            <a href="{{ route('deposit') }}" class="px-4 py-2 bg-gradient-to-r from-primary to-green-400 hover:from-green-400 hover:to-primary text-black rounded-lg font-bold text-sm transition-all shadow-[0_0_15px_rgba(0,255,0,0.4)] hover:shadow-[0_0_25px_rgba(0,255,0,0.6)] border border-primary/50 uppercase tracking-wide">
                                Nạp thêm tiền
                            </a>
                            @endif
                    </div>
                </div>
            </div>

            <!-- Right Column: Order Summary - Techno Style -->
            <div class="md:col-span-1">
                <div class="relative bg-gradient-to-br from-black via-[#001a0f] to-black border-2 border-primary/30 rounded-xl shadow-[0_0_30px_rgba(0,255,0,0.2)] p-6 sticky top-24 overflow-hidden">
                    <!-- Grid Pattern -->
                    <div class="absolute inset-0 opacity-10 pointer-events-none">
                        <div class="absolute inset-0" style="background-image: repeating-linear-gradient(90deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px), repeating-linear-gradient(0deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px);"></div>
                    </div>

                    <h2 class="text-lg font-black mb-4 text-primary drop-shadow-[0_0_10px_rgba(0,255,0,0.8)] relative z-10 uppercase tracking-wide">Tổng đơn hàng</h2>

                    <!-- Coupon Input -->
                    <div class="mb-6 relative z-10">
                        <label class="block text-sm font-bold text-slate-400 mb-2 uppercase tracking-wide">Mã giảm giá</label>
                        <div class="flex gap-2">
                            <input
                                type="text"
                                wire:model.defer="couponCode"
                                class="flex-1 rounded-lg bg-black/40 border-2 border-slate-700 focus:border-primary focus:ring-primary text-sm text-white placeholder-slate-600"
                                placeholder="Nhập mã"
                                @if($couponValid)
                                disabled
                                @endif>
                            @if($couponValid)
                            <button
                                type="button"
                                wire:click="removeCoupon"
                                class="px-3 py-2 bg-gradient-to-r from-red-600 to-red-500 text-white rounded-lg text-sm font-bold hover:shadow-[0_0_20px_rgba(239,68,68,0.5)] transition-all border border-red-400">
                                Xóa
                            </button>
                            @else
                            <button
                                type="button"
                                wire:click="applyCoupon"
                                wire:loading.attr="disabled"
                                wire:target="applyCoupon"
                                class="px-3 py-2 bg-black/60 border-2 border-primary/50 text-primary rounded-lg text-sm font-bold hover:bg-primary/20 hover:shadow-[0_0_20px_rgba(0,255,0,0.5)] transition-all disabled:opacity-50">
                                <span wire:loading.remove wire:target="applyCoupon">Áp dụng</span>
                                <span wire:loading wire:target="applyCoupon" class="flex items-center gap-1">
                                    <span class="material-icons animate-spin text-sm">refresh</span>
                                </span>
                            </button>
                            @endif
                        </div>
                        @if($couponMessage)
                        <p class="text-xs mt-1 {{ $couponValid ? 'text-primary drop-shadow-[0_0_8px_rgba(0,255,0,0.8)]' : 'text-red-500 drop-shadow-[0_0_8px_rgba(239,68,68,0.8)]' }}">
                            {{ $couponMessage }}
                        </p>
                        @endif
                    </div>

                    <div class="space-y-3 pt-4 border-t border-primary/20 relative z-10">
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Tạm tính</span>
                            <span class="font-bold text-white">{{ number_format($this->originalPrice) }}đ</span>
                        </div>
                        @if($discount > 0)
                        <div class="flex justify-between text-sm text-primary drop-shadow-[0_0_8px_rgba(0,255,0,0.6)]">
                            <span>Giảm giá</span>
                            <span>-{{ number_format($discount) }}đ</span>
                        </div>
                        @endif
                        <div class="flex justify-between text-base font-black pt-3 border-t border-primary/20">
                            <span class="text-white">Tổng thanh toán</span>
                            <span class="text-primary drop-shadow-[0_0_15px_rgba(0,255,0,0.8)] text-xl">{{ number_format($this->finalAmount) }}đ</span>
                        </div>
                    </div>

                    <button
                        type="button"
                        wire:click="purchase"
                        wire:loading.attr="disabled"
                        wire:target="purchase"
                        {{ $this->wallet->balance < $this->finalAmount ? 'disabled' : '' }}
                        class="w-full py-3 rounded-lg font-black text-white shadow-[0_0_25px_rgba(239,68,68,0.4)] hover:shadow-[0_0_35px_rgba(239,68,68,0.6)] transition-all transform active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed mt-6 uppercase tracking-wide border-2 {{ $this->wallet->balance < $this->finalAmount ? 'bg-slate-700 border-slate-600 cursor-not-allowed' : 'bg-gradient-to-r from-red-600 to-red-500 hover:from-red-500 hover:to-red-600 border-red-400' }} relative z-10">
                        <span wire:loading.remove wire:target="purchase">
                            {{ $this->wallet->balance < $this->finalAmount ? 'Số dư không đủ' : 'Xác nhận thanh toán' }}
                        </span>
                        <span wire:loading wire:target="purchase" class="flex items-center justify-center gap-2">
                            <span class="material-icons animate-spin text-sm">refresh</span>
                            Đang xử lý...
                        </span>
                    </button>

                    <p class="text-xs text-slate-600 text-center mt-4 relative z-10">
                        Bằng việc xác nhận thanh toán, bạn đồng ý với điều khoản dịch vụ của chúng tôi.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>