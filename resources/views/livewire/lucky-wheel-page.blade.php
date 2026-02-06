<div class="min-h-screen bg-gradient-to-b from-black via-[#001a0f] to-black">
    <div class="container mx-auto px-4 py-6 max-w-lg">

        <!-- Spins Counter - Techno Style -->
        @if($this->spinsLeft > 0)
        <div class="text-center mb-4 relative">
            <div class="absolute inset-0 bg-primary/10 blur-2xl opacity-50"></div>
            <p class="text-primary text-sm font-bold uppercase tracking-wider drop-shadow-[0_0_8px_rgba(0,255,0,0.8)] relative z-10">Số lượt quay còn lại</p>
            <p class="text-white text-5xl font-black drop-shadow-[0_0_15px_rgba(0,255,0,0.8)] relative z-10 animate-pulse">{{ $this->spinsLeft }}</p>
        </div>
        @endif

        <!-- Wheel Card - Techno Style -->
        <div class="relative rounded-2xl border-2 border-primary/40 bg-gradient-to-br from-black via-[#001a0f] to-black shadow-[0_0_40px_rgba(0,255,0,0.3)] p-6 overflow-hidden">
            <!-- Grid Pattern -->
            <div class="absolute inset-0 opacity-10 pointer-events-none">
                <div class="absolute inset-0" style="background-image: repeating-linear-gradient(90deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 30px), repeating-linear-gradient(0deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 30px);"></div>
            </div>

            <!-- Scan Line Animation -->
            <div class="absolute inset-0 opacity-20 pointer-events-none overflow-hidden">
                <div class="h-px w-full bg-gradient-to-r from-transparent via-primary to-transparent animate-scan-vertical"></div>
            </div>

            @if (session()->has('error'))
            <div class="bg-red-900/30 border-2 border-red-500/50 text-red-300 px-4 py-3 rounded-lg mb-4 text-sm backdrop-blur-sm shadow-[0_0_15px_rgba(239,68,68,0.3)] relative z-10">
                {{ session('error') }}
            </div>
            @endif

            <!-- Canvas: pointer + wheel đều vẽ trên canvas => không bị lệch -->
            <div class="flex justify-center mb-6 relative z-10">
                <!-- Glow effect for wheel -->
                <div class="absolute inset-0 bg-primary/20 blur-3xl opacity-50"></div>
                <canvas id="wheelCanvas" width="360" height="390" style="max-width: 100%; height: auto; display: block; filter: drop-shadow(0 0 30px rgba(0, 255, 0, 0.5));"></canvas>
            </div>

            <!-- Spin Button - Techno Style -->
            <div class="flex justify-center relative z-10">
                <button
                    wire:click="spin"
                    wire:loading.attr="disabled"
                    {{ $this->spinsLeft <= 0 ? 'disabled' : '' }}
                    class="relative px-16 py-4 border-2 border-primary/50 rounded-full shadow-[0_0_25px_rgba(0,255,0,0.4)] hover:shadow-[0_0_40px_rgba(0,255,0,0.6)] hover:border-primary transition-all active:scale-95 disabled:opacity-40 disabled:cursor-not-allowed bg-gradient-to-r from-primary/20 to-green-400/20 backdrop-blur-sm group overflow-hidden">
                    <!-- Button glow effect -->
                    <div class="absolute inset-0 bg-gradient-to-r from-primary/30 to-green-400/30 opacity-0 group-hover:opacity-100 transition-opacity"></div>

                    <span wire:loading.remove class="text-primary px-4 font-black text-lg uppercase tracking-wider drop-shadow-[0_0_10px_rgba(0,255,0,0.8)] relative z-10">QUAY NGAY!</span>
                    <span wire:loading class="text-slate-400 font-semibold text-sm relative z-10">Đang quay...</span>
                </button>
            </div>
        </div>

        <!-- Result Modal - Techno Style -->
        @if($showResult)
        <div class="fixed inset-0 bg-black/80 backdrop-blur-sm flex items-center justify-center z-50 p-4" style="animation: fadeIn 0.2s ease-out;">
            <div class="relative bg-gradient-to-br from-black via-[#001a0f] to-black border-2 border-primary/50 rounded-2xl p-8 max-w-sm w-full shadow-[0_0_50px_rgba(0,255,0,0.4)] text-center overflow-hidden" style="animation: scaleUp 0.3s ease-out;">
                <!-- Grid Pattern -->
                <div class="absolute inset-0 opacity-10 pointer-events-none">
                    <div class="absolute inset-0" style="background-image: repeating-linear-gradient(90deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px), repeating-linear-gradient(0deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px);"></div>
                </div>

                <div class="mb-4 text-6xl relative z-10" style="filter: drop-shadow(0 0 20px rgba(255, 255, 0, 0.6));">
                    @if($prizeAmount > 0) 🎉 @else 😊 @endif
                </div>
                <h3 class="text-2xl font-black text-primary mb-2 drop-shadow-[0_0_15px_rgba(0,255,0,0.8)] uppercase tracking-wide relative z-10">{{ $prizeLabel }}</h3>
                @if($prizeAmount > 0)
                <p class="text-slate-400 mb-1 text-sm relative z-10">Số dư mới</p>
                <p class="text-4xl font-black text-primary mb-6 drop-shadow-[0_0_20px_rgba(0,255,0,1)] relative z-10 animate-pulse">{{ number_format($this->walletBalance) }}đ</p>
                @else
                <p class="text-slate-400 mb-6 relative z-10">Chúc bạn may mắn lần sau nhé!</p>
                @endif
                <button
                    wire:click="resetResult"
                    class="w-full bg-gradient-to-r from-primary to-green-400 text-black px-6 py-3 rounded-xl font-black hover:shadow-[0_0_30px_rgba(0,255,0,0.6)] transition-all active:scale-95 uppercase tracking-wide border-2 border-primary/50 relative z-10">
                    Đóng
                </button>
            </div>
        </div>
        @endif

        <!-- Rules - Techno Style -->
        <div class="relative bg-gradient-to-br from-black via-[#001a0f] to-black border-2 border-primary/30 rounded-2xl shadow-[0_0_30px_rgba(0,255,0,0.2)] mt-6 p-6 overflow-hidden">
            <!-- Grid Pattern -->
            <div class="absolute inset-0 opacity-10 pointer-events-none">
                <div class="absolute inset-0" style="background-image: repeating-linear-gradient(90deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px), repeating-linear-gradient(0deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px);"></div>
            </div>

            <div class="flex items-center gap-2 mb-4 relative z-10">
                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-[0_0_15px_rgba(59,130,246,0.5)]">ℹ</div>
                <h3 class="text-lg font-black text-primary drop-shadow-[0_0_10px_rgba(0,255,0,0.8)] uppercase tracking-wide">Thể lệ</h3>
            </div>
            <ul class="space-y-3 relative z-10">
                <li class="flex items-start gap-3 text-sm text-slate-300">
                    <div class="w-5 h-5 bg-gradient-to-br from-primary to-green-400 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5 text-black text-xs font-bold shadow-[0_0_10px_rgba(0,255,0,0.5)]">✓</div>
                    <span>Mỗi đơn hàng từ <strong class="text-primary drop-shadow-[0_0_8px_rgba(0,255,0,0.8)]">300,000đ</strong> trở lên sẽ nhận được <strong class="text-primary drop-shadow-[0_0_8px_rgba(0,255,0,0.8)]">1 lượt quay</strong></span>
                </li>
                <li class="flex items-start gap-3 text-sm text-slate-300">
                    <div class="w-5 h-5 bg-gradient-to-br from-primary to-green-400 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5 text-black text-xs font-bold shadow-[0_0_10px_rgba(0,255,0,0.5)]">✓</div>
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
    </style>
