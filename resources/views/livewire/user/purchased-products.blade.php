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
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-white p-3 rounded-lg border border-slate-200">
                            <span class="text-xs text-slate-500 uppercase font-bold block mb-1">Tài khoản</span>
                            <div class="flex items-center justify-between">
                                <code class="font-mono font-bold text-slate-700">{{ $selectedOrder->product->phone ?? 'N/A' }}</code>
                                <button class="text-slate-400 hover:text-primary-blue copy-btn" data-clipboard-text="{{ $selectedOrder->product->phone ?? '' }}">
                                    <span class="material-icons text-sm">content_copy</span>
                                </button>
                            </div>
                        </div>
                        <div class="bg-white p-3 rounded-lg border border-slate-200">
                            <span class="text-xs text-slate-500 uppercase font-bold block mb-1">Mật khẩu</span>
                            <div class="flex items-center justify-between">
                                <code class="font-mono font-bold text-slate-700">{{ $selectedOrder->product->password ?? 'N/A' }}</code>
                                <button class="text-slate-400 hover:text-primary-blue copy-btn" data-clipboard-text="{{ $selectedOrder->product->password ?? '' }}">
                                    <span class="material-icons text-sm">content_copy</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    @if(isset($selectedOrder->product->note))
                    <div class="mt-4 pt-4 border-t border-slate-200">
                        <span class="text-xs text-slate-500 uppercase font-bold block mb-1">Ghi chú</span>
                        <p class="text-sm text-slate-700">{{ $selectedOrder->product->note }}</p>
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