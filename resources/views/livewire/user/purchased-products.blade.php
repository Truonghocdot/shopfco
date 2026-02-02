<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="p-4 border-b border-slate-200">
        <h2 class="text-slate-900 text-lg font-bold">Tài khoản đã mua</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 text-slate-500 text-xs font-bold uppercase tracking-wider">
                    <th class="px-6 py-4">Mã đơn</th>
                    <th class="px-6 py-4">Sản phẩm</th>
                    <th class="px-6 py-4">Giá tiền</th>
                    <th class="px-6 py-4">Ngày mua</th>
                    <th class="px-6 py-4">Trạng thái</th>
                    <th class="px-6 py-4">Hành động</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($purchasedProducts as $order)
                <tr class="text-sm">
                    <td class="px-6 py-4 font-mono font-medium text-slate-600">#{{ $order->order_number }}</td>
                    <td class="px-6 py-4">
                        <div class="font-bold text-slate-900">{{ $order->product->title ?? 'Sản phẩm đã xóa' }}</div>
                    </td>
                    <td class="px-6 py-4 font-bold text-primary-blue">
                        {{ number_format($order->final_amount) }}đ
                    </td>
                    <td class="px-6 py-4 text-slate-500">
                        {{ $order->created_at->format('d/m/Y H:i') }}
                    </td>
                    <td class="px-6 py-4">
                        @if($order->status == 1)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-100 text-green-700">Hoàn thành</span>
                        @elseif($order->status == 2)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-red-100 text-red-700">Đã hủy</span>
                        @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700">Chờ xử lý</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <button wire:click="viewDetails({{ $order->id }})" class="text-primary-blue font-bold hover:underline">Xem chi tiết</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                        <div class="flex flex-col items-center gap-2">
                            <span class="material-icons text-4xl text-slate-300">shopping_cart_off</span>
                            <p>Bạn chưa mua tài khoản nào</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($purchasedProducts->hasPages())
    <div class="p-4 border-t border-slate-200">
        {{ $purchasedProducts->links() }}
    </div>
    @endif

    <!-- Order Detail Modal -->
    @if($showModal && $selectedOrder)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm"
        wire:click.self="closeModal">
        <div class="bg-white rounded-2xl w-full max-w-2xl overflow-hidden shadow-2xl animate-fade-in-up">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                <h3 class="text-xl font-bold text-slate-900">Chi tiết đơn hàng #{{ $selectedOrder->order_number }}</h3>
                <button wire:click="closeModal" class="text-slate-400 hover:text-slate-600">
                    <span class="material-icons">close</span>
                </button>
            </div>

            <div class="p-6 space-y-6">
                <!-- Product Info -->
                <div class="flex gap-4">
                    <div class="w-24 h-24 rounded-lg overflow-hidden shrink-0 border border-slate-200">
                        <img src="{{ url('storage/'.$selectedOrder->product->images[0] ?? '') }}"
                            alt="{{ $selectedOrder->product->title ?? 'Sản phẩm' }}"
                            class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h4 class="font-bold text-lg mb-1">{{ $selectedOrder->product->title ?? 'Sản phẩm đã xóa' }}</h4>
                        <div class="flex items-center gap-4 text-sm text-slate-500">
                            <div>
                                Giá gốc: <span class="line-through">{{ number_format($selectedOrder->product_price) }}đ</span>
                            </div>
                            <div class="text-accent-red font-bold">
                                Thành tiền: {{ number_format($selectedOrder->final_amount) }}đ
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Account Credentials (Important) -->
                <div class="bg-slate-50 rounded-xl p-5 border border-slate-200">
                    <h4 class="font-bold text-slate-900 mb-3 flex items-center gap-2">
                        <span class="material-icons text-primary-blue">vpn_key</span>
                        Thông tin tài khoản:
                    </h4>

                    @if(!$isVerified)
                    <!-- Verification Form -->
                    <div class="bg-white p-6 rounded-lg border border-slate-200 text-center">
                        <div class="max-w-xs mx-auto space-y-4">
                            <div class="w-12 h-12 bg-primary-blue/10 rounded-full flex items-center justify-center mx-auto mb-2">
                                <span class="material-icons text-primary-blue">lock</span>
                            </div>
                            <h5 class="font-bold text-slate-800">Yêu cầu xác thực</h5>
                            <p class="text-xs text-slate-500">Vui lòng nhập <b>Mật khẩu cấp 2</b> để xem thông tin tài khoản này.</p>

                            <div class="relative">
                                <input type="password"
                                    wire:model="inputPassword2"
                                    wire:keydown.enter="verifyPassword"
                                    placeholder="Nhập mật khẩu cấp 2..."
                                    class="w-full px-4 py-2 rounded-lg border @error('inputPassword2') border-red-500 @else border-slate-200 @enderror focus:ring-2 focus:ring-primary-blue/20 outline-none text-center font-mono">
                                @error('inputPassword2')
                                <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <button wire:click="verifyPassword"
                                wire:loading.attr="disabled"
                                class="w-full py-2 bg-primary-blue hover:bg-primary-blue/90 text-white font-bold rounded-lg transition-all flex items-center justify-center gap-2">
                                <span wire:loading.remove class="text-green-600">Xác nhận</span>
                                <span wire:loading class="w-4 h-4 border-2 border-white/30 border-t-white rounded-full animate-spin"></span>
                            </button>

                            <p class="text-[11px] text-slate-400 italic">
                                Ghi chú: Sử dụng Mật khẩu 2 để lấy thông tin tài khoản.
                            </p>
                        </div>
                    </div>
                    @else
                    <!-- Revealed Credentials -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Username -->
                        <div class="bg-white p-3 rounded-lg border border-slate-200">
                            <span class="text-xs text-slate-500 uppercase font-bold block mb-1">Tài khoản (Username)</span>
                            <div class="flex items-center justify-between">
                                <code class="font-mono font-bold text-slate-700">{{ $selectedOrder->product->username ?? 'N/A' }}</code>
                                <button class="text-slate-400 hover:text-primary-blue copy-btn" data-clipboard-text="{{ $selectedOrder->product->username ?? '' }}">
                                    <span class="material-icons text-sm">content_copy</span>
                                </button>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="bg-white p-3 rounded-lg border border-slate-200">
                            <span class="text-xs text-slate-500 uppercase font-bold block mb-1">Mật khẩu cấp 1</span>
                            <div class="flex items-center justify-between">
                                <code class="font-mono font-bold text-slate-700">{{ $selectedOrder->product->password ?? 'N/A' }}</code>
                                <button class="text-slate-400 hover:text-primary-blue copy-btn" data-clipboard-text="{{ $selectedOrder->product->password ?? '' }}">
                                    <span class="material-icons text-sm">content_copy</span>
                                </button>
                            </div>
                        </div>

                        <!-- Password 2 -->
                        @if(!empty($selectedOrder->product->password2))
                        <div class="bg-white p-3 rounded-lg border border-slate-200">
                            <span class="text-xs text-slate-500 uppercase font-bold block mb-1">Mật khẩu cấp 2</span>
                            <div class="flex items-center justify-between">
                                <code class="font-mono font-bold text-slate-700">{{ $selectedOrder->product->password2 }}</code>
                                <button class="text-slate-400 hover:text-primary-blue copy-btn" data-clipboard-text="{{ $selectedOrder->product->password2 }}">
                                    <span class="material-icons text-sm">content_copy</span>
                                </button>
                            </div>
                        </div>
                        @endif

                        <!-- Email -->
                        @if(!empty($selectedOrder->product->email))
                        <div class="bg-white p-3 rounded-lg border border-slate-200">
                            <span class="text-xs text-slate-500 uppercase font-bold block mb-1">Email</span>
                            <div class="flex items-center justify-between">
                                <code class="font-mono font-bold text-slate-700">{{ $selectedOrder->product->email }}</code>
                                <button class="text-slate-400 hover:text-primary-blue copy-btn" data-clipboard-text="{{ $selectedOrder->product->email }}">
                                    <span class="material-icons text-sm">content_copy</span>
                                </button>
                            </div>
                        </div>
                        @endif

                        <!-- Phone -->
                        @if(!empty($selectedOrder->product->phone))
                        <div class="bg-white p-3 rounded-lg border border-slate-200">
                            <span class="text-xs text-slate-500 uppercase font-bold block mb-1">Số điện thoại</span>
                            <div class="flex items-center justify-between">
                                <code class="font-mono font-bold text-slate-700">{{ $selectedOrder->product->phone }}</code>
                                <button class="text-slate-400 hover:text-primary-blue copy-btn" data-clipboard-text="{{ $selectedOrder->product->phone }}">
                                    <span class="material-icons text-sm">content_copy</span>
                                </button>
                            </div>
                        </div>
                        @endif
                    </div>

                    @if(isset($selectedOrder->product->note))
                    <div class="mt-4 pt-4 border-t border-slate-200">
                        <span class="text-xs text-slate-500 uppercase font-bold block mb-1">Ghi chú</span>
                        <p class="text-sm text-slate-700">{{ $selectedOrder->product->note }}</p>
                    </div>
                    @endif

                    <div class="mt-4 p-3 bg-blue-50 rounded-lg border border-blue-100 italic text-[13px] text-blue-700">
                        <span class="font-bold">Ghi chú:</span> Sử dụng Mật khẩu 2 để lấy thông tin tài khoản trong trang quản lý đơn hàng
                    </div>
                    @endif
                </div>

                <!-- Transaction Info -->
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-slate-500 block">Thời gian mua:</span>
                        <span class="font-medium">{{ $selectedOrder->created_at->format('d/m/Y H:i:s') }}</span>
                    </div>
                    <div>
                        <span class="text-slate-500 block">Trạng thái:</span>
                        @if($selectedOrder->status == 1)
                        <span class="text-green-600 font-bold">Hoàn thành</span>
                        @else
                        <span class="text-yellow-600 font-bold">Chờ xử lý</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="p-6 border-t border-slate-100 bg-slate-50 flex justify-end">
                <button wire:click="closeModal" class="px-6 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold rounded-lg transition">
                    Đóng
                </button>
            </div>
        </div>
    </div>
    @endif
</div>