@props(['topSpenders'])

<div class="glass rounded-xl border border-white/10 shadow-2xl p-4 md:p-6 relative overflow-hidden group">
    <!-- Decorative background glow -->
    <div class="absolute -top-10 -right-10 w-32 h-32 bg-primary/10 blur-3xl rounded-full pointer-events-none transition-all group-hover:bg-primary/20"></div>
    <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-indigo-500/10 blur-3xl rounded-full pointer-events-none transition-all group-hover:bg-indigo-500/20"></div>

    <!-- Header -->
    <div class="flex items-center gap-2 md:gap-3 mb-4 md:mb-6 relative z-10">
        <div class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-slate-900 border border-primary/30 flex items-center justify-center shadow-[0_0_15px_rgba(56,189,248,0.2)]">
            <span class="material-icons text-primary text-xl md:text-2xl">emoji_events</span>
        </div>
        <div>
            <h3 class="text-base md:text-xl font-black text-white uppercase tracking-wider">Bảng Xếp Hạng</h3>
            <p class="text-[10px] md:text-sm text-slate-500 font-medium">Top người chi tiêu nhiều nhất</p>
        </div>
    </div>

    @if($topSpenders->isNotEmpty())
    <div class="space-y-2 md:space-y-3">
        @foreach($topSpenders as $index => $user)
        <div class="relative z-10 flex items-center gap-3 md:gap-4 p-2 md:p-3 rounded-lg transition-all {{ $index < 3 ? 'bg-primary/5 border border-primary/20 shadow-[0_0_10px_rgba(56,189,248,0.05)]' : 'bg-white/5 border border-white/5 hover:border-primary/30' }} hover:scale-[1.01] group/item">
            <!-- Rank -->
            <div class="shrink-0 w-8 md:w-10 text-center">
                @if($index === 0)
                <span class="text-2xl md:text-3xl drop-shadow-[0_0_8px_rgba(255,215,0,0.5)]">🥇</span>
                @elseif($index === 1)
                <span class="text-2xl md:text-3xl drop-shadow-[0_0_8px_rgba(192,192,192,0.5)]">🥈</span>
                @elseif($index === 2)
                <span class="text-2xl md:text-3xl drop-shadow-[0_0_8px_rgba(205,127,50,0.5)]">🥉</span>
                @else
                <span class="text-sm md:text-lg font-black text-slate-600 group-hover/item:text-primary/50 transition-colors">#{{ $index + 1 }}</span>
                @endif
            </div>

            <!-- User Info -->
            <div class="flex-1 min-w-0">
                <p class="font-bold text-sm md:text-base {{ $index < 3 ? 'text-white' : 'text-slate-300' }} truncate group-hover/item:text-primary transition-colors">{{ $user->name }}</p>
                <p class="text-[10px] md:text-xs text-slate-500 font-medium">{{ $user->total_orders }} đơn hàng</p>
            </div>

            <!-- Total Spent -->
            <div class="text-right">
                <p class="font-black text-sm md:text-lg {{ $index < 3 ? 'text-primary drop-shadow-[0_0_5px_rgba(56,189,248,0.4)]' : 'text-slate-400' }}">
                    {{ number_format($user->total_spent) }}đ
                </p>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-4 md:mt-6 pt-3 md:pt-4 border-t border-white/5 text-center">
        <p class="text-xs text-slate-600 font-medium flex items-center justify-center gap-1 italic">
            <span class="material-icons text-xs align-middle text-primary/50">info</span>
            Cập nhật mỗi 5 phút
        </p>
    </div>
    @else
    <div class="text-center py-8">
        <span class="material-icons text-gray-300 text-5xl mb-3">leaderboard</span>
        <p class="text-gray-400">Chưa có dữ liệu xếp hạng</p>
    </div>
    @endif
</div>