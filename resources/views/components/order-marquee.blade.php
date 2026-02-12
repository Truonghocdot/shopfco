{{-- Order Marquee Component --}}
@inject('viewDataService', 'App\Services\ViewDataService')

@php
$recentOrdersResult = $viewDataService->getRecentOrdersForMarquee(20);
$recentOrders = $recentOrdersResult->isSuccess() ? $recentOrdersResult->getData() : collect();
@endphp

<div class="border-y border-gray-200 py-3 overflow-hidden bg-white">
    <div class="container mx-auto px-4 flex items-center gap-4">
        <!-- Icon & Label -->
        <div class="flex items-center gap-2 shrink-0">
            <div class="bg-primary/10 border border-primary/20 rounded-lg p-2">
                <span class="material-icons text-primary text-xl">shopping_cart</span>
            </div>
            <span class="text-primary font-black text-sm uppercase tracking-wider">Mua gần đây:</span>
        </div>

        <!-- Marquee Content -->
        <div class="flex-1 overflow-hidden min-w-0">
            <div class="marquee-content inline-flex flex-nowrap gap-6 items-center whitespace-nowrap">
                @if($recentOrders->count() > 0)
                @foreach($recentOrders as $order)
                <div class="flex items-center gap-3 shrink-0 bg-white border border-gray-200 rounded-lg px-4 py-2 shadow-sm">
                    <span class="material-icons text-primary text-sm">person</span>
                    <span class="text-gray-800 font-semibold text-sm">
                        {{ substr($order->user->name ?? 'User', 0, 3) }}***
                    </span>
                    <span class="text-gray-400">→</span>
                    <span class="text-gray-600 text-sm">
                        {{ Str::limit($order->product->title ?? 'Sản phẩm', 30) }}
                    </span>
                    <span class="text-primary text-xs font-bold">
                        {{ number_format($order->final_amount, 0, ',', '.') }}đ
                    </span>
                </div>
                @endforeach

                <!-- Duplicate for seamless loop -->
                @foreach($recentOrders as $order)
                <div class="flex items-center gap-3 shrink-0 bg-white border border-gray-200 rounded-lg px-4 py-2 shadow-sm">
                    <span class="material-icons text-primary text-sm">person</span>
                    <span class="text-gray-800 font-semibold text-sm">
                        {{ substr($order->user->name ?? 'User', 0, 3) }}***
                    </span>
                    <span class="text-gray-400">→</span>
                    <span class="text-gray-600 text-sm">
                        {{ Str::limit($order->product->title ?? 'Sản phẩm', 30) }}
                    </span>
                    <span class="text-primary text-xs font-bold">
                        {{ number_format($order->final_amount, 0, ',', '.') }}đ
                    </span>
                </div>
                @endforeach
                @else
                <div class="text-gray-400 text-sm">Chưa có đơn hàng nào...</div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes marquee {
        0% {
            transform: translate3d(0, 0, 0);
        }

        100% {
            transform: translate3d(-50%, 0, 0);
        }
    }

    .marquee-content {
        width: max-content;
        animation: marquee 25s linear infinite;
        will-change: transform;
    }

    .marquee-content:hover {
        animation-play-state: paused;
    }
</style>