    <div class="max-w-4xl mx-auto relative z-10">
        <div class="mb-12 text-center relative">
            <!-- Decorative background glow -->
            <div class="absolute -top-20 -left-20 w-64 h-64 bg-primary/10 blur-[100px] rounded-full pointer-events-none"></div>
            <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-indigo-500/10 blur-[100px] rounded-full pointer-events-none"></div>

            <h1 class="text-3xl md:text-5xl font-black uppercase tracking-tight text-white mb-3 flex justify-center items-center gap-4 relative z-10">
                <span class="material-icons text-4xl md:text-5xl text-primary drop-shadow-[0_0_10px_rgba(74,222,128,0.5)]">payments</span>
                XÁC NHẬN THANH TOÁN
            </h1>
            <div class="h-1 w-32 bg-linear-to-r from-transparent via-primary to-transparent mx-auto rounded-full mt-8"></div>
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
                <div class="glass rounded-2xl border border-white/10 p-8 relative overflow-hidden group shadow-2xl">
                    <h2 class="text-xl font-black mb-8 flex items-center gap-3 text-white uppercase tracking-tighter">
                        <span class="material-icons text-primary">shopping_bag</span>
                        THÔNG TIN SẢN PHẨM
                    </h2>

                    <div class="flex gap-6">
                        <div class="w-28 h-28 shrink-0 bg-neutral-950/50 rounded-xl overflow-hidden border border-white/5">
                            @if($product->images[0])
                            <img src="{{ url('storage/'.$product->images[0]) }}" alt="{{ $product->title }}" class="w-full h-full object-cover">
                            @else
                            <div class="w-full h-full flex items-center justify-center text-neutral-800">
                                <span class="material-icons text-4xl">image</span>
                            </div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <h3 class="font-black text-lg mb-2 text-white leading-tight">{{ $product->title }}</h3>
                            <p class="text-[10px] text-neutral-600 mb-4 font-black uppercase tracking-widest flex items-center gap-2">
                                <span class="w-1 h-3 bg-primary rounded-full"></span>
                                DANH MỤC: {{ $product->category->title ?? 'N/A' }}
                            </p>
                            <div class="flex items-center gap-3">
                                <span class="text-2xl font-black text-primary drop-shadow-[0_0_8px_rgba(74,222,128,0.4)]">{{ number_format($this->originalPrice) }}đ</span>
                                @if($product->sale_price && $product->sale_price < $product->sell_price)
                                    <span class="text-xs text-neutral-600 line-through font-bold">{{ number_format($product->sell_price) }}đ</span>
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
                                <span class="material-icons text-xl">account_balance_wallet</span>
                            </div>
                            <div>
                                <p class="text-[10px] text-neutral-600 font-black uppercase tracking-widest mb-1">Số dư hiện tại</p>
                                <p class="font-black text-2xl {{ $this->wallet->balance < $this->finalAmount ? 'text-pink-500 shadow-pink-500/10' : 'text-emerald-400 drop-shadow-[0_0_8px_rgba(52,211,153,0.3)]' }}">
                                    {{ number_format($this->wallet->balance) }}đ
                                </p>
                            </div>
                        </div>

                        @if($this->wallet->balance < $this->finalAmount)
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
                        <label class="block text-[10px] font-black text-neutral-700 mb-3 uppercase tracking-widest">MÃ GIẢM GIÁ</label>
                        <div class="flex gap-2">
                            <input
                                type="text"
                                wire:model.defer="couponCode"
                                class="flex-1 bg-neutral-950/50 border border-white/10 focus:border-primary focus:ring-primary/20 rounded-xl px-4 py-3 text-neutral-200 text-sm outline-hidden placeholder-neutral-700 transition-all font-bold"
                                placeholder="NHẬP MÃ..."
                                @if($couponValid)
                                disabled
                                @endif>
                            @if($couponValid)
                            <button
                                type="button"
                                wire:click="removeCoupon"
                                class="shrink-0 whitespace-nowrap px-4 py-3 bg-pink-500 text-white rounded-xl text-xs font-black transition-all shadow-lg shadow-pink-500/20 uppercase tracking-widest">
                                XÓA
                            </button>
                            @else
                            <button
                                type="button"
                                wire:click="applyCoupon"
                                wire:loading.attr="disabled"
                                wire:target="applyCoupon"
                                class="shrink-0 whitespace-nowrap px-4 py-3 bg-white/10 hover:bg-white/20 text-white rounded-xl text-xs font-black transition-all uppercase tracking-widest disabled:opacity-50">
                                <span wire:loading.remove wire:target="applyCoupon">ÁP DỤNG</span>
                                <span wire:loading wire:target="applyCoupon" class="flex items-center gap-1">
                                    <span class="material-icons animate-spin text-sm">refresh</span>
                                </span>
                            </button>
                            @endif
                        </div>

                        @if($couponMessage)
                        <p class="text-[10px] font-black mt-2 uppercase tracking-widest {{ $couponValid ? 'text-emerald-400' : 'text-pink-500' }}">
                            {{ $couponMessage }}
                        </p>
                        @endif
                    </div>

                    <div class="space-y-4 pt-6 border-t border-white/5">
                        <div class="flex justify-between text-xs font-bold">
                            <span class="text-neutral-600 uppercase tracking-widest">Tạm tính</span>
                            <span class="font-black text-neutral-200">{{ number_format($this->originalPrice) }}đ</span>
                        </div>
                        @if($discount > 0)
                        <div class="flex justify-between text-xs font-black text-emerald-400 uppercase tracking-widest">
                            <span>Giảm giá</span>
                            <span>-{{ number_format($discount) }}đ</span>
                        </div>
                        @endif
                        <div class="flex justify-between items-center text-sm font-black pt-5 border-t border-white/5">
                            <span class="text-neutral-400 uppercase tracking-widest">Tổng thanh toán</span>
                            <span class="text-primary text-2xl drop-shadow-[0_0_10px_rgba(74,222,128,0.4)]">{{ number_format($this->finalAmount) }}đ</span>
                        </div>
                    </div>

                    <button
                        type="button"
                        wire:click="purchase"
                        wire:loading.attr="disabled"
                        wire:target="purchase"
                        {{ $this->wallet->balance < $this->finalAmount ? 'disabled' : '' }}
                        class="w-full py-5 rounded-2xl font-black text-white shadow-2xl transition-all transform active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed mt-8 uppercase tracking-widest text-sm border-none {{ $this->wallet->balance < $this->finalAmount ? 'bg-neutral-800 text-neutral-600 cursor-not-allowed' : 'btn-esport shadow-primary/20' }}">
                        <span wire:loading.remove wire:target="purchase">
                            {{ $this->wallet->balance < $this->finalAmount ? 'SỐ DƯ KHÔNG ĐỦ' : 'XÁC NHẬN THANH TOÁN' }}
                        </span>
                        <span wire:loading wire:target="purchase" class="flex items-center justify-center gap-2">
                            <span class="material-icons animate-spin text-sm">refresh</span>
                            ĐANG XỬ LÝ...
                        </span>
                    </button>

                    <p class="text-[10px] text-neutral-600 font-bold text-center mt-6 leading-relaxed uppercase tracking-widest">
                        Bằng việc xác nhận thanh toán, bạn đồng ý với <a href="{{ route('policy') }}" class="text-primary hover:underline">điều khoản dịch vụ</a> của chúng tôi.
                    </p>
                </div>
            </div>
        </div>
    </div>
    </div>