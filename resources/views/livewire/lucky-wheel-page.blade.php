<div class="min-h-screen bg-black overflow-hidden relative">
    <!-- Summer Decorations -->
    <div class="absolute inset-0 z-0 pointer-events-none">
        <!-- Neon Sun -->
        <div class="absolute -top-20 left-1/2 -translate-x-1/2 w-96 h-96 bg-white/5 blur-[120px] rounded-full"></div>
        <!-- Sea Waves Pattern -->
        <div class="absolute bottom-0 left-0 w-full h-64 opacity-20" style="background: linear-gradient(transparent, var(--color-primary)); mask-image: radial-gradient(circle at 50% 100%, black, transparent 70%);"></div>

        <!-- Neon Palm Tree Left -->
        <div class="absolute -bottom-10 -left-20 w-64 h-96 opacity-10 blur-[2px] rotate-12">
            <span class="material-icons text-[200px] text-primary">park</span>
        </div>
        <!-- Neon Palm Tree Right -->
        <div class="absolute -bottom-10 -right-20 w-64 h-96 opacity-10 blur-[2px] -rotate-12">
            <span class="material-icons text-[200px] text-primary">park</span>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8 max-w-2xl relative z-10">
        <!-- Header -->
        <div class="text-center mb-12">
            <div class="inline-block px-4 py-1.5 rounded-full bg-primary/10 border border-primary/20 mb-4 animate-bounce">
                <span class="text-[10px] font-black text-primary uppercase tracking-[0.3em]">SUMMER EVENT 2024</span>
            </div>
            <h1 class="text-4xl md:text-6xl font-black text-white italic tracking-tighter uppercase mb-2">
                LƯỚT SÓNG <span class="text-primary drop-shadow-[0_0_15px_rgba(0,255,133,0.6)]">NHẬN QUÀ</span>
            </h1>
            <p class="text-neutral-500 font-bold uppercase tracking-widest text-xs">Ride the wave • Claim the prize • Extreme Luck</p>
        </div>

        <!-- Spins Counter -->
        <div class="flex justify-center mb-12">
            <div class="glass px-8 py-4 rounded-3xl border border-white/5 shadow-2xl flex flex-col items-center group overflow-hidden">
                <div class="absolute inset-0 bg-primary/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <p class="text-[9px] font-black text-neutral-500 uppercase tracking-widest mb-1 relative z-10">LƯỢT LƯỚT CÒN LẠI</p>
                <p class="text-4xl font-black text-white relative z-10 italic">{{ $this->spinsLeft }}</p>
            </div>
        </div>

        <!-- Summer Surfing Arena -->
        <div class="relative mb-16">
            @if (session()->has('error'))
            <div class="absolute -top-16 left-0 w-full bg-pink-500/10 border border-pink-500/20 text-pink-500 px-4 py-3 rounded-2xl text-xs font-black uppercase tracking-widest text-center animate-shake z-30">
                {{ session('error') }}
            </div>
            @endif

            <!-- The Carousel Container -->
            <div class="glass rounded-[3rem] border border-white/10 p-1 bg-black/40 overflow-hidden relative shadow-[0_0_50px_rgba(0,0,0,0.5)]">
                <!-- Center Indicator (The Surfboard) -->
                <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 z-20 pointer-events-none">
                    <div class="relative group/surf">
                        <!-- Surfboard Shape -->
                        <div class="w-2 h-48 bg-primary shadow-[0_0_20px_rgba(0,255,133,0.8)] rounded-full animate-float"></div>
                        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-32 h-32 bg-primary/10 blur-3xl rounded-full"></div>
                        <!-- "Stop Here" Label -->
                        <div class="absolute -top-8 left-1/2 -translate-x-1/2 whitespace-nowrap">
                            <span class="text-[8px] font-black text-primary uppercase tracking-[0.2em] bg-black/80 px-2 py-1 rounded-md border border-primary/20">TARGET</span>
                        </div>
                    </div>
                </div>

                <!-- Scrolling Prizes Dải phần thưởng -->
                <div class="relative h-64 flex items-center overflow-hidden mask-fade-edges" id="surfing-track">
                    <div class="flex items-center gap-4 transition-transform duration-[3000ms] cubic-bezier(0.16, 1, 0.3, 1)" id="prize-slider">
                        <!-- Prizes will be duplicated by JS for infinite-ish loop -->
                        @for($i = 0; $i < 40; $i++)
                            <div class="shrink-0 w-32 h-40 rounded-2xl bg-neutral-900/50 border border-white/5 flex flex-col items-center justify-center p-4 transition-all group/item hover:border-primary/30">
                            <div class="w-16 h-16 rounded-full bg-black/50 border border-white/5 flex items-center justify-center mb-4 group-hover/item:scale-110 transition-transform">
                                <span class="material-icons text-3xl {{ $i % 5 == 0 ? 'text-primary' : 'text-neutral-700' }}">
                                    {{ $i % 5 == 0 ? 'card_giftcard' : 'savings' }}
                                </span>
                            </div>
                            <p class="text-[9px] font-black text-neutral-500 uppercase tracking-widest">GIFT #{{ $i+1 }}</p>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>

    <!-- Action Button -->
    <div class="flex flex-col items-center gap-6 relative z-10 px-4">
        <button
            wire:click="spin"
            wire:loading.attr="disabled"
            {{ $this->spinsLeft <= 0 ? 'disabled' : '' }}
            id="surf-btn"
            class="group relative w-full max-w-sm py-6 rounded-[2rem] font-black text-white shadow-2xl transition-all transform active:scale-95 disabled:opacity-30 disabled:grayscale overflow-hidden border-none btn-esport">
            <!-- Waves background in button -->
            <div class="absolute bottom-0 left-0 w-full h-1 bg-white/20 blur-[1px]"></div>

            <span wire:loading.remove class="flex items-center justify-center gap-3 relative z-10 text-base italic tracking-tighter">
                <span class="material-icons text-xl">surfing</span>
                BẮT ĐẦU LƯỚT NGAY
            </span>
            <span wire:loading class="flex items-center justify-center gap-2 relative z-10">
                <span class="material-icons animate-spin">refresh</span>
                ĐANG RẼ SÓNG...
            </span>

            <!-- Speed lines effect -->
            <div class="absolute inset-x-0 top-0 h-px bg-linear-to-r from-transparent via-white/40 to-transparent -translate-x-full group-hover:animate-shimmer"></div>
        </button>
        <p class="text-[10px] font-bold text-neutral-600 uppercase tracking-[0.3em]">Cơ hội nhận đến 1,000,000đ trực tiếp vào ví</p>
    </div>

    <!-- Result Modal -->
    @if($showResult)
    <div class="fixed inset-0 bg-black/90 backdrop-blur-xl flex items-center justify-center z-50 p-6" style="animation: fadeIn 0.4s ease-out;">
        <div class="glass border border-primary/20 rounded-[3rem] p-12 max-w-md w-full shadow-[0_0_80px_rgba(0,255,133,0.2)] text-center relative overflow-hidden" style="animation: bounceIn 0.6s cubic-bezier(0.16, 1, 0.3, 1);">
            <div class="absolute -top-32 -left-32 w-64 h-64 bg-primary/10 blur-[100px] rounded-full animate-pulse-slow"></div>

            <div class="mb-8 relative z-10">
                <div class="w-32 h-32 bg-primary/20 rounded-full flex items-center justify-center mx-auto shadow-[0_0_30px_rgba(0,255,133,0.3)] animate-float">
                    <span class="material-icons text-6xl text-primary drop-shadow-[0_0_10px_rgba(0,255,133,0.5)]">
                        {{ $prizeAmount > 0 ? 'celebration' : 'sentiment_dissatisfied' }}
                    </span>
                </div>
            </div>

            <h3 class="text-3xl font-black text-white mb-4 italic uppercase tracking-tighter relative z-10">
                {{ $prizeAmount > 0 ? 'CHÚC MỪNG BẠN!' : 'HẸN GẶP LẠI!' }}
            </h3>
            <p class="text-primary font-black text-xl mb-8 relative z-10 tracking-tight">{{ $prizeLabel }}</p>

            @if($prizeAmount > 0)
            <div class="bg-white/5 border border-white/5 rounded-2xl p-6 mb-8 relative z-10">
                <p class="text-[10px] font-black text-neutral-500 uppercase tracking-widest mb-1">CẬP NHẬT SỐ DƯ VÍ</p>
                <p class="text-3xl font-black text-white italic tracking-tighter">{{ number_format($this->walletBalance) }}đ</p>
            </div>
            @endif

            <button
                wire:click="resetResult"
                class="w-full py-4 rounded-2xl bg-white text-black font-black uppercase tracking-widest text-xs hover:bg-primary transition-all active:scale-95 relative z-10 border-none">
                TIẾP TỤC TRẢI NGHIỆM
            </button>
        </div>
    </div>
    @endif
    <!-- Rules -->
    <div class="glass rounded-[2.5rem] border border-white/10 shadow-2xl mt-12 p-10 relative overflow-hidden">
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: url('{{ asset('images/esport/bg_pattern.png') }}'); background-size: cover;"></div>

        <div class="flex items-center gap-4 mb-8 relative z-10">
            <div class="w-12 h-12 bg-primary/10 border border-primary/20 rounded-2xl flex items-center justify-center text-primary">
                <span class="material-icons">help_outline</span>
            </div>
            <h3 class="text-2xl font-black text-white uppercase tracking-tighter italic">LUẬT CHƠI RẼ SÓNG</h3>
        </div>

        <ul class="space-y-4 relative z-10">
            <li class="flex items-start gap-4 p-5 bg-white/5 rounded-3xl border border-white/5 group hover:bg-white/10 transition-colors">
                <div class="w-8 h-8 bg-primary/20 rounded-xl flex items-center justify-center shrink-0 text-primary text-xs font-black group-hover:bg-primary group-hover:text-black transition-all">01</div>
                <span class="text-xs font-bold text-neutral-400 leading-relaxed uppercase tracking-wide">Mỗi lượt nạp hoặc đơn hàng đạt mốc quy định sẽ nhận được <strong class="text-primary italic">Lượt Lướt Sóng</strong> tương ứng.</span>
            </li>
            <li class="flex items-start gap-4 p-5 bg-white/5 rounded-3xl border border-white/5 group hover:bg-white/10 transition-colors">
                <div class="w-8 h-8 bg-primary/20 rounded-xl flex items-center justify-center shrink-0 text-primary text-xs font-black group-hover:bg-primary group-hover:text-black transition-all">02</div>
                <span class="text-xs font-bold text-neutral-400 leading-relaxed uppercase tracking-wide">Nhấn nút "BẮT ĐẦU LƯỚT" để bắt đầu hành trình săn quà Neon.</span>
            </li>
            <li class="flex items-start gap-4 p-5 bg-white/5 rounded-3xl border border-white/5 group hover:bg-white/10 transition-colors">
                <div class="w-8 h-8 bg-primary/20 rounded-xl flex items-center justify-center shrink-0 text-primary text-xs font-black group-hover:bg-primary group-hover:text-black transition-all">03</div>
                <span class="text-xs font-bold text-neutral-400 leading-relaxed uppercase tracking-wide">Phần quà sẽ được cộng vào ví của bạn ngay khi ván trượt dừng lại.</span>
            </li>
        </ul>
    </div>
