<div class="min-h-screen">
    <div class="container mx-auto px-4 py-6 max-w-lg">

        <!-- Spins Counter -->
        @if($this->spinsLeft > 0)
        <div class="text-center mb-4">
            <p class="text-primary text-sm font-bold uppercase tracking-wider">Số lượt quay còn lại</p>
            <p class="text-gray-800 text-5xl font-black animate-pulse">{{ $this->spinsLeft }}</p>
        </div>
        @endif

        <!-- Wheel Card -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-lg p-6">
            @if (session()->has('error'))
            <div class=" border border-red-200 text-red-600 px-4 py-3 rounded-lg mb-4 text-sm">
                {{ session('error') }}
            </div>
            @endif

            <!-- Canvas -->
            <div class="flex justify-center mb-6">
                <canvas id="wheelCanvas" width="360" height="390" style="max-width: 100%; height: auto; display: block; filter: drop-shadow(0 4px 20px rgba(212,32,32,0.3));"></canvas>
            </div>

            <!-- Spin Button -->
            <div class="flex justify-center">
                <button
                    wire:click="spin"
                    wire:loading.attr="disabled"
                    {{ $this->spinsLeft <= 0 ? 'disabled' : '' }}
                    class="relative px-16 py-4 rounded-full shadow-lg hover:shadow-xl transition-all active:scale-95 disabled:opacity-40 disabled:cursor-not-allowed btn-tet group overflow-hidden">
                    <span wire:loading.remove class="px-4 font-black text-lg uppercase tracking-wider relative z-10">QUAY NGAY!</span>
                    <span wire:loading class="font-semibold text-sm relative z-10 text-white">Đang quay...</span>
                </button>
            </div>
        </div>

        <!-- Result Modal -->
        @if($showResult)
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50 p-4" style="animation: fadeIn 0.2s ease-out;">
            <div class="bg-white border border-gray-200 rounded-2xl p-8 max-w-sm w-full shadow-2xl text-center" style="animation: scaleUp 0.3s ease-out;">
                <div class="mb-4 text-6xl">
                    @if($prizeAmount > 0) 🎉 @else 😊 @endif
                </div>
                <h3 class="text-2xl font-black text-primary mb-2 uppercase tracking-wide">{{ $prizeLabel }}</h3>
                @if($prizeAmount > 0)
                <p class="text-gray-500 mb-1 text-sm">Số dư mới</p>
                <p class="text-4xl font-black text-primary mb-6 animate-pulse">{{ number_format($this->walletBalance) }}đ</p>
                @else
                <p class="text-gray-500 mb-6">Chúc bạn may mắn lần sau nhé!</p>
                @endif
                <button
                    wire:click="resetResult"
                    class="w-full btn-tet px-6 py-3 rounded-xl font-black uppercase tracking-wide">
                    Đóng
                </button>
            </div>
        </div>
        @endif

        <!-- Rules -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-md mt-6 p-6">
            <div class="flex items-center gap-2 mb-4">
                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold text-sm">ℹ</div>
                <h3 class="text-lg font-black text-primary uppercase tracking-wide">Thể lệ</h3>
            </div>
            <ul class="space-y-3">
                <li class="flex items-start gap-3 text-sm text-gray-600">
                    <div class="w-5 h-5 bg-primary rounded-full flex items-center justify-center flex-shrink-0 mt-0.5 text-white text-xs font-bold">✓</div>
                    <span>Mỗi đơn hàng từ <strong class="text-primary">300,000đ</strong> trở lên sẽ nhận được <strong class="text-primary">1 lượt quay</strong></span>
                </li>
                <li class="flex items-start gap-3 text-sm text-gray-600">
                    <div class="w-5 h-5 bg-primary rounded-full flex items-center justify-center flex-shrink-0 mt-0.5 text-white text-xs font-bold">✓</div>
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
        const CANVAS_W = 360;
        const CANVAS_H = 390;
        const CX = CANVAS_W / 2;
        const CY = 195;
        const RADIUS = 155;
        const NUM_SEG = 8;
        const SEG_RAD = (2 * Math.PI) / NUM_SEG;
        const OFFSET = -Math.PI / 2;

        const SEGMENTS = [{
                amount: 200000,
                label: '200,000đ',
                color: '#ef4444'
            },
            {
                amount: 10000,
                label: '10,000đ',
                color: '#22d3ee'
            },
            {
                amount: 20000,
                label: '20,000đ',
                color: '#10b981'
            },
            {
                amount: 0,
                label: 'Chúc\nmay mắn',
                color: '#fb7185'
            },
            {
                amount: 50000,
                label: '50,000đ',
                color: '#fbbf24'
            },
            {
                amount: 10000,
                label: '10,000đ',
                color: '#22d3ee'
            },
            {
                amount: 100000,
                label: '100,000đ',
                color: '#22d3ee'
            },
            {
                amount: 0,
                label: 'Chúc\nmay mắn',
                color: '#fb7185'
            }
        ];

        let canvas, ctx;
        let curAngle = 0;
        let spinning = false;
        let startAngle = 0;
        let deltaAngle = 0;
        let startTime = 0;
        let dur = 0;

        function easeOutQuart(t) {
            return 1 - Math.pow(1 - t, 4);
        }

        function draw(rot) {
            ctx.clearRect(0, 0, CANVAS_W, CANVAS_H);

            // Pointer
            ctx.save();
            ctx.beginPath();
            ctx.moveTo(CX, CY - RADIUS - 2);
            ctx.lineTo(CX - 15, CY - RADIUS - 30);
            ctx.lineTo(CX + 15, CY - RADIUS - 30);
            ctx.closePath();
            ctx.fillStyle = '#D42020';
            ctx.shadowColor = 'rgba(212, 32, 32, 0.8)';
            ctx.shadowBlur = 15;
            ctx.fill();
            ctx.restore();

            // Wheel segments
            ctx.save();
            ctx.translate(CX, CY);
            ctx.rotate(rot);

            SEGMENTS.forEach((seg, i) => {
                const a0 = OFFSET + i * SEG_RAD;
                const a1 = a0 + SEG_RAD;

                ctx.beginPath();
                ctx.moveTo(0, 0);
                ctx.arc(0, 0, RADIUS, a0, a1);
                ctx.closePath();
                ctx.fillStyle = seg.color;
                ctx.fill();

                ctx.strokeStyle = '#fff';
                ctx.lineWidth = 3;
                ctx.shadowColor = 'rgba(255, 255, 255, 0.5)';
                ctx.shadowBlur = 5;
                ctx.stroke();

                ctx.save();
                const mid = a0 + SEG_RAD / 2;
                ctx.rotate(mid);
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                ctx.fillStyle = '#fff';
                ctx.shadowColor = 'rgba(0, 0, 0, 0.8)';
                ctx.shadowBlur = 4;
                const tR = RADIUS * 0.60;
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

            // Center hub
            ctx.shadowColor = 'rgba(212, 32, 32, 0.6)';
            ctx.shadowBlur = 20;
            ctx.beginPath();
            ctx.arc(0, 0, 34, 0, 2 * Math.PI);
            ctx.fillStyle = '#fff';
            ctx.fill();
            ctx.strokeStyle = '#D42020';
            ctx.lineWidth = 3;
            ctx.stroke();

            ctx.shadowBlur = 0;
            ctx.beginPath();
            ctx.arc(0, 0, 20, 0, 2 * Math.PI);
            ctx.fillStyle = '#ffffff';
            ctx.fill();

            ctx.beginPath();
            ctx.arc(0, 0, 7, 0, 2 * Math.PI);
            ctx.fillStyle = '#D42020';
            ctx.shadowColor = 'rgba(212, 32, 32, 0.8)';
            ctx.shadowBlur = 10;
            ctx.fill();

            ctx.restore();
        }

        function loop() {
            if (spinning) {
                const t = Math.min((Date.now() - startTime) / dur, 1);
                const eased = easeOutQuart(t);
                curAngle = startAngle + deltaAngle * eased;
                if (t >= 1) {
                    curAngle = startAngle + deltaAngle;
                    spinning = false;
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

        $wire.on('spin-wheel', (event) => {
            if (spinning) return;
            const prizeAmount = event[0].prizeAmount;
            const candidates = [];
            SEGMENTS.forEach((s, i) => {
                if (s.amount === prizeAmount) candidates.push(i);
            });
            const idx = candidates[Math.floor(Math.random() * candidates.length)];
            const segCenterBase = OFFSET + idx * SEG_RAD + SEG_RAD / 2;
            const jitter = (Math.random() - 0.5) * (24 * Math.PI / 180);
            let targetRot = (-Math.PI / 2 - segCenterBase - jitter) % (2 * Math.PI);
            let delta = (targetRot - curAngle) % (2 * Math.PI);
            if (delta < 0) delta += 2 * Math.PI;
            const fullSpins = 5 + Math.floor(Math.random() * 3);
            deltaAngle = delta + fullSpins * 2 * Math.PI;
            startAngle = curAngle;
            startTime = Date.now();
            dur = 4500 + Math.random() * 800;
            spinning = true;
        });

        function init() {
            canvas = document.getElementById('wheelCanvas');
            if (!canvas) return;
            ctx = canvas.getContext('2d');
            draw(0);
            requestAnimationFrame(loop);
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', init);
        } else {
            init();
        }
    })();
</script>
@endscript