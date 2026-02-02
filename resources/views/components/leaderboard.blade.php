@props(['topSpenders'])

<div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
    <div class="flex items-center gap-3 mb-6">
        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center">
            <span class="material-icons text-white text-2xl">emoji_events</span>
        </div>
        <div>
            <h3 class="text-xl font-bold text-gray-800">Bảng Xếp Hạng Đại Gia</h3>
            <p class="text-sm text-gray-500">Top người chi tiêu nhiều nhất</p>
        </div>
    </div>

    @if($topSpenders->isNotEmpty())
    <div class="space-y-3">
        @foreach($topSpenders as $index => $user)
        <div class="flex items-center gap-4 p-3 rounded-lg hover:bg-gray-50 transition {{ $index < 3 ? 'bg-gradient-to-r from-yellow-50 to-orange-50' : '' }}">
            <!-- Rank -->
            <div class="flex-shrink-0 w-10 text-center">
                @if($index === 0)
                <span class="text-3xl">🥇</span>
                @elseif($index === 1)
                <span class="text-3xl">🥈</span>
                @elseif($index === 2)
                <span class="text-3xl">🥉</span>
                @else
                <span class="text-lg font-bold text-gray-400">#{{ $index + 1 }}</span>
                @endif
            </div>

            <!-- User Info -->
            <div class="flex-1 min-w-0">
                <p class="font-semibold text-gray-800 truncate">{{ $user->name }}</p>
                <p class="text-xs text-gray-500">{{ $user->total_orders }} đơn hàng</p>
            </div>

            <!-- Total Spent -->
            <div class="text-right">
                <p class="font-bold text-lg {{ $index < 3 ? 'text-orange-600' : 'text-gray-800' }}">
                    {{ number_format($user->total_spent) }}đ
                </p>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-6 pt-4 border-t border-gray-200 text-center">
        <p class="text-xs text-gray-400 italic">
            <span class="material-icons text-xs align-middle">info</span>
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