<div class="min-h-screen bg-black overflow-hidden relative">
    <!-- Summer Decorations -->
    <div class="absolute inset-0 z-0 pointer-events-none">
        <div class="absolute -top-20 left-1/2 -translate-x-1/2 w-96 h-96 bg-white/5 blur-[120px] rounded-full"></div>
        <div class="absolute bottom-0 left-0 w-full h-64 opacity-20" style="background: linear-gradient(transparent, var(--color-primary)); mask-image: radial-gradient(circle at 50% 100%, black, transparent 70%);"></div>
        <div class="absolute -bottom-10 -left-20 w-64 h-96 opacity-10 blur-[2px] rotate-12">
            <span class="material-icons text-[200px] text-primary">park</span>
        </div>
        <div class="absolute -bottom-10 -right-20 w-64 h-96 opacity-10 blur-[2px] -rotate-12">
            <span class="material-icons text-[200px] text-primary">park</span>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8 max-w-2xl relative z-10">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-block px-4 py-1.5 rounded-full bg-primary/10 border border-primary/20 mb-4 animate-bounce">
                <span class="text-[10px] font-black text-primary uppercase tracking-[0.3em]">SUMMER EVENT {{ date('Y') }}</span>
            </div>
            <h1 class="text-4xl md:text-6xl font-black text-white italic tracking-tighter uppercase mb-2">
                HỨNG DỪA <span class="text-primary drop-shadow-[0_0_15px_rgba(0,255,133,0.6)]">ĐÓN QUÀ</span>
            </h1>
            <p class="text-neutral-500 font-bold uppercase tracking-widest text-xs">Surf the wave • Catch coconuts • Win prizes</p>
        </div>

        <!-- Spins Counter -->
        <div class="flex justify-center mb-8">
            <div class="glass px-8 py-4 rounded-3xl border border-white/5 shadow-2xl flex flex-col items-center group overflow-hidden relative">
                <div class="absolute inset-0 bg-primary/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <p class="text-[9px] font-black text-neutral-500 uppercase tracking-widest mb-1 relative z-10">LƯỢT LƯỚT CÒN LẠI</p>
                <p class="text-4xl font-black text-white relative z-10 italic">{{ $this->spinsLeft }}</p>
            </div>
        </div>

        <!-- Game Canvas Area -->
        <div class="relative mb-8">
            @if (session()->has('error'))
            <div class="absolute -top-16 left-0 w-full bg-pink-500/10 border border-pink-500/20 text-pink-500 px-4 py-3 rounded-2xl text-xs font-black uppercase tracking-widest text-center animate-shake z-30">
                {{ session('error') }}
            </div>
            @endif

            <div class="glass rounded-[2rem] border border-white/10 p-1 bg-black/40 overflow-hidden relative shadow-[0_0_50px_rgba(0,0,0,0.5)]">
                <canvas id="surf-game" class="w-full rounded-[1.8rem] block" style="aspect-ratio: 16/10; image-rendering: auto;"></canvas>
                <!-- Game status overlay -->
                <div id="game-idle-overlay" class="absolute inset-0 flex items-center justify-center bg-black/30 rounded-[1.8rem] transition-opacity duration-300">
                    <div class="text-center">
                        <span class="material-icons text-6xl text-primary animate-float mb-4 block">surfing</span>
                        <p class="text-white font-black text-lg uppercase tracking-wider">Sẵn sàng hứng dừa!</p>
                        <p class="text-neutral-500 text-xs mt-2">Nhấn nút bên dưới để bắt đầu</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Button -->
        <div class="flex flex-col items-center gap-6 relative z-10 px-4 mb-8">
            <button
                wire:click="spin"
                wire:loading.attr="disabled"
                {{ $this->spinsLeft <= 0 ? 'disabled' : '' }}
                id="surf-btn"
                class="group relative w-full max-w-sm py-6 rounded-[2rem] font-black text-white shadow-2xl transition-all transform active:scale-95 disabled:opacity-30 disabled:grayscale overflow-hidden border-none btn-esport">
                <div class="absolute bottom-0 left-0 w-full h-1 bg-white/20 blur-[1px]"></div>

                <span wire:loading.remove class="flex items-center justify-center gap-3 relative z-10 text-base italic tracking-tighter">
                    <span class="material-icons text-xl">surfing</span>
                    BẮT ĐẦU LƯỚT NGAY
                </span>
                <span wire:loading class="flex items-center justify-center gap-2 relative z-10">
                    <span class="material-icons animate-spin">refresh</span>
                    ĐANG RẼ SÓNG...
                </span>

                <div class="absolute inset-x-0 top-0 h-px bg-linear-to-r from-transparent via-white/40 to-transparent -translate-x-full group-hover:animate-shimmer"></div>
            </button>
            <p class="text-[10px] font-bold text-neutral-600 uppercase tracking-[0.3em]">Cơ hội nhận đến 200,000đ trực tiếp vào ví</p>
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
                    {{ $prizeAmount > 0 ? 'HỨNG TRÚNG DỪA!' : 'HỤT MẤT RỒI!' }}
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
                    TIẾP TỤC LƯỚT SÓNG
                </button>
            </div>
        </div>
        @endif

        <!-- Rules -->
        <div class="glass rounded-[2.5rem] border border-white/10 shadow-2xl p-10 relative overflow-hidden">
            <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: url('{{ asset('images/esport/bg_pattern.png') }}'); background-size: cover;"></div>

            <div class="flex items-center gap-4 mb-8 relative z-10">
                <div class="w-12 h-12 bg-primary/10 border border-primary/20 rounded-2xl flex items-center justify-center text-primary">
                    <span class="material-icons">help_outline</span>
                </div>
                <h3 class="text-2xl font-black text-white uppercase tracking-tighter italic">LUẬT CHƠI HỨNG DỪA</h3>
            </div>

            <ul class="space-y-4 relative z-10">
                <li class="flex items-start gap-4 p-5 bg-white/5 rounded-3xl border border-white/5 group hover:bg-white/10 transition-colors">
                    <div class="w-8 h-8 bg-primary/20 rounded-xl flex items-center justify-center shrink-0 text-primary text-xs font-black group-hover:bg-primary group-hover:text-black transition-all">01</div>
                    <span class="text-xs font-bold text-neutral-400 leading-relaxed uppercase tracking-wide">Mỗi lượt nạp hoặc đơn hàng đạt mốc quy định sẽ nhận được <strong class="text-primary italic">Lượt Lướt Sóng</strong> tương ứng.</span>
                </li>
                <li class="flex items-start gap-4 p-5 bg-white/5 rounded-3xl border border-white/5 group hover:bg-white/10 transition-colors">
                    <div class="w-8 h-8 bg-primary/20 rounded-xl flex items-center justify-center shrink-0 text-primary text-xs font-black group-hover:bg-primary group-hover:text-black transition-all">02</div>
                    <span class="text-xs font-bold text-neutral-400 leading-relaxed uppercase tracking-wide">Nhấn nút "BẮT ĐẦU LƯỚT" → Surfer xuất hiện trên biển, dừa rơi từ cây dừa trên trời.</span>
                </li>
                <li class="flex items-start gap-4 p-5 bg-white/5 rounded-3xl border border-white/5 group hover:bg-white/10 transition-colors">
                    <div class="w-8 h-8 bg-primary/20 rounded-xl flex items-center justify-center shrink-0 text-primary text-xs font-black group-hover:bg-primary group-hover:text-black transition-all">03</div>
                    <span class="text-xs font-bold text-neutral-400 leading-relaxed uppercase tracking-wide">Di chuột hoặc chạm màn hình để di chuyển surfer hứng dừa. <strong class="text-primary italic">Dừa vàng = có thưởng!</strong></span>
                </li>
                <li class="flex items-start gap-4 p-5 bg-white/5 rounded-3xl border border-white/5 group hover:bg-white/10 transition-colors">
                    <div class="w-8 h-8 bg-primary/20 rounded-xl flex items-center justify-center shrink-0 text-primary text-xs font-black group-hover:bg-primary group-hover:text-black transition-all">04</div>
                    <span class="text-xs font-bold text-neutral-400 leading-relaxed uppercase tracking-wide">Phần thưởng sẽ được cộng trực tiếp vào ví sau khi kết thúc ván lướt.</span>
                </li>
            </ul>
        </div>
    </div>