</div>

<style>
    .mask-fade-edges {
        mask-image: linear-gradient(to right, transparent, black 15%, black 85%, transparent);
        -webkit-mask-image: linear-gradient(to right, transparent, black 15%, black 85%, transparent);
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes bounceIn {
        0% {
            transform: scale(0.3);
            opacity: 0;
        }

        50% {
            transform: scale(1.05);
        }

        70% {
            transform: scale(0.95);
        }

        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    @keyframes shimmer {
        100% {
            transform: translateX(100%);
        }
    }

    .animate-shimmer {
        animation: shimmer 1.5s infinite;
    }

    .animate-float {
        animation: float 2s ease-in-out infinite;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    .animate-pulse-slow {
        animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    @keyframes pulse {

        0%,
        100% {
            opacity: 0.1;
        }

        50% {
            opacity: 0.2;
        }
    }

    /* Custom Bezier for the surf stop */
    .cubic-bezier-surf {
        transition-timing-function: cubic-bezier(0.15, 0, 0.15, 1);
    }
</style>
</div>

@script
<script>
    (function() {
        const slider = document.getElementById('prize-slider');
        let currentPos = 0;
        let isSpinning = false;

        function playSurfingAnimation() {
            if (isSpinning) return;
            isSpinning = true;

            // Reset position to center first if needed
            slider.style.transition = 'none';
            slider.style.transform = 'translateX(0)';

            // Wait a frame
            setTimeout(() => {
                // Large distance for the effect of high speed
                // Each prize box is 32px (w-32) + 4px (gap-4) = 144px
                const prizeWidth = 144;
                const randomSpins = Math.floor(Math.random() * 10) + 15; // 15-25 prizes
                const targetPos = -(randomSpins * prizeWidth);

                slider.style.transition = 'transform 3s cubic-bezier(0.15, 0, 0.15, 1)';
                slider.style.transform = `translateX(${targetPos}px)`;

                // End of animation
                setTimeout(() => {
                    isSpinning = false;
                    @this.set('showResult', true);
                    @this.set('spinning', false);
                }, 3200);
            }, 50);
        }

        // Listen for Livewire event
        $wire.on('shake-tree', () => {
            playSurfingAnimation();
        });

    })();
</script>
@endscript