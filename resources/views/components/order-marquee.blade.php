{{-- Order Marquee Component --}}
@inject('viewDataService', 'App\Services\ViewDataService')

@php
$recentOrdersResult = $viewDataService->getRecentOrdersForMarquee(20);
$recentOrders = $recentOrdersResult->isSuccess() ? $recentOrdersResult->getData() : collect();
@endphp

<div class="bg-gradient-to-r from-black via-[#001a0f] to-black border-y-2 border-primary/30 py-3 overflow-hidden relative">
    <!-- Grid Pattern Background -->
    <div class="absolute inset-0 opacity-5 pointer-events-none">
        <div class="absolute inset-0" style="background-image: repeating-linear-gradient(90deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px), repeating-linear-gradient(0deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px);"></div>
    </div>

    <!-- Scan Line Animation -->
    <div class="absolute inset-0 opacity-20 pointer-events-none overflow-hidden">
        <div class="h-full w-[200%] bg-gradient-to-r from-transparent via-primary/20 to-transparent animate-shimmer"></div>
    </div>

    <div class="container mx-auto px-4 flex items-center gap-4 relative z-10">
        <!-- Icon & Label -->
        <div class="flex items-center gap-2 shrink-0">
            <div class="bg-primary/20 border border-primary/50 rounded-lg p-2 shadow-[0_0_10px_rgba(0,255,0,0.3)]">
                <span class="material-icons text-primary text-xl drop-shadow-[0_0_8px_rgba(0,255,0,0.8)]">shopping_cart</span>
            </div>
            <span class="text-primary font-black text-sm uppercase tracking-wider drop-shadow-[0_0_8px_rgba(0,255,0,0.8)]">Mua gần đây:</span>
        </div>

        <!-- Marquee Content -->
        <div class="flex-1 overflow-hidden">
            <div class="marquee-content flex gap-8 items-center">
                @if($recentOrders->count() > 0)
                @foreach($recentOrders as $order)
                <div class="flex items-center gap-3 shrink-0 bg-black/40 border border-slate-700 rounded-lg px-4 py-2 shadow-[0_0_10px_rgba(0,255,0,0.1)] hover:border-primary/50 transition-colors">
                    <span class="material-icons text-primary text-sm">person</span>
                    <span class="text-white font-semibold text-sm">
                        {{ substr($order->user->name ?? 'User', 0, 3) }}***
                    </span>
                    <span class="text-slate-500">→</span>
                    <span class="text-slate-300 text-sm">
                        {{ Str::limit($order->product->title ?? 'Sản phẩm', 30) }}
                    </span>
                    <span class="text-primary text-xs font-bold">
                        {{ number_format($order->final_amount, 0, ',', '.') }}đ
                    </span>
                </div>
                @endforeach

                <!-- Duplicate for seamless loop -->
                @foreach($recentOrders as $order)
                <div class="flex items-center gap-3 shrink-0 bg-black/40 border border-slate-700 rounded-lg px-4 py-2 shadow-[0_0_10px_rgba(0,255,0,0.1)] hover:border-primary/50 transition-colors">
                    <span class="material-icons text-primary text-sm">person</span>
                    <span class="text-white font-semibold text-sm">
                        {{ substr($order->user->name ?? 'User', 0, 3) }}***
                    </span>
                    <span class="text-slate-500">→</span>
                    <span class="text-slate-300 text-sm">
                        {{ Str::limit($order->product->title ?? 'Sản phẩm', 30) }}
                    </span>
                    <span class="text-primary text-xs font-bold">
                        {{ number_format($order->final_amount, 0, ',', '.') }}đ
                    </span>
                </div>
                @endforeach
                @else
                <div class="text-slate-500 text-sm">Chưa có đơn hàng nào...</div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes marquee {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-50%);
        }
    }

    .marquee-content {
        animation: marquee 40s linear infinite;
    }

    .marquee-content:hover {
        animation-play-state: paused;
    }
</style>