<style>
    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    @keyframes bounceIn {
        0% { transform: scale(0.3); opacity: 0; }
        50% { transform: scale(1.05); }
        70% { transform: scale(0.95); }
        100% { transform: scale(1); opacity: 1; }
    }
    @keyframes shimmer { 100% { transform: translateX(100%); } }
    .animate-shimmer { animation: shimmer 1.5s infinite; }
    .animate-float { animation: float 2s ease-in-out infinite; }
    @keyframes float { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }
    .animate-pulse-slow { animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
    @keyframes pulse { 0%,100% { opacity: 0.1; } 50% { opacity: 0.2; } }
</style>
</div>

@script
<script>
(function() {
    // ============================================================
    // 🏄 SURF & CATCH COCONUTS — Canvas Mini-Game Engine
    // ============================================================
    const canvas = document.getElementById('surf-game');
    const ctx = canvas.getContext('2d');
    const overlay = document.getElementById('game-idle-overlay');
    const coconutImg = new Image();
    coconutImg.src = '/images/summer/coconut.png';

    let W, H;
    let gameRunning = false;
    let gameTime = 0;
    const GAME_DURATION = 5000; // 5 seconds
    let prizeAmount = 0;
    let mouseX = 0.5; // normalized 0-1
    let animFrameId = null;

    // Resize canvas to actual pixel size
    function resize() {
        const rect = canvas.getBoundingClientRect();
        const dpr = Math.min(window.devicePixelRatio || 1, 2);
        W = rect.width * dpr;
        H = rect.height * dpr;
        canvas.width = W;
        canvas.height = H;
        ctx.scale(dpr, dpr);
        // Store CSS dimensions for calculations
        canvas._cssW = rect.width;
        canvas._cssH = rect.height;
    }

    resize();
    window.addEventListener('resize', resize);

    // ============================================================
    // GAME OBJECTS
    // ============================================================

    // --- Sky & Background ---
    function drawSky() {
        const cssW = canvas._cssW, cssH = canvas._cssH;
        const grad = ctx.createLinearGradient(0, 0, 0, cssH);
        grad.addColorStop(0, '#0a1628');
        grad.addColorStop(0.4, '#0d2137');
        grad.addColorStop(0.7, '#0a4d7a');
        grad.addColorStop(1, '#0077b6');
        ctx.fillStyle = grad;
        ctx.fillRect(0, 0, cssW, cssH);
    }

    // --- Stars ---
    const stars = [];
    function initStars() {
        stars.length = 0;
        for (let i = 0; i < 40; i++) {
            stars.push({ x: Math.random(), y: Math.random() * 0.5, r: Math.random() * 1.5 + 0.5, blink: Math.random() * Math.PI * 2 });
        }
    }
    initStars();

    function drawStars(t) {
        const cssW = canvas._cssW, cssH = canvas._cssH;
        stars.forEach(s => {
            const alpha = 0.3 + 0.7 * Math.abs(Math.sin(t * 0.001 + s.blink));
            ctx.beginPath();
            ctx.arc(s.x * cssW, s.y * cssH, s.r, 0, Math.PI * 2);
            ctx.fillStyle = `rgba(255,255,255,${alpha})`;
            ctx.fill();
        });
    }

    // --- Moon ---
    function drawMoon(t) {
        const cssW = canvas._cssW, cssH = canvas._cssH;
        const mx = cssW * 0.82, my = cssH * 0.12, mr = 28;
        // Glow
        const glow = ctx.createRadialGradient(mx, my, mr * 0.5, mx, my, mr * 4);
        glow.addColorStop(0, 'rgba(255,215,0,0.15)');
        glow.addColorStop(1, 'rgba(255,215,0,0)');
        ctx.fillStyle = glow;
        ctx.fillRect(mx - mr * 4, my - mr * 4, mr * 8, mr * 8);
        // Moon body
        ctx.beginPath();
        ctx.arc(mx, my, mr, 0, Math.PI * 2);
        ctx.fillStyle = '#FFD700';
        ctx.fill();
        ctx.beginPath();
        ctx.arc(mx + 8, my - 4, mr * 0.85, 0, Math.PI * 2);
        ctx.fillStyle = '#0a1628';
        ctx.fill();
    }

    // --- Clouds ---
    const clouds = [
        { x: 0.1, y: 0.08, w: 120, h: 30, speed: 0.008 },
        { x: 0.5, y: 0.15, w: 90, h: 22, speed: 0.012 },
        { x: 0.8, y: 0.05, w: 100, h: 25, speed: 0.006 },
    ];

    function drawClouds(t) {
        const cssW = canvas._cssW, cssH = canvas._cssH;
        ctx.fillStyle = 'rgba(255,255,255,0.06)';
        clouds.forEach(c => {
            const cx = ((c.x + t * c.speed * 0.001) % 1.3 - 0.15) * cssW;
            const cy = c.y * cssH;
            // Simple cloud shape with circles
            for (let i = 0; i < 3; i++) {
                ctx.beginPath();
                ctx.ellipse(cx + i * c.w * 0.3, cy, c.w * 0.25, c.h, 0, 0, Math.PI * 2);
                ctx.fill();
            }
        });
    }

    // --- Palm Trees ---
    function drawPalmTree(x, baseY, size, flip, t) {
        const cssW = canvas._cssW, cssH = canvas._cssH;
        const sway = Math.sin(t * 0.002) * 3;
        ctx.save();
        ctx.translate(x, baseY);
        if (flip) ctx.scale(-1, 1);

        // Trunk
        ctx.strokeStyle = '#5a3e1b';
        ctx.lineWidth = size * 0.12;
        ctx.lineCap = 'round';
        ctx.beginPath();
        ctx.moveTo(0, 0);
        ctx.quadraticCurveTo(size * 0.15 + sway, -size * 0.5, sway * 0.5, -size);
        ctx.stroke();

        // Coconuts
        const cocoY = -size * 0.88;
        const cocoX = sway * 0.5;
        ctx.fillStyle = '#8B4513';
        for (let i = -1; i <= 1; i++) {
            ctx.beginPath();
            ctx.arc(cocoX + i * 6, cocoY + Math.abs(i) * 3, 4, 0, Math.PI * 2);
            ctx.fill();
        }

        // Leaves
        const leafColors = ['#2d8a4e', '#34a853', '#43b864'];
        const leafAngles = [-0.8, -0.4, 0, 0.4, 0.8, 1.2, -1.2];
        leafAngles.forEach((angle, i) => {
            ctx.save();
            ctx.translate(sway * 0.5, -size);
            ctx.rotate(angle + sway * 0.015);
            ctx.fillStyle = leafColors[i % leafColors.length];
            ctx.beginPath();
            ctx.ellipse(size * 0.35, 0, size * 0.4, size * 0.06, 0, 0, Math.PI * 2);
            ctx.fill();
            // Leaf vein
            ctx.strokeStyle = 'rgba(0,0,0,0.15)';
            ctx.lineWidth = 1;
            ctx.beginPath();
            ctx.moveTo(0, 0);
            ctx.lineTo(size * 0.6, 0);
            ctx.stroke();
            ctx.restore();
        });

        ctx.restore();
    }

    // --- Waves ---
    function drawWaves(t) {
        const cssW = canvas._cssW, cssH = canvas._cssH;
        const waveY = cssH * 0.68;

        // Multiple wave layers
        const waveLayers = [
            { color: 'rgba(0,119,182,0.4)', amp: 8, freq: 0.02, speed: 0.003, yOff: 0 },
            { color: 'rgba(0,150,199,0.5)', amp: 6, freq: 0.025, speed: -0.004, yOff: 15 },
            { color: 'rgba(0,180,216,0.6)', amp: 5, freq: 0.03, speed: 0.005, yOff: 30 },
        ];

        waveLayers.forEach(wl => {
            ctx.beginPath();
            ctx.moveTo(0, cssH);
            for (let x = 0; x <= cssW; x += 3) {
                const y = waveY + wl.yOff + Math.sin(x * wl.freq + t * wl.speed) * wl.amp
                    + Math.sin(x * wl.freq * 1.5 + t * wl.speed * 0.7) * wl.amp * 0.5;
                ctx.lineTo(x, y);
            }
            ctx.lineTo(cssW, cssH);
            ctx.closePath();
            ctx.fillStyle = wl.color;
            ctx.fill();
        });

        // Water fill
        const waterGrad = ctx.createLinearGradient(0, waveY + 30, 0, cssH);
        waterGrad.addColorStop(0, 'rgba(0,100,150,0.7)');
        waterGrad.addColorStop(1, 'rgba(0,50,80,0.9)');
        ctx.fillStyle = waterGrad;
        ctx.fillRect(0, waveY + 25, cssW, cssH - waveY);
    }

    // --- Surfer ---
    const surfer = { x: 0.5, targetX: 0.5, y: 0, w: 50, h: 60 };

    function drawSurfer(t) {
        const cssW = canvas._cssW, cssH = canvas._cssH;
        // Smooth follow
        surfer.x += (surfer.targetX - surfer.x) * 0.08;
        const sx = surfer.x * cssW;
        const waveY = cssH * 0.68;
        const sy = waveY - 5 + Math.sin(t * 0.004) * 4;
        surfer.y = sy;

        ctx.save();
        ctx.translate(sx, sy);

        // Surfboard
        const boardGrad = ctx.createLinearGradient(-22, 8, 22, 8);
        boardGrad.addColorStop(0, '#FFD700');
        boardGrad.addColorStop(1, '#FFA500');
        ctx.fillStyle = boardGrad;
        ctx.beginPath();
        ctx.ellipse(0, 8, 22, 5, 0, 0, Math.PI * 2);
        ctx.fill();
        ctx.strokeStyle = 'rgba(255,255,255,0.3)';
        ctx.lineWidth = 1;
        ctx.stroke();

        // Body
        ctx.fillStyle = '#ffd6a5';
        ctx.beginPath();
        ctx.arc(0, -18, 9, 0, Math.PI * 2); // head
        ctx.fill();

        // Hair
        ctx.fillStyle = '#5a3e1b';
        ctx.beginPath();
        ctx.arc(0, -22, 9, Math.PI, Math.PI * 2);
        ctx.fill();

        // Torso
        ctx.fillStyle = '#00AEEF';
        ctx.fillRect(-7, -9, 14, 15);

        // Arms up (catching pose)
        ctx.strokeStyle = '#ffd6a5';
        ctx.lineWidth = 3;
        ctx.lineCap = 'round';
        // Left arm
        ctx.beginPath();
        ctx.moveTo(-7, -5);
        ctx.lineTo(-16, -18 + Math.sin(t * 0.006) * 3);
        ctx.stroke();
        // Right arm
        ctx.beginPath();
        ctx.moveTo(7, -5);
        ctx.lineTo(16, -18 + Math.sin(t * 0.006 + 1) * 3);
        ctx.stroke();

        // Legs
        ctx.strokeStyle = '#ffd6a5';
        ctx.lineWidth = 3;
        ctx.beginPath();
        ctx.moveTo(-3, 6);
        ctx.lineTo(-5, 10);
        ctx.stroke();
        ctx.beginPath();
        ctx.moveTo(3, 6);
        ctx.lineTo(5, 10);
        ctx.stroke();

        // Splash effect
        ctx.fillStyle = 'rgba(255,255,255,0.3)';
        for (let i = 0; i < 5; i++) {
            const angle = (i / 5) * Math.PI - Math.PI * 0.5;
            const splashR = 3 + Math.sin(t * 0.01 + i) * 2;
            ctx.beginPath();
            ctx.arc(Math.cos(angle) * 28, 10 + Math.sin(angle) * 4, splashR, 0, Math.PI * 2);
            ctx.fill();
        }

        ctx.restore();
    }

    // --- Coconuts (Falling) ---
    let coconuts = [];

    function spawnCoconut(isGolden, delay) {
        const cssW = canvas._cssW, cssH = canvas._cssH;
        setTimeout(() => {
            coconuts.push({
                x: 0.15 + Math.random() * 0.7,
                y: -0.05,
                speed: 0.005 + Math.random() * 0.003,
                golden: isGolden,
                radius: isGolden ? 14 : 10,
                rotation: Math.random() * Math.PI * 2,
                rotSpeed: (Math.random() - 0.5) * 0.05,
                caught: false,
                missed: false,
                catchAnim: 0,
            });
        }, delay);
    }

    function drawCoconuts(t) {
        const cssW = canvas._cssW, cssH = canvas._cssH;
        const waveY = cssH * 0.68;

        coconuts.forEach(c => {
            if (c.caught || c.missed) return;

            c.y += c.speed;
            c.rotation += c.rotSpeed;

            const cx = c.x * cssW;
            const cy = c.y * cssH;

            ctx.save();
            ctx.translate(cx, cy);
            ctx.rotate(c.rotation);

            // Coconut body
            if (c.golden) {
                // Golden coconut — prize!
                const goldGrad = ctx.createRadialGradient(0, 0, 2, 0, 0, c.radius);
                goldGrad.addColorStop(0, '#FFE55C');
                goldGrad.addColorStop(0.7, '#FFD700');
                goldGrad.addColorStop(1, '#CC8800');
                ctx.fillStyle = goldGrad;
                ctx.beginPath();
                ctx.arc(0, 0, c.radius, 0, Math.PI * 2);
                ctx.fill();
                // Sparkle
                ctx.fillStyle = 'rgba(255,255,255,0.8)';
                ctx.beginPath();
                ctx.arc(-3, -4, 2.5, 0, Math.PI * 2);
                ctx.fill();
                // Glow
                ctx.shadowColor = '#FFD700';
                ctx.shadowBlur = 15;
                ctx.beginPath();
                ctx.arc(0, 0, c.radius + 2, 0, Math.PI * 2);
                ctx.strokeStyle = 'rgba(255,215,0,0.4)';
                ctx.lineWidth = 2;
                ctx.stroke();
                ctx.shadowBlur = 0;
                // ₫ symbol
                ctx.fillStyle = '#8B4513';
                ctx.font = 'bold 10px sans-serif';
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                ctx.fillText('₫', 0, 1);
            } else {
                // Regular coconut
                const cocoGrad = ctx.createRadialGradient(0, -2, 2, 0, 0, c.radius);
                cocoGrad.addColorStop(0, '#8B6914');
                cocoGrad.addColorStop(0.7, '#6B4613');
                cocoGrad.addColorStop(1, '#4a3010');
                ctx.fillStyle = cocoGrad;
                ctx.beginPath();
                ctx.arc(0, 0, c.radius, 0, Math.PI * 2);
                ctx.fill();
                // Eyes
                ctx.fillStyle = '#3a2510';
                ctx.beginPath(); ctx.arc(-3, 0, 1.5, 0, Math.PI * 2); ctx.fill();
                ctx.beginPath(); ctx.arc(3, 0, 1.5, 0, Math.PI * 2); ctx.fill();
                ctx.beginPath(); ctx.arc(0, 3, 1, 0, Math.PI * 2); ctx.fill();
            }

            ctx.restore();

            // Collision detection with surfer
            const surferCx = surfer.x * cssW;
            const surferCy = surfer.y;
            const dist = Math.hypot(cx - surferCx, cy - surferCy);

            if (dist < 35 && cy > waveY - 40) {
                c.caught = true;
                c.catchAnim = 1;
                spawnCatchParticles(cx, cy, c.golden);
            }

            // Fell into water
            if (cy > waveY + 20) {
                c.missed = true;
            }
        });

        // Clean up
        coconuts = coconuts.filter(c => !c.missed && (!c.caught || c.catchAnim > 0));
    }

    // --- Particles ---
    let particles = [];

    function spawnCatchParticles(x, y, golden) {
        const color = golden ? '#FFD700' : '#8B6914';
        for (let i = 0; i < (golden ? 20 : 8); i++) {
            particles.push({
                x, y,
                vx: (Math.random() - 0.5) * 4,
                vy: -Math.random() * 4 - 1,
                life: 1,
                decay: 0.015 + Math.random() * 0.01,
                radius: Math.random() * 3 + 1,
                color: golden ? (Math.random() > 0.5 ? '#FFD700' : '#FFF') : color,
            });
        }
    }

    function drawParticles() {
        particles.forEach(p => {
            p.x += p.vx;
            p.y += p.vy;
            p.vy += 0.1; // gravity
            p.life -= p.decay;

            if (p.life > 0) {
                ctx.globalAlpha = p.life;
                ctx.fillStyle = p.color;
                ctx.beginPath();
                ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
                ctx.fill();
                ctx.globalAlpha = 1;
            }
        });
        particles = particles.filter(p => p.life > 0);
    }

    // --- Score popup ---
    let scorePopups = [];
    function addScorePopup(text, x, y) {
        scorePopups.push({ text, x, y, life: 1, vy: -1.5 });
    }
    function drawScorePopups() {
        scorePopups.forEach(s => {
            s.y += s.vy;
            s.life -= 0.012;
            if (s.life > 0) {
                ctx.globalAlpha = s.life;
                ctx.fillStyle = '#FFD700';
                ctx.font = 'bold 16px "Outfit", sans-serif';
                ctx.textAlign = 'center';
                ctx.fillText(s.text, s.x, s.y);
                ctx.globalAlpha = 1;
            }
        });
        scorePopups = scorePopups.filter(s => s.life > 0);
    }

    // ============================================================
    // IDLE ANIMATION (when not playing)
    // ============================================================
    function drawIdle(t) {
        const cssW = canvas._cssW, cssH = canvas._cssH;
        drawSky();
        drawStars(t);
        drawMoon(t);
        drawClouds(t);
        drawPalmTree(cssW * 0.08, cssH * 0.65, cssH * 0.45, false, t);
        drawPalmTree(cssW * 0.92, cssH * 0.65, cssH * 0.4, true, t);
        drawWaves(t);
    }

    let idleRaf;
    function idleLoop(t) {
        const cssW = canvas._cssW, cssH = canvas._cssH;
        ctx.clearRect(0, 0, cssW, cssH);
        drawIdle(t);
        idleRaf = requestAnimationFrame(idleLoop);
    }
    // Start idle animation
    idleRaf = requestAnimationFrame(idleLoop);

    // ============================================================
    // GAME LOOP
    // ============================================================
    let gameStartTime = 0;
    let finalPhaseStarted = false;

    function startGame(prize) {
        if (gameRunning) return;
        gameRunning = true;
        prizeAmount = prize;
        finalPhaseStarted = false;
        coconuts = [];
        particles = [];
        scorePopups = [];
        gameStartTime = performance.now();
        surfer.x = 0.5;
        surfer.targetX = 0.5;

        // Hide overlay
        if (overlay) overlay.style.opacity = '0';
        setTimeout(() => { if (overlay) overlay.style.display = 'none'; }, 300);

        // Cancel idle
        cancelAnimationFrame(idleRaf);

        // Spawn regular coconuts at intervals
        for (let i = 0; i < 6; i++) {
            spawnCoconut(false, 200 + i * 400);
        }

        // Start game loop
        animFrameId = requestAnimationFrame(gameLoop);
    }

    function gameLoop(timestamp) {
        const cssW = canvas._cssW, cssH = canvas._cssH;
        const elapsed = timestamp - gameStartTime;
        ctx.clearRect(0, 0, cssW, cssH);

        // Draw scene
        drawSky();
        drawStars(timestamp);
        drawMoon(timestamp);
        drawClouds(timestamp);
        drawPalmTree(cssW * 0.08, cssH * 0.65, cssH * 0.45, false, timestamp);
        drawPalmTree(cssW * 0.92, cssH * 0.65, cssH * 0.4, true, timestamp);
        drawCoconuts(timestamp);
        drawSurfer(timestamp);
        drawWaves(timestamp);
        drawParticles();
        drawScorePopups();

        // Check for golden catch → show score
        coconuts.forEach(c => {
            if (c.golden && c.caught && c.catchAnim > 0) {
                if (c.catchAnim === 1) {
                    c.catchAnim = 0.99;
                    const label = prizeAmount > 0 ? '+' + prizeAmount.toLocaleString() + 'đ' : 'Nice!';
                    addScorePopup(label, surfer.x * cssW, surfer.y - 40);
                    
                    // Trigger modal after catch
                    setTimeout(endGame, 1200);
                }
            }
            // If missed golden (shouldn't happen with current logic but for safety)
            if (c.golden && c.missed) {
                setTimeout(endGame, 1000);
            }
        });

        // Timer bar
        const progress = Math.min(elapsed / GAME_DURATION, 1);
        ctx.fillStyle = 'rgba(0,0,0,0.4)';
        ctx.fillRect(cssW * 0.1, 12, cssW * 0.8, 6);
        const barGrad = ctx.createLinearGradient(cssW * 0.1, 0, cssW * 0.1 + cssW * 0.8 * progress, 0);
        barGrad.addColorStop(0, '#00AEEF');
        barGrad.addColorStop(1, '#FFD700');
        ctx.fillStyle = barGrad;
        ctx.fillRect(cssW * 0.1, 12, cssW * 0.8 * progress, 6);
        ctx.strokeStyle = 'rgba(255,255,255,0.2)';
        ctx.lineWidth = 1;
        ctx.strokeRect(cssW * 0.1, 12, cssW * 0.8, 6);

        if (elapsed < GAME_DURATION) {
            animFrameId = requestAnimationFrame(gameLoop);
        } else if (!finalPhaseStarted) {
            finalPhaseStarted = true;
            // Spawn the "Result" coconut
            const isWin = prizeAmount > 0;
            const resultCoco = {
                x: surfer.x + (Math.random() - 0.5) * 0.1, // Near surfer
                y: -0.1,
                speed: 0.007,
                golden: isWin,
                radius: isWin ? 18 : 12,
                rotation: 0,
                rotSpeed: 0.05,
                caught: false,
                missed: false,
                catchAnim: 0,
            };
            coconuts.push(resultCoco);
            
            // If it's a lose, we still need to end game after it falls
            if (!isWin) {
                setTimeout(() => {
                    if (!gameRunning) return;
                    endGame();
                }, 2000);
            }
            
            // Continue loop to show falling result coconut
            animFrameId = requestAnimationFrame(gameLoop);
        } else if (gameRunning) {
            // Keep loop until endGame is explicitly called by catch/timeout
            animFrameId = requestAnimationFrame(gameLoop);
        }
    }

    function endGame() {
        if (!gameRunning) return;
        gameRunning = false;
        cancelAnimationFrame(animFrameId);

        @this.set('showResult', true);
        @this.set('spinning', false);

        // Restart idle
        if (overlay) {
            overlay.style.display = 'flex';
            setTimeout(() => { overlay.style.opacity = '1'; }, 50);
        }
        idleRaf = requestAnimationFrame(idleLoop);
    }

    // ============================================================
    // CONTROLS
    // ============================================================
    canvas.addEventListener('mousemove', (e) => {
        if (!gameRunning) return;
        const rect = canvas.getBoundingClientRect();
        surfer.targetX = Math.max(0.1, Math.min(0.9, (e.clientX - rect.left) / rect.width));
    });

    canvas.addEventListener('touchmove', (e) => {
        if (!gameRunning) return;
        e.preventDefault();
        const rect = canvas.getBoundingClientRect();
        const touch = e.touches[0];
        surfer.targetX = Math.max(0.1, Math.min(0.9, (touch.clientX - rect.left) / rect.width));
    }, { passive: false });

    // Auto-play when no interaction
    let autoPlayInterval = null;
    function startAutoPlay() {
        autoPlayInterval = setInterval(() => {
            if (!gameRunning) return;
            surfer.targetX = 0.3 + Math.random() * 0.4;
        }, 800);
    }

    // ============================================================
    // LIVEWIRE EVENT
    // ============================================================
    $wire.on('start-surf-game', (data) => {
        const prize = Array.isArray(data) ? data[0].prizeAmount : data.prizeAmount;
        startAutoPlay();
        startGame(prize || 0);
    });

})();
</script>
@endscript