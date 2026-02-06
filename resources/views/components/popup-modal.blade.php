{{-- Popup Modal Component --}}
@php
$popupContent = \App\Models\Setting::where('setting_name', \App\Constants\SettingName::POPUP_CONTENT->value)->value('setting_value');
@endphp

@if($popupContent)
<div id="popup-modal" class="fixed inset-0 z-[9999] hidden items-center justify-center p-4 bg-black/80 backdrop-blur-sm">
    <div class="relative max-w-2xl w-full">
        <!-- Grid Pattern Background -->
        <div class="absolute inset-0 opacity-10 pointer-events-none">
            <div class="absolute inset-0" style="background-image: repeating-linear-gradient(90deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px), repeating-linear-gradient(0deg, rgba(0, 255, 0, 0.1) 0px, transparent 1px, transparent 20px);"></div>
        </div>

        <!-- Modal Content -->
        <div class="relative bg-gradient-to-br from-black via-[#001a0f] to-black border-2 border-primary/50 rounded-2xl shadow-[0_0_50px_rgba(0,255,0,0.4)] overflow-hidden">
            <!-- Scan Line Animation -->
            <div class="absolute inset-0 opacity-20 pointer-events-none overflow-hidden">
                <div class="h-full w-[200%] bg-gradient-to-r from-transparent via-primary/20 to-transparent animate-shimmer"></div>
            </div>

            <!-- Header -->
            <div class="relative bg-gradient-to-r from-primary/20 to-primary/10 p-4 border-b-2 border-primary/30 flex justify-between items-center">
                <h3 class="text-xl font-black uppercase text-primary drop-shadow-[0_0_10px_rgba(0,255,0,0.8)] flex items-center gap-2">
                    <span class="material-icons">campaign</span>
                    THÔNG BÁO
                </h3>
                <button onclick="closePopup()" class="text-primary hover:text-white transition-colors">
                    <span class="material-icons drop-shadow-[0_0_8px_rgba(0,255,0,0.8)]">close</span>
                </button>
            </div>

            <!-- Content -->
            <div class="relative p-6 max-h-[60vh] overflow-y-auto prose prose-invert prose-primary max-w-none">
                {!! $popupContent !!}
            </div>

            <!-- Footer with Duration Options -->
            <div class="relative bg-gradient-to-r from-primary/10 to-transparent p-4 border-t-2 border-primary/30">
                <p class="text-sm text-slate-400 mb-3 font-bold">Ẩn thông báo này trong:</p>
                <div class="flex gap-3">
                    <button onclick="closePopup(1)" class="flex-1 bg-gradient-to-r from-primary/20 to-primary/10 hover:from-primary/30 hover:to-primary/20 border-2 border-primary/50 text-primary px-4 py-2 rounded-lg font-bold transition-all shadow-[0_0_10px_rgba(0,255,0,0.3)] hover:shadow-[0_0_20px_rgba(0,255,0,0.5)] active:scale-95">
                        <span class="material-icons text-sm align-middle mr-1">schedule</span>
                        1 Giờ
                    </button>
                    <button onclick="closePopup(24)" class="flex-1 bg-gradient-to-r from-primary/20 to-primary/10 hover:from-primary/30 hover:to-primary/20 border-2 border-primary/50 text-primary px-4 py-2 rounded-lg font-bold transition-all shadow-[0_0_10px_rgba(0,255,0,0.3)] hover:shadow-[0_0_20px_rgba(0,255,0,0.5)] active:scale-95">
                        <span class="material-icons text-sm align-middle mr-1">event</span>
                        24 Giờ
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Check if popup should be shown
    function shouldShowPopup() {
        const hideUntil = localStorage.getItem('popup_hide_until');
        if (!hideUntil) return true;

        const hideUntilTime = new Date(hideUntil);
        const now = new Date();

        return now > hideUntilTime;
    }

    // Close popup and set hide duration
    function closePopup(hours = 0) {
        const modal = document.getElementById('popup-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');

        if (hours > 0) {
            const hideUntil = new Date();
            hideUntil.setHours(hideUntil.getHours() + hours);
            localStorage.setItem('popup_hide_until', hideUntil.toISOString());
        }
    }

    // Show popup on page load if conditions are met
    document.addEventListener('DOMContentLoaded', function() {
        if (shouldShowPopup()) {
            const modal = document.getElementById('popup-modal');
            setTimeout(() => {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }, 1000); // Show after 1 second
        }
    });

    // Close on background click
    document.getElementById('popup-modal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closePopup();
        }
    });
</script>

<style>
    /* Custom prose styling for popup content */
    .prose-primary {
        color: #e2e8f0;
    }

    .prose-primary h1,
    .prose-primary h2,
    .prose-primary h3,
    .prose-primary h4 {
        color: #00ff00;
        text-shadow: 0 0 10px rgba(0, 255, 0, 0.8);
    }

    .prose-primary a {
        color: #00ff00;
        text-decoration: underline;
    }

    .prose-primary strong {
        color: #00ff00;
    }
</style>
@endif