@props(['topSpenders'])

<div class="relative rounded-xl border-2 border-primary/30 bg-gradient-to-br from-black via-[#001a0f] to-black shadow-[0_0_30px_rgba(0,255,0,0.2)] p-4 md:p-6 overflow-hidden">
    <!-- Grid Pattern -->
    <div class="absolute inset-0 opacity-10 pointer-events-none">
        <div class="absolute inset-0" style="background-image: repeating-linear-gradient(90deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px), repeating-linear-gradient(0deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px);"></div>
    </div>

    <!-- Header -->
    <div class="flex items-center gap-2 md:gap-3 mb-4 md:mb-6 relative z-10">
        <div class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center shadow-[0_0_20px_rgba(251,191,36,0.5)] relative">
            <div class="absolute inset-0 bg-yellow-400/30 blur-lg rounded-full"></div>
            <span class="material-icons text-white text-xl md:text-2xl relative z-10 drop-shadow-[0_0_8px_rgba(255,255,255,0.8)]">emoji_events</span>
        </div>
        <div>
            <h3 class="text-base md:text-xl font-black text-primary drop-shadow-[0_0_10px_rgba(0,255,0,0.8)] uppercase tracking-wide">Bảng Xếp Hạng</h3>
            <p class="text-[10px] md:text-sm text-slate-400">Top người chi tiêu nhiều nhất</p>
        </div>
    </div>

    @if($topSpenders->isNotEmpty())
    <div class="space-y-2 md:space-y-3 relative z-10">
        @foreach($topSpenders as $index => $user)
        <div class="flex items-center gap-3 md:gap-4 p-2 md:p-3 rounded-lg transition-all {{ $index < 3 ? 'bg-gradient-to-r from-yellow-900/20 to-orange-900/20 border border-yellow-500/30 shadow-[0_0_15px_rgba(251,191,36,0.2)]' : 'bg-black/40 border border-slate-700 hover:border-primary/50' }} hover:scale-[1.02] group">
            <!-- Rank -->
            <div class="flex-shrink-0 w-8 md:w-10 text-center">
                @if($index === 0)
                <span class="text-2xl md:text-3xl drop-shadow-[0_0_10px_rgba(251,191,36,0.8)]">🥇</span>
                @elseif($index === 1)
                <span class="text-2xl md:text-3xl drop-shadow-[0_0_10px_rgba(192,192,192,0.8)]">🥈</span>
                @elseif($index === 2)
                <span class="text-2xl md:text-3xl drop-shadow-[0_0_10px_rgba(205,127,50,0.8)]">🥉</span>
                @else
                <span class="text-sm md:text-lg font-bold text-slate-500 group-hover:text-primary transition-colors">#{{ $index + 1 }}</span>
                @endif
            </div>

            <!-- User Info -->
            <div class="flex-1 min-w-0">
                <p class="font-semibold text-sm md:text-base {{ $index < 3 ? 'text-yellow-400 drop-shadow-[0_0_8px_rgba(251,191,36,0.6)]' : 'text-white group-hover:text-primary' }} truncate transition-colors">{{ $user->name }}</p>
                <p class="text-[10px] md:text-xs text-slate-500">{{ $user->total_orders }} đơn hàng</p>
            </div>

            <!-- Total Spent -->
            <div class="text-right">
                <p class="font-black text-sm md:text-lg {{ $index < 3 ? 'text-yellow-400 drop-shadow-[0_0_10px_rgba(251,191,36,0.8)]' : 'text-primary drop-shadow-[0_0_8px_rgba(0,255,0,0.6)]' }}">
                    {{ number_format($user->total_spent) }}đ
                </p>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-4 md:mt-6 pt-3 md:pt-4 border-t border-primary/20 text-center relative z-10">
        <p class="text-xs text-slate-500 italic flex items-center justify-center gap-1">
            <span class="material-icons text-xs align-middle text-primary">info</span>
            Cập nhật mỗi 5 phút
        </p>
    </div>
    @else
    <div class="text-center py-8 relative z-10">
        <span class="material-icons text-slate-700 text-5xl mb-3 drop-shadow-[0_0_10px_rgba(0,255,0,0.3)]">leaderboard</span>
        <p class="text-slate-500">Chưa có dữ liệu xếp hạng</p>
    </div>
    @endif
</div>