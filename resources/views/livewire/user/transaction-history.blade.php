<div class="glass-morphism rounded-xl p-6">
    <h3 class="text-xl font-bold mb-6">Lịch sử giao dịch</h3>

    <!-- Filters -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        <div>
            <label class="block text-sm font-bold mb-2">Loại giao dịch</label>
            <select wire:model.live="filterType" class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-white">
                <option value="">Tất cả</option>
                <option value="0">Nạp tiền</option>
                <option value="1">Mua tài khoản</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-bold mb-2">Trạng thái</label>
            <select wire:model.live="filterStatus" class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-white">
                <option value="">Tất cả</option>
                <option value="0">Đang xử lý</option>
                <option value="1">Thành công</option>
                <option value="2">Thất bại</option>
            </select>
        </div>
    </div>

    <!-- Transactions Table -->
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-slate-700">
                    <th class="text-left py-3 px-2 text-sm font-bold">Mã GD</th>
                    <th class="text-left py-3 px-2 text-sm font-bold">Loại</th>
                    <th class="text-right py-3 px-2 text-sm font-bold">Số tiền</th>
                    <th class="text-center py-3 px-2 text-sm font-bold">Trạng thái</th>
                    <th class="text-right py-3 px-2 text-sm font-bold">Thời gian</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $transaction)
                <tr class="border-b border-slate-800">
                    <td class="py-3 px-2 text-sm">#{{ $transaction->id }}</td>
                    <td class="py-3 px-2 text-sm">
                        @if($transaction->service_type == 0)
                        <span class="text-primary">Nạp tiền</span>
                        @else
                        <span class="text-accent-red">Mua ACC</span>
                        @endif
                    </td>
                    <td class="py-3 px-2 text-sm text-right font-bold">{{ number_format($transaction->amount) }} đ</td>
                    <td class="py-3 px-2 text-sm text-center">
                        @if($transaction->status == 0)
                        <span class="bg-yellow-500/20 text-yellow-500 px-2 py-1 rounded text-xs">Đang xử lý</span>
                        @elseif($transaction->status == 1)
                        <span class="bg-primary/20 text-primary px-2 py-1 rounded text-xs">Thành công</span>
                        @else
                        <span class="bg-accent-red/20 text-accent-red px-2 py-1 rounded text-xs">Thất bại</span>
                        @endif
                    </td>
                    <td class="py-3 px-2 text-sm text-right text-slate-400">{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-8 text-center text-slate-400">Chưa có giao dịch nào</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $transactions->links() }}
    </div>
</div>