@props(['topSpenders'])

<div class="bg-white rounded-xl border border-gray-200 shadow-md p-4 md:p-6 relative overflow-hidden">
    <!-- Decorative fireworks -->
    <img src="{{ asset('images/meo.webp') }}" alt="" class="absolute -top-4 -right-4 w-28 md:w-32 opacity-90 pointer-events-none z-0">
    <img src="{{ asset('images/phao3.webp') }}" alt="" class="absolute -bottom-6 -left-6 w-24 md:w-28 opacity-70 -rotate-12 pointer-events-none animate-swing">
    <img src="{{ asset('images/phao2.webp') }}" alt="" class="absolute -bottom-4 -right-4 w-24 md:w-28 opacity-80 rotate-6 pointer-events-none animate-swing">

    <!-- Header -->
    <div class="flex items-center gap-2 md:gap-3 mb-4 md:mb-6 relative z-10">
        <div class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center shadow-md">
            <span class="material-icons text-white text-xl md:text-2xl">emoji_events</span>
        </div>
        <div>
            <h3 class="text-base md:text-xl font-black text-primary uppercase tracking-wide">Bảng Xếp Hạng</h3>
            <p class="text-[10px] md:text-sm text-gray-400">Top người chi tiêu nhiều nhất</p>
        </div>
    </div>

    @if($topSpenders->isNotEmpty())
    <div class="space-y-2 md:space-y-3">
        @foreach($topSpenders as $index => $user)
        <div class="flex items-center gap-3 md:gap-4 p-2 md:p-3 rounded-lg transition-all {{ $index < 3 ? 'bg-gradient-to-r from-yellow-50 to-orange-50 border border-yellow-200' : 'bg-gray-50 border border-gray-100 hover:border-orange-200' }} hover:scale-[1.01]">
            <!-- Rank -->
            <div class="shrink-0 w-8 md:w-10 text-center">
                @if($index === 0)
                <span class="text-2xl md:text-3xl">🥇</span>
                @elseif($index === 1)
                <span class="text-2xl md:text-3xl">🥈</span>
                @elseif($index === 2)
                <span class="text-2xl md:text-3xl">🥉</span>
                @else
                <span class="text-sm md:text-lg font-bold text-gray-400">#{{ $index + 1 }}</span>
                @endif
            </div>

            <!-- User Info -->
            <div class="flex-1 min-w-0">
                <p class="font-semibold text-sm md:text-base {{ $index < 3 ? 'text-orange-600' : 'text-gray-700' }} truncate">{{ $user->name }}</p>
                <p class="text-[10px] md:text-xs text-gray-400">{{ $user->total_orders }} đơn hàng</p>
            </div>

            <!-- Total Spent -->
            <div class="text-right">
                <p class="font-black text-sm md:text-lg {{ $index < 3 ? 'text-orange-500' : 'text-primary' }}">
                    {{ number_format($user->total_spent) }}đ
                </p>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-4 md:mt-6 pt-3 md:pt-4 border-t border-gray-100 text-center">
        <p class="text-xs text-gray-400 italic flex items-center justify-center gap-1">
            <span class="material-icons text-xs align-middle text-primary">info</span>
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