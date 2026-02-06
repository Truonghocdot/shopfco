<div class="relative bg-gradient-to-br from-black via-[#001a0f] to-black border-2 border-primary/30 rounded-xl shadow-[0_0_30px_rgba(0,255,0,0.2)] p-6 overflow-hidden">
    <!-- Grid Pattern -->
    <div class="absolute inset-0 opacity-10 pointer-events-none">
        <div class="absolute inset-0" style="background-image: repeating-linear-gradient(90deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px), repeating-linear-gradient(0deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px);"></div>
    </div>

    <h3 class="text-xl font-black mb-6 text-primary drop-shadow-[0_0_10px_rgba(0,255,0,0.8)] uppercase tracking-wide relative z-10">Lịch sử giao dịch</h3>

    <!-- Filters -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 relative z-10">
        <div>
            <label class="block text-sm font-bold mb-2 text-slate-400 uppercase tracking-wide">Loại giao dịch</label>
            <select wire:model.live="filterType" class="w-full bg-black/40 border-2 border-slate-700 focus:border-primary rounded-lg px-4 py-2 text-white">
                <option value="">Tất cả</option>
                <option value="0">Nạp tiền</option>
                <option value="1">Mua tài khoản</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-bold mb-2 text-slate-400 uppercase tracking-wide">Trạng thái</label>
            <select wire:model.live="filterStatus" class="w-full bg-black/40 border-2 border-slate-700 focus:border-primary rounded-lg px-4 py-2 text-white">
                <option value="">Tất cả</option>
                <option value="0">Đang xử lý</option>
                <option value="1">Thành công</option>
                <option value="2">Thất bại</option>
            </select>
        </div>
    </div>

    <!-- Transactions Table -->
    <div class="overflow-x-auto relative z-10">
        <table class="w-full">
            <thead>
                <tr class="border-b-2 border-primary/30">
                    <th class="text-left py-3 px-2 text-sm font-black text-primary uppercase tracking-wide">Mã GD</th>
                    <th class="text-left py-3 px-2 text-sm font-black text-primary uppercase tracking-wide">Loại</th>
                    <th class="text-right py-3 px-2 text-sm font-black text-primary uppercase tracking-wide">Số tiền</th>
                    <th class="text-center py-3 px-2 text-sm font-black text-primary uppercase tracking-wide">Trạng thái</th>
                    <th class="text-right py-3 px-2 text-sm font-black text-primary uppercase tracking-wide">Thời gian</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $transaction)
                <tr class="border-b border-slate-800 hover:bg-black/40 transition-colors">
                    <td class="py-3 px-2 text-sm text-white font-bold">#{{ $transaction->id }}</td>
                    <td class="py-3 px-2 text-sm">
                        @if($transaction->service_type == 0)
                        <span class="text-primary drop-shadow-[0_0_8px_rgba(0,255,0,0.6)]">Nạp tiền</span>
                        @else
                        <span class="text-red-500 drop-shadow-[0_0_8px_rgba(239,68,68,0.6)]">Mua ACC</span>
                        @endif
                    </td>
                    <td class="py-3 px-2 text-sm text-right font-black text-white">{{ number_format($transaction->amount) }} đ</td>
                    <td class="py-3 px-2 text-sm text-center">
                        @if($transaction->status == 0)
                        <span class="bg-yellow-500/20 border border-yellow-500/50 text-yellow-400 px-2 py-1 rounded text-xs font-bold shadow-[0_0_10px_rgba(250,204,21,0.3)]">Đang xử lý</span>
                        @elseif($transaction->status == 1)
                        <span class="bg-primary/20 border border-primary/50 text-primary px-2 py-1 rounded text-xs font-bold shadow-[0_0_10px_rgba(0,255,0,0.3)]">Thành công</span>
                        @else
                        <span class="bg-red-500/20 border border-red-500/50 text-red-400 px-2 py-1 rounded text-xs font-bold shadow-[0_0_10px_rgba(239,68,68,0.3)]">Thất bại</span>
                        @endif
                    </td>
                    <td class="py-3 px-2 text-sm text-right text-slate-500">{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-8 text-center text-slate-500">Chưa có giao dịch nào</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6 relative z-10">
        {{ $transactions->links() }}
    </div>
</div>