</div>

@script
<script>
    (function() {
        /* ================================================
           CONSTANTS
           ================================================ */
        const CANVAS_W = 360;
        const CANVAS_H = 390;
        const CX = CANVAS_W / 2; // 180  – horizontal center
        const CY = 195; // vertical center of the WHEEL (not canvas)
        const RADIUS = 155;
        const NUM_SEG = 8;
        const SEG_RAD = (2 * Math.PI) / NUM_SEG; // 45° in radians

        // Pointer tip lands at the TOP of the wheel (12 o'clock = -PI/2 in standard math)
        // We offset all segment drawing by -PI/2 so segment[0] starts at 12 o'clock.
        const OFFSET = -Math.PI / 2;

        const SEGMENTS = [{
                amount: 200000,
                label: '200,000đ',
                color: '#ef4444'
            }, // 0  → 12:00–1:30
            {
                amount: 10000,
                label: '10,000đ',
                color: '#22d3ee'
            }, // 1  → 1:30–3:00
            {
                amount: 20000,
                label: '20,000đ',
                color: '#10b981'
            }, // 2  → 3:00–4:30
            {
                amount: 0,
                label: 'Chúc\nmay mắn',
                color: '#fb7185'
            }, // 3  → 4:30–6:00
            {
                amount: 50000,
                label: '50,000đ',
                color: '#fbbf24'
            }, // 4  → 6:00–7:30
            {
                amount: 10000,
                label: '10,000đ',
                color: '#22d3ee'
            }, // 5  → 7:30–9:00
            {
                amount: 100000,
                label: '100,000đ',
                color: '#22d3ee'
            }, // 6  → 9:00–10:30
            {
                amount: 0,
                label: 'Chúc\nmay mắn',
                color: '#fb7185'
            } // 7  → 10:30–12:00
        ];

        /* ================================================
           STATE
           ================================================ */
        let canvas, ctx;
        let curAngle = 0; // current rotation (radians)
        let spinning = false;
        let startAngle = 0;
        let deltaAngle = 0; // total rotation to add
        let startTime = 0;
        let dur = 0;

        /* ================================================
           EASING
           ================================================ */
        function easeOutQuart(t) {
            return 1 - Math.pow(1 - t, 4);
        }

        /* ================================================
           DRAW
           ================================================ */
        function draw(rot) {
            ctx.clearRect(0, 0, CANVAS_W, CANVAS_H);

            /* --- Pointer (red triangle, tip pointing DOWN at 12 o'clock) --- */
            ctx.save();
            ctx.beginPath();
            ctx.moveTo(CX, CY - RADIUS - 2); // tip  (touches wheel edge)
            ctx.lineTo(CX - 15, CY - RADIUS - 30); // top-left
            ctx.lineTo(CX + 15, CY - RADIUS - 30); // top-right
            ctx.closePath();
            ctx.fillStyle = '#ef4444';
            ctx.shadowColor = 'rgba(239, 68, 68, 0.8)';
            ctx.shadowBlur = 15;
            ctx.shadowOffsetY = 0;
            ctx.fill();
            ctx.restore();

            /* --- Wheel segments --- */
            ctx.save();
            ctx.translate(CX, CY);
            ctx.rotate(rot);

            SEGMENTS.forEach((seg, i) => {
                const a0 = OFFSET + i * SEG_RAD;
                const a1 = a0 + SEG_RAD;

                // segment fill
                ctx.beginPath();
                ctx.moveTo(0, 0);
                ctx.arc(0, 0, RADIUS, a0, a1);
                ctx.closePath();
                ctx.fillStyle = seg.color;
                ctx.fill();

                // white border with glow
                ctx.strokeStyle = '#fff';
                ctx.lineWidth = 3;
                ctx.shadowColor = 'rgba(255, 255, 255, 0.5)';
                ctx.shadowBlur = 5;
                ctx.stroke();

                // text – rotated so it reads along the radius
                ctx.save();
                const mid = a0 + SEG_RAD / 2; // center angle of this segment
                ctx.rotate(mid); // X-axis now points along the radius
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                ctx.fillStyle = '#fff';
                ctx.shadowColor = 'rgba(0, 0, 0, 0.8)';
                ctx.shadowBlur = 4;

                const tR = RADIUS * 0.60; // text distance from center

                if (seg.label.includes('\n')) {
                    const [l1, l2] = seg.label.split('\n');
                    ctx.font = 'bold 14px Arial, sans-serif';
                    ctx.fillText(l1, tR, -8);
                    ctx.fillText(l2, tR, 8);
                } else {
                    ctx.font = 'bold 16px Arial, sans-serif';
                    ctx.fillText(seg.label, tR, 0);
                }
                ctx.restore();
            });

            /* --- Center hub with techno glow --- */
            ctx.shadowColor = 'rgba(0, 255, 0, 0.6)';
            ctx.shadowBlur = 20;

            ctx.beginPath();
            ctx.arc(0, 0, 34, 0, 2 * Math.PI);
            ctx.fillStyle = '#1a1a1a';
            ctx.fill();
            ctx.strokeStyle = '#00ff00';
            ctx.lineWidth = 3;
            ctx.stroke();

            ctx.shadowBlur = 0;
            ctx.beginPath();
            ctx.arc(0, 0, 20, 0, 2 * Math.PI);
            ctx.fillStyle = '#0a0a0a';
            ctx.fill();

            ctx.beginPath();
            ctx.arc(0, 0, 7, 0, 2 * Math.PI);
            ctx.fillStyle = '#00ff00';
            ctx.shadowColor = 'rgba(0, 255, 0, 0.8)';
            ctx.shadowBlur = 10;
            ctx.fill();

            ctx.restore(); // undo translate+rotate
        }

        /* ================================================
           ANIMATION LOOP
           ================================================ */
        function loop() {
            if (spinning) {
                const t = Math.min((Date.now() - startTime) / dur, 1);
                const eased = easeOutQuart(t);
                curAngle = startAngle + deltaAngle * eased;

                if (t >= 1) {
                    curAngle = startAngle + deltaAngle;
                    spinning = false;
                    // normalise
                    curAngle = curAngle % (2 * Math.PI);

                    setTimeout(() => {
                        @this.set('showResult', true);
                        @this.set('spinning', false);
                    }, 400);
                }
            }

            draw(curAngle);
            requestAnimationFrame(loop);
        }

        /* ================================================
           SPIN TRIGGER (Livewire event)
           ================================================ */
        $wire.on('spin-wheel', (event) => {
            if (spinning) return;

            const prizeAmount = event[0].prizeAmount;

            // pick a random segment that matches the prize
            const candidates = [];
            SEGMENTS.forEach((s, i) => {
                if (s.amount === prizeAmount) candidates.push(i);
            });
            const idx = candidates[Math.floor(Math.random() * candidates.length)];

            // Segment[idx] center angle trong wheel-local frame:
            const segCenterBase = OFFSET + idx * SEG_RAD + SEG_RAD / 2;

            // Small jitter ± 12°
            const jitter = (Math.random() - 0.5) * (24 * Math.PI / 180);

            // Pointer ở TOP = -PI/2 trong canvas frame.
            // Sau khi wheel rotate `rot`, point ở wheel-local angle θ hiện thị ở θ + rot.
            // Cần: segCenterBase + jitter + rot_new ≡ -PI/2  (mod 2π)
            //   rot_new    = -PI/2 - segCenterBase - jitter
            //   deltaAngle = rot_new - curAngle
            let targetRot = (-Math.PI / 2 - segCenterBase - jitter) % (2 * Math.PI);
            let delta = (targetRot - curAngle) % (2 * Math.PI);
            if (delta < 0) delta += 2 * Math.PI;

            // Add 5-7 full spins
            const fullSpins = 5 + Math.floor(Math.random() * 3);
            deltaAngle = delta + fullSpins * 2 * Math.PI;

            startAngle = curAngle;
            startTime = Date.now();
            dur = 4500 + Math.random() * 800; // 4.5 – 5.3 s
            spinning = true;

            console.log('[Wheel] → segment', idx, '| prize', prizeAmount, '| delta', (deltaAngle * 180 / Math.PI).toFixed(1), '°');
        });

        /* ================================================
           INIT
           ================================================ */
        function init() {
            canvas = document.getElementById('wheelCanvas');
            if (!canvas) {
                console.warn('[Wheel] canvas not found');
                return;
            }
            ctx = canvas.getContext('2d');
            draw(0);
            requestAnimationFrame(loop);
            console.log('[Wheel] ready');
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', init);
        } else {
            init();
        }
    })();
</script>
@endscript