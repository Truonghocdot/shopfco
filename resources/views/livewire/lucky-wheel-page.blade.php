<div class="min-h-screen">
    <div class="container mx-auto px-4 py-6 max-w-lg">

        <!-- Spins Counter -->
        @if($this->spinsLeft > 0)
        <div class="text-center mb-4">
            <p class="text-primary text-sm font-bold uppercase tracking-wider">Số lượt hái lộc còn lại</p>
            <p class="text-gray-800 text-5xl font-black animate-pulse">{{ $this->spinsLeft }}</p>
        </div>
        @endif

        <!-- Lucky Tree Card -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-lg p-6 relative overflow-hidden">
            @if (session()->has('error'))
            <div class="border border-red-200 text-red-600 px-4 py-3 rounded-lg mb-4 text-sm">
                {{ session('error') }}
            </div>
            @endif

            <!-- Decorative corner flowers -->
            <img src="{{ asset('images/hoa1.webp') }}" alt="" class="absolute -top-6 -left-6 w-28 opacity-80 -rotate-12 pointer-events-none">
            <img src="{{ asset('images/hoa3.webp') }}" alt="" class="absolute -top-4 -right-6 w-24 opacity-75 rotate-12 pointer-events-none">

            <!-- Tree Container -->
            <div class="relative flex justify-center mb-6" id="tree-container">
                <!-- Firecrackers (hidden, shown on shake) -->
                <img src="{{ asset('images/phao1.webp') }}" alt="Pháo hoa" id="fireworks-left"
                    class="absolute -left-8 top-2 w-28 md:w-36 opacity-0 pointer-events-none z-20 transition-none">
                <img src="{{ asset('images/phao4.webp') }}" alt="Pháo hoa" id="fireworks-right"
                    class="absolute -right-8 top-2 w-28 md:w-36 opacity-0 pointer-events-none z-20 transition-none">

                <!-- Envelope (hidden, flies up on shake) -->
                <div id="envelope-container" class="absolute inset-0 flex items-center justify-center z-30 pointer-events-none">
                    <img src="{{ asset('images/lixi1.png') }}" alt="Lì xì" id="envelope"
                        class="w-32 md:w-40 opacity-0 transition-none">
                </div>

                <!-- The Lucky Tree -->
                <img src="{{ asset('images/cay.webp') }}" alt="Cây Hái Lộc" id="lucky-tree"
                    class="w-72 md:w-80 cursor-pointer select-none drop-shadow-lg transition-transform hover:scale-105"
                    style="filter: drop-shadow(0 8px 30px rgba(212,32,32,0.2));">

                <!-- Glow ring under tree -->
                <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-48 h-8 bg-gradient-to-r from-transparent via-yellow-300/30 to-transparent rounded-full blur-md animate-pulse"></div>
            </div>

            <!-- Shake Button -->
            <div class="flex justify-center relative z-10">
                <button
                    wire:click="spin"
                    wire:loading.attr="disabled"
                    {{ $this->spinsLeft <= 0 ? 'disabled' : '' }}
                    id="shake-btn"
                    class="relative px-12 py-4 rounded-full shadow-lg hover:shadow-xl transition-all active:scale-95 disabled:opacity-40 disabled:cursor-not-allowed btn-tet group overflow-hidden">
                    <span wire:loading.remove class="px-4 font-black text-lg uppercase tracking-wider relative z-10 flex items-center gap-2">
                        🌳 HÁI LỘC NGAY!
                    </span>
                    <span wire:loading class="font-semibold text-sm relative z-10 text-white">Đang hái lộc...</span>
                </button>
            </div>
        </div>

        <!-- Result Modal -->
        @if($showResult)
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50 p-4" style="animation: fadeIn 0.2s ease-out;">
            <div class="bg-white border border-gray-200 rounded-2xl p-8 max-w-sm w-full shadow-2xl text-center relative overflow-hidden" style="animation: scaleUp 0.3s ease-out;">
                <!-- Decorative firecrackers in modal -->
                <img src="{{ asset('images/phao3.webp') }}" alt="" class="absolute -top-8 -left-8 w-28 opacity-80 -rotate-12">
                <img src="{{ asset('images/phao2.webp') }}" alt="" class="absolute -top-8 -right-8 w-28 opacity-80 rotate-12">
                <!-- Decorative flowers -->
                <img src="{{ asset('images/hoa2.webp') }}" alt="" class="absolute -bottom-4 -right-4 w-20 opacity-75 rotate-6">

                <div class="mb-4 relative z-10">
                    @if($prizeAmount > 0)
                    <img src="{{ asset('images/lixi2.png') }}" alt="Phần thưởng" class="w-28 mx-auto mb-2" style="animation: bounceIn 0.5s ease-out;">
                    @else
                    <div class="text-6xl">😊</div>
                    @endif
                </div>
                <h3 class="text-2xl font-black text-primary mb-2 uppercase tracking-wide relative z-10">{{ $prizeLabel }}</h3>
                @if($prizeAmount > 0)
                <p class="text-gray-500 mb-1 text-sm relative z-10">Số dư mới</p>
                <p class="text-4xl font-black text-primary mb-6 animate-pulse relative z-10">{{ number_format($this->walletBalance) }}đ</p>
                @else
                <p class="text-gray-500 mb-6 relative z-10">Chúc bạn may mắn lần sau nhé!</p>
                @endif
                <button
                    wire:click="resetResult"
                    class="w-full btn-tet px-6 py-3 rounded-xl font-black uppercase tracking-wide relative z-10">
                    Đóng
                </button>
            </div>
        </div>
        @endif

        <!-- Rules -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-md mt-6 p-6 relative overflow-hidden">
            <!-- Decorative flower -->
            <img src="{{ asset('images/hoa5.png') }}" alt="" class="absolute -bottom-4 -right-4 w-20 opacity-75 rotate-6 pointer-events-none">

            <div class="flex items-center gap-2 mb-4">
                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold text-sm">ℹ</div>
                <h3 class="text-lg font-black text-primary uppercase tracking-wide">Thể lệ Cây Hái Lộc</h3>
            </div>
            <ul class="space-y-3 relative z-10">
                <li class="flex items-start gap-3 text-sm text-gray-600">
                    <div class="w-5 h-5 bg-primary rounded-full flex items-center justify-center shrink-0 mt-0.5 text-white text-xs font-bold">✓</div>
                    <span>Mỗi đơn hàng từ <strong class="text-primary">300,000đ</strong> trở lên sẽ nhận được <strong class="text-primary">1 lượt hái lộc</strong></span>
                </li>
                <li class="flex items-start gap-3 text-sm text-gray-600">
                    <div class="w-5 h-5 bg-primary rounded-full flex items-center justify-center shrink-0 mt-0.5 text-white text-xs font-bold">✓</div>
                    <span>Ấn vào cây hoặc nút "Hái Lộc" để nhận bao lì xì may mắn</span>
                </li>
                <li class="flex items-start gap-3 text-sm text-gray-600">
                    <div class="w-5 h-5 bg-primary rounded-full flex items-center justify-center shrink-0 mt-0.5 text-white text-xs font-bold">✓</div>
                    <span>Giải thưởng sẽ được cộng trực tiếp vào ví của bạn</span>
                </li>
            </ul>
        </div>
    </div>

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes scaleUp {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes bounceIn {
            0% {
                transform: scale(0.3);
                opacity: 0;
            }

            50% {
                transform: scale(1.1);
            }

            70% {
                transform: scale(0.9);
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes shakeTree {

            0%,
            100% {
                transform: rotate(0deg);
            }

            10% {
                transform: rotate(-8deg);
            }

            20% {
                transform: rotate(8deg);
            }

            30% {
                transform: rotate(-6deg);
            }

            40% {
                transform: rotate(6deg);
            }

            50% {
                transform: rotate(-4deg);
            }

            60% {
                transform: rotate(4deg);
            }

            70% {
                transform: rotate(-2deg);
            }

            80% {
                transform: rotate(2deg);
            }

            90% {
                transform: rotate(-1deg);
            }
        }

        @keyframes envelopeFly {
            0% {
                transform: translateY(40px) scale(0.3) rotate(-10deg);
                opacity: 0;
            }

            30% {
                transform: translateY(-20px) scale(1.1) rotate(5deg);
                opacity: 1;
            }

            50% {
                transform: translateY(-60px) scale(1.2) rotate(-3deg);
                opacity: 1;
            }

            70% {
                transform: translateY(-40px) scale(1.0) rotate(2deg);
                opacity: 1;
            }

            100% {
                transform: translateY(-30px) scale(1.0) rotate(0deg);
                opacity: 0;
            }
        }

        @keyframes fireworksBurst {
            0% {
                transform: scale(0.5);
                opacity: 0;
            }

            30% {
                transform: scale(1.2);
                opacity: 0.9;
            }

            60% {
                transform: scale(1.0);
                opacity: 0.7;
            }

            100% {
                transform: scale(1.3);
                opacity: 0;
            }
        }

        .tree-shaking {
            animation: shakeTree 1.2s ease-in-out;
        }

        .envelope-flying {
            animation: envelopeFly 2s ease-out forwards;
        }

        .fireworks-burst {
            animation: fireworksBurst 1.8s ease-out forwards;
        }
    </style>
</div>

@script
<script>
    (function() {
        const tree = document.getElementById('lucky-tree');
        const envelope = document.getElementById('envelope');
        const fireworksLeft = document.getElementById('fireworks-left');
        const fireworksRight = document.getElementById('fireworks-right');
        let animating = false;

        function playAnimation() {
            if (animating) return;
            animating = true;

            // Step 1: Shake the tree
            tree.classList.add('tree-shaking');

            // Step 2: After 0.4s, show envelope flying up
            setTimeout(() => {
                envelope.style.opacity = '1';
                envelope.classList.add('envelope-flying');
            }, 400);

            // Step 3: After 0.8s, show firecrackers
            setTimeout(() => {
                fireworksLeft.style.opacity = '1';
                fireworksLeft.classList.add('fireworks-burst');
                fireworksRight.style.opacity = '1';
                fireworksRight.classList.add('fireworks-burst');
            }, 800);

            // Step 4: Clean up animations, show result
            setTimeout(() => {
                tree.classList.remove('tree-shaking');
                envelope.classList.remove('envelope-flying');
                envelope.style.opacity = '0';
                fireworksLeft.classList.remove('fireworks-burst');
                fireworksLeft.style.opacity = '0';
                fireworksRight.classList.remove('fireworks-burst');
                fireworksRight.style.opacity = '0';
                animating = false;

                @this.set('showResult', true);
                @this.set('spinning', false);
            }, 2200);
        }

        // Listen for Livewire event
        $wire.on('shake-tree', () => {
            playAnimation();
        });

        // Also allow clicking the tree directly (triggers the button)
        if (tree) {
            tree.addEventListener('click', () => {
                const btn = document.getElementById('shake-btn');
                if (btn && !btn.disabled) {
                    btn.click();
                }
            });
        }
    })();
</script>
@endscript