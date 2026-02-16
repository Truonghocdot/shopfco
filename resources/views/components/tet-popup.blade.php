{{-- Tet Greeting & Li Xi Popup --}}
@auth
@php
$user = auth()->user();
$bonusAmount = 0;
// Check if user received bonus today
$todayBonus = \App\Models\CouponUsage::where('user_id', $user->id)
->whereHas('coupon', function($q) {
$q->where('code', 'like', 'BONUS_%');
})
->whereDate('used_at', today())
->first();
if ($todayBonus) {
$bonusAmount = $todayBonus->discount_amount;
}
@endphp

@if($bonusAmount > 0)
<div id="tet-popup" class="fixed inset-0 z-[2147483647] hidden items-center justify-center p-4" style="background: radial-gradient(ellipse at center, rgb(139,0,0) 0%, rgb(0,0,0) 100%);">
    {{-- Particles --}}
    <div class="tet-particles" aria-hidden="true">
        @for($i = 0; $i < 20; $i++)
            <div class="tet-particle" style="--i: {{ $i }}; --x: {{ rand(-50, 50) }}vw; --delay: {{ $i * 0.15 }}s; --size: {{ rand(8, 20) }}px;">
    </div>
    @endfor
</div>

<div class="relative max-w-md w-full tet-popup-content">
    {{-- Envelope --}}
    <div class="relative mx-auto" style="max-width: 380px;">
        {{-- Top decorative border --}}
        <div class="text-center mb-2">
            <span class="text-4xl">🧧🧧🧧</span>
        </div>

        <div class="bg-gradient-to-b from-red-700 via-red-600 to-red-800 rounded-2xl shadow-2xl overflow-hidden border-2 border-yellow-400/60 relative">
            {{-- Gold pattern overlay --}}
            <div class="absolute inset-0 opacity-10" style="background-image: repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(255,215,0,0.3) 10px, rgba(255,215,0,0.3) 20px);"></div>

            {{-- Top golden band --}}
            <div class="bg-gradient-to-r from-yellow-600 via-yellow-400 to-yellow-600 h-3"></div>

            {{-- Close button --}}
            <button onclick="closeTetPopup()" class="absolute top-4 right-3 text-yellow-300/70 hover:text-yellow-200 transition-colors z-10">
                <span class="material-icons text-xl">close</span>
            </button>

            {{-- Content --}}
            <div class="p-6 pt-5 text-center relative z-10">
                {{-- Year decoration --}}
                <div class="mb-3">
                    <p class="text-yellow-400 font-bold text-sm tracking-[0.3em] uppercase" style="font-family: 'Lexend', sans-serif;">Xuân Bính Ngọ 2026</p>
                </div>

                {{-- Main greeting --}}
                <div class="mb-4">
                    <h2 class="text-3xl font-black text-yellow-300 mb-2" style="font-family: 'Lexend', sans-serif; text-shadow: 0 2px 10px rgba(255,215,0,0.4);">
                        🎊 CHÚC MỪNG NĂM MỚI 🎊
                    </h2>
                    <p class="text-yellow-100/90 text-sm leading-relaxed">
                        <span class="font-bold text-yellow-200">AccFCO - VanhFCO</span> kính chúc Quý khách hàng<br>
                        năm mới <span class="text-yellow-300 font-bold">An Khang Thịnh Vượng</span>,<br>
                        <span class="text-yellow-300 font-bold">Vạn Sự Như Ý</span>! 🎉
                    </p>
                </div>

                {{-- Li Xi section --}}
                <div class="bg-gradient-to-b from-yellow-500/20 to-yellow-600/10 rounded-xl p-4 border border-yellow-400/30 mb-4 relative overflow-hidden">
                    <div class="absolute inset-0 opacity-5" style="background: radial-gradient(circle at 50% 50%, gold, transparent 70%);"></div>
                    <div class="relative z-10">
                        <p class="text-yellow-200 text-xs font-semibold mb-2 tracking-wider uppercase">🧧 Lì Xì Mừng Xuân 🧧</p>
                        <p class="text-yellow-100/80 text-xs mb-3">
                            Xin gửi đến <span class="text-yellow-300 font-bold">{{ $user->name }}</span> một lì xì nhỏ
                        </p>
                        <div class="inline-block bg-gradient-to-r from-yellow-500 via-yellow-400 to-yellow-500 rounded-lg px-6 py-2 shadow-lg">
                            <p class="text-red-800 font-black text-2xl" style="font-family: 'Lexend', sans-serif;">
                                +{{ number_format($bonusAmount, 0, ',', '.') }}đ
                            </p>
                        </div>
                        <p class="text-yellow-200/70 text-xs mt-2">Đã cộng vào tài khoản của bạn 💰</p>
                    </div>
                </div>

                {{-- CTA --}}
                <button onclick="closeTetPopup()" class="w-full bg-gradient-to-r from-yellow-500 via-yellow-400 to-yellow-500 hover:from-yellow-400 hover:via-yellow-300 hover:to-yellow-400 text-red-800 font-bold py-3 px-6 rounded-xl transition-all duration-300 active:scale-95 shadow-lg text-sm" style="font-family: 'Lexend', sans-serif;">
                    🎁 Nhận Lì Xì - Chúc Mừng Năm Mới!
                </button>
            </div>

            {{-- Bottom golden band --}}
            <div class="bg-gradient-to-r from-yellow-600 via-yellow-400 to-yellow-600 h-3"></div>
        </div>

        {{-- Bottom decoration --}}
        <div class="text-center mt-2">
            <span class="text-2xl">🏮✨🏮</span>
        </div>
    </div>
</div>

<style>
    .tet-popup-content {
        animation: tetPopupIn 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
    }

    @keyframes tetPopupIn {
        from {
            opacity: 0;
            transform: scale(0.7) translateY(30px);
        }

        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    /* Particles */
    .tet-particles {
        position: absolute;
        inset: 0;
        overflow: hidden;
        pointer-events: none;
    }

    .tet-particle {
        position: absolute;
        width: var(--size);
        height: var(--size);
        top: -20px;
        left: 50%;
        animation: tetParticleFall 4s var(--delay) infinite ease-in;
    }

    .tet-particle::before {
        content: '';
        display: block;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: radial-gradient(circle, gold 30%, rgba(255, 215, 0, 0.6));
        box-shadow: 0 0 6px rgba(255, 215, 0, 0.5);
    }

    @keyframes tetParticleFall {
        0% {
            transform: translateX(var(--x)) translateY(-20px) rotate(0deg);
            opacity: 1;
        }

        100% {
            transform: translateX(calc(var(--x) + 20px)) translateY(100vh) rotate(720deg);
            opacity: 0;
        }
    }
</style>

<script>
    function shouldShowTetPopup() {
        const hideUntil = localStorage.getItem('tet_popup_hide_until');
        if (!hideUntil) return true;
        return new Date() > new Date(hideUntil);
    }

    function closeTetPopup() {
        const modal = document.getElementById('tet-popup');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        // Hide for 24 hours
        const hideUntil = new Date();
        hideUntil.setHours(hideUntil.getHours() + 24);
        localStorage.setItem('tet_popup_hide_until', hideUntil.toISOString());
    }

    document.addEventListener('DOMContentLoaded', function() {
        if (shouldShowTetPopup()) {
            const modal = document.getElementById('tet-popup');
            // Show after 1.5s (after the regular popup)
            setTimeout(() => {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }, 1500);
        }
    });

    document.getElementById('tet-popup')?.addEventListener('click', function(e) {
        if (e.target === this) closeTetPopup();
    });
</script>
@endif
@endauth