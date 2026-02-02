<div class="min-h-screen bg-black">
    <div class="container mx-auto px-4 py-6 max-w-lg">

        <!-- Spins Counter -->
        @if($this->spinsLeft > 0)
        <div class="text-center mb-4">
            <p class="text-green-400 text-sm">Số lượt quay còn lại</p>
            <p class="text-white text-3xl font-bold">{{ $this->spinsLeft }}</p>
        </div>
        @endif

        <!-- Wheel Card -->
        <div class="bg-white rounded-2xl shadow-xl p-6">
            @if (session()->has('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4 text-sm">
                {{ session('error') }}
            </div>
            @endif

            <!-- Canvas: pointer + wheel đều vẽ trên canvas => không bị lệch -->
            <div class="flex justify-center mb-6">
                <canvas id="wheelCanvas" width="360" height="390" style="max-width: 100%; height: auto; display: block;"></canvas>
            </div>

            <!-- Spin Button -->
            <div class="flex justify-center">
                <button
                    wire:click="spin"
                    wire:loading.attr="disabled"
                    {{ $this->spinsLeft <= 0 ? 'disabled' : '' }}
                    class="px-16 py-3 bg-white border-2 border-gray-300 rounded-full shadow-md hover:shadow-lg hover:border-gray-400 transition-all active:scale-95 disabled:opacity-40 disabled:cursor-not-allowed">
                    <span wire:loading.remove class="text-gray-400 font-semibold text-base uppercase tracking-wider">QUAY NGAY!</span>
                    <span wire:loading class="text-gray-400 font-semibold text-sm">Đang quay...</span>
                </button>
            </div>
        </div>

        <!-- Result Modal -->
        @if($showResult)
        <div class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50 p-4" style="animation: fadeIn 0.2s ease-out;">
            <div class="bg-white rounded-2xl p-8 max-w-sm w-full shadow-2xl text-center" style="animation: scaleUp 0.3s ease-out;">
                <div class="mb-4 text-6xl">
                    @if($prizeAmount > 0) 🎉 @else 😊 @endif
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $prizeLabel }}</h3>
                @if($prizeAmount > 0)
                    <p class="text-gray-500 mb-1">Số dư mới</p>
                    <p class="text-3xl font-bold text-green-600 mb-6">{{ number_format($this->walletBalance) }}đ</p>
                @else
                    <p class="text-gray-500 mb-6">Chúc bạn may mắn lần sau nhé!</p>
                @endif
                <button
                    wire:click="resetResult"
                    class="w-full bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-3 rounded-xl font-semibold hover:shadow-lg transition-all active:scale-95">
                    Đóng
                </button>
            </div>
        </div>
        @endif

        <!-- Rules -->
        <div class="bg-white rounded-2xl shadow-lg mt-6 p-6">
            <div class="flex items-center gap-2 mb-4">
                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold text-sm">ℹ</div>
                <h3 class="text-lg font-bold text-gray-800">Thể lệ</h3>
            </div>
            <ul class="space-y-3">
                <li class="flex items-start gap-3 text-sm text-gray-700">
                    <div class="w-5 h-5 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5 text-white text-xs font-bold">✓</div>
                    <span>Mỗi đơn hàng từ <strong>300,000đ</strong> trở lên sẽ nhận được <strong>1 lượt quay</strong></span>
                </li>
                <li class="flex items-start gap-3 text-sm text-gray-700">
                    <div class="w-5 h-5 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5 text-white text-xs font-bold">✓</div>
                    <span>Giải thưởng sẽ được cộng trực tiếp vào ví của bạn</span>
                </li>
            </ul>
        </div>
    </div>

    <style>
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes scaleUp { from { opacity: 0; transform: scale(0.9); } to { opacity: 1; transform: scale(1); } }
    </style>
</div>

