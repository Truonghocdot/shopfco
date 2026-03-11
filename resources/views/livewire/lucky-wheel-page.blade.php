<div class="min-h-screen">
    <div class="container mx-auto px-4 py-8 max-w-lg">

        <!-- Spins Counter -->
        @if($this->spinsLeft > 0)
        <div class="text-center mb-8">
            <p class="text-primary text-[10px] font-black uppercase tracking-[0.2em] mb-2">SỐ LƯỢT MỞ HÒM CÒN LẠI</p>
            <p class="text-white text-6xl font-black tracking-tighter drop-shadow-[0_0_15px_rgba(56,189,248,0.4)]">{{ $this->spinsLeft }}</p>
        </div>
        @endif

        <!-- Mystery Box Card -->
        <div class="glass rounded-3xl border border-white/10 shadow-3xl p-8 relative overflow-hidden group">
            @if (session()->has('error'))
            <div class="bg-pink-500/10 border border-pink-500/20 text-pink-500 px-4 py-3 rounded-xl mb-6 text-xs font-black uppercase tracking-widest text-center">
                {{ session('error') }}
            </div>
            @endif

            <!-- Decorative background elements -->
            <div class="absolute -top-24 -left-24 w-48 h-48 bg-primary/10 blur-[80px] rounded-full pointer-events-none group-hover:bg-primary/20 transition-all duration-700"></div>
            <div class="absolute -bottom-24 -right-24 w-48 h-48 bg-indigo-500/10 blur-[80px] rounded-full pointer-events-none group-hover:bg-indigo-500/20 transition-all duration-700"></div>

            <!-- Box Container -->
            <div class="relative flex justify-center mb-10" id="box-container">
                <!-- Energy bursts (hidden, shown on click) -->
                <div id="energy-burst" class="absolute inset-0 flex items-center justify-center opacity-0 pointer-events-none z-20">
                    <div class="w-64 h-64 bg-primary/30 blur-[60px] rounded-full animate-ping"></div>
                </div>

                <!-- Mystery Box Image -->
                <div class="relative z-10 transition-transform hover:scale-105 duration-500 cursor-pointer select-none" id="mystery-box-wrapper">
                    <img src="{{ asset('images/esport/mystery_box.png') }}" alt="Hòm Bí Ẩn" id="mystery-box"
                        class="w-72 md:w-80 drop-shadow-[0_0_30px_rgba(56,189,248,0.3)]">

                    <!-- Digital scan line -->
                    <div class="absolute inset-0 bg-linear-to-b from-transparent via-primary/20 to-transparent h-1 w-full top-0 opacity-0 group-hover:opacity-100 group-hover:top-full transition-all duration-2000 linear infinite"></div>
                </div>

                <!-- Tech pedestal under box -->
                <div class="absolute bottom-[-20px] left-1/2 -translate-x-1/2 w-64 h-12 bg-linear-to-r from-transparent via-primary/20 to-transparent rounded-full blur-xl animate-pulse"></div>
            </div>

            <!-- Action Button -->
            <div class="flex justify-center relative z-10 px-4">
                <button
                    wire:click="spin"
                    wire:loading.attr="disabled"
                    {{ $this->spinsLeft <= 0 ? 'disabled' : '' }}
                    id="shake-btn"
                    class="w-full py-5 rounded-2xl font-black text-white shadow-2xl transition-all transform active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed uppercase tracking-widest text-sm border-none btn-esport shadow-primary/20">
                    <span wire:loading.remove class="flex items-center justify-center gap-3">
                        <span class="material-icons">auto_fix_high</span>
                        MỞ HÒM NGAY!
                    </span>
                    <span wire:loading class="flex items-center justify-center gap-2">
                        <span class="material-icons animate-spin">refresh</span>
                        ĐANG XỬ LÝ...
                    </span>
                </button>
            </div>
        </div>

        <!-- Result Modal -->
        @if($showResult)
        <div class="fixed inset-0 bg-slate-950/80 backdrop-blur-md flex items-center justify-center z-50 p-6" style="animation: fadeIn 0.3s ease-out;">
            <div class="glass border border-white/10 rounded-3xl p-10 max-w-sm w-full shadow-[0_0_50px_rgba(56,189,248,0.2)] text-center relative overflow-hidden" style="animation: scaleUp 0.4s cubic-bezier(0.16, 1, 0.3, 1);">
                <!-- Animated background glow -->
                <div class="absolute -top-20 -left-20 w-40 h-40 bg-primary/20 blur-[60px] rounded-full animate-pulse"></div>
                <div class="absolute -bottom-20 -right-20 w-40 h-40 bg-indigo-500/20 blur-[60px] rounded-full animate-pulse delay-700"></div>

                <div class="mb-8 relative z-10">
                    @if($prizeAmount > 0)
                    <div class="relative inline-block">
                        <img src="{{ asset('images/esport/mystery_box_open.png') }}" alt="Phần thưởng" class="w-32 mx-auto drop-shadow-[0_0_20px_rgba(56,189,248,0.5)]" style="animation: bounceIn 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);">
                        <div class="absolute inset-0 bg-primary/20 blur-2xl rounded-full scale-0 animate-pulse-slow"></div>
                    </div>
                    @else
                    <div class="text-7xl drop-shadow-[0_0_20px_rgba(236,72,153,0.3)]">💠</div>
                    @endif
                </div>

                <h3 class="text-2xl font-black text-white mb-3 uppercase tracking-tighter relative z-10">{{ $prizeLabel }}</h3>

                @if($prizeAmount > 0)
                <p class="text-slate-500 mb-2 text-[10px] font-black uppercase tracking-widest relative z-10">SỐ DƯ MỚI</p>
                <p class="text-4xl font-black text-primary mb-8 drop-shadow-[0_0_10px_rgba(56,189,248,0.4)] relative z-10">{{ number_format($this->walletBalance) }}đ</p>
                @else
                <p class="text-slate-400 mb-8 font-bold uppercase tracking-wide text-xs relative z-10 leading-relaxed">Chúc bạn may mắn lần sau nhé! Hãy thử lại ở hòm tiếp theo.</p>
                @endif

                <button
                    wire:click="resetResult"
                    class="w-full btn-esport px-8 py-4 rounded-2xl font-black uppercase tracking-widest text-xs border-none shadow-primary/20 active:scale-95 transition-all relative z-10">
                    TIẾP TỤC
                </button>
            </div>
        </div>
        @endif

        <!-- Rules -->
        <div class="glass rounded-3xl border border-white/10 shadow-2xl mt-12 p-8 relative overflow-hidden">
            <!-- Tech background pattern -->
            <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: url('{{ asset('images/esport/bg_pattern.png') }}'); background-size: cover;"></div>

            <div class="flex items-center gap-4 mb-8">
                <div class="w-10 h-10 bg-primary/10 border border-primary/20 rounded-xl flex items-center justify-center text-primary">
                    <span class="material-icons">info</span>
                </div>
                <h3 class="text-xl font-black text-white uppercase tracking-tighter">THỂ LỆ HÒM BÍ ẨN</h3>
            </div>

            <ul class="space-y-4 relative z-10">
                <li class="flex items-start gap-4 p-4 bg-white/5 rounded-2xl border border-white/5 group hover:bg-white/10 transition-colors">
                    <div class="w-6 h-6 bg-primary/20 rounded-lg flex items-center justify-center shrink-0 text-primary text-[10px] font-black group-hover:bg-primary group-hover:text-white transition-all">01</div>
                    <span class="text-[11px] font-bold text-slate-400 leading-relaxed uppercase tracking-wide">Mỗi đơn hàng từ <strong class="text-primary">300,000đ</strong> trở lên sẽ nhận được <strong class="text-primary italic">1 lượt mở hòm</strong></span>
                </li>
                <li class="flex items-start gap-4 p-4 bg-white/5 rounded-2xl border border-white/5 group hover:bg-white/10 transition-colors">
                    <div class="w-6 h-6 bg-primary/20 rounded-lg flex items-center justify-center shrink-0 text-primary text-[10px] font-black group-hover:bg-primary group-hover:text-white transition-all">02</div>
                    <span class="text-[11px] font-bold text-slate-400 leading-relaxed uppercase tracking-wide">Ấn vào hòm hoặc nút "Mở Hòm" để nhận phần quà ngẫu nhiên</span>
                </li>
                <li class="flex items-start gap-4 p-4 bg-white/5 rounded-2xl border border-white/5 group hover:bg-white/10 transition-colors">
                    <div class="w-6 h-6 bg-primary/20 rounded-lg flex items-center justify-center shrink-0 text-primary text-[10px] font-black group-hover:bg-primary group-hover:text-white transition-all">03</div>
                    <span class="text-[11px] font-bold text-slate-400 leading-relaxed uppercase tracking-wide">Phần thưởng sẽ được cộng trực tiếp vào ví hệ thống của bạn</span>
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

        @keyframes mysteryVibrate {

            0%,
            100% {
                transform: translate(0, 0) rotate(0);
            }

            10% {
                transform: translate(-2px, -2px) rotate(-1deg);
            }

            20% {
                transform: translate(2px, 2px) rotate(1deg);
            }

            30% {
                transform: translate(-3px, 1px) rotate(-2deg);
            }

            40% {
                transform: translate(3px, -1px) rotate(2deg);
            }

            50% {
                transform: translate(-2px, 2px) rotate(-1deg);
            }

            60% {
                transform: translate(2px, -2px) rotate(1deg);
            }

            70% {
                transform: translate(-1px, -1px) rotate(-1deg);
            }

            80% {
                transform: translate(1px, 1px) rotate(1deg);
            }

            90% {
                transform: translate(0, 0) rotate(0);
            }
        }

        @keyframes energyPulse {
            0% {
                transform: scale(0.8);
                opacity: 0;
                filter: brightness(1) blur(20px);
            }

            50% {
                transform: scale(1.5);
                opacity: 0.8;
                filter: brightness(2) blur(10px);
            }

            100% {
                transform: scale(2);
                opacity: 0;
                filter: brightness(3) blur(5px);
            }
        }

        .box-vibrating {
            animation: mysteryVibrate 0.8s ease-in-out;
        }

        .energy-pulsing {
            animation: energyPulse 1.5s ease-out forwards;
        }

        .animate-pulse-slow {
            animation: pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>
</div>

@script
<script>
    (function() {
        const boxWrapper = document.getElementById('mystery-box-wrapper');
        const energy = document.getElementById('energy-burst');
        let animating = false;

        function playAnimation() {
            if (animating) return;
            animating = true;

            // Step 1: Vibrate the box
            boxWrapper.classList.add('box-vibrating');

            // Step 2: Show energy pulses
            setTimeout(() => {
                energy.style.opacity = '1';
                energy.classList.add('energy-pulsing');
            }, 200);

            // Step 3: Clean up and show result
            setTimeout(() => {
                boxWrapper.classList.remove('box-vibrating');
                energy.classList.remove('energy-pulsing');
                energy.style.opacity = '0';
                animating = false;

                @this.set('showResult', true);
                @this.set('spinning', false);
            }, 1800);
        }

        // Listen for Livewire event
        $wire.on('shake-tree', () => {
            playAnimation();
        });

        // Also allow clicking the hòm directly
        if (boxWrapper) {
            boxWrapper.addEventListener('click', () => {
                const btn = document.getElementById('shake-btn');
                if (btn && !btn.disabled) {
                    btn.click();
                }
            });
        }
    })();
</script>
@endscript