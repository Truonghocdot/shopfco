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
                        <div class="font-bold text-slate-900">{{ $order->product->name ?? 'Sản phẩm đã xóa' }}</div>
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
                        <button class="text-primary-blue font-bold hover:underline">Xem chi tiết</button>
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
</div>