@script
<script>
(function () {
    /* ================================================
       CONSTANTS
       ================================================ */
    const CANVAS_W   = 360;
    const CANVAS_H   = 390;
    const CX         = CANVAS_W / 2;          // 180  – horizontal center
    const CY         = 195;                   // vertical center of the WHEEL (not canvas)
    const RADIUS     = 155;
    const NUM_SEG    = 8;
    const SEG_RAD    = (2 * Math.PI) / NUM_SEG;   // 45° in radians

    // Pointer tip lands at the TOP of the wheel (12 o'clock = -PI/2 in standard math)
    // We offset all segment drawing by -PI/2 so segment[0] starts at 12 o'clock.
    const OFFSET     = -Math.PI / 2;

    const SEGMENTS = [
        { amount: 200000, label: '200,000đ',     color: '#ef4444' },   // 0  → 12:00–1:30
        { amount: 10000,  label: '10,000đ',      color: '#22d3ee' },   // 1  → 1:30–3:00
        { amount: 20000,  label: '20,000đ',      color: '#10b981' },   // 2  → 3:00–4:30
        { amount: 0,      label: 'Chúc\nmay mắn',color: '#fb7185' },   // 3  → 4:30–6:00
        { amount: 50000,  label: '50,000đ',      color: '#fbbf24' },   // 4  → 6:00–7:30
        { amount: 10000,  label: '10,000đ',      color: '#22d3ee' },   // 5  → 7:30–9:00
        { amount: 100000, label: '100,000đ',     color: '#22d3ee' },   // 6  → 9:00–10:30
        { amount: 0,      label: 'Chúc\nmay mắn',color: '#fb7185' }    // 7  → 10:30–12:00
    ];

    /* ================================================
       STATE
       ================================================ */
    let canvas, ctx;
    let curAngle   = 0;          // current rotation (radians)
    let spinning   = false;
    let startAngle = 0;
    let deltaAngle = 0;          // total rotation to add
    let startTime  = 0;
    let dur        = 0;

    /* ================================================
       EASING
       ================================================ */
    function easeOutQuart(t) { return 1 - Math.pow(1 - t, 4); }

    /* ================================================
       DRAW
       ================================================ */
    function draw(rot) {
        ctx.clearRect(0, 0, CANVAS_W, CANVAS_H);

        /* --- Pointer (red triangle, tip pointing DOWN at 12 o'clock) --- */
        ctx.save();
        ctx.beginPath();
        ctx.moveTo(CX,      CY - RADIUS - 2);   // tip  (touches wheel edge)
        ctx.lineTo(CX - 15, CY - RADIUS - 30);  // top-left
        ctx.lineTo(CX + 15, CY - RADIUS - 30);  // top-right
        ctx.closePath();
        ctx.fillStyle    = '#ef4444';
        ctx.shadowColor  = 'rgba(0,0,0,0.3)';
        ctx.shadowBlur   = 5;
        ctx.shadowOffsetY= 2;
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

            // white border
            ctx.strokeStyle = '#fff';
            ctx.lineWidth   = 3;
            ctx.stroke();

            // text – rotated so it reads along the radius
            ctx.save();
            const mid = a0 + SEG_RAD / 2;          // center angle of this segment
            ctx.rotate(mid);                        // X-axis now points along the radius
            ctx.textAlign    = 'center';
            ctx.textBaseline = 'middle';
            ctx.fillStyle    = '#fff';

            const tR = RADIUS * 0.60;               // text distance from center

            if (seg.label.includes('\n')) {
                const [l1, l2] = seg.label.split('\n');
                ctx.font = 'bold 14px Arial, sans-serif';
                ctx.fillText(l1, tR, -8);
                ctx.fillText(l2, tR,  8);
            } else {
                ctx.font = 'bold 16px Arial, sans-serif';
                ctx.fillText(seg.label, tR, 0);
            }
            ctx.restore();
        });

        /* --- Center hub --- */
        ctx.beginPath();
        ctx.arc(0, 0, 34, 0, 2 * Math.PI);
        ctx.fillStyle = '#fff';
        ctx.fill();
        ctx.strokeStyle = '#e5e7eb';
        ctx.lineWidth = 3;
        ctx.stroke();

        ctx.beginPath();
        ctx.arc(0, 0, 20, 0, 2 * Math.PI);
        ctx.fillStyle = '#f3f4f6';
        ctx.fill();

        ctx.beginPath();
        ctx.arc(0, 0, 7, 0, 2 * Math.PI);
        ctx.fillStyle = '#d1d5db';
        ctx.fill();

        ctx.restore();                              // undo translate+rotate
    }

    /* ================================================
       ANIMATION LOOP
       ================================================ */
    function loop() {
        if (spinning) {
            const t        = Math.min((Date.now() - startTime) / dur, 1);
            const eased    = easeOutQuart(t);
            curAngle       = startAngle + deltaAngle * eased;

            if (t >= 1) {
                curAngle   = startAngle + deltaAngle;
                spinning   = false;
                // normalise
                curAngle   = curAngle % (2 * Math.PI);

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
        SEGMENTS.forEach((s, i) => { if (s.amount === prizeAmount) candidates.push(i); });
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
        let delta     = (targetRot - curAngle) % (2 * Math.PI);
        if (delta < 0) delta += 2 * Math.PI;

        // Add 5-7 full spins
        const fullSpins = 5 + Math.floor(Math.random() * 3);
        deltaAngle = delta + fullSpins * 2 * Math.PI;

        startAngle = curAngle;
        startTime  = Date.now();
        dur        = 4500 + Math.random() * 800;   // 4.5 – 5.3 s
        spinning   = true;

        console.log('[Wheel] → segment', idx, '| prize', prizeAmount, '| delta', (deltaAngle * 180 / Math.PI).toFixed(1), '°');
    });

    /* ================================================
       INIT
       ================================================ */
    function init() {
        canvas = document.getElementById('wheelCanvas');
        if (!canvas) { console.warn('[Wheel] canvas not found'); return; }
        ctx    = canvas.getContext('2d');
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